<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Enum\AccountsReceivable\PaymentStatusEnum;
use App\Models\Accounts\AccountsInstallments;
use Carbon\Carbon;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\DB;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

final class MonthlyCashFlow extends ApexChartWidget
{
    protected static ?int $sort = 2;

    protected static ?string $chartId = 'monthlyCashFlow';

    protected static ?string $heading = 'Fluxo de Caixa - Últimos 12 Meses (Pago + A Vencer)';

    protected int|string|array $columnSpan = 'full';

    protected function getOptions(): array
    {
        $months = [];
        $incomeData = [];
        $expensesData = [];
        $balanceData = [];

        // Calcular período dos últimos 12 meses
        $startDate = Carbon::now()->subMonths(11)->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();

        // Detectar o driver do banco de dados para usar a função correta
        $driver = DB::getDriverName();

        // Usar paid_at se pago, senão usar due_date
        $dateFormatSql = $driver === 'sqlite'
            ? "strftime('%Y-%m', COALESCE(accounts_installments.paid_at, accounts_installments.due_date))"
            : "DATE_FORMAT(COALESCE(accounts_installments.paid_at, accounts_installments.due_date), '%Y-%m')";

        $tenant = Filament::getTenant();

        // Buscar contas pagas (usando paid_at)
        $paidResults = AccountsInstallments::query()
            ->join('accounts', 'accounts_installments.accounts_id', '=', 'accounts.id')
            ->where('accounts_installments.tenant_id', $tenant?->id)
            ->where('accounts_installments.status', PaymentStatusEnum::PAID->value)
            ->whereNotNull('accounts_installments.paid_at')
            ->whereBetween('accounts_installments.paid_at', [$startDate, $endDate])
            ->selectRaw("
                $dateFormatSql as month,
                accounts.type,
                SUM(accounts_installments.amount) as total
            ")
            ->groupBy('month', 'accounts.type')
            ->get();

        // Buscar contas não pagas (usando due_date)
        $unpaidResults = AccountsInstallments::query()
            ->join('accounts', 'accounts_installments.accounts_id', '=', 'accounts.id')
            ->where('accounts_installments.tenant_id', $tenant?->id)
            ->whereIn('accounts_installments.status', [
                PaymentStatusEnum::UNPAID->value,
                PaymentStatusEnum::PARTIAL->value,
                PaymentStatusEnum::OVERDUE->value,
            ])
            ->whereBetween('accounts_installments.due_date', [$startDate, $endDate])
            ->selectRaw("
                " . ($driver === 'sqlite'
                    ? "strftime('%Y-%m', accounts_installments.due_date)"
                    : "DATE_FORMAT(accounts_installments.due_date, '%Y-%m')") . " as month,
                accounts.type,
                SUM(accounts_installments.amount) as total
            ")
            ->groupBy('month', 'accounts.type')
            ->get();

        // Combinar resultados
        $results = $paidResults->concat($unpaidResults)
            ->groupBy('month')
            ->map(function ($items) {
                return $items->groupBy('type')->map(function ($group) {
                    return (object) [
                        'type' => $group->first()->type,
                        'total' => $group->sum('total'),
                    ];
                })->values();
            });

        // Processar dados para os últimos 12 meses
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthKey = $date->format('Y-m');

            // Nome do mês em português
            $months[] = mb_convert_case($date->locale('pt_BR')->isoFormat('MMM'), MB_CASE_TITLE, 'UTF-8');

            // Obter receitas e despesas do mês dos resultados
            $monthData = $results->get($monthKey, collect());

            $income = (float) $monthData->firstWhere('type', 'receivables')?->total ?? 0;
            $expenses = (float) $monthData->firstWhere('type', 'payables')?->total ?? 0;

            $incomeData[] = $income;
            $expensesData[] = $expenses;
            $balanceData[] = $income - $expenses;
        }

        return [
            'chart' => [
                'type' => 'bar',
                'height' => 350,
                'stacked' => true,
                'toolbar' => [
                    'show' => true,
                ],
                'zoom' => [
                    'enabled' => true,
                ],
            ],
            'series' => [
                [
                    'name' => 'Receitas',
                    'data' => $incomeData,
                ],
                [
                    'name' => 'Despesas',
                    'data' => $expensesData,
                ],
                [
                    'name' => 'Saldo Líquido',
                    'data' => $balanceData,
                ],
            ],
            'responsive' => [
                [
                    'breakpoint' => 480,
                    'options' => [
                        'legend' => [
                            'position' => 'bottom',
                            'offsetX' => -10,
                            'offsetY' => 0,
                        ],
                    ],
                ],
            ],
            'plotOptions' => [
                'bar' => [
                    'horizontal' => false,
                    'borderRadius' => 10,
                    'borderRadiusApplication' => 'end',
                    'borderRadiusWhenStacked' => 'last',
                    'columnWidth' => '55%',
                    'dataLabels' => [
                        'total' => [
                            'enabled' => true,
                            'style' => [
                                'fontSize' => '13px',
                                'fontWeight' => 900,
                            ],
                        ],
                    ],
                ],
            ],
            'xaxis' => [
                'type' => 'category',
                'categories' => $months,
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'yaxis' => [
                'title' => [
                    'text' => 'Valores (R$)',
                ],
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'legend' => [
                'position' => 'right',
                'offsetY' => 40,
                'fontFamily' => 'inherit',
            ],
            'fill' => [
                'opacity' => 1,
            ],
            'colors' => ['#10b981', '#ef4444', '#3b82f6'],
            'dataLabels' => [
                'enabled' => false,
            ],
            'grid' => [
                'show' => true,
            ],
            'tooltip' => [
                'enabled' => true,
                'shared' => true,
                'intersect' => false,
            ],
        ];
    }
}
