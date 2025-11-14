<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section as SchemaSection;
use Filament\Schemas\Components\TextInput as SchemaTextInput;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class UserResource extends Resource
{
    protected static ?string $model = User::class;

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-users';
    }

    public static function getNavigationLabel(): string
    {
        return 'Usuários';
    }

    public static function getModelLabel(): string
    {
        return 'Usuário';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Usuários';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Clientes';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                SchemaSection::make('Informações do Usuário')
                    ->schema([
                        SchemaTextInput::make('name')
                            ->label('Nome')
                            ->required()
                            ->maxLength(255),
                        SchemaTextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                    ])
                    ->columns(2),
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
                TextColumn::make('name')
                    ->label('Nome')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('tenants.name')
                    ->label('Empresas')
                    ->badge()
                    ->searchable(),
                TextColumn::make('email_verified_at')
                    ->label('Email Verificado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('id', 'desc');
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
