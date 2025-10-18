<?php

declare(strict_types=1);

namespace App\Filament\Resources\Financial\Extracts\Pages;

use App\Filament\Resources\Financial\Extracts\ExtractResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateExtract extends CreateRecord
{
    protected static string $resource = ExtractResource::class;
}
