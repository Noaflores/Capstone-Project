<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Clear existing users (except if you have foreign keys depending on users, then use disable FK checks)
        DB::table('users')->truncate();

        User::create([
            'name' => 'Manager',
            'email' => 'Manager@gmail.com',
            'password' => Hash::make('password123'),
            'contact_number' => '09171234567',
        ]);

        User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
            'contact_number' => '09981234567',
        ]);
    }
}
