<?php

declare(strict_types=1);

namespace App\Services\Onboarding;

use App\Filament\Resources\Creates\People\PersonResource;
use App\Filament\Resources\Creates\Vehicles\VehicleResource;
use App\Filament\Resources\Financial\AccountsReceivables\AccountsReceivableResource;
use App\Filament\Resources\Services\ServiceOrders\ServiceOrderResource;
use App\Models\User;
use App\Models\UserOnboardingStep;
use Filament\Facades\Filament;

final class OnboardingService
{
    public const STEPS = [
        'create_client' => [
            'order' => 1,
            'title' => 'Cadastrar um cliente',
            'description' => 'Cadastre um cliente para começar a abrir ordens de serviço.',
            'mandatory' => true,
            'resource' => PersonResource::class,
            'action' => 'create',
            'button_label' => 'Cadastrar Cliente',
            'show_condition' => null,
        ],
        'create_vehicle' => [
            'order' => 2,
            'title' => 'Cadastrar um veículo',
            'description' => 'O veículo é essencial para manter o histórico de serviços.',
            'mandatory' => true,
            'resource' => VehicleResource::class,
            'action' => 'index',
            'button_label' => 'Ir para Veículos',
            'show_condition' => 'isAutomotive',
        ],
        'create_os' => [
            'order' => 3,
            'title' => 'Criar a primeira Ordem de Serviço',
            'description' => 'Registre um serviço e organize sua oficina sem papel.',
            'mandatory' => true,
            'resource' => ServiceOrderResource::class,
            'action' => 'create',
            'button_label' => 'Criar Ordem de Serviço',
            'show_condition' => null,
        ],
        'finalize_os' => [
            'order' => 4,
            'title' => 'Finalizar a OS',
            'description' => 'Finalize a OS para liberar o financeiro.',
            'mandatory' => true,
            'resource' => ServiceOrderResource::class,
            'action' => 'index',
            'button_label' => 'Ver Ordens de Serviço',
            'show_condition' => null,
        ],
        'register_payment' => [
            'order' => 5,
            'title' => 'Registrar o pagamento',
            'description' => 'Registre o pagamento e veja seu caixa atualizado.',
            'mandatory' => true,
            'resource' => AccountsReceivableResource::class,
            'action' => 'create',
            'button_label' => 'Registrar Pagamento',
            'show_condition' => null,
        ],
        'view_dashboard' => [
            'order' => 6,
            'title' => 'Ver resumo financeiro',
            'description' => 'Aqui você acompanha o dinheiro da sua oficina.',
            'mandatory' => true,
            'resource' => null,
            'action' => 'dashboard',
            'button_label' => 'Ver Dashboard',
            'show_condition' => null,
        ],
    ];

    public const OPTIONAL_STEPS = [
        'create_product' => [
            'title' => 'Cadastrar produtos / peças',
            'mandatory' => false,
        ],
        'create_supplier' => [
            'title' => 'Cadastrar fornecedor',
            'mandatory' => false,
        ],
        'send_whatsapp' => [
            'title' => 'Enviar OS por WhatsApp',
            'mandatory' => false,
        ],
    ];

    /**
     * Get the list of step IDs that are required for account activation.
     *
     * @return array<string>
     */
    public static function getActivationRequiredStepIds(): array
    {
        // These are the critical steps that must be completed for activation
        return ['create_os', 'register_payment', 'view_dashboard'];
    }

    /**
     * Get all mandatory step IDs (steps with mandatory = true).
     *
     * @return array<string>
     */
    public static function getMandatoryStepIds(): array
    {
        return array_keys(array_filter(self::STEPS, fn ($step) => $step['mandatory'] ?? false));
    }

    public function completeStep(User $user, string $stepId): void
    {
        if (! $this->isValidStep($stepId)) {
            return;
        }

        $step = UserOnboardingStep::firstOrCreate(
            [
                'user_id' => $user->id,
                'step_id' => $stepId,
            ],
            [
                'completed' => false,
            ]
        );

        if (! $step->completed) {
            $step->markAsCompleted();
        }

        $user->checkAndActivate();
    }

    public function initializeSteps(User $user): void
    {
        foreach (array_keys(self::STEPS) as $stepId) {
            $stepData = self::STEPS[$stepId];

            // Verifica se o step deve ser mostrado
            if (! $this->shouldShowStep($stepData)) {
                continue;
            }

            UserOnboardingStep::firstOrCreate([
                'user_id' => $user->id,
                'step_id' => $stepId,
            ]);
        }
    }

    public function getProgress(User $user): array
    {
        $steps = [];
        $completed = 0;
        $total = 0;

        foreach (self::STEPS as $stepId => $stepData) {
            // Verifica se o step deve ser mostrado
            if (! $this->shouldShowStep($stepData)) {
                continue;
            }

            $total++;

            $stepRecord = UserOnboardingStep::where('user_id', $user->id)
                ->where('step_id', $stepId)
                ->first();

            $isCompleted = $stepRecord?->completed ?? false;

            if ($isCompleted) {
                $completed++;
            }

            $steps[] = [
                'id' => $stepId,
                'title' => $stepData['title'],
                'description' => $stepData['description'],
                'order' => $stepData['order'],
                'completed' => $isCompleted,
                'completed_at' => $stepRecord?->completed_at,
                'button_label' => $stepData['button_label'] ?? null,
                'resource' => $stepData['resource'] ?? null,
                'action' => $stepData['action'] ?? null,
            ];
        }

        return [
            'steps' => $steps,
            'completed' => $completed,
            'total' => $total,
            'percentage' => $total > 0 ? round(($completed / $total) * 100, 2) : 0,
            'is_completed' => $completed === $total,
        ];
    }

    private function shouldShowStep(array $stepData): bool
    {
        $condition = $stepData['show_condition'] ?? null;

        // Se não tem condição, sempre mostra
        if ($condition === null) {
            return true;
        }

        $tenant = Filament::getTenant();

        // Se não tem tenant, não mostra steps condicionais
        if ($tenant === null) {
            return false;
        }

        // Verifica a condição
        return match ($condition) {
            'isAutomotive' => $tenant->type->isAutomotive(),
            default => true,
        };
    }

    private function isValidStep(string $stepId): bool
    {
        return isset(self::STEPS[$stepId]) || isset(self::OPTIONAL_STEPS[$stepId]);
    }
}
