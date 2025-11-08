@props(['documentNumber' => null, 'documentType' => 'Documento'])

<div class="pdf-footer" style="margin-top: 30px; padding-top: 15px; border-top: 2px solid #e5e7eb; text-align: center; font-size: 9px; color: #9ca3af;">
    <p>Este documento foi gerado eletronicamente e possui validade legal.</p>
    @if($documentNumber)
        <p>{{ $documentType }} {{ $documentNumber }} | {{ now()->format('d/m/Y H:i') }}</p>
    @else
        <p>Gerado em {{ now()->format('d/m/Y H:i') }}</p>
    @endif
</div>
