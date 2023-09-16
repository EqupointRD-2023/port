<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class test extends Controller
{
    public function test(Request $request)
    {
        return view('device.index');
    }



    public function users(Request $request)
    {
        return view('user.index');
    }
}
