<?php

declare(strict_types=1);

namespace App\Services\Payment;

use App\Models\Tenant;
use InvalidArgumentException;
use Log;

abstract class AbstractPaymentProvider implements PaymentProviderInterface
{
    protected array $config;

    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    abstract public function createCheckoutSession(Tenant $tenant, string $priceId, array $options = []): array;

    abstract public function createBillingPortalSession(Tenant $tenant, string $returnUrl): array;

    abstract public function cancelSubscription(Tenant $tenant, string $subscriptionId): bool;

    abstract public function resumeSubscription(Tenant $tenant, string $subscriptionId): bool;

    abstract public function getSubscription(string $subscriptionId): array;

    abstract public function getPlans(): array;

    abstract public function updatePaymentMethod(Tenant $tenant, string $paymentMethodId): bool;

    abstract public function verifyWebhookSignature(string $payload, string $signature, string $secret): bool;

    abstract public function handleWebhook(array $payload): void;

    /**
     * Get configuration value
     */
    protected function getConfig(string $key, mixed $default = null): mixed
    {
        return $this->config[$key] ?? $default;
    }

    /**
     * Log payment activity
     */
    protected function logActivity(string $action, array $data = []): void
    {
        Log::info("Payment Provider: {$action}", array_merge([
            'provider' => static::class,
            'timestamp' => now(),
        ], $data));
    }

    /**
     * Validate tenant
     *
     * @throws InvalidArgumentException
     */
    protected function validateTenant(Tenant $tenant): void
    {
        if (! $tenant->exists) {
            throw new InvalidArgumentException('Tenant must exist in database');
        }
    }

    /**
     * Format money amount to cents
     */
    protected function formatMoney(float $amount): int
    {
        return (int) round($amount * 100);
    }

    /**
     * Format money amount from cents to decimal
     */
    protected function formatMoneyFromCents(int $cents): float
    {
        return $cents / 100;
    }
}
