# Pontos de Melhoria - WSoft Technology SaaS

## Índice
1. [Segurança](#1-segurança)
2. [Performance e Otimização](#2-performance-e-otimização)
3. [Experiência do Usuário (UX/UI)](#3-experiência-do-usuário-uxui)
4. [Testes e Qualidade](#4-testes-e-qualidade)
5. [Documentação](#5-documentação)
6. [Funcionalidades Faltantes](#6-funcionalidades-faltantes)
7. [Integrações](#7-integrações)
8. [DevOps e Infraestrutura](#8-devops-e-infraestrutura)
9. [Acessibilidade](#9-acessibilidade)
10. [Arquitetura e Código](#10-arquitetura-e-código)
11. [Monitoramento e Analytics](#11-monitoramento-e-analytics)
12. [Backup e Recuperação](#12-backup-e-recuperação)

---

## 1. Segurança

### 🔴 Crítico

#### 1.1 Rate Limiting
**Status:** ⚠️ Não implementado
**Impacto:** Alto - Vulnerável a ataques de força bruta

**Problema:**
- Sem limitação de tentativas de login
- APIs sem rate limiting
- Vulnerável a DDoS em nível de aplicação

**Solução:**
```php
// Adicionar no RouteServiceProvider ou em routes
RateLimiter::for('api', function (Request $request) {
    return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
});

RateLimiter::for('login', function (Request $request) {
    return Limit::perMinute(5)->by($request->email.$request->ip());
});
```

**Arquivos afetados:**
- `app/Providers/RouteServiceProvider.php`
- `routes/api.php`
- Páginas de login do Filament

---

#### 1.2 Validação de Uploads de Arquivo
**Status:** ⚠️ Implementação parcial
**Impacto:** Alto - Risco de upload de arquivos maliciosos

**Problema:**
- Validações de tipo MIME podem ser burladas
- Sem verificação de assinaturas de arquivo
- Falta validação de tamanho máximo consistente

**Solução:**
```php
// Criar validator customizado
class SecureFileValidator
{
    public static function validate(UploadedFile $file): bool
    {
        // Verificar extensão real do arquivo
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $file->getRealPath());
        finfo_close($finfo);

        // Validar contra whitelist
        $allowedMimes = ['image/jpeg', 'image/png', 'application/pdf'];

        return in_array($mimeType, $allowedMimes);
    }
}
```

**Arquivos afetados:**
- `app/Filament/Resources/Services/ServiceOrders/` (attachments)
- `app/Filament/Resources/Services/DigitalSignature/Envelopes/` (documents)
- `app/Models/Product.php` (attachment field)

---

#### 1.3 Sanitização de Inputs
**Status:** ⚠️ Implementação parcial
**Impacto:** Médio - XSS possível em alguns campos

**Problema:**
- RichEditor pode permitir JavaScript em alguns contextos
- Campos de texto livre sem sanitização adequada
- Falta proteção contra SQL Injection em queries raw

**Solução:**
```php
// Usar sempre prepared statements
DB::raw('SUM(products.stock * products.price_cost)')
// Melhor:
DB::table('products')->selectRaw('SUM(stock * price_cost) as total_value')

// Sanitizar RichEditor
use Illuminate\Support\Str;

$cleanHtml = Str::of($dirtyHtml)->stripTags(['p', 'br', 'strong', 'em', 'ul', 'ol', 'li']);
```

**Arquivos afetados:**
- Todos os widgets com `DB::raw()`
- `app/Filament/Resources/Services/ServiceOrders/Schemas/ServiceOrderForm.php`
- Campos com RichEditor

---

### 🟡 Importante

#### 1.4 Tokens de API com Expiração
**Status:** ⚠️ Não implementado
**Impacto:** Médio

**Problema:**
- Tokens do Sanctum sem expiração configurada
- Falta rotação de tokens
- Sem revogação automática

**Solução:**
```php
// config/sanctum.php
'expiration' => 60, // 60 minutos

// Implementar middleware de expiração
class CheckTokenExpiration
{
    public function handle($request, Closure $next)
    {
        if ($request->user() && $request->user()->currentAccessToken()->created_at->addMinutes(60)->isPast()) {
            $request->user()->currentAccessToken()->delete();
            return response()->json(['message' => 'Token expired'], 401);
        }

        return $next($request);
    }
}
```

---

#### 1.5 Logs de Auditoria
**Status:** ⚠️ Implementação básica
**Impacto:** Médio - Dificulta rastreamento de problemas

**Problema:**
- Sem log de ações críticas (exclusões, mudanças de senha)
- Falta rastreamento de quem fez o quê
- Sem retenção de logs configurada

**Solução:**
```php
// Instalar spatie/laravel-activitylog
composer require spatie/laravel-activitylog

// Usar em modelos críticos
use Spatie\Activitylog\Traits\LogsActivity;

class ServiceOrder extends Model
{
    use LogsActivity;

    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
}
```

---

## 2. Performance e Otimização

### 🔴 Crítico

#### 2.1 N+1 Query Problems
**Status:** ⚠️ Presente em múltiplos widgets
**Impacto:** Alto - Performance ruim com muitos dados

**Problema:**
```php
// Em widgets como LowStockProductsWidget
Product::query()
    ->whereNotNull('stock_alert')
    ->get();

// Depois acessa $product->category->name (N+1!)
```

**Solução:**
```php
Product::query()
    ->with(['category', 'person'])
    ->whereNotNull('stock_alert')
    ->get();
```

**Arquivos afetados:**
- `app/Filament/Widgets/LowStockProductsWidget.php`
- `app/Filament/Widgets/RecentStockMovementsWidget.php`
- `app/Filament/Widgets/TopSellingProductsWidget.php`
- Todos os Resources com RelationManagers

---

#### 2.2 Cache de Dados Frequentes
**Status:** ⚠️ Não implementado
**Impacto:** Alto - Queries repetitivas

**Problema:**
- Dashboard recalcula tudo a cada refresh
- Widgets fazem mesmas queries várias vezes
- Categorias e dados de configuração sem cache

**Solução:**
```php
// Cache de dashboard
public function getStats(): array
{
    return Cache::remember(
        'dashboard-stats-' . Filament::getTenant()->id,
        now()->addMinutes(5),
        function () {
            // ... cálculos
        }
    );
}

// Invalidar cache quando dados mudarem
protected static function booted()
{
    static::saved(function () {
        Cache::forget('dashboard-stats-' . Filament::getTenant()->id);
    });
}
```

**Arquivos afetados:**
- Todos os widgets (40+)
- `app/Models/Category.php`
- `app/Models/Product.php`

---

#### 2.3 Eager Loading em Queries Complexas
**Status:** ⚠️ Implementação inconsistente
**Impacto:** Alto

**Problema:**
```php
// Em SalesRevenueChart, TopSellingProductsWidget
DB::table('products')->leftJoin('sale_items', ...)
// Faz joins mas não otimiza relacionamentos
```

**Solução:**
```php
// Usar Eloquent com eager loading sempre que possível
Sale::with(['items.product.category', 'person', 'user'])
    ->whereDate('created_at', '>=', now()->subDays(30))
    ->get();
```

---

### 🟡 Importante

#### 2.4 Índices de Banco de Dados
**Status:** ⚠️ Incompleto
**Impacto:** Médio - Consultas lentas com crescimento de dados

**Problema:**
- Faltam índices em campos frequentemente consultados
- Foreign keys sem índices explícitos
- Campos de data sem índices

**Solução:**
```php
// Adicionar migration
Schema::table('service_orders', function (Blueprint $table) {
    $table->index('status');
    $table->index('priority');
    $table->index(['tenant_id', 'created_at']);
    $table->index(['person_id', 'status']);
});

Schema::table('accounts', function (Blueprint $table) {
    $table->index('status');
    $table->index('type');
    $table->index(['tenant_id', 'type', 'status']);
    $table->index('due_date');
});

Schema::table('products', function (Blueprint $table) {
    $table->index(['tenant_id', 'stock']);
    $table->index('sku');
    $table->index('barcode');
});
```

---

#### 2.5 Paginação de Resultados
**Status:** ✅ Implementado, mas inconsistente
**Impacto:** Médio

**Problema:**
- Alguns widgets carregam todos os registros (`->get()`)
- Falta paginação em algumas listagens

**Solução:**
```php
// Em vez de
$products = Product::all();

// Usar
$products = Product::paginate(50);

// Ou em widgets
Product::query()->limit(100)->get();
```

---

#### 2.6 Lazy Loading de Imagens
**Status:** ⚠️ Não implementado
**Impacto:** Médio - Carregamento lento de páginas com imagens

**Solução:**
- Implementar lazy loading nativo do browser
- Usar CDN para assets estáticos
- Comprimir imagens automaticamente

---

## 3. Experiência do Usuário (UX/UI)

### 🟡 Importante

#### 3.1 Feedback Visual
**Status:** ⚠️ Implementação básica
**Impacto:** Médio

**Melhorias:**
- ✅ Adicionar skeleton loaders nos widgets
- ✅ Loading states mais claros
- ✅ Confirmações de ações destrutivas
- ✅ Mensagens de sucesso mais descritivas

**Exemplo:**
```php
// No Resource
protected function getDeletedNotificationTitle(): ?string
{
    return 'Ordem de serviço #' . $this->record->number . ' excluída com sucesso';
}
```

---

#### 3.2 Busca Global
**Status:** ⚠️ Não implementado
**Impacto:** Médio

**Sugestão:**
- Implementar busca global no Filament
- Buscar em múltiplos recursos (clientes, produtos, OS)
- Atalho de teclado (Ctrl+K)

**Implementação:**
```php
// No PanelProvider
->globalSearch()
->globalSearchKeyBindings(['command+k', 'ctrl+k'])
```

---

#### 3.3 Atalhos de Teclado
**Status:** ⚠️ Não implementado
**Impacto:** Baixo - Melhora produtividade

**Sugestões:**
- `N` - Nova OS
- `Ctrl+S` - Salvar
- `/` - Buscar
- `Esc` - Fechar modal

---

#### 3.4 Tour Guiado (Onboarding)
**Status:** ⚠️ Não implementado
**Impacto:** Médio - Facilita adoção

**Sugestão:**
- Tour para novo usuário
- Explicar dashboard
- Guiar criação da primeira OS
- Tooltips contextuais

**Biblioteca sugerida:**
```bash
npm install driver.js
```

---

#### 3.5 Modo Escuro
**Status:** ✅ Parcialmente implementado
**Impacto:** Baixo

**Melhorias:**
- Testar todos os componentes no dark mode
- Garantir contraste adequado
- Salvar preferência do usuário

---

#### 3.6 Notificações em Tempo Real
**Status:** ⚠️ Não implementado
**Impacto:** Médio

**Sugestão:**
- Implementar Laravel Echo + Pusher/Soketi
- Notificar quando:
  - Nova OS atribuída
  - Pagamento recebido
  - Estoque baixo
  - Documento assinado

---

## 4. Testes e Qualidade

### 🔴 Crítico

#### 4.1 Cobertura de Testes
**Status:** ⚠️ Muito baixa ou inexistente
**Impacto:** Alto - Regressões não detectadas

**Problema:**
- Sem testes unitários
- Sem testes de integração
- Sem testes E2E

**Solução:**
```php
// Testes unitários (models)
test('service order calculates total correctly', function () {
    $serviceOrder = ServiceOrder::factory()->create();
    $serviceOrder->serviceOrderServices()->create([
        'quantity' => 2,
        'unit_price' => 100,
        'discount' => 10,
    ]);

    expect($serviceOrder->total_value)->toBe(190);
});

// Testes de feature (resources)
test('can create service order', function () {
    $user = User::factory()->create();
    $tenant = Tenant::factory()->create();

    actingAs($user)
        ->post(route('filament.app.resources.service-orders.store'), [
            'person_id' => Person::factory()->create()->id,
            'status' => 'draft',
            // ...
        ])
        ->assertSuccessful();
});

// Testes de browser (E2E)
test('can complete service order workflow', function () {
    $this->browse(function (Browser $browser) {
        $browser->loginAs(User::factory()->create())
                ->visit('/app/service-orders/create')
                ->type('number', '12345')
                ->select('status', 'in_progress')
                ->press('Salvar')
                ->assertSee('Ordem criada com sucesso');
    });
});
```

**Meta:**
- 80% de cobertura em models
- 60% em resources
- Testes E2E para fluxos críticos

---

#### 4.2 CI/CD Pipeline
**Status:** ⚠️ Não implementado
**Impacto:** Alto

**Sugestão:**
```yaml
# .github/workflows/tests.yml
name: Tests

on: [push, pull_request]

jobs:
  test:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v3
      - uses: shivammathur/setup-php@v2
        with:
          php-version: '8.2'
      - run: composer install
      - run: php artisan test
      - run: ./vendor/bin/phpstan analyse
      - run: ./vendor/bin/pint --test
```

---

## 5. Documentação

### 🟡 Importante

#### 5.1 README.md Completo
**Status:** ⚠️ Incompleto
**Impacto:** Médio

**O que incluir:**
- Setup inicial (requisitos, instalação)
- Variáveis de ambiente explicadas
- Comandos comuns
- Estrutura do projeto
- Guia de contribuição

---

#### 5.2 Documentação de API
**Status:** ⚠️ Não existe
**Impacto:** Alto se API for pública

**Sugestão:**
```bash
composer require darkaonline/l5-swagger
```

---

#### 5.3 Wiki Interna
**Status:** ⚠️ Não existe
**Impacto:** Médio

**Conteúdo sugerido:**
- Fluxo de desenvolvimento
- Padrões de código
- Arquitetura de decisões (ADRs)
- Troubleshooting comum

---

## 6. Funcionalidades Faltantes

### 🟡 Importante

#### 6.1 Relatórios Exportáveis
**Status:** ⚠️ Implementação básica
**Impacto:** Médio

**Faltam:**
- Relatório de OS por período
- Relatório financeiro consolidado
- Relatório de estoque valorizado
- Exportação em Excel/PDF

**Implementação:**
```php
use Filament\Actions\Exports\ExcelExport;

public function export(): BinaryFileResponse
{
    return Excel::download(new ServiceOrdersExport, 'os-' . now() . '.xlsx');
}
```

---

#### 6.2 Agendamento de Serviços
**Status:** ⚠️ Não implementado
**Impacto:** Alto - Feature importante para oficinas

**Sugestão:**
- Calendário de agendamentos
- Confirmação automática por email/SMS
- Lembretes
- Integração com Google Calendar

---

#### 6.3 Gestão de Comissões
**Status:** ⚠️ Não implementado
**Impacto:** Médio

**Sugestão:**
- Comissão por venda
- Comissão por OS
- Relatórios de comissão
- Pagamento de comissões

---

#### 6.4 WhatsApp Business API
**Status:** ⚠️ Não implementado
**Impacto:** Alto - Canal de comunicação importante

**Sugestão:**
- Notificações via WhatsApp
- Confirmação de agendamentos
- Status de OS
- Lembretes de pagamento

---

#### 6.5 Impressão de OS
**Status:** ⚠️ Não implementado
**Impacto:** Alto

**Sugestão:**
- Template de impressão
- QR Code para acompanhamento
- Versão para cliente/mecânico
- Termo de garantia

---

#### 6.6 Gestão de Orçamentos
**Status:** ⚠️ Não implementado
**Impacto:** Alto

**Sugestão:**
- Criar orçamento antes da OS
- Aprovar/Reprovar orçamento
- Converter orçamento em OS
- Validade do orçamento

---

#### 6.7 Portal do Cliente
**Status:** ⚠️ Não implementado
**Impacto:** Médio

**Sugestão:**
- Cliente visualiza suas OS
- Histórico de serviços
- Documentos assinados
- Faturas

---

#### 6.8 Checklist de Inspeção
**Status:** ⚠️ Não implementado
**Impacto:** Médio

**Sugestão:**
- Checklist personalizado por tipo de serviço
- Fotos antes/depois
- Assinatura do cliente

---

#### 6.9 Gestão de Garantias
**Status:** ⚠️ Parcial (apenas campo de prazo)
**Impacto:** Médio

**Melhorias:**
- Rastreamento de itens em garantia
- Alertas de vencimento
- Histórico de acionamentos

---

## 7. Integrações

### 🟡 Importante

#### 7.1 Mercado Pago
**Status:** ⚠️ Não implementado
**Impacto:** Alto - Alternativa ao Stripe no Brasil

**Sugestão:**
```bash
composer require mercadopago/dx-php
```

---

#### 7.2 SMS (Twilio/Zenvia)
**Status:** ⚠️ Não implementado
**Impacto:** Médio

**Uso:**
- Confirmações
- Lembretes
- 2FA via SMS

---

#### 7.3 Google Calendar
**Status:** ⚠️ Não implementado
**Impacto:** Médio

**Uso:**
- Sincronizar agendamentos
- Lembretes

---

#### 7.4 Nota Fiscal Eletrônica
**Status:** ⚠️ Não implementado
**Impacto:** Alto - Obrigatório para muitos negócios

**Sugestão:**
- Integração com eNotas, FocusNFe, ou similar
- Emissão automática

---

#### 7.5 Boleto Bancário
**Status:** ⚠️ Não implementado
**Impacto:** Médio

**Sugestão:**
- Integração com bancos
- Geração de boletos
- Webhook de pagamento

---

## 8. DevOps e Infraestrutura

### 🔴 Crítico

#### 8.1 Ambiente de Staging
**Status:** ⚠️ Não configurado
**Impacto:** Alto

**Sugestão:**
- Ambiente idêntico à produção
- Deploy automático de branches de feature
- Testes antes de produção

---

#### 8.2 Monitoramento de Erros
**Status:** ⚠️ Não implementado
**Impacto:** Alto

**Sugestão:**
```bash
composer require sentry/sentry-laravel
```

**Configuração:**
```php
// config/sentry.php
'dsn' => env('SENTRY_LARAVEL_DSN'),
'traces_sample_rate' => 0.2,
```

---

#### 8.3 Health Checks
**Status:** ⚠️ Não implementado
**Impacto:** Alto

**Sugestão:**
```php
// routes/web.php
Route::get('/health', function () {
    return response()->json([
        'status' => 'ok',
        'database' => DB::connection()->getPdo() ? 'connected' : 'disconnected',
        'cache' => Cache::has('health-check'),
        'queue' => Queue::size() < 1000,
    ]);
});
```

---

#### 8.4 CDN para Assets
**Status:** ⚠️ Não implementado
**Impacto:** Médio

**Sugestão:**
- Cloudflare ou AWS CloudFront
- Cache de imagens
- Compressão automática

---

### 🟡 Importante

#### 8.5 Docker para Desenvolvimento
**Status:** ⚠️ Não implementado
**Impacto:** Médio

**Sugestão:**
```yaml
# docker-compose.yml
version: '3.8'
services:
  app:
    build: .
    ports:
      - "8000:8000"
    volumes:
      - .:/var/www/html
    depends_on:
      - mysql
      - redis

  mysql:
    image: mysql:8.0
    environment:
      MYSQL_DATABASE: wsoft
      MYSQL_ROOT_PASSWORD: secret

  redis:
    image: redis:alpine
```

---

#### 8.6 Logs Centralizados
**Status:** ⚠️ Não implementado
**Impacto:** Médio

**Sugestão:**
- ELK Stack (Elasticsearch, Logstash, Kibana)
- Ou usar serviço como Papertrail, Loggly

---

## 9. Acessibilidade

### 🟡 Importante

#### 9.1 WCAG 2.1 Compliance
**Status:** ⚠️ Não verificado
**Impacto:** Médio

**Checklist:**
- ✅ Contraste de cores adequado
- ✅ Labels em todos os inputs
- ✅ Alt text em imagens
- ✅ Navegação por teclado
- ✅ Screen reader friendly

---

#### 9.2 Internacionalização (i18n)
**Status:** ⚠️ Não implementado
**Impacto:** Baixo (se apenas Brasil)

**Sugestão:**
- Preparar para múltiplos idiomas
- Datas e moedas localizadas
- Traduções completas

---

## 10. Arquitetura e Código

### 🟡 Importante

#### 10.1 Service Layer
**Status:** ⚠️ Não implementado
**Impacto:** Médio - Código nos controllers/resources

**Problema:**
- Lógica de negócio nos Resources
- Dificulta reuso
- Dificulta testes

**Solução:**
```php
// app/Services/ServiceOrderService.php
class ServiceOrderService
{
    public function create(array $data): ServiceOrder
    {
        return DB::transaction(function () use ($data) {
            $serviceOrder = ServiceOrder::create($data);
            $this->createServices($serviceOrder, $data['services']);
            $this->createProducts($serviceOrder, $data['products']);
            $this->calculateTotals($serviceOrder);

            return $serviceOrder;
        });
    }
}
```

---

#### 10.2 DTOs (Data Transfer Objects)
**Status:** ⚠️ Não implementado
**Impacto:** Baixo

**Sugestão:**
```php
class CreateServiceOrderDTO
{
    public function __construct(
        public readonly int $personId,
        public readonly string $status,
        public readonly array $services,
        public readonly array $products,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            personId: $request->input('person_id'),
            status: $request->input('status'),
            services: $request->input('services', []),
            products: $request->input('products', []),
        );
    }
}
```

---

#### 10.3 Enums para Constantes
**Status:** ✅ Parcialmente implementado
**Impacto:** Baixo

**Melhorias:**
- Converter strings mágicas em Enums
- Exemplo: status de OS, tipos de movimentação

---

#### 10.4 Query Scopes
**Status:** ⚠️ Pouco usado
**Impacto:** Baixo

**Sugestão:**
```php
// Em Product.php
public function scopeLowStock(Builder $query): void
{
    $query->whereNotNull('stock_alert')
          ->whereRaw('stock <= stock_alert');
}

// Uso
Product::lowStock()->get();
```

---

## 11. Monitoramento e Analytics

### 🟡 Importante

#### 11.1 Métricas de Negócio
**Status:** ⚠️ Não implementado
**Impacto:** Médio

**Sugestões:**
- MRR (Monthly Recurring Revenue)
- Churn rate
- CAC (Customer Acquisition Cost)
- LTV (Lifetime Value)
- NPS (Net Promoter Score)

---


## 12. Backup e Recuperação

### 🔴 Crítico

#### 12.1 Backup Automático
**Status:** ⚠️ Não configurado
**Impacto:** Crítico

**Sugestão:**
```bash
composer require spatie/laravel-backup
```

**Configuração:**
```php
// config/backup.php
'backup' => [
    'name' => env('APP_NAME', 'laravel-backup'),
    'source' => [
        'files' => [
            'include' => [
                base_path(),
            ],
            'exclude' => [
                base_path('vendor'),
                base_path('node_modules'),
            ],
        ],
        'databases' => ['mysql'],
    ],
    'destination' => [
        'disks' => ['s3'],
    ],
],
```

**Agendar:**
```php
// app/Console/Kernel.php
$schedule->command('backup:run')->daily()->at('01:00');
$schedule->command('backup:clean')->daily()->at('01:30');
```

---

#### 12.2 Disaster Recovery Plan
**Status:** ⚠️ Não documentado
**Impacto:** Alto

**Documentar:**
- RPO (Recovery Point Objective)
- RTO (Recovery Time Objective)
- Procedimento de restore
- Testes de recuperação

---

## Priorização Sugerida

### Sprint 1 (Crítico - Segurança)
1. ✅ Rate Limiting
2. ✅ Validação de Uploads
3. ✅ Sanitização de Inputs
4. ✅ Backup Automático

### Sprint 2 (Crítico - Performance)
1. ✅ N+1 Query Problems
2. ✅ Cache de Dados
3. ✅ Índices de Banco
4. ✅ Eager Loading

### Sprint 3 (Importante - Features)
1. ✅ Agendamento de Serviços
2. ✅ Impressão de OS
3. ✅ Gestão de Orçamentos
4. ✅ Relatórios Exportáveis

### Sprint 4 (Importante - DevOps)
1. ✅ Monitoramento de Erros (Sentry)
2. ✅ Health Checks
3. ✅ CI/CD Pipeline
4. ✅ Ambiente de Staging

### Sprint 5 (Importante - Integrações)
1. ✅ WhatsApp Business API
2. ✅ Mercado Pago
3. ✅ Nota Fiscal Eletrônica
4. ✅ Portal do Cliente

### Sprint 6 (Testes e Qualidade)
1. ✅ Testes Unitários (80% cobertura)
2. ✅ Testes de Integração
3. ✅ Testes E2E (fluxos críticos)
4. ✅ Documentação completa

---

## Conclusão

O projeto WSoft Technology é um SaaS robusto e bem arquitetado, mas precisa de melhorias em:

1. **Segurança** (rate limiting, validações)
2. **Performance** (N+1, cache, índices)
3. **Testes** (cobertura muito baixa)
4. **Features** (agendamento, impressão, orçamentos)
5. **DevOps** (monitoramento, backup)

**Estimativa de esforço total:** 6-8 sprints (3-4 meses com 1 desenvolvedor full-time)

**ROI esperado:**
- Redução de bugs em 60%
- Melhoria de performance em 50%
- Aumento de adoção de usuários em 40%
- Redução de churn em 30%

---

**Última atualização:** 2025-12-17
**Responsável pela análise:** Claude Code (Anthropic)
