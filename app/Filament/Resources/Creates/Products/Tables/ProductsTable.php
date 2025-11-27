<?php

declare(strict_types=1);

namespace App\Filament\Resources\Creates\Products\Tables;

use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use App\Filament\Components\PtbrMoney;
use App\Helpers\FormatterHelper;
use App\Models\Product;
use App\Models\StockMovement;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Facades\Filament;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

final class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nome do Produto')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('sku')
                    ->label('SKU')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),
                TextColumn::make('person.name')
                    ->label('Fornecedor')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),
                TextColumn::make('price_cost')
                    ->label('Custo')
                    ->money('BRL')
                    ->sortable(),
                TextColumn::make('price_sale')
                    ->label('Venda')
                    ->money('BRL')
                    ->sortable(),
                TextColumn::make('net_profit')
                    ->label('Lucro')
                    ->money('BRL')
                    ->sortable()
                    ->color(fn ($state): string => $state > 0 ? 'success' : ($state < 0 ? 'danger' : 'gray')),
                TextColumn::make('stock')
                    ->label('Estoque')
                    ->numeric()
                    ->sortable()
                    ->color(fn ($record): string => $record->stock <= $record->stock_alert ? 'danger' : 'success'),
                TextColumn::make('stock_alert')
                    ->label('Alerta')
                    ->numeric()
                    ->sortable()
                    ->placeholder('N/A')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Atualizado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('person')
                    ->label('Fornecedor')
                    ->relationship('person', 'name')
                    ->searchable()
                    ->preload(),
                TernaryFilter::make('low_stock')
                    ->label('Estoque Baixo')
                    ->queries(
                        true: fn ($query) => $query->whereRaw('stock <= stock_alert'),
                        false: fn ($query) => $query->whereRaw('stock > stock_alert'),
                    ),
                TernaryFilter::make('profitable')
                    ->label('Lucrativo')
                    ->queries(
                        true: fn ($query) => $query->whereRaw('net_profit > 0'),
                        false: fn ($query) => $query->whereRaw('net_profit <= 0'),
                    ),
            ])
            ->recordActions([
                ViewAction::make()->label('Ver'),
                EditAction::make(),
                Action::make('stock_in')
                    ->label('Entrada')
                    ->icon('heroicon-o-arrow-down-circle')
                    ->color('success')
                    ->form([
                        TextInput::make('quantity')
                            ->label('Quantidade')
                            ->numeric()
                            ->required()
                            ->minValue(1)
                            ->default(1),
                        PtbrMoney::make('unit_cost')
                            ->label('Custo Unitário')
                            ->required(),
                        Select::make('reason')
                            ->label('Motivo')
                            ->options([
                                'Compra' => 'Compra',
                                'Devolução' => 'Devolução',
                                'Transferência' => 'Transferência',
                                'Outro' => 'Outro',
                            ])
                            ->default('Compra')
                            ->required(),
                        Textarea::make('notes')
                            ->label('Observações')
                            ->rows(3),
                    ])
                    ->action(function (Product $record, array $data): void {
                        $stockBefore = $record->stock;
                        $stockAfter = $stockBefore + $data['quantity'];
                        $unitCost = FormatterHelper::toDecimal($data['unit_cost']);

                        // Cria a movimentação
                        StockMovement::create([
                            'tenant_id' => Filament::getTenant()->id,
                            'product_id' => $record->id,
                            'user_id' => auth()->id(),
                            'type' => 'in',
                            'quantity' => $data['quantity'],
                            'stock_before' => $stockBefore,
                            'stock_after' => $stockAfter,
                            'unit_cost' => $unitCost,
                            'reason' => $data['reason'],
                            'notes' => $data['notes'] ?? null,
                        ]);

                        // Atualiza estoque
                        $record->update(['stock' => $stockAfter]);

                        // Atualiza custo médio
                        $currentAverage = $record->average_cost ?? 0;
                        $totalCost = ($stockBefore * $currentAverage) + ($data['quantity'] * $unitCost);
                        $newAverageCost = $stockAfter > 0 ? $totalCost / $stockAfter : 0;
                        $record->update(['average_cost' => $newAverageCost]);

                        Notification::make()
                            ->success()
                            ->title('Entrada registrada!')
                            ->body("Adicionadas {$data['quantity']} unidades ao estoque.")
                            ->send();
                    }),
                Action::make('stock_out')
                    ->label('Saída')
                    ->icon('heroicon-o-arrow-up-circle')
                    ->color('danger')
                    ->form([
                        TextInput::make('quantity')
                            ->label('Quantidade')
                            ->numeric()
                            ->required()
                            ->minValue(1)
                            ->default(1),
                        Select::make('reason')
                            ->label('Motivo')
                            ->options([
                                'Venda' => 'Venda',
                                'Perda' => 'Perda',
                                'Transferência' => 'Transferência',
                                'Outro' => 'Outro',
                            ])
                            ->default('Venda')
                            ->required(),
                        Textarea::make('notes')
                            ->label('Observações')
                            ->rows(3),
                    ])
                    ->action(function (Product $record, array $data): void {
                        $stockBefore = $record->stock;
                        $stockAfter = $stockBefore - $data['quantity'];

                        if ($stockAfter < 0) {
                            Notification::make()
                                ->danger()
                                ->title('Estoque insuficiente!')
                                ->body("Estoque atual: {$stockBefore}. Não é possível retirar {$data['quantity']} unidades.")
                                ->send();

                            return;
                        }

                        // Cria a movimentação
                        StockMovement::create([
                            'tenant_id' => Filament::getTenant()->id,
                            'product_id' => $record->id,
                            'user_id' => auth()->id(),
                            'type' => 'out',
                            'quantity' => $data['quantity'],
                            'stock_before' => $stockBefore,
                            'stock_after' => $stockAfter,
                            'reason' => $data['reason'],
                            'notes' => $data['notes'] ?? null,
                        ]);

                        // Atualiza estoque
                        $record->update(['stock' => $stockAfter]);

                        Notification::make()
                            ->success()
                            ->title('Saída registrada!')
                            ->body("Removidas {$data['quantity']} unidades do estoque.")
                            ->send();
                    }),
            ])
            ->toolbarActions([

                FilamentExportBulkAction::make('export')->label('Exportar'),
            ])
            ->striped()
            ->emptyStateIcon('heroicon-o-inbox')
            ->emptyStateHeading('Nenhum produto encontrado')
            ->emptyStateDescription('Crie seu primeiro produto para começar a gerenciar seu inventário.')
            ->defaultPaginationPageOption(50);
    }
}
