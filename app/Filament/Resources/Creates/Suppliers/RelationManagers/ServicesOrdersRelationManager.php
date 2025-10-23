<?php

declare(strict_types=1);

namespace App\Filament\Resources\Creates\Suppliers\RelationManagers;

use App\Models\ServiceOrder;
use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

final class ServicesOrdersRelationManager extends RelationManager
{
    protected static string $relationship = 'servicesOrders';

    protected static ?string $label = 'Ordens de Serviço';

    protected static ?string $title = 'Ordens de Serviço';

    public function form(Schema $schema): Schema
    {
        return $schema->components(ServiceOrder::getForm());
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Person')
            ->columns(ServiceOrder::getTableColumns())
            ->headerActions([
                CreateAction::make(),
                AssociateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DissociateAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DissociateBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
