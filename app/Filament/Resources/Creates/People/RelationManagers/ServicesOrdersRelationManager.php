<?php

declare(strict_types=1);

namespace App\Filament\Resources\Creates\People\RelationManagers;

use App\Models\ServiceOrder;
use BackedEnum;
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
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

final class ServicesOrdersRelationManager extends RelationManager
{
    protected static string $relationship = 'servicesOrders';

    protected static ?string $label = 'Ordens de Serviço';

    protected static ?string $title = 'Ordens de Serviço';

    protected static string|BackedEnum|null $icon = Heroicon::OutlinedClipboardDocumentList;

    public function form(Schema $schema): Schema
    {
        return $schema->components(ServiceOrder::getForm());
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Person')
            ->modifyQueryUsing(fn ($query) => $query->with(['person', 'user', 'categories']))
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
