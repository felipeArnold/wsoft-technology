<?php

declare(strict_types=1);

namespace App\Filament\Resources\Financial\NonPayments\Tables;

use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use App\Helpers\FormatterHelper;
use App\Models\Accounts\AccountsInstallments;
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

final class NonPaymentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->query(AccountsInstallments::query()
                ->where('status', 0)
                ->where('due_date', '<=', now())
                ->whereHas('accounts', function ($query): void {
                    $query->where('type', 'receivables');
                })
                ->orderBy('due_date')
            )
            ->columns([
                TextColumn::make('accounts.person.name')
                    ->label('Cliente')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
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
                    ->color('danger')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('amount')
                    ->label('Valor')
                    ->money('BRL')
                    ->color('danger')
                    ->toggleable()
                    ->summarize([
                        Sum::make()->label('Total Inadimplente')
                            ->formatStateUsing(fn ($state) => FormatterHelper::money($state, true)),
                    ]),
                TextColumn::make('due_date')
                    ->label('Vencimento')
                    ->date('d/m/Y')
                    ->sortable()
                    ->toggleable()
                    ->color('danger')
                    ->tooltip(function ($record) {
                        $daysOverdue = (int) $record->due_date->diffInDays(now());

                        return "{$daysOverdue} dias em atraso";
                    }),
                TextColumn::make('accounts.payment_method')
                    ->label('Pagamento')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state?->getLabel() ?? $state)
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('accounts.reference_number')
                    ->label('Referência')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('accounts.category')
                    ->label('Categoria')
                    ->badge()
                    ->color('gray')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('accounts.user.name')
                    ->label('Responsável')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('accounts.created_at')
                    ->label('Criado em')
                    ->date('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Filter::make('overdue_days')
                    ->label('Dias em Atraso')
                    ->form([
                        TextInput::make('min_days')
                            ->label('Mínimo de dias')
                            ->numeric()
                            ->placeholder('Ex: 30')
                            ->prefixIcon('heroicon-m-calendar'),
                        TextInput::make('max_days')
                            ->label('Máximo de dias')
                            ->numeric()
                            ->placeholder('Ex: 90')
                            ->prefixIcon('heroicon-m-calendar'),
                    ])
                    ->query(function ($query, array $data): void {
                        if (filled($data['min_days'])) {
                            $minDate = now()->subDays($data['min_days']);
                            $query->where('due_date', '<=', $minDate);
                        }
                        if (filled($data['max_days'])) {
                            $maxDate = now()->subDays($data['max_days']);
                            $query->where('due_date', '>=', $maxDate);
                        }
                    }),
                SelectFilter::make('payment_method')
                    ->label('Forma de Pagamento')
                    ->relationship('accounts', 'payment_method')
                    ->searchable()
                    ->placeholder('Selecione a forma de pagamento'),
                SelectFilter::make('responsible')
                    ->label('Responsável')
                    ->relationship('accounts.user', 'name')
                    ->searchable()
                    ->placeholder('Selecione o responsável'),
                Filter::make('critical_overdue')
                    ->label('Crítico (>90 dias)')
                    ->query(function ($query): void {
                        $criticalDate = now()->subDays(90);
                        $query->where('due_date', '<=', $criticalDate);
                    })
                    ->toggle(),
            ])
            ->filtersTriggerAction(
                fn (Action $action) => $action
                    ->button()
                    ->label('Filtros')
                    ->icon('heroicon-o-funnel')
            )
            ->groups([
                Group::make('accounts.user.name')->label('Responsável')->collapsible(),
                Group::make('accounts.payment_method')->label('Forma de Pagamento')->collapsible(),
                Group::make('due_date')->label('Mês de Vencimento')->collapsible(),
            ])
            ->recordActions([
                ViewAction::make()->hiddenLabel()->tooltip('Visualizar Detalhes'),
                EditAction::make()->hiddenLabel()->tooltip('Editar Parcela'),
                Action::make('mark_as_paid')
                    ->hiddenLabel()
                    ->tooltip('Marcar como Pago')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Confirmar Pagamento')
                    ->modalDescription('Tem certeza que deseja marcar esta parcela como paga?')
                    ->action(function ($record): void {
                        $record->update([
                            'status' => 1,
                            'paid_at' => now(),
                        ]);
                    }),
                Action::make('send_reminder')
                    ->hiddenLabel()
                    ->tooltip('Enviar Lembrete')
                    ->icon('heroicon-o-envelope')
                    ->color('warning')
                    ->requiresConfirmation()
                    ->modalHeading('Enviar Lembrete')
                    ->modalDescription('Enviar lembrete de pagamento para o cliente?')
                    ->action(function ($record): void {}),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    Action::make('mark_all_paid')
                        ->label('Marcar como Pago')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->requiresConfirmation()
                        ->modalHeading('Confirmar Pagamento em Lote')
                        ->modalDescription('Tem certeza que deseja marcar todas as parcelas selecionadas como pagas?')
                        ->action(function ($records): void {
                            $records->each(function ($record): void {
                                $record->update([
                                    'status' => 1,
                                    'paid_at' => now(),
                                ]);
                            });
                        }),
                    Action::make('send_bulk_reminders')
                        ->label('Enviar Lembretes')
                        ->icon('heroicon-o-envelope')
                        ->color('warning')
                        ->requiresConfirmation()
                        ->modalHeading('Enviar Lembretes em Lote')
                        ->modalDescription('Enviar lembretes de pagamento para todos os clientes selecionados?')
                        ->action(function ($records): void {
                            // Implementar envio de lembretes em lote
                        }),
                    DeleteBulkAction::make(),
                ]),
                FilamentExportBulkAction::make('export')->label('Exportar'),
            ])
            ->striped()
            ->emptyStateIcon('heroicon-o-exclamation-triangle')
            ->emptyStateHeading('Nenhuma inadimplência encontrada')
            ->emptyStateDescription('Parabéns! Você não possui contas em atraso no momento.')
            ->emptyStateActions([
                Action::make('view_all_accounts')
                    ->label('Ver todas as contas')
                    ->icon('heroicon-m-currency-dollar')
                    ->url('/accounts-receivables'),
            ])
            ->defaultPaginationPageOption(100)
            ->paginationPageOptions([10, 25, 50, 100, 250, 'all']);
    }
}
