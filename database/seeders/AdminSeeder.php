<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Admin $admin)
    {
        $admin->create([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => 'password'
        ]);
        $admin->create([
            'name' => 'Koki',
            'username' => 'koki',
            'role' => 'koki',
            'password' => 'password'
        ]);
        $admin->create([
            'name' => 'Pelayanan',
            'username' => 'pelayanan',
            'role' => 'pelayanan',
            'password' => 'password'
        ]);
        $admin->create([
            'name' => 'Kasir',
            'username' => 'kasir',
            'role' => 'kasir',
            'password' => 'password'
        ]);
        $admin->create([
            'name' => 'Bar',
            'username' => 'bar',
            'role' => 'bar',
            'password' => 'password'
        ]);
    }
}
