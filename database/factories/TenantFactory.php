<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enum\TenantType;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tenant>
 */
final class TenantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = Tenant::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $name = $this->faker->company();

        return [
            'name' => $name,
            'slug' => \Illuminate\Support\Str::slug($name),
            'avatar' => null,
            'document' => $this->faker->numerify('########0001##'),
            'website' => $this->faker->optional(0.5)->url(),
            'type' => $this->faker->randomElement(TenantType::cases()),
        ];
    }

    /**
     * Indicate that the tenant is of a specific type.
     */
    public function type(TenantType $type): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => $type,
        ]);
    }
}
