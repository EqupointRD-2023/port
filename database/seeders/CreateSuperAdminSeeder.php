<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class CreateSuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $user = User::create([
            'name' => 'EMS SuperAdmin',
            'email' => 'admin@ems.com',
            'password' => bcrypt('admin123'),
        ]);

        $user->assignRole('Super Admin');
    }
}
