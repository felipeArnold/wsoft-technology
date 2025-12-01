<?php

declare(strict_types=1);

namespace App\Filament\Resources\AI\AIGenerations;

use App\Filament\Resources\AI\AIGenerations\Pages\ListAIGenerations;
use App\Filament\Resources\AI\AIGenerations\Schemas\AIGenerationForm;
use App\Filament\Resources\AI\AIGenerations\Tables\AIGenerationsTable;
use App\Models\AI\AIGeneration;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use UnitEnum;

final class AIGenerationResource extends Resource
{
    protected static ?string $model = AIGeneration::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-cpu-chip';

    protected static string|UnitEnum|null $navigationGroup = 'Inteligência Artificial';

    protected static ?string $navigationLabel = 'Logs de Gerações';

    protected static ?string $modelLabel = 'Geração IA';

    protected static ?string $pluralModelLabel = 'Gerações IA';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return AIGenerationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AIGenerationsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAIGenerations::route('/'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
