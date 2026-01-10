<?php

declare(strict_types=1);

namespace App\Filament\Resources\Creates\Vehicles\Schemas;

use App\Models\Vehicle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

final class VehicleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informações do Veículo')
                    ->icon('heroicon-o-truck')
                    ->schema(Vehicle::getFormFields())
                    ->columns(3)
                    ->columnSpanFull(),
            ]);
    }
}
