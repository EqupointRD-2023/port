<?php

namespace App\Http\Livewire\Device;

use App\Models\Device as ModelsDevice;
use Exception;
use Livewire\Component;

class Device extends Component
{
    public $deviceNumber;
    public $devicetype;
    public $devicebrand;
    public $created_by;
    public $status;




    public function render()
    {
        // Check if the rendered result is already cached
        $cacheKey = 'devices_cache_key';
        $devices = cache()->remember($cacheKey, now()->addHour(), function () {
            $devices = collect();
            ModelsDevice::query()->chunk(10, function ($chunkDevices) use ($devices) {
                $devices->push($chunkDevices);
            });
            return $devices->flatten();
        });

        return view('livewire.device.device', [
            'devices' => $devices,
        ]);
    }





    public function store()
    {

        dd('ok');
        $this->validate([
            'deviceNumber' => 'required',
            'devicetype' => 'required',
        ]);

        try {
            $device = ModelsDevice::create([
                'deviceNumber' => $this->deviceNumber,
                'devicetype' => $this->devicetype,
                'devicebrand' => 2,
                'created_by' => Auth()->user()->id,
                'status' => 1,
            ]);
            if ($device) {
                session()->flash('success', 'Device Created Successfully');
                $this->emit('dataPosted');
                return redirect()->route('device');
            }
        } catch (Exception $error) {
            dd($error);
        }
    }
}
