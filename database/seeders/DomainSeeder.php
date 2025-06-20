<?php

namespace Database\Seeders;

use App\Models\LearningDomain;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DomainSeeder extends Seeder
{
    public function run(): void
    {
        $domains = [
            'Literacy',
            'Numeracy',
            'Fine motor',
            'Social skills',
        ];

        foreach($domains as $d)
        {
            LearningDomain::firstOrCreate([
                'name' => $d,
                'remarks' => 'seeder generated'
            ]);
        }
    }
}
