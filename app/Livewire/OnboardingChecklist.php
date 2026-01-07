<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Services\Onboarding\OnboardingService;
use Exception;
use Filament\Facades\Filament;
use Livewire\Attributes\On;
use Livewire\Component;

final class OnboardingChecklist extends Component
{
    public array $progress = [];

    public bool $dismissed = false;

    public string $userName = '';

    public bool $linkCopied = false;

    public function mount(OnboardingService $onboardingService): void
    {
        $user = Filament::auth()->user();
        $this->userName = $user ? $user->name : '';
        $this->loadProgress($onboardingService);
        $this->checkDismissed();
    }

    #[On('refresh-onboarding')]
    public function refresh(OnboardingService $onboardingService): void
    {
        $this->loadProgress($onboardingService);
    }

    public function dismiss(): void
    {
        $user = Filament::auth()->user();
        session()->put('onboarding_dismissed_'.$user->id, true);
        $this->dismissed = true;
    }

    public function notifyLinkCopied(): void
    {
        $this->linkCopied = true;

        // Reset após 3 segundos
        $this->dispatch('reset-link-copied');
    }

    public function render()
    {
        return view('livewire.onboarding-checklist');
    }

    private function loadProgress(OnboardingService $onboardingService): void
    {
        $user = Filament::auth()->user();

        if (! $user) {
            $this->progress = [
                'steps' => [],
                'completed' => 0,
                'total' => 0,
                'percentage' => 0,
                'is_completed' => false,
            ];

            return;
        }

        $this->progress = $onboardingService->getProgress($user);

        // Gerar URLs para cada step com o tenant correto
        foreach ($this->progress['steps'] as &$step) {
            $step['action_url'] = $this->generateActionUrl($step);
        }
    }

    private function generateActionUrl(array $step): ?string
    {
        try {
            if ($step['resource'] && $step['action']) {
                return $step['resource']::getUrl($step['action']);
            }
            if ($step['action'] === 'dashboard') {
                return Filament::getUrl();
            }
        } catch (Exception $e) {
            // Se falhar, retorna null
        }

        return null;
    }

    private function checkDismissed(): void
    {
        $user = Filament::auth()->user();

        if (! $user) {
            $this->dismissed = true;

            return;
        }

        $this->dismissed = $this->progress['is_completed'] ||
                          session()->get('onboarding_dismissed_'.$user->id, false);
    }
}
