<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Setting $setting)
    {
        $setting->create([
            'name' => 'My Panic',
            'address' => 'Jln Kedungwuluh KM 7, Banjarnegara',
            'phone' => '082736188923'
        ]);
    }
}
