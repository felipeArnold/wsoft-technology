<?php

declare(strict_types=1);

namespace Database\Factories\Blog;

use App\Models\Blog\BlogCategory;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog\BlogCategory>
 */
final class BlogCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = BlogCategory::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'tenant_id' => Tenant::factory(),
            'name' => $this->faker->words(2, true),
            'slug' => fn (array $attributes) => \Illuminate\Support\Str::slug($attributes['name']),
            'description' => $this->faker->sentence(),
            'color' => $this->faker->hexColor(),
            'is_active' => true,
            'order' => $this->faker->numberBetween(1, 100),
            'parent_id' => null,
        ];
    }

    /**
     * Indicate that the blog category is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => true,
        ]);
    }

    /**
     * Indicate that the blog category is inactive.
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }
}
