# Componentes Reutilizáveis de PDF

Este diretório contém componentes Blade reutilizáveis para geração de PDFs profissionais e padronizados.

## 📁 Estrutura de Componentes

```
resources/views/
├── layouts/
│   └── pdf.blade.php              # Layout base com estilos comuns
├── components/
│   └── pdf/
│       ├── header.blade.php       # Header com logo, título e dados da empresa
│       ├── footer.blade.php       # Footer com informações do documento
│       └── signatures.blade.php   # Área de assinaturas
└── pdf/
    ├── service-order.blade.php    # Exemplo: Ordem de Serviço
    └── exemplo-uso-componentes.blade.php  # Template de exemplo
```

## 🎨 Componentes Disponíveis

### 1. Layout Base (`x-layouts.pdf`)

Layout base que contém todos os estilos CSS comuns para PDFs.

**Uso:**
```blade
<x-layouts.pdf title="Título do Documento">
    <!-- Conteúdo aqui -->
</x-layouts.pdf>
```

**Props:**
- `title` (string): Título que aparece na aba do navegador/PDF

---

### 2. Header (`x-pdf.header`)

Cabeçalho organizado em 3 colunas:
- **Esquerda:** Logo da empresa (ou letra inicial)
- **Centro:** Título do documento e data
- **Direita:** Nome da empresa, CNPJ e contatos

**Uso:**
```blade
<x-pdf.header
    :tenant="$tenant"
    title="ORDEM DE SERVIÇO #123"
    subtitle="Emitido em: 08/11/2025 às 14:30"
/>
```

**Props:**
- `tenant` (object): Objeto do tenant com dados da empresa
- `title` (string): Título do documento (em negrito)
- `subtitle` (string, opcional): Subtítulo/data abaixo do título

---

### 3. Footer (`x-pdf.footer`)

Rodapé com informações de validade e dados do documento.

**Uso:**
```blade
<x-pdf.footer
    documentNumber="#12345"
    documentType="Ordem de Serviço"
/>
```

**Props:**
- `documentNumber` (string, opcional): Número do documento
- `documentType` (string, default: "Documento"): Tipo do documento

---

### 4. Signatures (`x-pdf.signatures`)

Área de assinaturas com duas colunas (esquerda e direita).

**Uso:**
```blade
<x-pdf.signatures
    leftLabel="Prestador de Serviço"
    leftName="WSoft Technology"
    rightLabel="Cliente"
    rightName="João Silva"
/>
```

**Props:**
- `leftLabel` (string): Label da assinatura esquerda
- `leftName` (string): Nome para assinatura esquerda
- `rightLabel` (string): Label da assinatura direita
- `rightName` (string): Nome para assinatura direita

---

## 🎯 Classes CSS Disponíveis

### Seções
```blade
<div class="section">
    <div class="section-title">TÍTULO DA SEÇÃO</div>
    <!-- Conteúdo -->
</div>
```

### Tabelas de Informações
```blade
<table class="info-table">
    <tr>
        <td class="label">Campo:</td>
        <td class="value">Valor</td>
    </tr>
</table>
```

### Tabela de Valores
```blade
<table class="values-table">
    <tr>
        <td class="label-cell">Item:</td>
        <td class="value-cell">R$ 100,00</td>
    </tr>
    <tr class="total-row">
        <td>TOTAL:</td>
        <td style="text-align: right;">R$ 100,00</td>
    </tr>
</table>
```

### Caixa de Descrição
```blade
<div class="description-box">
    Texto da descrição...
</div>
```

### Badges de Status
```blade
<span class="status-badge status-draft">Rascunho</span>
<span class="status-badge status-in_progress">Em Andamento</span>
<span class="status-badge status-completed">Concluída</span>
<span class="status-badge status-cancelled">Cancelada</span>
```

### Badges de Prioridade
```blade
<span class="priority-badge priority-low">Baixa</span>
<span class="priority-badge priority-medium">Média</span>
<span class="priority-badge priority-high">Alta</span>
<span class="priority-badge priority-urgent">Urgente</span>
```

### Alert Boxes
```blade
<div class="alert-warning">Aviso amarelo</div>
<div class="alert-info">Informação azul</div>
<div class="alert-success">Sucesso verde</div>
<div class="alert-danger">Erro vermelho</div>
```

### Grid de 2 Colunas
```blade
<table class="grid-2">
    <tr>
        <td>Coluna 1</td>
        <td>Coluna 2</td>
    </tr>
</table>
```

---

## 📝 Exemplo Completo

Veja o arquivo `exemplo-uso-componentes.blade.php` para um template completo com todos os componentes e classes CSS disponíveis.

---

## 🚀 Como Criar um Novo PDF

1. Crie um novo arquivo em `resources/views/pdf/meu-documento.blade.php`
2. Use o layout base e os componentes:

```blade
<x-layouts.pdf title="Meu Documento">

    <x-pdf.header
        :tenant="$tenant"
        title="MEU DOCUMENTO #001"
        subtitle="Data: {{ now()->format('d/m/Y') }}"
    />

    <div class="section">
        <div class="section-title">INFORMAÇÕES</div>
        <!-- Seu conteúdo aqui -->
    </div>

    <x-pdf.signatures
        leftLabel="Empresa"
        :leftName="$tenant->name"
        rightLabel="Cliente"
        :rightName="$cliente->name"
    />

    <x-pdf.footer
        documentNumber="#001"
        documentType="Meu Documento"
    />

</x-layouts.pdf>
```

3. No controller/action, gere o PDF:

```php
use Barryvdh\DomPDF\Facade\Pdf;

$pdf = Pdf::loadView('pdf.meu-documento', [
    'tenant' => $tenant,
    'cliente' => $cliente,
    // outros dados...
])
->setPaper('a4')
->setOption('margin-top', 10)
->setOption('margin-bottom', 10)
->setOption('margin-left', 10)
->setOption('margin-right', 10);

return response()->streamDownload(
    fn () => print($pdf->output()),
    'meu-documento.pdf'
);
```

---

## 🎨 Cores Padrão

- **Azul Principal:** #60a5fa
- **Azul Claro:** #93c5fd
- **Azul Escuro:** #1e3a8a
- **Cinza Texto:** #333
- **Bordas:** #e5e7eb

---

## 📌 Notas Importantes

1. Use `storage_path()` para caminhos de imagens no PDF
2. O DomPDF não suporta `flexbox` - use tabelas para layouts
3. Estilos inline têm prioridade sobre classes CSS
4. Mantenha o CSS simples para melhor compatibilidade
5. Teste sempre em diferentes visualizadores de PDF

---

## ✅ Checklist para Novos PDFs

- [ ] Usar layout base `x-layouts.pdf`
- [ ] Incluir header `x-pdf.header`
- [ ] Estruturar conteúdo em seções
- [ ] Adicionar assinaturas `x-pdf.signatures`
- [ ] Incluir footer `x-pdf.footer`
- [ ] Testar geração do PDF
- [ ] Verificar margens e quebras de página

---

## 📚 Referências

- [DomPDF Documentation](https://github.com/dompdf/dompdf)
- [Laravel DomPDF](https://github.com/barryvdh/laravel-dompdf)
