<?php

namespace App\Filament\Resources\Financial\AccountsPayables\Tables;

use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use App\Models\Accounts\AccountsInstallments;
use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class AccountsPayablesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->query(AccountsInstallments::query()->whereHas('accounts', fn ($q) => $q->where('type', 'payables')))
            ->columns([
                TextColumn::make('accounts.person.name')
                    ->label('Fornecedor')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('installment_number')
                    ->label('Parcela')
                    ->formatStateUsing(function ($state, $record) {
                        $accounts = $record->accounts;
                        if (! $accounts) {
                            return $state;
                        }

                        return Str::of($state)->padLeft(2, '0').'/'.Str::of($accounts->parcels)->padLeft(2, '0');
                    })
                    ->badge()
                    ->color('info')
                    ->sortable(),
                TextColumn::make('amount')
                    ->label('Valor')
                    ->money('BRL')
                    ->weight('bold')
                    ->color('success')
                    ->sortable()
                    ->summarize([
                        Sum::make()->label('Total a pagar')->money('BRL'),
                    ]),
                TextColumn::make('due_date')
                    ->label('Vencimento')
                    ->date('d/m/Y')
                    ->sortable()
                    ->color(fn ($record) => $record->due_date->isPast() && ! $record->status->value ? 'danger' : 'gray')
                    ->weight(fn ($record) => $record->due_date->isPast() && ! $record->status->value ? 'bold' : 'normal')
                    ->icon(fn ($record) => $record->due_date->isPast() && ! $record->status->value ? 'heroicon-o-exclamation-triangle' : 'heroicon-o-calendar'),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(function ($state, $record) {
                        if ($state->value) {
                            return 'Recebido';
                        }
                        if ($record->due_date->isPast()) {
                            return 'Vencido';
                        }

                        return 'Pendente';
                    })
                    ->colors([
                        'success' => fn ($state) => $state->value,
                        'danger' => fn ($state, $record) => ! $state->value && $record->due_date->isPast(),
                        'warning' => fn ($state, $record) => ! $state->value && ! $record->due_date->isPast(),
                    ])
                    ->icons([
                        'heroicon-o-check-circle' => fn ($state) => $state->value,
                        'heroicon-o-exclamation-triangle' => fn ($state, $record) => ! $state->value && $record->due_date->isPast(),
                        'heroicon-o-clock' => fn ($state, $record) => ! $state->value && ! $record->due_date->isPast(),
                    ])
                    ->sortable(),
                TextColumn::make('accounts.payment_method')
                    ->label('Forma de Pagamento')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state?->getLabel() ?? $state)
                    ->color(fn ($state) => $state?->getColor() ?? 'gray')
                    ->icon(fn ($state) => $state?->getIcon() ?? 'heroicon-o-credit-card')
                    ->sortable(),
                TextColumn::make('accounts.reference_number')
                    ->label('Referência')
                    ->searchable()
                    ->sortable()
                    ->placeholder('—'),
                TextColumn::make('accounts.category')
                    ->label('Categoria')
                    ->badge()
                    ->color('gray')
                    ->searchable()
                    ->sortable()
                    ->placeholder('—'),
                TextColumn::make('paid_at')
                    ->label('Recebido em')
                    ->date('d/m/Y H:i')
                    ->sortable()
                    ->placeholder('—'),
            ])
            ->filters([
                Filter::make('month')
                    ->label('Mês de Referência')
                    ->form([
                        TextInput::make('month')
                            ->label('Mês de referência')
                            ->placeholder('Selecione o mês')
                            ->prefixIcon('heroicon-m-calendar')
                            ->type('month')
                            ->default(Carbon::now()->format('Y-m'))
                            ->required()
                            ->reactive(),
                    ])
                    ->query(function ($query, array $data): void {
                        if (filled($data['month'])) {
                            $carbon = Carbon::parse($data['month']);
                            $month = $carbon->month;
                            $year = $carbon->year;
                            $query->whereMonth('due_date', $month)->whereYear('due_date', $year);
                        }
                    }),
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        0 => 'Pendente',
                        1 => 'Recebido',
                    ])
                    ->query(function ($query, array $data): void {
                        if (filled($data['value'])) {
                            $query->where('status', $data['value']);
                        }
                    }),
                Filter::make('overdue')
                    ->label('Vencidas')
                    ->query(function ($query): void {
                        $query->where('due_date', '<', now())
                            ->where('status', 0);
                    })
                    ->toggle(),
                Filter::make('due_today')
                    ->label('Vence Hoje')
                    ->query(function ($query): void {
                        $query->whereDate('due_date', now())
                            ->where('status', 0);
                    })
                    ->toggle(),
            ])
            ->filtersTriggerAction(
                fn (Action $action) => $action
                    ->button()
                    ->label('Filtros')
                    ->icon('heroicon-o-funnel')
            )
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                Action::make('mark_as_received')
                    ->label('Marcar como Recebido')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn ($record) => ! $record->status->value)
                    ->requiresConfirmation()
                    ->action(function ($record): void {
                        $record->update([
                            'status' => 1,
                            'paid_at' => now(),
                        ]);
                    }),
                Action::make('mark_as_pending')
                    ->label('Marcar como Pendente')
                    ->icon('heroicon-o-x-circle')
                    ->color('warning')
                    ->visible(fn ($record) => $record->status->value)
                    ->requiresConfirmation()
                    ->action(function ($record): void {
                        $record->update([
                            'status' => 0,
                            'paid_at' => null,
                        ]);
                    }),
            ])
            ->groups([
                Group::make('Status')->collapsible(),
                Group::make('accounts.category')->label('Categoria')->collapsible(),
                Group::make('accounts.payment_method')->label('Forma de Pagamento')->collapsible(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    Action::make('mark_all_received')
                        ->label('Marcar como Recebido')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->requiresConfirmation()
                        ->action(function ($records): void {
                            $records->each(function ($record): void {
                                $record->update([
                                    'status' => 1,
                                    'paid_at' => now(),
                                ]);
                            });
                        }),
                    Action::make('mark_all_pending')
                        ->label('Marcar como Pendente')
                        ->icon('heroicon-o-x-circle')
                        ->color('warning')
                        ->requiresConfirmation()
                        ->action(function ($records): void {
                            $records->each(function ($record): void {
                                $record->update([
                                    'status' => 0,
                                    'paid_at' => null,
                                ]);
                            });
                        }),
                    DeleteBulkAction::make(),
                ]),
                FilamentExportBulkAction::make('export')->label('Exportar'),
            ])
            ->striped()
            ->emptyStateIcon('heroicon-o-arrow-down-circle')
            ->emptyStateHeading('Nenhuma conta a pagar encontrada')
            ->emptyStateDescription('Crie uma nova conta a pagar para começar.')
            ->emptyStateActions([
                Action::make('create')
                    ->label('Criar nova conta a pagar')
                    ->icon('heroicon-m-plus')
                    ->url('accounts-payable/create'),
            ])
            ->recordUrl(function ($record) {
                return 'accounts-payable/'.$record->accounts->id.'/edit';
            })
            ->defaultSort('due_date');
    }
}
