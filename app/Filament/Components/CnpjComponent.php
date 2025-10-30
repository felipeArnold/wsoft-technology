<?php

declare(strict_types=1);

namespace App\Filament\Components;

use DateTimeImmutable;
use Exception;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Support\RawJs;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

final class CnpjComponent extends TextInput
{
    protected function setUp(): void
    {
        $this
            ->label('CNPJ')
            ->inputMode('numeric')
            ->maxLength(18)
            ->mask(RawJs::make(<<<'JS'
                (value) => {
                    if (value == null) return '';
                    value = String(value);

                    // mantém apenas dígitos
                    const digits = value.replace(/\D/g, '');
                    if (!digits.length) return '';

                    // Formato XX.XXX.XXX/XXXX-XX
                    return digits.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{0,2})/, '$1.$2.$3/$4-$5').trim();
                }
            JS))
            ->placeholder('00.000.000/0000-00')
            ->live(onBlur: true)
            ->suffix(new HtmlString('
                <div wire:loading wire:target="data.document" class="flex items-center">
                    <svg class="animate-spin h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>
            '))
            ->afterStateUpdated(function (?string $state, callable $set) {
                if (empty($state)) {
                    return;
                }

                $cnpj = self::toDigits($state);

                // Valida se tem 14 dígitos
                if (mb_strlen($cnpj) !== 14) {
                    return;
                }

                try {
                    // Consulta a API da BrasilAPI
                    $response = Http::timeout(10)
                        ->get("https://brasilapi.com.br/api/cnpj/v1/{$cnpj}");

                    if ($response->successful()) {
                        $data = $response->json();

                        // Preenche os campos do formulário
                        $set('name', $data['razao_social'] ?? null);
                        $set('surname', $data['nome_fantasia'] ?? null);

                        // Data de abertura (formato: YYYY-MM-DD para o campo date)
                        if (isset($data['data_inicio_atividade'])) {
                            $date = DateTimeImmutable::createFromFormat('Y-m-d', $data['data_inicio_atividade']);
                            if ($date) {
                                $set('birth_date', $date->format('Y-m-d'));
                            }
                        }

                        // Endereço
                        if (! empty($data['logradouro'])) {
                            // Busca endereços existentes para adicionar um novo
                            $addresses = [];

                            $cep = self::formatCep($data['cep'] ?? '');

                            $addresses[] = [
                                'postal_code' => $cep,
                                'street' => $data['logradouro'] ?? '',
                                'number' => $data['numero'] ?? '',
                                'complement' => $data['complemento'] ?? '',
                                'district' => $data['bairro'] ?? '',
                                'city' => $data['municipio'] ?? '',
                                'state' => $data['uf'] ?? '',
                            ];

                            $set('addresses', $addresses);
                        }

                        // E-mail e telefone (se disponíveis na API)
                        if (! empty($data['ddd_telefone_1'])) {
                            $phones = [];
                            $ddd = $data['ddd_telefone_1'];

                            // Remove caracteres não numéricos e formata
                            $phoneNumber = preg_replace('/\D/', '', $ddd);

                            if (! empty($phoneNumber)) {
                                $phones[] = [
                                    'number' => $phoneNumber,
                                ];
                                $set('phones', $phones);
                            }
                        }

                        // Representantes (QSA - Quadro de Sócios e Administradores)
                        if (! empty($data['qsa']) && is_array($data['qsa'])) {
                            $representatives = [];

                            foreach ($data['qsa'] as $socio) {
                                // Adiciona apenas sócios com qualificação de administrador
                                if (! empty($socio['nome_socio'])) {
                                    $representatives[] = [
                                        'name' => $socio['nome_socio'] ?? '',
                                        'position' => $socio['qualificacao_socio'] ?? '',
                                        'phone' => null,
                                        'email' => null,
                                    ];
                                }
                            }

                            if (! empty($representatives)) {
                                $set('supplierRepresentatives', $representatives);
                            }
                        }

                        // Notificação de sucesso
                        Notification::make()
                            ->title('CNPJ consultado com sucesso!')
                            ->success()
                            ->body('Os dados foram preenchidos automaticamente.')
                            ->send();
                    } else {
                        Notification::make()
                            ->title('CNPJ não encontrado')
                            ->warning()
                            ->body('Não foi possível encontrar dados para este CNPJ.')
                            ->send();
                    }
                } catch (Exception $e) {
                    Notification::make()
                        ->title('Erro ao consultar CNPJ')
                        ->danger()
                        ->body('Ocorreu um erro ao consultar a API: '.$e->getMessage())
                        ->send();
                }
            })
            ->dehydrateStateUsing(fn ($state) => self::toDigits($state))
            ->dehydrated(true)
            ->rules([
                'required',
                'string',
                function () {
                    return function (string $attribute, $value, $fail) {
                        // Remove caracteres não numéricos
                        $digits = preg_replace('/\D/', '', $value);

                        // Valida se tem exatamente 14 dígitos
                        if (mb_strlen($digits) !== 14) {
                            $fail('O CNPJ deve conter exatamente 14 dígitos.');

                            return;
                        }

                        // Valida se contém apenas números
                        if (! ctype_digit($digits)) {
                            $fail('O CNPJ deve conter apenas números.');

                            return;
                        }
                    };
                },
            ]);
    }

    public static function toDigits(?string $value): ?string
    {
        if ($value === null) {
            return null;
        }

        return Str::of($value)
            ->replaceMatches('/\D/', '')
            ->toString();
    }

    private static function formatCep(?string $cep): ?string
    {
        if (empty($cep)) {
            return null;
        }

        $digits = preg_replace('/\D/', '', $cep);

        if (mb_strlen($digits) === 8) {
            return mb_substr($digits, 0, 5).'-'.mb_substr($digits, 5, 3);
        }

        return $digits;
    }
}
