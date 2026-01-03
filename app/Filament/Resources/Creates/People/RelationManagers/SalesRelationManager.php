<?php

declare(strict_types=1);

namespace App\Filament\Resources\Creates\People\RelationManagers;

use App\Filament\Resources\Financial\Sales\SaleResource;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class SalesRelationManager extends RelationManager
{
    protected static string $relationship = 'sales';

    protected static ?string $title = 'Vendas';

    protected static ?string $modelLabel = 'Venda';

    protected static ?string $pluralModelLabel = 'Vendas';

    protected static string|BackedEnum|null $icon = 'heroicon-o-shopping-cart';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('sale_number')
                    ->label('Número')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('info'),
                TextColumn::make('items_count')
                    ->label('Itens')
                    ->counts('items')
                    ->badge()
                    ->color('gray'),
                TextColumn::make('subtotal')
                    ->label('Subtotal')
                    ->money('BRL')
                    ->sortable(),
                TextColumn::make('discount_amount')
                    ->label('Desconto')
                    ->money('BRL')
                    ->sortable()
                    ->color('danger'),
                TextColumn::make('total')
                    ->label('Total')
                    ->money('BRL')
                    ->weight('bold')
                    ->color('success')
                    ->sortable()
                    ->summarize([
                        Sum::make()->label('Total Vendas')->money('BRL'),
                    ]),
                TextColumn::make('payment_method')
                    ->label('Pagamento')
                    ->badge()
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'cash' => 'Dinheiro',
                        'card' => 'Cartão',
                        'pix' => 'PIX',
                        'installments' => 'Parcelado',
                        default => $state,
                    })
                    ->color(fn ($state) => match ($state) {
                        'cash' => 'success',
                        'card' => 'info',
                        'pix' => 'warning',
                        'installments' => 'primary',
                        default => 'gray',
                    }),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'pending' => 'Pendente',
                        'completed' => 'Concluída',
                        'cancelled' => 'Cancelada',
                        default => $state,
                    })
                    ->color(fn ($state) => match ($state) {
                        'pending' => 'warning',
                        'completed' => 'success',
                        'cancelled' => 'danger',
                        default => 'gray',
                    })
                    ->icon(fn ($state) => match ($state) {
                        'pending' => 'heroicon-o-clock',
                        'completed' => 'heroicon-o-check-circle',
                        'cancelled' => 'heroicon-o-x-circle',
                        default => null,
                    }),
                TextColumn::make('created_at')
                    ->label('Data')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->recordActions([
                Action::make('view')
                    ->label('Ver')
                    ->icon('heroicon-o-eye')
                    ->url(fn (Action $action) => SaleResource::getUrl('view', ['record' => $action->getRecord()])),
                Action::make('edit')
                    ->label('Editar')
                    ->icon('heroicon-o-pencil')
                    ->url(fn (Action $action) => SaleResource::getUrl('edit', ['record' => $action->getRecord()])),
            ])
            ->emptyStateIcon(Heroicon::OutlinedShoppingCart)
            ->emptyStateHeading('Nenhuma venda vinculada')
            ->emptyStateDescription('Crie vendas para que elas apareçam aqui.')
            ->defaultSort('created_at', 'desc')
            ->paginated([10, 25, 50]);
    }
}
