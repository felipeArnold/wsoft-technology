<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Enum\AccountsReceivable\PaymentStatusEnum;
use App\Models\Accounts\AccountsInstallments;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Date;

final class CashFlowWidget extends ChartWidget
{
    public ?string $filter = '30days';

    protected static ?int $sort = 4;

    protected int|string|array $columnSpan = 'full';

    protected function getData(): array
    {
        $data = $this->getCashFlowData();

        return [
            'datasets' => [
                [
                    'label' => 'Entradas Previstas',
                    'data' => $data['inflows'],
                    'backgroundColor' => 'rgba(34, 197, 94, 0.8)',
                    'borderColor' => 'rgb(34, 197, 94)',
                    'borderWidth' => 1,
                ],
                [
                    'label' => 'Saídas Previstas',
                    'data' => $data['outflows'],
                    'backgroundColor' => 'rgba(239, 68, 68, 0.8)',
                    'borderColor' => 'rgb(239, 68, 68)',
                    'borderWidth' => 1,
                ],
                [
                    'label' => 'Saldo Acumulado',
                    'data' => $data['balance'],
                    'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                    'borderColor' => 'rgb(59, 130, 246)',
                    'borderWidth' => 2,
                    'type' => 'line',
                    'fill' => false,
                    'tension' => 0.4,
                ],
            ],
            'labels' => $data['labels'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getFilters(): ?array
    {
        return [
            '7days' => 'Próximos 7 dias',
            '15days' => 'Próximos 15 dias',
            '30days' => 'Próximos 30 dias',
            '60days' => 'Próximos 60 dias',
        ];
    }

    private function getCashFlowData(): array
    {
        $days = match ($this->filter) {
            '7days' => 7,
            '15days' => 15,
            '60days' => 60,
            default => 30,
        };

        $today = Date::now();
        $labels = [];
        $inflows = [];
        $outflows = [];
        $balance = [];
        $currentBalance = 0;

        // Obter saldo atual (receitas - despesas pagas hoje)
        $currentBalance = $this->getCurrentBalance();

        for ($i = 0; $i < $days; $i++) {
            $date = (clone $today)->addDays($i);
            $labels[] = $date->format('d/m');

            // Entradas previstas (contas a receber vencendo neste dia)
            $inflow = AccountsInstallments::query()
                ->whereHas('accounts', function ($q) {
                    $q->where('type', 'receivables');
                })
                ->whereIn('status', [PaymentStatusEnum::UNPAID, PaymentStatusEnum::PARTIAL])
                ->whereDate('due_date', $date)
                ->sum('amount');

            $inflows[] = (float) $inflow;

            // Saídas previstas (contas a pagar vencendo neste dia)
            $outflow = AccountsInstallments::query()
                ->whereHas('accounts', function ($q) {
                    $q->where('type', 'payables');
                })
                ->whereIn('status', [PaymentStatusEnum::UNPAID, PaymentStatusEnum::PARTIAL])
                ->whereDate('due_date', $date)
                ->sum('amount');

            $outflows[] = (float) $outflow;

            // Calcular saldo acumulado
            $currentBalance += $inflow - $outflow;
            $balance[] = (float) $currentBalance;
        }

        return [
            'labels' => $labels,
            'inflows' => $inflows,
            'outflows' => $outflows,
            'balance' => $balance,
        ];
    }

    private function getCurrentBalance(): float
    {
        $today = Date::now();

        $received = AccountsInstallments::query()
            ->whereHas('accounts', function ($q) {
                $q->where('type', 'receivables');
            })
            ->where('status', PaymentStatusEnum::PAID)
            ->whereDate('paid_at', '<=', $today)
            ->sum('amount');

        $paid = AccountsInstallments::query()
            ->whereHas('accounts', function ($q) {
                $q->where('type', 'payables');
            })
            ->where('status', PaymentStatusEnum::PAID)
            ->whereDate('paid_at', '<=', $today)
            ->sum('amount');

        return (float) ($received - $paid);
    }
}
