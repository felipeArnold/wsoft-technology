<?php

declare(strict_types=1);

namespace Database\Factories\Person;

use App\Models\Person\Person;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Person\Person>
 */
final class PersonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = Person::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'tenant_id' => Tenant::factory(),
            'name' => $this->faker->name(),
            'surname' => $this->faker->optional(0.5)->lastName(),
            'document' => $this->faker->cpf(false),
            'birth_date' => $this->faker->optional(0.7)->date(),
            'nationality' => $this->faker->optional(0.5)->country(),
            'naturalness' => $this->faker->optional(0.5)->city(),
            'type' => $this->faker->randomElement(['individual', 'company']),
        ];
    }
}