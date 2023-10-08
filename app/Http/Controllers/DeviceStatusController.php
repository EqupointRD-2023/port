<?php

namespace App\Http\Controllers;

use App\Models\DeviceStatus;
use Exception;
use Illuminate\Http\Request;
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
        $token = DeviceStatus::select('token_access')->first();
        $serialNumber = $id;
        // return  $serialNumber;
        try {
            $url = 'https://taxpayerportal.tra.go.tz/ects-vendor-service/DeviceData?SerialNumber='.$serialNumber;
            $response = Http::withHeaders([
                'Accept' => 'application/json, text/plain, */*',
                'Accept-Language' => 'en-US,en;q=0.9',
                'Authorization' => 'Bearer eyJhbGciOiJSUzI1NiIsImtpZCI6IjdFNTlDMUM5NjNFQjE1QzZCMjFFNEExRjIzMUY3QTA0REUzQjU0MjdSUzI1NiIsInR5cCI6IkpXVCIsIng1dCI6ImZsbkJ5V1ByRmNheUhrb2ZJeDk2Qk40N1ZDYyJ9.eyJuYmYiOjE2OTY1ODE5OTEsImV4cCI6MTY5NjU4MjQ3MSwiaXNzIjoiaHR0cHM6Ly9pZGVudGl0eS50cmEuZ28udHoiLCJhdWQiOiJUYXhwYXllclBvcnRhbCIsImlhdCI6MTY5NjU4MTk5MSwiYXRfaGFzaCI6IndzeEdLdUZONDh4ZWFtb014R1N6bmciLCJzX2hhc2giOiI4Qm05M2tybV9RSGZGLTNBdlFNM0F3Iiwic2lkIjoiQjMwMTE1QTlBRjcxMEI1MUIyMUY0Rjg4QzVCMTcyRUIiLCJzdWIiOiIxMjAxNDQ0NzIiLCJhdXRoX3RpbWUiOjE2OTY1ODE5NTYsImlkcCI6ImxvY2FsIiwicHJlZmVycmVkX3VzZXJuYW1lIjoiMTIwMTQ0NDcyIiwidW5pcXVlX25hbWUiOiIxMjAxNDQ0NzIiLCJpc2J1c2luZXNzIjoiRmFsc2UiLCJ0aW4iOiIxMjAxNDQ0NzIiLCJuaW4iOiIxOTg5MDkyNjEyMTA3MDAwMDIyOSIsInVzZXJpZCI6IjEyMDE0NDQ3MiIsInVzZXJuYW1lIjoiMTIwMTQ0NDcyIiwibmFtZSI6IjEyMDE0NDQ3MiIsImZ1bGxfbmFtZSI6IlJJQ0FOTkEgT01BUlkgQ0hJS1dFS1dFIiwiZW50aXR5X3RpbiI6IiIsImZpcnN0X2xvZ2luIjoiRmFsc2UiLCJlbWFpbCI6IiIsImVtYWlsX3ZlcmlmaWVkIjpmYWxzZSwicGhvbmVfbnVtYmVyIjoiMDY1Njg4Mzg4OCIsInBob25lX251bWJlcl92ZXJpZmllZCI6dHJ1ZSwiYW1yIjpbInB3ZCJdfQ.p0LaIvoR0E0hlOl3U81iteX4WHLarOY8FcrbN-2iRgtyHWpiVW4C8OH20-Nn3DnNaAhdiRAI9JW-dz-9Gkb9S_O0ewxlnqidDxpDDWcM2ZSewyS8rTv_afF1rnLLivYZWkuND7CVny9VV8dpCkoMAKOE7lkYHgq1BAHeMJmLr8EaaWY8Z6UbWdxJbF4H0R1uqz86BuDC4b9ZUq1FLQIKiFxH3Ry7PvNKxuttSKOy-B1pSKW_y9mrVAJ0UIAiZcGqrq5on6UtpFX51mwRm7SHfqlcChkqZ3cIkBOgWKd8H6nzVn689Syz1JoEH7cNZvOjrd6Xmc3ApGSFvlEKcdNtow', // Use the token directly
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
