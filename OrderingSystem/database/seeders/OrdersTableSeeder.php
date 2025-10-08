<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 🧾 Order 1 - Pending
        Order::create([
            'user_id' => 1,
            'status' => 'pending',
        ]);

        // 🧾 Order 2 - Pending
        Order::create([
            'user_id' => 1,
            'status' => 'pending',
        ]);

        // 🧾 Order 3 - In Progress
        Order::create([
            'user_id' => 1,
            'status' => 'in progress',
        ]);
    }
}
