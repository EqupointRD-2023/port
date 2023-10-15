<?php

namespace App\Http\Controllers;

use App\Models\DeviceStatus;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class DeviceStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd('oo');
        return view('stock.status');
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        // dd($id);
        $token = DB::table('tokens')
            ->select('token_access')
            ->first();
        $serialNumber = $id;
        // return  $serialNumber;
        try {
            $url = 'https://taxpayerportal.tra.go.tz/ects-vendor-service/DeviceData?SerialNumber='.$serialNumber;
            $response = Http::withHeaders([
                'Accept' => 'application/json, text/plain, */*',
                'Accept-Language' => 'en-US,en;q=0.9',
                'Authorization' => 'Bearer'.$token, // Use the token directly
                'userToken' => 'eyJUaW4iOiIxMjAxNDQ0NzIiLCJFbnRpdHlUaW4iOiIxMjA5NjM4MjEifQ==',
                'entitytin' => '120963821',
                'Connection' => 'keep-alive',
                'Cookie' => '_redirectUrl=https://taxpayerportal.tra.go.tz/#/ects/device-status',
                'Referer' => 'https://taxpayerportal.tra.go.tz/#/ects/device-status',
            ])->get($url);
            // dd($response->json());
            // return $response;

            return view('stock.status', [
                'data' => $response->json(),
            ]);
        } catch (Exception $error) {
            toastr()->error($error->getMessage(), '0pps!');

            return back();
        }

        // return $response->json();

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DeviceStatus $deviceStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DeviceStatus $deviceStatus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeviceStatus $deviceStatus)
    {
        //
    }
}
