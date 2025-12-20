<?php

declare(strict_types=1);

namespace App\Filament\Resources\Services\Warranties\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class WarrantyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informações da Garantia')
                    ->icon('heroicon-o-shield-check')
                    ->description('Dados principais da garantia')
                    ->schema([
                        Select::make('service_order_id')
                            ->label('Ordem de Serviço')
                            ->relationship('serviceOrder', 'number')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->columnSpan(1),

                        Select::make('person_id')
                            ->label('Cliente')
                            ->relationship('person', 'name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->columnSpan(1),

                        Select::make('warranty_type')
                            ->label('Tipo de Garantia')
                            ->options([
                                'order' => 'Ordem de Serviço',
                                'product' => 'Produto',
                                'service' => 'Serviço',
                            ])
                            ->default('order')
                            ->required()
                            ->native(false)
                            ->reactive()
                            ->columnSpan(1),

                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'active' => 'Ativa',
                                'expired' => 'Expirada',
                                'claimed' => 'Acionada',
                                'cancelled' => 'Cancelada',
                            ])
                            ->default('active')
                            ->required()
                            ->native(false)
                            ->columnSpan(1),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                Section::make('Item Específico')
                    ->icon('heroicon-o-cube')
                    ->description('Selecione o item específico coberto pela garantia (opcional)')
                    ->schema([
                        Select::make('product_id')
                            ->label('Produto')
                            ->relationship('product', 'name')
                            ->searchable()
                            ->preload()
                            ->visible(fn ($get) => $get('warranty_type') === 'product')
                            ->columnSpan(1),

                        Select::make('service_id')
                            ->label('Serviço')
                            ->relationship('service', 'name')
                            ->searchable()
                            ->preload()
                            ->visible(fn ($get) => $get('warranty_type') === 'service')
                            ->columnSpan(1),
                    ])
                    ->columns(2)
                    ->columnSpanFull()
                    ->collapsed(),

                Section::make('Período da Garantia')
                    ->icon('heroicon-o-calendar')
                    ->description('Defina o período de cobertura')
                    ->schema([
                        DatePicker::make('start_date')
                            ->label('Data de Início')
                            ->required()
                            ->native(false)
                            ->default(now())
                            ->reactive()
                            ->afterStateUpdated(function ($state, $get, $set) {
                                $durationDays = $get('duration_days');
                                if ($state && $durationDays) {
                                    $endDate = \Carbon\Carbon::parse($state)->addDays((int) $durationDays);
                                    $set('end_date', $endDate->toDateString());
                                }
                            })
                            ->columnSpan(1),

                        TextInput::make('duration_days')
                            ->label('Duração (dias)')
                            ->numeric()
                            ->default(90)
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, $get, $set) {
                                $startDate = $get('start_date');
                                if ($startDate && $state) {
                                    $endDate = \Carbon\Carbon::parse($startDate)->addDays((int) $state);
                                    $set('end_date', $endDate->toDateString());
                                }
                            })
                            ->columnSpan(1),

                        DatePicker::make('end_date')
                            ->label('Data de Término')
                            ->required()
                            ->native(false)
                            ->columnSpan(1),
                    ])
                    ->columns(3)
                    ->columnSpanFull(),

                Section::make('Descrição e Termos')
                    ->icon('heroicon-o-document-text')
                    ->description('Informações sobre cobertura e condições')
                    ->schema([
                        RichEditor::make('coverage_description')
                            ->label('Descrição da Cobertura')
                            ->placeholder('Descreva o que está coberto pela garantia...')
                            ->columnSpanFull(),

                        RichEditor::make('terms')
                            ->label('Termos e Condições')
                            ->placeholder('Termos e condições da garantia...')
                            ->columnSpanFull(),

                        RichEditor::make('notes')
                            ->label('Observações')
                            ->placeholder('Observações adicionais...')
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull()
                    ->collapsed(),
            ]);
    }
}
