<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Enum\AccountsReceivable\PaymentStatusEnum;
use Carbon\Carbon;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\DB;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

final class ChurnRateChart extends ApexChartWidget
{
    protected static ?int $sort = 4;

    protected int|string|array $columnSpan = 'full';

    protected static ?string $chartId = 'churnRateChart';

    protected static ?string $heading = 'Taxa de Churn';

    protected static ?string $subheading = 'Percentual de clientes inativos por mês';

    protected function getOptions(): array
    {
        $tenant = Filament::getTenant();
        $months = [];
        $churnData = [];

        // Calcular churn rate dos últimos 12 meses
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthStart = $date->copy()->startOfMonth();
            $monthEnd = $date->copy()->endOfMonth();
            $churnThreshold = $monthEnd->copy()->subDays(60);

            $months[] = mb_convert_case($date->locale('pt_BR')->isoFormat('MMM/YY'), MB_CASE_TITLE, 'UTF-8');

            // Clientes com histórico de pagamento até o início do mês
            $activeCustomers = DB::table('people')
                ->where('people.tenant_id', $tenant?->id)
                ->where('people.is_client', true)
                ->whereExists(function ($query) use ($monthStart): void {
                    $query->select(DB::raw(1))
                        ->from('accounts')
                        ->whereColumn('accounts.person_id', 'people.id')
                        ->join('accounts_installments', 'accounts.id', '=', 'accounts_installments.accounts_id')
                        ->where('accounts_installments.status', PaymentStatusEnum::PAID->value)
                        ->where('accounts_installments.paid_at', '<', $monthStart);
                })
                ->count();

            if ($activeCustomers === 0) {
                $churnData[] = 0;

                continue;
            }

            // Clientes que não pagaram há 60+ dias no final do mês
            $churnedCustomers = DB::table('people')
                ->where('people.tenant_id', $tenant?->id)
                ->where('people.is_client', true)
                ->whereExists(function ($query) use ($monthStart): void {
                    // Teve pagamentos antes do mês
                    $query->select(DB::raw(1))
                        ->from('accounts')
                        ->whereColumn('accounts.person_id', 'people.id')
                        ->join('accounts_installments', 'accounts.id', '=', 'accounts_installments.accounts_id')
                        ->where('accounts_installments.status', PaymentStatusEnum::PAID->value)
                        ->where('accounts_installments.paid_at', '<', $monthStart);
                })
                ->whereNotExists(function ($query) use ($churnThreshold, $monthEnd): void {
                    // Não tem pagamentos entre churnThreshold e fim do mês
                    $query->select(DB::raw(1))
                        ->from('accounts')
                        ->whereColumn('accounts.person_id', 'people.id')
                        ->join('accounts_installments', 'accounts.id', '=', 'accounts_installments.accounts_id')
                        ->where('accounts_installments.status', PaymentStatusEnum::PAID->value)
                        ->whereBetween('accounts_installments.paid_at', [$churnThreshold, $monthEnd]);
                })
                ->count();

            $churnRate = ($churnedCustomers / $activeCustomers) * 100;
            $churnData[] = round($churnRate, 2);
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
                    'name' => 'Churn Rate (%)',
                    'data' => $churnData,
                ],
            ],
            'stroke' => [
                'curve' => 'smooth',
                'width' => 2,
            ],
            'fill' => [
                'type' => 'gradient',
                'gradient' => [
                    'shadeIntensity' => 1,
                    'opacityFrom' => 0.7,
                    'opacityTo' => 0.3,
                ],
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
                    'text' => 'Churn Rate (%)',
                ],
                'max' => 100,
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'colors' => ['#ef4444'],
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
