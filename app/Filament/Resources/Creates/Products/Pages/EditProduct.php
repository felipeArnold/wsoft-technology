<?php

declare(strict_types=1);

namespace App\Filament\Resources\Creates\Products\Pages;

use App\Filament\Resources\Creates\Products\ProductResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

final class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Produto "' . $this->record->name . '" atualizado com sucesso';
    }

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make()
                ->requiresConfirmation()
                ->modalHeading('Excluir Produto')
                ->modalDescription('Tem certeza que deseja excluir o produto "' . $this->record->name . '"? Esta ação não pode ser desfeita.')
                ->modalSubmitActionLabel('Sim, excluir')
                ->successNotificationTitle('Produto "' . $this->record->name . '" excluído com sucesso'),
        ];
    }
}
