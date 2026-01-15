<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Category;
use App\Models\Service;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
final class ServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = Service::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'tenant_id' => Tenant::factory(),
            'category_id' => Category::factory(),
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 20, 500),
            'duration' => $this->faker->numberBetween(30, 180),
            'commission_percentage' => $this->faker->optional(0.5)->randomFloat(2, 1, 15),
            'price_type' => $this->faker->randomElement(['fixed', 'hourly']),
            'is_active' => true,
        ];
    }
}
