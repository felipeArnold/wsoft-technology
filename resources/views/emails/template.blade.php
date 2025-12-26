@component('mail::message')
{!! $body !!}

@if(isset($serviceOrder))
---

**Ordem de Serviço:** {{ $serviceOrder->number }}
@endif

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
