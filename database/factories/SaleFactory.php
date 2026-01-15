<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Person\Person;
use App\Models\Sale;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
final class SaleFactory extends Factory
{
    /**
     * The name of factory's corresponding model.
     */
    protected $model = Sale::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $subtotal = $this->faker->randomFloat(2, 50, 2000);
        $discount = $this->faker->optional(0.3)->randomFloat(2, 0, $subtotal * 0.2);
        $tax = $this->faker->randomFloat(2, 0, $subtotal * 0.1);

        return [
            'tenant_id' => Tenant::factory(),
            'person_id' => Person::factory(),
            'user_id' => User::factory(),
            'subtotal' => $subtotal,
            'discount' => $discount ?? 0,
            'tax' => $tax,
            'total' => $subtotal - ($discount ?? 0) + $tax,
            'status' => $this->faker->randomElement(['pending', 'completed', 'cancelled']),
            'payment_method' => $this->faker->randomElement(['cash', 'credit_card', 'debit_card', 'pix']),
            'payment_status' => $this->faker->randomElement(['pending', 'paid', 'partial']),
            'sale_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
