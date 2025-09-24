<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\Experience;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'experience_id' => Experience::inRandomOrder()->first()->id ?? Experience::factory(),
            'customer_name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'phone' => $this->faker->phoneNumber(),
            'booking_date' => $this->faker->dateTimeBetween('now', '+2 weeks'),
            'number_of_guests' => $this->faker->numberBetween(1, 6),
            'status' => $this->faker->randomElement(['pending', 'confirmed']),
        ];
    }
}
