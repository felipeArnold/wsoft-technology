<?php

declare(strict_types=1);

namespace App\Filament\Resources\Services\DigitalSignature\Envelopes\Tables;

use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

final class EnvelopesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nome')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'draft' => 'gray',
                        'sent' => 'warning',
                        'signed' => 'success',
                        'expired' => 'danger',
                        'cancelled' => 'danger',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'draft' => 'Rascunho',
                        'sent' => 'Enviado',
                        'signed' => 'Assinado',
                        'expired' => 'Expirado',
                        'cancelled' => 'Cancelado',
                    }),
                TextColumn::make('deadline')
                    ->label('Prazo')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('signers_count')
                    ->label('Signatários')
                    ->counts('signers')
                    ->badge()
                    ->color('primary'),
                TextColumn::make('user.name')
                    ->label('Criado por')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
                FilamentExportBulkAction::make('export')->label('Exportar'),
            ])
            ->striped()
            ->emptyStateIcon('heroicon-o-inbox')
            ->emptyStateHeading('Nenhum envelope encontrado')
            ->emptyStateDescription('Crie um novo envelope para começar a enviar documentos para assinatura.')
            ->emptyStateActions([
                Action::make('create')
                    ->label('Criar Envelope')
                    ->url('envelopes/create')
                    ->icon('heroicon-o-plus'),
            ]);
    }
}
