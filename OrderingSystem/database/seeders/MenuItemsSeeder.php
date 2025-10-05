<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       DB::table('menu_items')->insert([
    ['item_id' => 'I001', 'name' => 'Coffee', 'description' => 'Hot brewed coffee', 'price' => 200],
    ['item_id' => 'I002', 'name' => 'Pizza', 'description' => 'Cheesy oven-baked pizza', 'price' => 450],
    ['item_id' => 'I003', 'name' => 'Pasta', 'description' => 'Italian pasta dish', 'price' => 200],
    ['item_id' => 'I004', 'name' => 'Mango Shake', 'description' => 'Refreshing mango shake', 'price' => 280],
    ['item_id' => 'I005', 'name' => 'Chocolate Cake', 'description' => 'Rich chocolate cake', 'price' => 210],
]);

    }
}
