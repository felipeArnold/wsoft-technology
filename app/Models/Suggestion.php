<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Suggestion extends Model
{
    protected $fillable = [
        'user_id',
        'tenant_id',
        'type',
        'title',
        'description',
        'status',
        'admin_notes',
    ];

    protected $casts = [
        'type' => 'string',
        'status' => 'string',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }
}
