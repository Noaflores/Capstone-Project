<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Order;
use App\Models\MenuItem;

class OrderItemsTableSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure we have a user
        $user = User::first() ?: User::create([
            'name' => 'Staff',
            'email' => 'staff@example.com',
            'password' => bcrypt('password123'),
            'role' => 'staff',
        ]);

        // Ensure the menu items exist (use fields that actually exist in menu_items)
        $coffee = MenuItem::firstOrCreate(
            ['name' => 'Coffee'],
            ['item_id' => 'IID1001', 'price' => 210.00, 'description' => 'Hot brewed coffee']
        );

        $pizza = MenuItem::firstOrCreate(
            ['name' => 'Pizza'],
            ['item_id' => 'IID1002', 'price' => 450.00, 'description' => 'Cheesy oven-baked pizza']
        );

        $pasta = MenuItem::firstOrCreate(
            ['name' => 'Pasta'],
            ['item_id' => 'IID1003', 'price' => 200.00, 'description' => 'Delicious pasta']
        );

        // Create an order for that user
        $order = Order::create([
            'user_id' => $user->id,
            'status' => 'pending',
            // add other fields if your orders table requires them
        ]);

        // Determine which FK column order_items uses
        $fkColumn = null;
        if (Schema::hasColumn('order_items', 'menu_item_id')) {
            $fkColumn = 'menu_item_id'; // numeric FK -> menu_items.id
        } elseif (Schema::hasColumn('order_items', 'item_id')) {
            $fkColumn = 'item_id'; // string FK -> menu_items.item_id
        } else {
            // fallback - adjust to your schema if different
            $fkColumn = 'menu_item_id';
        }

        // Build rows using the correct FK value depending on column
        $rows = [
            [
                'order_id'   => $order->id,
                $fkColumn    => ($fkColumn === 'menu_item_id' ? $coffee->id : $coffee->item_id),
                'item_name'  => $coffee->name,
                'quantity'   => 2,
                'subtotal'   => $coffee->price * 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id'   => $order->id,
                $fkColumn    => ($fkColumn === 'menu_item_id' ? $pizza->id : $pizza->item_id),
                'item_name'  => $pizza->name,
                'quantity'   => 1,
                'subtotal'   => $pizza->price * 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id'   => $order->id,
                $fkColumn    => ($fkColumn === 'menu_item_id' ? $pasta->id : $pasta->item_id),
                'item_name'  => $pasta->name,
                'quantity'   => 3,
                'subtotal'   => $pasta->price * 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert order items
        DB::table('order_items')->insert($rows);
    }
}
