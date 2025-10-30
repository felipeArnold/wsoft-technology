<?php

declare(strict_types=1);

namespace App\Filament\Resources\Creates\Suppliers;

use App\Filament\Resources\Creates\Suppliers\Pages\CreateSupplier;
use App\Filament\Resources\Creates\Suppliers\Pages\EditSupplier;
use App\Filament\Resources\Creates\Suppliers\Pages\ListSuppliers;
use App\Filament\Resources\Creates\Suppliers\RelationManagers\ServicesOrdersRelationManager;
use App\Filament\Resources\Creates\Suppliers\Schemas\SupplierForm;
use App\Filament\Resources\Creates\Suppliers\Tables\SuppliersTable;
use App\Models\Person\Person;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

final class SupplierResource extends Resource
{
    protected static ?string $model = Person::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingStorefront;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $label = 'Fornecedores';

    protected static string|UnitEnum|null $navigationGroup = 'Cadastros';

    protected static ?int $navigationSort = 2;

    public static function getGloballySearchableAttributes(): array
    {
        return [
            'name',
            'document',
            'surname',
        ];
    }

    public static function getGlobalSearchResultDetails($record): array
    {
        return [
            'Nome' => $record->name,
            'Documento' => $record->document,
            'Apelido' => $record->surname,
        ];
    }

    public static function form(Schema $schema): Schema
    {
        return SupplierForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SuppliersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            ServicesOrdersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSuppliers::route('/'),
            'create' => CreateSupplier::route('/create'),
            'edit' => EditSupplier::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
