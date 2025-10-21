<?php

declare(strict_types=1);

namespace App\Filament\Resources\Financial\AccountsPayables;

use App\Filament\Resources\Financial\AccountsPayables\Pages\CreateAccountsPayable;
use App\Filament\Resources\Financial\AccountsPayables\Pages\EditAccountsPayable;
use App\Filament\Resources\Financial\AccountsPayables\Pages\ListAccountsPayables;
use App\Filament\Resources\Financial\AccountsPayables\Schemas\AccountsPayableForm;
use App\Filament\Resources\Financial\AccountsPayables\Tables\AccountsPayablesTable;
use App\Models\Accounts\Accounts;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use UnitEnum;

final class AccountsPayableResource extends Resource
{
    protected static ?string $model = Accounts::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ArrowTrendingDown;

    protected static ?string $label = 'Contas a Pagar';

    protected static string|UnitEnum|null $navigationGroup = 'Financeiro';

    protected static ?string $pluralLabel = 'Contas a Pagar';

    public static function form(Schema $schema): Schema
    {
        return AccountsPayableForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AccountsPayablesTable::configure($table);
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
            'index' => ListAccountsPayables::route('/'),
            'create' => CreateAccountsPayable::route('/create'),
            'edit' => EditAccountsPayable::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('type', 'payables');
    }
}
