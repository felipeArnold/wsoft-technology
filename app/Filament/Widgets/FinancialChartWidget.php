<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Enum\AccountsReceivable\PaymentStatusEnum;
use App\Models\Accounts\AccountsInstallments;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Date;

final class FinancialChartWidget extends ChartWidget
{
    public ?string $filter = '12months';

    //    protected static ?string $heading = 'Receitas vs Despesas - Últimos 12 Meses';

    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 'full';

    protected function getData(): array
    {
        $data = $this->getFinancialData();

        return [
            'datasets' => [
                [
                    'label' => 'Receitas',
                    'data' => $data['receivables'],
                    'backgroundColor' => 'rgba(34, 197, 94, 0.1)',
                    'borderColor' => 'rgb(34, 197, 94)',
                    'borderWidth' => 2,
                    'fill' => true,
                ],
                [
                    'label' => 'Despesas',
                    'data' => $data['payables'],
                    'backgroundColor' => 'rgba(239, 68, 68, 0.1)',
                    'borderColor' => 'rgb(239, 68, 68)',
                    'borderWidth' => 2,
                    'fill' => true,
                ],
            ],
            'labels' => $data['labels'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getFilters(): ?array
    {
        return [
            '6months' => 'Últimos 6 meses',
            '12months' => 'Últimos 12 meses',
            '24months' => 'Últimos 24 meses',
        ];
    }

    private function getFinancialData(): array
    {
        $months = $this->filter === '6months' ? 6 : ($this->filter === '24months' ? 24 : 12);
        $today = Date::now();

        $labels = [];
        $receivables = [];
        $payables = [];

        for ($i = $months - 1; $i >= 0; $i--) {
            $date = (clone $today)->subMonths($i);
            $startOfMonth = (clone $date)->startOfMonth();
            $endOfMonth = (clone $date)->endOfMonth();

            $labels[] = $date->format('M/Y');

            // Receitas do mês
            $receivablesAmount = AccountsInstallments::query()
                ->whereHas('accounts', function ($q) {
                    $q->where('type', 'receivables');
                })
                ->where('status', PaymentStatusEnum::PAID)
                ->whereBetween('paid_at', [$startOfMonth, $endOfMonth])
                ->sum('amount');

            $receivables[] = (float) $receivablesAmount;

            // Despesas do mês
            $payablesAmount = AccountsInstallments::query()
                ->whereHas('accounts', function ($q) {
                    $q->where('type', 'payables');
                })
                ->where('status', PaymentStatusEnum::PAID)
                ->whereBetween('paid_at', [$startOfMonth, $endOfMonth])
                ->sum('amount');

            $payables[] = (float) $payablesAmount;
        }

        return [
            'labels' => $labels,
            'receivables' => $receivables,
            'payables' => $payables,
        ];
    }
}
