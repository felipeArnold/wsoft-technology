{{--
    EXEMPLO DE COMO USAR OS COMPONENTES DE PDF

    Este é um exemplo de template que mostra como usar os componentes reutilizáveis
    de PDF para criar novos documentos.
--}}

<x-layouts.pdf title="Título do Documento">

    {{-- HEADER: Logo esquerda | Título centro | Empresa direita --}}
    <x-pdf.header
        :tenant="$tenant"
        title="TÍTULO DO DOCUMENTO"
        subtitle="Data: {{ now()->format('d/m/Y') }}"
    />

    {{-- CONTEÚDO DO DOCUMENTO --}}

    {{-- Seção com título --}}
    <div class="section">
        <div class="section-title">SEÇÃO 1</div>

        {{-- Tabela de informações --}}
        <table class="info-table">
            <tr>
                <td class="label">Campo 1:</td>
                <td class="value">Valor 1</td>
                <td class="label">Campo 2:</td>
                <td class="value">Valor 2</td>
            </tr>
        </table>
    </div>

    {{-- Caixa de descrição --}}
    <div class="section">
        <div class="section-title">DESCRIÇÃO</div>
        <div class="description-box">
            Texto da descrição aqui...
        </div>
    </div>

    {{-- Tabela de valores --}}
    <div class="section">
        <div class="section-title">VALORES</div>
        <table class="values-table">
            <tr>
                <td class="label-cell">Item 1:</td>
                <td class="value-cell">R$ 100,00</td>
            </tr>
            <tr>
                <td class="label-cell">Item 2:</td>
                <td class="value-cell">R$ 50,00</td>
            </tr>
            <tr class="total-row">
                <td>TOTAL:</td>
                <td style="text-align: right;">R$ 150,00</td>
            </tr>
        </table>
    </div>

    {{-- Alert boxes disponíveis --}}
    <div class="alert-warning">
        <strong>Aviso:</strong> Mensagem de alerta amarela
    </div>

    <div class="alert-info">
        <strong>Informação:</strong> Mensagem informativa azul
    </div>

    <div class="alert-success">
        <strong>Sucesso:</strong> Mensagem de sucesso verde
    </div>

    <div class="alert-danger">
        <strong>Erro:</strong> Mensagem de erro vermelha
    </div>

    {{-- Badges de status --}}
    <p>
        Status disponíveis:
        <span class="status-badge status-draft">Rascunho</span>
        <span class="status-badge status-in_progress">Em Andamento</span>
        <span class="status-badge status-completed">Concluída</span>
        <span class="status-badge status-cancelled">Cancelada</span>
    </p>

    {{-- Badges de prioridade --}}
    <p>
        Prioridades disponíveis:
        <span class="priority-badge priority-low">Baixa</span>
        <span class="priority-badge priority-medium">Média</span>
        <span class="priority-badge priority-high">Alta</span>
        <span class="priority-badge priority-urgent">Urgente</span>
    </p>

    {{-- ASSINATURAS --}}
    <x-pdf.signatures
        leftLabel="Prestador"
        leftName="Nome do Prestador"
        rightLabel="Cliente"
        rightName="Nome do Cliente"
    />

    {{-- FOOTER --}}
    <x-pdf.footer
        documentNumber="#12345"
        documentType="Tipo do Documento"
    />

</x-layouts.pdf>
