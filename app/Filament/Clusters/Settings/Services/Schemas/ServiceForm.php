<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\Services\Schemas;

use App\Filament\Components\PtbrMoney;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

final class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informações do Serviço')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nome')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        PtbrMoney::make('price')
                            ->label('Preço')
                            ->default('0,00')
                            ->required(),
                        PtbrMoney::make('discount')
                            ->label('Desconto')
                            ->default('0,00'),
                        Textarea::make('description')
                            ->label('Descrição')
                            ->rows(3)
                            ->columnSpanFull(),

                    ])
                    ->columns(3)
                    ->columnSpanFull(),
            ]);
    }
}
