<?php

declare(strict_types=1);

namespace App\Models;

use App\Enum\Commission\CommissionStatusEnum;
use App\Helpers\FormatterHelper;
use App\Observers\CommissionObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy(CommissionObserver::class)]
final class Commission extends Model
{
    /** @use HasFactory<\Database\Factories\CommissionFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'tenant_id',
        'user_id',
        'service_order_id',
        'sale_id',
        'type',
        'commission_percentage',
        'base_value',
        'commission_amount',
        'status',
        'paid_at',
        'paid_by_user_id',
        'notes',
    ];

    protected $casts = [
        'commission_percentage' => 'decimal:2',
        'base_value' => 'decimal:2',
        'commission_amount' => 'decimal:2',
        'status' => CommissionStatusEnum::class,
        'paid_at' => 'datetime',
    ];

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function serviceOrder(): BelongsTo
    {
        return $this->belongsTo(ServiceOrder::class);
    }

    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class);
    }

    public function paidBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'paid_by_user_id');
    }

    public function isPaid(): bool
    {
        return $this->status === CommissionStatusEnum::PAID;
    }

    public function isPending(): bool
    {
        return $this->status === CommissionStatusEnum::PENDING;
    }

    public function markAsPaid(User $paidBy): void
    {
        $this->update([
            'status' => CommissionStatusEnum::PAID,
            'paid_at' => now(),
            'paid_by_user_id' => $paidBy->id,
        ]);
    }

    public function markAsPending(): void
    {
        $this->update([
            'status' => CommissionStatusEnum::PENDING,
            'paid_at' => null,
            'paid_by_user_id' => null,
        ]);
    }

    public function isServiceOrderCommission(): bool
    {
        return $this->type === 'service_order';
    }

    public function isSaleCommission(): bool
    {
        return $this->type === 'sale';
    }

    protected function commissionPercentage(): Attribute
    {
        return Attribute::set(fn (null|string|int|float $value): float => FormatterHelper::toDecimal($value));
    }

    protected function baseValue(): Attribute
    {
        return Attribute::set(fn (null|string|int|float $value): float => FormatterHelper::toDecimal($value));
    }

    protected function commissionAmount(): Attribute
    {
        return Attribute::set(fn (null|string|int|float $value): float => FormatterHelper::toDecimal($value));
    }
}
