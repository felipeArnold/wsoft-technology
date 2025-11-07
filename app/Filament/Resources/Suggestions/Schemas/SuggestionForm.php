<?php

declare(strict_types=1);

namespace App\Filament\Resources\Suggestions\Schemas;

use Filament\Facades\Filament;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SuggestionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informações da Sugestão')
                    ->schema([
                        Select::make('type')
                            ->label('Tipo')
                            ->options([
                                'suggestion' => 'Sugestão',
                                'improvement' => 'Melhoria',
                            ])
                            ->required()
                            ->default('suggestion')
                            ->columnSpanFull(),

                        TextInput::make('title')
                            ->label('Título')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Textarea::make('description')
                            ->label('Descrição')
                            ->required()
                            ->rows(5)
                            ->maxLength(1000)
                            ->columnSpanFull(),

                        Hidden::make('user_id')
                            ->default(auth()->id()),

                        Hidden::make('tenant_id')
                            ->default(fn () => Filament::getTenant()?->id),
                    ])->columns(2),

                Section::make('Status e Acompanhamento')
                    ->schema([
                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'pending' => 'Pendente',
                                'in_review' => 'Em Análise',
                                'approved' => 'Aprovado',
                                'rejected' => 'Rejeitado',
                                'implemented' => 'Implementado',
                            ])
                            ->default('pending')
                            ->required()
                            ->disabled()
                            ->columnSpanFull(),

                        Textarea::make('admin_notes')
                            ->label('Notas do Administrador')
                            ->rows(3)
                            ->disabled()
                            ->columnSpanFull(),

                        Placeholder::make('created_at')
                            ->label('Criado em')
                            ->content(fn ($record) => $record?->created_at?->format('d/m/Y H:i'))
                            ->visible(fn ($record) => $record),

                        Placeholder::make('updated_at')
                            ->label('Atualizado em')
                            ->content(fn ($record) => $record?->updated_at?->format('d/m/Y H:i'))
                            ->visible(fn ($record) => $record),
                    ])->columns(2)
                    ->visible(fn ($record) => $record !== null),
            ]);
    }
}
