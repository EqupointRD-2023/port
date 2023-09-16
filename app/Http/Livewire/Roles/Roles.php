<?php

namespace App\Http\Livewire\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class Roles extends Component
{
    public function render()
    {
        $roles = Role::with('permissions')->get();
        return view('livewire.roles.roles', [
            'roles' => $roles
        ]);
    }
}
