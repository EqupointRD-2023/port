<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Dispatch;
use App\Models\PortStock;
use App\Models\requisitions;
use App\Models\ReturnedFromPort;
use Exception;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deviceX = PortStock::with('device')->where('user_id', auth()->user()->id)->where('status', 0)->get();
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

            foreach ($deviceX as $portStock) {
                $devices = $portStock->device->where('devicetype', 2)->where('devicebrand', 1);
                $uniqueDevices = $devices->unique('id');
                // Increment the count with the number of devices that meet both conditions
                $slaveHb += $uniqueDevices->count();
            }

            foreach ($deviceX as $portStock) {
                $slaveJt += $portStock->device->where('devicetype', 2)->where('devicebrand', 2)->count();
            }

            // dd($masterJt);
            return view('stock.index', [
                'deviceX' => $deviceX,
                'date' => $date,
                'masterHb' => $masterHb,
                'masterJt' => $masterJt,
                'slaveHb' => $slaveHb,
                'slaveJt' => $slaveJt,
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
        try {
            foreach ($request['device_check'] as $device) {
                // dd($device->deviceId);
                $deviceX = Device::where('deviceNumber', $device)->first();
                $return = PortStock::where('device_id', $deviceX->id)->first();
                // dd($this->deviceId);
                $return->update([
                    'status' => 2,
                ]);
                $deviceX->update([
                    'status' => 3,
                ]);
                // ReturnedFromPort::create([
                //     'user_id' => auth()->user()->id,
                //     'device_id' => $device,
                // ]);

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
        //
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
