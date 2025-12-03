<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\CRM\Funnels;

use App\Filament\Clusters\Settings\CRM\Funnels\Pages\ListFunnels;
use App\Filament\Clusters\Settings\CRM\Funnels\Schemas\FunnelForm;
use App\Filament\Clusters\Settings\CRM\Funnels\Schemas\FunnelInfolist;
use App\Filament\Clusters\Settings\CRM\Funnels\Tables\FunnelsTable;
use App\Filament\Clusters\Settings\SettingsCluster;
use App\Models\Funnel;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

final class FunnelResource extends Resource
{
    protected static ?string $model = Funnel::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedFunnel;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $label = 'Funil';

    protected static ?string $pluralLabel = 'Funis';

    protected static string|UnitEnum|null $navigationGroup = 'CRM';

    protected static ?int $navigationSort = 3;

    protected static ?string $cluster = SettingsCluster::class;

    public static function form(Schema $schema): Schema
    {
        return FunnelForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return FunnelInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FunnelsTable::configure($table);
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
            'index' => ListFunnels::route('/'),
        ];
    }
}
