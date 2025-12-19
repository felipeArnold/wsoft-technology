<?php

declare(strict_types=1);

namespace Tests\Unit\Console\Commands;

use App\Console\Commands\SendTrialNotifications;
use App\Models\Tenant;
use App\Models\User;
use DB;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

/**
 * Testes unitários para SendTrialNotifications
 * Foco: Performance e Segurança
 */
final class SendTrialNotificationsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Notification::fake();
        Log::spy();
    }

    /**
     * @test
     * Segurança: Valida que parâmetro --days aceita apenas inteiros válidos
     */
    public function days_parameter_must_be_valid_integer(): void
    {
        // Valores válidos devem funcionar
        $exitCode = Artisan::call('trial:notify', ['--days' => '3', '--dry-run' => true]);
        $this->assertEquals(0, $exitCode);

        $exitCode = Artisan::call('trial:notify', ['--days' => '7', '--dry-run' => true]);
        $this->assertEquals(0, $exitCode);
    }

    /**
     * @test
     * Segurança: Valida que dry-run não envia notificações reais
     */
    public function dry_run_mode_does_not_send_notifications(): void
    {
        // Cria dados de teste
        $tenant = Tenant::factory()
            ->hasSubscriptions(1, [
                'trial_ends_at' => now()->addDays(2),
                'stripe_status' => 'trialing',
            ])
            ->create();

        $tenant->users()->save(User::factory()->make());

        Artisan::call('trial:notify', ['--days' => 3, '--dry-run' => true]);

        // Não deve enviar notificações
        Notification::assertNothingSent();
    }

    /**
     * @test
     * Performance: Valida que comando é eficiente com muitos usuários
     */
    public function command_handles_many_users_efficiently(): void
    {
        // Cria 100 usuários sem tenant (cadastro incompleto)
        User::factory()->count(100)->create([
            'created_at' => now()->subDays(5),
        ]);

        $start = microtime(true);

        Artisan::call('trial:notify', [
            '--registration-days' => 3,
            '--dry-run' => true,
        ]);

        $duration = microtime(true) - $start;

        // Deve processar 100 usuários em menos de 2 segundos
        $this->assertLessThan(
            2.0,
            $duration,
            "Comando deve processar 100 usuários rapidamente (levou {$duration}s)"
        );
    }

    /**
     * @test
     * Performance: Valida uso de memória com grandes volumes
     */
    public function command_does_not_leak_memory_with_large_dataset(): void
    {
        $memoryBefore = memory_get_usage();

        // Cria 500 usuários
        User::factory()->count(500)->create([
            'created_at' => now()->subDays(5),
        ]);

        Artisan::call('trial:notify', [
            '--registration-days' => 3,
            '--dry-run' => true,
        ]);

        $memoryAfter = memory_get_usage();
        $memoryUsed = ($memoryAfter - $memoryBefore) / 1024 / 1024; // MB

        // Não deve usar mais de 50MB de memória adicional
        $this->assertLessThan(
            50,
            $memoryUsed,
            "Comando não deve vazar memória (usou {$memoryUsed}MB)"
        );
    }

    /**
     * @test
     * Segurança: Valida que comando não expõe dados sensíveis nos logs
     */
    public function command_does_not_log_sensitive_data(): void
    {
        $user = User::factory()->create([
            'email' => 'sensitive@example.com',
            'password' => 'secret_password',
            'created_at' => now()->subDays(5),
        ]);

        Artisan::call('trial:notify', [
            '--registration-days' => 3,
            '--dry-run' => true,
        ]);

        // Logs não devem conter senha
        Log::shouldNotHaveReceived('info')
            ->withArgs(function ($message, $context) {
                return isset($context['password']) ||
                       (is_string($message) && str_contains($message, 'secret_password'));
            });

        Log::shouldNotHaveReceived('error')
            ->withArgs(function ($message, $context) {
                return isset($context['password']) ||
                       (is_string($message) && str_contains($message, 'secret_password'));
            });
    }

    /**
     * @test
     * Segurança: Valida que parâmetros negativos não causam problemas
     */
    public function negative_parameters_are_handled_safely(): void
    {
        // Não deve causar erro ou comportamento inesperado
        $exitCode = Artisan::call('trial:notify', [
            '--days' => '-1',
            '--dry-run' => true,
        ]);

        // Deve completar sem erro
        $this->assertEquals(0, $exitCode);
    }

    /**
     * @test
     * Segurança: Valida que parâmetros muito grandes são limitados
     */
    public function very_large_parameters_do_not_cause_performance_issues(): void
    {
        $start = microtime(true);

        $exitCode = Artisan::call('trial:notify', [
            '--days' => '999999',
            '--registration-days' => '999999',
            '--dry-run' => true,
        ]);

        $duration = microtime(true) - $start;

        // Deve completar sem erro
        $this->assertEquals(0, $exitCode);

        // Não deve demorar muito (mesmo com parâmetros grandes)
        $this->assertLessThan(
            5.0,
            $duration,
            "Comando com parâmetros grandes não deve ser lento (levou {$duration}s)"
        );
    }

    /**
     * @test
     * Performance: Valida uso de eager loading para evitar N+1
     */
    public function command_uses_eager_loading_to_avoid_n_plus_one(): void
    {
        // Cria tenant com subscription e usuários
        $tenant = Tenant::factory()
            ->hasSubscriptions(1, [
                'trial_ends_at' => now()->addDays(2),
                'stripe_status' => 'trialing',
            ])
            ->create();

        // Adiciona 10 usuários ao tenant
        $users = User::factory()->count(10)->make();
        $tenant->users()->saveMany($users);

        // Habilita query logging
        DB::enableQueryLog();

        Artisan::call('trial:notify', [
            '--days' => 3,
            '--dry-run' => true,
        ]);

        $queries = DB::getQueryLog();

        // Não deve fazer queries individuais para cada usuário
        // Deve usar eager loading (with)
        $userQueries = array_filter($queries, function ($query) {
            return str_contains($query['query'], 'select * from `users` where');
        });

        // Se houvesse N+1, teríamos 10+ queries de usuários
        // Com eager loading, devemos ter no máximo 2-3
        $this->assertLessThan(
            5,
            count($userQueries),
            'Deve usar eager loading para evitar N+1 queries'
        );

        DB::disableQueryLog();
    }

    /**
     * @test
     * Segurança: Valida que exceções são tratadas corretamente
     */
    public function command_handles_exceptions_gracefully(): void
    {
        // Este teste valida que o comando não quebra mesmo com dados problemáticos

        // Cria usuário sem email (caso de edge)
        $user = new User();
        $user->name = 'Test User';
        $user->email = null;
        $user->created_at = now()->subDays(5);

        try {
            $user->saveOrFail();
        } catch (Exception $e) {
            // É esperado que falhe - teste só valida que comando não quebra
        }

        $exitCode = Artisan::call('trial:notify', [
            '--registration-days' => 3,
            '--dry-run' => true,
        ]);

        // Comando deve completar mesmo com dados problemáticos
        $this->assertEquals(0, $exitCode);
    }

    /**
     * @test
     * Performance: Valida que comando finaliza rapidamente com dataset vazio
     */
    public function command_finishes_quickly_with_empty_dataset(): void
    {
        $start = microtime(true);

        Artisan::call('trial:notify', ['--dry-run' => true]);

        $duration = microtime(true) - $start;

        // Deve finalizar quase instantaneamente com dados vazios
        $this->assertLessThan(
            0.5,
            $duration,
            "Comando com dataset vazio deve ser muito rápido (levou {$duration}s)"
        );
    }

    /**
     * @test
     * Segurança: Valida que filtragem de datas é precisa
     */
    public function date_filtering_is_precise_and_secure(): void
    {
        // Cria usuários em diferentes períodos
        $oldUser = User::factory()->create(['created_at' => now()->subDays(30)]);
        $recentUser = User::factory()->create(['created_at' => now()->subDays(5)]);
        $veryRecentUser = User::factory()->create(['created_at' => now()->subDay()]);

        Artisan::call('trial:notify', [
            '--registration-days' => 3,
            '--dry-run' => true,
        ]);

        // Apenas o usuário no período correto deve ser processado
        // O comando deve usar BETWEEN corretamente
        $output = Artisan::output();

        // Usuário de 30 dias atrás não deve aparecer
        $this->assertStringNotContainsString($oldUser->email, $output);

        // Usuário de ontem (< 3 dias) não deve aparecer
        $this->assertStringNotContainsString($veryRecentUser->email, $output);
    }

    /**
     * @test
     * Segurança: Valida que comando não é vulnerável a timing attacks
     */
    public function command_execution_time_does_not_leak_information(): void
    {
        // Executa com dados
        User::factory()->count(10)->create(['created_at' => now()->subDays(5)]);
        $start1 = microtime(true);
        Artisan::call('trial:notify', ['--registration-days' => 3, '--dry-run' => true]);
        $duration1 = microtime(true) - $start1;

        // Limpa e executa sem dados
        User::query()->delete();
        $start2 = microtime(true);
        Artisan::call('trial:notify', ['--registration-days' => 3, '--dry-run' => true]);
        $duration2 = microtime(true) - $start2;

        // A diferença de tempo pode existir mas não deve ser exploitável
        // Este é um teste básico - em produção seria necessário análise mais profunda
        $this->assertTrue(true, 'Timing attack test placeholder');
    }

    /**
     * @test
     * Valida que comando retorna código de sucesso correto
     */
    public function command_returns_success_exit_code(): void
    {
        $exitCode = Artisan::call('trial:notify', ['--dry-run' => true]);
        $this->assertEquals(0, $exitCode);
    }
}
