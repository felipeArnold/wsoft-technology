<?php

declare(strict_types=1);

namespace App\Models\AI;

use App\Models\Blog\BlogPost;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class AIGeneration extends Model
{
    protected $table = 'ai_generations';

    protected $fillable = [
        'user_id',
        'blog_post_id',
        'type',
        'status',
        'prompt',
        'request_data',
        'model',
        'temperature',
        'max_tokens',
        'response_content',
        'response_data',
        'tokens_used',
        'prompt_tokens',
        'completion_tokens',
        'estimated_cost',
        'processing_time_ms',
        'retry_attempts',
        'error_message',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'request_data' => 'array',
        'response_data' => 'array',
        'temperature' => 'float',
        'max_tokens' => 'integer',
        'tokens_used' => 'integer',
        'prompt_tokens' => 'integer',
        'completion_tokens' => 'integer',
        'estimated_cost' => 'decimal:6',
        'processing_time_ms' => 'integer',
        'retry_attempts' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function blogPost(): BelongsTo
    {
        return $this->belongsTo(BlogPost::class);
    }

    public function markAsProcessing(): void
    {
        $this->update(['status' => 'processing']);
    }

    public function markAsCompleted(array $data = []): void
    {
        $this->update(array_merge(['status' => 'completed'], $data));
    }

    public function markAsFailed(string $errorMessage, array $data = []): void
    {
        $this->update(array_merge([
            'status' => 'failed',
            'error_message' => $errorMessage,
        ], $data));
    }

    public function calculateEstimatedCost(): float
    {
        if (! $this->tokens_used) {
            return 0;
        }

        // Preços do GPT-4o-mini (verificar em https://openai.com/pricing)
        // Input: $0.150 / 1M tokens
        // Output: $0.600 / 1M tokens
        $inputCostPer1M = 0.150;
        $outputCostPer1M = 0.600;

        $promptCost = ($this->prompt_tokens ?? 0) * ($inputCostPer1M / 1_000_000);
        $completionCost = ($this->completion_tokens ?? 0) * ($outputCostPer1M / 1_000_000);

        return round($promptCost + $completionCost, 6);
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeFailed($query)
    {
        return $query->where('status', 'failed');
    }

    public function scopeByType($query, string $type)
    {
        return $query->where('type', $type);
    }

    public function scopeByUser($query, int $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeRecent($query, int $days = 7)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    public function getProcessingTimeAttribute(): ?string
    {
        if (! $this->processing_time_ms) {
            return null;
        }

        if ($this->processing_time_ms < 1000) {
            return "{$this->processing_time_ms}ms";
        }

        return round($this->processing_time_ms / 1000, 2).'s';
    }

    public function getFormattedCostAttribute(): string
    {
        if (! $this->estimated_cost) {
            return '$0.000000';
        }

        return '$'.number_format($this->estimated_cost, 6);
    }
}
