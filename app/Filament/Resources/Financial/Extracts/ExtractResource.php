<?php

declare(strict_types=1);

namespace App\Filament\Resources\Financial\Extracts;

use App\Filament\Resources\Financial\Extracts\Pages\ListExtracts;
use App\Filament\Resources\Financial\Extracts\Schemas\ExtractForm;
use App\Filament\Resources\Financial\Extracts\Tables\ExtractsTable;
use App\Models\Accounts\AccountsInstallments;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

final class ExtractResource extends Resource
{
    protected static ?string $model = AccountsInstallments::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPresentationChartBar;

    protected static string|null|UnitEnum $navigationGroup = 'Financeiro';

    protected static ?string $navigationLabel = 'Movimentação Financeira';

    protected static ?string $label = 'Movimentação Financeira';

    protected static ?string $pluralLabel = 'Movimentações Financeiras';

    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return ExtractForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ExtractsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListExtracts::route('/'),
        ];
    }
}
