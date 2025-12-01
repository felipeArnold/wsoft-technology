<?php

declare(strict_types=1);

namespace App\Filament\Resources\AI\AIGenerations\Pages;

use App\Filament\Resources\AI\AIGenerations\AIGenerationResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateAIGeneration extends CreateRecord
{
    protected static string $resource = AIGenerationResource::class;
}
