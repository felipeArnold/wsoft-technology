<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Person\Person;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
final class VehicleFactory extends Factory
{
    /**
     * The name of factory's corresponding model.
     */
    protected $model = Vehicle::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'person_id' => Person::factory(),
            'brand' => $this->faker->randomElement(['Toyota', 'Honda', 'Ford', 'Chevrolet', 'Volkswagen']),
            'model' => $this->faker->word(),
            'license_plate' => $this->faker->regexify('[A-Z]{3}[0-9]{4}'),
            'vin' => $this->faker->regexify('[A-HJ-NPR-Z0-9]{17}'),
            'year' => $this->faker->numberBetween(2010, 2024),
            'color' => $this->faker->colorName(),
            'fuel_type' => $this->faker->randomElement(['gasoline', 'ethanol', 'flex', 'diesel']),
            'transmission' => $this->faker->randomElement(['manual', 'automatic']),
            'odometer' => $this->faker->numberBetween(0, 200000),
            'is_active' => true,
        ];
    }
}
