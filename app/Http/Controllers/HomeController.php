<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Dispatch;
use App\Models\Lease;
use App\Models\PortStock;
use App\Models\SaleReport;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        if ($user->hasAnyRole(['Tag Operator', 'UnTag Operator'])) {
            $masterStockyesterday = PortStock::whereDate('created_at', '<', Carbon::today())
                ->whereHas('device', function ($query) {
                    $query->where('devicetype', 1);
                })
                ->count();

            $totalLeaseMasteryesterday = Lease::whereHas('master', function ($query) {
                $query->where('devicetype', 1);
            })
                ->where('tager_id', auth()->user()->id)
                ->whereDate('created_at', '<', Carbon::today())->count();
            $openingMaster = $masterStockyesterday - $totalLeaseMasteryesterday;

            // dd($openingMaster);

            $totalLeaseSlaveyesterday = Lease::whereHas('devices', function ($query) {
                $query->where('devicetype', 2);
            })
                ->where('tager_id', auth()->user()->id)
                ->whereDate('created_at', '<', Carbon::today())->count();

            $slaveStockyesterday = PortStock::whereDate('created_at', '<', Carbon::today())
                ->whereHas('device', function ($query) {
                    $query->where('devicetype', 2)->where('status', 0);
                })
                ->count();
            // dd($slaveStockyesterday);

            $openingSlave = $slaveStockyesterday - $totalLeaseSlaveyesterday;

            $today = now()->format('Y-m-d'); // Get the current date in 'Y-m-d' format

            $receivedMaster = Dispatch::whereHas('requisition', function ($query) {
                $query->where('request_id', auth()->user()->id)->whereDate('created_at', Carbon::today());
            })->whereHas('device', function ($query) {
                $query->where('devicetype', 1);
            })->count();

            // dd($receivedMaster);

            $receivedSlave = Dispatch::whereHas('requisition', function ($query) {
                $query->where('request_id', auth()->user()->id)->whereDate('created_at', Carbon::today());
            })->whereHas('device', function ($query) {
                $query->where('devicetype', 2);
            })->count();

            $leaseCashMaster = Lease::whereHas('master', function ($query) {
                $query->where('devicetype', 1);
            })
                ->where('tager_id', auth()->user()->id)->where('lease_type', 1)
                ->whereDate('created_at', Carbon::today())->count();

            $leaseCashSlave = Lease::where('tager_id', auth()->user()->id)
                ->where('lease_type', 1)
                ->whereDate('created_at', Carbon::today())
                ->whereHas('devices', function ($query) {
                    $query->where('devicetype', 2);
                })
                ->withCount('devices')
                ->count();

            // dd($leaseCashSlave);
            $leaseBillMaster = Lease::whereHas('master', function ($query) {
                $query->where('devicetype', 1);
            })
                ->where('tager_id', auth()->user()->id)->where('lease_type', 2)
                ->whereDate('created_at', Carbon::today())->count();

            $leaseBillSlave = Lease::where('tager_id', auth()->user()->id)
                ->where('lease_type', 2)
                ->whereDate('created_at', Carbon::today())
                ->whereHas('devices', function ($query) {
                    $query->where('devicetype', 2);
                })
                ->withCount('devices')
                ->count();

            $totalLeaseMaster = Lease::whereHas('master', function ($query) {
                $query->where('devicetype', 2);
            })
                ->where('tager_id', auth()->user()->id)
                ->whereDate('created_at', Carbon::today())->count();

            $totalLeaseSlave = Lease::whereHas('devices', function ($query) {
                $query->where('devicetype', 2);
            })
                ->where('tager_id', auth()->user()->id)
                ->whereDate('created_at', Carbon::today())->count();

            $closingMaster = PortStock::whereDate('created_at', Carbon::today())
                ->whereHas('device', function ($query) {
                    $query->where('devicetype', 1)->where('status', 0);
                })
                ->count();

            $closingSlave = PortStock::whereDate('created_at', '<', Carbon::today())
                ->whereHas('device', function ($query) {
                    $query->where('devicetype', 2)->where('status', 0);
                })
                ->count();

            $totalleaseMaster = Lease::where('tager_id', auth()->user()->id)
                ->whereDate('created_at', Carbon::today())->count();

            $leases = Lease::with('devices')
                ->where('tager_id', auth()->user()->id)
                ->whereDate('created_at', Carbon::today())
                ->get();

            // dd($leases);

            $totalSlaveCount = 0;
            foreach ($leases as $lease) {
                $totalSlaveCount += $lease->devices->count();
            }

            $coment = Comment::whereDate('created_at', Carbon::today())->count();
            $mycomment = Comment::whereDate('created_at', Carbon::today())
                ->where('user_id', auth()->user()->id)->first();
            // dd($coment);
            $returnedDeviceMaster = PortStock::where('user_id', auth()->user()->id)
                ->where('status', 2)->whereDate('updated_at', Carbon::today())
                ->whereHas('device', function ($query) {
                    $query->where('devicetype', 1);
                })
                ->count();

            // dd($returnedDeviceMaster);
            $returnedDeviceSlave = PortStock::where('user_id', auth()->user()->id)
                ->where('status', 2)->whereDate('updated_at', Carbon::today())
                ->whereHas('device', function ($query) {
                    $query->where('devicetype', 2);
                })
                ->count();

            return view('dashboard.port', [
                'openingMaster' => $openingMaster,
                'openingSlave' => $openingSlave,
                'date' => Carbon::today(),
                'receivedMaster' => $receivedMaster,
                'receivedSlave' => $receivedSlave,
                'leaseCashMaster' => $leaseCashMaster,
                'leaseCashSlave' => $leaseCashSlave,
                'leaseBillMaster' => $leaseBillMaster,
                'leaseBillSlave' => $leaseBillSlave,
                'totalLeaseMaster' => $totalLeaseMaster,
                'totalLeaseSlave' => $totalLeaseSlave,
                'closingMaster' => $openingMaster - $totalleaseMaster + $receivedMaster - $returnedDeviceMaster,
                'closingSlave' => $openingSlave - $totalSlaveCount + $receivedSlave - $returnedDeviceSlave,
                'coment' => $coment,
                'mycomment' => $mycomment,
            ]);
        }

        return view('dashboard.dashboard');
    }

    public function index2()
    {
        $masterStockyesterday = PortStock::whereDate('created_at', '<', Carbon::today())
            ->whereHas('device', function ($query) {
                $query->where('devicetype', 1);
            })
            ->count();

        $totalLeaseMasteryesterday = Lease::whereHas('master', function ($query) {
            $query->where('devicetype', 1);
        })
            ->where('tager_id', auth()->user()->id)
            ->whereDate('created_at', '<', Carbon::today())->count();
        $openingMaster = $masterStockyesterday - $totalLeaseMasteryesterday;

        // dd($openingMaster);

        $totalLeaseSlaveyesterday = Lease::whereHas('devices', function ($query) {
            $query->where('devicetype', 2);
        })
            ->where('tager_id', auth()->user()->id)
            ->whereDate('created_at', '<', Carbon::today())->count();

        $slaveStockyesterday = PortStock::whereDate('created_at', '<', Carbon::today())
            ->whereHas('device', function ($query) {
                $query->where('devicetype', 2)->where('status', 0);
            })
            ->count();
        // dd($slaveStockyesterday);

        $openingSlave = $slaveStockyesterday - $totalLeaseSlaveyesterday;

        $today = now()->format('Y-m-d'); // Get the current date in 'Y-m-d' format

        $receivedMaster = Dispatch::whereHas('requisition', function ($query) {
            $query->where('request_id', auth()->user()->id)->whereDate('created_at', Carbon::today());
        })->whereHas('device', function ($query) {
            $query->where('devicetype', 1);
        })->count();

        // dd($receivedMaster);

        $receivedSlave = Dispatch::whereHas('requisition', function ($query) {
            $query->where('request_id', auth()->user()->id)->whereDate('created_at', Carbon::today());
        })->whereHas('device', function ($query) {
            $query->where('devicetype', 2);
        })->count();

        $leaseCashMaster = Lease::whereHas('master', function ($query) {
            $query->where('devicetype', 1);
        })
            ->where('tager_id', auth()->user()->id)->where('lease_type', 1)
            ->whereDate('created_at', Carbon::today())->count();

        $leaseCashSlave = Lease::where('tager_id', auth()->user()->id)
            ->where('lease_type', 1)
            ->whereDate('created_at', Carbon::today())
            ->whereHas('devices', function ($query) {
                $query->where('devicetype', 2);
            })
            ->withCount('devices')
            ->count();

        // dd($leaseCashSlave);
        $leaseBillMaster = Lease::whereHas('master', function ($query) {
            $query->where('devicetype', 1);
        })
            ->where('tager_id', auth()->user()->id)->where('lease_type', 2)
            ->whereDate('created_at', Carbon::today())->count();

        $leaseBillSlave = Lease::where('tager_id', auth()->user()->id)
            ->where('lease_type', 2)
            ->whereDate('created_at', Carbon::today())
            ->whereHas('devices', function ($query) {
                $query->where('devicetype', 2);
            })
            ->withCount('devices')
            ->count();

        $totalLeaseMaster = Lease::whereHas('master', function ($query) {
            $query->where('devicetype', 2);
        })
            ->where('tager_id', auth()->user()->id)
            ->whereDate('created_at', Carbon::today())->count();

        $totalLeaseSlave = Lease::whereHas('devices', function ($query) {
            $query->where('devicetype', 2);
        })
            ->where('tager_id', auth()->user()->id)
            ->whereDate('created_at', Carbon::today())->count();

        $closingMaster = PortStock::whereDate('created_at', Carbon::today())
            ->whereHas('device', function ($query) {
                $query->where('devicetype', 1)->where('status', 0);
            })
            ->count();

        $closingSlave = PortStock::whereDate('created_at', '<', Carbon::today())
            ->whereHas('device', function ($query) {
                $query->where('devicetype', 2)->where('status', 0);
            })
            ->count();

        $totalleaseMaster = Lease::where('tager_id', auth()->user()->id)
            ->whereDate('created_at', Carbon::today())->count();

        // dd($totalLeaseMaster);

        $leases = Lease::with('devices')
            ->where('tager_id', auth()->user()->id)
            ->whereDate('created_at', Carbon::today())
            ->get();

        // dd($leases);

        $totalSlaveCount = 0;
        foreach ($leases as $lease) {
            $totalSlaveCount += $lease->devices->count();
        }

        $coment = Comment::whereDate('created_at', Carbon::today())->count();
        $mycomment = Comment::whereDate('created_at', Carbon::today())
            ->where('user_id', auth()->user()->id)->first();
        // dd($coment);
        $returnedDeviceMaster = PortStock::where('user_id', auth()->user()->id)
            ->where('status', 2)->whereDate('updated_at', Carbon::today())
            ->whereHas('device', function ($query) {
                $query->where('devicetype', 1);
            })
            ->count();

        // dd($returnedDeviceMaster);
        $returnedDeviceSlave = PortStock::where('user_id', auth()->user()->id)
            ->where('status', 2)->whereDate('updated_at', Carbon::today())
            ->whereHas('device', function ($query) {
                $query->where('devicetype', 2);
            })
            ->count();

        return view('dashboard.port', [
            'openingMaster' => $openingMaster,
            'openingSlave' => $openingSlave,
            'date' => Carbon::today(),
            'receivedMaster' => $receivedMaster,
            'receivedSlave' => $receivedSlave,
            'leaseCashMaster' => $leaseCashMaster,
            'leaseCashSlave' => $leaseCashSlave,
            'leaseBillMaster' => $leaseBillMaster,
            'leaseBillSlave' => $leaseBillSlave,
            'totalLeaseMaster' => $totalLeaseMaster,
            'totalLeaseSlave' => $totalLeaseSlave,
            'closingMaster' => $openingMaster - $totalleaseMaster + $receivedMaster - $returnedDeviceMaster,
            'closingSlave' => $openingSlave - $totalSlaveCount + $receivedSlave - $returnedDeviceSlave,
            'coment' => $coment,
            'mycomment' => $mycomment,

        ]);
    }

    public function comment(Request $request)
    {
        try {
            $report = SaleReport::create([
                'report_date' => Carbon::today(),
                'acknowledged_by_tagOperator' => auth()->user()->id,
            ]);

            if ($report) {
                $comment = Comment::create([
                    'report_id' => $report->id,
                    'user_id' => auth()->user()->id,
                    'tagoperator_id' => auth()->user()->id,
                    'comment' => $request->comment,
                ]);

                if ($comment) {
                    toastr()->success('report sent successfully!', 'Congrats');

                    return back();
                }
            }
        } catch (Exception $error) {
            toastr()->error($error->getMessage(), '0pps!');

            return back();
        }
    }

    public function reportAll()
    {
        return view('report');
    }

    public function reportAllReturn(Request $request)
    {
        $date = $request['date'];
        dd($date);
        $masterStockyesterday = PortStock::whereDate('created_at', '<', Carbon::today())
            ->whereHas('device', function ($query) {
                $query->where('devicetype', 1)->where('status', '0');
            })
            ->count();

        $totalLeaseMasteryesterday = Lease::whereHas('master', function ($query) {
            $query->where('devicetype', 1);
        })
            ->where('tager_id', auth()->user()->id)
            ->whereDate('created_at', '<', Carbon::today())->count();
        $openingMaster = $masterStockyesterday - $totalLeaseMasteryesterday;

        // dd($openingMaster);

        $totalLeaseSlaveyesterday = Lease::whereHas('devices', function ($query) {
            $query->where('devicetype', 2);
        })
            ->where('tager_id', auth()->user()->id)
            ->whereDate('created_at', '<', Carbon::today())->count();

        $slaveStockyesterday = PortStock::whereDate('created_at', '<', Carbon::today())
            ->whereHas('device', function ($query) {
                $query->where('devicetype', 2)->where('status', 0);
            })
            ->count();
        // dd($slaveStockyesterday);

        $openingSlave = $slaveStockyesterday - $totalLeaseSlaveyesterday;

        $today = now()->format('Y-m-d'); // Get the current date in 'Y-m-d' format

        $receivedMaster = Dispatch::whereHas('requisition', function ($query) use ($today) {
            $query->where('request_id', auth()->user()->id)->whereDate('created_at', $today);
        })->whereHas('device', function ($query) {
            $query->where('devicetype', 1);
        })->count();

        $receivedSlave = Dispatch::whereHas('requisition', function ($query) use ($today) {
            $query->where('request_id', auth()->user()->id)->whereDate('created_at', $today);
        })->whereHas('device', function ($query) {
            $query->where('devicetype', 2);
        })->count();

        $leaseCashMaster = Lease::whereHas('master', function ($query) {
            $query->where('devicetype', 1);
        })
            ->where('tager_id', auth()->user()->id)->where('lease_type', 1)
            ->whereDate('created_at', Carbon::today())->count();

        $leaseCashSlave = Lease::where('tager_id', auth()->user()->id)
            ->where('lease_type', 1)
            ->whereDate('created_at', Carbon::today())
            ->whereHas('devices', function ($query) {
                $query->where('devicetype', 2);
            })
            ->withCount('devices')
            ->count();

        // dd($leaseCashSlave);
        $leaseBillMaster = Lease::whereHas('master', function ($query) {
            $query->where('devicetype', 1);
        })
            ->where('tager_id', auth()->user()->id)->where('lease_type', 2)
            ->whereDate('created_at', Carbon::today())->count();

        $leaseBillSlave = Lease::where('tager_id', auth()->user()->id)
            ->where('lease_type', 2)
            ->whereDate('created_at', Carbon::today())
            ->whereHas('devices', function ($query) {
                $query->where('devicetype', 2);
            })
            ->withCount('devices')
            ->count();

        $totalLeaseMaster = Lease::whereHas('master', function ($query) {
            $query->where('devicetype', 2);
        })
            ->where('tager_id', auth()->user()->id)
            ->whereDate('created_at', Carbon::today())->count();

        $totalLeaseSlave = Lease::whereHas('devices', function ($query) {
            $query->where('devicetype', 2);
        })
            ->where('tager_id', auth()->user()->id)
            ->whereDate('created_at', Carbon::today())->count();

        $closingMaster = PortStock::whereDate('created_at', Carbon::today())
            ->whereHas('device', function ($query) {
                $query->where('devicetype', 1)->where('status', 0);
            })
            ->count();

        $closingSlave = PortStock::whereDate('created_at', '<', Carbon::today())
            ->whereHas('device', function ($query) {
                $query->where('devicetype', 2)->where('status', 0);
            })
            ->count();

        $totalleaseMaster = Lease::where('tager_id', auth()->user()->id)
            ->whereDate('created_at', Carbon::today())->count();

        $leases = Lease::with('devices')
            ->where('tager_id', auth()->user()->id)
            ->whereDate('created_at', Carbon::today())
            ->get();

        // dd($leases);

        $totalSlaveCount = 0;
        foreach ($leases as $lease) {
            $totalSlaveCount += $lease->devices->count();
        }

        $coment = Comment::whereDate('created_at', Carbon::today())->count();
        $mycomment = Comment::whereDate('created_at', Carbon::today())
            ->where('user_id', auth()->user()->id)->first();
        // dd($coment);

        $returnedDeviceMaster = PortStock::where('user_id', auth()->user()->id)
            ->where('device_id', 1)
            ->where('status', 2)->whereDate('created_at', Carbon::today())->count();

        dd($returnedDeviceMaster);
        $returnedDeviceSlave = PortStock::where('user_id', auth()->user()->id)
            ->where('device_id', 2)
            ->where('status', 2)->whereDate('created_at', Carbon::today())->count();

        return view('dashboard.port', [
            'openingMaster' => $openingMaster,
            'openingSlave' => $openingSlave,
            'date' => Carbon::today(),
            'receivedMaster' => $receivedMaster,
            'receivedSlave' => $receivedSlave,
            'leaseCashMaster' => $leaseCashMaster,
            'leaseCashSlave' => $leaseCashSlave,
            'leaseBillMaster' => $leaseBillMaster,
            'leaseBillSlave' => $leaseBillSlave,
            'totalLeaseMaster' => $totalLeaseMaster,
            'totalLeaseSlave' => $totalLeaseSlave,
            'closingMaster' => $openingMaster - $totalleaseMaster + $receivedMaster - $returnedDeviceMaster,
            'closingSlave' => $openingSlave - $totalSlaveCount + $receivedSlave - $returnedDeviceSlave,
            'coment' => $coment,
            'mycomment' => $mycomment,

        ]);
    }
}
