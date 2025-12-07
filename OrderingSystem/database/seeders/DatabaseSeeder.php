<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
   public function run(): void
{
    $this->call([
        UsersTableSeeder::class,
        MenuItemsSeeder::class,
        //OrdersTableSeeder::class,
        OrderItemsSeeder::class, 
    ]);
}


}
