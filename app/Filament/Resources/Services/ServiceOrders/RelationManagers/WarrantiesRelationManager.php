<?php

declare(strict_types=1);

namespace App\Filament\Resources\Services\ServiceOrders\RelationManagers;

use App\Filament\Resources\Services\Warranties\Schemas\WarrantyForm;
use App\Filament\Resources\Services\Warranties\Tables\WarrantiesTable;
use BackedEnum;
use Filament\Facades\Filament;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

final class WarrantiesRelationManager extends RelationManager
{
    protected static string $relationship = 'warranties';

    protected static ?string $recordTitleAttribute = 'warranty_type';

    protected static ?string $title = 'Garantias';

    protected static string|BackedEnum|null $icon = 'heroicon-o-shield-check';

    public function form(Schema $schema): Schema
    {
        return WarrantyForm::configure($schema);
    }

    public function table(Table $table): Table
    {
        return WarrantiesTable::configure($table)
            ->modifyQueryUsing(fn ($query) => $query->withCount('warrantyClaims'))
            ->emptyStateHeading('Nenhuma garantia')
            ->emptyStateDescription('Esta ordem de serviço ainda não possui garantias.')
            ->emptyStateIcon(Heroicon::ShieldCheck);
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['tenant_id'] = Filament::getTenant()->id;
        $data['service_order_id'] = $this->getOwnerRecord()->id;

        // Auto-set person_id from the service order if not set
        if (! isset($data['person_id']) && $this->getOwnerRecord()->person_id) {
            $data['person_id'] = $this->getOwnerRecord()->person_id;
        }

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['tenant_id'] = Filament::getTenant()->id;

        return $data;
    }
}
