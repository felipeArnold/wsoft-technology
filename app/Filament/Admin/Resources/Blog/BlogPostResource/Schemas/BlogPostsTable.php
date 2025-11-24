<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Blog\BlogPostResource\Schemas;

use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

final class BlogPostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('featured_image')
                    ->label('Imagem')
                    ->circular()
                    ->size(40),

                TextColumn::make('title')
                    ->label('Título')
                    ->searchable()
                    ->sortable()
                    ->limit(50)
                    ->tooltip(fn ($record) => $record->title),

                TextColumn::make('category.name')
                    ->label('Categoria')
                    ->sortable()
                    ->badge()
                    ->color('gray'),

                TextColumn::make('author.name')
                    ->label('Autor')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'draft' => 'Rascunho',
                        'published' => 'Publicado',
                        'scheduled' => 'Agendado',
                        default => $state,
                    })
                    ->color(fn ($state) => match ($state) {
                        'draft' => 'warning',
                        'published' => 'success',
                        'scheduled' => 'info',
                        default => 'gray',
                    }),

                IconColumn::make('is_featured')
                    ->label('Destaque')
                    ->boolean()
                    ->trueIcon('heroicon-o-star')
                    ->falseIcon('heroicon-o-star')
                    ->trueColor('warning')
                    ->falseColor('gray'),

                TextColumn::make('view_count')
                    ->label('Views')
                    ->sortable()
                    ->numeric()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('published_at')
                    ->label('Publicado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'draft' => 'Rascunho',
                        'published' => 'Publicado',
                        'scheduled' => 'Agendado',
                    ]),

                SelectFilter::make('category_id')
                    ->label('Categoria')
                    ->relationship('category', 'name')
                    ->preload(),

                TernaryFilter::make('is_featured')
                    ->label('Destaque'),

                TrashedFilter::make(),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
