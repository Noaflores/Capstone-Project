<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenuItem;

class MenuItemsSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['name' => 'Coffee', 'description' => 'Hot brewed coffee', 'price' => 200],
            ['name' => 'Pizza', 'description' => 'Cheesy oven-baked pizza', 'price' => 450],
            ['name' => 'Pasta', 'description' => 'Italian pasta dish', 'price' => 200],
        ];

        foreach ($items as $item) {
            $latest = MenuItem::orderByDesc('item_id')->first();
            $nextNumber = $latest
                ? ((int) preg_replace('/\D/', '', $latest->item_id) + 1)
                : 1001;

            MenuItem::create([
                'item_id'     => 'IID' . $nextNumber,
                'name'        => $item['name'],
                'description' => $item['description'],
                'price'       => $item['price'],
            ]);
        }
    }
}
