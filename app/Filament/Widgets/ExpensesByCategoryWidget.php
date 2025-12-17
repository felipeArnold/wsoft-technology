<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Models\Accounts\AccountsInstallments;
use Carbon\Carbon;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\DB;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

final class ExpensesByCategoryWidget extends ApexChartWidget
{
    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 1;

    protected static ?string $chartId = 'expensesByCategory';

    protected static ?string $heading = 'Despesas por Categoria';

    protected static ?string $subheading = 'Distribuição de gastos por categoria';

    protected function getOptions(): array
    {
        $tenant = Filament::getTenant();

        // Período: últimos 12 meses
        $startDate = Carbon::now()->subMonths(11)->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();

        // Buscar despesas por categoria
        $expenses = AccountsInstallments::query()
            ->join('accounts', 'accounts_installments.accounts_id', '=', 'accounts.id')
            ->where('accounts_installments.tenant_id', $tenant->id ?? null)
            ->where('accounts.type', 'payables')
            ->whereBetween(
                DB::raw('COALESCE(accounts_installments.paid_at, accounts_installments.due_date)'),
                [$startDate, $endDate]
            )
            ->selectRaw('
                COALESCE(accounts.category, "Sem Categoria") as category,
                SUM(accounts_installments.amount) as total
            ')
            ->groupBy('category')
            ->orderByDesc('total')
            ->get();

        $categories = [];
        $values = [];
        $colors = [
            '#ef4444', // red
            '#f97316', // orange
            '#f59e0b', // amber
            '#eab308', // yellow
            '#84cc16', // lime
            '#22c55e', // green
            '#10b981', // emerald
            '#14b8a6', // teal
            '#06b6d4', // cyan
            '#0ea5e9', // sky
            '#3b82f6', // blue
            '#6366f1', // indigo
            '#8b5cf6', // violet
            '#a855f7', // purple
            '#d946ef', // fuchsia
            '#ec4899', // pink
            '#f43f5e', // rose
        ];

        foreach ($expenses as $expense) {
            $categories[] = $expense->category ?? 'Sem Categoria';
            $values[] = (float) ($expense->total ?? 0);
        }

        return [
            'chart' => [
                'type' => 'donut',
                'height' => 350,
            ],
            'series' => $values,
            'labels' => $categories,
            'colors' => array_slice($colors, 0, count($categories)),
            'legend' => [
                'position' => 'bottom',
                'fontFamily' => 'inherit',
            ],
            'plotOptions' => [
                'pie' => [
                    'donut' => [
                        'size' => '65%',
                        'labels' => [
                            'show' => true,
                            'name' => [
                                'show' => true,
                                'fontSize' => '16px',
                                'fontFamily' => 'inherit',
                            ],
                            'value' => [
                                'show' => true,
                                'fontSize' => '24px',
                                'fontFamily' => 'inherit',
                                'formatter' => 'function (val) { return "R$ " + Number(val).toLocaleString("pt-BR", {minimumFractionDigits: 2, maximumFractionDigits: 2}); }',
                            ],
                            'total' => [
                                'show' => true,
                                'label' => 'Total',
                                'fontSize' => '16px',
                                'fontFamily' => 'inherit',
                                'formatter' => 'function (w) { var total = w.globals.seriesTotals.reduce((a, b) => a + b, 0); return "R$ " + Number(total).toLocaleString("pt-BR", {minimumFractionDigits: 2, maximumFractionDigits: 2}); }',
                            ],
                        ],
                    ],
                ],
            ],
            'dataLabels' => [
                'enabled' => true,
                'formatter' => 'function (val) { return val.toFixed(1) + "%"; }',
            ],
            'tooltip' => [
                'enabled' => true,
                'y' => [
                    'formatter' => 'function (val) { return "R$ " + Number(val).toLocaleString("pt-BR", {minimumFractionDigits: 2, maximumFractionDigits: 2}); }',
                ],
            ],
        ];
    }
}
