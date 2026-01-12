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
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
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
                ->label('Exportar Extrato')
                ->icon('heroicon-o-document-arrow-down')
                ->color('primary')
                ->modalHeading('Exportar Extrato Financeiro')
                ->modalDescription('Configure o período e o tipo de movimentação para exportar o extrato.')
                ->modalIcon('heroicon-o-document-chart-bar')
                ->modalWidth('md')
                ->form([
                    Section::make('Configurações do Extrato')
                        ->description('Personalize o extrato conforme sua necessidade')
                        ->icon('heroicon-o-adjustments-horizontal')
                        ->schema([
                            DatePicker::make('start_date')
                                ->label('Data Inicial')
                                ->helperText('Data de início do período')
                                ->default(now()->startOfMonth())
                                ->native(false)
                                ->displayFormat('d/m/Y')
                                ->maxDate(now())
                                ->required()
                                ->columnSpan(1),
                            DatePicker::make('end_date')
                                ->label('Data Final')
                                ->helperText('Data de término do período')
                                ->default(now())
                                ->native(false)
                                ->displayFormat('d/m/Y')
                                ->maxDate(now())
                                ->afterOrEqual('start_date')
                                ->required()
                                ->columnSpan(1),
                            Select::make('filter_type')
                                ->label('Tipo de Movimentação')
                                ->helperText('Filtre por tipo de movimentação')
                                ->options([
                                    'all' => 'Todas',
                                    'receivables' => 'Apenas Receitas',
                                    'payables' => 'Apenas Despesas',
                                ])
                                ->default('all')
                                ->native(false)
                                ->required()
                                ->columnSpan(1),
                            Select::make('filter_status')
                                ->label('Status de Pagamento')
                                ->helperText('Filtre por status de pagamento')
                                ->options([
                                    'all' => 'Todos',
                                    'paid' => 'Apenas Pagas',
                                    'pending' => 'Apenas Pendentes',
                                    'overdue' => 'Apenas Vencidas',
                                ])
                                ->default('all')
                                ->native(false)
                                ->required()
                                ->columnSpan(1),
                        ])
                        ->columns(1)
                        ->columnSpanFull(),

                    Section::make('Resumo da Seleção')
                        ->description('Prévia das movimentações que serão exportadas')
                        ->icon('heroicon-o-chart-bar')
                        ->schema([
                            Placeholder::make('preview_stats')
                                ->label('')
                                ->content(function ($get) {
                                    $startDate = $get('start_date') ? Carbon::parse($get('start_date'))->startOfDay() : now()->startOfMonth();
                                    $endDate = $get('end_date') ? Carbon::parse($get('end_date'))->endOfDay() : now()->endOfMonth();
                                    $filterType = $get('filter_type') ?? 'all';
                                    $filterStatus = $get('filter_status') ?? 'all';

                                    $query = AccountsInstallments::query()
                                        ->with(['accounts'])
                                        ->where('tenant_id', Filament::getTenant()->id)
                                        ->whereBetween('due_date', [$startDate, $endDate]);

                                    // Aplicar filtro de tipo
                                    if ($filterType !== 'all') {
                                        $query->whereHas('accounts', fn ($q) => $q->where('type', $filterType));
                                    }

                                    // Aplicar filtro de status
                                    if ($filterStatus === 'paid') {
                                        $query->where('status', 1);
                                    } elseif ($filterStatus === 'pending') {
                                        $query->where('status', 0)->where('due_date', '>=', now());
                                    } elseif ($filterStatus === 'overdue') {
                                        $query->where('status', 0)->where('due_date', '<', now());
                                    }

                                    $installments = $query->get();
                                    $totalReceivables = $installments->filter(fn ($i) => $i->accounts->type === 'receivables')->sum('amount');
                                    $totalPayables = $installments->filter(fn ($i) => $i->accounts->type === 'payables')->sum('amount');
                                    $balance = $totalReceivables - $totalPayables;
                                    $count = $installments->count();

                                    return new \Illuminate\Support\HtmlString("
                                        <div style='display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px; margin-top: 8px;'>
                                            <div style='background: #dbeafe; padding: 12px; border-radius: 6px; text-align: center;'>
                                                <div style='font-size: 11px; color: #1e40af; font-weight: 600; margin-bottom: 4px;'>MOVIMENTAÇÕES</div>
                                                <div style='font-size: 24px; font-weight: bold; color: #3b82f6;'>{$count}</div>
                                            </div>
                                            <div style='background: #dcfce7; padding: 12px; border-radius: 6px; text-align: center;'>
                                                <div style='font-size: 11px; color: #166534; font-weight: 600; margin-bottom: 4px;'>RECEITAS</div>
                                                <div style='font-size: 18px; font-weight: bold; color: #16a34a;'>R$ ".number_format($totalReceivables, 2, ',', '.')."</div>
                                            </div>
                                            <div style='background: #fee2e2; padding: 12px; border-radius: 6px; text-align: center;'>
                                                <div style='font-size: 11px; color: #991b1b; font-weight: 600; margin-bottom: 4px;'>DESPESAS</div>
                                                <div style='font-size: 18px; font-weight: bold; color: #dc2626;'>R$ ".number_format($totalPayables, 2, ',', '.')."</div>
                                            </div>
                                            <div style='background: ".($balance >= 0 ? '#dcfce7' : '#fee2e2')."; padding: 12px; border-radius: 6px; text-align: center;'>
                                                <div style='font-size: 11px; color: ".($balance >= 0 ? '#166534' : '#991b1b')."; font-weight: 600; margin-bottom: 4px;'>SALDO</div>
                                                <div style='font-size: 18px; font-weight: bold; color: ".($balance >= 0 ? '#16a34a' : '#dc2626').";'>R$ ".number_format($balance, 2, ',', '.')."</div>
                                            </div>
                                        </div>
                                    ");
                                })
                                ->columnSpanFull(),
                        ])
                        ->columnSpanFull()
                        ->collapsed(),
                ])
                ->action(function (array $data): Response {
                    $tenant = Filament::getTenant();
                    $startDate = Carbon::parse($data['start_date'])->startOfDay();
                    $endDate = Carbon::parse($data['end_date'])->endOfDay();
                    $filterType = $data['filter_type'];
                    $filterStatus = $data['filter_status'];

                    $query = AccountsInstallments::query()
                        ->with(['accounts.person', 'accounts.user'])
                        ->where('tenant_id', $tenant->id)
                        ->whereBetween('due_date', [$startDate, $endDate]);

                    // Aplicar filtros
                    if ($filterType !== 'all') {
                        $query->whereHas('accounts', fn ($q) => $q->where('type', $filterType));
                    }

                    if ($filterStatus === 'paid') {
                        $query->where('status', 1);
                    } elseif ($filterStatus === 'pending') {
                        $query->where('status', 0)->where('due_date', '>=', now());
                    } elseif ($filterStatus === 'overdue') {
                        $query->where('status', 0)->where('due_date', '<', now());
                    }

                    $installments = $query->orderBy('due_date', 'asc')->get();

                    // Calcula totalizadores
                    $totalReceivables = $installments->filter(fn ($i) => $i->accounts->type === 'receivables')->sum('amount');
                    $totalPayables = $installments->filter(fn ($i) => $i->accounts->type === 'payables')->sum('amount');
                    $totalPaid = $installments->where('status', 1)->sum('amount');
                    $totalPending = $installments->where('status', 0)->where('due_date', '>=', now())->sum('amount');
                    $totalOverdue = $installments->where('status', 0)->where('due_date', '<', now())->sum('amount');
                    $balance = $totalReceivables - $totalPayables;

                    $pdf = Pdf::loadView('pdf.extract', [
                        'tenant' => $tenant,
                        'startDate' => $startDate,
                        'endDate' => $endDate,
                        'installments' => $installments,
                        'filterType' => $filterType,
                        'filterStatus' => $filterStatus,
                        'totalReceivables' => $totalReceivables,
                        'totalPayables' => $totalPayables,
                        'totalPaid' => $totalPaid,
                        'totalPending' => $totalPending,
                        'totalOverdue' => $totalOverdue,
                        'balance' => $balance,
                    ])
                        ->setPaper('a4', 'landscape')
                        ->setOption('margin-top', 10)
                        ->setOption('margin-bottom', 10)
                        ->setOption('margin-left', 10)
                        ->setOption('margin-right', 10);

                    $fileName = sprintf(
                        'extrato-financeiro-%s-a-%s.pdf',
                        $startDate->format('d-m-Y'),
                        $endDate->format('d-m-Y')
                    );

                    return response()->streamDownload(
                        fn () => print ($pdf->output()),
                        $fileName
                    );
                })
                ->successNotificationTitle('Extrato gerado com sucesso!'),
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
