<?php

declare(strict_types=1);

namespace App\Filament\Resources\Suggestions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

final class SuggestionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Título')
                    ->searchable()
                    ->sortable()
                    ->limit(50),

                BadgeColumn::make('type')
                    ->label('Tipo')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'suggestion' => 'Sugestão',
                        'improvement' => 'Melhoria',
                        default => $state,
                    })
                    ->colors([
                        'primary' => 'suggestion',
                        'info' => 'improvement',
                    ]),

                BadgeColumn::make('status')
                    ->label('Status')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'Pendente',
                        'in_review' => 'Em Análise',
                        'approved' => 'Aprovado',
                        'rejected' => 'Rejeitado',
                        'implemented' => 'Implementado',
                        default => $state,
                    })
                    ->colors([
                        'warning' => 'pending',
                        'info' => 'in_review',
                        'success' => 'approved',
                        'danger' => 'rejected',
                        'success' => 'implemented',
                    ]),

                TextColumn::make('user.name')
                    ->label('Usuário')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->label('Tipo')
                    ->options([
                        'suggestion' => 'Sugestão',
                        'improvement' => 'Melhoria',
                    ]),

                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pendente',
                        'in_review' => 'Em Análise',
                        'approved' => 'Aprovado',
                        'rejected' => 'Rejeitado',
                        'implemented' => 'Implementado',
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
