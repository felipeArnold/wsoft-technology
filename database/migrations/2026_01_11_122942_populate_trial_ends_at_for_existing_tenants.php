<?php

declare(strict_types=1);

use App\Models\Tenant;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Log;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Populate trial_ends_at for existing tenants that have subscriptions
     * but trial_ends_at is NULL.
     *
     * Logic:
     * 1. If subscription has trial_ends_at, use that value
     * 2. Otherwise, use tenant's created_at + 7 days
     */
    public function up(): void
    {
        // Get all tenants with subscriptions but NULL trial_ends_at
        $tenants = Tenant::whereHas('subscriptions')
            ->whereNull('trial_ends_at')
            ->get();

        Log::info('Populating trial_ends_at for existing tenants', [
            'total_tenants' => $tenants->count(),
        ]);

        foreach ($tenants as $tenant) {
            // Try to get trial_ends_at from subscription first
            $subscription = $tenant->subscriptions()
                ->whereNotNull('trial_ends_at')
                ->orderBy('created_at', 'asc')
                ->first();

            if ($subscription && $subscription->trial_ends_at) {
                // Use trial_ends_at from subscription
                $trialEndsAt = $subscription->trial_ends_at;
                $source = 'subscription';
            } else {
                // Calculate trial_ends_at as created_at + 7 days
                $trialEndsAt = $tenant->created_at->copy()->addDays(7);
                $source = 'calculated (created_at + 7 days)';
            }

            // Update tenant
            $tenant->update(['trial_ends_at' => $trialEndsAt]);

            Log::info('Updated tenant trial_ends_at', [
                'tenant_id' => $tenant->id,
                'tenant_name' => $tenant->name,
                'trial_ends_at' => $trialEndsAt->format('Y-m-d H:i:s'),
                'source' => $source,
            ]);
        }

        Log::info('Finished populating trial_ends_at', [
            'updated_tenants' => $tenants->count(),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * Note: We don't reverse this migration because trial_ends_at
     * might have been updated via webhooks after this migration ran.
     */
    public function down(): void
    {
        // Do nothing - data migration is not reversible
        Log::warning('Skipping down() for populate_trial_ends_at migration - data migration is not reversible');
    }
};
