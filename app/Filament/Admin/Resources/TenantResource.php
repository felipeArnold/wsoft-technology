<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\TenantResource\Pages;
use App\Models\Tenant;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section as SchemaSection;
use Filament\Schemas\Components\TextInput as SchemaTextInput;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class TenantResource extends Resource
{
    protected static ?string $model = Tenant::class;

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-building-office';
    }

    public static function getNavigationLabel(): string
    {
        return 'Empresas';
    }

    public static function getModelLabel(): string
    {
        return 'Empresa';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Empresas';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Clientes';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                SchemaSection::make('Informações da Empresa')
                    ->schema([
                        SchemaTextInput::make('name')
                            ->label('Nome')
                            ->required()
                            ->maxLength(255),
                        SchemaTextInput::make('slug')
                            ->label('Slug')
                            ->disabled()
                            ->dehydrated(false),
                        SchemaTextInput::make('document')
                            ->label('CNPJ/CPF')
                            ->maxLength(18),
                        SchemaTextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->maxLength(255),
                        SchemaTextInput::make('phone')
                            ->label('Telefone')
                            ->tel()
                            ->maxLength(20),
                    ])
                    ->columns(2),

                SchemaSection::make('Endereço')
                    ->schema([
                        SchemaTextInput::make('zip_code')
                            ->label('CEP')
                            ->maxLength(9),
                        SchemaTextInput::make('street')
                            ->label('Rua')
                            ->maxLength(255),
                        SchemaTextInput::make('number')
                            ->label('Número')
                            ->maxLength(10),
                        SchemaTextInput::make('complement')
                            ->label('Complemento')
                            ->maxLength(255),
                        SchemaTextInput::make('neighborhood')
                            ->label('Bairro')
                            ->maxLength(255),
                        SchemaTextInput::make('city')
                            ->label('Cidade')
                            ->maxLength(255),
                        SchemaTextInput::make('state')
                            ->label('Estado')
                            ->maxLength(2),
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
                TextColumn::make('slug')
                    ->label('Slug')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('document')
                    ->label('CNPJ/CPF')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('members_count')
                    ->label('Usuários')
                    ->counts('members')
                    ->sortable(),
                TextColumn::make('subscriptions.stripe_status')
                    ->label('Status Assinatura')
                    ->badge()
                    ->color(fn (?string $state): string => match ($state) {
                        'active' => 'success',
                        'trialing' => 'info',
                        'canceled' => 'danger',
                        'past_due' => 'warning',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'active' => 'Ativa',
                        'trialing' => 'Período de Teste',
                        'canceled' => 'Cancelada',
                        'past_due' => 'Vencida',
                        'incomplete' => 'Incompleta',
                        'incomplete_expired' => 'Expirada',
                        default => 'Sem assinatura',
                    })
                    ->toggleable(),
                TextColumn::make('subscriptions.trial_ends_at')
                    ->label('Fim do Teste')
                    ->dateTime('d/m/Y H:i')
                    ->toggleable(),
                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListTenants::route('/'),
            'create' => Pages\CreateTenant::route('/create'),
            'view' => Pages\ViewTenant::route('/{record}'),
            'edit' => Pages\EditTenant::route('/{record}/edit'),
        ];
    }
}
