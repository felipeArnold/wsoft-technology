<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Commission;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Commission>
 */
final class CommissionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = Commission::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'sale_id' => Sale::factory(),
            'amount' => $this->faker->randomFloat(2, 10, 1000),
            'percentage' => $this->faker->randomFloat(2, 1, 20),
            'paid_at' => $this->faker->optional(0.7)->dateTime(),
        ];
    }
}
