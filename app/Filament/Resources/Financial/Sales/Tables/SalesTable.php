<?php

declare(strict_types=1);

namespace App\Filament\Resources\Financial\Sales\Tables;

use App\Enum\Commission\CommissionStatusEnum;
use App\Models\Commission;
use App\Models\Sale;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

final class SalesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('sale_number')
                    ->label('Número')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('info'),
                TextColumn::make('person.name')
                    ->label('Cliente')
                    ->searchable()
                    ->sortable()
                    ->placeholder('Cliente não informado'),
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
                TextColumn::make('user.name')
                    ->label('Vendedor')
                    ->searchable()
                    ->sortable()
                    ->placeholder('Vendedor não informado')
                    ->toggleable(),
                TextColumn::make('categories.name')
                    ->label('Etiquetas')
                    ->badge()
                    ->separator(',')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('created_at')
                    ->label('Data')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pendente',
                        'completed' => 'Concluída',
                        'cancelled' => 'Cancelada',
                    ]),
                SelectFilter::make('payment_method')
                    ->label('Pagamento')
                    ->options([
                        'cash' => 'Dinheiro',
                        'card' => 'Cartão',
                        'pix' => 'PIX',
                        'installments' => 'Parcelado',
                    ]),
                SelectFilter::make('categories')
                    ->label('Etiquetas')
                    ->relationship('categories', 'name')
                    ->searchable()
                    ->multiple()
                    ->preload(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                Action::make('generate_commission')
                    ->label('Gerar Comissão')
                    ->icon('heroicon-o-currency-dollar')
                    ->color('success')
                    ->visible(fn (Sale $record): bool => ! $record->hasCommission() && $record->status === 'completed')
                    ->requiresConfirmation()
                    ->modalHeading('Gerar Comissão')
                    ->modalDescription(fn (Sale $record): string => "Gerar comissão para o vendedor {$record->user?->name} no valor total de R$ ".number_format($record->total, 2, ',', '.'))
                    ->modalSubmitActionLabel('Gerar Comissão')
                    ->action(function (Sale $record): void {
                        // Verificar se tem vendedor
                        if (! $record->user_id) {
                            Notification::make()
                                ->danger()
                                ->title('Erro ao gerar comissão')
                                ->body('A venda não possui um vendedor responsável.')
                                ->send();

                            return;
                        }

                        // Verificar se o vendedor tem porcentagem de comissão
                        $user = $record->user;
                        if (! $user || $user->commission_percentage <= 0) {
                            Notification::make()
                                ->danger()
                                ->title('Erro ao gerar comissão')
                                ->body('O vendedor não possui porcentagem de comissão configurada.')
                                ->send();

                            return;
                        }

                        // Verificar se o total é maior que zero
                        if ($record->total <= 0) {
                            Notification::make()
                                ->danger()
                                ->title('Erro ao gerar comissão')
                                ->body('O valor total da venda deve ser maior que zero.')
                                ->send();

                            return;
                        }

                        // Gerar comissão
                        $commissionAmount = ($record->total * $user->commission_percentage) / 100;

                        Commission::query()->create([
                            'tenant_id' => $record->tenant_id,
                            'user_id' => $record->user_id,
                            'sale_id' => $record->id,
                            'type' => 'sale',
                            'commission_percentage' => $user->commission_percentage,
                            'base_value' => $record->total,
                            'commission_amount' => $commissionAmount,
                            'status' => CommissionStatusEnum::PENDING,
                        ]);

                        Notification::make()
                            ->success()
                            ->title('Comissão gerada com sucesso!')
                            ->body('Comissão de R$ '.number_format($commissionAmount, 2, ',', '.')." ({$user->commission_percentage}%) gerada para {$user->name}.")
                            ->send();
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->striped()
            ->emptyStateIcon('heroicon-o-shopping-cart')
            ->emptyStateHeading('Nenhuma venda encontrada')
            ->emptyStateDescription('Crie uma nova venda para começar.')
            ->emptyStateActions([
                Action::make('create')
                    ->label('Nova Venda')
                    ->icon('heroicon-m-plus')
                    ->url('sales/create'),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
