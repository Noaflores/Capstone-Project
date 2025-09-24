<?php

namespace Database\Factories;

use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;


class ReviewFactory extends Factory
{
    public function definition(): array
{
    $comments = [
        "Amazing experience, loved the chef's expertise!",
        "Great cooking class, learned so much!",
        "The dishes were delicious and the chef was very friendly.",
        "I highly recommend this chef for private lessons about cooking.",
        "A wonderful and tasty culinary journey.",
        "The chef's passion really shows in every dish.",
    ];

    return [
        'name' => $this->faker->name,
        'comment' => $this->faker->randomElement($comments),
    ];
}

}
