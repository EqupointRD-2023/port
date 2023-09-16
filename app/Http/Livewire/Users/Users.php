<?php

namespace App\Http\Livewire\Users;

use App\Models\Department;
use App\Models\Team;
use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Users extends Component
{
    public function render()
    {
        $users = User::all();
        $depat = Department::all();
        $teamlist = Team::all();
        $roles = Role::all();
        return view('livewire.users.users', [
            'users' => $users,
            'depat' => $depat,
            'teamlist' => $teamlist,
            'teamlist' => $teamlist,
            'roles' => $roles
        ]);
    }
}
