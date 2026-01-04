<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\StockInventoryItem;
use App\Models\StockInventory;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StockInventoryItem>
 */
final class StockInventoryItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = StockInventoryItem::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'stock_inventory_id' => StockInventory::factory(),
            'product_id' => Product::factory(),
            'expected_quantity' => $this->faker->numberBetween(10, 1000),
            'actual_quantity' => $this->faker->numberBetween(0, 1000),
            'difference' => fn (array $attributes) => $attributes['actual_quantity'] - $attributes['expected_quantity'],
            'unit_cost' => $this->faker->randomFloat(2, 1, 100),
            'total_cost' => fn (array $attributes) => $attributes['actual_quantity'] * $attributes['unit_cost'],
        ];
    }
}