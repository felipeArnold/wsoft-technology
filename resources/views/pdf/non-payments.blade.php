<x-layouts.pdf :title="'Relatório de Inadimplência'">

    <x-pdf.header
        :tenant="$tenant"
        title="RELATÓRIO DE INADIMPLÊNCIA"
        :subtitle="'Período: ' . $startDate->format('d/m/Y') . ' à ' . $endDate->format('d/m/Y')"
    />

    <!-- Resumo por Gravidade -->
    <div class="section">
        <div class="section-title">ANÁLISE POR GRAVIDADE</div>
        <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
            <tr>
                <td style="width: 25%; padding: 10px;">
                    <div style="background-color: #f3f4f6; border-left: 4px solid #6b7280; padding: 15px; border-radius: 5px;">
                        <div style="font-size: 10px; color: #4b5563; font-weight: bold; margin-bottom: 5px;">TOTAL INADIMPLENTE</div>
                        <div style="font-size: 16px; color: #1f2937; font-weight: bold;">R$ {{ number_format($totalOverdue, 2, ',', '.') }}</div>
                        <div style="font-size: 8px; color: #6b7280; margin-top: 3px;">{{ $installments->count() }} parcelas</div>
                    </div>
                </td>
                <td style="width: 25%; padding: 10px;">
                    <div style="background-color: #fee2e2; border-left: 4px solid #dc2626; padding: 15px; border-radius: 5px;">
                        <div style="font-size: 10px; color: #b91c1c; font-weight: bold; margin-bottom: 5px;">CRÍTICO (>90 dias)</div>
                        <div style="font-size: 16px; color: #dc2626; font-weight: bold;">R$ {{ number_format($totalCritical, 2, ',', '.') }}</div>
                        <div style="font-size: 8px; color: #b91c1c; margin-top: 3px;">{{ $critical->count() }} parcelas</div>
                    </div>
                </td>
                <td style="width: 25%; padding: 10px;">
                    <div style="background-color: #fef3c7; border-left: 4px solid #d97706; padding: 15px; border-radius: 5px;">
                        <div style="font-size: 10px; color: #92400e; font-weight: bold; margin-bottom: 5px;">VENCIDO (30-90 dias)</div>
                        <div style="font-size: 16px; color: #d97706; font-weight: bold;">R$ {{ number_format($totalOverdueRange, 2, ',', '.') }}</div>
                        <div style="font-size: 8px; color: #92400e; margin-top: 3px;">{{ $overdue->count() }} parcelas</div>
                    </div>
                </td>
                <td style="width: 25%; padding: 10px;">
                    <div style="background-color: #dbeafe; border-left: 4px solid #3b82f6; padding: 15px; border-radius: 5px;">
                        <div style="font-size: 10px; color: #1e40af; font-weight: bold; margin-bottom: 5px;">RECENTE (<30 dias)</div>
                        <div style="font-size: 16px; color: #3b82f6; font-weight: bold;">R$ {{ number_format($totalRecent, 2, ',', '.') }}</div>
                        <div style="font-size: 8px; color: #1e40af; margin-top: 3px;">{{ $recent->count() }} parcelas</div>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <!-- Top Devedores -->
    @if($topDebtors->count() > 0)
    <div class="section">
        <div class="section-title">TOP 10 DEVEDORES</div>
        <table style="width: 100%; border-collapse: collapse; font-size: 9px; margin-top: 10px;">
            <thead>
                <tr style="background-color: #374151; color: white;">
                    <th style="padding: 8px; text-align: left; border: 1px solid #4b5563;">Cliente</th>
                    <th style="padding: 8px; text-align: center; border: 1px solid #4b5563; width: 15%;">Qtd Parcelas</th>
                    <th style="padding: 8px; text-align: right; border: 1px solid #4b5563; width: 20%;">Total Devido</th>
                </tr>
            </thead>
            <tbody>
                @foreach($topDebtors as $debtor)
                <tr style="border-bottom: 1px solid #e5e7eb;">
                    <td style="padding: 6px; border: 1px solid #e5e7eb;">{{ $debtor->person_name }}</td>
                    <td style="padding: 6px; text-align: center; border: 1px solid #e5e7eb;">{{ $debtor->count }}</td>
                    <td style="padding: 6px; text-align: right; border: 1px solid #e5e7eb; font-weight: bold; color: #dc2626;">
                        R$ {{ number_format($debtor->total, 2, ',', '.') }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    <!-- Detalhamento -->
    <div class="section">
        <div class="section-title">DETALHAMENTO DAS PARCELAS INADIMPLENTES</div>
        @if($installments->count() > 0)
        <table style="width: 100%; border-collapse: collapse; font-size: 9px; margin-top: 10px;">
            <thead>
                <tr style="background-color: #374151; color: white;">
                    <th style="padding: 8px; text-align: left; border: 1px solid #4b5563;">Cliente</th>
                    <th style="padding: 8px; text-align: center; border: 1px solid #4b5563; width: 10%;">Parcela</th>
                    <th style="padding: 8px; text-align: right; border: 1px solid #4b5563; width: 15%;">Valor</th>
                    <th style="padding: 8px; text-align: center; border: 1px solid #4b5563; width: 12%;">Vencimento</th>
                    <th style="padding: 8px; text-align: center; border: 1px solid #4b5563; width: 12%;">Dias</th>
                    <th style="padding: 8px; text-align: center; border: 1px solid #4b5563; width: 10%;">Gravidade</th>
                </tr>
            </thead>
            <tbody>
                @foreach($installments->take(50) as $installment)
                @php
                    $daysOverdue = now()->diffInDays($installment->due_date);
                @endphp
                <tr style="border-bottom: 1px solid #e5e7eb;">
                    <td style="padding: 6px; border: 1px solid #e5e7eb;">{{ $installment->accounts->person->name ?? 'N/A' }}</td>
                    <td style="padding: 6px; text-align: center; border: 1px solid #e5e7eb;">
                        {{ $installment->installment_number }}/{{ $installment->accounts->parcels }}
                    </td>
                    <td style="padding: 6px; text-align: right; border: 1px solid #e5e7eb; font-weight: bold;">
                        R$ {{ number_format($installment->amount, 2, ',', '.') }}
                    </td>
                    <td style="padding: 6px; text-align: center; border: 1px solid #e5e7eb;">
                        {{ $installment->due_date->format('d/m/Y') }}
                    </td>
                    <td style="padding: 6px; text-align: center; border: 1px solid #e5e7eb; font-weight: bold;">
                        {{ $daysOverdue }}
                    </td>
                    <td style="padding: 6px; text-align: center; border: 1px solid #e5e7eb;">
                        @if($daysOverdue > 90)
                            <span style="background-color: #fee2e2; color: #dc2626; padding: 2px 6px; border-radius: 8px; font-size: 8px; font-weight: bold;">CRÍTICO</span>
                        @elseif($daysOverdue > 30)
                            <span style="background-color: #fef3c7; color: #d97706; padding: 2px 6px; border-radius: 8px; font-size: 8px; font-weight: bold;">VENCIDO</span>
                        @else
                            <span style="background-color: #dbeafe; color: #3b82f6; padding: 2px 6px; border-radius: 8px; font-size: 8px; font-weight: bold;">RECENTE</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if($installments->count() > 50)
        <div style="margin-top: 10px; font-size: 9px; color: #6b7280; text-align: center;">
            * Exibindo as primeiras 50 parcelas de {{ $installments->count() }} parcelas inadimplentes
        </div>
        @endif
        @else
        <div class="alert-info">Nenhuma inadimplência encontrada no período selecionado.</div>
        @endif
    </div>

    <x-pdf.footer
        :documentNumber="'#IND-' . now()->format('YmdHis')"
        documentType="Relatório de Inadimplência"
    />

</x-layouts.pdf>
