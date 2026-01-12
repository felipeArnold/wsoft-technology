<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\ServiceOrder;
use Barryvdh\DomPDF\Facade\Pdf;
use Symfony\Component\HttpFoundation\StreamedResponse;

final class ServiceOrderPdfController extends Controller
{
    public function download(ServiceOrder $serviceOrder): StreamedResponse
    {
        $serviceOrder->load([
            'person.phones',
            'person.addresses',
            'person.emails',
            'user',
            'tenant.phones',
            'tenant.addresses',
            'tenant.emails',
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
            'ordem-servico-'.$serviceOrder->number.'.pdf',
            ['Content-Type' => 'application/pdf']
        );
    }
}
