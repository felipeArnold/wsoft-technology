<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\EmailTemplates\Tables;

use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use App\Enum\Template\TemplateContext;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

final class EmailTemplatesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nome')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('context')
                    ->label('Contexto')
                    ->badge()
                    ->sortable(),
                TextColumn::make('subject')
                    ->label('Assunto')
                    ->limit(40)
                    ->searchable(),
                IconColumn::make('is_active')
                    ->boolean()
                    ->label('Ativo'),
                TextColumn::make('updated_at')
                    ->dateTime('d/m/Y H:i')
                    ->label('Atualizado')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('context')
                    ->label('Contexto')
                    ->options(collect(TemplateContext::cases())->mapWithKeys(fn (TemplateContext $context) => [
                        $context->value => $context->getLabel(),
                    ])),
                TernaryFilter::make('is_active')
                    ->label('Ativo'),
            ])
            ->defaultSort('updated_at', 'desc')
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
                FilamentExportBulkAction::make('export')->label('Exportar'),
            ])
            ->striped()
            ->emptyStateIcon('heroicon-o-clipboard-document-list')
            ->emptyStateHeading('Nenhum modelo de e-mail encontrado')
            ->emptyStateDescription('Crie seu primeiro modelo de e-mail para começar a enviar notificações por e-mail.')
            ->emptyStateActions([
                CreateAction::make()
                    ->label('Novo template')
                    ->icon('heroicon-o-plus'),
            ]);
    }
}
