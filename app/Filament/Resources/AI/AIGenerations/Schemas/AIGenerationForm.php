<?php

declare(strict_types=1);

namespace App\Filament\Resources\AI\AIGenerations\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

final class AIGenerationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name'),
                Select::make('blog_post_id')
                    ->relationship('blogPost', 'title'),
                TextInput::make('type')
                    ->required(),
                TextInput::make('status')
                    ->required()
                    ->default('pending'),
                Textarea::make('prompt')
                    ->columnSpanFull(),
                Textarea::make('request_data')
                    ->columnSpanFull(),
                TextInput::make('model')
                    ->required()
                    ->default('gpt-4o-mini'),
                TextInput::make('temperature')
                    ->required()
                    ->numeric()
                    ->default(0.7),
                TextInput::make('max_tokens')
                    ->required()
                    ->numeric()
                    ->default(3000),
                Textarea::make('response_content')
                    ->columnSpanFull(),
                Textarea::make('response_data')
                    ->columnSpanFull(),
                TextInput::make('tokens_used')
                    ->numeric(),
                TextInput::make('prompt_tokens')
                    ->numeric(),
                TextInput::make('completion_tokens')
                    ->numeric(),
                TextInput::make('estimated_cost')
                    ->numeric()
                    ->prefix('$'),
                TextInput::make('processing_time_ms')
                    ->numeric(),
                TextInput::make('retry_attempts')
                    ->required()
                    ->numeric()
                    ->default(0),
                Textarea::make('error_message')
                    ->columnSpanFull(),
                TextInput::make('ip_address'),
                Textarea::make('user_agent')
                    ->columnSpanFull(),
            ]);
    }
}
