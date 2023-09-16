<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreatePermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
       $permissions = [
            'approve requisition',
            'approve transfer device',
            'approve return device',
            'approve user',
            'register user',
            'update user ',
            'register customer',
            'update customer',
            'disable enable user',
            'register device',
            'issuing device',
            'received issuing device',
            'received return device',
            'view leasing ',
            'acknowledge sales',
            'view device rotation',
            'edit receipt',
            'untag device',
            'return device port',
            'return device border',
            'leasing device',
            'edit Leasing',
            'cancel Leasing',
            'refer Leasing',
            'tech received device',
            'tech return device',
            'receive unknow device',
            'customer orders',
            'customer list',
            'customer vehicles',
            'create customer',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'permission-list',
            'permission-create',
            'permission-edit',
            'permission-delete'

        ];


        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }

        $role = Role::create(['name' => 'Super Admin']);
        $role->givePermissionTo(Permission::all());
    }
}
