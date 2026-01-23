<?php

namespace Database\Factories;

use App\Models\InventoryCategory;
use App\Models\Laboratory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InventoryItem>
 */
class InventoryItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'laboratory_id' => Laboratory::factory(),
            'category_id' => InventoryCategory::factory(),
            'code' => $this->faker->unique()->bothify('INV-####'),
            'name' => $this->faker->word,
            'brand' => $this->faker->company,
            'model' => $this->faker->word,
            'purchase_year' => $this->faker->year,
            'condition' => 'good',
            'status' => 'available',
            'quantity' => $quantity = $this->faker->numberBetween(1, 100),
            'available_quantity' => $quantity,
        ];
    }
}