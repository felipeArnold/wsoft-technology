<?php

declare(strict_types=1);

namespace App\Filament\Resources\AI\AIGenerations\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

final class AIGenerationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('type')
                    ->label('Tipo')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'blog_post' => 'Post de Blog',
                        'blog_post_improvement' => 'Melhoria de Post',
                        'seo_metadata' => 'SEO Metadata',
                        'multiple_posts' => 'Múltiplos Posts',
                        default => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'blog_post' => 'success',
                        'blog_post_improvement' => 'info',
                        'seo_metadata' => 'warning',
                        'multiple_posts' => 'primary',
                        default => 'gray',
                    })
                    ->sortable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'Pendente',
                        'processing' => 'Processando',
                        'completed' => 'Concluído',
                        'failed' => 'Falhou',
                        default => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'gray',
                        'processing' => 'warning',
                        'completed' => 'success',
                        'failed' => 'danger',
                        default => 'gray',
                    })
                    ->sortable(),

                TextColumn::make('user.name')
                    ->label('Usuário')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('blogPost.title')
                    ->label('Post')
                    ->limit(30)
                    ->sortable()
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('tokens_used')
                    ->label('Tokens')
                    ->numeric()
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('formatted_cost')
                    ->label('Custo')
                    ->sortable(query: function ($query, $direction) {
                        return $query->orderBy('estimated_cost', $direction);
                    })
                    ->toggleable(),

                TextColumn::make('processing_time')
                    ->label('Tempo')
                    ->sortable(query: function ($query, $direction) {
                        return $query->orderBy('processing_time_ms', $direction);
                    })
                    ->toggleable(),

                TextColumn::make('retry_attempts')
                    ->label('Tentativas')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->label('Tipo')
                    ->options([
                        'blog_post' => 'Post de Blog',
                        'blog_post_improvement' => 'Melhoria de Post',
                        'seo_metadata' => 'SEO Metadata',
                        'multiple_posts' => 'Múltiplos Posts',
                    ]),

                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pendente',
                        'processing' => 'Processando',
                        'completed' => 'Concluído',
                        'failed' => 'Falhou',
                    ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
