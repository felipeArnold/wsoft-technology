<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Services\SEO\IndexNowService;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Job para submeter URLs aos buscadores em background
 */
final class SubmitUrlToSearchEngines implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Número de tentativas
     */
    public int $tries = 3;

    /**
     * Timeout em segundos
     */
    public int $timeout = 30;

    /**
     * Criar nova instância do job
     */
    public function __construct(
        public readonly string $url,
        public readonly string $title,
    ) {}

    /**
     * Executar o job
     */
    public function handle(IndexNowService $indexNowService): void
    {
        try {
            Log::info('🚀 Submitting URL to search engines', [
                'url' => $this->url,
                'title' => $this->title,
            ]);

            $success = $indexNowService->submitUrl($this->url);

            if ($success) {
                Log::info('✅ URL successfully submitted to search engines', [
                    'url' => $this->url,
                ]);
            } else {
                Log::warning('⚠️ Failed to submit URL to search engines', [
                    'url' => $this->url,
                ]);
            }
        } catch (Exception $e) {
            Log::error('❌ Error submitting URL to search engines', [
                'url' => $this->url,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            // Re-throw para permitir retry automático
            throw $e;
        }
    }

    /**
     * Handle a job failure.
     */
    public function failed(Throwable $exception): void
    {
        Log::error('❌ Job failed after all retries', [
            'url' => $this->url,
            'error' => $exception->getMessage(),
        ]);
    }
}
