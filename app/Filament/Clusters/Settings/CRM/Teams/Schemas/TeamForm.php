<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\CRM\Teams\Schemas;

use App\Models\Funnel;
use Filament\Facades\Filament;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

final class TeamForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informações da Equipe')
                    ->schema([
                        Toggle::make('active')
                            ->label('Ativa')
                            ->default(true)
                            ->inline(false)
                            ->columnSpanFull(),
                        TextInput::make('name')
                            ->label('Nome')
                            ->required()
                            ->maxLength(255),
                        Select::make('funnel_id')
                            ->label('Funil')
                            ->options(function () {
                                $tenant = Filament::getTenant();
                                if (! $tenant) {
                                    return [];
                                }

                                return Funnel::query()->where('tenant_id', $tenant->id)
                                    ->where('active', true)
                                    ->pluck('name', 'id')
                                    ->toArray();
                            })
                            ->searchable()
                            ->nullable()
                            ->helperText('Selecione o funil que esta equipe utilizará'),
                        Textarea::make('description')
                            ->label('Descrição')
                            ->rows(3)
                            ->columnSpanFull(),

                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                Section::make('Membros da Equipe')
                    ->schema([
                        CheckboxList::make('users')
                            ->label('Usuários')
                            ->relationship('users', 'name')
                            ->options(function () {
                                $tenant = Filament::getTenant();
                                if (! $tenant) {
                                    return [];
                                }

                                return $tenant->users()
                                    ->select('users.id', 'users.name')
                                    ->pluck('users.name', 'users.id')
                                    ->toArray();
                            })
                            ->searchable()
                            ->bulkToggleable()
                            ->columns(2)
                            ->gridDirection('row'),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
