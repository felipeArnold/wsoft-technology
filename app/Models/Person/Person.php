<?php

declare(strict_types=1);

namespace App\Models\Person;

use App\Filament\Components\CnpjComponent;
use App\Models\Concerns\Categorizable;
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
    use Categorizable;
    use HasFactory;
    use SoftDeletes;

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
                ->description(fn ($get) => mb_strlen(preg_replace('/\D/', '', $get('document') ?? '')) === 14
                    ? 'Informações da empresa'
                    : 'Informações básicas do cliente')
                ->icon(fn ($get) => mb_strlen(preg_replace('/\D/', '', $get('document') ?? '')) === 14
                    ? 'heroicon-o-building-storefront'
                    : 'heroicon-o-user')

                ->schema([
                    Hidden::make('is_client')->default(true),

                    // Campo para CNPJ - usa CnpjComponent com auto-preenchimento
                    CnpjComponent::make('document')
                        ->required()
                        ->columnSpan(1)
                        ->helperText('Digite o CNPJ e pressione Tab para preencher automaticamente')
                        ->visible(fn ($get) => mb_strlen(preg_replace('/\D/', '', $get('document') ?? '')) === 14),

                    // Campo para CPF ou inicial (antes de identificar se é CNPJ)
                    Document::make('document')
                        ->label('CPF/CNPJ')
                        ->dynamic()
                        ->reactive()
                        ->required()
                        ->columnSpan(1)
                        ->visible(fn ($get) => mb_strlen(preg_replace('/\D/', '', $get('document') ?? '')) !== 14),

                    // Campos para CNPJ (Pessoa Jurídica)
                    TextInput::make('name')
                        ->label('Razão Social')
                        ->placeholder('Nome empresarial registrado')
                        ->required()
                        ->maxLength(50)
                        ->columnSpan(2)
                        ->visible(fn ($get) => mb_strlen(preg_replace('/\D/', '', $get('document') ?? '')) === 14),

                    TextInput::make('surname')
                        ->label('Nome Fantasia')
                        ->placeholder('Nome comercial da empresa')
                        ->maxLength(50)
                        ->columnSpan(2)
                        ->visible(fn ($get) => mb_strlen(preg_replace('/\D/', '', $get('document') ?? '')) === 14),

                    DatePicker::make('birth_date')
                        ->label('Data de fundação')
                        ->placeholder('Selecione a data')
                        ->native(false)
                        ->maxDate(now())
                        ->displayFormat('d/m/Y')
                        ->columnSpan(1)
                        ->visible(fn ($get) => mb_strlen(preg_replace('/\D/', '', $get('document') ?? '')) === 14),

                    // Campos para CPF (Pessoa Física)
                    TextInput::make('name')
                        ->label('Nome completo')
                        ->placeholder('Digite o nome completo')
                        ->required()
                        ->maxLength(50)
                        ->columnSpan(2)
                        ->visible(fn ($get) => mb_strlen(preg_replace('/\D/', '', $get('document') ?? '')) !== 14),

                    TextInput::make('surname')
                        ->label('Apelido / Nome social')
                        ->placeholder('Como prefere ser chamado')
                        ->maxLength(50)
                        ->columnSpan(1)
                        ->visible(fn ($get) => mb_strlen(preg_replace('/\D/', '', $get('document') ?? '')) !== 14),

                    DatePicker::make('birth_date')
                        ->label('Data de nascimento')
                        ->placeholder('Selecione a data')
                        ->native(false)
                        ->maxDate(now())
                        ->displayFormat('d/m/Y')
                        ->columnSpan(1)
                        ->visible(fn ($get) => mb_strlen(preg_replace('/\D/', '', $get('document') ?? '')) !== 14),

                    TextInput::make('profession')
                        ->label('Profissão')
                        ->placeholder('Profissão ou ocupação')
                        ->maxLength(50)
                        ->columnSpan(1)
                        ->visible(fn ($get) => mb_strlen(preg_replace('/\D/', '', $get('document') ?? '')) !== 14),

                    TextInput::make('nationality')
                        ->label('Nacionalidade')
                        ->placeholder('Ex: Brasileira')
                        ->maxLength(50)
                        ->columnSpan(1)
                        ->visible(fn ($get) => mb_strlen(preg_replace('/\D/', '', $get('document') ?? '')) !== 14),

                    TextInput::make('naturalness')
                        ->label('Naturalidade')
                        ->placeholder('Cidade de nascimento')
                        ->maxLength(50)
                        ->columnSpan(1)
                        ->visible(fn ($get) => mb_strlen(preg_replace('/\D/', '', $get('document') ?? '')) !== 14),
                ])
                ->columnSpanFull()
                ->columns(3),
            Section::make('Representantes')
                ->description('Representantes comerciais do fornecedor')
                ->icon('heroicon-o-user-group')

                ->schema([
                    SupplierRepresentative::getForm(),
                ])
                ->visible(fn ($get) => mb_strlen(preg_replace('/\D/', '', $get('document') ?? '')) === 14)
                ->columnSpanFull()
                ->columns(1),
            Section::make('Contato')
                ->description('Telefones e e-mails para contato')
                ->icon('heroicon-o-chat-bubble-left-right')

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
                ->columns(2),
            Section::make('Endereços')
                ->description('Endereços do cliente')
                ->icon('heroicon-o-map-pin')

                ->schema([
                    ...Addresses::getForm(),
                ])
                ->columnSpanFull()
                ->columns(1),
        ];
    }

    public static function getFormSuppliers(): array
    {
        return [
            Section::make('Dados do fornecedor')
                ->description('Informações da empresa fornecedora')
                ->icon('heroicon-o-building-storefront')

                ->schema([
                    Hidden::make('is_supplier')->default(true),
                    CnpjComponent::make('document')
                        ->required()
                        ->columnSpan(1)
                        ->helperText('Digite o CNPJ e pressione Tab para preencher automaticamente'),
                    TextInput::make('name')
                        ->label('Razão Social')
                        ->placeholder('Nome empresarial registrado')
                        ->required()
                        ->maxLength(50)
                        ->columnSpan(2),
                    TextInput::make('surname')
                        ->label('Nome Fantasia')
                        ->placeholder('Nome comercial da empresa')
                        ->maxLength(50)
                        ->columnSpan(2),
                    DatePicker::make('birth_date')
                        ->label('Data de fundação')
                        ->placeholder('Selecione a data')
                        ->native(false)
                        ->maxDate(now())
                        ->displayFormat('d/m/Y')
                        ->columnSpan(1),
                ])
                ->columnSpanFull()
                ->columns(3),
            Section::make('Representantes')
                ->description('Representantes comerciais do fornecedor')
                ->icon('heroicon-o-user-group')

                ->schema([
                    SupplierRepresentative::getForm(),
                ])
                ->columnSpanFull()
                ->columns(1),
            Section::make('Contato')
                ->description('Telefones e e-mails para contato')
                ->icon('heroicon-o-chat-bubble-left-right')

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
                ->columns(2),
            Section::make('Endereços')
                ->description('Endereços da empresa')
                ->icon('heroicon-o-map-pin')

                ->schema([
                    ...Addresses::getForm(),
                ])
                ->columnSpanFull()
                ->columns(1),
        ];
    }

    public static function getFormSuppliersSimple(): array
    {
        return [
            Section::make('Dados do fornecedor')
                ->description('Informações da empresa fornecedora')
                ->icon('heroicon-o-building-storefront')
                ->schema([
                    Hidden::make('is_supplier')->default(true),
                    CnpjComponent::make('document')
                        ->required()
                        ->columnSpan(1)
                        ->helperText('Digite o CNPJ e pressione Tab para preencher automaticamente'),
                    TextInput::make('name')
                        ->label('Razão Social')
                        ->placeholder('Nome empresarial registrado')
                        ->required()
                        ->maxLength(50)
                        ->columnSpan(2),
                    TextInput::make('surname')
                        ->label('Nome Fantasia')
                        ->placeholder('Nome comercial da empresa')
                        ->maxLength(50)
                        ->columnSpan(2),
                    DatePicker::make('birth_date')
                        ->label('Data de fundação')
                        ->placeholder('Selecione a data')
                        ->native(false)
                        ->maxDate(now())
                        ->displayFormat('d/m/Y')
                        ->columnSpan(1),
                ])
                ->columnSpanFull()
                ->columns(3)
                ->collapsible(),
        ];
    }

    public static function getFormSimple(): array
    {
        return [
            Section::make('Dados pessoais')
                ->description(fn ($get) => mb_strlen(preg_replace('/\D/', '', $get('document') ?? '')) === 14
                    ? 'Informações da empresa'
                    : 'Informações básicas do cliente')
                ->icon(fn ($get) => mb_strlen(preg_replace('/\D/', '', $get('document') ?? '')) === 14
                    ? 'heroicon-o-building-storefront'
                    : 'heroicon-o-user')
                ->schema([
                    Hidden::make('is_client')->default(true),

                    // Campo para CNPJ - usa CnpjComponent com auto-preenchimento
                    CnpjComponent::make('document')
                        ->required()
                        ->columnSpan(1)
                        ->helperText('Digite o CNPJ e pressione Tab para preencher automaticamente')
                        ->visible(fn ($get) => mb_strlen(preg_replace('/\D/', '', $get('document') ?? '')) === 14),

                    // Campo para CPF ou inicial (antes de identificar se é CNPJ)
                    Document::make('document')
                        ->label('CPF/CNPJ')
                        ->dynamic()
                        ->reactive()
                        ->required()
                        ->columnSpan(1)
                        ->visible(fn ($get) => mb_strlen(preg_replace('/\D/', '', $get('document') ?? '')) !== 14),

                    // Campos para CNPJ (Pessoa Jurídica)
                    TextInput::make('name')
                        ->label('Razão Social')
                        ->placeholder('Nome empresarial registrado')
                        ->required()
                        ->maxLength(50)
                        ->columnSpan(2)
                        ->visible(fn ($get) => mb_strlen(preg_replace('/\D/', '', $get('document') ?? '')) === 14),

                    TextInput::make('surname')
                        ->label('Nome Fantasia')
                        ->placeholder('Nome comercial da empresa')
                        ->maxLength(50)
                        ->columnSpan(2)
                        ->visible(fn ($get) => mb_strlen(preg_replace('/\D/', '', $get('document') ?? '')) === 14),

                    DatePicker::make('birth_date')
                        ->label('Data de fundação')
                        ->placeholder('Selecione a data')
                        ->native(false)
                        ->maxDate(now())
                        ->displayFormat('d/m/Y')
                        ->columnSpan(1)
                        ->visible(fn ($get) => mb_strlen(preg_replace('/\D/', '', $get('document') ?? '')) === 14),

                    // Campos para CPF (Pessoa Física)
                    TextInput::make('name')
                        ->label('Nome completo')
                        ->placeholder('Digite o nome completo')
                        ->required()
                        ->maxLength(50)
                        ->columnSpan(2)
                        ->visible(fn ($get) => mb_strlen(preg_replace('/\D/', '', $get('document') ?? '')) !== 14),

                    TextInput::make('surname')
                        ->label('Apelido / Nome social')
                        ->placeholder('Como prefere ser chamado')
                        ->maxLength(50)
                        ->columnSpan(1)
                        ->visible(fn ($get) => mb_strlen(preg_replace('/\D/', '', $get('document') ?? '')) !== 14),

                    DatePicker::make('birth_date')
                        ->label('Data de nascimento')
                        ->placeholder('Selecione a data')
                        ->native(false)
                        ->maxDate(now())
                        ->displayFormat('d/m/Y')
                        ->columnSpan(1)
                        ->visible(fn ($get) => mb_strlen(preg_replace('/\D/', '', $get('document') ?? '')) !== 14),

                    TextInput::make('profession')
                        ->label('Profissão')
                        ->placeholder('Profissão ou ocupação')
                        ->maxLength(50)
                        ->columnSpan(1)
                        ->visible(fn ($get) => mb_strlen(preg_replace('/\D/', '', $get('document') ?? '')) !== 14),

                    TextInput::make('nationality')
                        ->label('Nacionalidade')
                        ->placeholder('Ex: Brasileira')
                        ->maxLength(50)
                        ->columnSpan(1)
                        ->visible(fn ($get) => mb_strlen(preg_replace('/\D/', '', $get('document') ?? '')) !== 14),

                    TextInput::make('naturalness')
                        ->label('Naturalidade')
                        ->placeholder('Cidade de nascimento')
                        ->maxLength(50)
                        ->columnSpan(1)
                        ->visible(fn ($get) => mb_strlen(preg_replace('/\D/', '', $get('document') ?? '')) !== 14),
                ])
                ->columnSpanFull()
                ->columns(3)
                ->collapsible(),
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

    public function accounts(): HasMany
    {
        return $this->hasMany(\App\Models\Accounts\Accounts::class);
    }

    public function supplierRepresentatives(): HasMany
    {
        return $this->hasMany(SupplierRepresentative::class, 'supplier_id');
    }
}
