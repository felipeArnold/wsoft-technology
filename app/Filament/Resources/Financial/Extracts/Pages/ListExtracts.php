<?php

declare(strict_types=1);

namespace App\Filament\Resources\Financial\Extracts\Pages;

use App\Filament\Resources\Financial\Extracts\ExtractResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

final class ListExtracts extends ListRecords
{
    protected static string $resource = ExtractResource::class;

    public function getTabs(): array
    {
        return [
            'receivables' => Tab::make()
                ->label('Receitas')
                ->badge(fn () => $this->getReceivablesCount())
                ->badgeColor('success')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereHas('accounts', fn (Builder $q) => $q->where('type', 'receivables'))),
            'payables' => Tab::make()
                ->label('Despesas')
                ->badge(fn () => $this->getPayablesCount())
                ->badgeColor('danger')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereHas('accounts', fn (Builder $q) => $q->where('type', 'payables'))),
            'paid' => Tab::make()
                ->label('Pagas')
                ->badge(fn () => $this->getPaidCount())
                ->badgeColor('success')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 1)),
            'pending' => Tab::make()
                ->label('Pendentes')
                ->badge(fn () => $this->getPendingCount())
                ->badgeColor('warning')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 0)->where('due_date', '>=', now())),
            'overdue' => Tab::make()
                ->label('Vencidas')
                ->badge(fn () => $this->getOverdueCount())
                ->badgeColor('danger')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 0)->where('due_date', '<', now())),
            'all' => Tab::make()
                ->label('Todas')
                ->badge(fn () => $this->getAllCount())
                ->badgeColor('gray'),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('export_extract')
                ->label('Exportar Extrato')
                ->icon('heroicon-o-document-arrow-down')
                ->color('gray')
                ->action(function (): void {
                    // Implementar exportação de extrato
                }),
            Action::make('generate_report')
                ->label('Gerar Relatório')
                ->icon('heroicon-o-chart-bar')
                ->color('primary')
                ->action(function (): void {
                    // Implementar geração de relatório
                }),
        ];
    }

    private function getReceivablesCount(): int
    {
        return \App\Models\Accounts\AccountsInstallments::query()
            ->whereHas('accounts', function ($query): void {
                $query->where('type', 'receivables');
            })
            ->count();
    }

    private function getPayablesCount(): int
    {
        return \App\Models\Accounts\AccountsInstallments::query()
            ->whereHas('accounts', function ($query): void {
                $query->where('type', 'payables');
            })
            ->count();
    }

    private function getPaidCount(): int
    {
        return \App\Models\Accounts\AccountsInstallments::query()
            ->where('status', 1)
            ->count();
    }

    private function getPendingCount(): int
    {
        return \App\Models\Accounts\AccountsInstallments::query()
            ->where('status', 0)
            ->where('due_date', '>=', now())
            ->count();
    }

    private function getOverdueCount(): int
    {
        return \App\Models\Accounts\AccountsInstallments::query()
            ->where('status', 0)
            ->where('due_date', '<', now())
            ->count();
    }

    private function getAllCount(): int
    {
        return \App\Models\Accounts\AccountsInstallments::query()->count();
    }
}
