<?php

declare(strict_types=1);

namespace App\Filament\Resources\Creates\People\Pages;

use App\Filament\Resources\Creates\People\PersonResource;
use Filament\Resources\Pages\CreateRecord;

final class CreatePerson extends CreateRecord
{
    protected static string $resource = PersonResource::class;
}
