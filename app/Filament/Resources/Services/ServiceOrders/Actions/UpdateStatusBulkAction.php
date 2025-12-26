<?php

declare(strict_types=1);

namespace App\Filament\Resources\Services\ServiceOrders\Actions;

use App\Enum\ServiceOrderStatus;
use App\Models\ServiceOrder;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Notifications\Notification;
use Illuminate\Support\Collection;

final class UpdateStatusBulkAction extends Action
{
    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->label('Atualizar Status')
            ->icon('heroicon-o-arrow-path')
            ->modalWidth('md')
            ->requiresConfirmation()
            ->color('info')
            ->accessSelectedRecords()
            ->form($this->getFormSchema())
            ->action(fn (array $data, Collection $records) => $this->execute($data, $records));
    }

    public static function make(?string $name = 'update_status'): static
    {
        return parent::make($name);
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Select::make('status')
                ->label('Status')
                ->options(ServiceOrderStatus::toSelectArray())
                ->native(false)
                ->required(),
        ];
    }

    protected function execute(array $data, Collection $records): void
    {
        $records->each(function (ServiceOrder $record) use ($data): void {
            $record->update([
                'status' => $data['status'],
            ]);
        });

        Notification::make()
            ->title('Status atualizado com sucesso')
            ->success()
            ->body('O status das ordens de serviço selecionadas foi atualizado.')
            ->send();
    }
}
