<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: 'Helvetica', Arial, sans-serif;
            color: #000;
            font-size: 10px;
            line-height: 1.4;
        }

        .invoice-box {
            width: 100%;
            border: 1px solid #000;
            font-size: 10px;
            line-height: 14px;
            font-family: 'Helvetica', Helvetica, Arial, sans-serif;
            color: #000;
            margin-bottom: 15px;
            border-collapse: collapse;
        }

        .invoice-box td {
            padding: 4px;
            vertical-align: top;
        }

        .header-title {
            font-size: 16px;
            font-weight: bold;
            background-color: #3b82f6;
            color: white;
            border-bottom: 1px solid #000;
            padding: 8px;
            text-transform: uppercase;
            text-align: center;
        }

        .section-header {
            background-color: #f0f0f0;
            font-weight: bold;
            border-bottom: 1px solid #000;
            border-top: 1px solid #000;
            padding: 5px;
            text-transform: uppercase;
            font-size: 10px;
        }

        .info-label {
            font-weight: bold;
            color: #333;
        }

        .info-value {
            color: #000;
        }

        .stats-box {
            border: 1px solid #000;
            padding: 10px;
            text-align: center;
            margin: 5px;
        }

        .stats-title {
            font-size: 8px;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .stats-value {
            font-size: 16px;
            font-weight: bold;
            margin: 5px 0;
        }

        .stats-subtitle {
            font-size: 7px;
            color: #666;
        }

        .table-datagrid {
            width: 100%;
            border-collapse: collapse;
            font-size: 8px;
            margin-top: 10px;
        }

        .table-datagrid th {
            background-color: #374151;
            color: white;
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
            font-weight: bold;
            text-transform: uppercase;
        }

        .table-datagrid td {
            border: 1px solid #ddd;
            padding: 4px;
        }

        .badge {
            padding: 2px 6px;
            border-radius: 8px;
            font-size: 7px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .badge-receivable {
            background-color: #dcfce7;
            color: #166534;
        }

        .badge-payable {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .badge-paid {
            background-color: #dcfce7;
            color: #16a34a;
        }

        .badge-pending {
            background-color: #fef3c7;
            color: #92400e;
        }

        .badge-overdue {
            background-color: #fee2e2;
            color: #dc2626;
        }

        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .text-left { text-align: left; }
        .font-bold { font-weight: bold; }
        .border-right { border-right: 1px solid #000; }
        .border-bottom { border-bottom: 1px solid #000; }

        .summary-row {
            background-color: #f8f8f8;
            font-weight: bold;
        }

        .alert-info {
            background-color: #dbeafe;
            border-left: 4px solid #3b82f6;
            padding: 10px;
            margin: 10px 0;
            font-size: 9px;
        }
    </style>
</head>
<body>
    @php
        use App\Helpers\FormatterHelper;
        use Illuminate\Support\Facades\Storage;

        $tenantAddress = $tenant->addresses->first();
        $tenantPhone = $tenant->phones->first();
        $tenantEmail = $tenant->emails->first();
    @endphp

    <!-- DOCUMENT HEADER -->
    <table class="invoice-box" cellspacing="0" cellpadding="0">
        <tr>
            <!-- LOGO -->
            <td width="15%" class="border-right" style="vertical-align: middle; text-align: center; padding: 10px;">
                @if($tenant->avatar && Storage::exists($tenant->avatar))
                    @php
                        $avatarPath = Storage::path($tenant->avatar);
                        $imageData = base64_encode(file_get_contents($avatarPath));
                        $mimeType = mime_content_type($avatarPath);
                        $base64Image = "data:{$mimeType};base64,{$imageData}";
                    @endphp
                    <img src="{{ $base64Image }}" style="max-width: 80px; max-height: 80px;">
                @else
                    <div style="font-size: 24px; font-weight: bold; color: #666;">
                        {{ strtoupper(substr($tenant->name, 0, 1)) }}
                    </div>
                @endif
            </td>

            <!-- COMPANY INFO -->
            <td width="50%" class="border-right">
                <div style="font-size: 14px; font-weight: bold; margin-bottom: 5px;">{{ $tenant->name }}</div>
                @if($tenant->document)<div class="info-value"><span class="info-label">CNPJ/CPF:</span> {{ $tenant->document }}</div>@endif

                @if($tenantAddress)
                <div class="info-value">
                    {{ $tenantAddress->street }}{{ $tenantAddress->number ? ', ' . $tenantAddress->number : '' }}
                    {{ $tenantAddress->complement ? ' - ' . $tenantAddress->complement : '' }}
                    <br>
                    {{ $tenantAddress->district }}
                    @if($tenantAddress->city && $tenantAddress->state) - {{ $tenantAddress->city }}/{{ $tenantAddress->state }} @endif
                    @if($tenantAddress->postal_code) - CEP: {{ $tenantAddress->postal_code }} @endif
                </div>
                @endif

                <div class="info-value">
                    @if($tenantPhone)<span class="info-label">Tel:</span> {{ FormatterHelper::phone($tenantPhone->number) }} @endif
                    @if($tenantEmail) <br><span class="info-label">Email:</span> {{ $tenantEmail->address }} @elseif($tenant->email) <br><span class="info-label">Email:</span> {{ $tenant->email }} @endif
                </div>
            </td>

            <!-- DOCUMENT INFO -->
            <td width="35%">
                <div class="header-title">EXTRATO FINANCEIRO</div>
                <div style="text-align: center; padding: 10px;">
                    <div style="font-size: 11px;">
                        <div style="margin-bottom: 3px;"><span class="info-label">PERÍODO:</span></div>
                        <div style="font-size: 12px; font-weight: bold;">{{ $startDate->format('d/m/Y') }} à {{ $endDate->format('d/m/Y') }}</div>
                        <div style="margin-top: 8px; font-size: 9px;"><span class="info-label">EMISSÃO:</span> {{ now()->format('d/m/Y H:i') }}</div>
                    </div>
                </div>
            </td>
        </tr>
    </table>

    <!-- FILTERS APPLIED -->
    @if($filterType !== 'all' || $filterStatus !== 'all')
    <table class="invoice-box" cellspacing="0" cellpadding="0">
        <tr class="section-header">
            <td>FILTROS APLICADOS</td>
        </tr>
        <tr>
            <td style="padding: 8px;">
                <div style="font-size: 9px;">
                    @if($filterType !== 'all')
                        <span class="info-label">Tipo:</span>
                        @if($filterType === 'receivables')
                            <span class="badge badge-receivable">RECEITAS</span>
                        @else
                            <span class="badge badge-payable">DESPESAS</span>
                        @endif
                    @endif

                    @if($filterStatus !== 'all')
                        <span class="info-label" style="margin-left: 15px;">Status:</span>
                        @if($filterStatus === 'paid')
                            <span class="badge badge-paid">PAGAS</span>
                        @elseif($filterStatus === 'pending')
                            <span class="badge badge-pending">PENDENTES</span>
                        @else
                            <span class="badge badge-overdue">VENCIDAS</span>
                        @endif
                    @endif
                </div>
            </td>
        </tr>
    </table>
    @endif

    <!-- STATISTICS SUMMARY -->
    <table class="invoice-box" cellspacing="0" cellpadding="0">
        <tr class="section-header">
            <td colspan="5">RESUMO DO PERÍODO</td>
        </tr>
        <tr>
            <td width="20%" style="padding: 8px;">
                <div class="stats-box" style="background-color: #dbeafe; border-color: #3b82f6;">
                    <div class="stats-title" style="color: #1e40af;">MOVIMENTAÇÕES</div>
                    <div class="stats-value" style="color: #3b82f6;">{{ $installments->count() }}</div>
                    <div class="stats-subtitle">{{ $installments->count() === 1 ? 'lançamento' : 'lançamentos' }}</div>
                </div>
            </td>
            <td width="20%" style="padding: 8px;">
                <div class="stats-box" style="background-color: #dcfce7; border-color: #16a34a;">
                    <div class="stats-title" style="color: #166534;">RECEITAS</div>
                    <div class="stats-value" style="color: #16a34a;">R$ {{ FormatterHelper::money($totalReceivables) }}</div>
                    <div class="stats-subtitle">{{ $installments->filter(fn($i) => $i->accounts->type === 'receivables')->count() }} {{ $installments->filter(fn($i) => $i->accounts->type === 'receivables')->count() === 1 ? 'lançamento' : 'lançamentos' }}</div>
                </div>
            </td>
            <td width="20%" style="padding: 8px;">
                <div class="stats-box" style="background-color: #fee2e2; border-color: #dc2626;">
                    <div class="stats-title" style="color: #991b1b;">DESPESAS</div>
                    <div class="stats-value" style="color: #dc2626;">R$ {{ FormatterHelper::money($totalPayables) }}</div>
                    <div class="stats-subtitle">{{ $installments->filter(fn($i) => $i->accounts->type === 'payables')->count() }} {{ $installments->filter(fn($i) => $i->accounts->type === 'payables')->count() === 1 ? 'lançamento' : 'lançamentos' }}</div>
                </div>
            </td>
            <td width="20%" style="padding: 8px;">
                <div class="stats-box" style="background-color: {{ $balance >= 0 ? '#dcfce7' : '#fee2e2' }}; border-color: {{ $balance >= 0 ? '#16a34a' : '#dc2626' }};">
                    <div class="stats-title" style="color: {{ $balance >= 0 ? '#166534' : '#991b1b' }};">SALDO</div>
                    <div class="stats-value" style="color: {{ $balance >= 0 ? '#16a34a' : '#dc2626' }};">R$ {{ FormatterHelper::money($balance) }}</div>
                    <div class="stats-subtitle">receitas - despesas</div>
                </div>
            </td>
            <td width="20%" style="padding: 8px;">
                <div class="stats-box" style="background-color: #f3f4f6; border-color: #6b7280;">
                    <div class="stats-title" style="color: #4b5563;">TAXA PAGAMENTO</div>
                    <div class="stats-value" style="color: #1f2937;">{{ $installments->count() > 0 ? number_format(($installments->where('status', 1)->count() / $installments->count()) * 100, 1, ',', '.') : '0,0' }}%</div>
                    <div class="stats-subtitle">{{ $installments->where('status', 1)->count() }} de {{ $installments->count() }} pagas</div>
                </div>
            </td>
        </tr>
    </table>

    <!-- DETAILED TRANSACTIONS -->
    <div style="margin-bottom: 10px;">
        <div class="section-header" style="border: 1px solid #000; border-bottom: none;">MOVIMENTAÇÕES DETALHADAS</div>
        @if($installments->count() > 0)
        <table class="table-datagrid">
            <thead>
                <tr>
                    <th width="8%">PARCELA</th>
                    <th width="22%">CLIENTE/FORNECEDOR</th>
                    <th width="10%" class="text-center">TIPO</th>
                    <th width="12%" class="text-right">VALOR</th>
                    <th width="10%" class="text-center">VENCIMENTO</th>
                    <th width="12%" class="text-center">STATUS</th>
                    <th width="10%" class="text-center">PAGAMENTO</th>
                    <th width="16%">RESPONSÁVEL</th>
                </tr>
            </thead>
            <tbody>
                @foreach($installments->take(100) as $installment)
                @php
                    $isOverdue = $installment->status == 0 && $installment->due_date < now();
                @endphp
                <tr style="{{ $isOverdue ? 'background-color: #fef2f2;' : '' }}">
                    <td class="text-center">
                        {{ str_pad($installment->installment_number, 2, '0', STR_PAD_LEFT) }}/{{ str_pad($installment->accounts->parcels, 2, '0', STR_PAD_LEFT) }}
                    </td>
                    <td>{{ $installment->accounts->person->name ?? 'N/A' }}</td>
                    <td class="text-center">
                        @if($installment->accounts->type === 'receivables')
                            <span class="badge badge-receivable">RECEITA</span>
                        @else
                            <span class="badge badge-payable">DESPESA</span>
                        @endif
                    </td>
                    <td class="text-right font-bold" style="color: {{ $installment->accounts->type === 'receivables' ? '#16a34a' : '#dc2626' }};">
                        R$ {{ FormatterHelper::money($installment->amount) }}
                    </td>
                    <td class="text-center">{{ $installment->due_date->format('d/m/Y') }}</td>
                    <td class="text-center">
                        @if($installment->status == 1)
                            <span class="badge badge-paid">PAGO</span>
                        @elseif($isOverdue)
                            <span class="badge badge-overdue">VENCIDO</span>
                        @else
                            <span class="badge badge-pending">PENDENTE</span>
                        @endif
                    </td>
                    <td class="text-center" style="font-size: 7px;">
                        {{ $installment->paid_at ? $installment->paid_at->format('d/m/Y') : '-' }}
                    </td>
                    <td style="font-size: 7px;">{{ $installment->accounts->user->name ?? 'N/A' }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="summary-row">
                    <td colspan="3" class="text-right">TOTAL DO PERÍODO:</td>
                    <td class="text-right font-bold" style="color: #1f2937;">
                        R$ {{ FormatterHelper::money($installments->take(100)->sum('amount')) }}
                    </td>
                    <td colspan="4"></td>
                </tr>
            </tfoot>
        </table>
        @if($installments->count() > 100)
        <div style="margin-top: 8px; font-size: 8px; color: #666; text-align: center; font-style: italic;">
            * Exibindo as primeiras 100 movimentações de {{ $installments->count() }} movimentações no período selecionado
        </div>
        @endif
        @else
        <div class="alert-info">
            <strong>Nenhuma movimentação encontrada!</strong><br>
            Não há movimentações no período de {{ $startDate->format('d/m/Y') }} à {{ $endDate->format('d/m/Y') }} com os filtros aplicados.
        </div>
        @endif
    </div>

    <!-- STATUS BREAKDOWN -->
    @if($installments->count() > 0)
    <table class="invoice-box" cellspacing="0" cellpadding="0">
        <tr class="section-header">
            <td>ANÁLISE POR STATUS</td>
        </tr>
        <tr>
            <td style="padding: 8px;">
                <table style="width: 100%; font-size: 9px;">
                    <tr>
                        <td width="50%" style="padding: 5px;">
                            <div style="margin-bottom: 5px;">
                                <span class="info-label">Contas Pagas:</span>
                                <span style="color: #16a34a; font-weight: bold; float: right;">
                                    R$ {{ FormatterHelper::money($totalPaid) }}
                                </span>
                            </div>
                            <div style="font-size: 8px; color: #666;">
                                {{ $installments->where('status', 1)->count() }} {{ $installments->where('status', 1)->count() === 1 ? 'conta' : 'contas' }}
                            </div>
                        </td>
                        <td width="50%" style="padding: 5px; border-left: 1px solid #ddd;">
                            <div style="margin-bottom: 5px;">
                                <span class="info-label">Contas Pendentes:</span>
                                <span style="color: #d97706; font-weight: bold; float: right;">
                                    R$ {{ FormatterHelper::money($totalPending) }}
                                </span>
                            </div>
                            <div style="font-size: 8px; color: #666;">
                                {{ $installments->where('status', 0)->where('due_date', '>=', now())->count() }} {{ $installments->where('status', 0)->where('due_date', '>=', now())->count() === 1 ? 'conta' : 'contas' }}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding: 5px; padding-top: 10px; border-top: 1px solid #ddd;">
                            <div style="margin-bottom: 5px;">
                                <span class="info-label">Contas Vencidas:</span>
                                <span style="color: #dc2626; font-weight: bold; float: right;">
                                    R$ {{ FormatterHelper::money($totalOverdue) }}
                                </span>
                            </div>
                            <div style="font-size: 8px; color: #666;">
                                {{ $installments->where('status', 0)->where('due_date', '<', now())->count() }} {{ $installments->where('status', 0)->where('due_date', '<', now())->count() === 1 ? 'conta' : 'contas' }}
                                @if($installments->where('status', 0)->where('due_date', '<', now())->count() > 0)
                                    <span style="color: #dc2626; font-weight: bold;"> - ATENÇÃO: Ação necessária!</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    @endif

    <!-- FOOTER -->
    <div style="margin-top: 20px; font-size: 7px; text-align: center; color: #666; border-top: 1px solid #ccc; padding-top: 5px;">
        <div style="margin-bottom: 3px;">
            <strong>{{ $tenant->name }}</strong> - EXTRATO FINANCEIRO
        </div>
        <div>
            Documento gerado em {{ now()->format('d/m/Y H:i:s') }} | Nº do Documento: #EXT-{{ now()->format('YmdHis') }}
        </div>
        <div style="margin-top: 3px; font-size: 6px; color: #999;">
            Este documento é confidencial e destinado exclusivamente para uso interno da empresa
        </div>
    </div>
</body>
</html>
