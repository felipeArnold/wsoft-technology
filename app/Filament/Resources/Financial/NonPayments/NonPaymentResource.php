<?php

declare(strict_types=1);

namespace App\Filament\Resources\Financial\NonPayments;

use App\Filament\Resources\Financial\NonPayments\Pages\ListNonPayments;
use App\Filament\Resources\Financial\NonPayments\Schemas\NonPaymentForm;
use App\Filament\Resources\Financial\NonPayments\Tables\NonPaymentsTable;
use App\Models\Accounts\AccountsInstallments;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use UnitEnum;

final class NonPaymentResource extends Resource
{
    protected static ?string $model = AccountsInstallments::class;

    protected static ?string $label = 'Inadimplência';

    protected static ?string $recordTitleAttribute = 'installment_number';

    protected static string|null|UnitEnum $navigationGroup = 'Financeiro';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-currency-dollar';

    public static function form(Schema $schema): Schema
    {
        return NonPaymentForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return NonPaymentsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListNonPayments::route('/'),
        ];
    }
}
