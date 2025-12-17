<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Enum\AccountsReceivable\PaymentStatusEnum;
use App\Models\Person\Person;
use Carbon\Carbon;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\DB;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

final class LtvTrendChart extends ApexChartWidget
{
    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = 'full';

    protected static ?string $chartId = 'ltvTrendChart';

    protected static ?string $heading = 'Evolução do LTV Médio';

    protected static ?string $subheading = 'Lifetime Value por coorte de clientes';

    protected function getOptions(): array
    {
        $tenant = Filament::getTenant();
        $months = [];
        $ltvData = [];

        // Calcular LTV médio por mês de aquisição (últimos 12 meses)
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthStart = $date->copy()->startOfMonth();
            $monthEnd = $date->copy()->endOfMonth();

            $months[] = mb_convert_case($date->locale('pt_BR')->isoFormat('MMM/YY'), MB_CASE_TITLE, 'UTF-8');

            // Buscar clientes criados neste mês
            $clientsInCohort = Person::query()
                ->where('tenant_id', $tenant?->id)
                ->where('is_client', true)
                ->whereBetween('created_at', [$monthStart, $monthEnd])
                ->pluck('id');

            if ($clientsInCohort->isEmpty()) {
                $ltvData[] = 0;

                continue;
            }

            // Calcular LTV total da coorte
            $totalLtv = 0;

            // Somar vendas concluídas
            $salesTotal = DB::table('sales')
                ->whereIn('person_id', $clientsInCohort)
                ->where('status', 'completed')
                ->sum('total');

            // Somar ordens de serviço concluídas
            $serviceOrdersTotal = DB::table('service_orders')
                ->whereIn('person_id', $clientsInCohort)
                ->where('status', 'completed')
                ->sum('total_value');

            // Somar contas pagas
            $accountsTotal = DB::table('accounts_installments')
                ->join('accounts', 'accounts_installments.accounts_id', '=', 'accounts.id')
                ->whereIn('accounts.person_id', $clientsInCohort)
                ->where('accounts_installments.status', PaymentStatusEnum::PAID->value)
                ->sum('accounts_installments.amount');

            $totalLtv = (float) $salesTotal + (float) $serviceOrdersTotal + (float) $accountsTotal;

            // Calcular média
            $averageLtv = $totalLtv / $clientsInCohort->count();

            $ltvData[] = round($averageLtv, 2);
        }

        return [
            'chart' => [
                'type' => 'bar',
                'height' => 350,
                'toolbar' => [
                    'show' => true,
                ],
            ],
            'series' => [
                [
                    'name' => 'LTV Médio',
                    'data' => $ltvData,
                ],
            ],
            'plotOptions' => [
                'bar' => [
                    'borderRadius' => 4,
                    'columnWidth' => '60%',
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
                    'text' => 'LTV Médio (R$)',
                ],
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'colors' => ['#3b82f6'],
            'dataLabels' => [
                'enabled' => false,
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
