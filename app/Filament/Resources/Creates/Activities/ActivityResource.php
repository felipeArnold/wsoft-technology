<?php

declare(strict_types=1);

namespace App\Filament\Resources\Creates\Activities;

use App\Filament\Resources\Creates\Activities\Pages\CreateActivity;
use App\Filament\Resources\Creates\Activities\Pages\EditActivity;
use App\Filament\Resources\Creates\Activities\Pages\ListActivities;
use App\Filament\Resources\Creates\Activities\Schemas\ActivityForm;
use App\Filament\Resources\Creates\Activities\Tables\ActivitiesTable;
use App\Models\Activity;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use UnitEnum;

final class ActivityResource extends Resource
{
    protected static ?string $model = Activity::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentCheck;

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $label = 'Atividades';

    protected static string|UnitEnum|null $navigationGroup = 'Cadastros';

    protected static ?int $navigationSort = 4;

    public static function getGloballySearchableAttributes(): array
    {
        return [
            'title',
            'description',
        ];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Título' => $record->title,
            'Status' => match ($record->status) {
                'pending' => 'Pendente',
                'in_progress' => 'Em Andamento',
                'completed' => 'Concluído',
                'cancelled' => 'Cancelado',
                default => $record->status,
            },
            'Prioridade' => match ($record->priority) {
                'low' => 'Baixa',
                'medium' => 'Média',
                'high' => 'Alta',
                'urgent' => 'Urgente',
                default => $record->priority,
            },
        ];
    }

    public static function form(Schema $schema): Schema
    {
        return ActivityForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ActivitiesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListActivities::route('/'),
            'create' => CreateActivity::route('/create'),
            'edit' => EditActivity::route('/{record}/edit'),
        ];
    }
}
