<?php

declare(strict_types=1);

namespace App\Filament\Resources\Services\ServiceOrders\Actions;

use App\Enum\ServiceOrderPriority;
use App\Models\ServiceOrder;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Notifications\Notification;
use Illuminate\Support\Collection;

final class UpdatePriorityBulkAction extends Action
{
    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->label('Atualizar Prioridade')
            ->icon('heroicon-o-pencil-square')
            ->modalWidth('md')
            ->requiresConfirmation()
            ->color('warning')
            ->accessSelectedRecords()
            ->form($this->getFormSchema())
            ->action(fn (array $data, Collection $records) => $this->execute($data, $records));
    }

    public static function make(?string $name = 'update_priority'): static
    {
        return parent::make($name);
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Select::make('priority')
                ->label('Prioridade')
                ->options(ServiceOrderPriority::toSelectArray())
                ->native(false)
                ->required(),
        ];
    }

    protected function execute(array $data, Collection $records): void
    {
        $records->each(function (ServiceOrder $record) use ($data): void {
            $record->update([
                'priority' => $data['priority'],
            ]);
        });

        Notification::make()
            ->title('Prioridade atualizada com sucesso')
            ->success()
            ->body('A prioridade das ordens de serviço selecionadas foi atualizada.')
            ->send();
    }
}
