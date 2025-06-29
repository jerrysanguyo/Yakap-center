<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $superAdminRole = Role::firstOrCreate(['name' => 'superadmin']);
        
        $admin = User::firstOrCreate(
            ['email' => 'superadmin@gmail.com'],
            [
                'first_name' => 'Super',
                'middle_name' => '',
                'last_name' => 'Admin',
                'email' => 'superadmin@gmail.com',
                'contact_number' => '09271852711',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => \Str::random(10),
            ]
        );
        
        $admin->assignRole($superAdminRole);
    }
}
