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
    protected static ?int $sort = 1;

    protected int|string|array $columnSpan = 'full';

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

        $totalToReceive = (float) (clone $receivablesQuery)
            ->whereIn('status', [PaymentStatusEnum::UNPAID, PaymentStatusEnum::PARTIAL, PaymentStatusEnum::OVERDUE])
            ->sum('amount');

        $countToReceive = (int) (clone $receivablesQuery)
            ->whereIn('status', [PaymentStatusEnum::UNPAID, PaymentStatusEnum::PARTIAL, PaymentStatusEnum::OVERDUE])
            ->count();

        $receivedThisMonth = (float) (clone $receivablesQuery)
            ->where('status', PaymentStatusEnum::PAID)
            ->whereBetween('paid_at', [$startOfMonth, $endOfMonth])
            ->sum('amount');

        $overdueReceivables = (float) (clone $receivablesQuery)
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

        $totalToPay = (float) (clone $payablesQuery)
            ->whereIn('status', [PaymentStatusEnum::UNPAID, PaymentStatusEnum::PARTIAL, PaymentStatusEnum::OVERDUE])
            ->sum('amount');

        $countToPay = (int) (clone $payablesQuery)
            ->whereIn('status', [PaymentStatusEnum::UNPAID, PaymentStatusEnum::PARTIAL, PaymentStatusEnum::OVERDUE])
            ->count();

        $paidThisMonth = (float) (clone $payablesQuery)
            ->where('status', PaymentStatusEnum::PAID)
            ->whereBetween('paid_at', [$startOfMonth, $endOfMonth])
            ->sum('amount');

        $overduePayables = (float) (clone $payablesQuery)
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

        // Calcular saldo do mês anterior para comparação
        $startOfLastMonth = (clone $today)->subMonth()->startOfMonth();
        $endOfLastMonth = (clone $today)->subMonth()->endOfMonth();

        $receivedLastMonth = (float) AccountsInstallments::query()
            ->whereHas('accounts', function ($q): void {
                $q->where('type', 'receivables');
            })
            ->where('status', PaymentStatusEnum::PAID)
            ->whereBetween('paid_at', [$startOfLastMonth, $endOfLastMonth])
            ->sum('amount');

        $paidLastMonth = (float) AccountsInstallments::query()
            ->whereHas('accounts', function ($q): void {
                $q->where('type', 'payables');
            })
            ->where('status', PaymentStatusEnum::PAID)
            ->whereBetween('paid_at', [$startOfLastMonth, $endOfLastMonth])
            ->sum('amount');

        $lastMonthBalance = $receivedLastMonth - $paidLastMonth;

        // Calcular variação percentual
        $balanceVariation = abs($lastMonthBalance) > 0.01
            ? (($monthlyBalance - $lastMonthBalance) / abs($lastMonthBalance)) * 100
            : 0;

        // Inadimplência total
        $totalOverdue = $overdueReceivables + $overduePayables;

        // Contar contas em atraso
        $countOverdue = (int) AccountsInstallments::query()
            ->where(function ($q) use ($today): void {
                $q->where('status', PaymentStatusEnum::OVERDUE)
                    ->orWhere(function ($q2) use ($today): void {
                        $q2->whereIn('status', [PaymentStatusEnum::UNPAID, PaymentStatusEnum::PARTIAL])
                            ->whereDate('due_date', '<', $today);
                    });
            })
            ->count();

        return [
            Stat::make('Saldo em caixa', 'R$ '.number_format($monthlyBalance, 2, ',', '.'))
                ->icon('heroicon-m-currency-dollar')
                ->description(($balanceVariation >= 0 ? '+ ' : '- ').number_format(abs($balanceVariation), 1, ',', '.').'% vs mês anterior')
                ->color($monthlyBalance >= 0 ? 'success' : 'danger'),

            Stat::make('A Receber', 'R$ '.number_format($totalToReceive, 2, ',', '.'))
                ->icon('heroicon-m-arrow-trending-up')
                ->description($countToReceive.' '.($countToReceive === 1 ? 'conta pendente' : 'contas pendentes'))
                ->color('success'),

            Stat::make('A Pagar', 'R$ '.number_format($totalToPay, 2, ',', '.'))
                ->icon('heroicon-m-arrow-trending-down')
                ->description($countToPay.' '.($countToPay === 1 ? 'conta pendente' : 'contas pendentes'))
                ->color('danger'),

            Stat::make('Inadimplência', 'R$ '.number_format($totalOverdue, 2, ',', '.'))
                ->icon('heroicon-m-exclamation-triangle')
                ->description($countOverdue.' '.($countOverdue === 1 ? 'conta atrasada' : 'contas atrasadas'))
                ->color('danger'),
        ];
    }

    private function getReceivablesTrend(): array
    {
        $today = Date::now();
        $startDate = (clone $today)->subDays(6)->startOfDay();
        $endDate = (clone $today)->endOfDay();

        // Otimização: Buscar todos os dados em uma única query
        $results = AccountsInstallments::query()
            ->join('accounts', 'accounts_installments.accounts_id', '=', 'accounts.id')
            ->where('accounts.type', 'receivables')
            ->where('accounts_installments.status', PaymentStatusEnum::PAID->value)
            ->whereBetween('accounts_installments.paid_at', [$startDate, $endDate])
            ->selectRaw('date(accounts_installments.paid_at) as date, SUM(accounts_installments.amount) as total')
            ->groupBy('date')
            ->get()
            ->keyBy('date');

        $trend = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = (clone $today)->subDays($i)->format('Y-m-d');
            $trend[] = (float) ($results->get($date)?->total ?? 0);
        }

        return $trend;
    }

    private function getPayablesTrend(): array
    {
        $today = Date::now();
        $startDate = (clone $today)->subDays(6)->startOfDay();
        $endDate = (clone $today)->endOfDay();

        // Otimização: Buscar todos os dados em uma única query
        $results = AccountsInstallments::query()
            ->join('accounts', 'accounts_installments.accounts_id', '=', 'accounts.id')
            ->where('accounts.type', 'payables')
            ->where('accounts_installments.status', PaymentStatusEnum::PAID->value)
            ->whereBetween('accounts_installments.paid_at', [$startDate, $endDate])
            ->selectRaw('date(accounts_installments.paid_at) as date, SUM(accounts_installments.amount) as total')
            ->groupBy('date')
            ->get()
            ->keyBy('date');

        $trend = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = (clone $today)->subDays($i)->format('Y-m-d');
            $trend[] = (float) ($results->get($date)?->total ?? 0);
        }

        return $trend;
    }

    private function getMonthlyBalanceTrend(): array
    {
        $today = Date::now();
        $startDate = (clone $today)->subDays(6)->startOfDay();
        $endDate = (clone $today)->endOfDay();

        // Otimização: Buscar todos os dados em uma única query agrupando por tipo e data
        $results = AccountsInstallments::query()
            ->join('accounts', 'accounts_installments.accounts_id', '=', 'accounts.id')
            ->where('accounts_installments.status', PaymentStatusEnum::PAID->value)
            ->whereBetween('accounts_installments.paid_at', [$startDate, $endDate])
            ->selectRaw('date(accounts_installments.paid_at) as date, accounts.type, SUM(accounts_installments.amount) as total')
            ->groupBy('date', 'accounts.type')
            ->get()
            ->groupBy('date');

        $trend = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = (clone $today)->subDays($i)->format('Y-m-d');
            $dayData = $results->get($date, collect());

            $received = (float) ($dayData->firstWhere('type', 'receivables')?->total ?? 0);
            $paid = (float) ($dayData->firstWhere('type', 'payables')?->total ?? 0);

            $trend[] = $received - $paid;
        }

        return $trend;
    }

    private function getOverdueTrend(): array
    {
        $today = Date::now();
        $trend = [];

        // Para inadimplência, precisamos calcular acumulado para cada dia
        // Buscar todas as parcelas vencidas/não pagas uma única vez
        $allOverdue = AccountsInstallments::query()
            ->select('due_date', 'amount', 'status')
            ->whereIn('status', [PaymentStatusEnum::OVERDUE, PaymentStatusEnum::UNPAID, PaymentStatusEnum::PARTIAL])
            ->get();

        for ($i = 6; $i >= 0; $i--) {
            $date = (clone $today)->subDays($i);

            // Filtrar em memória as contas vencidas até esta data
            $overdue = $allOverdue
                ->filter(function ($item) use ($date) {
                    return $item->due_date < $date;
                })
                ->sum('amount');

            $trend[] = (float) $overdue;
        }

        return $trend;
    }
}
