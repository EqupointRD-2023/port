<?php

namespace App\Http\Controllers;

use App\Models\Lease;
use App\Models\PortStock_masters;
use App\Models\PortStock_slaves;
use App\Models\SwapDevice;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SwapDeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        // dd($id);

        $devices = PortStock_masters::with('device', 'dispatch_slave.device')
            ->where('status', 0)->where('user_id', auth()->user()->id)->get();
        $leases = Lease::with('master', 'lease_master2.dispatch_slave.device', 'devices')->where('lease_number', $id)->where('tager_id', auth()->user()->id)->first();
        $all = Lease::with('master', 'devices')->where('lease_number', $id)->where('tager_id', auth()->user()->id)->first();
        // dd($devices);

        return view(
            'lease.swapdevice',
            [
                'devices' => $devices,
                'leases' => $leases,
                'all' => $all,
            ]
        );
    }

    public function index_old($id)
    {
        // dd($id);

        $devices = PortStock_masters::with('device', 'dispatch_slave.device')->where('status', 0)->where('user_id', auth()->user()->id)->get();
        $leases = Lease::with('master', 'lease_master2.dispatch_slave.device', 'devices')->where('lease_number', $id)->where('tager_id', auth()->user()->id)->first();
        $all = Lease::with('master', 'devices')->where('lease_number', $id)->where('tager_id', auth()->user()->id)->first();
        // dd($leases);

        return view(
            'lease.swapdevice',
            [
                'devices' => $devices,
                'leases' => $leases,
                'all' => $all,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            $lease = Lease::with('lease_master.dispatch_slave')
                ->where('lease_number', $request->lease_number)->first();

            // dd($lease);
            PortStock_masters::where('user_id', Auth()->user()->id)
                ->where('master_id', $lease->master_id)
                ->update(['status' => 0]);

            $master_slave = PortStock_masters::with('dispatch_slave')->where('user_id', Auth()->user()->id)
                ->where('master_id', $request['master'])
                ->first();

            $oldSlaveIds = $lease->lease_master2->dispatch_slave->pluck('slave_id')->toArray();
            $newSlaveIds = $master_slave->dispatch_slave->pluck('slave_id')->toArray();

            foreach ($oldSlaveIds as $index => $oldSlaveId) {
                $newSlaveId = $newSlaveIds[$index] ?? null;
                DB::table('lease_slaves')
                    ->where('lease_id', $lease->id)
                    ->where('slave_id', $oldSlaveId)
                    ->update(['slave_id' => $newSlaveId]);
            }

            DB::table('leases')
                ->where('id', $lease->id)
                ->update(['master_id' => $request['master']]);

            // dd($master_slave);

            PortStock_masters::where('user_id', Auth()->user()->id)
                ->where('master_id', $request['master'])
                ->update(['status' => 1]);
            toastr()->success('Swapped Successfully', 'Successfully');

            return back();
        } catch (Exception $error) {
            toastr()->error($error->getMessage(), 'Ooops!');

            return back();
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SwapDevice $swapDevice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SwapDevice $swapDevice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SwapDevice $swapDevice)
    {
        //
    }

    public function store_old(Request $request)
    {
        // $lease = Lease::where('lease_number', $request->lease_number)->first();
        $slave = $request->input('slave_old');
        $slave_new = $request->input('slave');
        // dd($slave_new);
        try {
            foreach ($slave as $dt) {
                $lease = Lease::with(['devices' => function ($query) use ($dt) {
                    // Apply the condition to the devices relationship query
                    $query->where('slave_id', $dt);
                }])
                    ->where('lease_number', $request->lease_number)
                    ->first();

                // dd($lease);
                $slaveold = Lease::with(['devices' => function ($query) use ($dt) {
                    // Apply the condition to the devices relationship query
                    $query->where('slave_id', $dt);
                }])
                    ->where('lease_number', $request->lease_number)
                    ->first();
                foreach ($slave_new as $dt_new) {
                    if ((int) $dt_new == 0) {
                        // dd($request['master']);
                        if ($request['master'] != null) {
                            PortStock_masters::where('user_id', Auth()->user()->id)
                                ->where('master_id', $lease->master_id)
                                ->update(['status' => 0]);
                            PortStock_masters::where('user_id', Auth()->user()->id)
                                ->where('master_id', $request['master'])
                                ->update(['status' => 1]);
                        }
                        $update = $lease->update([
                            'master_id' => $request->master ?? $lease->master_id,
                            // 'slave_id' => (int)$dt_new ?? $lease->slave_id,
                        ]);

                        if ($update) {
                            SwapDevice::create([
                                'lease_number' => $lease->id,
                                'master_id' => $lease->master_id,
                                'master_new_id' => $request->master,
                                'slave_id' => $lease->slave_id,
                                'slave_new_id' => null,
                            ]);

                        }
                    } else {
                        $myslave = PortStock_slaves::where('slave_id', $dt_new)->whereHas('dispatch_master', function ($query) {
                            $query->where('status', 0);
                        })->first();
                        // dd($myslave);
                        $myslave->update([
                            'slave_id' => $dt,
                        ]);

                        if ($request['master'] != null) {
                            DB::table('port_stock_masters')
                                ->where('user_id', Auth()->user()->id)
                                ->where('master_id', $lease->master_id)
                                ->update(['status' => 0]);

                            DB::table('port_stock_masters')
                                ->where('user_id', Auth()->user()->id)
                                ->where('master_id', $request['master'])
                                ->update(['status' => 1]);
                        }
                        $mymaster = PortStock_masters::where('master_id', $lease->master_id)
                            ->whereHas('dispatch_slave', function ($slave) use ($dt) {
                                $slave->where('slave_id', $dt);
                            })
                            ->where('ID', PortStock_masters::where('master_id', $lease->master_id)
                                ->whereHas('dispatch_slave', function ($slave) use ($dt) {
                                    $slave->where('slave_id', $dt);
                                })

                                ->max('ID')) // Filter by the maximum ID
                            ->first(); // Retrieve the entire record

                        // dd($mymaster); // Get the maximum value of the ID column

                        DB::table('port_stock_slaves')
                            ->where('port_master_id', $mymaster->id)
                            ->where('slave_id', $dt)
                            ->update([
                                'slave_id' => $dt_new,
                            ]);

                        $update = $lease->update([
                            'master_id' => $request->master ?? $lease->master_id,
                            'slave_id' => (int) $dt,
                        ]);
                        if ($update) {
                            SwapDevice::create([
                                'lease_number' => $lease->id,
                                'master_id' => $lease->master_id,
                                'master_new_id' => $request->master,
                                'slave_id' => $lease->slave_id,
                                'slave_new_id' => (int) $dt_new,
                            ]);

                            DB::table('lease_slaves')
                                ->where('lease_id', $lease->id)
                                ->where('slave_id', $dt)
                                ->update(['slave_id' => $dt_new]);

                        }
                    }
                }

                toastr()->success('Swapped Successfully', 'Successfully');

                return back();
            }
        } catch (Exception $error) {
            toastr()->error($error->getMessage(), 'Ooops!');

            return back();
        }
    }
}
