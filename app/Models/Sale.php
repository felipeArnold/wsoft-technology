<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Concerns\Categorizable;
use App\Models\Person\Person;
use App\Observers\SaleObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy(SaleObserver::class)]
final class Sale extends Model
{
    use Categorizable;
    use HasFactory;
    use SoftDeletes;

    protected $casts = [
        'subtotal' => 'float',
        'discount_amount' => 'float',
        'total' => 'float',
        'installments' => 'integer',
        'completed_at' => 'datetime',
    ];

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(SaleItem::class);
    }

    public function calculateTotals(): void
    {
        $subtotal = $this->items()->sum('total');
        $this->subtotal = $subtotal;
        $this->total = $subtotal - $this->discount_amount;
    }
}
