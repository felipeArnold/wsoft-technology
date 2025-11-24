<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Blog\BlogCategoryResource\Pages;

use App\Filament\Admin\Resources\Blog\BlogCategoryResource\BlogCategoryResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

final class EditBlogCategory extends EditRecord
{
    protected static string $resource = BlogCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
