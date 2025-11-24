<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Blog\BlogPostResource\Pages;

use App\Filament\Admin\Resources\Blog\BlogPostResource\BlogPostResource;
use App\Models\Blog\BlogPost;
use Filament\Facades\Filament;
use Filament\Resources\Pages\CreateRecord;

final class CreateBlogPost extends CreateRecord
{
    protected static string $resource = BlogPostResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (empty($data['slug'])) {
            $data['slug'] = BlogPost::generateUniqueSlug($data['title']);
        }

        $data['author_id'] = Filament::auth()->id();

        if ($data['status'] === 'published' && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        return $data;
    }
}
