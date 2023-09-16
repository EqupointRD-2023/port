<?php

namespace App\Http\Controllers;

use App\Jobs\ReturnDeviceToStock;
use App\Jobs\SendDeviceToPortStock;
use App\Models\Device;
use App\Models\Dispatch;
use App\Models\PortStock;
use App\Models\requisitions;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DispatchController extends Controller
{
    public function index()
    {
        $dispatch = Dispatch::with('user', 'requisition', 'device')
            ->select('dispatchNo', 'dispatcherId', 'requestId', 'dispatchStatus')
            ->get()->unique('dispatchNo');

        // dd($dispatch);
        $requisitions = requisitions::with('user')->whereDate('created_at', Carbon::today())->where('status', 1)->get();
        // dd($dispatch);
        return view('dispatch.index', [
            'dispatch' => $dispatch,
            'requisitions' => $requisitions,

        ]);
    }

    public function show($id)
    {
        $dispatch = Dispatch::with('user', 'requisition.user', 'device')->where('dispatchNo', $id)->get();
        $dispatch_id = Dispatch::with('user', 'requisition.user', 'device')->where('dispatchNo', $id)->get();
        $requisitions = requisitions::where('status', 1)->get();
        // dd($dispatch);
        return view('dispatch.show', [
            'dispatch' => $dispatch,
            'requisitions' => $requisitions,
            'dispatch_id' => $dispatch_id,
        ]);
    }

    public function SearchDevice(Request $request)
    {
        $bill_no = DB::table('requisitions')->count();
        $count = $bill_no + date('s') + 1;
        $dispatchNo = 'DIS'.date('dmys').'00'.$count;

        $deviceIds = explode(',', $request->input('devicenumber'));

        foreach ($deviceIds as $deviceId) {
            // Trim and sanitize the input (optional)
            $deviceId = trim($deviceId);
            // Store the device ID in the database
            $device = Device::where('Devicenumber', $deviceId)->get();
        }
        ($device);
    }

    public function dispatcch(Request $request)
    {
        $bill_no = DB::table('dispatches')->count();
        $count = $bill_no + date('s') + 1;
        $dispatchNo = 'DIS'.date('dmys').'00'.$count;
        $deviceIds = explode(',', $request->input('devicenumber'));
        $deviceCount = count($deviceIds);
        $quantity = requisitions::with('dispatch', 'user')->where('id', $request->requestId)->first();
        // dd($quantity);
        $devices = Device::where('status', 0)->whereIn('Devicenumber', $deviceIds)->get();
        $masterHb = Device::whereIn('Devicenumber', $deviceIds)
            ->where('devicetype', 1)->where('devicebrand', 1)->where('status', 0)->count();

        $masterJt = Device::whereIn('Devicenumber', $deviceIds)
            ->where('devicetype', 1)->where('devicebrand', 2)->where('status', 0)->count();
        $slaveHb = Device::whereIn('Devicenumber', $deviceIds)
            ->where('devicetype', 2)->where('devicebrand', 1)->where('status', 0)->count();
        $slaveJt = Device::whereIn('Devicenumber', $deviceIds)
            ->where('devicetype', 2)->where('devicebrand', 2)->where('status', 0)->count();

        // dd($quantity->dispatch->dispatchNo);
        if ($request->is('dispatch-put')) {
            // dd('');
            try {
                foreach ($devices as $deviceId) {
                    // dd($deviceId);
                    // Trim and sanitize the input (optional)
                    $deviceId = trim($deviceId);
                    // Store the device ID in the database
                    // $device_id = Device::where('Devicenumber', $deviceId)->first();
                    $deviceData = json_decode($deviceId, true);
                    // dd($deviceData['id']);
                    $device = Dispatch::create([
                        'deviceId' => $deviceData['id'],
                        'dispatchNo' => $dispatchNo,
                        'requestId' => $quantity->requisitionNumber,
                        'dispatcherId' => auth()->user()->id,
                    ]);
                    toastr()->success('Device has been Dispatched successfully!', 'Congrats');

                    return redirect()->route('dispatch');
                }
            } catch (Exception $error) {
                toastr()->error('Oops! Something went wrong!', 'Oops!');

                return back();
            }
        } else {
            if ($deviceCount <= $quantity->quantity) {

                // dd($deviceIds);

                return view('dispatch.summary', [
                    'devices' => $devices,
                    'masterHb' => $masterHb,
                    'masterJt' => $masterJt,
                    'slaveHb' => $slaveHb,
                    'slaveJt' => $slaveJt,
                    'requestId' => $quantity->requisitionNumber,
                    'dispatchNumber' => $quantity->dispatch,
                    'user' => $quantity->user,
                    'quantity' => $quantity->quantity,
                ]);
            } else {
                toastr()->error('you have exceed the device quantity!', 'Oops!');

                return back();
            }
        }
    }

    public function summary()
    {
        dd('o');
        $deviceIds = session('deviceIds');
        $requestId = session('requestId');
        $variable3 = session('variable3');
        $bill_no = DB::table('dispatches')->count();
        $count = $bill_no + date('s') + 1;
        $dispatchNo = 'DIS'.date('dmys').'00'.$count;
        // dd($deviceIds);
        $devices = Device::whereIn('Devicenumber', $deviceIds)->get();
        $masterHb = Device::whereIn('Devicenumber', $deviceIds)
            ->where('devicetype', 1)->where('devicebrand', 1)->where('status', 0)->count();

        $masterJt = Device::whereIn('Devicenumber', $deviceIds)
            ->where('devicetype', 1)->where('devicebrand', 2)->where('status', 0)->count();
        $slaveHb = Device::whereIn('Devicenumber', $deviceIds)
            ->where('devicetype', 2)->where('devicebrand', 1)->where('status', 0)->count();
        $slaveJt = Device::whereIn('Devicenumber', $deviceIds)
            ->where('devicetype', 2)->where('devicebrand', 2)->where('status', 0)->count();
        // dd($devices);
        return view('dispatch.summary', [
            'devices' => $devices,
            'masterHb' => $masterHb,
            'masterJt' => $masterJt,
            'slaveHb' => $slaveHb,
            'slaveJt' => $slaveJt,
        ]);
    }

    public function send(Request $request)
    {
        $bill_no = DB::table('dispatches')->count();
        $count = $bill_no + date('s') + 1;
        $dispatchNo = 'DIS'.date('dmys').'00'.$count;
        // dd($request['requestId']);
        try {
            foreach ($request->devices as $deviceId) {
                // Trim and sanitize the input (optional)
                $deviceId = trim($deviceId);
                // Store the device ID in the database
                $device_id = Device::where('Devicenumber', $deviceId)->first();
                // dd($device_id->id);
                $req_id = requisitions::where('requisitionNumber', $request['requestId'])->first();
                // dd($req_id->id);
                $device = Dispatch::create([
                    'deviceId' => $device_id->id,
                    'dispatchNo' => $dispatchNo,
                    'requestId' => $req_id->id,
                    'dispatcherId' => auth()->user()->id,
                ]);

                dispatch(new SendDeviceToPortStock($device_id->id));
            }
            toastr()->success('Data has been Dispatched successfully!', 'Congrats');

            return redirect()->route('dispatch');
        } catch (Exception $error) {
            toastr()->error($error->getMessage(), 'Oops!');

            return redirect()->route('dispatch');
        }
    }

    public function update(Request $request, $id)
    {
        $disp_id = Dispatch::find($id);
        if ($disp_id) {
            $deviceId = Device::where('Devicenumber', $request->devicenumber)->first();
            if ($deviceId) {
                $update = $disp_id->update([
                    'device_id' => $deviceId->id,
                ]);
                if ($update) {
                    toastr()->success('Device has been updated successfully!', 'Congrats');

                    return back();
                }
                toastr()->error('failed to update device', 'failed');

                return back();
            }
            toastr()->error('device does not exist', 'failed');

            return back();
        }
    }

    public function receiveDeviceView()
    {
        $req = requisitions::where('request_id', auth()->user()->id)->where('status', 1)->whereDate('created_at', Carbon::today())->first();
        // dd($req);
        if ($req == null) {
            return view('receiveDevice.index', [
                'dispatch' => null,
                'req' => $req,
                'dispatchDevice' => null,
            ]);
        }
        $dispatch = Dispatch::with('device', 'requisition')->where('requestId', $req->id)->whereDate('created_at', Carbon::today())
            ->get()->unique('dispatchNo');
        $dispatchDevice = Dispatch::withCount('device')
            ->where('requestId', $req->id)
            ->whereDate('created_at', Carbon::today())
            ->count();
        // dd($dispatch);
        return view('receiveDevice.index', [
            'dispatch' => $dispatch,
            'req' => $req,
            'dispatchDevice' => $dispatchDevice,
        ]);
    }

    public function receiveDevice($id)
    {
        $devices = Dispatch::with('device')->where('dispatchNo', $id)->get();
        $disp_id = Dispatch::with('device')->where('dispatchNo', $id)->get();
        // dd($devices[0]['device'][0]['id']);
        try {
            foreach ($devices as $device) {
                // dd($device['device']);
                PortStock::create([
                    'user_id' => auth()->user()->id,
                    'device_id' => $device['device'][0]['id'],
                ]);
                // SendDeviceToPortStock::dispatch($device['device'][0]['id']);
                $update = $device->update([
                    'dispatchStatus' => 1,
                ]);
                dispatch(new ReturnDeviceToStock($device['device'][0]['id']));
            }
            if ($update) {
                toastr()->success('Device received successfully!', 'Congrats');

                return back();
            }
            toastr()->error('something went wrong', 'Oops!');

            return back();
        } catch (Exception $error) {
            toastr()->error($error->getMessage(), 'Oops!');

            return back();
        }
    }
}
