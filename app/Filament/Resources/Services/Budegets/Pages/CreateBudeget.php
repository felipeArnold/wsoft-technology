<?php

declare(strict_types=1);

namespace App\Filament\Resources\Services\Budegets\Pages;

use App\Filament\Resources\Services\Budegets\BudegetResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateBudeget extends CreateRecord
{
    protected static string $resource = BudegetResource::class;
}
