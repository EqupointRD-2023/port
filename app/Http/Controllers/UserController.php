<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'role' => 'required',
        ]);

        try {
            $user = new User();

            $user->name                     = $request->input('name');
            $user->email                    = $request->input('email');
            $user->password                 = Hash::make($request->input('password'));
            $user->team_id                  = $request->input('team_id');
            $user->depertment_id            = $request->input('department_id');
            $user->location_id                = $request->input('location_id');
            $user->sex                   = $request->input('sex');
            $user->phone                = $request->input('phone');
            $user->position                 = $request->input('position');
            $user->created_by               = Auth::user()->id;
            // $user->created_date             = Carbon::now()->toDateTimeString();
            $user->assignRole($request->input('role'));
            $user->save();
            toastr()->success('Data has been saved successfully!', 'Successfully');
            return back();
        } catch (Exception $error) {
            toastr()->error($error, 'Error');
            return back();
        }
    }
}
