<?php

declare(strict_types=1);

namespace App\Observers\Accounts;

use App\Enum\AccountsReceivable\PaymentStatusEnum;
use App\Models\Accounts\AccountsInstallments;
use App\Services\Onboarding\OnboardingService;
use Filament\Facades\Filament;

final class AccountsInstallmentsObserver
{
    public function __construct(
        private readonly OnboardingService $onboardingService
    ) {}

    public function creating(AccountsInstallments $installments): void
    {
        if (auth()->check()) {
            $installments->tenant_id = Filament::getTenant()->id;
        }

    }

    public function updated(AccountsInstallments $installments): void
    {
        // Mark onboarding step when installment status is set to paid
        if ($installments->wasChanged('status') && $installments->status === PaymentStatusEnum::PAID) {
            $user = $installments->accounts?->user;
            if ($user) {
                $this->onboardingService->completeStep($user, 'register_payment');
            }
        }
    }
}
