<?php

namespace Database\Seeders;

use App\Models\Requirement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RequirementSeeder extends Seeder
{
    public function run(): void
    {
        $requirements = [
            'Developmental / Psychological Assessment (photocopy)',
            'Audiometry (photocopy)',
            'PSA Birth Certificate (photocopy)',
            'PWD ID (front)',
            'PWD ID (back)',
            'Barangay Certificate of Parent (photocopy)',
            '1×1 ID Photo (Parent)',
            '1×1 ID Photo (Child)',
            'Report Card (if enrolled in any public or private school)'
        ];
        
        foreach($requirements as $r) {
            Requirement::firstOrCreate(
                ['name' => $r],
                [
                    'name' => $r,
                    'remarks' => 'seeder generated'
                ]
            );
        }
    }
}