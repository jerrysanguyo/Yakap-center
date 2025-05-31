<?php

namespace Database\Seeders;

use App\Models\CivilStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CivilStatusSeeder extends Seeder
{
    public function run(): void
    {
        $civilStatuses = [
            ['name' => 'Single', 'remarks' => 'seeder generated'],
            ['name' => 'Married', 'remarks' => 'seeder generated'],
            ['name' => 'Widowed', 'remarks' => 'seeder generated'],
            ['name' => 'Divorced', 'remarks' => 'seeder generated'],
            ['name' => 'Separated', 'remarks' => 'seeder generated'],
        ];
        foreach($civilStatuses as $s)
        {
            CivilStatus::firstOrCreate(
                ['name' => $s['name']],
                ['remarks' => $s['remarks']]
            );
        }
    }
}
