<?php

namespace Database\Seeders;

use App\Models\Education;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EducationSeeder extends Seeder
{
    public function run(): void
    {
        $educations = [
            'Bachelor\'s Degree',
            'Master\'s Degree',
            'Doctorate Degree',
            'Secondary Education',
            'Primary Education',
            'No educational Attainment',
        ];
        
        foreach ($educations as $e)
        {
            Education::firstOrCreate([
                'name' => $e,
                'remarks' => 'seeder generated',
            ]);
        }
    }
}
