<?php

declare(strict_types=1);

namespace App\Models\Person;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Leandrocfe\FilamentPtbrFormFields\Cep;

/**
 * @property int $id
 * @property string $addressable_type
 * @property int $addressable_id
 * @property string $postal_code
 * @property string $street
 * @property string|null $number
 * @property string|null $complement
 * @property string $district
 * @property string $city
 * @property string $state
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
final class Addresses extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'street',
        'number',
        'complement',
        'district',
        'city',
        'state',
        'postal_code',
        'morphs',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    public static function getForm(): array
    {
        return [
            Repeater::make('addresses')
                ->label('Endereços')
                ->relationship()
                ->schema([
                    Cep::make('postal_code')
                        ->label('CEP')
                        ->placeholder('00000-000')
                        ->live(onBlur: true)
                        ->viaCep(
                            mode: 'suffix',
                            errorMessage: 'CEP inválido. Verifique e tente novamente.',
                            setFields: [
                                'street' => 'logradouro',
                                'number' => 'numero',
                                'complement' => 'complemento',
                                'district' => 'bairro',
                                'city' => 'localidade',
                                'state' => 'uf',
                            ]
                        )
                        ->required()
                        ->columnSpan(1),
                    TextInput::make('street')
                        ->label('Logradouro')
                        ->placeholder('Rua, Avenida, etc.')
                        ->required()
                        ->maxLength(50)
                        ->columnSpan(2),
                    TextInput::make('number')
                        ->label('Número')
                        ->placeholder('Nº')
                        ->required()
                        ->maxLength(10)
                        ->columnSpan(1),
                    TextInput::make('complement')
                        ->label('Complemento')
                        ->placeholder('Apto, Bloco, Sala, etc.')
                        ->maxLength(50)
                        ->columnSpan(2),
                    TextInput::make('district')
                        ->label('Bairro')
                        ->placeholder('Nome do bairro')
                        ->required()
                        ->maxLength(50)
                        ->columnSpan(1),
                    TextInput::make('city')
                        ->label('Cidade')
                        ->placeholder('Nome da cidade')
                        ->required()
                        ->maxLength(50)
                        ->columnSpan(1),
                    TextInput::make('state')
                        ->label('Estado (UF)')
                        ->placeholder('Ex: SP, RJ, MG')
                        ->required()
                        ->maxLength(2)
                        ->columnSpan(1),
                ])
                ->columns(3)
                ->addActionLabel('Adicionar endereço')
                ->collapsible()
                ->cloneable()
                ->reorderable()
                ->itemLabel(fn (array $state): ?string => isset($state['street'], $state['number'])
                    ? $state['street'].', '.$state['number']
                    : 'Novo endereço'
                )
                ->defaultItems(0),
        ];
    }
}
