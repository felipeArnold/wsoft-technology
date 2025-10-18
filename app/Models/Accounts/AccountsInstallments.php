<?php

declare(strict_types=1);

namespace App\Models\Accounts;

use App\Enum\AccountsReceivable\PaymentStatusEnum;
use App\Helpers\FormatterHelper;
use App\Models\Tenant;
use App\Observers\Accounts\AccountsInstallmentsObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[ObservedBy(AccountsInstallmentsObserver::class)]
final class AccountsInstallments extends Model
{
    protected $casts = [
        'installment_number' => 'integer',
        'amount' => 'decimal:2',
        'due_date' => 'date',
        'paid_at' => 'datetime',
        'status' => PaymentStatusEnum::class,
    ];

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function accounts(): HasOne
    {
        return $this->hasOne(Accounts::class, 'id', 'accounts_id');
    }

    protected function amount(): Attribute
    {
        return Attribute::set(fn (null|string|int|float $value): float => FormatterHelper::toDecimal($value));
    }
}
