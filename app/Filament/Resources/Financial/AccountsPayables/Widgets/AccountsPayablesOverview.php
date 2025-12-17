<?php

declare(strict_types=1);

namespace App\Filament\Resources\Financial\AccountsPayables\Widgets;

use App\Enum\AccountsReceivable\PaymentStatusEnum;
use App\Models\Accounts\AccountsInstallments;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Date;

final class AccountsPayablesOverview extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';

    protected function getColumns(): int
    {
        return 4;
    }

    protected function getStats(): array
    {
        $today = Date::now();
        $startOfMonth = (clone $today)->startOfMonth();
        $endOfMonth = (clone $today)->endOfMonth();

        $baseQuery = AccountsInstallments::query();

        $openCount = (clone $baseQuery)
            ->whereIn('status', [PaymentStatusEnum::UNPAID, PaymentStatusEnum::PARTIAL])
            ->count();

        $overdueCount = (clone $baseQuery)
            ->where('status', PaymentStatusEnum::OVERDUE)
            ->orWhere(function ($q) use ($today): void {
                $q->whereIn('status', [PaymentStatusEnum::UNPAID, PaymentStatusEnum::PARTIAL])
                    ->whereDate('due_date', '<', $today);
            })
            ->count();

        $paidThisMonth = (clone $baseQuery)
            ->where('status', PaymentStatusEnum::PAID)
            ->whereBetween('paid_at', [$startOfMonth, $endOfMonth])
            ->count();

        $totalToPay = (clone $baseQuery)
            ->whereIn('status', [PaymentStatusEnum::UNPAID, PaymentStatusEnum::PARTIAL, PaymentStatusEnum::OVERDUE])
            ->sum('amount');

        // Trend for the next 14 days: number of installments due per day
        $trendDays = 14;
        $trendData = [];
        for ($i = 0; $i < $trendDays; $i++) {
            $date = (clone $today)->addDays($i)->toDateString();
            $trendData[] = (clone $baseQuery)
                ->whereIn('status', [PaymentStatusEnum::UNPAID, PaymentStatusEnum::PARTIAL])
                ->whereDate('due_date', $date)
                ->count();
        }

        return [
            Stat::make('Em aberto', (string) $openCount)
                ->icon('heroicon-o-clock')
                ->description('Parcelas em aberto')
                ->color('warning'),

            Stat::make('Vencidas', (string) $overdueCount)
                ->icon('heroicon-o-exclamation-triangle')
                ->description('Parcelas vencidas')
                ->color('danger')
                ->chart($trendData),

            Stat::make('Pagas no mês', (string) $paidThisMonth)
                ->icon('heroicon-o-check-circle')
                ->description('Liquidadas neste mês')
                ->color('success'),

            Stat::make('Total a pagar', 'R$ '.number_format((float) $totalToPay, 2, ',', '.'))
                ->icon('heroicon-o-banknotes')
                ->description('Soma das parcelas em aberto')
                ->color('primary'),
        ];
    }
}
