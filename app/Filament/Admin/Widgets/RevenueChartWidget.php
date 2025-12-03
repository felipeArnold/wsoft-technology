<?php

declare(strict_types=1);

namespace App\Filament\Admin\Widgets;

use App\Models\Tenant;
use Filament\Widgets\ChartWidget;

final class RevenueChartWidget extends ChartWidget
{
    protected static ?int $sort = 2;

    public function getHeading(): ?string
    {
        return 'Evolução MRR (Últimos 12 Meses)';
    }

    protected function getData(): array
    {
        $months = [];
        $mrrData = [];

        // Gera os últimos 12 meses
        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $months[] = $date->format('M/Y');

            // Calcula MRR para aquele mês (empresas com assinatura ativa criadas até aquela data)
            $count = Tenant::whereHas('subscriptions', function ($query) use ($date): void {
                $query->where('stripe_status', 'active')
                    ->where('created_at', '<=', $date->endOfMonth());
            })->count();

            $mrrData[] = $count * 99; // R$ 99 por mês
        }

        return [
            'datasets' => [
                [
                    'label' => 'MRR (R$)',
                    'data' => $mrrData,
                    'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                    'borderColor' => 'rgb(59, 130, 246)',
                    'fill' => true,
                ],
            ],
            'labels' => $months,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
