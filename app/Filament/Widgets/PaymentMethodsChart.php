<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Enum\AccountsReceivable\PaymentMethodEnum;
use App\Models\Accounts\AccountsInstallments;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

final class PaymentMethodsChart extends ApexChartWidget
{
    /**
     * Chart Id
     */
    protected static ?string $chartId = 'paymentMethodsChart';

    /**
     * Widget Title
     */
    protected static ?string $heading = 'Formas de Pagamento';

    protected static ?int $sort = 2;

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     */
    protected function getOptions(): array
    {
        $paymentMethods = PaymentMethodEnum::cases();
        $data = [];
        $labels = [];
        $colors = [];

        foreach ($paymentMethods as $method) {
            $count = AccountsInstallments::query()
                ->whereHas('accounts', function ($query) use ($method): void {
                    $query->where('payment_method', $method);
                })
                ->where('status', \App\Enum\AccountsReceivable\PaymentStatusEnum::PAID)
                ->count();

            if ($count > 0) {
                $data[] = $count;
                $labels[] = $method->getLabel();
                $colors[] = $this->getColorForMethod($method);
            }
        }

        return [
            'chart' => [
                'type' => 'pie',
                'height' => 400,
                'toolbar' => [
                    'show' => true,
                ],
                'animations' => [
                    'enabled' => true,
                    'easing' => 'easeinout',
                    'speed' => 800,
                ],
            ],
            'series' => $data,
            'labels' => $labels,
            'colors' => $colors,
            'legend' => [
                'position' => 'bottom',
                'horizontalAlign' => 'center',
                'fontSize' => '14px',
                'fontWeight' => 500,
                'itemMargin' => [
                    'horizontal' => 20,
                    'vertical' => 8,
                ],
            ],
            'dataLabels' => [
                'enabled' => true,
                'formatter' => 'function(val) { return val.toFixed(1) + "%"; }',
                'style' => [
                    'fontSize' => '14px',
                    'fontWeight' => 'bold',
                    'colors' => ['#ffffff'],
                ],
                'dropShadow' => [
                    'enabled' => true,
                    'color' => '#000',
                    'top' => 1,
                    'left' => 1,
                    'blur' => 1,
                    'opacity' => 0.45,
                ],
            ],

            'stroke' => [
                'show' => true,
                'width' => 2,
                'colors' => ['#ffffff'],
            ],
        ];
    }

    /**
     * Get color for payment method
     */
    private function getColorForMethod(PaymentMethodEnum $method): string
    {
        return match ($method) {
            PaymentMethodEnum::CASH => '#22c55e', // Verde mais suave
            PaymentMethodEnum::PIX => '#f97316', // Laranja vibrante
            PaymentMethodEnum::CREDIT_CARD, PaymentMethodEnum::DEBIT_CARD, PaymentMethodEnum::CREDIT => '#3b82f6', // Azul clássico
            PaymentMethodEnum::BANK_TRANSFER => '#06b6d4', // Ciano moderno
            PaymentMethodEnum::CHECK => '#a855f7', // Roxo elegante
            PaymentMethodEnum::BOLETO => '#e11d48', // Rosa vermelho
            default => '#9ca3af', // Cinza neutro
        };
    }
}
