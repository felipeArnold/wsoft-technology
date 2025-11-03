<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Enum\AccountsReceivable\PaymentMethodEnum;
use App\Enum\AccountsReceivable\PaymentStatusEnum;
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

    protected static ?int $sort = 3;

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     */
    protected function getOptions(): array
    {
        // Otimização: Buscar todos os counts em uma única query com GROUP BY
        $results = AccountsInstallments::query()
            ->join('accounts', 'accounts_installments.accounts_id', '=', 'accounts.id')
            ->where('accounts_installments.status', PaymentStatusEnum::PAID->value)
            ->selectRaw('accounts.payment_method, COUNT(*) as count')
            ->groupBy('accounts.payment_method')
            ->get()
            ->keyBy('payment_method');

        $data = [];
        $labels = [];
        $colors = [];

        foreach (PaymentMethodEnum::cases() as $method) {
            $count = $results->get($method->value)?->count ?? 0;

            if ($count > 0) {
                $data[] = $count;
                $labels[] = $method->getLabel();
                $colors[] = $this->getColorForMethod($method);
            }
        }

        return [
            'chart' => [
                'type' => 'donut',
                'height' => 310,
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
            'dataLabels' => [
                'enabled' => true,
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
            PaymentMethodEnum::CASH => '#4ade80',
            PaymentMethodEnum::PIX => '#fb923c',
            PaymentMethodEnum::CREDIT_CARD => '#fbbf24',
            PaymentMethodEnum::DEBIT_CARD => '#34d399',
            PaymentMethodEnum::CREDIT => '#60a5fa',
            PaymentMethodEnum::BANK_TRANSFER => '#22d3ee',
            PaymentMethodEnum::CHECK => '#a78bfa',
            PaymentMethodEnum::BOLETO => '#fb7185',
            default => '#9ca3af',
        };

    }
}
