<?php

namespace App\Http\Livewire\Users;

use App\Models\Department as ModelsDepartment;
use Livewire\Component;

class Department extends Component
{
    public function render()
    {
        $departments = ModelsDepartment::all();
        return view('livewire.users.department', [
            'departments' => $departments
        ]);
    }
}
