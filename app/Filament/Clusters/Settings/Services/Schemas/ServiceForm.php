<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\Services\Schemas;

use App\Models\Service;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

final class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informações do Serviço')
                    ->schema(Service::getFormFields())
                    ->columns(3)
                    ->columnSpanFull(),
            ]);
    }
}
