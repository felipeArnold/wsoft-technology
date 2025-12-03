<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\CRM\LossReasons\Schemas;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

final class LossReasonForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Loss Reason Information')
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
                            ->default('#ef4444')
                            ->disabled(fn (?string $operation, Get $get): bool => $operation === 'edit' && $get('is_default') === true),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }
}
