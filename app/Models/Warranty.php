<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Person\Person;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

final class Warranty extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'tenant_id',
        'service_order_id',
        'service_order_service_id',
        'service_order_product_id',
        'product_id',
        'service_id',
        'person_id',
        'warranty_type',
        'start_date',
        'end_date',
        'duration_days',
        'status',
        'coverage_description',
        'terms',
        'notes',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'duration_days' => 'integer',
    ];

    // Relationships

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function serviceOrder(): BelongsTo
    {
        return $this->belongsTo(ServiceOrder::class);
    }

    public function serviceOrderService(): BelongsTo
    {
        return $this->belongsTo(ServiceOrderService::class);
    }

    public function serviceOrderProduct(): BelongsTo
    {
        return $this->belongsTo(ServiceOrderProduct::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }

    public function warrantyClaims(): HasMany
    {
        return $this->hasMany(WarrantyClaim::class);
    }

    // Helper Methods

    public function isActive(): bool
    {
        return $this->status === 'active' && $this->end_date >= now()->toDateString();
    }

    public function isExpired(): bool
    {
        return $this->status === 'expired' || $this->end_date < now()->toDateString();
    }

    public function isNearExpiration(int $days = 30): bool
    {
        return $this->isActive() && $this->end_date <= now()->addDays($days)->toDateString();
    }

    public function getDaysRemaining(): int
    {
        if ($this->isExpired()) {
            return 0;
        }

        return (int) now()->diffInDays($this->end_date, false);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active')
            ->where('end_date', '>=', now()->toDateString());
    }

    public function scopeExpiring($query, int $days = 30)
    {
        return $query->where('status', 'active')
            ->whereBetween('end_date', [now()->toDateString(), now()->addDays($days)->toDateString()]);
    }

    public function scopeExpired($query)
    {
        return $query->where(function ($q) {
            $q->where('status', 'expired')
                ->orWhere('end_date', '<', now()->toDateString());
        });
    }
}
