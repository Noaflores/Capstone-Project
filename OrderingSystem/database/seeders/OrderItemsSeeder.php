<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\MenuItem;
use Illuminate\Support\Facades\DB;

class OrderItemsSeeder extends Seeder
{
    public function run(): void
    {
        $orders = Order::all();
        $menuItems = MenuItem::all();

        if ($orders->isEmpty() || $menuItems->isEmpty()) {
            $this->command->warn('No orders or menu items found! Make sure they are seeded first.');
            return;
        }

        foreach ($orders as $order) {
            // Pick a random menu item for this order
            $item = $menuItems->random();

            DB::table('order_items')->insert([
            'order_id'   => $order->order_id,          // numeric
            'item_id'    => $item->item_id,           // string
            'quantity'   => rand(1, 3),
            'price'      => $item->price,             // get price from MenuItem
            'created_at' => now(),
            'updated_at' => now(),
            ]);

        }
    }
}
