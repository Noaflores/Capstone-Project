<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ChefUser;

class ChefUserFactory extends Factory
{
    protected $model = ChefUser::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'role' => 'personal_chef',
            'specialty' => 'general',
        ];
    }

    public function personalChef(string $specialty = 'general'): static
    {
        return $this->state(fn () => [
            'role' => 'personal_chef',
            'specialty' => $specialty,
        ]);
    }

    public function cookingTeacher(string $specialty = 'general'): static
    {
        return $this->state(fn () => [
            'role' => 'culenary_teacher',
            'specialty' => $specialty,
        ]);
    }

   public function shakeTeacher(string $specialty = 'Shake teaching'): static
    {
    return $this->state(fn () => [
        'role' => 'culenary_teacher',
        'specialty' => $specialty,
    ]);
    }

}
