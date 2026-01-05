<?php

declare(strict_types=1);

namespace App\Models;

use App\Filament\Components\PtbrMoney;
use App\Models\Concerns\Categorizable;
use App\Models\Person\Person;
use Database\Factories\ProductFactory;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
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

    public static function getFormFields(bool $useRelationship = true): array
    {
        $categoryField = Select::make('category_id')
            ->label('Categoria')
            ->searchable()
            ->preload()
            ->columnSpan(1);

        if ($useRelationship) {
            $categoryField->relationship('category', 'name');
        } else {
            $categoryField->options(fn () => Category::pluck('name', 'id'));
        }

        return [
            TextInput::make('name')
                ->label('Nome do Produto')
                ->required()
                ->maxLength(255)
                ->columnSpan(2),
            $categoryField,
            TextInput::make('sku')
                ->label('Código SKU')
                ->maxLength(50)
                ->columnSpan(1),
            PtbrMoney::make('price_cost')
                ->label('Valor de Custo')
                ->default('0,00')
                ->columnSpan(1),
            PtbrMoney::make('price_sale')
                ->label('Valor de Venda')
                ->default('0,00')
                ->required()
                ->columnSpan(1),
        ];
    }

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
