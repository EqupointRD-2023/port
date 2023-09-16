<?php

namespace App\Http\Livewire\Roles;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Permissions extends Component
{
    public $name;
    public function render()
    {
        $permissions = Permission::all();;
        return view('livewire.roles.permissions', [
            'permissions' => $permissions
        ]);
    }

    public function store()
    {
        dd('fail');
        $this->validate([
            'name' => 'required'
        ]);
        $permission = Permission::create(['name' => $this->name]);
        if ($permission) {
        }
    }
}
