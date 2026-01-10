<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Person\Person;
use App\Observers\VehicleObserver;
use Filament\Facades\Filament;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $tenant_id
 * @property int $person_id
 * @property string $plate
 * @property string $brand
 * @property string $model
 * @property int|null $year
 * @property string|null $color
 * @property string|null $chassis
 * @property string|null $renavam
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read Tenant $tenant
 * @property-read Person $person
 */
#[ObservedBy(VehicleObserver::class)]
final class Vehicle extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'year' => 'integer',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'tenant_id',
        'person_id',
        'plate',
        'brand',
        'model',
        'year',
        'color',
        'chassis',
        'renavam',
        'notes',
    ];

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }

    public function serviceOrders(): HasMany
    {
        return $this->hasMany(ServiceOrder::class);
    }

    /**
     * Get reusable form fields for Vehicle
     *
     * @param bool $includePersonField Whether to include the person_id field
     * @param bool $disablePersonField Whether to disable the person_id field (only applies if includePersonField is true)
     * @param callable|null $personIdDefault Optional callback to set default value for person_id
     * @return array
     */
    public static function getFormFields(bool $includePersonField = true, bool $disablePersonField = false, ?callable $personIdDefault = null): array
    {
        $fields = [];

        if ($includePersonField) {
            if ($disablePersonField && $personIdDefault !== null) {
                // When disabled, show a text field with the person name and a hidden field with the ID
                $fields[] = Hidden::make('person_id')
                    ->default($personIdDefault)
                    ->dehydrated();

                $fields[] = TextInput::make('person_name_display')
                    ->label('Cliente')
                    ->disabled()
                    ->dehydrated(false)
                    ->columnSpan(2)
                    ->helperText('Cliente selecionado anteriormente')
                    ->afterStateHydrated(function ($component) use ($personIdDefault) {
                        $personId = is_callable($personIdDefault) ? $personIdDefault() : null;
                        if ($personId) {
                            $person = Person::find($personId);
                            if ($person) {
                                $component->state($person->name);
                            }
                        }
                    });
            } else {
                $personField = Person::getSelectComponent(
                    label: 'Cliente',
                    placeholder: 'Selecione o cliente',
                    columnSpan: 2,
                    required: !$disablePersonField,
                    modifyQueryUsing: fn ($query) => $query->where('is_client', true)
                );

                if ($personIdDefault !== null) {
                    $personField = $personField->default($personIdDefault);
                }

                $fields[] = $personField;
            }
        }

        return array_merge($fields, [
            TextInput::make('plate')
                ->label('Placa')
                ->required()
                ->placeholder('ABC1234')
                ->maxLength(7)
                ->unique(
                    ignoreRecord: true,
                    modifyRuleUsing: fn ($rule) => $rule->where('tenant_id', Filament::getTenant()->id)
                )
                ->columnSpan(1),
            TextInput::make('brand')
                ->label('Marca')
                ->required()
                ->placeholder('Ex: Volkswagen')
                ->maxLength(50)
                ->columnSpan(1),
            TextInput::make('model')
                ->label('Modelo')
                ->required()
                ->placeholder('Ex: Gol')
                ->maxLength(50)
                ->columnSpan(1),
            TextInput::make('year')
                ->label('Ano')
                ->numeric()
                ->placeholder('Ex: 2023')
                ->minValue(1900)
                ->maxValue((int) date('Y') + 1)
                ->columnSpan(1),
            TextInput::make('color')
                ->label('Cor')
                ->placeholder('Ex: Preto')
                ->maxLength(30)
                ->columnSpan(1),
            TextInput::make('chassis')
                ->label('Chassi')
                ->placeholder('17 caracteres')
                ->maxLength(17)
                ->unique(
                    ignoreRecord: true,
                    modifyRuleUsing: fn ($rule) => $rule->where('tenant_id', Filament::getTenant()->id)
                )
                ->columnSpan(1),
            TextInput::make('renavam')
                ->label('Renavam')
                ->placeholder('11 dígitos')
                ->maxLength(11)
                ->unique(
                    ignoreRecord: true,
                    modifyRuleUsing: fn ($rule) => $rule->where('tenant_id', Filament::getTenant()->id)
                )
                ->columnSpan(1),
            Textarea::make('notes')
                ->label('Observações')
                ->rows(3)
                ->columnSpanFull(),
        ]);
    }
}
