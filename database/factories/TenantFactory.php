<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Tenant;
use App\Enum\TenantType;
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
            'document' => $this->faker->cnpj(false),
            'email' => $this->faker->companyEmail(),
            'phone' => $this->faker->phoneNumber(),
            'mobile' => $this->faker->optional(0.5)->phoneNumber(),
            'zip_code' => $this->faker->postcode(),
            'street' => $this->faker->streetName(),
            'number' => $this->faker->buildingNumber(),
            'complement' => $this->faker->optional(0.3)->secondaryAddress(),
            'neighborhood' => $this->faker->word(),
            'city' => $this->faker->city(),
            'state' => $this->faker->stateAbbr(),
            'website' => $this->faker->optional(0.5)->url(),
            'type' => $this->faker->randomElement(TenantType::cases()),
            'max_users' => $this->faker->numberBetween(1, 100),
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