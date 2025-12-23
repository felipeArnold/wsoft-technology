<?php

declare(strict_types=1);

namespace App\Filament\Resources\Financial\AccountsReceivables\Pages;

use App\Filament\Resources\Financial\AccountsReceivables\AccountsReceivableResource;
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

final class ListAccountsReceivables extends ListRecords
{
    protected static string $resource = AccountsReceivableResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('Nova conta')->icon('heroicon-o-plus'),
            Action::make('export_receivables_pdf')
                ->label('Exportar PDF')
                ->icon('heroicon-o-document-arrow-down')
                ->color(Color::Gray)
                ->form([
                    Section::make('Período de Exportação')
                        ->description('Selecione o período para exportar as contas a receber.')
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
                        ->with(['person', 'user', 'installments'])
                        ->where('type', 'receivables')
                        ->whereBetween('created_at', [$startDate, $endDate]);

                    $accounts = $query->orderBy('created_at', 'desc')->get();

                    // Cálculos
                    $totalAmount = $accounts->sum('total_amount');
                    $totalPaid = $accounts->filter(function ($account) {
                        return $account->installments->where('status', 1)->count() === $account->parcels;
                    })->sum('total_amount');
                    $totalPending = $accounts->filter(function ($account) {
                        return $account->installments->where('status', 0)->count() > 0 &&
                               $account->installments->where('status', 0)->where('due_date', '>=', now())->count() > 0;
                    })->sum('total_amount');
                    $totalOverdue = $accounts->filter(function ($account) {
                        return $account->installments->where('status', 0)->where('due_date', '<', now())->count() > 0;
                    })->sum('total_amount');

                    $pdf = Pdf::loadView('pdf.accounts-receivables', [
                        'tenant' => $tenant,
                        'startDate' => $startDate,
                        'endDate' => $endDate,
                        'accounts' => $accounts,
                        'totalAmount' => $totalAmount,
                        'totalPaid' => $totalPaid,
                        'totalPending' => $totalPending,
                        'totalOverdue' => $totalOverdue,
                    ])
                        ->setPaper('a4', 'landscape')
                        ->setOption('margin-top', 10)
                        ->setOption('margin-bottom', 10)
                        ->setOption('margin-left', 10)
                        ->setOption('margin-right', 10);

                    return response()->streamDownload(
                        fn () => print ($pdf->output()),
                        'contas-receber-'.now()->format('Y-m-d').'.pdf'
                    );
                }),
        ];
    }
}
