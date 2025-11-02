<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Enum\AccountsReceivable\PaymentStatusEnum;
use App\Models\Accounts\AccountsInstallments;
use Carbon\Carbon;
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

        // Gerar dados para os últimos 12 meses
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $startOfMonth = $date->copy()->startOfMonth();
            $endOfMonth = $date->copy()->endOfMonth();

            // Nome do mês em português
            $months[] = mb_convert_case($date->locale('pt_BR')->isoFormat('MMM'), MB_CASE_TITLE, 'UTF-8');

            // Receitas do mês
            $income = AccountsInstallments::query()
                ->whereHas('accounts', function ($query): void {
                    $query->where('type', 'receivables');
                })
                ->where('status', PaymentStatusEnum::PAID)
                ->whereBetween('paid_at', [$startOfMonth, $endOfMonth])
                ->sum('amount');

            // Despesas do mês
            $expenses = AccountsInstallments::query()
                ->whereHas('accounts', function ($query): void {
                    $query->where('type', 'payables');
                })
                ->where('status', PaymentStatusEnum::PAID)
                ->whereBetween('paid_at', [$startOfMonth, $endOfMonth])
                ->sum('amount');

            $incomeData[] = (float) $income;
            $expensesData[] = (float) $expenses;
            $balanceData[] = (float) $income - (float) $expenses;
        }

        return [
            'chart' => [
                'type' => 'area',
                'height' => 350,
                'toolbar' => [
                    'show' => true,
                ],
            ],
            'series' => [
                [
                    'name' => 'Receitas',
                    'data' => $incomeData,
                    'color' => '#10b981',
                ],
                [
                    'name' => 'Despesas',
                    'data' => $expensesData,
                    'color' => '#ef4444',
                ],
                [
                    'name' => 'Saldo Líquido',
                    'data' => $balanceData,
                    'color' => '#3b82f6',
                ],
            ],
            'plotOptions' => [
                'bar' => [
                    'horizontal' => false,
                    'columnWidth' => '55%',
                    'borderRadius' => 5,
                    'borderRadiusApplication' => 'end',
                ],
            ],
            'colors' => ['#34c38f', '#f46a6a'],

        ];
    }
}
