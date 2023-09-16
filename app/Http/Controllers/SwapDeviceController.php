<?php

namespace App\Http\Controllers;

use App\Models\Lease;
use App\Models\PortStock;
use App\Models\SwapDevice;
use Exception;
use Illuminate\Http\Request;

class SwapDeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        // dd($id);

        $devices = PortStock::with('device')->where('user_id', auth()->user()->id)->get();
        $leases = Lease::with('master', 'devices')->where('lease_number', $id)->where('tager_id', auth()->user()->id)->first();
        $all = Lease::with('master', 'devices')->where('lease_number', $id)->where('tager_id', auth()->user()->id)->get();
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
    public function storeee(Request $request)
    {
        // dd($request);
        // $lease = Lease::where('lease_number', $request->lease_number)->first();
        $slave = $request->input('slave_old');
        $slave_new = $request->input('slave');

        try {
            foreach ($slave as $dt) {
                // dd($dt);
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
                    // dd($dt_new);
                    if ($dt_new != null) {
                        $update = $lease->update([
                            'master_id' => $request->master ?? $lease->master_id,
                            // 'slave_id' => (int)$dt_new ?? $lease->slave_id,
                        ]);

                        $lease->devices()->sync([$request['slave']]);
                        // if ($update) {
                        //     foreach($request['slave'] as )
                        //     SwapDevice::create([
                        //         'lease_number' => $lease->id,
                        //         'master_id' => $lease->master_id,
                        //         'master_new_id' => $request->master,
                        //         'slave_id' => $lease->slave_id,
                        //         'slave_new_id' => null,
                        //     ]);
                        // }
                    } else {
                        // dd($request['slave_id']);
                        $update = $lease->update([
                            'master_id' => $request->master ?? $lease->master_id,
                        ]);
                        // dd($update);
                        if ($update && $request['slave_id'] == null) {
                            SwapDevice::create([
                                'lease_number' => $lease->id,
                                'master_id' => $lease->master_id,
                                'master_new_id' => $request->master,
                                'slave_id' => NULL,
                                'slave_new_id' => NULL,
                            ]);
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

    public function store(Request $request)
    {
        // $lease = Lease::where('lease_number', $request->lease_number)->first();
        $slave = $request->input('slave_old');
        $slave_new = $request->input('slave');

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

                    if ((int)$dt_new == 0) {
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
                        $update = $lease->update([
                            'master_id' => $request->master ?? $lease->master_id,
                            'slave_id' => (int)$dt_new,
                        ]);
                        if ($update) {
                            SwapDevice::create([
                                'lease_number' => $lease->id,
                                'master_id' => $lease->master_id,
                                'master_new_id' => $request->master,
                                'slave_id' => $lease->slave_id,
                                'slave_new_id' => (int)$dt_new,
                            ]);
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
}
