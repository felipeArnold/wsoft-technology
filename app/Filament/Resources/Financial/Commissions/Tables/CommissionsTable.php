<?php

declare(strict_types=1);

namespace App\Filament\Resources\Financial\Commissions\Tables;

use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use App\Enum\Commission\CommissionStatusEnum;
use App\Filament\Resources\Financial\Sales\SaleResource;
use App\Filament\Resources\Services\ServiceOrders\ServiceOrderResource;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

final class CommissionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('type')
                    ->label('Tipo')
                    ->badge()
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'service_order' => 'Ordem de Serviço',
                        'sale' => 'Venda',
                        default => $state,
                    })
                    ->color(fn ($state) => match ($state) {
                        'service_order' => 'info',
                        'sale' => 'success',
                        default => 'gray',
                    })
                    ->icon(fn ($state) => match ($state) {
                        'service_order' => 'heroicon-o-wrench-screwdriver',
                        'sale' => 'heroicon-o-shopping-cart',
                        default => null,
                    })
                    ->sortable(),
                TextColumn::make('serviceOrder.number')
                    ->label('OS')
                    ->searchable()
                    ->sortable()
                    ->url(fn ($record) => $record->service_order_id ? ServiceOrderResource::getUrl('view', ['record' => $record->service_order_id]) : null)
                    ->color('primary')
                    ->placeholder('—')
                    ->toggleable(),
                TextColumn::make('sale.sale_number')
                    ->label('Venda')
                    ->searchable()
                    ->sortable()
                    ->url(fn ($record) => $record->sale_id ? SaleResource::getUrl('view', ['record' => $record->sale_id]) : null)
                    ->color('primary')
                    ->placeholder('—')
                    ->toggleable(),
                TextColumn::make('user.name')
                    ->label('Responsável')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('base_value')
                    ->label('Valor Base')
                    ->money('BRL')
                    ->sortable(),
                TextColumn::make('commission_percentage')
                    ->label('Percentual')
                    ->formatStateUsing(fn ($state) => number_format((float) $state, 2, ',', '.').'%')
                    ->sortable(),
                TextColumn::make('commission_amount')
                    ->label('Valor da Comissão')
                    ->money('BRL')
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->sortable(),
                TextColumn::make('paid_at')
                    ->label('Data de Pagamento')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('paidBy.name')
                    ->label('Pago Por')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->groups([
                Group::make('status')->label('Status')->collapsible(),
                Group::make('user.name')->label('Responsável')->collapsible(),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->label('Tipo')
                    ->options([
                        'service_order' => 'Ordem de Serviço',
                        'sale' => 'Venda',
                    ])
                    ->native(false),
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        CommissionStatusEnum::PENDING->value => 'Pendente',
                        CommissionStatusEnum::PAID->value => 'Pago',
                    ])
                    ->native(false),
                SelectFilter::make('user_id')
                    ->label('Responsável')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->native(false),
                Filter::make('created_at')
                    ->label('Período de Criação')
                    ->form([
                        DatePicker::make('created_from')
                            ->label('Período de Criação')
                            ->native(false),
                        DatePicker::make('created_until')
                            ->label('Até')
                            ->native(false),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
                Filter::make('paid_at')
                    ->label('Período de Pagamento')
                    ->form([
                        DatePicker::make('paid_from')
                            ->label('Período de Pagamento')
                            ->native(false),
                        DatePicker::make('paid_until')
                            ->label('Até')
                            ->native(false),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['paid_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('paid_at', '>=', $date),
                            )
                            ->when(
                                $data['paid_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('paid_at', '<=', $date),
                            );
                    }),
            ], layout: FiltersLayout::AboveContentCollapsible)
            ->defaultSort('created_at', 'desc')
            ->paginated([10, 25, 50, 100])
            ->recordActions([
                ViewAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    BulkAction::make('markAsPaid')
                        ->label('Marcar como Pago')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->requiresConfirmation()
                        ->modalHeading('Marcar comissões como pagas')
                        ->modalDescription('Tem certeza que deseja marcar as comissões selecionadas como pagas?')
                        ->modalSubmitActionLabel('Sim, marcar como pagas')
                        ->action(function (Collection $records) {
                            $user = Auth::user();
                            $count = 0;

                            foreach ($records as $record) {
                                if ($record->isPending()) {
                                    $record->markAsPaid($user);
                                    $count++;
                                }
                            }

                            Notification::make()
                                ->title("{$count} comissões marcadas como pagas")
                                ->success()
                                ->send();
                        }),
                    BulkAction::make('markAsPending')
                        ->label('Marcar como Pendente')
                        ->icon('heroicon-o-clock')
                        ->color('warning')
                        ->requiresConfirmation()
                        ->modalHeading('Marcar comissões como pendentes')
                        ->modalDescription('Tem certeza que deseja reverter o pagamento das comissões selecionadas?')
                        ->modalSubmitActionLabel('Sim, marcar como pendentes')
                        ->action(function (Collection $records) {
                            $count = 0;

                            foreach ($records as $record) {
                                if ($record->isPaid()) {
                                    $record->markAsPending();
                                    $count++;
                                }
                            }

                            Notification::make()
                                ->title("{$count} comissões revertidas para pendente")
                                ->warning()
                                ->send();
                        }),
                    DeleteBulkAction::make(),
                ]),
                FilamentExportBulkAction::make('export')->label('Exportar'),
            ])
            ->striped()
            ->emptyStateIcon('heroicon-o-inbox')
            ->emptyStateHeading('Nenhum registro encontrado')
            ->emptyStateDescription('Não há comissões para exibir no momento.');
    }
}
