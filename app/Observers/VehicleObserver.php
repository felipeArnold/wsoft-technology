<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Vehicle;
use App\Services\Onboarding\OnboardingService;
use Filament\Facades\Filament;

final class VehicleObserver
{
    public function __construct(
        private readonly OnboardingService $onboardingService
    ) {}

    /**
     * Handle the Vehicle "created" event.
     */
    public function created(Vehicle $vehicle): void
    {
        if (Filament::auth()->check()) {
            $user = Filament::auth()->user();
            $this->onboardingService->completeStep($user, 'create_vehicle');
        }
    }

    /**
     * Handle the Vehicle "updated" event.
     */
    public function updated(Vehicle $vehicle): void
    {
        //
    }

    /**
     * Handle the Vehicle "deleted" event.
     */
    public function deleted(Vehicle $vehicle): void
    {
        //
    }

    /**
     * Handle the Vehicle "restored" event.
     */
    public function restored(Vehicle $vehicle): void
    {
        //
    }

    /**
     * Handle the Vehicle "force deleted" event.
     */
    public function forceDeleted(Vehicle $vehicle): void
    {
        //
    }
}
