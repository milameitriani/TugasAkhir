<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(User $user)
    {
        $user->create([
            "name" => "Pelanggan 1",
            "password" => "password",
            "email_verified_at" => now()
        ]);

        $user->create([
            "name" => "Pelanggan 2",
            "password" => "password",
            "email_verified_at" => now()
        ]);
    }
}
