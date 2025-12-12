<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class ServiceOrderService extends Model
{
    use HasFactory;

    protected $casts = [
        'quantity' => 'integer',
        'unit_price' => 'float',
        'discount' => 'float',
        'total' => 'float',
    ];

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function serviceOrder(): BelongsTo
    {
        return $this->belongsTo(ServiceOrder::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    protected static function booted(): void
    {
        self::saving(function (ServiceOrderService $item): void {
            $item->total = ($item->unit_price * $item->quantity) - $item->discount;
        });
    }
}
