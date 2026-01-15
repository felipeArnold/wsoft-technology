<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Product;
use App\Models\StockMovement;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StockMovement>
 */
final class StockMovementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = StockMovement::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'tenant_id' => Tenant::factory(),
            'product_id' => Product::factory(),
            'user_id' => User::factory(),
            'type' => $this->faker->randomElement(['in', 'out', 'adjustment']),
            'quantity' => $this->faker->numberBetween(1, 100),
            'reason' => $this->faker->sentence(),
            'notes' => $this->faker->optional(0.5)->paragraph(),
            'movement_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }

    /**
     * Indicate that it's a stock in movement.
     */
    public function stockIn(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'in',
            'quantity' => abs($attributes['quantity']),
        ]);
    }

    /**
     * Indicate that it's a stock out movement.
     */
    public function stockOut(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'out',
            'quantity' => abs($attributes['quantity']),
        ]);
    }

    /**
     * Indicate that it's a stock adjustment movement.
     */
    public function adjustment(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'adjustment',
        ]);
    }
}
