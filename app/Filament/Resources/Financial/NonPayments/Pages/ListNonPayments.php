<?php

declare(strict_types=1);

namespace App\Filament\Resources\Financial\NonPayments\Pages;

use App\Filament\Resources\Financial\NonPayments\NonPaymentResource;
use App\Models\Accounts\AccountsInstallments;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

final class ListNonPayments extends ListRecords
{
    protected static string $resource = NonPaymentResource::class;

    public function getTabs(): array
    {
        return [
            'critical' => Tab::make()
                ->label('Crítico (>90 dias)')
                ->badge(fn () => $this->getCriticalOverdueCount())
                ->badgeColor('danger')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('due_date', '<=', now()->subDays(90))),
            'overdue' => Tab::make()
                ->label('Vencidas (30-90 dias)')
                ->badge(fn () => $this->getOverdueCount())
                ->badgeColor('warning')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereBetween('due_date', [now()->subDays(90), now()->subDays(30)])),
            'recent' => Tab::make()
                ->label('Recentes (<30 dias)')
                ->badge(fn () => $this->getRecentOverdueCount())
                ->badgeColor('info')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereBetween('due_date', [now()->subDays(30), now()])),
            'all' => Tab::make()
                ->label('Todas')
                // ->badge(fn () => $this->getAllOverdueCount())
                ->badgeColor('gray'),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('export_overdue')
                ->label('Exportar Relatório')
                ->icon('heroicon-o-document-arrow-down')
                ->color('gray')
                ->action(function (): void {
                    // Implementar exportação de relatório de inadimplência
                }),
            Action::make('send_bulk_reminders')
                ->label('Enviar Lembretes')
                ->icon('heroicon-o-envelope')
                ->color('warning')
                ->requiresConfirmation()
                ->modalHeading('Enviar Lembretes em Lote')
                ->modalDescription('Enviar lembretes de pagamento para todos os clientes inadimplentes?')
                ->action(function (): void {}),
        ];
    }

    private function getCriticalOverdueCount(): int
    {
        return AccountsInstallments::query()
            ->where('status', 0)
            ->where('due_date', '<=', now()->subDays(90))
            ->whereHas('accounts', function ($query): void {
                $query->where('type', 'receivables');
            })
            ->count();
    }

    private function getOverdueCount(): int
    {
        return AccountsInstallments::query()
            ->where('status', 0)
            ->whereBetween('due_date', [now()->subDays(90), now()->subDays(30)])
            ->whereHas('accounts', function ($query): void {
                $query->where('type', 'receivables');
            })
            ->count();
    }

    private function getRecentOverdueCount(): int
    {
        return AccountsInstallments::query()
            ->where('status', 0)
            ->whereBetween('due_date', [now()->subDays(30), now()])
            ->whereHas('accounts', function ($query): void {
                $query->where('type', 'receivables');
            })
            ->count();
    }

    private function getAllOverdueCount(): int
    {
        return AccountsInstallments::query()
            ->where('status', 0)
            ->where('due_date', '<=', now())
            ->whereHas('accounts', function ($query): void {
                $query->where('type', 'receivables');
            })
            ->count();
    }
}
