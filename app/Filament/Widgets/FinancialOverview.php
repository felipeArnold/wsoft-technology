<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Enum\AccountsReceivable\PaymentStatusEnum;
use App\Models\Accounts\AccountsInstallments;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

final class FinancialOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $currentMonth = Carbon::now();
        $startOfMonth = $currentMonth->copy()->startOfMonth();
        $endOfMonth = $currentMonth->copy()->endOfMonth();

        // Receitas do mês atual
        $monthlyIncome = AccountsInstallments::query()
            ->whereHas('accounts', function ($query): void {
                $query->where('type', 'receivables');
            })
            ->where('status', PaymentStatusEnum::PAID)
            ->whereBetween('paid_at', [$startOfMonth, $endOfMonth])
            ->sum('amount');

        // Despesas do mês atual
        $monthlyExpenses = AccountsInstallments::query()
            ->whereHas('accounts', function ($query): void {
                $query->where('type', 'payables');
            })
            ->where('status', PaymentStatusEnum::PAID)
            ->whereBetween('paid_at', [$startOfMonth, $endOfMonth])
            ->sum('amount');

        // Contas a receber em aberto
        $receivablesOpen = AccountsInstallments::query()
            ->whereHas('accounts', function ($query): void {
                $query->where('type', 'receivables');
            })
            ->where('status', PaymentStatusEnum::UNPAID)
            ->sum('amount');

        // Contas a pagar em aberto
        $payablesOpen = AccountsInstallments::query()
            ->whereHas('accounts', function ($query): void {
                $query->where('type', 'payables');
            })
            ->where('status', PaymentStatusEnum::UNPAID)
            ->sum('amount');

        // Contas vencidas
        $overdueAmount = AccountsInstallments::query()
            ->where('status', PaymentStatusEnum::OVERDUE)
            ->sum('amount');

        // Saldo líquido do mês
        $netBalance = $monthlyIncome - $monthlyExpenses;

        return [
            Stat::make('Receitas do Mês', 'R$ '.number_format($monthlyIncome, 2, ',', '.'))
                ->description('Receitas pagas em '.$currentMonth->locale('pt_BR')->isoFormat('MMMM'))
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),

            Stat::make('Despesas do Mês', 'R$ '.number_format($monthlyExpenses, 2, ',', '.'))
                ->description('Despesas pagas em '.$currentMonth->locale('pt_BR')->isoFormat('MMMM'))
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger'),

            Stat::make('Saldo Líquido', 'R$ '.number_format($netBalance, 2, ',', '.'))
                ->description($netBalance >= 0 ? 'Saldo positivo' : 'Saldo negativo')
                ->descriptionIcon($netBalance >= 0 ? 'heroicon-m-check-circle' : 'heroicon-m-exclamation-triangle')
                ->color($netBalance >= 0 ? 'success' : 'danger'),

            Stat::make('A Receber', 'R$ '.number_format($receivablesOpen, 2, ',', '.'))
                ->description('Contas a receber em aberto')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),

            Stat::make('A Pagar', 'R$ '.number_format($payablesOpen, 2, ',', '.'))
                ->description('Contas a pagar em aberto')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),

            Stat::make('Vencidas', 'R$ '.number_format($overdueAmount, 2, ',', '.'))
                ->description('Valor total em atraso')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('danger'),
        ];
    }
}
