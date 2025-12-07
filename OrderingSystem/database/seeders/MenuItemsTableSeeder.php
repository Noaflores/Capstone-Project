<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MenuItemsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('menu_items')->delete();
        
        \DB::table('menu_items')->insert(array (
            0 => 
            array (
                'item_id' => 'IID1001',
                'name' => 'Coffee',
                'description' => 'Passionately hot brewed coffee!',
                'image' => NULL,
                'price' => 200,
                'created_at' => NULL,
                'updated_at' => '2025-12-04 13:48:12',
            ),
            1 => 
            array (
                'item_id' => 'IID1002',
                'name' => 'Pizza',
                'description' => 'Cheesy oven-baked pizza',
                'image' => NULL,
                'price' => 450,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'item_id' => 'IID1003',
                'name' => 'Pasta',
                'description' => 'Italian pasta dish',
                'image' => NULL,
                'price' => 200,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}