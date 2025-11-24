<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Blog\BlogCategoryResource\Pages;

use App\Filament\Admin\Resources\Blog\BlogCategoryResource\BlogCategoryResource;
use App\Models\Blog\BlogCategory;
use Filament\Resources\Pages\CreateRecord;

final class CreateBlogCategory extends CreateRecord
{
    protected static string $resource = BlogCategoryResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (empty($data['slug'])) {
            $data['slug'] = BlogCategory::generateUniqueSlug($data['name']);
        }

        return $data;
    }
}
