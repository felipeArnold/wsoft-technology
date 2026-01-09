<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Enum\AccountsReceivable\PaymentStatusEnum;
use App\Models\Accounts\AccountsInstallments;
use Carbon\Carbon;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\DB;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

final class MonthlyExpensesDistributionWidget extends ApexChartWidget
{
    protected static ?int $sort = 4;

    protected static ?string $chartId = 'monthlyExpensesDistribution';

    protected static ?string $heading = 'Distribuição Mensal de Gastos';

    protected static ?string $subheading = 'Despesas nos últimos 12 meses';

    protected int|string|array $columnSpan = 'full';

    protected ?string $pollingInterval = null;

    protected function getOptions(): array
    {
        $months = [];
        $paidExpenses = [];
        $unpaidExpenses = [];

        // Calcular período dos últimos 12 meses
        $startDate = Carbon::now()->subMonths(11)->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();

        // Detectar o driver do banco de dados
        $driver = DB::getDriverName();

        $dateFormatSql = $driver === 'sqlite'
            ? "strftime('%Y-%m', COALESCE(accounts_installments.paid_at, accounts_installments.due_date))"
            : "DATE_FORMAT(COALESCE(accounts_installments.paid_at, accounts_installments.due_date), '%Y-%m')";

        $tenant = Filament::getTenant();

        // Buscar despesas pagas (usando paid_at)
        $paidResults = AccountsInstallments::query()
            ->join('accounts', 'accounts_installments.accounts_id', '=', 'accounts.id')
            ->where('accounts_installments.tenant_id', $tenant->id ?? null)
            ->where('accounts.type', 'payables')
            ->where('accounts_installments.status', PaymentStatusEnum::PAID->value)
            ->whereNotNull('accounts_installments.paid_at')
            ->whereBetween('accounts_installments.paid_at', [$startDate, $endDate])
            ->selectRaw("
                $dateFormatSql as month,
                SUM(accounts_installments.amount) as total
            ")
            ->groupBy('month')
            ->get()
            ->keyBy('month');

        // Buscar despesas não pagas (usando due_date)
        $unpaidResults = AccountsInstallments::query()
            ->join('accounts', 'accounts_installments.accounts_id', '=', 'accounts.id')
            ->where('accounts_installments.tenant_id', $tenant->id ?? null)
            ->where('accounts.type', 'payables')
            ->whereIn('accounts_installments.status', [
                PaymentStatusEnum::UNPAID->value,
                PaymentStatusEnum::PARTIAL->value,
                PaymentStatusEnum::OVERDUE->value,
            ])
            ->whereBetween('accounts_installments.due_date', [$startDate, $endDate])
            ->selectRaw('
                '.($driver === 'sqlite'
                    ? "strftime('%Y-%m', accounts_installments.due_date)"
                    : "DATE_FORMAT(accounts_installments.due_date, '%Y-%m')").' as month,
                SUM(accounts_installments.amount) as total
            ')
            ->groupBy('month')
            ->get()
            ->keyBy('month');

        // Processar dados para os últimos 12 meses
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthKey = $date->format('Y-m');

            // Nome do mês em português
            $months[] = mb_convert_case($date->locale('pt_BR')->isoFormat('MMM'), MB_CASE_TITLE, 'UTF-8');

            $paid = (float) ($paidResults->get($monthKey)->total ?? 0);
            $unpaid = (float) ($unpaidResults->get($monthKey)->total ?? 0);

            $paidExpenses[] = $paid;
            $unpaidExpenses[] = $unpaid;
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
                    'enabled' => false,
                ],
            ],
            'series' => [
                [
                    'name' => 'Despesas Pagas',
                    'data' => $paidExpenses,
                ],
                [
                    'name' => 'Despesas Pendentes',
                    'data' => $unpaidExpenses,
                ],
            ],
            'plotOptions' => [
                'bar' => [
                    'horizontal' => false,
                    'borderRadius' => 8,
                    'columnWidth' => '55%',
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
                'position' => 'top',
                'horizontalAlign' => 'left',
                'fontFamily' => 'inherit',
            ],
            'fill' => [
                'opacity' => 1,
            ],
            'colors' => ['#ef4444', '#f59e0b'],
            'dataLabels' => [
                'enabled' => false,
            ],
            'grid' => [
                'show' => true,
                'borderColor' => '#e5e7eb',
            ],
            'tooltip' => [
                'enabled' => true,
                'shared' => true,
                'intersect' => false,
            ],
        ];
    }
}
