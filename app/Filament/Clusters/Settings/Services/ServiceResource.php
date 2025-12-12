<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\Services;

use App\Filament\Clusters\Settings\Services\Pages\ListServices;
use App\Filament\Clusters\Settings\Services\Schemas\ServiceForm;
use App\Filament\Clusters\Settings\Services\Tables\ServicesTable;
use App\Filament\Clusters\Settings\SettingsCluster;
use App\Models\Service;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

final class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedWrenchScrewdriver;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $label = 'Serviço';

    protected static ?string $pluralLabel = 'Serviços';

    protected static string|UnitEnum|null $navigationGroup = 'Personalização';

    protected static ?int $navigationSort = 5;

    protected static ?string $cluster = SettingsCluster::class;

    public static function form(Schema $schema): Schema
    {
        return ServiceForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ServicesTable::configure($table);
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
            'index' => ListServices::route('/'),
        ];
    }
}
