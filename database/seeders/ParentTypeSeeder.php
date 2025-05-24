<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ParentType;

class ParentTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            'Father',
            'Mother',
            'Guardian',
            'Grandparent',
            'Brother',
            'Sister',
            'Auntie',
            'Uncle',
        ];

        foreach($types as $type)
        {
            ParentType::firstOrcreate(
            [   
                'name' => $type 
            ],
            [
                'name' => $type,
                'remarks' => 'Seeder generated',
            ]);
        }
    }
}
