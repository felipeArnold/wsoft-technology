<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $tenant_id
 * @property int|null $funnel_id
 * @property string $name
 * @property string|null $description
 * @property bool $active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
final class Team extends Model
{
    protected $guarded = ['id'];

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function funnel(): BelongsTo
    {
        return $this->belongsTo(Funnel::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'team_user')
            ->withTimestamps();
    }

    protected function casts(): array
    {
        return [
            'active' => 'boolean',
        ];
    }
}
