<?php

declare(strict_types=1);

namespace App\Filament\Resources\Creates\People\RelationManagers;

use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Facades\Filament;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class VehiclesRelationManager extends RelationManager
{
    protected static string $relationship = 'vehicles';

    protected static ?string $label = 'Veículos';

    protected static ?string $title = 'Veículos';

    protected static string|BackedEnum|null $icon = Heroicon::OutlinedTruck;

    public static function canViewForRecord(mixed $ownerRecord, string $pageClass): bool
    {
        $tenant = Filament::getTenant();

        if ($tenant === null) {
            return false;
        }

        return $tenant->type->isAutomotive();
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informações do Veículo')
                    ->icon('heroicon-o-truck')
                    ->schema([
                        TextInput::make('plate')
                            ->label('Placa')
                            ->required()
                            ->placeholder('ABC1234')
                            ->maxLength(7)
                            ->unique(ignoreRecord: true)
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
                            ->unique(ignoreRecord: true)
                            ->columnSpan(1),
                        TextInput::make('renavam')
                            ->label('Renavam')
                            ->placeholder('11 dígitos')
                            ->maxLength(11)
                            ->unique(ignoreRecord: true)
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

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('plate')
            ->columns([
                TextColumn::make('plate')
                    ->label('Placa')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->copyable(),
                TextColumn::make('brand')
                    ->label('Marca')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('model')
                    ->label('Modelo')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('year')
                    ->label('Ano')
                    ->sortable()
                    ->placeholder('N/A'),
                TextColumn::make('color')
                    ->label('Cor')
                    ->searchable()
                    ->placeholder('N/A'),
                TextColumn::make('chassis')
                    ->label('Chassi')
                    ->searchable()
                    ->placeholder('N/A')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('Novo Veículo')
                    ->icon('heroicon-o-plus'),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateIcon('heroicon-o-truck')
            ->emptyStateHeading('Nenhum veículo cadastrado')
            ->emptyStateDescription('Cadastre o primeiro veículo deste cliente.');
    }
}
