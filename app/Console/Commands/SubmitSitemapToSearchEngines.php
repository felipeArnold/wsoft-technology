<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Blog\BlogPost;
use App\Services\SEO\IndexNowService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

final class SubmitSitemapToSearchEngines extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seo:submit-sitemap
                            {--all : Submit all published blog posts}
                            {--google : Submit to Google Search Console}
                            {--bing : Submit to Bing Webmaster Tools}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Submit sitemap and URLs to search engines for faster indexing';

    /**
     * Execute the console command.
     */
    public function handle(IndexNowService $indexNowService): int
    {
        $this->info('🚀 Submitting URLs to search engines...');

        // Submit all blog posts if requested
        if ($this->option('all')) {
            $this->submitAllBlogPosts($indexNowService);
        }

        // Submit sitemap to Google
        if ($this->option('google') || !$this->option('bing')) {
            $this->submitToGoogle();
        }

        // Submit sitemap to Bing
        if ($this->option('bing') || !$this->option('google')) {
            $this->submitToBing();
        }

        $this->newLine();
        $this->info('✅ Submission completed!');

        return Command::SUCCESS;
    }

    /**
     * Submit all published blog posts via IndexNow
     */
    private function submitAllBlogPosts(IndexNowService $indexNowService): void
    {
        $posts = BlogPost::query()
            ->published()
            ->get();

        if ($posts->isEmpty()) {
            $this->warn('No published blog posts found.');
            return;
        }

        $urls = $posts->map(fn($post) => route('blog.show', $post->slug))->toArray();

        $this->info("📝 Submitting {$posts->count()} blog posts via IndexNow...");

        if ($indexNowService->submitUrls($urls)) {
            $this->info("✅ {$posts->count()} URLs submitted successfully!");
        } else {
            $this->error('❌ Failed to submit URLs. Check logs for details.');
        }
    }

    /**
     * Submit sitemap to Google Search Console
     */
    private function submitToGoogle(): void
    {
        $sitemapUrl = url('/sitemap.xml');
        $pingUrl = "https://www.google.com/ping?sitemap=" . urlencode($sitemapUrl);

        $this->info('🔍 Submitting sitemap to Google...');

        try {
            $response = Http::timeout(10)->get($pingUrl);

            if ($response->successful()) {
                $this->info('✅ Sitemap submitted to Google successfully!');
            } else {
                $this->warn("⚠️  Google returned status: {$response->status()}");
            }
        } catch (\Exception $e) {
            $this->error("❌ Failed to submit to Google: {$e->getMessage()}");
        }
    }

    /**
     * Submit sitemap to Bing Webmaster Tools
     */
    private function submitToBing(): void
    {
        $sitemapUrl = url('/sitemap.xml');
        $apiKey = config('services.bing.webmaster_api_key');

        if (empty($apiKey)) {
            $this->warn('⚠️  Bing Webmaster API key not configured. Skipping...');
            return;
        }

        $this->info('🔍 Submitting sitemap to Bing...');

        try {
            $response = Http::timeout(10)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->post("https://ssl.bing.com/webmaster/api.svc/json/SubmitUrlbatch?apikey={$apiKey}", [
                    'siteUrl' => url('/'),
                    'urlList' => [$sitemapUrl]
                ]);

            if ($response->successful()) {
                $this->info('✅ Sitemap submitted to Bing successfully!');
            } else {
                $this->warn("⚠️  Bing returned status: {$response->status()}");
            }
        } catch (\Exception $e) {
            $this->error("❌ Failed to submit to Bing: {$e->getMessage()}");
        }
    }
}
