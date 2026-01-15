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
use Filament\Forms\Components\Placeholder;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs\Tab;
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
                ->label('Exportar Relatório')
                ->icon('heroicon-o-document-arrow-down')
                ->color('danger')
                ->modalHeading('Exportar Relatório de Inadimplência')
                ->modalDescription('Gere um relatório detalhado com análise de inadimplência por período.')
                ->modalIcon('heroicon-o-document-chart-bar')
                ->modalWidth('md')
                ->form([
                    Section::make('Configurações do Relatório')
                        ->description('Defina o período e os critérios para o relatório de inadimplência')
                        ->icon('heroicon-o-adjustments-horizontal')
                        ->schema([
                            DatePicker::make('start_date')
                                ->label('Data Inicial')
                                ->helperText('Data de início do período de análise')
                                ->default(now()->startOfMonth())
                                ->native(false)
                                ->displayFormat('d/m/Y')
                                ->maxDate(now())
                                ->required()
                                ->columnSpan(1),
                            DatePicker::make('end_date')
                                ->label('Data Final')
                                ->helperText('Data de término do período de análise')
                                ->default(now())
                                ->native(false)
                                ->displayFormat('d/m/Y')
                                ->maxDate(now())
                                ->afterOrEqual('start_date')
                                ->required()
                                ->columnSpan(1),
                        ])
                        ->columns(1)
                        ->columnSpanFull(),

                    Section::make('Resumo Atual')
                        ->description('Estatísticas atuais de inadimplência')
                        ->icon('heroicon-o-chart-bar')
                        ->schema([
                            Placeholder::make('current_stats')
                                ->label('')
                                ->content(function () {
                                    $criticalCount = $this->getCriticalOverdueCount();
                                    $overdueCount = $this->getOverdueCount();
                                    $recentCount = $this->getRecentOverdueCount();
                                    $totalCount = $criticalCount + $overdueCount + $recentCount;

                                    return new \Illuminate\Support\HtmlString("
                                        <div style='display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px; margin-top: 8px;'>
                                            <div style='background: #f3f4f6; padding: 12px; border-radius: 6px; text-align: center;'>
                                                <div style='font-size: 11px; color: #6b7280; font-weight: 600; margin-bottom: 4px;'>TOTAL</div>
                                                <div style='font-size: 24px; font-weight: bold; color: #1f2937;'>{$totalCount}</div>
                                            </div>
                                            <div style='background: #fee2e2; padding: 12px; border-radius: 6px; text-align: center;'>
                                                <div style='font-size: 11px; color: #991b1b; font-weight: 600; margin-bottom: 4px;'>CRÍTICO</div>
                                                <div style='font-size: 24px; font-weight: bold; color: #dc2626;'>{$criticalCount}</div>
                                            </div>
                                            <div style='background: #fef3c7; padding: 12px; border-radius: 6px; text-align: center;'>
                                                <div style='font-size: 11px; color: #92400e; font-weight: 600; margin-bottom: 4px;'>VENCIDO</div>
                                                <div style='font-size: 24px; font-weight: bold; color: #d97706;'>{$overdueCount}</div>
                                            </div>
                                            <div style='background: #dbeafe; padding: 12px; border-radius: 6px; text-align: center;'>
                                                <div style='font-size: 11px; color: #1e40af; font-weight: 600; margin-bottom: 4px;'>RECENTE</div>
                                                <div style='font-size: 24px; font-weight: bold; color: #3b82f6;'>{$recentCount}</div>
                                            </div>
                                        </div>
                                    ");
                                })
                                ->columnSpanFull(),
                        ])
                        ->columnSpanFull()
                        ->collapsed(),
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

                    $fileName = sprintf(
                        'relatorio-inadimplencia-%s-a-%s.pdf',
                        $startDate->format('d-m-Y'),
                        $endDate->format('d-m-Y')
                    );

                    return response()->streamDownload(
                        fn () => print ($pdf->output()),
                        $fileName
                    );
                })
                ->successNotificationTitle('Relatório gerado com sucesso!')
                ->after(function (): void {
                    // Notificação adicional com informações do relatório
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
