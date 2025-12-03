<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\CRM\Sources\Schemas;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

final class SourceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Source Information')
                    ->schema([
                        Toggle::make('active')
                            ->label('Ativo')
                            ->default(true)
                            ->inline(false)
                            ->columnSpanFull(),
                        TextInput::make('name')
                            ->label('Nome')
                            ->required()
                            ->maxLength(255)
                            ->disabled(fn (?string $operation, Get $get): bool => $operation === 'edit' && $get('is_default') === true),
                        ColorPicker::make('color')
                            ->label('Cor')
                            ->default('#3b82f6')
                            ->disabled(fn (?string $operation, Get $get): bool => $operation === 'edit' && $get('is_default') === true),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }
}
