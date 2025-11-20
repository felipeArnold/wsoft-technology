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

    protected static ?string $heading = 'Fluxo de Caixa - Últimos 12 Meses';

    protected function getOptions(): array
    {
        $months = [];
        $incomeData = [];
        $expensesData = [];
        $balanceData = [];

        // Calcular período dos últimos 12 meses
        $startDate = Carbon::now()->subMonths(11)->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();

        // Otimização: Buscar todos os dados em uma única query
        // Detectar o driver do banco de dados para usar a função correta
        $driver = DB::getDriverName();
        $dateFormatSql = $driver === 'sqlite'
            ? "strftime('%Y-%m', accounts_installments.paid_at)"
            : "DATE_FORMAT(accounts_installments.paid_at, '%Y-%m')";

        $tenant = Filament::getTenant();

        $results = AccountsInstallments::query()
            ->join('accounts', 'accounts_installments.accounts_id', '=', 'accounts.id')
            ->where('accounts_installments.tenant_id', $tenant?->id)
            ->where('accounts_installments.status', PaymentStatusEnum::PAID->value)
            ->whereBetween('accounts_installments.paid_at', [$startDate, $endDate])
            ->selectRaw("
                {$dateFormatSql} as month,
                accounts.type,
                SUM(accounts_installments.amount) as total
            ")
            ->groupBy('month', 'accounts.type')
            ->get()
            ->groupBy('month');

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
                'type' => 'line',
                'height' => 350,
                'stacked' => false,
                'toolbar' => [
                    'show' => true,
                ],
            ],
            'series' => [
                [
                    'name' => 'Receitas',
                    'type' => 'column',
                    'data' => $incomeData,
                ],
                [
                    'name' => 'Despesas',
                    'type' => 'area',
                    'data' => $expensesData,
                ],
                [
                    'name' => 'Saldo Líquido',
                    'type' => 'line',
                    'data' => $balanceData,
                ],
            ],

            'stroke' => [
                'width' => [0, 2, 3],
                'curve' => 'smooth',
            ],
            'fill' => [
                'opacity' => [0.85, 0.25, 1],
                'gradient' => [
                    'inverseColors' => false,
                    'shade' => 'light',
                    'type' => 'vertical',
                    'opacityFrom' => 0.85,
                    'opacityTo' => 0.55,
                    'stops' => [0, 100, 100, 100],
                ],
            ],
            'xaxis' => [
                'categories' => $months,
            ],
            'plotOptions' => [
                'bar' => [
                    'horizontal' => false,
                    'columnWidth' => '55%',
                    'borderRadius' => 5,
                    'borderRadiusApplication' => 'end',
                ],
            ],
            'colors' => ['#34c38f', '#f46a6a', '#556ee6'],
            'yaxis' => [
                'labels' => [
                    'formatter' => 'function (value) { return "R$ " + value.toLocaleString("pt-BR", {minimumFractionDigits: 2}); }',
                ],
            ],
            'tooltip' => [
                'y' => [
                    'formatter' => 'function (value) { return "R$ " + value.toLocaleString("pt-BR", {minimumFractionDigits: 2}); }',
                ],
            ],
        ];
    }
}
