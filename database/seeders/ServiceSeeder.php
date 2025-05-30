<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            ['name' => 'Paaralan', 'remarks' => 'Oo'],
            ['name' => 'Hospital', 'remarks' => 'Oo'],
            ['name' => 'L.A.N.I. Cares', 'remarks' => 'Oo'],
            ['name' => 'Barangay health center', 'remarks' => 'Oo'],
            ['name' => 'Others', 'remarks' => 'Oo'],
            ['name' => 'Kawalan ng pera', 'remarks' => 'Hindi'],
            ['name' => 'Kawalan ng trabaho', 'remarks' => 'Hindi'],
            ['name' => 'Kawalan ng oras', 'remarks' => 'Hindi'],
            ['name' => 'Other', 'remarks' => 'Hindi'],
        ];

        foreach($services as $s)
        {
            Service::firstOrCreate($s);
        }
    }
}
