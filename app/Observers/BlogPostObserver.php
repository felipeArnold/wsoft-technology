<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Blog\BlogPost;
use Illuminate\Support\Facades\Cache;

final class BlogPostObserver
{
    /**
     * Handle the BlogPost "saved" event (created or updated).
     */
    public function saved(BlogPost $blogPost): void
    {
        $this->clearSitemapCache();
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
}
