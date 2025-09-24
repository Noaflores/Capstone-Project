<?php

namespace Database\Factories;

use App\Models\EventSchedule;
use App\Models\Experience;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EventSchedule>
 */
class EventScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start = $this->faker->dateTimeBetween('+1 day', '+1 month');
        return [
            //
            'experience_id' => Experience::inRandomOrder()->first()->id ?? Experience::factory(),
            'start_time' => $start,
            'end_time' => (clone $start)->modify('+2 hours'),
            'date' => $start->format('Y-m-d'),
        ];
    }
}
