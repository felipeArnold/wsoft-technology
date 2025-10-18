<?php

declare(strict_types=1);

namespace App\Filament\Resources\Creates\People\Tables;

use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

final class PeopleTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nome')
                    ->description(fn ($record) => $record->document)
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('surname')
                    ->label('Apelido')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('document')
                    ->label('Documento')
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
                    ->label('Data de nascimento')
                    ->date()
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('nationality')
                    ->label('Nacionalidade')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('naturalness')
                    ->label('Naturalidade')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('profession')
                    ->label('Profissão')
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
                TrashedFilter::make(),
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
            ->emptyStateIcon('heroicon-o-users')
            ->emptyStateHeading('Nenhuma pessoa encontrada')
            ->emptyStateDescription('Crie uma nova pessoa clicando no botão abaixo');
    }
}
