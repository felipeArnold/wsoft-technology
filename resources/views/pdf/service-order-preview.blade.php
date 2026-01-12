<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <style>
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
            font-size: 14px;
            font-weight: bold;
            background-color: #e0e0e0;
            border-bottom: 1px solid #000;
            padding: 5px;
            text-transform: uppercase;
        }

        .section-header {
            background-color: #f0f0f0;
            font-weight: bold;
            border-bottom: 1px solid #000;
            border-top: 1px solid #000;
            padding: 3px 5px;
            text-transform: uppercase;
            font-size: 9px;
        }

        .info-label {
            font-weight: bold;
            color: #333;
        }

        .info-value {
            color: #000;
        }

        .table-datagrid {
            width: 100%;
            border-collapse: collapse;
            font-size: 9px;
        }

        .table-datagrid th {
            background-color: #e0e0e0;
            border: 1px solid #000;
            padding: 4px;
            text-align: left;
            font-weight: bold;
            text-transform: uppercase;
        }

        .table-datagrid td {
            border: 1px solid #000;
            padding: 4px;
        }

        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .font-bold { font-weight: bold; }

        .border-right { border-right: 1px solid #000; }
        .border-bottom { border-bottom: 1px solid #000; }
        .no-border { border: none !important; }

        .total-box {
            float: right;
            width: 250px;
            border: 1px solid #000;
            margin-top: 10px;
        }

        .total-row td {
            border-top: 1px solid #000;
            font-weight: bold;
            background-color: #f8f8f8;
        }

        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
    </style>
</head>
<body>
    @php
        use Illuminate\Support\Facades\Storage;
        $person = $serviceOrder->person;
        $primaryPhone = $person->phones->first();
        $primaryAddress = $person->addresses->first();

        $tenantAddress = $tenant->addresses->first();
        $tenantPhone = $tenant->phones->first();
        $tenantEmail = $tenant->emails->first();
    @endphp

    <!-- DOCUMENT HEADER -->
    <table class="invoice-box" cellspacing="0" cellpadding="0">
        <tr>
            <!-- LOGO -->
            <td width="15%" class="border-right" style="vertical-align: middle; text-align: center; padding: 10px;">
                @if($tenant->avatar && \Illuminate\Support\Facades\Storage::exists($tenant->avatar))
                    @php
                        $avatarPath = \Illuminate\Support\Facades\Storage::path($tenant->avatar);
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
                    @if($tenantPhone)<span class="info-label">Tel:</span> {{ Formatter::phone($tenantPhone->number) }} @endif
                    @if($tenantEmail) <br><span class="info-label">Email:</span> {{ $tenantEmail->address }} @elseif($tenant->email) <br><span class="info-label">Email:</span> {{ $tenant->email }} @endif
                </div>
            </td>

            <!-- DOCUMENT INFO -->
            <td width="35%">
                <div class="header-title text-center">ORDEM DE SERVIÇO</div>
                <div style="text-align: center; padding: 10px;">
                    <div style="font-size: 18px; font-weight: bold;">Nº {{ $serviceOrder->number }}</div>
                    <div style="margin-top: 10px; font-size: 11px;">
                        <div style="margin-bottom: 3px;"><span class="info-label">EMISSÃO:</span> {{ $serviceOrder->opening_date->format('d/m/Y') }}</div>
                        @if($serviceOrder->completion_date)
                        <div><span class="info-label">SAÍDA:</span> {{ $serviceOrder->completion_date->format('d/m/Y') }}</div>
                        @endif
                        <div style="margin-top: 5px;"><span class="info-label">STATUS:</span> {{ $serviceOrder->status->getLabel() }}</div>
                    </div>
                </div>
            </td>
        </tr>
    </table>

    <!-- CLIENT & EQUIPMENT INFO -->
    <table class="invoice-box" cellspacing="0" cellpadding="0">
        <tr class="section-header">
            <td colspan="2">DADOS DO CLIENTE</td>
            <td colspan="2" class="border-left">DADOS DO EQUIPAMENTO / SOLICITAÇÃO</td>
        </tr>
        <tr>
            <td width="50%" colspan="2" class="border-right">
                <table width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                        <td class="info-label" width="15%">NOME:</td>
                        <td class="info-value" style="font-weight: bold;">{{ $person->name }}</td>
                    </tr>
                    @if($person->document)
                    <tr>
                        <td class="info-label">CPF/CNPJ:</td>
                        <td class="info-value">{{ $person->document }}</td>
                    </tr>
                    @endif
                    <tr>
                        <td class="info-label">ENDEREÇO:</td>
                        <td class="info-value">
                            @if($primaryAddress)
                                {{ $primaryAddress->street }}, {{ $primaryAddress->number }} {{ $primaryAddress->complement ?? '' }}
                                <br>{{ $primaryAddress->district }} - {{ $primaryAddress->city }}/{{ $primaryAddress->state }}
                                @if($primaryAddress->postal_code) - CEP: {{ $primaryAddress->postal_code }} @endif
                            @else
                                <span style="color: #999;">Não informado</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="info-label">CONTATO:</td>
                        <td class="info-value">
                            @if($primaryPhone) {{ Formatter::phone($primaryPhone->number) }} @endif
                            @if($person->email) <br>{{ $person->email }} @endif
                        </td>
                    </tr>
                </table>
            </td>
            <td width="50%" colspan="2">
                <table width="100%" cellpadding="0" cellspacing="0">
                     <tr>
                        <td class="info-label" width="20%">TÉCNICO:</td>
                        <td class="info-value">{{ $serviceOrder->user->name ?? 'N/A' }}</td>
                    </tr>
                    <tr><td colspan="2" style="border-bottom: 1px dotted #ccc; height: 1px; margin: 2px 0;"></td></tr>
                    <tr>
                        <td colspan="2">
                            <span class="info-label">PROBLEMA RELATADO:</span><br>
                            <div style="font-style: italic; margin-top: 2px;">
                                {!! nl2br(strip_tags($serviceOrder->description ?? 'Não informado')) !!}
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <!-- SERVICES -->
    @if($serviceOrder->serviceOrderServices->count() > 0)
    <div style="margin-bottom: 10px;">
        <div class="section-header" style="border: 1px solid #000; border-bottom: none;">SERVIÇOS EXECUTADOS</div>
        <table class="table-datagrid">
            <thead>
                <tr>
                    <th width="50%">DESCRIÇÃO</th>
                    <th width="10%" class="text-center">QTD</th>
                    <th width="15%" class="text-right">V. UNIT</th>
                    <th width="10%" class="text-right">DESC.</th>
                    <th width="15%" class="text-right">TOTAL</th>
                </tr>
            </thead>
            <tbody>
                @foreach($serviceOrder->serviceOrderServices as $item)
                <tr>
                    <td>{{ $item->service_name }}</td>
                    <td class="text-center">{{ $item->quantity }}</td>
                    <td class="text-right">{{ number_format($item->unit_price, 2, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($item->discount, 2, ',', '.') }}</td>
                    <td class="text-right font-bold">{{ number_format($item->total, 2, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    <!-- PRODUCTS -->
    @if($serviceOrder->serviceOrderProducts->count() > 0)
    <div style="margin-bottom: 10px;">
        <div class="section-header" style="border: 1px solid #000; border-bottom: none;">PEÇAS E MATERIAIS APLICADOS</div>
        <table class="table-datagrid">
            <thead>
                <tr>
                    <th width="50%">DESCRIÇÃO</th>
                    <th width="10%" class="text-center">QTD</th>
                    <th width="15%" class="text-right">V. UNIT</th>
                    <th width="10%" class="text-right">DESC.</th>
                    <th width="15%" class="text-right">TOTAL</th>
                </tr>
            </thead>
            <tbody>
                @foreach($serviceOrder->serviceOrderProducts as $item)
                <tr>
                    <td>{{ $item->product_name }}</td>
                    <td class="text-center">{{ $item->quantity }}</td>
                    <td class="text-right">{{ number_format($item->unit_price, 2, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($item->discount, 2, ',', '.') }}</td>
                    <td class="text-right font-bold">{{ number_format($item->total, 2, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    <!-- TECH REPORT & OBSERVATIONS -->
    @if($serviceOrder->technical_report || $serviceOrder->observations)
    <table class="invoice-box">
        <tr class="section-header">
            <td>LAUDO TÉCNICO E OBSERVAÇÕES</td>
        </tr>
        <tr>
            <td>
                @if($serviceOrder->technical_report)
                <div style="margin-bottom: 8px;">
                    <span class="info-label">LAUDO TÉCNICO:</span><br>
                    {!! nl2br(strip_tags($serviceOrder->technical_report)) !!}
                </div>
                @endif

                @if($serviceOrder->observations)
                <div>
                    <span class="info-label">OBSERVAÇÕES GERAIS:</span><br>
                    {!! nl2br(strip_tags($serviceOrder->observations)) !!}
                </div>
                @endif

                @if($serviceOrder->warranty_period)
                <div style="margin-top: 8px; padding-top: 5px; border-top: 1px dashed #ccc;">
                    <strong>GARANTIA:</strong> {{ $serviceOrder->warranty_period }}
                </div>
                @endif
            </td>
        </tr>
    </table>
    @endif

    <!-- TOTALS SECTION -->
    <div class="clearfix">
        <div class="total-box">
            <table width="100%" cellpadding="4" cellspacing="0" style="font-size: 11px;">
                @php
                    $totalServices = $serviceOrder->serviceOrderServices->sum('total');
                    $totalProducts = $serviceOrder->serviceOrderProducts->sum('total');
                    $totalDiscount = $serviceOrder->discount ?? ($serviceOrder->serviceOrderServices->sum('discount') + $serviceOrder->serviceOrderProducts->sum('discount'));
                @endphp
                <tr>
                    <td width="60%" class="text-right">TOTAL SERVIÇOS:</td>
                    <td width="40%" class="text-right">R$ {{ number_format($totalServices, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="text-right">TOTAL PRODUTOS:</td>
                    <td class="text-right">R$ {{ number_format($totalProducts, 2, ',', '.') }}</td>
                </tr>
                @if($totalDiscount > 0)
                <tr>
                    <td class="text-right">DESCONTOS:</td>
                    <td class="text-right">- R$ {{ number_format($totalDiscount, 2, ',', '.') }}</td>
                </tr>
                @endif
                <tr class="total-row">
                    <td class="text-right" style="font-size: 12px; background-color: #e0e0e0;">TOTAL A PAGAR:</td>
                    <td class="text-right" style="font-size: 14px; background-color: #e0e0e0;">R$ {{ number_format($serviceOrder->total_value, 2, ',', '.') }}</td>
                </tr>
            </table>
        </div>
    </div>

    <!-- SIGNATURES -->
    <div style="margin-top: 80px;">
        <table width="100%">
            <tr>
                <td width="45%" class="text-center">
                    <div style="border-bottom: 1px solid #000; margin-bottom: 5px;"></div>
                    <span style="font-size: 10px;">{{ $tenant->name }}</span><br>
                    <span style="font-size: 10px;">CNPJ: {{ $tenant->document ?? '' }}</span>
                </td>
                <td width="10%"></td>
                <td width="45%" class="text-center">
                    <div style="border-bottom: 1px solid #000; margin-bottom: 5px;"></div>
                    <span style="font-size: 10px;">{{ $person->name }}</span><br>
                    <span style="font-size: 10px;">CPF/CNPJ: {{ $person->document ?? '' }}</span>
                </td>
            </tr>
        </table>
    </div>

    <!-- FOOTER -->
    <div style="margin-top: 20px; font-size: 8px; text-align: center; color: #666; border-top: 1px solid #ccc; padding-top: 5px;">
        {{ $tenant->name }} - Documento gerado em {{ now()->format('d/m/Y H:i:s') }}
    </div>
</body>
</html>
