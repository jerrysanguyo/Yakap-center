<?php

namespace Database\Seeders;

use App\Models\BloodType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BloodSeeder extends Seeder
{
    public function run(): void
    {
        $bloodTypes = [
            ['name' => 'A+', 'remarks' => 'seeder generated'],
            ['name' => 'A-', 'remarks' => 'seeder generated'],
            ['name' => 'B+', 'remarks' => 'seeder generated'],
            ['name' => 'B-', 'remarks' => 'seeder generated'],
            ['name' => 'AB+', 'remarks' => 'seeder generated'],
            ['name' => 'AB-', 'remarks' => 'seeder generated'],
            ['name' => 'O+', 'remarks' => 'seeder generated'],
            ['name' => 'O-', 'remarks' => 'seeder generated'],
        ];

        foreach ($bloodTypes as $type) {
            BloodType::firstOrCreate($type);
        }
    }
}
