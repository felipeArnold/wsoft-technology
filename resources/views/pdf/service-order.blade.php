<x-layouts.pdf :title="'Ordem de Serviço #' . $serviceOrder->number">
    @php
        $person = $serviceOrder->person;
        $primaryPhone = $person->phones()->first();
        $primaryAddress = $person->addresses()->first();
    @endphp

    <style>
        /* Estilos profissionais com tons de cinza e azul escuro */
        :root {
            --text-main: #1e293b;
            --text-secondary: #475569;
            --text-muted: #64748b;
            --border-color: #cbd5e0;
            --bg-light: #f8fafc;
            --bg-section: #ffffff;
            --accent: #334155;
            
            /* Sistema de espaçamento consistente */
            --spacing-xs: 4px;
            --spacing-sm: 8px;
            --spacing-md: 12px;
            --spacing-lg: 16px;
            --spacing-xl: 20px;
            --spacing-2xl: 24px;
            --spacing-3xl: 32px;
            --spacing-4xl: 40px;
        }

        .os-container {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: var(--text-main);
            line-height: 1.6;
        }

        /* Header Principal */
        .os-header {
            width: 100%;
            margin-bottom: var(--spacing-4xl);
            border-bottom: 2px solid var(--border-color);
            padding-bottom: var(--spacing-xl);
        }

        .os-header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .os-logo-cell {
            width: 12%;
            vertical-align: top;
            padding-right: var(--spacing-lg);
        }

        .os-company-cell {
            width: 48%;
            vertical-align: top;
            padding-right: var(--spacing-xl);
        }

        .os-meta-cell {
            width: 40%;
            vertical-align: top;
            text-align: right;
        }

        .os-company-name {
            font-size: 20px;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: var(--spacing-sm);
            letter-spacing: -0.5px;
            line-height: 1.3;
        }

        .os-company-info {
            font-size: 10px;
            color: var(--text-secondary);
            line-height: 1.7;
        }

        .os-company-info-item {
            margin-bottom: var(--spacing-xs);
            padding-left: var(--spacing-xs);
        }

        .os-company-info-label {
            font-weight: 600;
            color: var(--text-secondary);
            display: inline-block;
            min-width: 70px;
        }

        /* Box do Número da OS */
        .os-number-badge {
            display: inline-block;
            color: var(--text-main);
            padding: var(--spacing-md) var(--spacing-xl);
            border-radius: 4px;
            text-align: center;
            margin-bottom: var(--spacing-md);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .os-number-label {
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            opacity: 0.95;
            margin-bottom: var(--spacing-xs);
        }

        .os-number-value {
            font-size: 22px;
            font-weight: 700;
            letter-spacing: -0.5px;
            line-height: 1.2;
        }

        .os-dates {
            font-size: 10px;
            color: var(--text-secondary);
            line-height: 1.9;
        }

        .os-dates > div {
            margin-bottom: var(--spacing-xs);
        }

        .os-dates strong {
            color: var(--text-main);
            font-weight: 600;
            display: block;
            margin-bottom: 2px;
        }

        /* Seções de Informação */
        .info-section {
            margin-bottom: var(--spacing-3xl);
            background-color: var(--bg-section);
            padding: var(--spacing-xl);
            border: 1px solid var(--border-color);
            border-radius: 4px;
        }

        .section-title {
            font-size: 11px;
            font-weight: 700;
            color: var(--text-main);
            text-transform: uppercase;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: var(--spacing-sm);
            margin-bottom: var(--spacing-lg);
            margin-top: 0;
            letter-spacing: 0.8px;
        }

        .info-grid {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 var(--spacing-md);
        }

        .info-grid td {
            padding: var(--spacing-sm) 0;
            font-size: 11px;
            vertical-align: top;
        }

        .info-label {
            font-weight: 600;
            color: var(--text-secondary);
            width: 18%;
            white-space: nowrap;
            padding-right: var(--spacing-md);
            vertical-align: top;
        }

        .info-value {
            color: var(--text-main);
            line-height: 1.6;
        }

        .info-value strong {
            display: block;
            margin-bottom: var(--spacing-xs);
        }

        /* Tabelas de Itens */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0;
            margin-top: var(--spacing-md);
            font-size: 10px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            overflow: hidden;
        }

        .items-table th {
            background-color: var(--accent);
            color: #ffffff;
            font-weight: 600;
            text-transform: uppercase;
            padding: var(--spacing-md) var(--spacing-md);
            text-align: left;
            font-size: 9px;
            letter-spacing: 0.5px;
            line-height: 1.4;
        }

        .items-table th:first-child {
            padding-left: var(--spacing-lg);
        }

        .items-table th:last-child {
            padding-right: var(--spacing-lg);
        }

        .items-table td {
            padding: var(--spacing-md) var(--spacing-md);
            border-bottom: 1px solid var(--border-color);
            color: var(--text-main);
            line-height: 1.5;
        }

        .items-table td:first-child {
            padding-left: var(--spacing-lg);
        }

        .items-table td:last-child {
            padding-right: var(--spacing-lg);
        }

        .items-table tr:last-child td {
            border-bottom: none;
        }

        .items-table tr:nth-child(even) {
            background-color: var(--bg-light);
        }

        .items-table tr:hover {
            background-color: var(--bg-light);
        }

        .text-right { text-align: right; }
        .text-center { text-align: center; }

        /* Valores Totais */
        .totals-container {
            width: 48%;
            margin-left: auto;
            background-color: var(--bg-light);
            border: 1px solid var(--border-color);
            border-radius: 4px;
            padding: var(--spacing-xl);
        }

        .totals-title {
            font-size: 10px;
            font-weight: 700;
            color: var(--text-main);
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: var(--spacing-md);
            border-bottom: 1px solid var(--border-color);
            padding-bottom: var(--spacing-sm);
        }

        .totals-table {
            width: 100%;
            border-collapse: collapse;
        }

        .totals-table td {
            padding: var(--spacing-sm) var(--spacing-xs);
            font-size: 11px;
        }

        .total-row.final td {
            border-top: 2px solid var(--border-color);
            padding-top: var(--spacing-md);
        }

        /* Descrições e Laudos */
        .text-block {
            background-color: var(--bg-light);
            border: 1px solid var(--border-color);
            border-radius: 4px;
            padding: var(--spacing-lg);
            font-size: 11px;
            line-height: 1.7;
            color: var(--text-main);
            min-height: 60px;
        }

        .text-block-label {
            font-size: 9px;
            font-weight: 700;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: var(--spacing-sm);
            display: block;
        }

        .text-block-wrapper {
            margin-bottom: var(--spacing-lg);
        }

        .text-block-wrapper:last-child {
            margin-bottom: 0;
        }

        /* Garantia Badge */
        .warranty-badge {
            background-color: var(--bg-light);
            border: 1px solid var(--border-color);
            color: var(--text-main);
            padding: var(--spacing-md);
            border-radius: 4px;
            font-size: 11px;
            text-align: center;
            margin-top: var(--spacing-md);
        }

        .warranty-badge strong {
            font-weight: 600;
            color: var(--accent);
        }

        /* Observações e Totais Container */
        .footer-section {
            display: flex;
            justify-content: space-between;
            margin-top: var(--spacing-3xl);
            gap: var(--spacing-xl);
            align-items: flex-start;
        }

        .observations-container {
            width: 52%;
        }

        .observations-item {
            margin-bottom: var(--spacing-xl);
        }

        .observations-item:last-child {
            margin-bottom: 0;
        }
    </style>

    <div class="os-container">
        <!-- Header -->
        <div class="os-header">
            <table class="os-header-table">
                <tr>
                    <td class="os-logo-cell">
                        @if($tenant->avatar && Storage::exists($tenant->avatar))
                            <img src="{{ Storage::path($tenant->avatar) }}" alt="Logo" style="width: 90px; height: 90px; object-fit: contain; border: 1px solid var(--border-color); border-radius: 4px; padding: 4px;">
                        @else
                            <div style="width: 90px; height: 90px; background-color: var(--bg-light); border: 1px solid var(--border-color); border-radius: 4px; display: flex; align-items: center; justify-content: center; font-size: 32px; font-weight: 700; color: var(--text-secondary);">
                                {{ strtoupper(substr($tenant->name, 0, 1)) }}
                            </div>
                        @endif
                    </td>
                    <td class="os-company-cell">
                        <div class="os-company-name">{{ $tenant->name }}</div>
                        <div class="os-company-info">
                            @if($tenant->document)
                                <div class="os-company-info-item">
                                    <span class="os-company-info-label">CNPJ/CPF:</span> {{ $tenant->document }}
                                </div>
                            @endif
                            @if($tenant->phone)
                                <div class="os-company-info-item">
                                    <span class="os-company-info-label">Telefone:</span> {{ $tenant->phone }}
                                    @if($tenant->mobile) / {{ $tenant->mobile }} @endif
                                </div>
                            @elseif($tenant->mobile)
                                <div class="os-company-info-item">
                                    <span class="os-company-info-label">Celular:</span> {{ $tenant->mobile }}
                                </div>
                            @endif
                            @if($tenant->email)
                                <div class="os-company-info-item">
                                    <span class="os-company-info-label">E-mail:</span> {{ $tenant->email }}
                                </div>
                            @endif
                            @if($tenant->website)
                                <div class="os-company-info-item">
                                    <span class="os-company-info-label">Website:</span> {{ $tenant->website }}
                                </div>
                            @endif
                            @if($tenant->street)
                                <div class="os-company-info-item">
                                    <span class="os-company-info-label">Endereço:</span> 
                                    {{ $tenant->street }}{{ $tenant->number ? ', ' . $tenant->number : '' }}{{ $tenant->complement ? ' - ' . $tenant->complement : '' }}
                                </div>
                                <div class="os-company-info-item">
                                    <span class="os-company-info-label"></span>{{ $tenant->neighborhood }}{{ $tenant->zip_code ? ' - CEP: ' . $tenant->zip_code : '' }}
                                </div>
                                <div class="os-company-info-item">
                                    <span class="os-company-info-label"></span>{{ $tenant->city }}{{ $tenant->state ? '/' . $tenant->state : '' }}
                                </div>
                            @endif
                        </div>
                    </td>
                    <td class="os-meta-cell">
                        <div class="os-number-badge">
                            <div class="os-number-label">Ordem de Serviço</div>
                            <div class="os-number-value">#{{ $serviceOrder->number }}</div>
                        </div>
                        <div class="os-dates">
                            <div>
                                <strong>Data de Entrada:</strong>
                                {{ $serviceOrder->opening_date->format('d/m/Y') }} às {{ $serviceOrder->opening_date->format('H:i') }}
                            </div>
                            @if($serviceOrder->completion_date)
                                <div>
                                    <strong>Data de Saída:</strong>
                                    {{ $serviceOrder->completion_date->format('d/m/Y') }}
                                </div>
                            @endif
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Cliente e Equipamento -->
        <div class="info-section">
            <div class="section-title">Dados do Cliente e Equipamento</div>
            <table class="info-grid">
                <tr>
                    <td class="info-label">Cliente:</td>
                    <td class="info-value" width="48%">
                        <strong style="font-size: 12px; display: block; margin-bottom: 4px;">{{ $person->name }}</strong>
                        @if($person->document)
                            <span style="font-size: 10px; color: var(--text-secondary); display: block; margin-bottom: 2px;">Documento: {{ $person->document }}</span>
                        @endif
                        @if($primaryPhone)
                            <span style="font-size: 10px; color: var(--text-secondary); display: block;">Telefone: {{ $primaryPhone->number }}</span>
                        @endif
                    </td>
                    <td class="info-label" style="padding-left: var(--spacing-xl);">Equipamento:</td>
                    <td class="info-value">
                        <strong style="font-size: 12px; display: block; margin-bottom: 4px;">-</strong>
                        <span style="font-size: 10px; color: var(--text-secondary);">Não informado</span>
                    </td>
                </tr>
                <tr>
                    <td class="info-label">Endereço:</td>
                    <td class="info-value">
                        @if($primaryAddress)
                            <div style="margin-bottom: 2px;">{{ $primaryAddress->street }}, {{ $primaryAddress->number }}
                            @if($primaryAddress->complement), {{ $primaryAddress->complement }} @endif</div>
                            <div style="margin-bottom: 2px;">{{ $primaryAddress->district }}
                            @if($primaryAddress->postal_code), CEP: {{ $primaryAddress->postal_code }} @endif</div>
                            <div>{{ $primaryAddress->city }}{{ $primaryAddress->state ? '/' . $primaryAddress->state : '' }}</div>
                        @else
                            <span style="color: var(--text-muted);">Não informado</span>
                        @endif
                    </td>
                    <td class="info-label" style="padding-left: var(--spacing-xl);">Técnico Responsável:</td>
                    <td class="info-value">
                        <strong style="font-size: 12px; display: block; margin-bottom: 4px;">{{ $serviceOrder->user->name }}</strong>
                        @if($serviceOrder->user->email)
                            <span style="font-size: 10px; color: var(--text-secondary);">{{ $serviceOrder->user->email }}</span>
                        @endif
                    </td>
                </tr>
            </table>
        </div>

        <!-- Descrição e Laudo -->
        <div class="info-section">
            <div class="section-title">Relatório Técnico</div>
            
            <div class="text-block-wrapper">
                <div class="text-block-label">Problema Relatado pelo Cliente</div>
                <div class="text-block">
                    {!! nl2br(strip_tags($serviceOrder->description ?? 'Não informado')) !!}
                </div>
            </div>

            @if($serviceOrder->technical_report)
            <div class="text-block-wrapper">
                <div class="text-block-label">Laudo Técnico / Serviço Realizado</div>
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
        <div class="footer-section">
            <div class="observations-container">
                @if($serviceOrder->observations)
                <div class="observations-item">
                    <div class="text-block-label">Observações</div>
                    <div class="text-block" style="min-height: auto;">
                        {!! nl2br(strip_tags($serviceOrder->observations)) !!}
                    </div>
                </div>
                @endif

                @if($serviceOrder->warranty_period)
                <div class="warranty-badge">
                    <strong>Garantia do Serviço:</strong> {{ $serviceOrder->warranty_period }}
                </div>
                @endif
            </div>

            <div class="totals-container">
                @php
                    $totalDiscountServices = $serviceOrder->serviceOrderServices->sum('discount');
                    $totalDiscountProducts = $serviceOrder->serviceOrderProducts->sum('discount');
                    $totalDiscount = $totalDiscountServices + $totalDiscountProducts;
                @endphp

                <div class="totals-title">Resumo Financeiro</div>

                <table class="totals-table">
                    @if($serviceOrder->serviceOrderServices->count() > 0)
                    <tr>
                        <td class="text-right" style="color: var(--text-secondary);">Subtotal Serviços:</td>
                        <td class="text-right" style="width: 110px; font-weight: 600;">R$ {{ number_format($serviceOrder->labor_value + $totalDiscountServices, 2, ',', '.') }}</td>
                    </tr>
                    @endif
                    
                    @if($serviceOrder->serviceOrderProducts->count() > 0)
                    <tr>
                        <td class="text-right" style="color: var(--text-secondary);">Subtotal Peças:</td>
                        <td class="text-right" style="font-weight: 600;">R$ {{ number_format($serviceOrder->parts_value + $totalDiscountProducts, 2, ',', '.') }}</td>
                    </tr>
                    @endif

                    @if($totalDiscount > 0)
                    <tr>
                        <td class="text-right" style="color: var(--text-secondary);">Descontos:</td>
                        <td class="text-right" style="color: var(--text-secondary);">- R$ {{ number_format($totalDiscount, 2, ',', '.') }}</td>
                    </tr>
                    @endif

                    <tr class="total-row final">
                        <td class="text-right" style="font-weight: 700; color: var(--text-main); font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">Valor Total:</td>
                        <td class="text-right" style="font-weight: 700; color: var(--accent); font-size: 15px;">R$ {{ number_format($serviceOrder->total_value, 2, ',', '.') }}</td>
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
