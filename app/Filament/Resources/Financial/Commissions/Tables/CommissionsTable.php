<?php

declare(strict_types=1);

namespace App\Filament\Resources\Financial\Commissions\Tables;

use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use App\Enum\Commission\CommissionStatusEnum;
use App\Filament\Resources\Services\ServiceOrders\ServiceOrderResource;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

final class CommissionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('serviceOrder.number')
                    ->label('Ordem de Serviço')
                    ->searchable()
                    ->sortable()
                    ->url(fn ($record) => $record->service_order ? ServiceOrderResource::getUrl('view', ['record' => $record->service_order]) : null)
                    ->color('primary'),
                TextColumn::make('user.name')
                    ->label('Responsável')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('labor_value_base')
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
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        CommissionStatusEnum::PENDING->value => 'Pendente',
                        CommissionStatusEnum::PAID->value => 'Pago',
                    ])
                    ->native(false),
                SelectFilter::make('user_id')
                    ->label('Técnico')
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
