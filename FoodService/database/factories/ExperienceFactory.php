<?php

namespace Database\Factories;

use App\Models\Experience;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExperienceFactory extends Factory
{
    protected static int $index = 0;

    public function definition(): array
    {
        $titles = [
            'Local BBQ Meat Feast',
            'Fresh Vegetable Salad Tour',
            'Cold-Pressed Juice Party',
            'Tropical Shake-Making Class',
        ];

        $descriptions = [
            'Join us for a hands-on local food journey with expert chefs.',
            'Enjoy the freshness of organic produce in this curated class.',
            'Discover vibrant flavors through a guided beverage experience.',
            'Experience the best mixes with our shake-making chef sessions.',
        ];

        $prices = [
            250.00, // Meat Pricing
            200.00, // Vegetable Pricing
            150.00, // Juice Pricing
            150.00, // Shake Pricing
        ];

        $i = self::$index % count($titles);
        self::$index++;

        return [
            'title' => $titles[$i],
            'description' => $descriptions[$i],
            'type' => $this->faker->randomElement(['food_tour', 'cooking_class', 'personal_chef']),
            'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory(),
            'price' => $prices[$i],
            'location' => $this->faker->city(),
            'image_path' => $this->faker->imageUrl(640, 480, 'food'),
        ];
    }
}
