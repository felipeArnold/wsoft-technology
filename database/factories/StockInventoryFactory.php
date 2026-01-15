<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\StockInventory;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StockInventory>
 */
final class StockInventoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = StockInventory::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'tenant_id' => Tenant::factory(),
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->sentence(),
            'status' => $this->faker->randomElement(['draft', 'in_progress', 'completed']),
            'inventory_date' => $this->faker->dateTime(),
            'finalized_at' => $this->faker->optional(0.5)->dateTime(),
        ];
    }

    /**
     * Indicate that the inventory is completed.
     */
    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'completed',
            'finalized_at' => now(),
        ]);
    }

    /**
     * Indicate that the inventory is in progress.
     */
    public function inProgress(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'in_progress',
        ]);
    }
}
