<?php

declare(strict_types=1);

namespace App\Models\DigitalSignature;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class Envelope extends Model
{
    /** @use HasFactory<\Database\Factories\DigitalSignature\EnvelopeFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'documents',
        'deadline',
        'status',
        'user_id',
        'tenant_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function signers(): HasMany
    {
        return $this->hasMany(Signer::class);
    }

    protected function casts(): array
    {
        return [
            'deadline' => 'date',
            'documents' => 'array',
        ];
    }
}
