<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

public function run(): void
{
     Order::create([
            'user_id' => 1, // make sure this user exists in users table
            'status' => 'pending',
            ]);
}

}
