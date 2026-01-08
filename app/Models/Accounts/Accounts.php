<?php

declare(strict_types=1);

namespace App\Models\Accounts;

use App\Enum\AccountsReceivable\PaymentMethodEnum;
use App\Helpers\FormatterHelper;
use App\Models\Category;
use App\Models\Person\Person;
use App\Models\ServiceOrder;
use App\Models\Tenant;
use App\Models\User;
use App\Observers\Accounts\AccountsObserver;
use Database\Factories\Accounts\AccountsFactory;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

#[ObservedBy(AccountsObserver::class)]
final class Accounts extends Model
{
    /** @use HasFactory<AccountsFactory> */
    use HasFactory;

    protected $casts = [
        'payment_method' => PaymentMethodEnum::class,
        'attachment' => 'array',
        'amount' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'interest_amount' => 'decimal:2',
        'fine_amount' => 'decimal:2',
        'due_date' => 'date',
        'paid_at' => 'datetime',
    ];

    public static function getTableColumns(): array
    {
        return [
            TextColumn::make('parcels')
                ->label('Parcelas')
                ->badge()
                ->formatStateUsing(fn ($state) => $state.' x'),
            TextColumn::make('amount')
                ->label('Valor')
                ->money('BRL')
                ->sortable(),
            TextColumn::make('status')
                ->label('Status')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'paid' => 'success',
                    'open' => 'warning',
                    'overdue' => 'danger',
                    'partial' => 'info',
                    default => 'gray',
                }),
            TextColumn::make('payment_method')
                ->label('Forma de Pagamento')
                ->placeholder('—'),
            TextColumn::make('categories.name')
                ->label('Categorias')
                ->badge()
                ->color('gray')
                ->searchable()
                ->separator(',')
                ->placeholder('—'),
        ];
    }

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

    public function serviceOrder(): BelongsTo
    {
        return $this->belongsTo(ServiceOrder::class);
    }

    public function installments(): HasMany
    {
        return $this->hasMany(AccountsInstallments::class, 'accounts_id');
    }

    public function categories(): MorphToMany
    {
        return $this->morphToMany(Category::class, 'categorizable');
    }

    protected function amount(): Attribute
    {
        return Attribute::set(fn (null|string|int|float $value): float => FormatterHelper::toDecimal($value));
    }

    protected function discountAmount(): Attribute
    {
        return Attribute::set(fn (null|string|int|float $value): float => FormatterHelper::toDecimal($value));
    }

    protected function interestAmount(): Attribute
    {
        return Attribute::set(fn (null|string|int|float $value): float => FormatterHelper::toDecimal($value));
    }

    protected function fineAmount(): Attribute
    {
        return Attribute::set(fn (null|string|int|float $value): float => FormatterHelper::toDecimal($value));
    }
}
