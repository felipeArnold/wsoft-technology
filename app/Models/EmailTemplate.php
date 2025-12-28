<?php

declare(strict_types=1);

namespace App\Models;

use App\Observers\EmailTemplateObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Enum\Template\TemplateContext;

#[ObservedBy(EmailTemplateObserver::class)]
final class EmailTemplate extends Model
{
    protected $guarded = ['id'];

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'meta' => 'array',
            'context' => TemplateContext::class,
        ];
    }
}
