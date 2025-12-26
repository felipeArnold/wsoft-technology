<?php

declare(strict_types=1);

namespace App\Filament\Resources\Services\ServiceOrders\Actions;

use App\Models\ServiceOrder;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Notifications\Notification;
use Illuminate\Support\Collection;

final class UpdateResponsibleBulkAction extends Action
{
    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->label('Atualizar Responsável')
            ->icon('heroicon-o-user')
            ->modalWidth('md')
            ->requiresConfirmation()
            ->color('success')
            ->accessSelectedRecords()
            ->form($this->getFormSchema())
            ->action(fn (array $data, Collection $records) => $this->execute($data, $records));
    }

    public static function make(?string $name = 'update_responsible'): static
    {
        return parent::make($name);
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Select::make('user_id')
                ->label('Responsável')
                ->relationship('user', 'name')
                ->searchable()
                ->preload()
                ->required(),
        ];
    }

    protected function execute(array $data, Collection $records): void
    {
        $records->each(function (ServiceOrder $record) use ($data): void {
            $record->update([
                'user_id' => $data['user_id'],
            ]);
        });

        Notification::make()
            ->title('Responsável atualizado com sucesso')
            ->success()
            ->body('O responsável das ordens de serviço selecionadas foi atualizado.')
            ->send();
    }
}
