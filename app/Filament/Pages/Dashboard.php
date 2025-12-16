<?php

declare(strict_types=1);

namespace App\Filament\Pages;

use App\Filament\Widgets\ExpensesByCategoryWidget;
use App\Filament\Widgets\FinancialDashboardOverview;
use App\Filament\Widgets\LowStockProductsWidget;
use App\Filament\Widgets\MonthlyCashFlow;
use App\Filament\Widgets\MonthlyExpensesDistributionWidget;
use App\Filament\Widgets\OverdueAccounts;
use App\Filament\Widgets\PaymentMethodsChart;
use App\Filament\Widgets\TopSellingProductsWidget;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Schema;

final class Dashboard extends BaseDashboard
{
    public function getColumns(): int
    {
        return 2;
    }

    public function content(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Dashboard')
                    ->tabs([
                        Tabs\Tab::make('Visão Geral')
                            ->icon('heroicon-o-chart-bar')
                            ->schema(
                                $this->getWidgetsSchemaComponents([
                                    FinancialDashboardOverview::class,
                                    MonthlyCashFlow::class,
                                ])
                            ),

                        Tabs\Tab::make('Financeiro')
                            ->icon('heroicon-o-currency-dollar')
                            ->schema(
                                $this->getWidgetsSchemaComponents([
                                    FinancialDashboardOverview::class,
                                    MonthlyCashFlow::class,
                                    ExpensesByCategoryWidget::class,
                                    MonthlyExpensesDistributionWidget::class,
                                    PaymentMethodsChart::class,
                                    OverdueAccounts::class,
                                ])
                            ),

                        Tabs\Tab::make('Vendas')
                            ->icon('heroicon-o-shopping-cart')
                            ->schema(
                                $this->getWidgetsSchemaComponents([
                                    TopSellingProductsWidget::class,
                                ])
                            ),

                        // ordem de serviço
                        Tabs\Tab::make('Ordem de Serviço')
                            ->icon('heroicon-o-wrench-screwdriver')
                            ->schema(
                                $this->getWidgetsSchemaComponents([
                                    // OrdemDeServicoWidget::class,
                                ])
                            ),

                        Tabs\Tab::make('Estoque')
                            ->icon('heroicon-o-cube')
                            ->schema(
                                $this->getWidgetsSchemaComponents([
                                    LowStockProductsWidget::class,
                                ])
                            ),
                    ])
                    ->persistTabInQueryString(),

            ]);
    }
}
