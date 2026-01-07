<?php

declare(strict_types=1);

namespace App\Observers;

use App\Enum\Commission\CommissionStatusEnum;
use App\Enum\ServiceOrderStatus;
use App\Helpers\FormatterHelper;
use App\Models\Commission;
use App\Models\ServiceOrder;
use App\Notifications\AppointmentConfirmationNotification;
use App\Services\Onboarding\OnboardingService;
use Exception;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

final class ServiceOrderObserver
{
    public function __construct(
        private readonly OnboardingService $onboardingService
    ) {}

    public function creating(ServiceOrder $serviceOrder)
    {
        // Generate order number based on current month
        $prefix = '#OS-'.now()->format('Y-m').'-';

        $prefix = Str::replace('##', '#', $prefix);

        // Get the last order number for the current month
        $lastOrder = ServiceOrder::query()
            ->where('number', 'like', $prefix.'%')
            ->orderBy('number', 'desc')
            ->value('number');

        if ($lastOrder) {
            // Extract the sequential number from the last order
            $lastNumber = (int) mb_substr($lastOrder, -3);
            $nextNumber = $lastNumber + 1;
        } else {
            // First order of the month
            $nextNumber = 1;
        }

        $serviceOrder->number = $prefix.Str::padLeft($nextNumber, 3, '0');

        $values = [
            FormatterHelper::toDecimal($serviceOrder->labor_value),
            FormatterHelper::toDecimal($serviceOrder->parts_value),
        ];

        $serviceOrder->total_value = FormatterHelper::toDecimal(array_sum($values));
    }

    /**
     * Handle the ServiceOrder "created" event.
     * Send appointment confirmation email if scheduled
     */
    public function created(ServiceOrder $serviceOrder): void
    {
        // Mark onboarding step
        if (Filament::auth()->check()) {
            $user = Filament::auth()->user();
            $this->onboardingService->completeStep($user, 'create_os');
        }

        // Send appointment confirmation email if appointment is scheduled
        if ($serviceOrder->hasScheduledAppointment() &&
            ! $serviceOrder->appointment_confirmation_sent_at) {

            // Queue notification for customer
            if ($serviceOrder->person && $serviceOrder->person->email) {
                try {
                    $serviceOrder->person->notify(
                        new AppointmentConfirmationNotification($serviceOrder)
                    );

                    $serviceOrder->appointment_confirmation_sent_at = now();
                    $serviceOrder->appointment_confirmed = true;
                    $serviceOrder->saveQuietly();

                    Log::info('Appointment confirmation sent', [
                        'service_order_id' => $serviceOrder->id,
                        'person_email' => $serviceOrder->person->email,
                        'scheduled_for' => $serviceOrder->scheduled_start_at->toIso8601String(),
                    ]);
                } catch (Exception $e) {
                    Log::error('Failed to send appointment confirmation', [
                        'service_order_id' => $serviceOrder->id,
                        'error' => $e->getMessage(),
                    ]);
                }
            }
        }
    }

    public function updated(ServiceOrder $serviceOrder): void
    {
        // Set completed_at timestamp when status changes to completed
        if ($serviceOrder->wasChanged('status') &&
            $serviceOrder->status === ServiceOrderStatus::COMPLETED &&
            ! $serviceOrder->completed_at
        ) {
            $serviceOrder->completed_at = now();
            $serviceOrder->saveQuietly();

            // Mark onboarding step when OS is finalized
            if (Filament::auth()->check()) {
                $user = Filament::auth()->user();
                $this->onboardingService->completeStep($user, 'finalize_os');
            }
        }

        // Generate commission when status changes to completed
        if ($serviceOrder->wasChanged('status') &&
            $serviceOrder->status === ServiceOrderStatus::COMPLETED &&
            ! $serviceOrder->hasCommission() &&
            $serviceOrder->labor_value > 0 &&
            $serviceOrder->assigned_user_id
        ) {
            $this->generateCommission($serviceOrder);
        }

        // Resend confirmation if appointment datetime changed
        if ($serviceOrder->wasChanged('scheduled_start_at') &&
            $serviceOrder->hasScheduledAppointment() &&
            $serviceOrder->person &&
            $serviceOrder->person->email) {

            try {
                $serviceOrder->person->notify(
                    new AppointmentConfirmationNotification($serviceOrder, true)
                );

                $serviceOrder->appointment_confirmation_sent_at = now();
                $serviceOrder->appointment_reminder_sent_at = null; // Reset reminder
                $serviceOrder->saveQuietly();

                Log::info('Appointment reschedule confirmation sent', [
                    'service_order_id' => $serviceOrder->id,
                    'old_time' => $serviceOrder->getOriginal('scheduled_start_at'),
                    'new_time' => $serviceOrder->scheduled_start_at->toIso8601String(),
                ]);
            } catch (Exception $e) {
                Log::error('Failed to send reschedule confirmation', [
                    'service_order_id' => $serviceOrder->id,
                    'error' => $e->getMessage(),
                ]);
            }
        }
    }

    private function generateCommission(ServiceOrder $serviceOrder): void
    {
        $user = $serviceOrder->userAssigned;

        if (! $user || $user->commission_percentage <= 0) {
            return;
        }

        Commission::query()->create([
            'tenant_id' => $serviceOrder->tenant_id,
            'user_id' => $serviceOrder->assigned_user_id,
            'service_order_id' => $serviceOrder->id,
            'commission_percentage' => $user->commission_percentage,
            'labor_value_base' => $serviceOrder->labor_value,
            'commission_amount' => ($serviceOrder->labor_value * $user->commission_percentage) / 100,
            'status' => CommissionStatusEnum::PENDING,
        ]);
    }
}
