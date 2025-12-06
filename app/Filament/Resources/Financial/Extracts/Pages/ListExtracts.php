<?php

declare(strict_types=1);

namespace App\Filament\Resources\Financial\Extracts\Pages;

use App\Filament\Resources\Financial\Extracts\ExtractResource;
use App\Models\Accounts\AccountsInstallments;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms\Components\DatePicker;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Support\Colors\Color;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\HttpFoundation\Response;

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
                ->action(function (): Response {
                    $tenant = Filament::getTenant();

                    // Obtém a query filtrada da tabela respeitando todos os filtros aplicados
                    $query = $this->getFilteredTableQuery()
                        ->with(['accounts.person', 'accounts.user']);

                    $installments = $query->orderBy('due_date', 'asc')->get();

                    // Calcula totalizadores
                    $totalReceivables = $installments->filter(fn ($i) => $i->accounts->type === 'receivables')->sum('amount');
                    $totalPayables = $installments->filter(fn ($i) => $i->accounts->type === 'payables')->sum('amount');
                    $totalPaid = $installments->where('status', 1)->sum('amount');
                    $totalPending = $installments->where('status', 0)->sum('amount');

                    $pdf = Pdf::loadView('pdf.extract', [
                        'tenant' => $tenant,
                        'installments' => $installments,
                        'activeTab' => $this->activeTab ?? 'all',
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
                ->form([
                    Section::make('Período do Relatório')
                        ->description('Selecione o período para o qual deseja gerar o relatório financeiro.')
                        ->icon('heroicon-o-calendar')
                        ->schema([
                            DatePicker::make('start_date')
                                ->label('Data Inicial')
                                ->default(now()->startOfMonth())
                                ->required(),
                            DatePicker::make('end_date')
                                ->label('Data Final')
                                ->default(now()->endOfMonth())
                                ->required(),
                        ])
                        ->columns(2),
                ])
                ->action(function (array $data): Response {
                    $tenant = Filament::getTenant();
                    $startDate = Carbon::parse($data['start_date'])->startOfDay();
                    $endDate = Carbon::parse($data['end_date'])->endOfDay();

                    // Query base com filtro de período
                    $query = AccountsInstallments::query()
                        ->with(['accounts.person', 'accounts.user'])
                        ->where('tenant_id', $tenant->id)
                        ->whereBetween('due_date', [$startDate, $endDate]);

                    $installments = $query->get();

                    // Cálculos principais
                    $totalReceivables = $installments->filter(fn ($i) => $i->accounts->type === 'receivables')->sum('amount');
                    $totalPayables = $installments->filter(fn ($i) => $i->accounts->type === 'payables')->sum('amount');
                    $balance = $totalReceivables - $totalPayables;

                    $receivablesCount = $installments->filter(fn ($i) => $i->accounts->type === 'receivables')->count();
                    $payablesCount = $installments->filter(fn ($i) => $i->accounts->type === 'payables')->count();

                    // Indicadores financeiros
                    $totalPaid = $installments->where('status', 1)->sum('amount');
                    $totalPending = $installments->where('status', 0)->where('due_date', '>=', now())->sum('amount');
                    $totalOverdue = $installments->where('status', 0)->where('due_date', '<', now())->sum('amount');

                    $total = $installments->sum('amount');
                    $paymentRate = $total > 0 ? ($totalPaid / $total) * 100 : 0;
                    $overdueRate = $total > 0 ? ($totalOverdue / $total) * 100 : 0;
                    $averageTicket = $installments->count() > 0 ? $total / $installments->count() : 0;

                    // Top Clientes (Receitas)
                    $topReceivables = $installments
                        ->filter(fn ($i) => $i->accounts->type === 'receivables' && $i->accounts->person)
                        ->groupBy('accounts.person.id')
                        ->map(function ($group) {
                            return (object) [
                                'person_name' => $group->first()->accounts->person->name,
                                'total' => $group->sum('amount'),
                            ];
                        })
                        ->sortByDesc('total')
                        ->take(5)
                        ->values();

                    // Top Fornecedores (Despesas)
                    $topPayables = $installments
                        ->filter(fn ($i) => $i->accounts->type === 'payables' && $i->accounts->person)
                        ->groupBy('accounts.person.id')
                        ->map(function ($group) {
                            return (object) [
                                'person_name' => $group->first()->accounts->person->name,
                                'total' => $group->sum('amount'),
                            ];
                        })
                        ->sortByDesc('total')
                        ->take(5)
                        ->values();

                    // Análise por Categoria
                    $byCategory = $installments
                        ->groupBy(function ($item) {
                            return ($item->accounts->category ?? 'Sem Categoria').'_'.$item->accounts->type;
                        })
                        ->map(function ($group) {
                            return (object) [
                                'category' => $group->first()->accounts->category,
                                'type' => $group->first()->accounts->type,
                                'total' => $group->sum('amount'),
                                'count' => $group->count(),
                            ];
                        })
                        ->sortByDesc('total')
                        ->values();

                    // Fluxo Mensal
                    $monthlyFlow = $installments
                        ->groupBy(function ($item) {
                            return $item->due_date->format('Y-m');
                        })
                        ->map(function ($group, $key) {
                            $date = Carbon::parse($key.'-01');
                            return (object) [
                                'month_name' => ucfirst($date->translatedFormat('F/Y')),
                                'receivables' => $group->filter(fn ($i) => $i->accounts->type === 'receivables')->sum('amount'),
                                'payables' => $group->filter(fn ($i) => $i->accounts->type === 'payables')->sum('amount'),
                            ];
                        })
                        ->sortKeys()
                        ->values();

                    $pdf = Pdf::loadView('pdf.financial-report', [
                        'tenant' => $tenant,
                        'startDate' => $startDate,
                        'endDate' => $endDate,
                        'totalReceivables' => $totalReceivables,
                        'totalPayables' => $totalPayables,
                        'balance' => $balance,
                        'receivablesCount' => $receivablesCount,
                        'payablesCount' => $payablesCount,
                        'totalPaid' => $totalPaid,
                        'totalPending' => $totalPending,
                        'totalOverdue' => $totalOverdue,
                        'paymentRate' => $paymentRate,
                        'overdueRate' => $overdueRate,
                        'averageTicket' => $averageTicket,
                        'topReceivables' => $topReceivables,
                        'topPayables' => $topPayables,
                        'byCategory' => $byCategory,
                        'monthlyFlow' => $monthlyFlow,
                    ])
                        ->setPaper('a4', 'landscape')
                        ->setOption('margin-top', 10)
                        ->setOption('margin-bottom', 10)
                        ->setOption('margin-left', 10)
                        ->setOption('margin-right', 10);

                    return response()->streamDownload(
                        fn () => print ($pdf->output()),
                        'relatorio-financeiro-'.now()->format('Y-m-d').'.pdf'
                    );
                }),
        ];
    }

    private function getReceivablesCount(): int
    {
        return AccountsInstallments::query()
            ->whereHas('accounts', function ($query): void {
                $query->where('type', 'receivables');
            })
            ->count();
    }

    private function getPayablesCount(): int
    {
        return AccountsInstallments::query()
            ->whereHas('accounts', function ($query): void {
                $query->where('type', 'payables');
            })
            ->count();
    }

    private function getPaidCount(): int
    {
        return AccountsInstallments::query()
            ->where('status', 1)
            ->count();
    }

    private function getPendingCount(): int
    {
        return AccountsInstallments::query()
            ->where('status', 0)
            ->where('due_date', '>=', now())
            ->count();
    }

    private function getOverdueCount(): int
    {
        return AccountsInstallments::query()
            ->where('status', 0)
            ->where('due_date', '<', now())
            ->count();
    }

    private function getAllCount(): int
    {
        return AccountsInstallments::query()->count();
    }
}
