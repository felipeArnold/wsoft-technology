<?php

declare(strict_types=1);

namespace App\Filament\Resources\Services\Warranties;

use App\Filament\Resources\Services\Warranties\Pages\CreateWarranty;
use App\Filament\Resources\Services\Warranties\Pages\EditWarranty;
use App\Filament\Resources\Services\Warranties\Pages\ListWarranties;
use App\Filament\Resources\Services\Warranties\Pages\ViewWarranty;
use App\Filament\Resources\Services\Warranties\RelationManagers\WarrantyClaimsRelationManager;
use App\Filament\Resources\Services\Warranties\Schemas\WarrantyForm;
use App\Filament\Resources\Services\Warranties\Schemas\WarrantyInfolist;
use App\Filament\Resources\Services\Warranties\Tables\WarrantiesTable;
use App\Models\Warranty;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

final class WarrantyResource extends Resource
{
    protected static ?string $model = Warranty::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedShieldCheck;

    protected static ?string $label = 'Garantia';

    protected static ?string $pluralLabel = 'Garantias';

    protected static ?int $navigationSort = 2;

    protected static string|UnitEnum|null $navigationGroup = 'Serviços';

    public static function form(Schema $schema): Schema
    {
        return WarrantyForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return WarrantyInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WarrantiesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            WarrantyClaimsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListWarranties::route('/'),
            'create' => CreateWarranty::route('/create'),
            'view' => ViewWarranty::route('/{record}'),
            'edit' => EditWarranty::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::expiring(30)->count() > 0
            ? (string) static::getModel()::expiring(30)->count()
            : null;
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        $count = static::getModel()::expiring(30)->count();

        return match (true) {
            $count > 10 => 'danger',
            $count > 5 => 'warning',
            default => 'success',
        };
    }
}
