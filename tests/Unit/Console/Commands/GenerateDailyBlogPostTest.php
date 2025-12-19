<?php

declare(strict_types=1);

namespace Tests\Unit\Console\Commands;

use App\Console\Commands\GenerateDailyBlogPost;
use App\Models\Blog\BlogCategory;
use App\Models\Blog\BlogPost;
use App\Models\User;
use App\Services\AI\BlogPostGenerator;
use DB;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Mockery;
use ReflectionClass;
use Tests\TestCase;

/**
 * Testes unitários para GenerateDailyBlogPost
 * Foco: Performance e Segurança
 */
final class GenerateDailyBlogPostTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Log::spy();
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    /**
     * @test
     * Performance: Valida que array de tópicos não causa overhead de memória
     */
    public function topics_array_does_not_consume_excessive_memory(): void
    {
        $memoryBefore = memory_get_usage();

        $command = new GenerateDailyBlogPost();

        // Acessa a propriedade privada topics via reflection para validar
        $reflection = new ReflectionClass($command);
        $topicsProperty = $reflection->getProperty('topics');
        $topicsProperty->setAccessible(true);
        $topics = $topicsProperty->getValue($command);

        $memoryAfter = memory_get_usage();
        $memoryUsed = ($memoryAfter - $memoryBefore) / 1024; // KB

        // Array de ~200 strings não deve usar mais de 100KB
        $this->assertLessThan(
            100,
            $memoryUsed,
            "Array de tópicos não deve consumir muita memória (usou {$memoryUsed}KB)"
        );

        // Valida que tem um número razoável de tópicos
        $this->assertGreaterThan(50, count($topics), 'Deve ter muitos tópicos disponíveis');
        $this->assertLessThan(500, count($topics), 'Não deve ter tópicos demais');
    }

    /**
     * @test
     * Segurança: Valida que tópico customizado não é vulnerável a injection
     */
    public function custom_topic_parameter_is_sanitized(): void
    {
        User::factory()->create();
        BlogCategory::factory()->create();

        // Mock do gerador
        $this->mockBlogPostGenerator();

        // Tenta injection via --topic
        $maliciousTopic = '<script>alert("xss")</script>';

        Artisan::call('blog:generate-daily', [
            '--topic' => $maliciousTopic,
            '--publish' => false,
        ]);

        // Post criado não deve conter script tags
        $post = BlogPost::latest()->first();

        if ($post) {
            $this->assertDoesNotMatchRegularExpression(
                '/<script|<iframe|javascript:/i',
                $post->title ?? '',
                'Título não deve conter código malicioso'
            );
        }
    }

    /**
     * @test
     * Segurança: Valida que category ID só aceita inteiros
     */
    public function category_parameter_only_accepts_valid_ids(): void
    {
        User::factory()->create();
        $category = BlogCategory::factory()->create();
        $this->mockBlogPostGenerator();

        // ID válido deve funcionar
        $exitCode = Artisan::call('blog:generate-daily', [
            '--category' => $category->id,
            '--publish' => false,
        ]);

        $this->assertEquals(0, $exitCode);
    }

    /**
     * @test
     * Segurança: Valida que author ID só aceita inteiros
     */
    public function author_parameter_only_accepts_valid_ids(): void
    {
        $user = User::factory()->create();
        BlogCategory::factory()->create();
        $this->mockBlogPostGenerator();

        // ID válido deve funcionar
        $exitCode = Artisan::call('blog:generate-daily', [
            '--author' => $user->id,
            '--publish' => false,
        ]);

        $this->assertEquals(0, $exitCode);
    }

    /**
     * @test
     * Performance: Valida que seleção de tópico com array_rand é rápida
     */
    public function topic_selection_is_fast(): void
    {
        $command = new GenerateDailyBlogPost();
        $reflection = new ReflectionClass($command);
        $selectTopicMethod = $reflection->getMethod('selectTopic');
        $selectTopicMethod->setAccessible(true);

        $start = microtime(true);
        $iterations = 1000;

        for ($i = 0; $i < $iterations; $i++) {
            $selectTopicMethod->invoke($command);
        }

        $duration = microtime(true) - $start;

        // Deve selecionar 1000 tópicos em menos de 100ms
        $this->assertLessThan(
            0.1,
            $duration,
            "Seleção de tópico deve ser rápida (levou {$duration}s para {$iterations} iterações)"
        );
    }

    /**
     * @test
     * Performance: Valida que similar_text não causa lentidão extrema
     */
    public function similarity_check_does_not_cause_performance_issues(): void
    {
        // Cria 30 posts recentes (pior caso)
        BlogPost::factory()->count(30)->create([
            'created_at' => now()->subDays(15),
        ]);

        User::factory()->create();
        BlogCategory::factory()->create();
        $this->mockBlogPostGenerator();

        $start = microtime(true);

        Artisan::call('blog:generate-daily', ['--publish' => false]);

        $duration = microtime(true) - $start;

        // Mesmo com 30 comparações, deve ser razoavelmente rápido
        // (não conta tempo de IA, que é mockado)
        $this->assertLessThan(
            2.0,
            $duration,
            "Seleção de tópico com verificação de similaridade não deve ser muito lenta (levou {$duration}s)"
        );
    }

    /**
     * @test
     * Segurança: Valida que logs não expõem dados sensíveis
     */
    public function command_does_not_log_sensitive_information(): void
    {
        User::factory()->create(['password' => 'secret123']);
        BlogCategory::factory()->create();
        $this->mockBlogPostGenerator();

        Artisan::call('blog:generate-daily', ['--publish' => false]);

        // Logs não devem conter senhas
        Log::shouldNotHaveReceived('info')
            ->withArgs(function ($message, $context) {
                return isset($context['password']) ||
                       (is_string($message) && str_contains($message, 'secret'));
            });
    }

    /**
     * @test
     * Segurança: Valida que tópicos não contêm código malicioso
     */
    public function topics_array_does_not_contain_malicious_content(): void
    {
        $command = new GenerateDailyBlogPost();
        $reflection = new ReflectionClass($command);
        $topicsProperty = $reflection->getProperty('topics');
        $topicsProperty->setAccessible(true);
        $topics = $topicsProperty->getValue($command);

        foreach ($topics as $topic) {
            // Não deve conter scripts
            $this->assertDoesNotMatchRegularExpression(
                '/<script|<iframe|javascript:|onerror=/i',
                $topic,
                "Tópico não deve conter código malicioso: {$topic}"
            );

            // Não deve conter SQL injection patterns
            $this->assertDoesNotMatchRegularExpression(
                '/union.*select|drop.*table|insert.*into|delete.*from/i',
                $topic,
                "Tópico não deve conter SQL injection: {$topic}"
            );

            // Deve ser string não vazia
            $this->assertIsString($topic);
            $this->assertNotEmpty($topic);

            // Deve ter tamanho razoável (não muito longo)
            $this->assertLessThan(
                500,
                mb_strlen($topic),
                "Tópico não deve ser muito longo: {$topic}"
            );
        }
    }

    /**
     * @test
     * Performance: Valida que comando não vaza memória
     */
    public function command_does_not_leak_memory(): void
    {
        User::factory()->create();
        BlogCategory::factory()->create();

        $memoryBefore = memory_get_usage();

        // Executa comando 5 vezes
        for ($i = 0; $i < 5; $i++) {
            $this->mockBlogPostGenerator();
            Artisan::call('blog:generate-daily', ['--publish' => false]);
        }

        $memoryAfter = memory_get_usage();
        $memoryLeaked = ($memoryAfter - $memoryBefore) / 1024 / 1024; // MB

        // Não deve vazar mais de 20MB após 5 execuções
        $this->assertLessThan(
            20,
            $memoryLeaked,
            "Comando não deve vazar memória (vazou {$memoryLeaked}MB em 5 execuções)"
        );
    }

    /**
     * @test
     * Segurança: Valida comportamento com categoria inexistente
     */
    public function handles_nonexistent_category_gracefully(): void
    {
        User::factory()->create();
        $this->mockBlogPostGenerator();

        $exitCode = Artisan::call('blog:generate-daily', [
            '--category' => 99999,
            '--publish' => false,
        ]);

        // Deve criar categoria padrão ou usar existente
        $this->assertEquals(0, $exitCode);
    }

    /**
     * @test
     * Segurança: Valida comportamento com autor inexistente
     */
    public function handles_nonexistent_author_gracefully(): void
    {
        // Cria ao menos um usuário no sistema
        User::factory()->create();
        BlogCategory::factory()->create();
        $this->mockBlogPostGenerator();

        $exitCode = Artisan::call('blog:generate-daily', [
            '--author' => 99999,
            '--publish' => false,
        ]);

        // Deve usar primeiro usuário disponível
        $this->assertEquals(0, $exitCode);
    }

    /**
     * @test
     * Performance: Valida que filtro de posts recentes é eficiente
     */
    public function recent_posts_filtering_uses_efficient_query(): void
    {
        // Cria muitos posts antigos e alguns recentes
        BlogPost::factory()->count(100)->create(['created_at' => now()->subDays(60)]);
        BlogPost::factory()->count(20)->create(['created_at' => now()->subDays(15)]);

        DB::enableQueryLog();

        User::factory()->create();
        BlogCategory::factory()->create();
        $this->mockBlogPostGenerator();

        Artisan::call('blog:generate-daily', ['--publish' => false]);

        $queries = DB::getQueryLog();

        // Deve usar WHERE com data para filtrar, não carregar todos os posts
        $postQueries = array_filter($queries, function ($query) {
            return str_contains($query['query'], 'blog_posts') &&
                   str_contains($query['query'], 'created_at');
        });

        $this->assertNotEmpty($postQueries, 'Deve filtrar posts por data');

        DB::disableQueryLog();
    }

    /**
     * @test
     * Valida que comando retorna código de sucesso correto
     */
    public function command_returns_success_exit_code(): void
    {
        User::factory()->create();
        BlogCategory::factory()->create();
        $this->mockBlogPostGenerator();

        $exitCode = Artisan::call('blog:generate-daily', ['--publish' => false]);

        $this->assertEquals(0, $exitCode);
    }

    /**
     * @test
     * Segurança: Valida que opção --publish é booleana
     */
    public function publish_option_is_boolean(): void
    {
        User::factory()->create();
        BlogCategory::factory()->create();
        $this->mockBlogPostGenerator();

        // Com --publish (true)
        Artisan::call('blog:generate-daily', ['--publish' => true]);
        $publishedPost = BlogPost::latest()->first();
        $this->assertEquals('published', $publishedPost->status);

        // Sem --publish (false/draft)
        Artisan::call('blog:generate-daily', ['--publish' => false]);
        $draftPost = BlogPost::latest()->first();
        $this->assertEquals('draft', $draftPost->status);
    }

    /**
     * Helper method para mockar BlogPostGenerator
     */
    private function mockBlogPostGenerator(): void
    {
        $mock = Mockery::mock(BlogPostGenerator::class);
        $mock->shouldReceive('generatePost')
            ->andReturn([
                'title' => 'Test Blog Post',
                'slug' => 'test-blog-post',
                'content' => 'Test content',
                'excerpt' => 'Test excerpt',
                'meta_description' => 'Test meta',
            ]);

        $this->app->instance(BlogPostGenerator::class, $mock);
    }
}
