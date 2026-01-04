# WSoft Technology - Sistema de Gestão Empresarial

> Sistema completo de gestão empresarial com foco em oficinas mecânicas, funilarias e diversos segmentos de negócios.

## Sobre

WSoft Technology é uma plataforma SaaS de gestão empresarial desenvolvida com Laravel e Filament, oferecendo soluções completas para:

- Oficinas mecânicas e automotivas
- Funilarias e pinturas
- Barbearias e salões de beleza
- Pet shops
- Lojas de roupas
- Pizzarias e restaurantes
- Clínicas de estética
- Lava rápidos

## Principais Funcionalidades

### Gestão de Clientes
- Cadastro completo de pessoas (físicas e jurídicas)
- Histórico de atendimentos
- Controle de veículos vinculados
- CRM integrado

### Ordens de Serviço
- Criação e gerenciamento de OS
- Integração com assinatura digital (ZapSign)
- Geração de PDF personalizado
- Controle de status e prazos
- Sistema de comissões

### Gestão Financeira
- Contas a pagar e receber
- Controle de inadimplência
- Fluxo de caixa
- Comissões de vendas
- Relatórios financeiros
- Integração com Stripe para pagamentos

### Estoque
- Controle de produtos e peças
- Movimentações de estoque
- Inventário
- Alertas de estoque mínimo

### Vendas
- Registro de vendas
- Comissionamento automático
- Relatórios de performance

### Garantias
- Controle de garantias de serviços
- Notificações de vencimento

## Tecnologias

- **Backend**: Laravel 12.x, PHP 8.2+
- **Frontend**: Filament 4.x, Livewire, Alpine.js
- **Database**: MySQL/PostgreSQL
- **Pagamentos**: Stripe, Laravel Cashier
- **IA**: OpenAI API para geração de conteúdo
- **Assinatura Digital**: ZapSign
- **E-mail**: Resend
- **Queue**: Laravel Horizon

## Segmentos Atendidos

### Automotivo
- [Oficinas Mecânicas]({{ url('/software-gestao-oficina-mecanica') }})
- [Funilarias]({{ url('/funilaria') }})
- [Lava Rápido]({{ url('/sistema-para-lava-rapido') }})

### Beleza e Estética
- [Barbearias]({{ url('/sistema-para-barbearia') }})
- [Salões de Beleza]({{ url('/sistema-para-salao-de-beleza') }})
- [Clínicas de Estética]({{ url('/sistema-para-clinica-estetica') }})

### Varejo e Serviços
- [Pet Shops]({{ url('/sistema-para-pet-shop') }})
- [Lojas de Roupas]({{ url('/sistema-para-loja-de-roupas') }})
- [Pizzarias]({{ url('/sistema-para-pizzaria') }})

### Soluções Corporativas
- [CRM e Gestão Empresarial]({{ url('/crm-gestao-empresarial') }})
- [Software Sob Medida]({{ url('/software-sob-medida') }})
- [White Label para Revenda]({{ url('/sistema-white-label-para-revenda') }})

## Funcionalidades por Módulo

### Ordem de Serviço Digital
- Criação rápida de OS
- Assinatura digital integrada
- Envio automático por e-mail/WhatsApp
- Impressão e PDF personalizados

### Sistema de Comissões
- Cálculo automático por venda
- Múltiplos vendedores
- Relatórios de comissionamento
- Integração com folha de pagamento

### Gestão de Estoque
- Controle de entrada e saída
- Inventário periódico
- Código de barras
- Categorização de produtos

### Gestão Financeira
- Contas a pagar e receber
- Conciliação bancária
- Relatórios gerenciais
- Dashboard financeiro

### Assinatura Digital
- Integração com ZapSign
- Envio de documentos
- Rastreamento de assinaturas
- Arquivamento automático

## Blog e Conteúdo

Acesse nosso [blog]({{ url('/blog') }}) para conteúdos sobre:
- Gestão empresarial
- Dicas para oficinas
- Tecnologia e inovação
- Cases de sucesso

## Sitemap

Para mais informações sobre todas as páginas disponíveis: [Sitemap]({{ url('/sitemap.xml') }})

## Feed RSS

Acompanhe nossos artigos: [Feed RSS]({{ url('/feed') }})

## Contato e Demonstração

- [Solicitar Demonstração]({{ url('/demonstracao') }})
- [Perguntas Frequentes]({{ url('/faq') }})
- [Benefícios]({{ url('/beneficios') }})
- [Quem Somos]({{ url('/quem-somos') }})

---

Última atualização: {{ now()->format('Y-m-d') }}
URL: {{ url('/') }}
