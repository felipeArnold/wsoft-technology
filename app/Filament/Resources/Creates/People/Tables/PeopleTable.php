<?php

declare(strict_types=1);

namespace App\Filament\Resources\Creates\People\Tables;

use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use App\Models\Person\Person;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

final class PeopleTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->query(Person::query()->where('is_client', true))
            ->columns([
                TextColumn::make('name')
                    ->label('Nome')
                    ->description(fn ($record) => $record->surname ? 'Apelido: '.$record->surname : null)
                    ->searchable(['name', 'surname'])
                    ->sortable()
                    ->weight('medium')
                    ->toggleable(),
                TextColumn::make('document')
                    ->label('CPF/CNPJ')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->copyMessage('CPF/CNPJ copiado!')
                    ->placeholder('Não informado')
                    ->toggleable(),
                TextColumn::make('phones.number')
                    ->label('Telefone')
                    ->icon('heroicon-m-phone')
                    ->getStateUsing(fn ($record) => $record->phones->first()?->number ?? 'Não informado')
                    ->url(fn ($record) => $record->phones->first() ? 'tel:'.$record->phones->first()->number : null)
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('emails.address')
                    ->label('E-mail')
                    ->icon('heroicon-m-envelope')
                    ->getStateUsing(fn ($record) => $record->emails->first()?->address ?? 'Não informado')
                    ->url(fn ($record) => $record->emails->first() ? 'mailto:'.$record->emails->first()->address : null)
                    ->searchable()
                    ->limit(30)
                    ->tooltip(fn ($record) => $record->emails->first()?->address)
                    ->toggleable(),
                TextColumn::make('addresses.city')
                    ->label('Cidade')
                    ->icon('heroicon-m-map-pin')
                    ->getStateUsing(fn ($record) => $record->addresses->first()
                        ? $record->addresses->first()->city.' - '.$record->addresses->first()->state
                        : 'Não informado')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('birth_date')
                    ->label('Nascimento')
                    ->date('d/m/Y')
                    ->sortable()
                    ->placeholder('Não informado')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('profession')
                    ->label('Profissão')
                    ->searchable()
                    ->sortable()
                    ->placeholder('Não informado')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('nationality')
                    ->label('Nacionalidade')
                    ->sortable()
                    ->placeholder('Não informado')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('naturalness')
                    ->label('Naturalidade')
                    ->sortable()
                    ->placeholder('Não informado')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('categories.name')
                    ->label('Etiquetas')
                    ->badge()
                    ->separator(',')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('created_at')
                    ->label('Cadastrado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Atualizado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->since()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('name', 'asc')
            ->filters([
                TrashedFilter::make(),
                SelectFilter::make('categories')
                    ->label('Etiquetas')
                    ->relationship('categories', 'name')
                    ->searchable()
                    ->multiple()
                    ->preload(),
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
            ->emptyStateHeading('Nenhum cliente encontrado')
            ->emptyStateDescription('Comece criando seu primeiro cliente clicando no botão abaixo')
            ->emptyStateActions([
                CreateAction::make()
                    ->label('Novo Cliente')
                    ->icon('heroicon-o-plus'),
            ])
            ->defaultPaginationPageOption(25);
    }
}
