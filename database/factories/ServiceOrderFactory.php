<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enum\ServiceOrderPriority;
use App\Enum\ServiceOrderStatus;
use App\Models\Person\Person;
use App\Models\ServiceOrder;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServiceOrder>
 */
final class ServiceOrderFactory extends Factory
{
    protected $model = ServiceOrder::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tenant_id' => Tenant::factory(),
            'user_id' => User::factory(),
            'person_id' => Person::factory(),
            'number' => $this->faker->unique()->numerify('OS-####'),
            'status' => $this->faker->randomElement([
                ServiceOrderStatus::DRAFT->value,
                ServiceOrderStatus::BUDGET->value,
                ServiceOrderStatus::IN_PROGRESS->value,
                ServiceOrderStatus::COMPLETED->value,
                ServiceOrderStatus::CANCELLED->value,
            ]),
            'priority' => $this->faker->randomElement([
                ServiceOrderPriority::LOW->value,
                ServiceOrderPriority::MEDIUM->value,
                ServiceOrderPriority::HIGH->value,
                ServiceOrderPriority::URGENT->value,
            ]),
            'opening_date' => $this->faker->date(),
            'expected_completion_date' => $this->faker->optional()->date(),
            'completion_date' => $this->faker->optional()->date(),
            'description' => $this->faker->sentence(),
            'observations' => $this->faker->optional()->paragraph(),
            'total_value' => $this->faker->randomFloat(2, 50, 1000),
            'labor_value' => $this->faker->randomFloat(2, 20, 500),
            'parts_value' => $this->faker->randomFloat(2, 10, 300),
            'warranty_period' => $this->faker->optional()->randomElement(['30 dias', '90 dias', '1 ano']),
            'technical_report' => $this->faker->optional()->paragraph(),
            'attachments' => $this->faker->optional()->randomElements(['file1.pdf', 'file2.jpg'], 2),
        ];
    }
}
