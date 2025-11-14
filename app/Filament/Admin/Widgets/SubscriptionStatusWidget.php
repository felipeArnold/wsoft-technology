<?php

declare(strict_types=1);

namespace App\Filament\Admin\Widgets;

use App\Models\Tenant;
use Filament\Widgets\ChartWidget;

final class SubscriptionStatusWidget extends ChartWidget
{
    protected static ?int $sort = 3;

    public function getHeading(): ?string
    {
        return 'Status das Assinaturas';
    }

    protected function getData(): array
    {
        $active = Tenant::whereHas('subscriptions', function ($query) {
            $query->where('stripe_status', 'active');
        })->count();

        $trialing = Tenant::whereHas('subscriptions', function ($query) {
            $query->where('stripe_status', 'trialing');
        })->count();

        $canceled = Tenant::whereHas('subscriptions', function ($query) {
            $query->where('stripe_status', 'canceled');
        })->count();

        $pastDue = Tenant::whereHas('subscriptions', function ($query) {
            $query->where('stripe_status', 'past_due');
        })->count();

        $noSubscription = Tenant::whereDoesntHave('subscriptions')->count();

        return [
            'datasets' => [
                [
                    'label' => 'Assinaturas',
                    'data' => [$active, $trialing, $canceled, $pastDue, $noSubscription],
                    'backgroundColor' => [
                        'rgb(34, 197, 94)',   // Verde - Ativa
                        'rgb(59, 130, 246)',  // Azul - Trial
                        'rgb(239, 68, 68)',   // Vermelho - Cancelada
                        'rgb(245, 158, 11)',  // Amarelo - Vencida
                        'rgb(156, 163, 175)', // Cinza - Sem assinatura
                    ],
                ],
            ],
            'labels' => ['Ativa', 'Período de Teste', 'Cancelada', 'Vencida', 'Sem Assinatura'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
