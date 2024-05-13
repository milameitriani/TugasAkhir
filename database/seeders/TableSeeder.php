<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Table;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Table $table)
    {
        for ($i=0; $i < 10; $i++) { 
            $table::create([
                'no' => $i+1
            ]);
        }
    }
}
