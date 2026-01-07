<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Services\Onboarding\OnboardingService;
use Filament\Facades\Filament;
use Filament\Widgets\Widget;

final class OnboardingWidget extends Widget
{
    protected string $view = 'filament.widgets.onboarding-widget';

    protected int|string|array $columnSpan = 'full';

    protected static ?int $sort = -10;

    public static function canView(): bool
    {
        return true;
    }

    public function mount(): void
    {
        if (Filament::auth()->check()) {
            $user = Filament::auth()->user();
            $onboardingService = app(OnboardingService::class);
            $onboardingService->completeStep($user, 'view_dashboard');
        }
    }
}
