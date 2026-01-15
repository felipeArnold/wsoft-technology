<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
final class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(2, true),
            'description' => $this->faker->sentence(),
            'color' => $this->faker->hexColor(),
            'icon' => $this->faker->randomElement(['heroicon-o-folder', 'heroicon-o-tag', 'heroicon-o-star']),
            'is_active' => true,
            'order' => $this->faker->numberBetween(1, 100),
            'parent_id' => null,
        ];
    }
}
