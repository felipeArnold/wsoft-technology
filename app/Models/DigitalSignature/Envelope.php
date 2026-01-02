<?php

declare(strict_types=1);

namespace App\Models\DigitalSignature;

use App\Models\Tenant;
use App\Models\User;
use Database\Factories\DigitalSignature\EnvelopeFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property array<int, string>|null $documents
 * @property Carbon|null $deadline
 * @property string|null $name
 * @property string|null $status
 *
 * @method static Builder where($column, $operator = null, $value = null, $boolean = 'and')
 * @method static Envelope|null find($id, $columns = ['*'])
 */
final class Envelope extends Model
{
    /** @use HasFactory<EnvelopeFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'documents',
        'deadline',
        'status',
        'user_id',
        'tenant_id',
        'zapsign_token',
        'zapsign_open_id',
        'zapsign_status',
        'zapsign_url',
        'zapsign_signed_file',
        'zapsign_sent_at',
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
            'zapsign_sent_at' => 'datetime',
        ];
    }
}
