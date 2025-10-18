<?php

declare(strict_types=1);

namespace Database\Factories\DigitalSignature;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DigitalSignature\Envelope>
 */
final class EnvelopeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'documents' => null,
            'deadline' => $this->faker->dateTimeBetween('+1 week', '+1 month'),
            'status' => $this->faker->randomElement(['draft', 'sent', 'signed', 'expired', 'cancelled']),
            'user_id' => 1, // Assumindo que existe um usuário com ID 1
            'tenant_id' => 1, // Assumindo que existe um tenant com ID 1
        ];
    }
}
