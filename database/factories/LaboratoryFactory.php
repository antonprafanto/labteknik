<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Laboratory>
 */
class LaboratoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Lab ' . $this->faker->word,
            'location' => 'Building ' . $this->faker->randomLetter,
            'description' => $this->faker->sentence,
            'capacity' => $this->faker->numberBetween(20, 50),
        ];
    }
}