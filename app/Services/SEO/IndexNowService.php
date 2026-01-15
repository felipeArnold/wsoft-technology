<?php

declare(strict_types=1);

namespace App\Services\SEO;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * IndexNow Service
 *
 * Notifica automaticamente buscadores (Bing, Yandex) sobre páginas novas/atualizadas
 * para indexação mais rápida.
 *
 * @see https://www.indexnow.org/
 */
final class IndexNowService
{
    /**
     * API Key para IndexNow (deve ser armazenado em .env)
     */
    private string $apiKey;

    /**
     * URLs dos endpoints IndexNow
     */
    private array $endpoints = [
        'bing' => 'https://www.bing.com/indexnow',
        'yandex' => 'https://yandex.com/indexnow',
    ];

    public function __construct()
    {
        $this->apiKey = config('services.indexnow.key', '');
    }

    /**
     * Gera uma chave API aleatória para IndexNow
     */
    public static function generateApiKey(): string
    {
        return bin2hex(random_bytes(16));
    }

    /**
     * Notifica buscadores sobre uma URL atualizada
     *
     * @param  string  $url  URL completa da página atualizada
     */
    public function submitUrl(string $url): bool
    {
        if (empty($this->apiKey)) {
            Log::warning('IndexNow API key not configured');

            return false;
        }

        $payload = [
            'host' => parse_url($url, PHP_URL_HOST),
            'key' => $this->apiKey,
            'keyLocation' => url('/').'/'.$this->apiKey.'.txt',
            'urlList' => [$url],
        ];

        $success = false;

        foreach ($this->endpoints as $name => $endpoint) {
            try {
                $response = Http::timeout(5)->post($endpoint, $payload);

                if ($response->successful() || $response->status() === 202) {
                    Log::info("IndexNow: URL submitted to {$name}", ['url' => $url]);
                    $success = true;
                } else {
                    Log::warning("IndexNow: Failed to submit to {$name}", [
                        'url' => $url,
                        'status' => $response->status(),
                    ]);
                }
            } catch (Exception $e) {
                Log::error("IndexNow: Exception submitting to {$name}", [
                    'url' => $url,
                    'error' => $e->getMessage(),
                ]);
            }
        }

        return $success;
    }

    /**
     * Notifica buscadores sobre múltiplas URLs atualizadas
     *
     * @param  array  $urls  Array de URLs completas
     */
    public function submitUrls(array $urls): bool
    {
        if (empty($this->apiKey) || empty($urls)) {
            return false;
        }

        $payload = [
            'host' => parse_url($urls[0], PHP_URL_HOST),
            'key' => $this->apiKey,
            'keyLocation' => url('/').'/'.$this->apiKey.'.txt',
            'urlList' => $urls,
        ];

        $success = false;

        foreach ($this->endpoints as $name => $endpoint) {
            try {
                $response = Http::timeout(10)->post($endpoint, $payload);

                if ($response->successful() || $response->status() === 202) {
                    Log::info("IndexNow: URLs submitted to {$name}", [
                        'count' => count($urls),
                    ]);
                    $success = true;
                }
            } catch (Exception $e) {
                Log::error("IndexNow: Exception submitting to {$name}", [
                    'error' => $e->getMessage(),
                ]);
            }
        }

        return $success;
    }
}
