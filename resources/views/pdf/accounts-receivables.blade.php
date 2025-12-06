<x-layouts.pdf :title="'Contas a Receber'">

    <x-pdf.header
        :tenant="$tenant"
        title="CONTAS A RECEBER"
        :subtitle="'Período: ' . $startDate->format('d/m/Y') . ' à ' . $endDate->format('d/m/Y')"
    />

    <!-- Resumo -->
    <div class="section">
        <div class="section-title">RESUMO FINANCEIRO</div>
        <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
            <tr>
                <td style="width: 25%; padding: 10px;">
                    <div style="background-color: #dbeafe; border-left: 4px solid #2563eb; padding: 15px; border-radius: 5px;">
                        <div style="font-size: 10px; color: #1e40af; font-weight: bold; margin-bottom: 5px;">TOTAL</div>
                        <div style="font-size: 16px; color: #2563eb; font-weight: bold;">R$ {{ number_format($totalAmount, 2, ',', '.') }}</div>
                    </div>
                </td>
                <td style="width: 25%; padding: 10px;">
                    <div style="background-color: #d1fae5; border-left: 4px solid #059669; padding: 15px; border-radius: 5px;">
                        <div style="font-size: 10px; color: #047857; font-weight: bold; margin-bottom: 5px;">RECEBIDO</div>
                        <div style="font-size: 16px; color: #059669; font-weight: bold;">R$ {{ number_format($totalPaid, 2, ',', '.') }}</div>
                    </div>
                </td>
                <td style="width: 25%; padding: 10px;">
                    <div style="background-color: #fef3c7; border-left: 4px solid #b45309; padding: 15px; border-radius: 5px;">
                        <div style="font-size: 10px; color: #92400e; font-weight: bold; margin-bottom: 5px;">A RECEBER</div>
                        <div style="font-size: 16px; color: #b45309; font-weight: bold;">R$ {{ number_format($totalPending, 2, ',', '.') }}</div>
                    </div>
                </td>
                <td style="width: 25%; padding: 10px;">
                    <div style="background-color: #fee2e2; border-left: 4px solid #dc2626; padding: 15px; border-radius: 5px;">
                        <div style="font-size: 10px; color: #b91c1c; font-weight: bold; margin-bottom: 5px;">VENCIDO</div>
                        <div style="font-size: 16px; color: #dc2626; font-weight: bold;">R$ {{ number_format($totalOverdue, 2, ',', '.') }}</div>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <!-- Contas -->
    <div class="section">
        <div class="section-title">DETALHAMENTO DAS CONTAS</div>
        @if($accounts->count() > 0)
        <table style="width: 100%; border-collapse: collapse; font-size: 9px; margin-top: 10px;">
            <thead>
                <tr style="background-color: #374151; color: white;">
                    <th style="padding: 8px; text-align: left; border: 1px solid #4b5563;">Cliente</th>
                    <th style="padding: 8px; text-align: center; border: 1px solid #4b5563; width: 10%;">Parcelas</th>
                    <th style="padding: 8px; text-align: right; border: 1px solid #4b5563; width: 15%;">Valor Total</th>
                    <th style="padding: 8px; text-align: center; border: 1px solid #4b5563; width: 12%;">Data</th>
                    <th style="padding: 8px; text-align: center; border: 1px solid #4b5563; width: 12%;">Vencimento</th>
                    <th style="padding: 8px; text-align: center; border: 1px solid #4b5563; width: 10%;">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($accounts as $account)
                <tr style="border-bottom: 1px solid #e5e7eb;">
                    <td style="padding: 6px; border: 1px solid #e5e7eb;">{{ $account->person->name ?? 'N/A' }}</td>
                    <td style="padding: 6px; text-align: center; border: 1px solid #e5e7eb;">{{ $account->parcels }}x</td>
                    <td style="padding: 6px; text-align: right; border: 1px solid #e5e7eb; font-weight: bold; color: #059669;">R$ {{ number_format($account->total_amount, 2, ',', '.') }}</td>
                    <td style="padding: 6px; text-align: center; border: 1px solid #e5e7eb;">{{ $account->created_at->format('d/m/Y') }}</td>
                    <td style="padding: 6px; text-align: center; border: 1px solid #e5e7eb;">
                        {{ $account->installments->first()?->due_date?->format('d/m/Y') ?? 'N/A' }}
                    </td>
                    <td style="padding: 6px; text-align: center; border: 1px solid #e5e7eb;">
                        @if($account->installments->where('status', 0)->where('due_date', '<', now())->count() > 0)
                            <span style="background-color: #fee2e2; color: #dc2626; padding: 3px 8px; border-radius: 10px; font-size: 8px; font-weight: bold;">VENCIDO</span>
                        @elseif($account->installments->where('status', 1)->count() === $account->parcels)
                            <span style="background-color: #d1fae5; color: #059669; padding: 3px 8px; border-radius: 10px; font-size: 8px; font-weight: bold;">RECEBIDO</span>
                        @else
                            <span style="background-color: #fef3c7; color: #b45309; padding: 3px 8px; border-radius: 10px; font-size: 8px; font-weight: bold;">PENDENTE</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="alert-info">Nenhuma conta a receber encontrada no período selecionado.</div>
        @endif
    </div>

    <x-pdf.footer
        :documentNumber="'#CR-' . now()->format('YmdHis')"
        documentType="Contas a Receber"
    />

</x-layouts.pdf>
