<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\SuggestionResource\Pages;
use App\Models\Suggestion;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section as SchemaSection;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class SuggestionResource extends Resource
{
    protected static ?string $model = Suggestion::class;

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-light-bulb';
    }

    public static function getNavigationLabel(): string
    {
        return 'Sugestões';
    }

    public static function getModelLabel(): string
    {
        return 'Sugestão';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Sugestões';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Sistema';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                SchemaSection::make('Informações da Sugestão')
                    ->schema([
                        TextInput::make('title')
                            ->label('Título')
                            ->required()
                            ->maxLength(255)
                            ->disabled(),

                        Select::make('type')
                            ->label('Tipo')
                            ->options([
                                'feature' => 'Nova Funcionalidade',
                                'improvement' => 'Melhoria',
                                'bug' => 'Correção de Bug',
                                'other' => 'Outro',
                            ])
                            ->required()
                            ->disabled(),

                        Textarea::make('description')
                            ->label('Descrição')
                            ->rows(5)
                            ->columnSpanFull()
                            ->disabled(),
                    ])
                    ->columns(2),

                SchemaSection::make('Informações do Usuário')
                    ->schema([
                        TextInput::make('user.name')
                            ->label('Usuário')
                            ->disabled(),

                        TextInput::make('tenant.name')
                            ->label('Empresa')
                            ->disabled(),
                    ])
                    ->columns(2),

                SchemaSection::make('Status e Notas do Admin')
                    ->schema([
                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'pending' => 'Pendente',
                                'in_review' => 'Em Análise',
                                'approved' => 'Aprovada',
                                'rejected' => 'Rejeitada',
                                'implemented' => 'Implementada',
                            ])
                            ->required()
                            ->default('pending'),

                        Textarea::make('admin_notes')
                            ->label('Notas do Administrador')
                            ->rows(4)
                            ->columnSpanFull(),
                    ])
                    ->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('title')
                    ->label('Título')
                    ->searchable()
                    ->sortable()
                    ->limit(50),

                TextColumn::make('type')
                    ->label('Tipo')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'feature' => 'success',
                        'improvement' => 'info',
                        'bug' => 'danger',
                        'other' => 'gray',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'feature' => 'Nova Funcionalidade',
                        'improvement' => 'Melhoria',
                        'bug' => 'Correção de Bug',
                        'other' => 'Outro',
                        default => $state,
                    })
                    ->sortable(),

                TextColumn::make('user.name')
                    ->label('Usuário')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('tenant.name')
                    ->label('Empresa')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'gray',
                        'in_review' => 'info',
                        'approved' => 'success',
                        'rejected' => 'danger',
                        'implemented' => 'primary',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'Pendente',
                        'in_review' => 'Em Análise',
                        'approved' => 'Aprovada',
                        'rejected' => 'Rejeitada',
                        'implemented' => 'Implementada',
                        default => $state,
                    })
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label('Tipo')
                    ->options([
                        'feature' => 'Nova Funcionalidade',
                        'improvement' => 'Melhoria',
                        'bug' => 'Correção de Bug',
                        'other' => 'Outro',
                    ]),

                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pendente',
                        'in_review' => 'Em Análise',
                        'approved' => 'Aprovada',
                        'rejected' => 'Rejeitada',
                        'implemented' => 'Implementada',
                    ]),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSuggestions::route('/'),
            'view' => Pages\ViewSuggestion::route('/{record}'),
            'edit' => Pages\EditSuggestion::route('/{record}/edit'),
        ];
    }
}
