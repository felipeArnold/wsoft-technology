<?php

declare(strict_types=1);

namespace App\Filament\Resources\Financial\AccountsReceivables;

use App\Filament\Clusters\Financial\FinancialCluster;
use App\Filament\Resources\Financial\AccountsReceivables\Pages\CreateAccountsReceivable;
use App\Filament\Resources\Financial\AccountsReceivables\Pages\EditAccountsReceivable;
use App\Filament\Resources\Financial\AccountsReceivables\Pages\ListAccountsReceivables;
use App\Filament\Resources\Financial\AccountsReceivables\Pages\ViewAccountsReceivable;
use App\Filament\Resources\Financial\AccountsReceivables\Schemas\AccountsReceivableForm;
use App\Filament\Resources\Financial\AccountsReceivables\Schemas\AccountsReceivableInfolist;
use App\Filament\Resources\Financial\AccountsReceivables\Tables\AccountsReceivablesTable;
use App\Models\Accounts\Accounts;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use UnitEnum;

final class AccountsReceivableResource extends Resource
{
    protected static ?string $model = Accounts::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ArrowTrendingUp;

    protected static ?string $label = 'Contas a Receber';

    protected static ?string $pluralLabel = 'Contas a Receber';

    protected static string|UnitEnum|null $navigationGroup = 'Financeiro';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return AccountsReceivableForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return AccountsReceivableInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AccountsReceivablesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAccountsReceivables::route('/'),
            'create' => CreateAccountsReceivable::route('/create'),
            'view' => ViewAccountsReceivable::route('/{record}'),
            'edit' => EditAccountsReceivable::route('/{record}/edit'),
        ];
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ServiceOrderRelationManager::class,
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('type', 'receivables');
    }
}
