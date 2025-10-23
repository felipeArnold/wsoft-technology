<?php

declare(strict_types=1);

namespace App\Models\Person;

use App\Models\Tenant;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Leandrocfe\FilamentPtbrFormFields\Document;

/**
 * @property int $id
 * @property int $tenant_id
 * @property string $name
 * @property string $type
 * @property string|null $surname
 * @property string|null $document
 * @property \Illuminate\Support\Carbon|null $birth_date
 * @property string|null $nationality
 * @property string|null $naturalness
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read Tenant $tenant
 */
final class Person extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'birth_date' => 'date',
    ];

    public static function getForm(): array
    {
        return [
            Section::make('Dados pessoais')
                ->description('Insira os dados pessoais do cliente')
                ->collapsible()
                ->schema([
                    Hidden::make('is_client')->default(true),
                    TextInput::make('name')
                        ->label('Nome')
                        ->rules([
                            'required',
                            'max:50',
                        ]),
                    TextInput::make('surname')
                        ->label('Apelido')
                        ->rules([
                            'nullable',
                            'max:50',
                        ]),
                    Document::make('document')
                        ->label('CPF/CNPJ')
                        ->dynamic()
                        ->columnSpan(1),
                    DatePicker::make('birth_date')
                        ->label('Data de nascimento')
                        ->native(false)
                        ->rules([
                            'nullable',
                            'date',
                            'before:today',
                        ]),
                    TextInput::make('nationality')
                        ->label('Nacionalidade')
                        ->rules([
                            'nullable',
                            'max:50',
                        ]),
                    TextInput::make('naturalness')
                        ->label('Naturalidade')
                        ->rules([
                            'nullable',
                            'max:50',
                        ]),
                    TextInput::make('profession')
                        ->label('Profissão')
                        ->rules([
                            'nullable',
                            'max:50',
                        ]),
                ])
                ->columnSpanFull()
                ->columns(3)
                ->grow(true),
            Section::make('Contato')
                ->description('Dados de contato do fornecedor')
                ->schema([
                    Section::make('Telefones')
                        ->icon('heroicon-o-phone')
                        ->schema([Phones::getForm()])
                        ->columnSpanFull(),
                    Section::make('E-mails')
                        ->icon('heroicon-o-envelope')
                        ->schema([Emails::getForm()])
                        ->columnSpanFull(),
                ])
                ->columnSpanFull()
                ->columns(2)
                ->grow(true),
            Section::make('Endereços')
                ->description('Endereços do cliente')
                ->collapsible()
                ->schema([
                    ...Addresses::getForm(),
                ])
                ->columnSpanFull()
                ->columns(1)
                ->grow(true),
        ];
    }

    public static function getFormSuppliers(): array
    {
        return [
            Section::make('Dados do fornecedor')
                ->description('Insira os dados do fornecedor')
                ->collapsible()
                ->schema([
                    Hidden::make('is_supplier')->default(true),
                    Document::make('document')
                        ->label('CNPJ')
                        ->cnpj()
                        ->columnSpan(1),
                    TextInput::make('name')
                        ->label('Razão Social')
                        ->rules([
                            'required',
                            'max:50',
                        ]),
                    TextInput::make('surname')
                        ->label('Nome Fantasia')
                        ->rules([
                            'nullable',
                            'max:50',
                        ]),
                    DatePicker::make('birth_date')
                        ->label('Data de fundação')
                        ->native(false)
                        ->rules([
                            'nullable',
                            'date',
                            'before:today',
                        ]),
                ])
                ->columnSpanFull()
                ->columns(3)
                ->grow(true),
            Section::make('Contato')
                ->description('Dados de contato do fornecedor')
                ->schema([
                    Section::make('Telefones')
                        ->icon('heroicon-o-phone')
                        ->schema([Phones::getForm()])
                        ->columnSpanFull(),
                    Section::make('E-mails')
                        ->icon('heroicon-o-envelope')
                        ->schema([Emails::getForm()])
                        ->columnSpanFull(),
                ])
                ->columnSpanFull()
                ->columns(2)
                ->grow(true),
            Section::make('Endereços')
                ->description('Endereços do fornecedor')
                ->collapsible()
                ->schema([
                    ...Addresses::getForm(),
                ])
                ->columnSpanFull()
                ->columns(1)
                ->grow(true),
        ];
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function phones(): MorphMany
    {
        return $this->morphMany(Phones::class, 'phonable');
    }

    public function addresses(): MorphMany
    {
        return $this->morphMany(Addresses::class, 'addressable');
    }

    public function emails(): MorphMany
    {
        return $this->morphMany(Emails::class, 'emailable');
    }

    public function servicesOrders(): HasMany
    {
        return $this->hasMany(\App\Models\ServiceOrder::class);
    }
}
