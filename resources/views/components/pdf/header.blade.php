@props(['tenant', 'title', 'subtitle' => null])

<div class="pdf-header">
    <table style="width: 100%; border-bottom: 2px solid #6b7280; padding-bottom: 15px; margin-bottom: 20px;">
        <tr>
            <td style="width: 25%; vertical-align: middle; text-align: left;">
                <!-- Logo -->
                @if($tenant->avatar && Storage::exists($tenant->avatar))
                    <img src="{{ Storage::path($tenant->avatar) }}" alt="Logo" style="width: 80px; height: 80px; object-fit: contain; border-radius: 10px;">
                @else
                    <img src="{{ public_path('images/logo.png') }}" alt="Logo WSoft" style="width: 80px; height: 80px; object-fit: contain; border-radius: 10px;">
                @endif
            </td>
            <td style="width: 50%; vertical-align: middle; text-align: center;">
                <!-- Título do Documento -->
                <div style="font-size: 14px; font-weight: bold; color: #1f2937; margin-bottom: 5px;">
                    {{ $title }}
                </div>
                @if($subtitle)
                    <div style="font-size: 11px; color: #6b7280;">
                        {{ $subtitle }}
                    </div>
                @endif
            </td>
            <td style="width: 25%; vertical-align: middle; text-align: right;">
                <!-- Dados da Empresa -->
                <div style="font-size: 14px; font-weight: bold; color: #374151; margin-bottom: 5px;">
                    {{ $tenant->name }}
                </div>
                @if($tenant->document)
                    <div style="font-size: 10px; color: #666;">
                        CNPJ/CPF: {{ $tenant->document }}
                    </div>
                @endif
                @if($tenant->phone)
                    <div style="font-size: 10px; color: #666; margin-top: 3px;">
                        {{ $tenant->phone }}
                    </div>
                @endif
                @if($tenant->email)
                    <div style="font-size: 9px; color: #666; margin-top: 2px;">
                        {{ $tenant->email }}
                    </div>
                @endif
            </td>
        </tr>
    </table>
</div>
