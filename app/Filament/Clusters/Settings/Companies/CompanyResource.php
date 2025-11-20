<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\Companies;

use App\Filament\Clusters\Settings\Companies\Pages\EditCompany;
use App\Filament\Clusters\Settings\Companies\Pages\ListCompanies;
use App\Filament\Clusters\Settings\Companies\Pages\ViewCompany;
use App\Filament\Clusters\Settings\Companies\RelationManagers\SubscriptionsRelationManager;
use App\Filament\Clusters\Settings\Companies\Schemas\CompanyForm;
use App\Filament\Clusters\Settings\Companies\Schemas\CompanyInfolist;
use App\Filament\Clusters\Settings\Companies\Tables\CompaniesTable;
use App\Filament\Clusters\Settings\SettingsCluster;
use App\Models\Tenant;
use BackedEnum;
use Filament\Facades\Filament;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

final class CompanyResource extends Resource
{
    protected static ?string $model = Tenant::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingOffice2;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $label = 'Dados da Empresa';

    protected static ?string $pluralLabel = 'Dados da Empresa';

    protected static ?int $navigationSort = 1;

    protected static string|UnitEnum|null $navigationGroup = 'Empresa';

    protected static ?string $cluster = SettingsCluster::class;

    public static function form(Schema $schema): Schema
    {
        return CompanyForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CompanyInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CompaniesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            SubscriptionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCompanies::route('/'),
            'view' => ViewCompany::route('/{record}'),
            'edit' => EditCompany::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getNavigationUrl(): string
    {
        $tenant = Filament::getTenant();

        if ($tenant) {
            return self::getUrl('edit', ['record' => $tenant->id]);
        }

        return self::getUrl('index');
    }
}
