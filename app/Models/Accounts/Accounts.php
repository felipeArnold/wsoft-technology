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
use Illuminate\Support\Carbon;

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
        'due_date' => 'date',
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

    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }

    public function installments(): HasMany
    {
        return $this->hasMany(AccountsInstallments::class, 'accounts_id');
    }

    /**
     * Scope para contas vencidas
     */
    // public function scopeVencidas($query)
    // {
    //     return $query->where('data_vencimento', '<', Carbon::now())
    //         ->whereIn('status', ['aberta', 'parcial']);
    // }

    // /**
    //  * Scope para contas a vencer
    //  */
    // public function scopeAVencer($query, int $dias = 30)
    // {
    //     return $query->whereBetween('data_vencimento', [Carbon::now(), Carbon::now()->addDays($dias)])
    //         ->whereIn('status', ['aberta', 'parcial']);
    // }

    // /**
    //  * Scope para contas do mês
    //  */
    // public function scopeDoMes($query, $anoMes = null)
    // {
    //     $periodo = $anoMes ? Carbon::createFromFormat('Y-m', $anoMes) : Carbon::now();

    //     return $query->whereBetween('data_vencimento', [
    //         $periodo->startOfMonth(),
    //         $periodo->endOfMonth(),
    //     ]);
    // }

    // /**
    //  * Scope para inadimplentes
    //  */
    // public function scopeInadimplentes($query)
    // {
    //     return $query->where('type', 'receivables')
    //         ->where('data_vencimento', '<', Carbon::now())
    //         ->whereIn('status', ['aberta', 'parcial']);
    // }

    // /**
    //  * Scope para contas a pagar
    //  */
    // public function scopeAPagar($query)
    // {
    //     return $query->where('type', 'payables');
    // }

    // /**
    //  * Scope para contas a receber
    //  */
    // public function scopeAReceber($query)
    // {
    //     return $query->where('type', 'receivables');
    // }

    // /**
    //  * Verificar se está vencida
    //  */
    // public function getEstaVencidaAttribute(): bool
    // {
    //     return $this->data_vencimento &&
    //            $this->data_vencimento < Carbon::now() &&
    //            in_array($this->status, ['aberta', 'parcial']);
    // }

    // /**
    //  * Calcular dias em atraso
    //  */
    // public function getDiasAtrasoAttribute(): int
    // {
    //     if (! $this->esta_vencida) {
    //         return 0;
    //     }

    //     return Carbon::now()->diffInDays($this->data_vencimento);
    // }

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
