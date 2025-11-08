<x-layouts.pdf :title="'Extrato Financeiro'">

    <!-- Header -->
    <x-pdf.header
        :tenant="$tenant"
        title="EXTRATO FINANCEIRO"
        :subtitle="'Período: ' . now()->format('d/m/Y \\à\\s H:i')"
    />

    <!-- Filtro Ativo -->
    @if($activeTab !== 'all')
    <div class="section">
        <div class="alert-info">
            <strong>Filtro aplicado:</strong>
            @switch($activeTab)
                @case('receivables') Receitas @break
                @case('payables') Despesas @break
                @case('paid') Contas Pagas @break
                @case('pending') Contas Pendentes @break
                @case('overdue') Contas Vencidas @break
            @endswitch
        </div>
    </div>
    @endif

    <!-- Tabela de Parcelas -->
    <div class="section">
        <div class="section-title">LANÇAMENTOS</div>

        @if($installments->count() > 0)
        <table style="width: 100%; border-collapse: collapse; font-size: 9px;">
            <thead>
                <tr style="background-color: #374151; color: white;">
                    <th style="padding: 8px; text-align: left; border: 1px solid #4b5563; width: 8%;">Parcela</th>
                    <th style="padding: 8px; text-align: left; border: 1px solid #4b5563; width: 22%;">Cliente/Fornecedor</th>
                    <th style="padding: 8px; text-align: center; border: 1px solid #4b5563; width: 10%;">Tipo</th>
                    <th style="padding: 8px; text-align: right; border: 1px solid #4b5563; width: 12%;">Valor</th>
                    <th style="padding: 8px; text-align: center; border: 1px solid #4b5563; width: 10%;">Vencimento</th>
                    <th style="padding: 8px; text-align: center; border: 1px solid #4b5563; width: 12%;">Status</th>
                    <th style="padding: 8px; text-align: center; border: 1px solid #4b5563; width: 12%;">Dt. Pagamento</th>
                    <th style="padding: 8px; text-align: left; border: 1px solid #4b5563; width: 14%;">Responsável</th>
                </tr>
            </thead>
            <tbody>
                @foreach($installments as $installment)
                <tr style="border-bottom: 1px solid #e5e7eb;">
                    <td style="padding: 6px; border: 1px solid #e5e7eb;">
                        {{ $installment->installment_number }}/{{ $installment->accounts->installments->count() }}
                    </td>
                    <td style="padding: 6px; border: 1px solid #e5e7eb;">
                        {{ $installment->accounts->person->name ?? 'N/A' }}
                    </td>
                    <td style="padding: 6px; text-align: center; border: 1px solid #e5e7eb;">
                        @if($installment->accounts->type === 'receivables')
                            <span style="background-color: #d1fae5; color: #059669; padding: 3px 8px; border-radius: 10px; font-size: 8px; font-weight: bold;">
                                RECEITA
                            </span>
                        @else
                            <span style="background-color: #fee2e2; color: #dc2626; padding: 3px 8px; border-radius: 10px; font-size: 8px; font-weight: bold;">
                                DESPESA
                            </span>
                        @endif
                    </td>
                    <td style="padding: 6px; text-align: right; border: 1px solid #e5e7eb; font-weight: bold;">
                        R$ {{ number_format($installment->amount, 2, ',', '.') }}
                    </td>
                    <td style="padding: 6px; text-align: center; border: 1px solid #e5e7eb;">
                        {{ $installment->due_date->format('d/m/Y') }}
                    </td>
                    <td style="padding: 6px; text-align: center; border: 1px solid #e5e7eb;">
                        @if($installment->status == 1)
                            <span style="background-color: #d1fae5; color: #059669; padding: 3px 8px; border-radius: 10px; font-size: 8px; font-weight: bold;">
                                PAGO
                            </span>
                        @elseif($installment->due_date < now())
                            <span style="background-color: #fee2e2; color: #dc2626; padding: 3px 8px; border-radius: 10px; font-size: 8px; font-weight: bold;">
                                VENCIDO
                            </span>
                        @else
                            <span style="background-color: #fef3c7; color: #b45309; padding: 3px 8px; border-radius: 10px; font-size: 8px; font-weight: bold;">
                                PENDENTE
                            </span>
                        @endif
                    </td>
                    <td style="padding: 6px; text-align: center; border: 1px solid #e5e7eb;">
                        {{ $installment->paid_at ? $installment->paid_at->format('d/m/Y') : '-' }}
                    </td>
                    <td style="padding: 6px; border: 1px solid #e5e7eb;">
                        {{ $installment->accounts->user->name ?? 'N/A' }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="alert-info">
            Nenhum lançamento encontrado com os filtros aplicados.
        </div>
        @endif
    </div>

    <!-- Totalizadores -->
    @if($installments->count() > 0)
    <div class="section">
        <div class="section-title">RESUMO FINANCEIRO</div>

        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td style="width: 50%; vertical-align: top; padding-right: 10px;">
                    <table class="values-table">
                        <tr>
                            <td class="label-cell">Total Receitas:</td>
                            <td class="value-cell" style="color: #059669; font-weight: bold;">
                                R$ {{ number_format($totalReceivables, 2, ',', '.') }}
                            </td>
                        </tr>
                        <tr>
                            <td class="label-cell">Total Despesas:</td>
                            <td class="value-cell" style="color: #dc2626; font-weight: bold;">
                                R$ {{ number_format($totalPayables, 2, ',', '.') }}
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="width: 50%; vertical-align: top; padding-left: 10px;">
                    <table class="values-table">
                        <tr>
                            <td class="label-cell">Total Pago:</td>
                            <td class="value-cell" style="color: #059669; font-weight: bold;">
                                R$ {{ number_format($totalPaid, 2, ',', '.') }}
                            </td>
                        </tr>
                        <tr>
                            <td class="label-cell">Total Pendente:</td>
                            <td class="value-cell" style="color: #b45309; font-weight: bold;">
                                R$ {{ number_format($totalPending, 2, ',', '.') }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <!-- Saldo Final -->
        <table class="values-table" style="margin-top: 10px;">
            <tr class="total-row">
                <td>SALDO (Receitas - Despesas):</td>
                <td style="text-align: right;">
                    R$ {{ number_format($totalReceivables - $totalPayables, 2, ',', '.') }}
                </td>
            </tr>
        </table>
    </div>
    @endif

    <!-- Footer -->
    <x-pdf.footer
        :documentNumber="'#' . now()->format('YmdHis')"
        documentType="Extrato Financeiro"
    />

</x-layouts.pdf>
