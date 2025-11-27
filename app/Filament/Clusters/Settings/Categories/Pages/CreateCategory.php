<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\Categories\Pages;

use App\Filament\Clusters\Settings\Categories\CategoryResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateCategory extends CreateRecord
{
    protected static string $resource = CategoryResource::class;
}
