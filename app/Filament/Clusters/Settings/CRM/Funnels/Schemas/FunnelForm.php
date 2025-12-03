<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\CRM\Funnels\Schemas;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Repeater\TableColumn;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

final class FunnelForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informações do Funil')
                    ->schema([
                        Toggle::make('active')
                            ->label('Ativo')
                            ->default(true)
                            ->inline(false)
                            ->columnSpanFull(),
                        TextInput::make('name')
                            ->label('Nome')
                            ->required()
                            ->maxLength(255),
                        ColorPicker::make('color')
                            ->label('Cor')
                            ->default('#3b82f6'),
                        Textarea::make('description')
                            ->label('Descrição')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                Section::make('Etapas do Funil')
                    ->schema([
                        Repeater::make('stages')
                            ->label('Etapas')
                            ->relationship('stages')
                            ->compact()
                            ->table([
                                TableColumn::make('Nome'),
                                TableColumn::make('Cor'),
                                TableColumn::make('Ativa'),
                            ])
                            ->schema([
                                TextInput::make('name')
                                    ->label('Nome')
                                    ->required()
                                    ->maxLength(255),
                                ColorPicker::make('color')
                                    ->label('Cor')
                                    ->default('#10b981'),
                                Toggle::make('active')
                                    ->label('Ativa')
                                    ->default(true)
                                    ->inline(false),
                            ])
                            ->columns(2)
                            ->reorderable()
                            ->orderColumn('order')
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['name'] ?? null)
                            ->addActionLabel('Adicionar Etapa')
                            ->defaultItems(0)
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
