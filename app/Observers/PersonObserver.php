<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Person\Person;
use App\Services\Onboarding\OnboardingService;
use Filament\Facades\Filament;

final class PersonObserver
{
    public function __construct(
        private readonly OnboardingService $onboardingService
    ) {}

    /**
     * Handle the Person "created" event.
     */
    public function created(Person $person): void
    {
        if ($person->is_client && Filament::auth()->check()) {
            $user = Filament::auth()->user();
            $this->onboardingService->completeStep($user, 'create_client');
        }
    }

    /**
     * Handle the Person "updated" event.
     */
    public function updated(Person $person): void
    {
        //
    }

    /**
     * Handle the Person "deleted" event.
     */
    public function deleted(Person $person): void
    {
        //
    }

    /**
     * Handle the Person "restored" event.
     */
    public function restored(Person $person): void
    {
        //
    }

    /**
     * Handle the Person "force deleted" event.
     */
    public function forceDeleted(Person $person): void
    {
        //
    }
}
