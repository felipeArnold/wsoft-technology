# Configuração de Webhook do Stripe

## URL do Webhook

Configure esta URL no Stripe Dashboard:

```
https://seu-dominio.com/stripe/webhook
```

## Eventos para Monitorar

Configure os seguintes eventos no Stripe Dashboard para que sejam enviados ao seu webhook:

### Eventos de Assinatura (Subscription)
- `customer.subscription.created` - Quando uma assinatura é criada
- `customer.subscription.updated` - Quando uma assinatura é atualizada (mudança de status, plano, etc)
- `customer.subscription.deleted` - Quando uma assinatura é cancelada
- `customer.subscription.trial_will_end` - 3 dias antes do trial acabar

### Eventos de Pagamento (Invoice)
- `invoice.payment_succeeded` - Quando um pagamento é bem-sucedido
- `invoice.payment_failed` - Quando um pagamento falha
- `invoice.created` - Quando uma invoice é criada
- `invoice.finalized` - Quando uma invoice é finalizada

### Eventos de Cliente (Customer)
- `customer.updated` - Quando dados do cliente são atualizados
- `customer.deleted` - Quando um cliente é deletado

### Eventos de Método de Pagamento
- `payment_method.attached` - Quando um método de pagamento é anexado
- `payment_method.detached` - Quando um método de pagamento é removido
- `payment_method.updated` - Quando um método de pagamento é atualizado

### Eventos de Checkout
- `checkout.session.completed` - Quando uma sessão de checkout é completada
- `checkout.session.expired` - Quando uma sessão de checkout expira

## Como Testar Localmente

### 1. Instalar Stripe CLI

```bash
# macOS
brew install stripe/stripe-cli/stripe

# Ou baixe de: https://stripe.com/docs/stripe-cli
```

### 2. Fazer Login

```bash
stripe login
```

### 3. Encaminhar Webhooks para seu Local

```bash
stripe listen --forward-to http://localhost/stripe/webhook
```

Isso irá mostrar o webhook secret. Copie e adicione ao seu `.env`:

```env
STRIPE_WEBHOOK_SECRET=whsec_...
```

### 4. Testar Eventos Específicos

```bash
# Testar criação de assinatura
stripe trigger customer.subscription.created

# Testar atualização de assinatura
stripe trigger customer.subscription.updated

# Testar pagamento bem-sucedido
stripe trigger invoice.payment_succeeded

# Testar pagamento falho
stripe trigger invoice.payment_failed
```

## Verificar Logs

Os eventos do webhook são registrados automaticamente. Para visualizar:

```bash
# Ver logs em tempo real
tail -f storage/logs/laravel.log

# Ou use o Telescope (se instalado)
php artisan telescope:install
```

## Atualização Automática do Banco de Dados

O Laravel Cashier **automaticamente** atualiza as seguintes tabelas quando recebe webhooks:

- `customers` - Dados do cliente Stripe (criado via trait Billable no model Tenant)
- `subscriptions` - Status, datas e informações da assinatura
- `subscription_items` - Itens/produtos da assinatura

### Campos Atualizados Automaticamente

**Tabela: `subscriptions`**
- `stripe_id` - ID da assinatura no Stripe
- `stripe_status` - Status (trialing, active, past_due, canceled, etc)
- `stripe_price` - ID do preço/plano
- `quantity` - Quantidade
- `trial_ends_at` - Data de término do trial
- `ends_at` - Data de cancelamento (se agendado)
- `created_at` / `updated_at`

## Lógica Customizada

Você pode adicionar lógica customizada nos métodos do controller:

```php
// app/Http/Controllers/Stripe/StripeWebhookController.php

protected function handleCustomerSubscriptionCreated(array $payload): void
{
    $subscription = $payload['data']['object'];

    // Seu código customizado aqui
    // Exemplo: Enviar email de boas-vindas
    // Exemplo: Ativar recursos premium
    // Exemplo: Notificar admin
}
```

## Segurança

✅ **Verificação de Assinatura**: Automática via `STRIPE_WEBHOOK_SECRET`
✅ **Exclusão CSRF**: Já configurada em `bootstrap/app.php`
✅ **Validação de Origem**: Cashier verifica se o evento veio do Stripe

## Monitoramento

Verifique o dashboard do Stripe para ver:
- Webhooks enviados
- Respostas recebidas
- Tentativas de reenvio (em caso de falha)

Dashboard: https://dashboard.stripe.com/webhooks

## Estrutura do Payload

Exemplo de payload recebido (customer.subscription.updated):

```json
{
  "id": "evt_xxx",
  "type": "customer.subscription.updated",
  "data": {
    "object": {
      "id": "sub_xxx",
      "customer": "cus_xxx",
      "status": "active",
      "items": {
        "data": [{
          "price": {
            "id": "price_xxx",
            "product": "prod_xxx",
            "unit_amount": 2990
          },
          "quantity": 1
        }]
      },
      "trial_end": 1234567890,
      "current_period_end": 1234567890,
      "current_period_start": 1234567890
    },
    "previous_attributes": {
      "status": "trialing"
    }
  }
}
```

## Troubleshooting

### Webhook não está sendo recebido

1. Verifique se a URL está correta no Stripe Dashboard
2. Verifique se o servidor está acessível publicamente
3. Verifique os logs: `storage/logs/laravel.log`
4. Teste com Stripe CLI: `stripe listen --forward-to http://localhost/stripe/webhook`

### Erro de verificação de assinatura

1. Verifique se `STRIPE_WEBHOOK_SECRET` está correto no `.env`
2. Limpe o cache de config: `php artisan config:clear`

### Dados não estão sendo atualizados

1. Verifique se o model Tenant usa o trait `Billable`
2. Verifique se as migrations do Cashier foram executadas
3. Verifique os logs para erros
