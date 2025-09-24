<?php

namespace Database\Factories;

use App\Models\Payment;
use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
     public function definition(): array
    {
        return [
            'booking_id' => Booking::inRandomOrder()->first()->id ?? Booking::factory(),
            'amount' => $this->faker->randomFloat(2, 30, 300),
            'payment_method' => $this->faker->randomElement(['stripe', 'paypal']),
            'transaction_id' => $this->faker->numerify('###'), 
            'status' => $this->faker->randomElement(['completed', 'pending']),
        ];
    }
}
