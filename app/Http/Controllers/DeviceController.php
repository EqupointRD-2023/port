<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function index()
    {
        $cacheKey = 'devices_cache_key';
        $devices = cache()->remember($cacheKey, now()->addHour(), function () {
            $devices = collect();
            Device::query()->chunk(10, function ($chunkDevices) use ($devices) {
                $devices->push($chunkDevices);
            });
            return $devices->flatten();
        });

        return view('device.index', [
            'devices' => $devices,
        ]);
    }



    public function store(Request $request)
    {
        $request->validate([
            'devicenumber' => 'required',

        ]);

        $device = Device::create([
            'Devicenumber' => $request['devicenumber'],
            'devicetype' => $request['devicetype'],
            'devicebrand' => 0,
            'status' => 0,
        ]);

        if ($device) {
            toastr()->success('Data has been saved successfully!', 'Successfully');
            return back();
        } else {
            toastr()->error('Oops! Something went wrong!', 'Error');
            return back();
        }
    }
}
