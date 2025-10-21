<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Enum\AccountsReceivable\PaymentMethodEnum;
use App\Models\Accounts\AccountsInstallments;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

final class PaymentMethodsByTypeChart extends ApexChartWidget
{
    /**
     * Chart Id
     */
    protected static ?string $chartId = 'paymentMethodsByTypeChart';

    /**
     * Widget Title
     */
    protected static ?string $heading = 'Formas de Pagamento por Tipo';

    protected static ?int $sort = 3;

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     */
    protected function getOptions(): array
    {
        $paymentMethods = PaymentMethodEnum::cases();
        $receivablesData = [];
        $payablesData = [];
        $labels = [];

        foreach ($paymentMethods as $method) {
            // Contas a receber
            $receivablesCount = AccountsInstallments::query()
                ->whereHas('accounts', function ($query) use ($method): void {
                    $query->where('type', 'receivables')
                        ->where('payment_method', $method);
                })
                ->where('status', \App\Enum\AccountsReceivable\PaymentStatusEnum::PAID)
                ->count();

            // Contas a pagar
            $payablesCount = AccountsInstallments::query()
                ->whereHas('accounts', function ($query) use ($method): void {
                    $query->where('type', 'payables')
                        ->where('payment_method', $method);
                })
                ->where('status', \App\Enum\AccountsReceivable\PaymentStatusEnum::PAID)
                ->count();

            if ($receivablesCount > 0 || $payablesCount > 0) {
                $receivablesData[] = $receivablesCount;
                $payablesData[] = $payablesCount;
                $labels[] = $method->getLabel();
            }
        }

        return [
            'chart' => [
                'type' => 'donut',
                'height' => 400,
                'toolbar' => [
                    'show' => true,
                ],
            ],
            'series' => [
                [
                    'name' => 'Contas a Receber',
                    'data' => $receivablesData,
                ],
                [
                    'name' => 'Contas a Pagar',
                    'data' => $payablesData,
                ],
            ],
            'labels' => $labels,
            'colors' => ['#34c38f', '#f46a6a'],
            'legend' => [
                'position' => 'bottom',
                'horizontalAlign' => 'center',
            ],
            'dataLabels' => [
                'enabled' => true,
                'formatter' => 'function(val) { return val.toFixed(1) + "%"; }',
            ],
            'tooltip' => [
                'y' => [
                    'formatter' => 'function(value) { return value + " transações"; }',
                ],
            ],
            'plotOptions' => [
                'pie' => [
                    'donut' => [
                        'size' => '70%',
                        'labels' => [
                            'show' => true,
                            'name' => [
                                'show' => true,
                                'fontSize' => '16px',
                                'fontWeight' => 600,
                            ],
                            'value' => [
                                'show' => true,
                                'fontSize' => '14px',
                            ],
                        ],
                    ],
                ],
            ],
        ];
    }
}
