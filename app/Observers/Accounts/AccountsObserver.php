<?php

declare(strict_types=1);

namespace App\Observers\Accounts;

use App\Models\Accounts\Accounts;
use App\Services\Onboarding\OnboardingService;

final class AccountsObserver
{
    public function __construct(
        private readonly OnboardingService $onboardingService
    ) {}

    /**
     * Handle the Accounts "created" event.
     */
    public function created(Accounts $accounts): void
    {
        // Mark onboarding step for the account owner when payment is registered
        if ($accounts->paid_at && $accounts->user) {
            $this->onboardingService->completeStep($accounts->user, 'register_payment');
        }
    }

    /**
     * Handle the Accounts "updated" event.
     */
    public function updated(Accounts $accounts): void
    {
        // Mark onboarding step when status is set to paid for the account owner
        if ($accounts->wasChanged('status') && $accounts->status === 'paid' && $accounts->user) {
            $this->onboardingService->completeStep($accounts->user, 'register_payment');
        }
    }

    /**
     * Handle the Accounts "deleted" event.
     */
    public function deleted(Accounts $accounts): void
    {
        //
    }

    /**
     * Handle the Accounts "restored" event.
     */
    public function restored(Accounts $accounts): void
    {
        //
    }

    /**
     * Handle the Accounts "force deleted" event.
     */
    public function forceDeleted(Accounts $accounts): void
    {
        //
    }
}
