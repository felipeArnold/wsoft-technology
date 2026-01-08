<?php

declare(strict_types=1);

namespace App\Filament\Resources\Creates\People\Pages;

use App\Filament\Resources\Creates\People\PersonResource;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\HtmlString;

final class ListPeople extends ListRecords
{
    protected static string $resource = PersonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Novo Cliente')
                ->icon('heroicon-o-plus'),
            Action::make('demo')
                ->label('Ver Demonstração')
                ->icon('heroicon-o-play-circle')
                ->outlined()
                ->color('danger')
                ->modalHeading('Demonstração - Cadastro de Clientes')
                ->modalContent(new HtmlString('
                    <div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;">
                        <iframe
                            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: none;"
                            src="https://www.youtube.com/embed/5SufzoP1Toc"
                            title="Demonstração"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>
                    </div>
                '))
                ->modalWidth('5xl')
                ->modalSubmitAction(false)
                ->modalCancelActionLabel('Fechar'),
        ];
    }
}
