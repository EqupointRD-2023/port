<?php

namespace App\Http\Controllers;

use App\Jobs\ReturnedFromPort as JobsReturnedFromPort;
use App\Models\Device;
use App\Models\Dispatch;
use App\Models\requisitions;
use App\Models\ReturnedFromPort;
use Exception;
use Illuminate\Http\Request;

class ReturnedFromPortController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ReturnedFromPort::with('user', 'dispatch')->get()->unique('dispatch_id');
        // dd($data);
        return view('stock.returned_from_port', [
            'dispatch' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $dispatch = Dispatch::with('device')->where('dispatchNo', $id)->get();

        try {
            foreach ($dispatch as $dispatch) {
                // dd($dispatch->id);
                $disId = ReturnedFromPort::where('id', $dispatch->id)->get();
                foreach ($disId as $dis) {
                    // dd($dis);
                    $dis->update([
                        'status' => 1
                    ]);
                }
                $device = Device::find($dispatch->id);
                $device->update([
                    'status' => 0
                ]);
                Dispatch(new JobsReturnedFromPort($dispatch->device[0]['id']));
            }
            toastr()->success('Device Received successfully');
            return back();
        } catch (Exception $e) {
            toastr()->error($e->getMessage());
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
