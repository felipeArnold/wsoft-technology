<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Enum\AccountsReceivable\PaymentMethodEnum;
use App\Models\Accounts\AccountsInstallments;
use Filament\Facades\Filament;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

final class PaymentMethodsChart extends ApexChartWidget
{
    protected static ?string $chartId = 'paymentMethodsChart';

    protected static ?string $heading = 'Formas de Pagamento';

    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = 'full';

    protected function getOptions(): array
    {
        $tenant = Filament::getTenant();

        // Buscar todas as contas (pagas e não pagas)
        $results = AccountsInstallments::query()
            ->join('accounts', 'accounts_installments.accounts_id', '=', 'accounts.id')
            ->when($tenant, fn ($query) => $query->where('accounts_installments.tenant_id', $tenant?->id))
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
                'type' => 'bar',
                'height' => 350,
                'stacked' => true,
                'toolbar' => [
                    'show' => true,
                ],
                'zoom' => [
                    'enabled' => true,
                ],
            ],
            'series' => [
                [
                    'name' => 'Quantidade',
                    'data' => $data,
                ],
            ],
            'responsive' => [
                [
                    'breakpoint' => 480,
                    'options' => [
                        'legend' => [
                            'position' => 'bottom',
                            'offsetX' => -10,
                            'offsetY' => 0,
                        ],
                    ],
                ],
            ],
            'plotOptions' => [
                'bar' => [
                    'horizontal' => true,
                    'borderRadius' => 10,
                    'borderRadiusApplication' => 'end',
                    'borderRadiusWhenStacked' => 'last',
                    'dataLabels' => [
                        'total' => [
                            'enabled' => true,
                            'style' => [
                                'fontSize' => '13px',
                                'fontWeight' => 900,
                            ],
                        ],
                    ],
                ],
            ],
            'xaxis' => [
                'type' => 'category',
                'categories' => $labels,
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'yaxis' => [
                'title' => [
                    'text' => 'Valores',
                ],
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'legend' => [
                'position' => 'right',
                'offsetY' => 40,
                'fontFamily' => 'inherit',
            ],
            'fill' => [
                'opacity' => 1,
            ],
            'colors' => $colors,
            'dataLabels' => [
                'enabled' => false,
            ],
            'grid' => [
                'show' => true,
            ],
            'tooltip' => [
                'enabled' => true,
                'shared' => true,
                'intersect' => false,
            ],
        ];
    }

    private function getColorForMethod(PaymentMethodEnum $method): string
    {
        return match ($method) {
            PaymentMethodEnum::CASH => '#10b981',
            PaymentMethodEnum::PIX => '#f97316',
            PaymentMethodEnum::CREDIT_CARD => '#eab308',
            PaymentMethodEnum::DEBIT_CARD => '#22c55e',
            PaymentMethodEnum::CREDIT => '#3b82f6',
            PaymentMethodEnum::BANK_TRANSFER => '#06b6d4',
            PaymentMethodEnum::CHECK => '#8b5cf6',
            PaymentMethodEnum::BOLETO => '#ec4899',
        };
    }
}
