<?php

declare(strict_types=1);

namespace App\Filament\Resources\Creates\Products\Pages;

use App\Filament\Resources\Creates\Products\ProductResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;
}
