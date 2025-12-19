<?php

declare(strict_types=1);

namespace App\Filament\Resources\Financial\Sales\Pages;

use App\Filament\Resources\Financial\Sales\SaleResource;
use App\Filament\Resources\Financial\Sales\Widgets\SalesOverview;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Facades\Filament;
use Filament\Forms\Components\DatePicker;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Section;
use Filament\Support\Colors\Color;
use Symfony\Component\HttpFoundation\Response;

final class ListSales extends ListRecords
{
    protected static string $resource = SaleResource::class;

    public function getHeaderWidgetsColumns(): int|array
    {
        return 4;
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
            Action::make('export_sales_pdf')
                ->label('Exportar PDF')
                ->icon('heroicon-o-document-arrow-down')
                ->color(Color::Gray)
                ->form([
                    Section::make('Período de Exportação')
                        ->description('Selecione o período para exportar o relatório de vendas.')
                        ->icon('heroicon-o-calendar')
                        ->schema([
                            DatePicker::make('start_date')
                                ->label('Data Inicial')
                                ->default(now()->startOfMonth())
                                ->required(),
                            DatePicker::make('end_date')
                                ->label('Data Final')
                                ->default(now()->endOfMonth())
                                ->required(),
                        ])
                        ->columns(2),
                ])
                ->action(function (array $data): Response {
                    $tenant = Filament::getTenant();
                    $startDate = Carbon::parse($data['start_date'])->startOfDay();
                    $endDate = Carbon::parse($data['end_date'])->endOfDay();

                    $query = $this->getFilteredTableQuery()
                        ->with(['person', 'user', 'items.product'])
                        ->whereBetween('created_at', [$startDate, $endDate]);

                    $sales = $query->orderBy('created_at', 'desc')->get();

                    // Cálculos gerais
                    $totalSales = $sales->sum('total_amount');
                    $totalQuantity = $sales->sum(function ($sale) {
                        return $sale->items->sum('quantity');
                    });
                    $averageTicket = $sales->count() > 0 ? $totalSales / $sales->count() : 0;

                    // Top clientes
                    $topCustomers = $sales
                        ->groupBy('person.id')
                        ->map(function ($group) {
                            return (object) [
                                'person_name' => $group->first()->person->name ?? 'N/A',
                                'total' => $group->sum('total_amount'),
                                'count' => $group->count(),
                            ];
                        })
                        ->sortByDesc('total')
                        ->take(10)
                        ->values();

                    // Top produtos
                    $topProducts = $sales
                        ->flatMap(fn ($sale) => $sale->items)
                        ->groupBy('product.id')
                        ->map(function ($group) {
                            return (object) [
                                'product_name' => $group->first()->product->name ?? 'N/A',
                                'quantity' => $group->sum('quantity'),
                                'total' => $group->sum('total'),
                            ];
                        })
                        ->sortByDesc('total')
                        ->take(10)
                        ->values();

                    // Vendas por dia
                    $salesByDay = $sales
                        ->groupBy(function ($sale) {
                            return $sale->created_at->format('Y-m-d');
                        })
                        ->map(function ($group, $key) {
                            return (object) [
                                'date' => Carbon::parse($key)->format('d/m/Y'),
                                'count' => $group->count(),
                                'total' => $group->sum('total_amount'),
                            ];
                        })
                        ->sortKeys()
                        ->values();

                    $pdf = Pdf::loadView('pdf.sales', [
                        'tenant' => $tenant,
                        'startDate' => $startDate,
                        'endDate' => $endDate,
                        'sales' => $sales,
                        'totalSales' => $totalSales,
                        'totalQuantity' => $totalQuantity,
                        'averageTicket' => $averageTicket,
                        'topCustomers' => $topCustomers,
                        'topProducts' => $topProducts,
                        'salesByDay' => $salesByDay,
                    ])
                        ->setPaper('a4', 'landscape')
                        ->setOption('margin-top', 10)
                        ->setOption('margin-bottom', 10)
                        ->setOption('margin-left', 10)
                        ->setOption('margin-right', 10);

                    return response()->streamDownload(
                        fn () => print ($pdf->output()),
                        'vendas-'.now()->format('Y-m-d').'.pdf'
                    );
                }),
        ];
    }
}
