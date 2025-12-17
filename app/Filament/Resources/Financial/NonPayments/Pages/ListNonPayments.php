<?php

declare(strict_types=1);

namespace App\Filament\Resources\Financial\NonPayments\Pages;

use App\Filament\Resources\Financial\NonPayments\NonPaymentResource;
use App\Models\Accounts\AccountsInstallments;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms\Components\DatePicker;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Support\Colors\Color;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\HttpFoundation\Response;

final class ListNonPayments extends ListRecords
{
    protected static string $resource = NonPaymentResource::class;

    public function getTabs(): array
    {
        return [
            'critical' => Tab::make()
                ->label('Crítico (>90 dias)')
                ->badge(fn () => $this->getCriticalOverdueCount())
                ->badgeColor('danger')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('due_date', '<=', now()->subDays(90))),
            'overdue' => Tab::make()
                ->label('Vencidas (30-90 dias)')
                ->badge(fn () => $this->getOverdueCount())
                ->badgeColor('warning')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereBetween('due_date', [now()->subDays(90), now()->subDays(30)])),
            'recent' => Tab::make()
                ->label('Recentes (<30 dias)')
                ->badge(fn () => $this->getRecentOverdueCount())
                ->badgeColor('info')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereBetween('due_date', [now()->subDays(30), now()])),
            'all' => Tab::make()
                ->label('Todas')
                // ->badge(fn () => $this->getAllOverdueCount())
                ->badgeColor('gray'),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('export_overdue')
                ->label('Exportar PDF')
                ->icon('heroicon-o-document-arrow-down')
                ->color(Color::Gray)
                ->form([
                    Section::make('Período de Exportação')
                        ->description('Selecione o período para exportar o relatório de inadimplência.')
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
                        ->with(['accounts.person', 'accounts.user'])
                        ->whereBetween('due_date', [$startDate, $endDate]);

                    $installments = $query->orderBy('due_date', 'asc')->get();

                    // Análise por gravidade
                    $critical = $installments->filter(fn ($i) => $i->due_date <= now()->subDays(90));
                    $overdue = $installments->filter(fn ($i) => $i->due_date > now()->subDays(90) && $i->due_date <= now()->subDays(30));
                    $recent = $installments->filter(fn ($i) => $i->due_date > now()->subDays(30));

                    // Cálculos
                    $totalOverdue = $installments->sum('amount');
                    $totalCritical = $critical->sum('amount');
                    $totalOverdueRange = $overdue->sum('amount');
                    $totalRecent = $recent->sum('amount');

                    // Top devedores
                    $topDebtors = $installments
                        ->groupBy('accounts.person.id')
                        ->map(function ($group) {
                            return (object) [
                                'person_name' => $group->first()->accounts->person->name ?? 'N/A',
                                'total' => $group->sum('amount'),
                                'count' => $group->count(),
                            ];
                        })
                        ->sortByDesc('total')
                        ->take(10)
                        ->values();

                    $pdf = Pdf::loadView('pdf.non-payments', [
                        'tenant' => $tenant,
                        'startDate' => $startDate,
                        'endDate' => $endDate,
                        'installments' => $installments,
                        'critical' => $critical,
                        'overdue' => $overdue,
                        'recent' => $recent,
                        'totalOverdue' => $totalOverdue,
                        'totalCritical' => $totalCritical,
                        'totalOverdueRange' => $totalOverdueRange,
                        'totalRecent' => $totalRecent,
                        'topDebtors' => $topDebtors,
                    ])
                        ->setPaper('a4', 'landscape')
                        ->setOption('margin-top', 10)
                        ->setOption('margin-bottom', 10)
                        ->setOption('margin-left', 10)
                        ->setOption('margin-right', 10);

                    return response()->streamDownload(
                        fn () => print ($pdf->output()),
                        'inadimplencia-'.now()->format('Y-m-d').'.pdf'
                    );
                }),
            Action::make('send_bulk_reminders')
                ->label('Enviar Lembretes')
                ->icon('heroicon-o-envelope')
                ->hidden()
                ->color('primary')
                ->requiresConfirmation()
                ->modalHeading('Enviar Lembretes em Lote')
                ->modalDescription('Enviar lembretes de pagamento para todos os clientes inadimplentes?')
                ->action(function (): void {}),
        ];
    }

    private function getCriticalOverdueCount(): int
    {
        return AccountsInstallments::query()
            ->where('status', 0)
            ->where('due_date', '<=', now()->subDays(90))
            ->whereHas('accounts', function ($query): void {
                $query->where('type', 'receivables');
            })
            ->count();
    }

    private function getOverdueCount(): int
    {
        return AccountsInstallments::query()
            ->where('status', 0)
            ->whereBetween('due_date', [now()->subDays(90), now()->subDays(30)])
            ->whereHas('accounts', function ($query): void {
                $query->where('type', 'receivables');
            })
            ->count();
    }

    private function getRecentOverdueCount(): int
    {
        return AccountsInstallments::query()
            ->where('status', 0)
            ->whereBetween('due_date', [now()->subDays(30), now()])
            ->whereHas('accounts', function ($query): void {
                $query->where('type', 'receivables');
            })
            ->count();
    }

    private function getAllOverdueCount(): int
    {
        return AccountsInstallments::query()
            ->where('status', 0)
            ->where('due_date', '<=', now())
            ->whereHas('accounts', function ($query): void {
                $query->where('type', 'receivables');
            })
            ->count();
    }
}
