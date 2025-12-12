<x-layouts.pdf :title="'Ordem de Serviço #' . $serviceOrder->number">
    @php
        $person = $serviceOrder->person;
        $primaryPhone = $person->phones()->first();
        $primaryAddress = $person->addresses()->first();
    @endphp

    <style>
        /* Estilos modernos e limpos com tema Sobrio/Escuro */
        :root {
            /* oklch(0.21 0.034 264.665) convertido para hex aproximado para compatibilidade PDF */
            --text-main: #2B2F3B; 
            
            /* Verdes alterados para Cinza Escuro */
            --primary: #374151; /* Gray 700 */
            --primary-light: #f3f4f6; /* Gray 100 */
            
            --header-text: #ffffff;
            --text-secondary: #64748b;
            --border-color: #e2e8f0;
        }

        .os-container {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: var(--text-main);
        }

        /* Header Principal */
        .os-header {
            width: 100%;
            margin-bottom: 30px;
        }

        .os-header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .os-logo-cell {
            width: 15%;
            vertical-align: middle;
        }

        .os-company-cell {
            width: 50%;
            vertical-align: middle;
            padding-left: 15px;
        }

        .os-meta-cell {
            width: 35%;
            vertical-align: top;
            text-align: right;
        }

        .os-company-name {
            font-size: 18px;
            font-weight: bold;
            color: #374151; /* Dark Gray */
            margin-bottom: 4px;
        }

        .os-company-info {
            font-size: 11px;
            color: #64748b;
            line-height: 1.4;
        }

        /* Box do Número da OS */
        .os-number-badge {
            display: inline-block;
            background-color: #374151; /* Dark Gray */
            color: #ffffff;
            padding: 10px 15px;
            border-radius: 6px;
            text-align: center;
        }

        .os-number-label {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            opacity: 0.9;
            margin-bottom: 2px;
        }

        .os-number-value {
            font-size: 20px;
            font-weight: bold;
        }

        /* Seções de Informação */
        .info-section {
            margin-bottom: 25px;
        }

        .section-title {
            font-size: 12px;
            font-weight: bold;
            color: #374151; /* Dark Gray */
            text-transform: uppercase;
            border-bottom: 2px solid #374151; /* Dark Gray */
            padding-bottom: 5px;
            margin-bottom: 10px;
            letter-spacing: 0.5px;
        }

        .info-grid {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 4px;
        }

        .info-grid td {
            padding: 6px 8px;
            font-size: 11px;
            vertical-align: top;
        }

        .info-label {
            font-weight: bold;
            color: #475569;
            width: 15%;
            white-space: nowrap;
        }

        .info-value {
            color: #1e293b;
            border-bottom: 1px solid #f1f5f9;
        }

        /* Tabelas de Itens */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
            font-size: 11px;
        }

        .items-table th {
            background-color: #374151; /* Dark Gray */
            color: #ffffff;
            font-weight: bold;
            text-transform: uppercase;
            padding: 8px 10px;
            text-align: left;
            font-size: 10px;
        }

        .items-table td {
            padding: 8px 10px;
            border-bottom: 1px solid #e2e8f0;
            color: #334155;
        }

        .items-table tr:nth-child(even) {
            background-color: #f3f4f6; /* Gray 100 */
        }

        .text-right { text-align: right; }
        .text-center { text-align: center; }

        /* Valores Totais */
        .totals-container {
            width: 45%; /* Aumentado um pouco para caber titulos maiores se precisar */
            margin-left: auto;
            background-color: #f8fafc;
            border-radius: 8px;
            padding: 15px;
            border: 1px solid #e2e8f0;
        }

        .total-row.final td {
            border-top: 2px solid #e2e8f0;
        }

        /* Descrições e Laudos */
        .text-block {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 12px;
            font-size: 11px;
            line-height: 1.6;
            color: #334155;
            min-height: 40px;
        }

        /* Garantia Badge */
        .warranty-badge {
            background-color: #f3f4f6;
            border: 1px dashed #374151;
            color: #1f2937;
            padding: 10px;
            border-radius: 6px;
            font-size: 11px;
            text-align: center;
            margin-top: 10px;
        }
    </style>

    <div class="os-container">
        <!-- Header -->
        <div class="os-header">
            <table class="os-header-table">
                <tr>
                    <td class="os-logo-cell">
                        @if($tenant->avatar && Storage::exists($tenant->avatar))
                            <img src="{{ Storage::path($tenant->avatar) }}" alt="Logo" style="width: 80px; height: 80px; object-fit: contain;">
                        @else
                            <div style="width: 80px; height: 80px; background-color: #e2e8f0; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 28px; font-weight: bold; color: #94a3b8;">
                                {{ strtoupper(substr($tenant->name, 0, 1)) }}
                            </div>
                        @endif
                    </td>
                    <td class="os-company-cell">
                        <div class="os-company-name">{{ $tenant->name }}</div>
                        <div class="os-company-info">
                            @if($tenant->phone) <div>{{ $tenant->phone }}</div> @endif
                            @if($tenant->email) <div>{{ $tenant->email }}</div> @endif
                            @if($tenant->street)
                                <div>{{ $tenant->street }}{{ $tenant->number ? ', ' . $tenant->number : '' }}</div>
                                <div>{{ $tenant->neighborhood }} - {{ $tenant->city }}/{{ $tenant->state }}</div>
                            @endif
                        </div>
                    </td>
                    <td class="os-meta-cell">
                        <div class="os-number-badge">
                            <div class="os-number-label">Ordem de Serviço</div>
                            <div class="os-number-value">#{{ $serviceOrder->number }}</div>
                        </div>
                        <div style="margin-top: 10px; font-size: 11px; color: #64748b;">
                            <div><strong>Entrada:</strong> {{ $serviceOrder->opening_date->format('d/m/Y H:i') }}</div>
                            @if($serviceOrder->completion_date)
                                <div><strong>Saída:</strong> {{ $serviceOrder->completion_date->format('d/m/Y') }}</div>
                            @endif
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Cliente e Veículo -->
        <div class="info-section">
            <div class="section-title">Dados do Cliente e Equipamento</div>
            <table class="info-grid">
                <tr>
                    <td class="info-label">Cliente:</td>
                    <td class="info-value" width="45%">
                        <strong>{{ $person->name }}</strong><br>
                        <span style="font-size: 10px; color: #64748b;">
                            {{ $person->document ?? '' }} • {{ $primaryPhone ? $primaryPhone->number : '' }}
                        </span>
                    </td>
                    <td class="info-label" style="padding-left: 15px;">Equipamento:</td>
                    <td class="info-value">
                        <!-- Ajuste conforme campos reais do veículo/equipamento se existirem -->
                        <strong>-</strong><br>
                        <span style="font-size: 10px; color: #64748b;">-</span>
                    </td>
                </tr>
                <tr>
                    <td class="info-label">Endereço:</td>
                    <td class="info-value">
                        @if($primaryAddress)
                            {{ $primaryAddress->street }}, {{ $primaryAddress->number }} - {{ $primaryAddress->neighborhood }}
                        @else
                            -
                        @endif
                    </td>
                    <td class="info-label" style="padding-left: 15px;">Responsável:</td>
                    <td class="info-value">{{ $serviceOrder->user->name }}</td>
                </tr>
            </table>
        </div>

        <!-- Descrição e Laudo -->
        <div class="info-section">
            <div class="section-title">Relatório Técnico</div>
            
            <div style="margin-bottom: 10px;">
                <div style="font-size: 10px; font-weight: bold; color: #64748b; margin-bottom: 2px;">PROBLEMA RELATADO</div>
                <div class="text-block">
                    {!! nl2br(strip_tags($serviceOrder->description ?? 'Não informado')) !!}
                </div>
            </div>

            @if($serviceOrder->technical_report)
            <div style="margin-bottom: 10px;">
                <div style="font-size: 10px; font-weight: bold; color: #64748b; margin-bottom: 2px;">LAUDO TÉCNICO / SERVIÇO REALIZADO</div>
                <div class="text-block">
                    {!! nl2br(strip_tags($serviceOrder->technical_report)) !!}
                </div>
            </div>
            @endif
        </div>

        <!-- Serviços -->
        @if($serviceOrder->serviceOrderServices->count() > 0)
        <div class="info-section">
            <div class="section-title">Serviços Executados</div>
            <table class="items-table">
                <thead>
                    <tr>
                        <th width="45%">Descrição</th>
                        <th width="10%" class="text-center">Qtd.</th>
                        <th width="15%" class="text-right">V. Unit.</th>
                        <th width="15%" class="text-right">Desc.</th>
                        <th width="15%" class="text-right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($serviceOrder->serviceOrderServices as $item)
                    <tr>
                        <td>{{ $item->service_name }}</td>
                        <td class="text-center">{{ $item->quantity }}</td>
                        <td class="text-right">{{ number_format($item->unit_price, 2, ',', '.') }}</td>
                        <td class="text-right">{{ number_format($item->discount, 2, ',', '.') }}</td>
                        <td class="text-right"><strong>{{ number_format($item->total, 2, ',', '.') }}</strong></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif

        <!-- Produtos -->
        @if($serviceOrder->serviceOrderProducts->count() > 0)
        <div class="info-section">
            <div class="section-title">Peças e Materiais</div>
            <table class="items-table">
                <thead>
                    <tr>
                        <th width="45%">Descrição</th>
                        <th width="10%" class="text-center">Qtd.</th>
                        <th width="15%" class="text-right">V. Unit.</th>
                        <th width="15%" class="text-right">Desc.</th>
                        <th width="15%" class="text-right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($serviceOrder->serviceOrderProducts as $item)
                    <tr>
                        <td>{{ $item->product_name }}</td>
                        <td class="text-center">{{ $item->quantity }}</td>
                        <td class="text-right">{{ number_format($item->unit_price, 2, ',', '.') }}</td>
                        <td class="text-right">{{ number_format($item->discount, 2, ',', '.') }}</td>
                        <td class="text-right"><strong>{{ number_format($item->total, 2, ',', '.') }}</strong></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif

        <!-- Totais e Observações Finais -->
        <div style="display: flex; justify-content: space-between; margin-top: 20px;">
            <div style="width: 55%;">
                @if($serviceOrder->observations)
                <div style="margin-bottom: 15px;">
                    <div style="font-size: 10px; font-weight: bold; color: #64748b; margin-bottom: 2px;">OBSERVAÇÕES</div>
                    <div class="text-block" style="min-height: auto; font-style: italic;">
                        {!! nl2br(strip_tags($serviceOrder->observations)) !!}
                    </div>
                </div>
                @endif

                @if($serviceOrder->warranty_period)
                <div class="warranty-badge">
                    <strong>GARANTIA DO SERVIÇO:</strong> {{ $serviceOrder->warranty_period }}
                </div>
                @endif
            </div>

            <div class="totals-container">
                @php
                    $totalDiscountServices = $serviceOrder->serviceOrderServices->sum('discount');
                    $totalDiscountProducts = $serviceOrder->serviceOrderProducts->sum('discount');
                    $totalDiscount = $totalDiscountServices + $totalDiscountProducts;
                @endphp

                <table style="width: 100%; border-collapse: collapse;">
                    @if($serviceOrder->serviceOrderServices->count() > 0)
                    <tr>
                        <td class="text-right" style="padding: 4px; color: #64748b;">Total Serviços:</td>
                        <td class="text-right" style="padding: 4px; width: 100px;">R$ {{ number_format($serviceOrder->labor_value + $totalDiscountServices, 2, ',', '.') }}</td>
                    </tr>
                    @endif
                    
                    @if($serviceOrder->serviceOrderProducts->count() > 0)
                    <tr>
                        <td class="text-right" style="padding: 4px; color: #64748b;">Total Peças:</td>
                        <td class="text-right" style="padding: 4px;">R$ {{ number_format($serviceOrder->parts_value + $totalDiscountProducts, 2, ',', '.') }}</td>
                    </tr>
                    @endif

                    @if($totalDiscount > 0)
                    <tr>
                        <td class="text-right" style="padding: 4px; color: #ef4444;">Descontos:</td>
                        <td class="text-right" style="padding: 4px; color: #ef4444;">- R$ {{ number_format($totalDiscount, 2, ',', '.') }}</td>
                    </tr>
                    @endif

                    <tr class="total-row final">
                        <td class="text-right" style="padding-top: 10px; font-weight: bold; color: #374151; font-size: 14px;">VALOR TOTAL:</td>
                        <td class="text-right" style="padding-top: 10px; font-weight: bold; color: #374151; font-size: 14px; background-color: transparent;">R$ {{ number_format($serviceOrder->total_value, 2, ',', '.') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <!-- Assinaturas -->
    <x-pdf.signatures
        leftLabel="Prestador de Serviço"
        :leftName="$tenant->name"
        rightLabel="Cliente"
        :rightName="$serviceOrder->person->name"
    />

    <!-- Footer -->
    <x-pdf.footer
        :documentNumber="'#' . $serviceOrder->number"
        documentType="Ordem de Serviço"
    />

</x-layouts.pdf>
