<?php

namespace App\Http\Livewire\Users;

use App\Models\Department;
use App\Models\Team;
use Livewire\Component;
use Spatie\Permission\Models\Permission;

class Teams extends Component
{
    public function render()
    {
        $teams = Team::all();
        $depts = Department::all();
        return view('livewire.users.teams', [
            'teams' => $teams,
            'depts' => $depts,
        ]);
    }
}
