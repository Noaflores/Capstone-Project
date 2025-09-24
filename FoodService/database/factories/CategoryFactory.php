<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $categories = ['Meat', 'Vegetable', 'Juice', 'Shake'];
        static $index = 0;

        return [
            //
            'name' => $categories[$index++ % count($categories)],
        ];
    }
}
