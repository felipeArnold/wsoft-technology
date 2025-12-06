<x-layouts.pdf :title="'Relatório Financeiro'">

    <!-- Header -->
    <x-pdf.header
        :tenant="$tenant"
        title="RELATÓRIO FINANCEIRO"
        :subtitle="'Período: ' . $startDate->format('d/m/Y') . ' à ' . $endDate->format('d/m/Y')"
    />

    <!-- Resumo Executivo -->
    <div class="section">
        <div class="section-title">RESUMO EXECUTIVO</div>

        <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
            <tr>
                <td style="width: 33.33%; vertical-align: top; padding: 10px;">
                    <div style="background-color: #d1fae5; border-left: 4px solid #059669; padding: 15px; border-radius: 5px;">
                        <div style="font-size: 10px; color: #047857; font-weight: bold; margin-bottom: 5px;">RECEITAS</div>
                        <div style="font-size: 16px; color: #059669; font-weight: bold;">R$ {{ number_format($totalReceivables, 2, ',', '.') }}</div>
                        <div style="font-size: 8px; color: #047857; margin-top: 3px;">{{ $receivablesCount }} lançamentos</div>
                    </div>
                </td>
                <td style="width: 33.33%; vertical-align: top; padding: 10px;">
                    <div style="background-color: #fee2e2; border-left: 4px solid #dc2626; padding: 15px; border-radius: 5px;">
                        <div style="font-size: 10px; color: #b91c1c; font-weight: bold; margin-bottom: 5px;">DESPESAS</div>
                        <div style="font-size: 16px; color: #dc2626; font-weight: bold;">R$ {{ number_format($totalPayables, 2, ',', '.') }}</div>
                        <div style="font-size: 8px; color: #b91c1c; margin-top: 3px;">{{ $payablesCount }} lançamentos</div>
                    </div>
                </td>
                <td style="width: 33.33%; vertical-align: top; padding: 10px;">
                    <div style="background-color: {{ $balance >= 0 ? '#dbeafe' : '#fee2e2' }}; border-left: 4px solid {{ $balance >= 0 ? '#2563eb' : '#dc2626' }}; padding: 15px; border-radius: 5px;">
                        <div style="font-size: 10px; color: {{ $balance >= 0 ? '#1e40af' : '#b91c1c' }}; font-weight: bold; margin-bottom: 5px;">SALDO</div>
                        <div style="font-size: 16px; color: {{ $balance >= 0 ? '#2563eb' : '#dc2626' }}; font-weight: bold;">R$ {{ number_format($balance, 2, ',', '.') }}</div>
                        <div style="font-size: 8px; color: {{ $balance >= 0 ? '#1e40af' : '#b91c1c' }}; margin-top: 3px;">{{ $balance >= 0 ? 'Positivo' : 'Negativo' }}</div>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <!-- Indicadores Financeiros -->
    <div class="section">
        <div class="section-title">INDICADORES FINANCEIROS</div>

        <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
            <tr>
                <td style="width: 50%; vertical-align: top; padding-right: 10px;">
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
                        <tr>
                            <td class="label-cell">Total Vencido:</td>
                            <td class="value-cell" style="color: #dc2626; font-weight: bold;">
                                R$ {{ number_format($totalOverdue, 2, ',', '.') }}
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="width: 50%; vertical-align: top; padding-left: 10px;">
                    <table class="values-table">
                        <tr>
                            <td class="label-cell">Taxa de Adimplência:</td>
                            <td class="value-cell" style="color: #059669; font-weight: bold;">
                                {{ number_format($paymentRate, 2, ',', '.') }}%
                            </td>
                        </tr>
                        <tr>
                            <td class="label-cell">Taxa de Inadimplência:</td>
                            <td class="value-cell" style="color: #dc2626; font-weight: bold;">
                                {{ number_format($overdueRate, 2, ',', '.') }}%
                            </td>
                        </tr>
                        <tr>
                            <td class="label-cell">Ticket Médio:</td>
                            <td class="value-cell" style="color: #6b7280; font-weight: bold;">
                                R$ {{ number_format($averageTicket, 2, ',', '.') }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>

    <!-- Top Clientes/Fornecedores -->
    @if($topReceivables->count() > 0 || $topPayables->count() > 0)
    <div class="section">
        <div class="section-title">TOP CLIENTES E FORNECEDORES</div>

        <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
            <tr>
                <td style="width: 50%; vertical-align: top; padding-right: 10px;">
                    <div style="font-size: 10px; font-weight: bold; color: #059669; margin-bottom: 8px; padding-left: 5px;">
                        ▼ TOP 5 CLIENTES (Receitas)
                    </div>
                    <table style="width: 100%; border-collapse: collapse; font-size: 9px;">
                        <thead>
                            <tr style="background-color: #f3f4f6;">
                                <th style="padding: 5px; text-align: left; border: 1px solid #e5e7eb;">Cliente</th>
                                <th style="padding: 5px; text-align: right; border: 1px solid #e5e7eb; width: 35%;">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($topReceivables as $item)
                            <tr>
                                <td style="padding: 4px; border: 1px solid #e5e7eb;">{{ $item->person_name }}</td>
                                <td style="padding: 4px; text-align: right; border: 1px solid #e5e7eb; font-weight: bold; color: #059669;">
                                    R$ {{ number_format($item->total, 2, ',', '.') }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </td>
                <td style="width: 50%; vertical-align: top; padding-left: 10px;">
                    <div style="font-size: 10px; font-weight: bold; color: #dc2626; margin-bottom: 8px; padding-left: 5px;">
                        ▼ TOP 5 FORNECEDORES (Despesas)
                    </div>
                    <table style="width: 100%; border-collapse: collapse; font-size: 9px;">
                        <thead>
                            <tr style="background-color: #f3f4f6;">
                                <th style="padding: 5px; text-align: left; border: 1px solid #e5e7eb;">Fornecedor</th>
                                <th style="padding: 5px; text-align: right; border: 1px solid #e5e7eb; width: 35%;">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($topPayables as $item)
                            <tr>
                                <td style="padding: 4px; border: 1px solid #e5e7eb;">{{ $item->person_name }}</td>
                                <td style="padding: 4px; text-align: right; border: 1px solid #e5e7eb; font-weight: bold; color: #dc2626;">
                                    R$ {{ number_format($item->total, 2, ',', '.') }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>
    </div>
    @endif

    <!-- Análise por Categoria -->
    @if($byCategory->count() > 0)
    <div class="section">
        <div class="section-title">ANÁLISE POR CATEGORIA</div>

        <table style="width: 100%; border-collapse: collapse; font-size: 9px; margin-top: 10px;">
            <thead>
                <tr style="background-color: #374151; color: white;">
                    <th style="padding: 8px; text-align: left; border: 1px solid #4b5563;">Categoria</th>
                    <th style="padding: 8px; text-align: center; border: 1px solid #4b5563; width: 15%;">Tipo</th>
                    <th style="padding: 8px; text-align: right; border: 1px solid #4b5563; width: 20%;">Total</th>
                    <th style="padding: 8px; text-align: center; border: 1px solid #4b5563; width: 15%;">Qtd</th>
                </tr>
            </thead>
            <tbody>
                @foreach($byCategory as $item)
                <tr style="border-bottom: 1px solid #e5e7eb;">
                    <td style="padding: 6px; border: 1px solid #e5e7eb;">{{ $item->category ?? 'Sem Categoria' }}</td>
                    <td style="padding: 6px; text-align: center; border: 1px solid #e5e7eb;">
                        @if($item->type === 'receivables')
                            <span style="background-color: #d1fae5; color: #059669; padding: 2px 6px; border-radius: 8px; font-size: 8px; font-weight: bold;">
                                RECEITA
                            </span>
                        @else
                            <span style="background-color: #fee2e2; color: #dc2626; padding: 2px 6px; border-radius: 8px; font-size: 8px; font-weight: bold;">
                                DESPESA
                            </span>
                        @endif
                    </td>
                    <td style="padding: 6px; text-align: right; border: 1px solid #e5e7eb; font-weight: bold; color: {{ $item->type === 'receivables' ? '#059669' : '#dc2626' }};">
                        R$ {{ number_format($item->total, 2, ',', '.') }}
                    </td>
                    <td style="padding: 6px; text-align: center; border: 1px solid #e5e7eb;">{{ $item->count }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    <!-- Fluxo Mensal -->
    @if($monthlyFlow->count() > 0)
    <div class="section">
        <div class="section-title">FLUXO MENSAL</div>

        <table style="width: 100%; border-collapse: collapse; font-size: 9px; margin-top: 10px;">
            <thead>
                <tr style="background-color: #374151; color: white;">
                    <th style="padding: 8px; text-align: left; border: 1px solid #4b5563; width: 25%;">Mês</th>
                    <th style="padding: 8px; text-align: right; border: 1px solid #4b5563; width: 25%;">Receitas</th>
                    <th style="padding: 8px; text-align: right; border: 1px solid #4b5563; width: 25%;">Despesas</th>
                    <th style="padding: 8px; text-align: right; border: 1px solid #4b5563; width: 25%;">Saldo</th>
                </tr>
            </thead>
            <tbody>
                @foreach($monthlyFlow as $flow)
                @php
                    $monthBalance = $flow->receivables - $flow->payables;
                @endphp
                <tr style="border-bottom: 1px solid #e5e7eb;">
                    <td style="padding: 6px; border: 1px solid #e5e7eb; font-weight: bold;">{{ $flow->month_name }}</td>
                    <td style="padding: 6px; text-align: right; border: 1px solid #e5e7eb; color: #059669; font-weight: bold;">
                        R$ {{ number_format($flow->receivables, 2, ',', '.') }}
                    </td>
                    <td style="padding: 6px; text-align: right; border: 1px solid #e5e7eb; color: #dc2626; font-weight: bold;">
                        R$ {{ number_format($flow->payables, 2, ',', '.') }}
                    </td>
                    <td style="padding: 6px; text-align: right; border: 1px solid #e5e7eb; font-weight: bold; color: {{ $monthBalance >= 0 ? '#2563eb' : '#dc2626' }};">
                        R$ {{ number_format($monthBalance, 2, ',', '.') }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    <!-- Footer -->
    <x-pdf.footer
        :documentNumber="'#REL-' . now()->format('YmdHis')"
        documentType="Relatório Financeiro"
    />

</x-layouts.pdf>
