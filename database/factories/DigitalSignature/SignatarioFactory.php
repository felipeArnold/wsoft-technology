<?php

declare(strict_types=1);

namespace Database\Factories\DigitalSignature;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DigitalSignature\Signatario>
 */
final class SignatarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'envelope_id' => \App\Models\DigitalSignature\Envelope::factory(),
            'name' => $this->faker->name(),
            'document_number' => $this->faker->numerify('###.###.###-##'),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'birth_date' => $this->faker->dateTimeBetween('-80 years', '-18 years'),
            'signer_type' => $this->faker->randomElement(['signer', 'witness', 'approver']),
            'signature_with_photo' => $this->faker->boolean(),
            'document_front' => null,
            'document_back' => null,
            'signature' => null,
            'rubric' => null,
            'status' => $this->faker->randomElement(['pending', 'signed', 'rejected', 'expired']),
            'signed_at' => $this->faker->optional()->dateTimeBetween('-1 month', 'now'),
            'rejection_reason' => $this->faker->optional()->sentence(),
        ];
    }
}
