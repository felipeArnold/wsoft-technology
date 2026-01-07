<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Accounts\Accounts;
use App\Services\Onboarding\OnboardingService;
use Filament\Facades\Filament;

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
        if ($accounts->paid_at && Filament::auth()->check()) {
            $user = Filament::auth()->user();
            $this->onboardingService->completeStep($user, 'register_payment');
        }
    }

    /**
     * Handle the Accounts "updated" event.
     */
    public function updated(Accounts $accounts): void
    {
        if ($accounts->wasChanged('paid_at') && $accounts->paid_at && Filament::auth()->check()) {
            $user = Filament::auth()->user();
            $this->onboardingService->completeStep($user, 'register_payment');
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
