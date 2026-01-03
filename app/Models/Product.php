<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Concerns\Categorizable;
use App\Models\Person\Person;
use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

final class Product extends Model
{
    /** @use HasFactory<ProductFactory> */
    use Categorizable;

    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['net_profit', 'profit_margin'];

    protected $casts = [
        'price_sale' => 'float',
        'price_cost' => 'float',
        'average_cost' => 'float',
        'net_profit' => 'float',
        'profit_margin' => 'float',
        'stock' => 'integer',
        'stock_alert' => 'integer',
        'attachment' => 'array',
    ];

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class, 'person_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function stockMovements(): HasMany
    {
        return $this->hasMany(StockMovement::class);
    }

    public function saleItems(): HasMany
    {
        return $this->hasMany(SaleItem::class);
    }
}
