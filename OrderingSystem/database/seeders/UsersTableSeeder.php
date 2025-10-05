<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        // Staff account
        User::firstOrCreate(
            ['email' => 'Staff@gmail.com'],
            [
                'name' => 'Staff',
                'password' => bcrypt('password123'),
                'role' => 'staff',
            ]
        );

        // Manager account
        User::firstOrCreate(
            ['email' => 'Manager@gmail.com'],
            [
                'name' => 'Manager',
                'password' => bcrypt('password123'),
                'role' => 'manager',
            ]
        );
    }
}
