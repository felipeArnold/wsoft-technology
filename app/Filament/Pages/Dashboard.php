<?php

declare(strict_types=1);

namespace App\Filament\Pages;

use App\Filament\Widgets\BusinessMetricsOverview;
use App\Filament\Widgets\ChurnRateChart;
use App\Filament\Widgets\CommissionsOverview;
use App\Filament\Widgets\CommissionsTrendChart;
use App\Filament\Widgets\ExpensesByCategoryWidget;
use App\Filament\Widgets\FinancialDashboardOverview;
use App\Filament\Widgets\LowStockProductsWidget;
use App\Filament\Widgets\LtvTrendChart;
use App\Filament\Widgets\MonthlyCashFlow;
use App\Filament\Widgets\MonthlyExpensesDistributionWidget;
use App\Filament\Widgets\MrrTrendChart;
use App\Filament\Widgets\OverdueAccounts;
use App\Filament\Widgets\PaymentMethodsChart;
use App\Filament\Widgets\RecentStockMovementsWidget;
use App\Filament\Widgets\SalesByCategoryWidget;
use App\Filament\Widgets\SalesOverviewWidget;
use App\Filament\Widgets\SalesRevenueChart;
use App\Filament\Widgets\ServiceOrdersByStatusChart;
use App\Filament\Widgets\ServiceOrdersCompletionTrend;
use App\Filament\Widgets\ServiceOrdersCreationByDayChart;
use App\Filament\Widgets\ServiceOrdersOverview;
use App\Filament\Widgets\StockMovementsByTypeWidget;
use App\Filament\Widgets\StockOverviewWidget;
use App\Filament\Widgets\StockValueByCategoryWidget;
use App\Filament\Widgets\TopSellingProductsWidget;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Schema;

final class Dashboard extends BaseDashboard
{
    public function getColumns(): int
    {
        return 5;
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

                        Tabs\Tab::make('Métricas de Negócio')
                            ->icon('heroicon-o-chart-pie')
                            ->schema(
                                $this->getWidgetsSchemaComponents([
                                    BusinessMetricsOverview::class,
                                    MrrTrendChart::class,
                                    LtvTrendChart::class,
                                    ChurnRateChart::class,
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
                                    SalesOverviewWidget::class,
                                    SalesRevenueChart::class,
                                    TopSellingProductsWidget::class,
                                    SalesByCategoryWidget::class,
                                ])
                            ),

                        Tabs\Tab::make('Ordem de Serviço')
                            ->icon('heroicon-o-wrench-screwdriver')
                            ->schema(
                                $this->getWidgetsSchemaComponents([
                                    ServiceOrdersOverview::class,
                                    ServiceOrdersCreationByDayChart::class,
                                    ServiceOrdersByStatusChart::class,
                                    ServiceOrdersCompletionTrend::class,
                                ])
                            ),

                        Tabs\Tab::make('Comissões')
                            ->icon('heroicon-o-banknotes')
                            ->schema(
                                $this->getWidgetsSchemaComponents([
                                    CommissionsOverview::class,
                                    CommissionsTrendChart::class,
                                ])
                            ),

                        Tabs\Tab::make('Estoque')
                            ->icon('heroicon-o-cube')
                            ->schema(
                                $this->getWidgetsSchemaComponents([
                                    StockOverviewWidget::class,
                                    StockMovementsByTypeWidget::class,
                                    StockValueByCategoryWidget::class,
                                    LowStockProductsWidget::class,
                                    RecentStockMovementsWidget::class,
                                ])
                            ),
                    ])
                    ->persistTabInQueryString(),

            ]);
    }
}
