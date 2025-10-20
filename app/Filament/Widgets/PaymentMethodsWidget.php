<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Enum\AccountsReceivable\PaymentMethodEnum;
use App\Enum\AccountsReceivable\PaymentStatusEnum;
use App\Models\Accounts\AccountsInstallments;
use Illuminate\Support\Facades\Date;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

final class PaymentMethodsWidget extends ApexChartWidget
{
    public ?string $filter = '30days';

    protected static ?string $heading = 'Pagamentos por Método - Últimos 30 Dias';

    protected static ?int $sort = 5;

    //    protected int|string|array $columnSpan = 'half';

    protected function getOptions(): array
    {
        return [
            'chart' => [
                'type' => 'donut',
                'height' => 300,
            ],
            'series' => [
                [
                    'name' => 'BlogPostsChart',
                    'data' => [7, 4, 6, 10, 14, 7, 5, 9, 10, 15, 13, 18],
                ],
            ],
            'xaxis' => [
                'categories' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                        'fontWeight' => 600,
                    ],
                ],
            ],
            'yaxis' => [
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'colors' => ['#f59e0b'],
        ];
    }

    //    protected function getType(): string
    //    {
    //        return 'doughnut';
    //    }
    //
    //    protected function getFilters(): ?array
    //    {
    //        return [
    //            '7days' => 'Últimos 7 dias',
    //            '15days' => 'Últimos 15 dias',
    //            '30days' => 'Últimos 30 dias',
    //            '90days' => 'Últimos 90 dias',
    //        ];
    //    }
    //
    //    private function getPaymentMethodsData(): array
    //    {
    //        $days = match ($this->filter) {
    //            '7days' => 7,
    //            '15days' => 15,
    //            '90days' => 90,
    //            default => 30,
    //        };
    //
    //        $startDate = Date::now()->subDays($days);
    //        $endDate = Date::now();
    //
    //        $labels = [];
    //        $values = [];
    //
    //        foreach (PaymentMethodEnum::cases() as $method) {
    //            $amount = AccountsInstallments::query()
    //                ->whereHas('accounts', function ($q) use ($method) {
    //                    $q->where('payment_method', $method->value);
    //                })
    //                ->where('status', PaymentStatusEnum::PAID)
    //                ->whereBetween('paid_at', [$startDate, $endDate])
    //                ->sum('amount');
    //
    //            if ($amount > 0) {
    //                $labels[] = $method->getLabel();
    //                $values[] = (float) $amount;
    //            }
    //        }
    //
    //        return [
    //            'labels' => $labels,
    //            'values' => $values,
    //        ];
    //    }
}
