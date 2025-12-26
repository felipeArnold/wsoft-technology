<?php

declare(strict_types=1);

namespace App\Filament\Resources\Services\ServiceOrders\Actions;

use App\Models\ServiceOrder;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Actions\Action;
use Filament\Support\Colors\Color;
use Symfony\Component\HttpFoundation\Response;

final class DownloadServiceOrderPdfAction extends Action
{
    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->label('Gerar PDF')
            ->color(Color::Blue)
            ->icon('heroicon-o-document-arrow-down')
            ->action(fn () => $this->execute());
    }

    public static function make(?string $name = 'download_pdf'): static
    {
        return parent::make($name);
    }

    protected function execute(): Response
    {
        /** @var ServiceOrder|null $record */
        $record = $this->getRecord();

        if (! $record) {
            abort(404, 'Ordem de serviço não encontrada');
        }

        $serviceOrder = $record->load([
            'person',
            'user',
            'tenant',
            'serviceOrderServices',
            'serviceOrderProducts',
        ]);

        $pdf = Pdf::loadView('pdf.service-order', [
            'serviceOrder' => $serviceOrder,
            'tenant' => $serviceOrder->tenant,
        ])
            ->setPaper('a4')
            ->setOption('margin-top', 10)
            ->setOption('margin-bottom', 10)
            ->setOption('margin-left', 10)
            ->setOption('margin-right', 10);

        return response()->streamDownload(
            fn () => print ($pdf->output()),
            'ordem-servico-'.$serviceOrder->number.'.pdf'
        );
    }
}
