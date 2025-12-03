<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\CRM\Sources;

use App\Filament\Clusters\Settings\CRM\Sources\Pages\ListSources;
use App\Filament\Clusters\Settings\CRM\Sources\Schemas\SourceForm;
use App\Filament\Clusters\Settings\CRM\Sources\Schemas\SourceInfolist;
use App\Filament\Clusters\Settings\CRM\Sources\Tables\SourcesTable;
use App\Filament\Clusters\Settings\SettingsCluster;
use App\Models\Source;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

final class SourceResource extends Resource
{
    protected static ?string $model = Source::class;

    protected static ?string $slug = 'sources';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedGlobeAlt;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $label = 'Origens';

    protected static ?string $pluralLabel = 'Origens';

    protected static string|UnitEnum|null $navigationGroup = 'CRM';

    protected static ?int $navigationSort = 4;

    protected static ?string $cluster = SettingsCluster::class;

    public static function form(Schema $schema): Schema
    {
        return SourceForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SourceInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SourcesTable::configure($table);
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
            'index' => ListSources::route('/'),
        ];
    }
}
