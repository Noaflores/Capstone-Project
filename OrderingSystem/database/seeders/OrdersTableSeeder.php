<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\User;

class OrdersTableSeeder extends Seeder
{
    public function run(): void
    {
        // Get the first user from the database
        $user = User::first();

        // Check if a user exists
        if (!$user) {
            $this->command->warn('No users found! Please run UsersTableSeeder first.');
            return;
        }

        // 🧾 Order 1 - Pending
        Order::create([
            'user_id' => $user->id,
            'total'   => 850.00,
            'status'  => 'pending',
        ]);

        // 🧾 Order 2 - Pending
        Order::create([
            'user_id' => $user->id,
            'total'   => 250.00,
            'status'  => 'pending',
        ]);
    }
}
