<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Tenant;
use App\Models\User;
use App\Notifications\IncompleteRegistrationNotification;
use App\Notifications\TrialEndingSoonNotification;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

final class SendTrialNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trial:notify
                            {--days=3 : Número de dias antes do fim do trial para notificar}
                            {--registration-days=3 : Número de dias após registro sem tenant para notificar}
                            {--dry-run : Simular execução sem enviar notificações}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envia notificações para empresas em trial e usuários com cadastro incompleto';

    public function handle(): int
    {
        $dryRun = $this->option('dry-run');
        $daysBeforeTrialEnd = (int) $this->option('days');
        $registrationDays = (int) $this->option('registration-days');

        $this->info('🚀 Iniciando envio de notificações de trial...');

        if ($dryRun) {
            $this->warn('⚠️  Modo DRY-RUN ativado - Nenhuma notificação será enviada');
        }

        $this->newLine();

        // Processar empresas em trial
        $tenantsNotified = $this->notifyTrialEndingTenants($daysBeforeTrialEnd, $dryRun);

        $this->newLine();

        // Processar usuários sem cadastro completo
        $usersNotified = $this->notifyIncompleteRegistrations($registrationDays, $dryRun);

        $this->newLine();
        $this->info('✅ Processo concluído!');
        $this->line("   📊 Empresas notificadas: {$tenantsNotified}");
        $this->line("   👤 Usuários notificados: {$usersNotified}");
        $this->line('   📧 Total de notificações: '.($tenantsNotified + $usersNotified));

        return Command::SUCCESS;
    }

    /**
     * Notifica empresas cujo trial está acabando
     */
    private function notifyTrialEndingTenants(int $daysBeforeEnd, bool $dryRun): int
    {
        $this->info("🏢 Processando empresas em trial (faltando {$daysBeforeEnd} dias ou menos)...");

        // Busca empresas com subscriptions em trial que estão acabando
        $tenants = Tenant::whereHas('subscriptions', function ($query) use ($daysBeforeEnd): void {
            $query->whereNotNull('trial_ends_at')
                ->where('trial_ends_at', '>', now())
                ->where('trial_ends_at', '<=', now()->addDays($daysBeforeEnd))
                ->where('stripe_status', 'trialing');
        })->with(['subscriptions' => function ($query) use ($daysBeforeEnd): void {
            $query->whereNotNull('trial_ends_at')
                ->where('trial_ends_at', '>', now())
                ->where('trial_ends_at', '<=', now()->addDays($daysBeforeEnd))
                ->where('stripe_status', 'trialing');
        }, 'users'])->get();

        $count = 0;

        foreach ($tenants as $tenant) {
            $subscription = $tenant->subscriptions->first();

            if (! $subscription) {
                continue;
            }

            $daysRemaining = now()->diffInDays($subscription->trial_ends_at, false);

            $this->line("   📌 {$tenant->name} - Trial expira em {$daysRemaining} dias");

            // Envia notificação para todos os membros da empresa
            foreach ($tenant->users as $user) {
                if ($dryRun) {
                    $this->line("      [DRY-RUN] Notificaria: {$user->email}");
                } else {
                    try {
                        $user->notify(new TrialEndingSoonNotification($tenant, $subscription));
                        $this->line("      ✓ Notificado: {$user->email}");
                        $count++;
                    } catch (Exception $e) {
                        $this->error("      ✗ Erro ao notificar {$user->email}: {$e->getMessage()}");
                        Log::error('Erro ao enviar notificação de trial', [
                            'user_id' => $user->id,
                            'tenant_id' => $tenant->id,
                            'error' => $e->getMessage(),
                        ]);
                    }
                }
            }
        }

        if ($tenants->isEmpty()) {
            $this->line('   ℹ️  Nenhuma empresa encontrada');
        }

        return $count;
    }

    /**
     * Notifica usuários que não completaram o cadastro
     */
    private function notifyIncompleteRegistrations(int $daysAfterRegistration, bool $dryRun): int
    {
        $this->info("👤 Processando usuários com cadastro incompleto ({$daysAfterRegistration} dias após registro)...");

        // Busca usuários sem tenant associado que foram criados há X dias
        $users = User::doesntHave('tenants')
            ->whereBetween('created_at', [
                now()->subDays($daysAfterRegistration + 7), // até 7 dias a mais
                now()->subDays($daysAfterRegistration),
            ])
            ->get();

        $count = 0;

        foreach ($users as $user) {
            $daysRegistered = now()->diffInDays($user->created_at);

            $this->line("   📌 {$user->name} ({$user->email}) - Registrado há {$daysRegistered} dias");

            if ($dryRun) {
                $this->line("      [DRY-RUN] Notificaria: {$user->email}");
            } else {
                try {
                    $user->notify(new IncompleteRegistrationNotification($user));
                    $this->line("      ✓ Notificado: {$user->email}");
                    $count++;
                } catch (Exception $e) {
                    $this->error("      ✗ Erro ao notificar {$user->email}: {$e->getMessage()}");
                    Log::error('Erro ao enviar notificação de cadastro incompleto', [
                        'user_id' => $user->id,
                        'error' => $e->getMessage(),
                    ]);
                }
            }
        }

        if ($users->isEmpty()) {
            $this->line('   ℹ️  Nenhum usuário encontrado');
        }

        return $count;
    }
}
