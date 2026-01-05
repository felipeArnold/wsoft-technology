<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\Services\Schemas;

use App\Filament\Components\PtbrMoney;
use Filament\Facades\Filament;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Validation\Rule;

final class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informações do Serviço')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nome')
                            ->required()
                            ->maxLength(255)
                            ->unique(
                                table: 'services',
                                column: 'name',
                                ignoreRecord: true,
                                modifyRuleUsing: fn ($rule) => $rule->where('tenant_id', Filament::getTenant()->id)
                            )
                            ->validationMessages([
                                'unique' => 'Já existe um serviço com este nome.',
                            ]),
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

                    ])
                    ->columns(3)
                    ->columnSpanFull(),
            ]);
    }
}
