<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Jobs\SubmitUrlToSearchEngines;
use App\Models\Blog\BlogPost;
use Illuminate\Console\Command;

final class TestBlogPostIndexing extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'seo:test-blog-indexing
                            {--post= : ID do post para testar}
                            {--latest : Usar o post mais recente}';

    /**
     * The console command description.
     */
    protected $description = 'Testa a indexação automática de posts do blog';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('🧪 Testando indexação automática de posts do blog...');
        $this->newLine();

        // Buscar post
        $post = $this->getPost();

        if (!$post) {
            $this->error('❌ Nenhum post encontrado!');
            return Command::FAILURE;
        }

        $this->line("📄 Post selecionado:");
        $this->line("   ID: {$post->id}");
        $this->line("   Título: {$post->title}");
        $this->line("   Status: {$post->status}");
        $this->line("   Publicado em: " . ($post->published_at?->format('d/m/Y H:i') ?? 'Não publicado'));
        $this->newLine();

        // Verificar se está publicado
        if (!$post->isPublished()) {
            $this->warn('⚠️  Este post ainda NÃO está publicado!');
            $this->line('   Para ser indexado automaticamente, o post precisa estar com status "published"');
            $this->newLine();
        }

        // Gerar URL
        $url = route('blog.show', $post->slug);
        $this->line("🔗 URL do post: {$url}");
        $this->newLine();

        // Confirmar envio
        if (!$this->confirm('Deseja enviar este post para os buscadores agora?', true)) {
            $this->info('Operação cancelada.');
            return Command::SUCCESS;
        }

        // Dispatch job
        $this->info('📤 Enviando job para a fila...');
        SubmitUrlToSearchEngines::dispatch($url, $post->title);

        $this->newLine();
        $this->info('✅ Job enviado com sucesso!');
        $this->newLine();

        $this->line('📊 Próximos passos:');
        $this->line('   1. Verifique os logs: tail -f storage/logs/laravel.log | grep "search engines"');
        $this->line('   2. Execute o worker: php artisan queue:work');
        $this->line('   3. Aguarde ~10 segundos para o job processar');
        $this->line('   4. Verifique se apareceu log de sucesso (✅)');

        return Command::SUCCESS;
    }

    /**
     * Buscar post baseado nas opções
     */
    private function getPost(): ?BlogPost
    {
        if ($postId = $this->option('post')) {
            return BlogPost::find($postId);
        }

        if ($this->option('latest')) {
            return BlogPost::latest()->first();
        }

        // Listar posts disponíveis
        $posts = BlogPost::latest()->limit(10)->get();

        if ($posts->isEmpty()) {
            return null;
        }

        $this->line('📚 Posts disponíveis (10 mais recentes):');
        $this->newLine();

        $choices = [];
        foreach ($posts as $post) {
            $status = $post->isPublished() ? '✅' : '⏳';
            $choice = "{$status} [{$post->id}] {$post->title} ({$post->status})";
            $choices[$post->id] = $choice;
        }

        $selectedId = $this->choice(
            'Selecione um post:',
            $choices,
            $posts->first()->id
        );

        return BlogPost::find(array_search($selectedId, $choices));
    }
}
