<?php

declare(strict_types=1);

namespace App\Filament\Resources\Services\Warranties\Pages;

use App\Filament\Resources\Services\Warranties\WarrantyResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateWarranty extends CreateRecord
{
    protected static string $resource = WarrantyResource::class;
}
