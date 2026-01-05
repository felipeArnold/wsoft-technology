<?php

declare(strict_types=1);

namespace App\Models;

use App\Filament\Components\PtbrMoney;
use Filament\Facades\Filament;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

final class Service extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'tenant_id',
        'name',
        'description',
        'price',
        'discount',
    ];

    protected $casts = [
        'price' => 'float',
        'discount' => 'float',
    ];

    public static function getFormFields(bool $withUniqueValidation = true): array
    {
        $nameField = TextInput::make('name')
            ->label('Nome')
            ->required()
            ->maxLength(255);

        if ($withUniqueValidation) {
            $nameField
                ->unique(
                    table: 'services',
                    column: 'name',
                    ignoreRecord: true,
                    modifyRuleUsing: fn ($rule) => $rule->where('tenant_id', Filament::getTenant()->id)
                )
                ->validationMessages([
                    'unique' => 'Já existe um serviço com este nome.',
                ]);
        }

        return [
            $nameField,
            PtbrMoney::make('price')
                ->label('Preço')
                ->default('0,00')
                ->required(),
            PtbrMoney::make('discount')
                ->label('Desconto')
                ->default('0,00'),
            Textarea::make('description')
                ->label('Descrição')
                ->rows(3)
                ->columnSpanFull(),
        ];
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }
}
