<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Enum\AccountsReceivable\PaymentStatusEnum;
use App\Models\Accounts\AccountsInstallments;
use App\Models\Person\Person;
use App\Models\Sale;
use App\Models\ServiceOrder;
use DateTimeInterface;
use Filament\Facades\Filament;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

final class BusinessMetricsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected int|string|array $columnSpan = 'full';

    protected static bool $isLazy = true;

    protected function getStats(): array
    {
        $tenant = Filament::getTenant();
        $today = Date::now();

        // Calcular MRR
        $currentMrr = $this->calculateMrr($tenant?->id, $today);
        $lastMonthMrr = $this->calculateMrr($tenant?->id, (clone $today)->subMonth());
        $mrrChange = $this->calculatePercentageChange($lastMonthMrr, $currentMrr);

        // Calcular LTV médio
        $averageLtv = $this->calculateAverageLtv($tenant?->id);

        // Calcular Churn Rate
        $churnRate = $this->calculateChurnRate($tenant?->id, $today);
        $churnedCount = $this->getChurnedCustomersCount($tenant?->id, $today);

        return [
            Stat::make('MRR', 'R$ '.number_format($currentMrr, 2, ',', '.'))
                ->description(
                    ($mrrChange >= 0 ? '+ ' : '- ').
                    number_format(abs($mrrChange), 1, ',', '.').
                    '% vs mês anterior'
                )
                ->descriptionIcon($mrrChange >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($mrrChange >= 0 ? 'success' : 'danger')
                ->chart($this->getMrrTrendLast7Days($tenant?->id)),

            Stat::make('LTV Médio', 'R$ '.number_format($averageLtv, 2, ',', '.'))
                ->description('Valor médio por cliente')
                ->descriptionIcon('heroicon-m-user-circle')
                ->color('info'),

            Stat::make('Churn Rate', number_format($churnRate, 1, ',', '.').'%')
                ->description($churnedCount.' '.($churnedCount === 1 ? 'cliente inativo' : 'clientes inativos').' (60+ dias)')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color(
                    $churnRate > 5 ? 'danger' :
                    ($churnRate > 2 ? 'warning' : 'success')
                ),
        ];
    }

    private function calculateMrr(?int $tenantId, DateTimeInterface $date): float
    {
        $startOfMonth = (clone $date)->modify('first day of this month')->setTime(0, 0);
        $endOfMonth = (clone $date)->modify('last day of this month')->setTime(23, 59, 59);

        $mrr = AccountsInstallments::query()
            ->join('accounts', 'accounts_installments.accounts_id', '=', 'accounts.id')
            ->where('accounts_installments.tenant_id', $tenantId)
            ->where('accounts.type', 'receivables')
            ->where('accounts.recurring', true)
            ->whereIn('accounts_installments.status', [
                PaymentStatusEnum::PAID,
                PaymentStatusEnum::UNPAID,
                PaymentStatusEnum::PARTIAL,
            ])
            ->whereBetween('accounts_installments.due_date', [$startOfMonth, $endOfMonth])
            ->sum('accounts_installments.amount');

        return (float) $mrr;
    }

    private function calculatePercentageChange(float $oldValue, float $newValue): float
    {
        if (abs($oldValue) < 0.01) {
            return 0;
        }

        return (($newValue - $oldValue) / abs($oldValue)) * 100;
    }

    private function getMrrTrendLast7Days(?int $tenantId): array
    {
        $today = Date::now();
        $startDate = (clone $today)->subDays(6)->setTime(0, 0);
        $endDate = (clone $today)->setTime(23, 59, 59);

        // Buscar todos os dados em uma única query
        $results = AccountsInstallments::query()
            ->join('accounts', 'accounts_installments.accounts_id', '=', 'accounts.id')
            ->where('accounts_installments.tenant_id', $tenantId)
            ->where('accounts.type', 'receivables')
            ->where('accounts.recurring', true)
            ->whereIn('accounts_installments.status', [
                PaymentStatusEnum::PAID,
                PaymentStatusEnum::UNPAID,
                PaymentStatusEnum::PARTIAL,
            ])
            ->whereBetween('accounts_installments.due_date', [$startDate, $endDate])
            ->selectRaw('date(accounts_installments.due_date) as date, SUM(accounts_installments.amount) as total')
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

    private function calculateAverageLtv(?int $tenantId): float
    {
        // Buscar todos os clientes e calcular LTV de cada um
        $clients = Person::query()
            ->where('tenant_id', $tenantId)
            ->where('is_client', true)
            ->get();

        if ($clients->isEmpty()) {
            return 0;
        }

        $totalLtv = 0;

        foreach ($clients as $client) {
            // Somar vendas concluídas
            $salesTotal = Sale::query()
                ->where('person_id', $client->id)
                ->where('status', 'completed')
                ->sum('total');

            // Somar ordens de serviço concluídas
            $serviceOrdersTotal = ServiceOrder::query()
                ->where('person_id', $client->id)
                ->where('status', 'completed')
                ->sum('total_value');

            // Somar contas pagas
            $accountsTotal = DB::table('accounts_installments')
                ->join('accounts', 'accounts_installments.accounts_id', '=', 'accounts.id')
                ->where('accounts.person_id', $client->id)
                ->where('accounts_installments.status', PaymentStatusEnum::PAID->value)
                ->sum('accounts_installments.amount');

            $totalLtv += (float) $salesTotal + (float) $serviceOrdersTotal + (float) $accountsTotal;
        }

        return $totalLtv / $clients->count();
    }

    private function calculateChurnRate(?int $tenantId, DateTimeInterface $date): float
    {
        // Data de 60 dias atrás
        $churnThreshold = (clone $date)->modify('-60 days');

        // Total de clientes que já fizeram pagamentos
        $totalCustomersWithPayments = DB::table('people')
            ->where('people.tenant_id', $tenantId)
            ->where('people.is_client', true)
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('accounts')
                    ->whereColumn('accounts.person_id', 'people.id')
                    ->join('accounts_installments', 'accounts.id', '=', 'accounts_installments.accounts_id')
                    ->where('accounts_installments.status', PaymentStatusEnum::PAID->value);
            })
            ->count();

        if ($totalCustomersWithPayments === 0) {
            return 0;
        }

        // Clientes que não pagaram nos últimos 60 dias (churned)
        $churnedCustomers = DB::table('people')
            ->where('people.tenant_id', $tenantId)
            ->where('people.is_client', true)
            ->whereExists(function ($query) {
                // Garantir que o cliente já teve algum pagamento
                $query->select(DB::raw(1))
                    ->from('accounts')
                    ->whereColumn('accounts.person_id', 'people.id')
                    ->join('accounts_installments', 'accounts.id', '=', 'accounts_installments.accounts_id')
                    ->where('accounts_installments.status', PaymentStatusEnum::PAID->value);
            })
            ->whereNotExists(function ($query) use ($churnThreshold) {
                // Não tem pagamentos nos últimos 60 dias
                $query->select(DB::raw(1))
                    ->from('accounts')
                    ->whereColumn('accounts.person_id', 'people.id')
                    ->join('accounts_installments', 'accounts.id', '=', 'accounts_installments.accounts_id')
                    ->where('accounts_installments.status', PaymentStatusEnum::PAID->value)
                    ->where('accounts_installments.paid_at', '>=', $churnThreshold);
            })
            ->count();

        return ($churnedCustomers / $totalCustomersWithPayments) * 100;
    }

    private function getChurnedCustomersCount(?int $tenantId, DateTimeInterface $date): int
    {
        // Data de 60 dias atrás
        $churnThreshold = (clone $date)->modify('-60 days');

        // Clientes que não pagaram nos últimos 60 dias
        return DB::table('people')
            ->where('people.tenant_id', $tenantId)
            ->where('people.is_client', true)
            ->whereExists(function ($query) {
                // Garantir que o cliente já teve algum pagamento
                $query->select(DB::raw(1))
                    ->from('accounts')
                    ->whereColumn('accounts.person_id', 'people.id')
                    ->join('accounts_installments', 'accounts.id', '=', 'accounts_installments.accounts_id')
                    ->where('accounts_installments.status', PaymentStatusEnum::PAID->value);
            })
            ->whereNotExists(function ($query) use ($churnThreshold) {
                // Não tem pagamentos nos últimos 60 dias
                $query->select(DB::raw(1))
                    ->from('accounts')
                    ->whereColumn('accounts.person_id', 'people.id')
                    ->join('accounts_installments', 'accounts.id', '=', 'accounts_installments.accounts_id')
                    ->where('accounts_installments.status', PaymentStatusEnum::PAID->value)
                    ->where('accounts_installments.paid_at', '>=', $churnThreshold);
            })
            ->count();
    }
}
