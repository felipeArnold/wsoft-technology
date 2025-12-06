<?php

declare(strict_types=1);

namespace App\Filament\Resources\Stock\StockInventories\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class StockInventoryItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    protected static ?string $title = 'Itens do Inventário';

    protected static ?string $recordTitleAttribute = 'product.name';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->components([
                Select::make('product_id')
                    ->label('Produto')
                    ->relationship('product', 'name')
                    ->searchable(['name', 'sku'])
                    ->preload()
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set): void {
                        if ($state) {
                            $product = \App\Models\Product::find($state);
                            if ($product) {
                                $set('system_quantity', $product->stock);
                            }
                        }
                    })
                    ->disabled(fn (?string $operation) => $operation === 'edit')
                    ->columnSpanFull(),

                TextInput::make('system_quantity')
                    ->label('Quantidade no Sistema')
                    ->numeric()
                    ->required()
                    ->disabled()
                    ->dehydrated()
                    ->helperText('Quantidade atual do produto no sistema')
                    ->columnSpan(1),

                TextInput::make('counted_quantity')
                    ->label('Quantidade Contada')
                    ->numeric()
                    ->minValue(0)
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $get, callable $set): void {
                        $systemQty = (int) $get('system_quantity') ?? 0;
                        $countedQty = (int) $state ?? 0;
                        $difference = $countedQty - $systemQty;
                        $set('difference', $difference);
                    })
                    ->helperText('Quantidade contada fisicamente no estoque')
                    ->columnSpan(1),

                TextInput::make('difference')
                    ->label('Diferença')
                    ->numeric()
                    ->disabled()
                    ->dehydrated()
                    ->helperText('Diferença entre quantidade contada e sistema')
                    ->columnSpan(1),

                Textarea::make('notes')
                    ->label('Observações')
                    ->rows(3)
                    ->maxLength(65535)
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('product.name')
            ->columns([
                TextColumn::make('product.name')
                    ->label('Produto')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('product.sku')
                    ->label('SKU')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('system_quantity')
                    ->label('Qtd. Sistema')
                    ->numeric(0)
                    ->alignCenter()
                    ->sortable(),

                TextColumn::make('counted_quantity')
                    ->label('Qtd. Contada')
                    ->numeric(0)
                    ->alignCenter()
                    ->sortable()
                    ->placeholder('-')
                    ->badge()
                    ->color(fn ($state) => $state === null ? 'gray' : 'success'),

                TextColumn::make('difference')
                    ->label('Diferença')
                    ->numeric(0)
                    ->alignCenter()
                    ->sortable()
                    ->placeholder('-')
                    ->badge()
                    ->color(fn ($state) => match (true) {
                        $state === null => 'gray',
                        $state > 0 => 'success',
                        $state < 0 => 'danger',
                        default => 'warning',
                    })
                    ->formatStateUsing(fn ($state) => $state > 0 ? "+{$state}" : $state),

                TextColumn::make('notes')
                    ->label('Observações')
                    ->limit(50)
                    ->toggleable()
                    ->placeholder('-')
                    ->wrap(),

                TextColumn::make('created_at')
                    ->label('Criado Em')
                    ->dateTime('d/m/Y H:i')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\Filter::make('has_difference')
                    ->label('Com diferença')
                    ->query(fn ($query) => $query->whereNotNull('difference')->where('difference', '!=', 0)),

                Tables\Filters\Filter::make('not_counted')
                    ->label('Não contados')
                    ->query(fn ($query) => $query->whereNull('counted_quantity')),
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('Adicionar Produto')
                    ->disabled(fn () => $this->getOwnerRecord()->status === 'completed'),
            ])
            ->actions([
                EditAction::make()
                    ->disabled(fn () => $this->getOwnerRecord()->status === 'completed'),
                DeleteAction::make()
                    ->disabled(fn () => $this->getOwnerRecord()->status === 'completed'),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->disabled(fn () => $this->getOwnerRecord()->status === 'completed'),
                ]),
            ])
            ->defaultSort('product.name')
            ->striped()
            ->emptyStateIcon('heroicon-o-inbox')
            ->emptyStateHeading('Nenhum item de inventário encontrado')
            ->emptyStateDescription('Adicione itens ao inventário de estoque para começar a gerenciá-los.')
            ->emptyStateActions([
                CreateAction::make()
                    ->icon('heroicon-s-plus')
                    ->label('Novo Item')
                    ->disabled(fn () => $this->getOwnerRecord()->status === 'completed'),
            ])
            ->paginated([10, 25, 50, 100]);
    }
}
