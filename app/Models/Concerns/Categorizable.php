<?php

declare(strict_types=1);

namespace App\Models\Concerns;

use App\Models\Category;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait Categorizable
{
    public function categories(): MorphToMany
    {
        return $this->morphToMany(Category::class, 'categorizable');
    }

    public function syncCategories(array $categoryIds): void
    {
        $this->categories()->sync($categoryIds);
    }

    public function attachCategories(array $categoryIds): void
    {
        $this->categories()->attach($categoryIds);
    }

    public function detachCategories(array $categoryIds = []): void
    {
        $this->categories()->detach($categoryIds);
    }

    public function hasCategory(int $categoryId): bool
    {
        return $this->categories()->where('category_id', $categoryId)->exists();
    }

    public function categoriesByPurpose(string $purpose)
    {
        return $this->categories()->where('purpose', $purpose)->get();
    }
}
