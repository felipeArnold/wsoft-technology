<?php

declare(strict_types=1);

namespace App\Observers;

use App\Jobs\SubmitUrlToSearchEngines;
use App\Models\Blog\BlogPost;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

final class BlogPostObserver
{
    /**
     * Handle the BlogPost "saved" event (created or updated).
     */
    public function saved(BlogPost $blogPost): void
    {
        $this->clearSitemapCache();

        // Notifica buscadores se o post estiver publicado
        if ($blogPost->isPublished()) {
            $this->notifySearchEngines($blogPost);
        }
    }

    /**
     * Handle the BlogPost "deleted" event.
     */
    public function deleted(BlogPost $blogPost): void
    {
        $this->clearSitemapCache();
    }

    /**
     * Handle the BlogPost "restored" event.
     */
    public function restored(BlogPost $blogPost): void
    {
        $this->clearSitemapCache();
    }

    /**
     * Clear the sitemap cache.
     */
    private function clearSitemapCache(): void
    {
        Cache::forget('sitemap');
    }

    /**
     * Notifica buscadores sobre o post publicado/atualizado
     */
    private function notifySearchEngines(BlogPost $blogPost): void
    {
        try {
            $url = route('blog.show', $blogPost->slug);

            // Dispatch job em background para não bloquear a publicação
            SubmitUrlToSearchEngines::dispatch($url, $blogPost->title)
                ->delay(now()->addSeconds(10)); // Aguardar 10s para garantir que a página está acessível

            Log::info('📤 Blog post queued for submission to search engines', [
                'post_id' => $blogPost->id,
                'title' => $blogPost->title,
                'url' => $url,
            ]);
        } catch (Exception $e) {
            Log::error('❌ Failed to queue blog post for search engine submission', [
                'post_id' => $blogPost->id,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
