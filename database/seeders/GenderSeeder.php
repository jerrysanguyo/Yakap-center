<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Gender;

class GenderSeeder extends Seeder
{
    public function run(): void
    {
        $genders = [
            'male', 
            'female'
        ];

        foreach($genders as $g)
        {
            Gender::firstOrCreate([
                'name' => $g, 
                'remarks' => 'seeder generated'
            ]);
        }
    }
}
