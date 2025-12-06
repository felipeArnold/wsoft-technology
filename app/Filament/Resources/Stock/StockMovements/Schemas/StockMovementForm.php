<?php

declare(strict_types=1);

namespace App\Filament\Resources\Stock\StockMovements\Schemas;

use App\Filament\Components\PtbrMoney;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

final class StockMovementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->components([
                Section::make('Informações da Movimentação')
                    ->description('Registre uma nova movimentação de estoque para um produto específico.')
                    ->icon('heroicon-o-arrows-right-left')
                    ->schema([
                        Select::make('product_id')
                            ->label('Produto')
                            ->relationship('product', 'name')
                            ->searchable(['name', 'sku'])
                            ->preload()
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set): void {
                                if ($state) {
                                    $product = \App\Models\Product::find($state);
                                    if ($product) {
                                        $set('stock_before', $product->stock);
                                    }
                                }
                            })
                            ->columnSpan(1),

                        Select::make('type')
                            ->label('Tipo de Movimentação')
                            ->options([
                                'in' => 'Entrada',
                                'out' => 'Saída',
                                'adjustment' => 'Ajuste',
                            ])
                            ->required()
                            ->native(false)
                            ->reactive()
                            ->columnSpan(1),

                        Select::make('reason')
                            ->label('Motivo')
                            ->options([
                                'Compra' => 'Compra',
                                'Venda' => 'Venda',
                                'Devolução' => 'Devolução',
                                'Ajuste de inventário' => 'Ajuste de inventário',
                                'Perda' => 'Perda',
                                'Transferência' => 'Transferência',
                                'Outro' => 'Outro',
                            ])
                            ->searchable()
                            ->columnSpan(1),

                        TextInput::make('quantity')
                            ->label('Quantidade')
                            ->numeric()
                            ->required()
                            ->minValue(1)
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $get, callable $set): void {
                                $stockBefore = (int) $get('stock_before') ?? 0;
                                $quantity = (int) $state ?? 0;
                                $type = $get('type');

                                $stockAfter = match ($type) {
                                    'in' => $stockBefore + $quantity,
                                    'out' => $stockBefore - $quantity,
                                    'adjustment' => $quantity,
                                    default => $stockBefore,
                                };

                                $set('stock_after', $stockAfter);
                            })
                            ->columnSpan(1),

                        TextInput::make('stock_before')
                            ->label('Estoque Anterior')
                            ->numeric()
                            ->disabled()
                            ->dehydrated()
                            ->default(0)
                            ->columnSpan(1),

                        TextInput::make('stock_after')
                            ->label('Estoque Após Movimentação')
                            ->numeric()
                            ->disabled()
                            ->dehydrated()
                            ->default(0)
                            ->columnSpan(1),

                        PtbrMoney::make('unit_cost')
                            ->label('Custo Unitário')
                            ->helperText('Apenas para entradas de estoque')
                            ->visible(fn (callable $get) => $get('type') === 'in')
                            ->columnSpan(1),

                        Textarea::make('notes')
                            ->label('Observações')
                            ->rows(4)
                            ->columnSpanFull(),
                    ])
                    ->columns(3)
                    ->columnSpanFull(),

            ]);
    }
}
