<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\CRM\Teams;

use App\Filament\Clusters\Settings\CRM\Teams\Pages\ListTeams;
use App\Filament\Clusters\Settings\CRM\Teams\Schemas\TeamForm;
use App\Filament\Clusters\Settings\CRM\Teams\Schemas\TeamInfolist;
use App\Filament\Clusters\Settings\CRM\Teams\Tables\TeamsTable;
use App\Filament\Clusters\Settings\SettingsCluster;
use App\Models\Team;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

final class TeamResource extends Resource
{
    protected static ?string $model = Team::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserGroup;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $label = 'Equipe';

    protected static ?string $pluralLabel = 'Equipes';

    protected static string|UnitEnum|null $navigationGroup = 'CRM';

    protected static ?int $navigationSort = 2;

    protected static ?string $cluster = SettingsCluster::class;

    public static function form(Schema $schema): Schema
    {
        return TeamForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return TeamInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TeamsTable::configure($table);
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
            'index' => ListTeams::route('/'),
        ];
    }
}
