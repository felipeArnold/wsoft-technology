<?php

declare(strict_types=1);

namespace Database\Factories\Blog;

use App\Models\Blog\BlogPost;
use App\Models\Category;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog\BlogPost>
 */
final class BlogPostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = BlogPost::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $title = $this->faker->sentence();
        $slug = \Illuminate\Support\Str::slug($title);

        return [
            'user_id' => User::factory(),
            'tenant_id' => Tenant::factory(),
            'category_id' => Category::factory(),
            'title' => $title,
            'slug' => $slug,
            'content' => $this->faker->paragraphs(5, true),
            'excerpt' => $this->faker->sentence(),
            'status' => $this->faker->randomElement(['draft', 'published']),
            'featured_image' => $this->faker->optional(0.5)->imageUrl(),
            'is_featured' => $this->faker->boolean(20), // 20% chance of being featured
            'meta' => [
                'keywords' => $this->faker->words(5),
                'description' => $this->faker->sentence(),
            ],
            'published_at' => $this->faker->optional(0.7)->dateTimeBetween('-1 year', 'now'),
        ];
    }

    /**
     * Indicate that the blog post is published.
     */
    public function published(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'published',
            'published_at' => now(),
        ]);
    }

    /**
     * Indicate that the blog post is featured.
     */
    public function featured(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_featured' => true,
        ]);
    }
}
