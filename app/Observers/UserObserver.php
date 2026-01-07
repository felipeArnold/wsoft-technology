<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Tenant;
use App\Models\User;
use App\Services\Onboarding\OnboardingService;

final class UserObserver
{
    public function __construct(
        private readonly OnboardingService $onboardingService
    ) {}

    public function creating($user)
    {
        unset($user['password_confirmation']);

        Tenant::creating(function ($tenant) use ($user): void {
            $tenant->users()->attach($user);
        });
    }

    public function created(User $user): void
    {
        $this->onboardingService->initializeSteps($user);
    }
}
