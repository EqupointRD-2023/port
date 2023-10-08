<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Dispatch;
use App\Models\PortStock;
use App\Models\PortStock_masters;
use App\Models\PortStock_slaves;
use App\Models\requisitions;
use App\Models\ReturnMasterPort;
use App\Models\ReturnSlavePort;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $deviceX = PortStock_masters::with('device')->where('user_id', auth()->user()->id)->where('status', 0)->get();
        $deviceX = PortStock_masters::with('device', 'dispatch_slave.device')
            ->where('user_id', auth()->user()->id)->where('status', 0)->get();

        $countSlaveHb = PortStock_slaves::whereHas('dispatch_master', function ($query) {
            $query->where('user_id', auth()->user()->id)
                ->where('status', 0);
        })->whereHas('device', function ($subquery) {
            $subquery->where('devicebrand', 1);
        })->count();

        $countSlaveJt = PortStock_slaves::whereHas('dispatch_master', function ($query) {
            $query->where('user_id', auth()->user()->id)
                ->where('status', 0);
        })->whereHas('device', function ($subquery) {
            $subquery->where('devicebrand', 2);
        })->count();

        // dd($countSlaveJt);
        $receive_date = requisitions::with('dispatch.device')->where('request_id', auth()->user()->id)->get();
        $masterHb = 0;
        $masterJt = 0;
        $slaveHb = 0;
        $slaveJt = 0;
        if (count($receive_date) === 0) {
        } else {

            $date = $receive_date[0]->dispatch;

            foreach ($deviceX as $portStock) {
                $devices = $portStock->device->where('devicetype', 1)->where('devicebrand', 1);
                $uniqueDevices = $devices->unique('id');
                // Increment the count with the number of devices that meet both conditions
                $masterHb += $uniqueDevices->count();
            }

            foreach ($deviceX as $portStock) {
                $masterJt += $portStock->device->where('devicetype', 1)->where('devicebrand', 2)->count();
            }

            // dd($masterJt);
            return view('stock.index', [
                'deviceX' => $deviceX,
                'date' => $date,
                'masterHb' => $masterHb,
                'masterJt' => $masterJt,
                'slaveHb' => $countSlaveHb,
                'slaveJt' => $countSlaveJt,
            ]);
        }

        return view('stock.index', [
            'deviceX' => $deviceX,
            'date' => null,
            'masterHb' => $masterHb,
            'masterJt' => $masterJt,
            'slaveHb' => $slaveHb,
            'slaveJt' => $slaveJt,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, $id)
    {
        // $devices = Dispatch::where('dispatchNo', $id)->get();
        // dd($request['device_check']);
        $startDate = date('Ymd');
        $randomNumber = rand(1000, 9999);
        $returnDeviceNo = 'RN'.$startDate.$randomNumber;
        try {
            foreach ($request['device_check'] as $device) {
                $deviceX = Device::where('deviceNumber', $device)->first();
                // dd($deviceX->id);
                $return = PortStock_masters::with('dispatch_slave.device')->where('master_id', $deviceX->id)->first();
                // dd($this->deviceId);
                $return->update([
                    'status' => 2,
                    'status_updated_at' => Carbon::today(),
                ]);
                // $deviceX->update([
                //     'status' => 3,
                // ]);

                // $dataToInsert = [
                //     'return_number' => $returnDeviceNo, // Replace with your returned_number value
                //     'return_user_id' => auth()->user()->id, // Replace with your return_user_id value
                //     'master_id' => $deviceX->id, // Replace with your device_id value
                // ];
                // Insert the data into the table
                // $master = DB::table('return_master_ports')->insert($dataToInsert);
                $master = ReturnMasterPort::create([
                    'return_number' => $returnDeviceNo, // Replace with your returned_number value
                    'return_user_id' => auth()->user()->id, // Replace with your return_user_id value
                    'master_id' => $deviceX->id,
                ]);
                foreach ($return->dispatch_slave as $slave) {
                    ReturnSlavePort::create([
                        'master_id' => $master->id, // Replace with your returned_number value
                        'slave_id' => $slave->id,
                    ]);
                }
            }
            toastr()->success('Device returned successfully!', 'Congrats');

            return back();
        } catch (Exception $error) {
            toastr()->error($error->getMessage(), '0pps!');

            return back();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request['master_id']);

        try {
            foreach ($request['slaves'] as $slave) {
                $slavedata = PortStock_slaves::where('slave_id', $slave)->update([
                    'port_master_id' => $request['master_id'],
                ]);
            }
            toastr()->success('Device added successfully!', 'Congrats');

            return back();
        } catch (Exception $error) {
            toastr()->error($error->getMessage(), '0pps!');

            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
