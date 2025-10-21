<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Enum\AccountsReceivable\PaymentStatusEnum;
use App\Models\Accounts\AccountsInstallments;
use Carbon\Carbon;
use Filament\Support\Enums\Width;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

final class IncomeAndExpenses extends ApexChartWidget
{
    /**
     * Chart Id
     */
    protected static ?string $chartId = 'incomeAndExpenses';

    /**
     * Widget Title
     */
    protected static ?string $heading = 'Receitas x Despesas';

    protected int|string|array $columnSpan = 'full';

    protected static Width|string $filterFormWidth = 'full';

    /**
     * Get total receivables (contas a receber)
     */
    public function getTotalReceivables(): float
    {
        return (float) AccountsInstallments::query()
            ->whereHas('accounts', function ($query): void {
                $query->where('type', 'receivables');
            })
            ->where('status', PaymentStatusEnum::UNPAID)
            ->sum('amount');
    }

    /**
     * Get total payables (contas a pagar)
     */
    public function getTotalPayables(): float
    {
        return (float) AccountsInstallments::query()
            ->whereHas('accounts', function ($query): void {
                $query->where('type', 'payables');
            })
            ->where('status', PaymentStatusEnum::UNPAID)
            ->sum('amount');
    }

    /**
     * Get overdue receivables (contas a receber em atraso)
     */
    public function getOverdueReceivables()
    {
        return (float) AccountsInstallments::query()->whereHas('accounts', function ($query): void {
            $query->where('type', 'receivables');
        })
            ->where('status', PaymentStatusEnum::OVERDUE)
            ->sum('amount');
    }

    /**
     * Get overdue payables (contas a pagar em atraso)
     */
    public function getOverduePayables(): float
    {
        return (float) AccountsInstallments::query()->whereHas('accounts', function ($query): void {
            $query->where('type', 'payables');
        })
            ->where('status', PaymentStatusEnum::OVERDUE)
            ->sum('amount');
    }

    /**
     * Get monthly income (receita mensal)
     */
    public function getMonthlyIncome(): float
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        return (float) AccountsInstallments::query()->whereHas('accounts', function ($query): void {
            $query->where('type', 'receivables');
        })
            ->where('status', PaymentStatusEnum::PAID)
            ->whereBetween('paid_at', [$startOfMonth, $endOfMonth])
            ->sum('amount');
    }

    /**
     * Get monthly expenses (despesa mensal)
     */
    public function getMonthlyExpenses(): float
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        return (float) AccountsInstallments::query()->whereHas('accounts', function ($query): void {
            $query->where('type', 'payables');
        })
            ->where('status', PaymentStatusEnum::PAID)
            ->whereBetween('paid_at', [$startOfMonth, $endOfMonth])
            ->sum('amount');
    }

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     */
    protected function getOptions(): array
    {
        $currentYear = Carbon::now()->year;
        $months = [];
        $receivablesData = [];
        $payablesData = [];

        // Gerar dados para os últimos 12 meses
        for ($i = 12; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);

            // formato em pt-BR (abreviado) e com primeira letra maiúscula
            $months[] = mb_convert_case($date->locale('pt_BR')->isoFormat('MMM'), MB_CASE_TITLE, 'UTF-8');

            $startOfMonth = $date->copy()->startOfMonth();
            $endOfMonth = $date->copy()->endOfMonth();

            $receivables = AccountsInstallments::query()
                ->whereHas('accounts', function ($query): void {
                    $query->where('type', 'receivables');
                })
                ->where('status', PaymentStatusEnum::PAID)
                ->whereBetween('paid_at', [$startOfMonth, $endOfMonth])
                ->sum('amount');

            $receivablesData[] = (float) $receivables;

            $payables = AccountsInstallments::query()
                ->whereHas('accounts', function ($query): void {
                    $query->where('type', 'payables');
                })
                ->where('status', PaymentStatusEnum::PAID)
                ->whereBetween('paid_at', [$startOfMonth, $endOfMonth])
                ->sum('amount');

            $payablesData[] = (float) $payables;
        }

        return [
            'chart' => [
                'type' => 'bar',
                'height' => 300,
                'toolbar' => [
                    'show' => true,
                ],
            ],
            'series' => [
                [
                    'name' => 'Receitas',
                    'data' => $receivablesData,
                ],
                [
                    'name' => 'Despesas',
                    'data' => $payablesData,
                ],
            ],
            'colors' => ['#34c38f', '#f46a6a'],

        ];
    }
}
