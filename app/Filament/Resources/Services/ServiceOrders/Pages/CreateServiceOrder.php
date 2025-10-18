<?php

declare(strict_types=1);

namespace App\Filament\Resources\Services\ServiceOrders\Pages;

use App\Filament\Resources\Services\ServiceOrders\ServiceOrderResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateServiceOrder extends CreateRecord
{
    protected static string $resource = ServiceOrderResource::class;
}
