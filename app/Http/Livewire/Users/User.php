<?php

namespace App\Http\Livewire\Users;

use App\Models\Department;
use App\Models\Team;
use App\Models\User as ModelsUser;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class User extends Component
{
    public function render()
    {

        $users = ModelsUser::with('team', 'department', 'createdby')->get();
        $depat = Department::all();
        $teamlist = Team::all();
        $roles = Role::all();
        return view('livewire.users.users', [
            'users' => $users,
            'depat' => $depat,
            'teamlist' => $teamlist,
            'teamlist' => $teamlist,
            'roles' => $roles,
        ]);
    }
}
