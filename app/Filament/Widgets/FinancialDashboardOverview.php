<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Enum\AccountsReceivable\PaymentStatusEnum;
use App\Models\Accounts\AccountsInstallments;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Date;

final class FinancialDashboardOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $today = Date::now();
        $startOfMonth = (clone $today)->startOfMonth();
        $endOfMonth = (clone $today)->endOfMonth();
        $startOfYear = (clone $today)->startOfYear();
        $endOfYear = (clone $today)->endOfYear();

        // Contas a Receber
        $receivablesQuery = AccountsInstallments::query()
            ->whereHas('accounts', function ($q): void {
                $q->where('type', 'receivables');
            });

        $totalToReceive = (clone $receivablesQuery)
            ->whereIn('status', [PaymentStatusEnum::UNPAID, PaymentStatusEnum::PARTIAL, PaymentStatusEnum::OVERDUE])
            ->sum('amount');

        $receivedThisMonth = (clone $receivablesQuery)
            ->where('status', PaymentStatusEnum::PAID)
            ->whereBetween('paid_at', [$startOfMonth, $endOfMonth])
            ->sum('amount');

        $overdueReceivables = (clone $receivablesQuery)
            ->where(function ($q) use ($today): void {
                $q->where('status', PaymentStatusEnum::OVERDUE)
                    ->orWhere(function ($q2) use ($today): void {
                        $q2->whereIn('status', [PaymentStatusEnum::UNPAID, PaymentStatusEnum::PARTIAL])
                            ->whereDate('due_date', '<', $today);
                    });
            })
            ->sum('amount');

        // Contas a Pagar
        $payablesQuery = AccountsInstallments::query()
            ->whereHas('accounts', function ($q): void {
                $q->where('type', 'payables');
            });

        $totalToPay = (clone $payablesQuery)
            ->whereIn('status', [PaymentStatusEnum::UNPAID, PaymentStatusEnum::PARTIAL, PaymentStatusEnum::OVERDUE])
            ->sum('amount');

        $paidThisMonth = (clone $payablesQuery)
            ->where('status', PaymentStatusEnum::PAID)
            ->whereBetween('paid_at', [$startOfMonth, $endOfMonth])
            ->sum('amount');

        $overduePayables = (clone $payablesQuery)
            ->where(function ($q) use ($today): void {
                $q->where('status', PaymentStatusEnum::OVERDUE)
                    ->orWhere(function ($q2) use ($today): void {
                        $q2->whereIn('status', [PaymentStatusEnum::UNPAID, PaymentStatusEnum::PARTIAL])
                            ->whereDate('due_date', '<', $today);
                    });
            })
            ->sum('amount');

        // Saldo do mês
        $monthlyBalance = $receivedThisMonth - $paidThisMonth;

        // Inadimplência total
        $totalOverdue = $overdueReceivables + $overduePayables;

        return [
            Stat::make('A Receber', 'R$ '.number_format($totalToReceive, 2, ',', '.'))
                ->description('Total em aberto')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart($this->getReceivablesTrend()),

            Stat::make('A Pagar', 'R$ '.number_format($totalToPay, 2, ',', '.'))
                ->description('Total em aberto')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger')
                ->chart($this->getPayablesTrend()),

            Stat::make('Saldo do Mês', 'R$ '.number_format($monthlyBalance, 2, ',', '.'))
                ->description($monthlyBalance >= 0 ? 'Positivo' : 'Negativo')
                ->descriptionIcon($monthlyBalance >= 0 ? 'heroicon-m-check-circle' : 'heroicon-m-exclamation-triangle')
                ->color($monthlyBalance >= 0 ? 'success' : 'danger')
                ->chart($this->getMonthlyBalanceTrend()),

            Stat::make('Inadimplência', 'R$ '.number_format($totalOverdue, 2, ',', '.'))
                ->description('Valores em atraso')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color($totalOverdue > 0 ? 'danger' : 'success')
                ->chart($this->getOverdueTrend()),
        ];
    }

    private function getReceivablesTrend(): array
    {
        $trend = [];
        $today = Date::now();

        for ($i = 6; $i >= 0; $i--) {
            $date = (clone $today)->subDays($i);
            $amount = AccountsInstallments::query()
                ->whereHas('accounts', function ($q): void {
                    $q->where('type', 'receivables');
                })
                ->where('status', PaymentStatusEnum::PAID)
                ->whereDate('paid_at', $date)
                ->sum('amount');

            $trend[] = (float) $amount;
        }

        return $trend;
    }

    private function getPayablesTrend(): array
    {
        $trend = [];
        $today = Date::now();

        for ($i = 6; $i >= 0; $i--) {
            $date = (clone $today)->subDays($i);
            $amount = AccountsInstallments::query()
                ->whereHas('accounts', function ($q): void {
                    $q->where('type', 'payables');
                })
                ->where('status', PaymentStatusEnum::PAID)
                ->whereDate('paid_at', $date)
                ->sum('amount');

            $trend[] = (float) $amount;
        }

        return $trend;
    }

    private function getMonthlyBalanceTrend(): array
    {
        $trend = [];
        $today = Date::now();

        for ($i = 6; $i >= 0; $i--) {
            $date = (clone $today)->subDays($i);

            $received = AccountsInstallments::query()
                ->whereHas('accounts', function ($q): void {
                    $q->where('type', 'receivables');
                })
                ->where('status', PaymentStatusEnum::PAID)
                ->whereDate('paid_at', $date)
                ->sum('amount');

            $paid = AccountsInstallments::query()
                ->whereHas('accounts', function ($q): void {
                    $q->where('type', 'payables');
                })
                ->where('status', PaymentStatusEnum::PAID)
                ->whereDate('paid_at', $date)
                ->sum('amount');

            $trend[] = (float) ($received - $paid);
        }

        return $trend;
    }

    private function getOverdueTrend(): array
    {
        $trend = [];
        $today = Date::now();

        for ($i = 6; $i >= 0; $i--) {
            $date = (clone $today)->subDays($i);

            $overdue = AccountsInstallments::query()
                ->where(function ($q) use ($date): void {
                    $q->where('status', PaymentStatusEnum::OVERDUE)
                        ->orWhere(function ($q2) use ($date): void {
                            $q2->whereIn('status', [PaymentStatusEnum::UNPAID, PaymentStatusEnum::PARTIAL])
                                ->whereDate('due_date', '<', $date);
                        });
                })
                ->sum('amount');

            $trend[] = (float) $overdue;
        }

        return $trend;
    }
}
