<?php

declare(strict_types=1);

namespace App\Filament\Resources\Financial\Extracts\Pages;

use App\Filament\Resources\Financial\Extracts\ExtractResource;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Support\Colors\Color;
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
                ->label('Exportar Extrato PDF')
                ->icon('heroicon-o-document-arrow-down')
                ->color(Color::Gray)
                ->action(function (): \Symfony\Component\HttpFoundation\Response {
                    $tenant = Filament::getTenant();

                    // Obtém os dados filtrados da tabela
                    $query = \App\Models\Accounts\AccountsInstallments::query()
                        ->with(['accounts.person', 'accounts.user'])
                        ->where('tenant_id', Filament::getTenant()->id);

                    // Aplica o filtro da aba ativa se existir
                    $activeTab = $this->activeTab ?? 'all';

                    if ($activeTab === 'receivables') {
                        $query->whereHas('accounts', fn (Builder $q) => $q->where('type', 'receivables'));
                    } elseif ($activeTab === 'payables') {
                        $query->whereHas('accounts', fn (Builder $q) => $q->where('type', 'payables'));
                    } elseif ($activeTab === 'paid') {
                        $query->where('status', 1);
                    } elseif ($activeTab === 'pending') {
                        $query->where('status', 0)->where('due_date', '>=', now());
                    } elseif ($activeTab === 'overdue') {
                        $query->where('status', 0)->where('due_date', '<', now());
                    }

                    $installments = $query->orderBy('due_date', 'asc')->get();

                    // Calcula totalizadores
                    $totalReceivables = $installments->filter(fn ($i) => $i->accounts->type === 'receivables')->sum('amount');
                    $totalPayables = $installments->filter(fn ($i) => $i->accounts->type === 'payables')->sum('amount');
                    $totalPaid = $installments->where('status', 1)->sum('amount');
                    $totalPending = $installments->where('status', 0)->sum('amount');

                    $pdf = Pdf::loadView('pdf.extract', [
                        'tenant' => $tenant,
                        'installments' => $installments,
                        'activeTab' => $activeTab,
                        'totalReceivables' => $totalReceivables,
                        'totalPayables' => $totalPayables,
                        'totalPaid' => $totalPaid,
                        'totalPending' => $totalPending,
                    ])
                        ->setPaper('a4', 'landscape')
                        ->setOption('margin-top', 10)
                        ->setOption('margin-bottom', 10)
                        ->setOption('margin-left', 10)
                        ->setOption('margin-right', 10);

                    return response()->streamDownload(
                        fn () => print ($pdf->output()),
                        'extrato-financeiro-'.now()->format('Y-m-d').'.pdf'
                    );
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
