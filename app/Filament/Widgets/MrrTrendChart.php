<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Enum\AccountsReceivable\PaymentStatusEnum;
use App\Models\Accounts\AccountsInstallments;
use Carbon\Carbon;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\DB;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

final class MrrTrendChart extends ApexChartWidget
{
    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 'full';

    protected static ?string $chartId = 'mrrTrendChart';

    protected static ?string $heading = 'Evolução do MRR';

    protected static ?string $subheading = 'Monthly Recurring Revenue - Últimos 12 meses';

    protected function getOptions(): array
    {
        $tenant = Filament::getTenant();
        $months = [];
        $mrrData = [];

        // Calcular período dos últimos 12 meses
        $startDate = Carbon::now()->subMonths(11)->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();

        // Detectar o driver do banco de dados
        $driver = DB::getDriverName();
        $dateFormatSql = $driver === 'sqlite'
            ? "strftime('%Y-%m', accounts_installments.due_date)"
            : "DATE_FORMAT(accounts_installments.due_date, '%Y-%m')";

        // Query otimizada
        $results = AccountsInstallments::query()
            ->join('accounts', 'accounts_installments.accounts_id', '=', 'accounts.id')
            ->where('accounts_installments.tenant_id', $tenant?->id)
            ->where('accounts.type', 'receivables')
            ->where('accounts.recurring', true)
            ->whereIn('accounts_installments.status', [
                PaymentStatusEnum::PAID->value,
                PaymentStatusEnum::UNPAID->value,
                PaymentStatusEnum::PARTIAL->value,
            ])
            ->whereBetween('accounts_installments.due_date', [$startDate, $endDate])
            ->selectRaw("
                $dateFormatSql as month,
                SUM(accounts_installments.amount) as total
            ")
            ->groupBy('month')
            ->get()
            ->keyBy('month');

        // Processar dados para os últimos 12 meses
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthKey = $date->format('Y-m');

            $months[] = mb_convert_case($date->locale('pt_BR')->isoFormat('MMM/YY'), MB_CASE_TITLE, 'UTF-8');
            $mrrData[] = (float) ($results->get($monthKey)?->total ?? 0);
        }

        return [
            'chart' => [
                'type' => 'line',
                'height' => 350,
                'toolbar' => [
                    'show' => true,
                ],
            ],
            'series' => [
                [
                    'name' => 'MRR',
                    'data' => $mrrData,
                ],
            ],
            'stroke' => [
                'curve' => 'smooth',
                'width' => 3,
            ],
            'xaxis' => [
                'categories' => $months,
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'yaxis' => [
                'title' => [
                    'text' => 'MRR (R$)',
                ],
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'colors' => ['#10b981'],
            'dataLabels' => [
                'enabled' => false,
            ],
            'markers' => [
                'size' => 4,
            ],
            'tooltip' => [
                'enabled' => true,
            ],
            'grid' => [
                'show' => true,
            ],
        ];
    }
}
