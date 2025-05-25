<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\District;
use App\Models\Barangay;

class BarangaySeeder extends Seeder
{
    public function run(): void
    {
        $districts = ['1', '2'];
        foreach($districts as $d)
        {
            District::firstOrCreate([
                'name' => $d, 
                'remarks' => 'seeder generated'
            ]);
        }

        $barangays = [
            ['name' => 'Bagumbayan', 'district_id' => 1, 'remarks' => 'seeder generated'],
            ['name' => 'Bambang', 'district_id' => 1, 'remarks' => 'seeder generated'],
            ['name' => 'Calzada', 'district_id' => 1, 'remarks' => 'seeder generated'],
            ['name' => 'Comembo', 'district_id' => 1, 'remarks' => 'seeder generated'],
            ['name' => 'Hagonoy', 'district_id' => 1, 'remarks' => 'seeder generated'],
            ['name' => 'Ibayo-Tipas', 'district_id' => 1, 'remarks' => 'seeder generated'],
            ['name' => 'Ligid-Tipas', 'district_id' => 1, 'remarks' => 'seeder generated'],
            ['name' => 'Lower Bicutan', 'district_id' => 1, 'remarks' => 'seeder generated'],
            ['name' => 'New Lower Bicutan', 'district_id' => 1, 'remarks' => 'seeder generated'],
            ['name' => 'Napindan', 'district_id' => 1, 'remarks' => 'seeder generated'],
            ['name' => 'Palingon', 'district_id' => 1, 'remarks' => 'seeder generated'],
            ['name' => 'Pembo', 'district_id' => 1, 'remarks' => 'seeder generated'],
            ['name' => 'Rizal', 'district_id' => 1, 'remarks' => 'seeder generated'],
            ['name' => 'San Miguel', 'district_id' => 1, 'remarks' => 'seeder generated'],
            ['name' => 'Santa Ana', 'district_id' => 1, 'remarks' => 'seeder generated'],
            ['name' => 'Tuktukan', 'district_id' => 1, 'remarks' => 'seeder generated'],
            ['name' => 'Ususan', 'district_id' => 1, 'remarks' => 'seeder generated'],
            ['name' => 'Cembo ', 'district_id' => 1, 'remarks' => 'seeder generated'],
            ['name' => 'Central Bicutan ', 'district_id' => 2, 'remarks' => 'seeder generated'],
            ['name' => 'Central Signal Village ', 'district_id' => 2, 'remarks' => 'seeder generated'],
            ['name' => 'East Rembo ', 'district_id' => 2, 'remarks' => 'seeder generated'],
            ['name' => 'Fort Bonifacio ', 'district_id' => 2, 'remarks' => 'seeder generated'],
            ['name' => 'Katuparan ', 'district_id' => 2, 'remarks' => 'seeder generated'],
            ['name' => 'Maharlika Village ', 'district_id' => 2, 'remarks' => 'seeder generated'],
            ['name' => 'North Daang Hari ', 'district_id' => 2, 'remarks' => 'seeder generated'],
            ['name' => 'North Signal Village ', 'district_id' => 2, 'remarks' => 'seeder generated'],
            ['name' => 'Pinagsama ', 'district_id' => 2, 'remarks' => 'seeder generated'],
            ['name' => 'Pitogo ', 'district_id' => 2, 'remarks' => 'seeder generated'],
            ['name' => 'Post Proper Northside ', 'district_id' => 2, 'remarks' => 'seeder generated'],
            ['name' => 'Post Proper Southside ', 'district_id' => 2, 'remarks' => 'seeder generated'],
            ['name' => 'South Cembo ', 'district_id' => 2, 'remarks' => 'seeder generated'],
            ['name' => 'South Daang Hari ', 'district_id' => 2, 'remarks' => 'seeder generated'],
            ['name' => 'South Signal Village ', 'district_id' => 2, 'remarks' => 'seeder generated'],
            ['name' => 'Tanyag ', 'district_id' => 2, 'remarks' => 'seeder generated'],
            ['name' => 'Upper Bicutan ', 'district_id' => 2, 'remarks' => 'seeder generated'],
            ['name' => 'West Rembo ', 'district_id' => 2, 'remarks' => 'seeder generated'],
            ['name' => 'Western Bicutan ', 'district_id' => 2, 'remarks' => 'seeder generated'],
        ];

        foreach($barangays as $b)
        {
            Barangay::firstOrCreate([
                'name' => $b['name'],
                'district_id' => $b['district_id'],
                'remarks' => $b['remarks']
            ]);
        }
    }
}
