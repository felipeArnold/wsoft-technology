<?php

declare(strict_types=1);

namespace App\Filament\Resources\Creates\Suppliers\Tables;

use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use App\Models\Person\Person;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class SuppliersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->query(Person::query()->where('is_supplier', true))
            ->columns([
                TextColumn::make('name')
                    ->label('Razão Social')
                    ->description(fn ($record) => $record->document)
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('surname')
                    ->label('Nome Fantasia')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('document')
                    ->label('CNPJ')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('phones.number')
                    ->label('Telefone')
                    ->getStateUsing(fn ($record) => $record->phones->pluck('number')->join(', '))
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('emails.address')
                    ->label('E-mail')
                    ->getStateUsing(fn ($record) => $record->emails->pluck('address')->join(', '))
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('birth_date')
                    ->label('Data de fundação')
                    ->date()
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('addresses.street')
                    ->label('Endereço')
                    ->getStateUsing(fn ($record) => $record->addresses->map(fn ($address) => $address->street.', '.$address->number)->join(' | '))
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('addresses.city')
                    ->label('Cidade')
                    ->getStateUsing(fn ($record) => $record->addresses->pluck('city')->unique()->join(', '))
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('addresses.state')
                    ->label('Estado')
                    ->getStateUsing(fn ($record) => $record->addresses->pluck('state')->unique()->join(', '))
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime()
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('updated_at')
                    ->label('Atualizado em')
                    ->dateTime()
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
                FilamentExportBulkAction::make('export')->label('Exportar'),
            ])
            ->striped()
            ->emptyStateIcon('heroicon-o-shopping-bag')
            ->emptyStateHeading('Nenhum fornecedor encontrado')
            ->emptyStateDescription('Crie uma novo fornecedor para que ele apareça aqui.');
    }
}
