<x-layouts.pdf :title="'Ordem de Serviço #' . $serviceOrder->number">

    <!-- Header -->
    <x-pdf.header
        :tenant="$tenant"
        :title="'ORDEM DE SERVIÇO #' . $serviceOrder->number"
        :subtitle="'Emitido em: ' . now()->format('d/m/Y \à\s H:i')"
    />

    <!-- Informações Principais -->
    <div class="section">
        <div class="section-title">INFORMAÇÕES DA ORDEM DE SERVIÇO</div>
        <table class="info-table">
            <tr>
                <td class="label">Data de Abertura:</td>
                <td class="value">{{ $serviceOrder->opening_date->format('d/m/Y') }}</td>
                <td class="label">Status:</td>
                <td class="value">
                    <span class="status-badge status-{{ $serviceOrder->status }}">
                        @switch($serviceOrder->status)
                            @case('draft') Rascunho @break
                            @case('in_progress') Em Andamento @break
                            @case('completed') Concluída @break
                            @case('cancelled') Cancelada @break
                        @endswitch
                    </span>
                </td>
            </tr>
            <tr>
                <td class="label">Previsão de Conclusão:</td>
                <td class="value">{{ $serviceOrder->expected_completion_date ? $serviceOrder->expected_completion_date->format('d/m/Y') : 'Não definida' }}</td>
                <td class="label">Prioridade:</td>
                <td class="value">
                    <span class="priority-badge priority-{{ $serviceOrder->priority }}">
                        @switch($serviceOrder->priority)
                            @case('low') Baixa @break
                            @case('medium') Média @break
                            @case('high') Alta @break
                            @case('urgent') Urgente @break
                        @endswitch
                    </span>
                </td>
            </tr>
            @if($serviceOrder->completion_date)
                <tr>
                    <td class="label">Data de Conclusão:</td>
                    <td class="value" colspan="3">{{ $serviceOrder->completion_date->format('d/m/Y') }}</td>
                </tr>
            @endif
        </table>
    </div>

    <!-- Cliente e Responsável -->
    <div class="section">
        <div class="section-title">CLIENTE E RESPONSÁVEL</div>
        <table class="grid-2">
            <tr>
                <td>
                    <table class="info-table">
                        <tr>
                            <td class="label">Cliente:</td>
                            <td class="value">{{ $serviceOrder->person->name }}</td>
                        </tr>
                        @if($serviceOrder->person->document)
                        <tr>
                            <td class="label">CPF/CNPJ:</td>
                            <td class="value">{{ $serviceOrder->person->document }}</td>
                        </tr>
                        @endif
                    </table>
                </td>
                <td>
                    <table class="info-table">
                        <tr>
                            <td class="label">Responsável Técnico:</td>
                            <td class="value">{{ $serviceOrder->user->name }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>

    <!-- Descrição do Serviço -->
    <div class="section">
        <div class="section-title">DESCRIÇÃO DO SERVIÇO</div>
        <div class="description-box">
            {!! nl2br(strip_tags($serviceOrder->description)) !!}
        </div>
    </div>

    <!-- Observações (se houver) -->
    @if($serviceOrder->observations)
    <div class="section">
        <div class="section-title">OBSERVAÇÕES</div>
        <div class="description-box">
            {!! nl2br(strip_tags($serviceOrder->observations)) !!}
        </div>
    </div>
    @endif

    <!-- Relatório Técnico (se houver) -->
    @if($serviceOrder->technical_report)
        <div class="section">
            <div class="section-title">RELATÓRIO TÉCNICO</div>
            <div class="description-box">
                {!! nl2br(strip_tags($serviceOrder->technical_report)) !!}
            </div>
        </div>
    @endif

    <!-- Valores -->
    <div class="section">
        <div class="section-title">VALORES</div>
        <table class="values-table">
            <tr>
                <td class="label-cell">Mão de Obra:</td>
                <td class="value-cell">R$ {{ number_format($serviceOrder->labor_value, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="label-cell">Peças/Materiais:</td>
                <td class="value-cell">R$ {{ number_format($serviceOrder->parts_value, 2, ',', '.') }}</td>
            </tr>
            <tr class="total-row">
                <td>VALOR TOTAL:</td>
                <td style="text-align: right;">R$ {{ number_format($serviceOrder->total_value, 2, ',', '.') }}</td>
            </tr>
        </table>
        @if($serviceOrder->warranty_period)
        <div class="alert-warning">
            <strong style="color: #b45309;">Garantia:</strong> {{ $serviceOrder->warranty_period }}
        </div>
        @endif
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
