<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $funnel_id
 * @property string $name
 * @property string|null $description
 * @property string $color
 * @property int $order
 * @property bool $active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
final class FunnelStage extends Model
{
    protected $guarded = ['id'];

    public function funnel(): BelongsTo
    {
        return $this->belongsTo(Funnel::class);
    }

    protected function casts(): array
    {
        return [
            'active' => 'boolean',
            'order' => 'integer',
        ];
    }
}
