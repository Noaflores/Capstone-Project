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
    ['item_id' => 'IID1001', 'name' => 'Coffee', 'description' => 'Hot brewed coffee', 'price' => 200],
    ['item_id' => 'IID1002', 'name' => 'Veggie Salad', 'description' => 'Fresh garden salad', 'price' => 120],
    ['item_id' => 'IID1003', 'name' => 'Pizza', 'description' => 'Cheesy oven-baked pizza', 'price' => 450],
    ['item_id' => 'IID1004', 'name' => 'Mango Shake', 'description' => 'Refreshing mango shake', 'price' => 280],
    ['item_id' => 'IID1005', 'name' => 'Chocolate Cake', 'description' => 'Rich chocolate cake', 'price' => 210],
]);

    }
}
