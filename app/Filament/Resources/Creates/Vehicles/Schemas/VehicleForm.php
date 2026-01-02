<?php

declare(strict_types=1);

namespace App\Filament\Resources\Creates\Vehicles\Schemas;

use App\Models\Person\Person;
use Filament\Facades\Filament;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

final class VehicleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informações do Veículo')
                    ->icon('heroicon-o-truck')
                    ->schema([
                        Select::make('person_id')
                            ->label('Cliente')
                            ->relationship(
                                'person',
                                'name',
                                fn ($query) => $query->where('is_client', true)
                            )
                            ->searchable()
                            ->preload()
                            ->required()
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->label('Nome do Cliente')
                                    ->required()
                                    ->maxLength(50),
                                TextInput::make('document')
                                    ->label('CPF/CNPJ')
                                    ->required()
                                    ->maxLength(14),
                            ])
                            ->createOptionUsing(function (array $data): int {
                                $person = Person::create([
                                    'tenant_id' => Filament::getTenant()->id,
                                    'is_client' => true,
                                    'name' => $data['name'],
                                    'document' => $data['document'],
                                ]);

                                return $person->id;
                            })
                            ->columnSpan(2),
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
                            ->maxValue(date('Y') + 1)
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
                    ])
                    ->columns(3)
                    ->columnSpanFull(),
            ]);
    }
}
