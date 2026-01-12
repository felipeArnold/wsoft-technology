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
            background-color: #dc2626;
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

        .badge-critical {
            background-color: #fee2e2;
            color: #dc2626;
        }

        .badge-overdue {
            background-color: #fef3c7;
            color: #d97706;
        }

        .badge-recent {
            background-color: #dbeafe;
            color: #3b82f6;
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

        .page-break {
            page-break-after: always;
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
                <div class="header-title">RELATÓRIO DE INADIMPLÊNCIA</div>
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

    <!-- STATISTICS SUMMARY -->
    <table class="invoice-box" cellspacing="0" cellpadding="0">
        <tr class="section-header">
            <td colspan="4">ANÁLISE POR GRAVIDADE</td>
        </tr>
        <tr>
            <td width="25%" style="padding: 8px;">
                <div class="stats-box" style="background-color: #f3f4f6; border-color: #6b7280;">
                    <div class="stats-title" style="color: #4b5563;">TOTAL INADIMPLENTE</div>
                    <div class="stats-value" style="color: #1f2937;">R$ {{ FormatterHelper::money($totalOverdue) }}</div>
                    <div class="stats-subtitle">{{ $installments->count() }} {{ $installments->count() === 1 ? 'parcela' : 'parcelas' }}</div>
                </div>
            </td>
            <td width="25%" style="padding: 8px;">
                <div class="stats-box" style="background-color: #fee2e2; border-color: #dc2626;">
                    <div class="stats-title" style="color: #b91c1c;">CRÍTICO (&gt;90 dias)</div>
                    <div class="stats-value" style="color: #dc2626;">R$ {{ FormatterHelper::money($totalCritical) }}</div>
                    <div class="stats-subtitle">{{ $critical->count() }} {{ $critical->count() === 1 ? 'parcela' : 'parcelas' }}</div>
                </div>
            </td>
            <td width="25%" style="padding: 8px;">
                <div class="stats-box" style="background-color: #fef3c7; border-color: #d97706;">
                    <div class="stats-title" style="color: #92400e;">VENCIDO (30-90 dias)</div>
                    <div class="stats-value" style="color: #d97706;">R$ {{ FormatterHelper::money($totalOverdueRange) }}</div>
                    <div class="stats-subtitle">{{ $overdue->count() }} {{ $overdue->count() === 1 ? 'parcela' : 'parcelas' }}</div>
                </div>
            </td>
            <td width="25%" style="padding: 8px;">
                <div class="stats-box" style="background-color: #dbeafe; border-color: #3b82f6;">
                    <div class="stats-title" style="color: #1e40af;">RECENTE (&lt;30 dias)</div>
                    <div class="stats-value" style="color: #3b82f6;">R$ {{ FormatterHelper::money($totalRecent) }}</div>
                    <div class="stats-subtitle">{{ $recent->count() }} {{ $recent->count() === 1 ? 'parcela' : 'parcelas' }}</div>
                </div>
            </td>
        </tr>
    </table>

    <!-- TOP DEBTORS -->
    @if($topDebtors->count() > 0)
    <div style="margin-bottom: 10px;">
        <div class="section-header" style="border: 1px solid #000; border-bottom: none;">TOP 10 MAIORES DEVEDORES</div>
        <table class="table-datagrid">
            <thead>
                <tr>
                    <th width="10%" class="text-center">#</th>
                    <th width="50%">CLIENTE</th>
                    <th width="20%" class="text-center">QTD. PARCELAS</th>
                    <th width="20%" class="text-right">TOTAL DEVIDO</th>
                </tr>
            </thead>
            <tbody>
                @foreach($topDebtors as $index => $debtor)
                <tr>
                    <td class="text-center font-bold">{{ $index + 1 }}º</td>
                    <td>{{ $debtor->person_name }}</td>
                    <td class="text-center">{{ $debtor->count }}</td>
                    <td class="text-right font-bold" style="color: #dc2626;">R$ {{ FormatterHelper::money($debtor->total) }}</td>
                </tr>
                @endforeach
                <tr class="summary-row">
                    <td colspan="2" class="text-right">TOTAL TOP 10:</td>
                    <td class="text-center font-bold">{{ $topDebtors->sum('count') }}</td>
                    <td class="text-right font-bold" style="color: #dc2626;">R$ {{ FormatterHelper::money($topDebtors->sum('total')) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    @endif

    <!-- DETAILED INSTALLMENTS -->
    <div style="margin-bottom: 10px;">
        <div class="section-header" style="border: 1px solid #000; border-bottom: none;">DETALHAMENTO DAS PARCELAS INADIMPLENTES</div>
        @if($installments->count() > 0)
        <table class="table-datagrid">
            <thead>
                <tr>
                    <th width="30%">CLIENTE</th>
                    <th width="10%" class="text-center">PARCELA</th>
                    <th width="15%" class="text-right">VALOR</th>
                    <th width="12%" class="text-center">VENCIMENTO</th>
                    <th width="10%" class="text-center">DIAS ATRASO</th>
                    <th width="13%" class="text-center">GRAVIDADE</th>
                    <th width="10%" class="text-left">RESPONSÁVEL</th>
                </tr>
            </thead>
            <tbody>
                @foreach($installments->take(50) as $installment)
                @php
                    $daysOverdue = (int) abs(now()->diffInDays($installment->due_date));
                    $severity = $daysOverdue > 90 ? 'critical' : ($daysOverdue > 30 ? 'overdue' : 'recent');
                @endphp
                <tr style="{{ $severity === 'critical' ? 'background-color: #fef2f2;' : '' }}">
                    <td>{{ $installment->accounts->person->name ?? 'N/A' }}</td>
                    <td class="text-center">
                        {{ str_pad($installment->installment_number, 2, '0', STR_PAD_LEFT) }}/{{ str_pad($installment->accounts->parcels, 2, '0', STR_PAD_LEFT) }}
                    </td>
                    <td class="text-right font-bold">R$ {{ FormatterHelper::money($installment->amount) }}</td>
                    <td class="text-center">{{ $installment->due_date->format('d/m/Y') }}</td>
                    <td class="text-center font-bold" style="color: {{ $severity === 'critical' ? '#dc2626' : ($severity === 'overdue' ? '#d97706' : '#3b82f6') }};">
                        {{ $daysOverdue }}
                    </td>
                    <td class="text-center">
                        @if($severity === 'critical')
                            <span class="badge badge-critical">CRÍTICO</span>
                        @elseif($severity === 'overdue')
                            <span class="badge badge-overdue">VENCIDO</span>
                        @else
                            <span class="badge badge-recent">RECENTE</span>
                        @endif
                    </td>
                    <td style="font-size: 7px;">{{ $installment->accounts->user->name ?? 'N/A' }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="summary-row">
                    <td colspan="2" class="text-right">TOTAL EXIBIDO:</td>
                    <td class="text-right font-bold" style="color: #dc2626;">
                        R$ {{ FormatterHelper::money($installments->take(50)->sum('amount')) }}
                    </td>
                    <td colspan="4"></td>
                </tr>
            </tfoot>
        </table>
        @if($installments->count() > 50)
        <div style="margin-top: 8px; font-size: 8px; color: #666; text-align: center; font-style: italic;">
            * Exibindo as primeiras 50 parcelas de {{ $installments->count() }} parcelas inadimplentes no período selecionado
        </div>
        @endif
        @else
        <div class="alert-info">
            <strong>Nenhuma inadimplência encontrada!</strong><br>
            Não há parcelas vencidas no período de {{ $startDate->format('d/m/Y') }} à {{ $endDate->format('d/m/Y') }}.
        </div>
        @endif
    </div>

    <!-- RECOMMENDATIONS -->
    @if($installments->count() > 0)
    <table class="invoice-box" cellspacing="0" cellpadding="0">
        <tr class="section-header">
            <td>OBSERVAÇÕES E RECOMENDAÇÕES</td>
        </tr>
        <tr>
            <td style="padding: 8px;">
                <div style="margin-bottom: 6px;">
                    <span class="info-label">ANÁLISE:</span><br>
                    <span style="font-size: 9px;">
                        O relatório identifica {{ $installments->count() }} {{ $installments->count() === 1 ? 'parcela inadimplente' : 'parcelas inadimplentes' }}
                        totalizando R$ {{ FormatterHelper::money($totalOverdue) }} no período analisado.
                        @if($critical->count() > 0)
                            <br><strong style="color: #dc2626;">ATENÇÃO:</strong> Existem {{ $critical->count() }} {{ $critical->count() === 1 ? 'parcela crítica' : 'parcelas críticas' }}
                            com mais de 90 dias de atraso, totalizando R$ {{ FormatterHelper::money($totalCritical) }}.
                        @endif
                    </span>
                </div>

                <div style="margin-top: 8px; padding-top: 6px; border-top: 1px dashed #ccc;">
                    <span class="info-label">AÇÕES RECOMENDADAS:</span><br>
                    <ul style="margin: 5px 0; padding-left: 15px; font-size: 8px;">
                        @if($critical->count() > 0)
                        <li>Priorizar contato com devedores críticos (&gt;90 dias) para negociação imediata</li>
                        @endif
                        @if($overdue->count() > 0)
                        <li>Enviar notificações de cobrança para parcelas vencidas (30-90 dias)</li>
                        @endif
                        @if($recent->count() > 0)
                        <li>Realizar lembretes preventivos para parcelas recentemente vencidas (&lt;30 dias)</li>
                        @endif
                        <li>Avaliar políticas de crédito e concessão de prazos para novos contratos</li>
                        <li>Considerar implementação de programa de fidelidade para clientes adimplentes</li>
                    </ul>
                </div>
            </td>
        </tr>
    </table>
    @endif

    <!-- FOOTER -->
    <div style="margin-top: 20px; font-size: 7px; text-align: center; color: #666; border-top: 1px solid #ccc; padding-top: 5px;">
        <div style="margin-bottom: 3px;">
            <strong>{{ $tenant->name }}</strong> - RELATÓRIO DE INADIMPLÊNCIA
        </div>
        <div>
            Documento gerado em {{ now()->format('d/m/Y H:i:s') }} | Nº do Documento: #IND-{{ now()->format('YmdHis') }}
        </div>
        <div style="margin-top: 3px; font-size: 6px; color: #999;">
            Este documento é confidencial e destinado exclusivamente para uso interno da empresa
        </div>
    </div>
</body>
</html>
