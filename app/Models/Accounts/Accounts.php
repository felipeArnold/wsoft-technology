<?php

declare(strict_types=1);

namespace App\Models\Accounts;

use App\Enum\AccountsReceivable\PaymentMethodEnum;
use App\Helpers\FormatterHelper;
use App\Models\Person\Person;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class Accounts extends Model
{
    /** @use HasFactory<\Database\Factories\Accounts\AccountsFactory> */
    use HasFactory;

    protected $casts = [
        'payment_method' => PaymentMethodEnum::class,
        'attachment' => 'array',
        'amount' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'interest_amount' => 'decimal:2',
        'fine_amount' => 'decimal:2',
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

    public function installments(): HasMany
    {
        return $this->hasMany(AccountsInstallments::class, 'accounts_id');
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
