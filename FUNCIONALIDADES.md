# Funcionalidades do SaaS - WSoft Technology

## Visão Geral
Sistema SaaS completo para gestão empresarial multi-tenant, especializado em **serviços automotivos e oficinas**, mas flexível para 93 tipos de negócios diferentes.

---

## Stack Tecnológico

- **Framework:** Laravel 12.0 + Filament 4.0
- **PHP:** 8.2+
- **Multi-tenancy:** Nativo com isolamento completo de dados
- **Autenticação:** Laravel Sanctum + 2FA via Email
- **Billing:** Laravel Cashier (Stripe)
- **Filas:** Laravel Horizon
- **Email:** Resend
- **IA:** OpenAI PHP
- **Frontend:** Vite + TypeScript
- **Testing:** PestPHP
- **Code Quality:** PHPStan, Rector, Pint

---

## Módulos Principais

### 1. Gestão de Ordem de Serviço (Core Feature)

**Funcionalidades:**
- ✅ Numeração automática de ordens
- ✅ Status e prioridades (baixa, média, alta, urgente)
- ✅ Múltiplos serviços por ordem
- ✅ Múltiplos produtos/peças por ordem
- ✅ Cálculo automático de valores (mão de obra + peças)
- ✅ Anexos (fotos e documentos PDF)
- ✅ Relatório técnico com editor rico
- ✅ Datas (abertura, previsão, conclusão)
- ✅ Tags/etiquetas para classificação
- ✅ Integração com contas a receber
- ✅ Período de garantia
- ✅ Cliente e técnico responsável

**Widgets de Dashboard:**
- Total de OS
- Em andamento
- Concluídas este mês
- Taxa de conclusão
- Gráfico por status
- Criação por dia
- Tendência de conclusão

---

### 2. Módulo Financeiro

#### 2.1 Vendas
- ✅ Vendas com múltiplos itens
- ✅ Cliente e vendedor
- ✅ Subtotal, desconto e total
- ✅ Parcelamento (configurável)
- ✅ Data de conclusão
- ✅ Categorização

**Widgets:**
- Receita do mês (com comparativo)
- Vendas do mês (com comparativo)
- Ticket médio
- Receita total histórica
- Gráfico de receita (últimos 30 dias)
- Produtos mais vendidos
- Vendas por categoria

#### 2.2 Contas a Receber
- ✅ Gestão de recebíveis
- ✅ Valor, desconto, juros, multa
- ✅ Parcelas múltiplas
- ✅ Status (pago, aberto, vencido, parcial, cancelado)
- ✅ Métodos de pagamento (Pix, cartão, transferência, dinheiro, boleto, cheque)
- ✅ Anexos (comprovantes)
- ✅ Integração com Ordem de Serviço
- ✅ Categorização

#### 2.3 Contas a Pagar
- ✅ Gestão de pagamentos a fornecedores
- ✅ Mesmas funcionalidades das contas a receber
- ✅ Rastreamento de despesas
- ✅ Categorização

#### 2.4 Não Pagamentos
- ✅ Rastreamento de inadimplência
- ✅ Motivos de não pagamento
- ✅ Multas e juros automáticos

#### 2.5 Extratos
- ✅ Importação de extratos bancários
- ✅ Reconciliação de pagamentos

**Widgets Financeiros:**
- Receita total
- Despesas totais
- Lucro líquido
- Fluxo de caixa mensal
- Despesas por categoria
- Distribuição mensal de despesas
- Métodos de pagamento (gráfico)
- Contas vencidas

---

### 3. Módulo de Estoque

#### 3.1 Produtos
- ✅ SKU e código de barras
- ✅ Nome, descrição
- ✅ Preço de venda e custo
- ✅ Custo médio calculado
- ✅ Margem de lucro e lucro líquido
- ✅ Estoque atual
- ✅ Alerta de estoque mínimo
- ✅ Fornecedor padrão
- ✅ Categorização
- ✅ Múltiplas imagens

#### 3.2 Movimentações de Estoque
- ✅ Tipos: entrada, saída, ajuste, devolução
- ✅ Quantidade
- ✅ Estoque antes/depois (auditoria)
- ✅ Custo unitário
- ✅ Motivo e observações
- ✅ Usuário responsável
- ✅ Rastreamento completo

#### 3.3 Inventário Físico
- ✅ Criação de inventários
- ✅ Referência e data
- ✅ Status (aberto, em progresso, concluído)
- ✅ Itens com contagem esperada vs real
- ✅ Diferenças calculadas
- ✅ Reconciliação de estoque

**Widgets de Estoque:**
- Valor total em estoque
- Produtos sem estoque
- Produtos com estoque baixo
- Valor médio por produto
- Movimentações (entrada vs saída - 30 dias)
- Valor de estoque por categoria
- Produtos com estoque crítico (tabela)
- Movimentações recentes

---

### 4. Módulo CRM

#### 4.1 Leads
- ✅ Captura de leads
- ✅ Nome, email, telefone, empresa
- ✅ Origem do lead
- ✅ Status (novo, contato, qualificado, perdido)
- ✅ Rastreamento UTM (source, medium, campaign, term, content)
- ✅ IP e User Agent
- ✅ Mensagem/notas
- ✅ Categorização

#### 4.2 Funis de Vendas
- ✅ Funis customizáveis
- ✅ Múltiplas etapas por funil
- ✅ Cores personalizadas
- ✅ Ordem das etapas
- ✅ Status ativo/inativo

#### 4.3 Equipes de Vendas
- ✅ Criação de equipes
- ✅ Associação a funis
- ✅ Membros (usuários)
- ✅ Campos customizados (JSON)

#### 4.4 Fontes de Leads
- ✅ Rastreamento de origens
- ✅ Cores personalizadas
- ✅ Fonte padrão configurável

#### 4.5 Motivos de Perda
- ✅ Categorização de perdas
- ✅ Análise de motivos
- ✅ Cores personalizadas

---

### 5. Módulo de Assinatura Digital

**Integração com ZapSign:**
- ✅ Criação de envelopes
- ✅ Upload de documentos PDF
- ✅ Múltiplos signatários
- ✅ Nome, email, telefone dos assinantes
- ✅ Prazo de assinatura
- ✅ Status de assinatura (rascunho, enviado, assinado, recusado, cancelado)
- ✅ Webhook para callbacks
- ✅ Download de documento assinado
- ✅ Rastreamento por signatário

---

### 6. Módulo de Cadastros

#### 6.1 Pessoas/Clientes
- ✅ Pessoa física ou jurídica
- ✅ CPF/CNPJ com validação
- ✅ Auto-preenchimento CNPJ (API)
- ✅ Nome, sobrenome
- ✅ Data de nascimento
- ✅ Nacionalidade, naturalidade
- ✅ Profissão
- ✅ Múltiplos telefones
- ✅ Múltiplos emails
- ✅ Múltiplos endereços
- ✅ Soft delete

#### 6.2 Fornecedores
- ✅ Dados de empresa
- ✅ CNPJ com auto-preenchimento
- ✅ Representantes comerciais
- ✅ Contatos e endereços

#### 6.3 Atividades/Tarefas
- ✅ Título e descrição
- ✅ Status
- ✅ Pessoa associada
- ✅ Usuário responsável
- ✅ Datas (início, vencimento, conclusão)
- ✅ Categorização

---

### 7. Módulo de Blog

- ✅ Posts com editor rico
- ✅ Título, slug (SEO-friendly)
- ✅ Resumo e conteúdo
- ✅ Imagem destacada
- ✅ Open Graph image
- ✅ Status (rascunho, publicado, arquivado)
- ✅ Post em destaque
- ✅ Contador de visualizações
- ✅ Meta tags (SEO)
- ✅ Categorização
- ✅ Autor (usuário)
- ✅ Páginas públicas de blog
- ✅ Feed RSS
- ✅ Sitemap XML

---

### 8. Multi-Tenancy

**93 Tipos de Negócios Suportados:**

**Automotivo (6):**
- Mecânica
- Funilaria
- Auto Center
- Concessionária
- Lava Rápido
- Borracharia

**Beleza (5):**
- Barbearia
- Salão de Beleza
- Spa
- Estética
- Nail Designer

**Saúde (6):**
- Clínica
- Consultório Odontológico
- Veterinária
- Farmácia
- Fisioterapia
- Laboratório

**Alimentação (7):**
- Restaurante
- Padaria
- Cafeteria
- Bar
- Pizzaria
- Lanchonete
- Sorveteria

**Varejo (8):**
- Loja de Roupas
- Supermercado
- Farmácia
- Pet Shop
- Eletrônicos
- Livraria
- Joalheria
- Papelaria

**Serviços Profissionais (8):**
- Contabilidade
- Advocacia
- Consultoria
- Arquitetura
- Engenharia
- Design
- Fotografia
- Imobiliária

**Tecnologia (4):**
- Desenvolvimento de Software
- TI
- Web Design
- Marketing Digital

**Educação (4):**
- Escola
- Escola de Idiomas
- Treinamentos
- Creche

**Construção (6):**
- Construção
- Encanamento
- Elétrica
- Pintura
- Carpintaria
- Marcenaria

**Esporte/Lazer (4):**
- Academia
- Esportes
- Agência de Viagens
- Eventos

**Outros (6+):**
- Segurança
- Limpeza
- Logística
- Transportes
- Agricultura
- Indústria

**Funcionalidades Multi-Tenant:**
- ✅ Isolamento completo de dados
- ✅ Slug único por tenant
- ✅ Billing integrado (Stripe)
- ✅ Gestão de membros
- ✅ Configurações por tenant
- ✅ Soft delete

---

### 9. Autenticação e Segurança

- ✅ Login com email/senha
- ✅ Registro de usuários
- ✅ Registro de tenants (empresas)
- ✅ Verificação de email
- ✅ Redefinição de senha
- ✅ 2FA via email (código temporário 2 minutos)
- ✅ Multi-tenancy com isolamento
- ✅ Políticas de acesso granular
- ✅ API tokens (Sanctum)
- ✅ CSRF protection
- ✅ Session management
- ✅ Password hashing

---

### 10. Integrações Externas

#### 10.1 Stripe
- ✅ Gestão de assinaturas
- ✅ Webhooks para callbacks
- ✅ Portal de cliente
- ✅ Faturamento automático

#### 10.2 ZapSign
- ✅ Assinatura digital de documentos
- ✅ Webhooks para status
- ✅ Download de documentos assinados

#### 10.3 Resend
- ✅ Envio de emails
- ✅ Templates de email
- ✅ Webhooks para eventos

#### 10.4 OpenAI
- ✅ Geração de conteúdo
- ✅ Posts de blog automáticos
- ✅ Sugestões

---

### 11. Dashboard Analítico

**Organização em Abas:**

#### Aba: Visão Geral
- Receita total
- Fluxo de caixa mensal

#### Aba: Financeiro
- Visão geral financeira
- Fluxo de caixa
- Despesas por categoria
- Distribuição mensal
- Métodos de pagamento
- Contas vencidas

#### Aba: Vendas
- Visão geral de vendas
- Gráfico de receita
- Produtos mais vendidos
- Vendas por categoria

#### Aba: Ordem de Serviço
- Visão geral de OS
- Gráfico por status
- Criação por dia
- Tendência de conclusão

#### Aba: Estoque
- Visão geral de estoque
- Movimentações (entrada/saída)
- Valor por categoria
- Produtos com estoque baixo
- Movimentações recentes

---

### 12. Configurações do Sistema (Settings Cluster)

#### CRM
- Funis de vendas
- Equipes
- Fontes de leads
- Motivos de perda

#### Empresa
- Dados do tenant
- Assinaturas

#### Usuários
- Gestão de usuários
- Permissões (potencial)

#### Templates de Email
- CRUD de templates
- Variáveis dinâmicas
- Contextos (confirmação, recebimento, etc.)

#### Categorias
- Categorias multi-propósito
- Cores personalizadas
- Por finalidade (OS, contas, produtos, etc.)

#### Serviços
- Catálogo de serviços
- Preços
- Descontos

---

### 13. Funcionalidades Avançadas

#### Cálculos Automáticos
- ✅ Totais de vendas
- ✅ Totais de ordens de serviço
- ✅ Margem de lucro de produtos
- ✅ Custo médio de estoque
- ✅ Fluxo de caixa projetado

#### Rastreamento e Auditoria
- ✅ Timestamps automáticos (created_at, updated_at)
- ✅ Observer patterns para auditoria
- ✅ Soft deletes (nunca deletar permanentemente)
- ✅ Rastreamento de estoque (antes/depois)
- ✅ Usuário responsável por ações

#### Notificações
- ✅ 2FA via email
- ✅ Webhooks (Stripe, ZapSign)
- ✅ Notificações de banco de dados

#### Templates de Email
- ✅ Templates personalizáveis
- ✅ Substituição de variáveis
- ✅ Contextos específicos
- ✅ Preview de templates

#### Sugestões de Usuários
- ✅ Envio de sugestões
- ✅ Status (aberto, em revisão, implementado, recusado)
- ✅ Votos
- ✅ Prioridade

---

### 14. Componentes Customizados

- ✅ **PtbrMoney** - Input monetário formatado em Real (R$)
- ✅ **PhoneComponent** - Formatação de telefone brasileiro
- ✅ **CnpjComponent** - Auto-preenchimento via API
- ✅ **FormatterHelper** - Conversões e formatações

---

### 15. Landing Pages para Captura de Leads

- ✅ Landing page para mecânica
- ✅ Landing page para funilaria
- ✅ Landing page para oficina
- ✅ Rastreamento UTM
- ✅ IP e User Agent tracking

---

### 16. SEO e Marketing

- ✅ Blog público
- ✅ Meta tags (title, description, keywords)
- ✅ Open Graph images
- ✅ Slug SEO-friendly
- ✅ Sitemap XML
- ✅ Feed RSS
- ✅ Rastreamento UTM em leads

---

### 17. Relatórios e Exportações

- ✅ Dashboard com gráficos (ApexCharts)
- ✅ Widgets estatísticos
- ✅ Exportação de dados (Filament Export)
- ✅ PDF Reports (potencial com DOMPDF)

---

### 18. Jobs e Filas

- ✅ Laravel Horizon para monitoramento
- ✅ Processamento assíncrono
- ✅ Webhooks em background
- ✅ Email em fila

---

## Resumo de Funcionalidades

### Core Features
1. ✅ **Ordem de Serviço Completa** (numeração automática, múltiplos serviços/produtos, anexos, relatórios)
2. ✅ **Gestão Financeira** (vendas, contas a receber/pagar, parcelas, métodos de pagamento)
3. ✅ **Controle de Estoque** (produtos, movimentações auditadas, inventário físico, alertas)
4. ✅ **CRM** (leads, funis, equipes, fontes, motivos de perda)
5. ✅ **Assinatura Digital** (integração ZapSign, múltiplos signatários)
6. ✅ **Multi-Tenancy** (93 tipos de negócios, isolamento completo)
7. ✅ **Dashboard Analítico** (widgets organizados em abas)
8. ✅ **Autenticação 2FA** (email-based)
9. ✅ **Blog** (SEO-friendly, categorias, autor)
10. ✅ **Integrações** (Stripe, ZapSign, Resend, OpenAI)

### Total de Funcionalidades Implementadas

- **20+ Resources** (CRUD completo)
- **40+ Widgets** (dashboard analítico)
- **15+ Modelos de Dados** principais
- **54 Migrations** (banco de dados completo)
- **93 Tipos de Negócios** suportados
- **8 Integrações Externas** (APIs)
- **6 Módulos Principais** (core features)

---

## Público-Alvo

**Principal:** Oficinas mecânicas, funilarias, auto centers
**Secundário:** Qualquer negócio dos 93 tipos suportados

---

## Diferenciais

1. Sistema especializado para serviços (ordem de serviço robusta)
2. Multi-tenant nativo (isolamento completo)
3. Dashboard analítico poderoso
4. Integrações externas prontas
5. Controle financeiro e estoque integrados
6. CRM completo
7. Assinatura digital integrada
8. Blog para marketing de conteúdo
9. Código limpo e bem arquitetado
10. Type-safe (PHPStan 100%)

---

**Última atualização:** 2025-12-17
**Versão do Laravel:** 12.0
**Versão do Filament:** 4.0
