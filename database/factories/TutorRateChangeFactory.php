<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TutorRateChange>
 */
class TutorRateChangeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tutor_id' => \App\Models\Tutor::factory(),
            'old_hourly_rate' => $this->faker->randomFloat(2, 10, 100),
            'new_hourly_rate' => $this->faker->randomFloat(2, 10, 100),
        ];
    }
}
