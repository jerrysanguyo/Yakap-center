<?php

namespace Database\Seeders;

use App\Models\Disability;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DisabilitySeeder extends Seeder
{
    public function run(): void
    {
        $disabilities = [
            ['name' => 'Blindness', 'remarks' => 'Visual impairment'],
            ['name' => 'Deafness', 'remarks' => 'Hearing impairment'],
            ['name' => 'Physical Disability', 'remarks' => 'Mobility impairment'],
            ['name' => 'Intellectual Disability', 'remarks' => 'Cognitive impairment'],
            ['name' => 'Mental Health Condition', 'remarks' => 'Psychological impairment'],
            ['name' => 'Autism Spectrum Disorder', 'remarks' => 'Developmental disorder'],
            ['name' => 'Speech Impairment', 'remarks' => 'Communication disorder'],
        ];

        foreach($disabilities as $disability) 
        {
            Disability::firstOrCreate($disability);
        }
    }
}
