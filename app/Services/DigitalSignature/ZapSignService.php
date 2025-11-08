<?php

declare(strict_types=1);

namespace App\Services\DigitalSignature;

use App\Models\DigitalSignature\Envelope;
use Exception;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

final class ZapSignService
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::accept('application/json')
            ->baseUrl(config('services.zapsign.url'))
            ->withToken(config('services.zapsign.api_token'))
            ->acceptJson()
            ->timeout(300);
    }

    /**
     * Cria um documento na ZApSign
     *
     *
     * @throws Exception
     */
    public function createDocument(Envelope $envelope): array
    {
        try {
            // Prepara os signatários
            $signers = $this->prepareSigners($envelope);

            // Prepara o documento (assumindo que o primeiro documento é um PDF)
            $documentData = $this->prepareDocument($envelope);

            // Monta o payload
            $payload = [
                'name' => $envelope->name,
                'signers' => $signers,
                'lang' => 'pt-br',
            ];

            // Adiciona o documento ao payload
            $payload = array_merge($payload, $documentData);

            // Adiciona data limite se existir
            if ($envelope->deadline) {
                $payload['date_limit_to_sign'] = $envelope->deadline->format('Y-m-d');
            }

            // Adiciona external_id para rastreamento
            $payload['external_id'] = "envelope_{$envelope->id}";

            Log::info('Creating ZApSign document', [
                'envelope_id' => $envelope->id,
                'payload' => $payload,
            ]);

            // Faz a requisição
            $response = $this->client->post('/docs/', $payload);

            if (! $response->successful()) {
                Log::error('ZApSign API error', [
                    'status' => $response->status(),
                    'body' => $response->json(),
                ]);

                throw new Exception('Erro ao criar documento na ZApSign: '.$response->json('message', 'Erro desconhecido'));
            }

            $data = $response->json();

            Log::info('ZApSign document created successfully', [
                'envelope_id' => $envelope->id,
                'zapsign_token' => $data['token'],
                'zapsign_open_id' => $data['open_id'],
            ]);

            return $data;
        } catch (Exception $e) {
            dd($e);
            Log::error('Error creating ZApSign document', [
                'envelope_id' => $envelope->id,
                'error' => $e->getMessage(),
            ]);

            throw $e;
        }
    }

    /**
     * Consulta o status de um documento
     *
     *
     * @throws Exception
     */
    public function getDocument(string $token): array
    {
        try {
            $response = $this->client->get("/docs/{$token}/");

            if (! $response->successful()) {
                throw new Exception('Erro ao consultar documento na ZApSign');
            }

            return $response->json();
        } catch (Exception $e) {
            Log::error('Error fetching ZApSign document', [
                'token' => $token,
                'error' => $e->getMessage(),
            ]);

            throw $e;
        }
    }

    /**
     * Deleta um documento
     *
     *
     * @throws Exception
     */
    public function deleteDocument(string $token): bool
    {
        try {
            $response = $this->client->delete("/docs/{$token}/");

            return $response->successful();
        } catch (Exception $e) {
            Log::error('Error deleting ZApSign document', [
                'token' => $token,
                'error' => $e->getMessage(),
            ]);

            throw $e;
        }
    }

    /**
     * Reenvia o email para um signatário
     *
     *
     * @throws Exception
     */
    public function resendEmail(string $signerToken): bool
    {
        try {
            $response = $this->client->post("/docs/{$signerToken}/resend-email/");

            return $response->successful();
        } catch (Exception $e) {
            Log::error('Error resending ZApSign email', [
                'signer_token' => $signerToken,
                'error' => $e->getMessage(),
            ]);

            throw $e;
        }
    }

    /**
     * Prepara os signatários no formato esperado pela ZApSign
     */
    private function prepareSigners(Envelope $envelope): array
    {
        $signers = [];

        foreach ($envelope->signers as $signer) {
            $signerData = [
                'name' => $signer->name,
                'email' => $signer->email,
                'send_automatic_email' => true,
                'send_automatic_whatsapp' => false,
            ];

            // Define o método de autenticação baseado no tipo de signatário
            $signerData['auth_mode'] = $this->getAuthMode($signer);

            // Adiciona telefone se disponível
            if ($signer->phone) {
                $phone = preg_replace('/\D/', '', $signer->phone);
                if (mb_strlen($phone) >= 10) {
                    $signerData['phone_country'] = '55'; // Brasil
                    $signerData['phone_number'] = $phone;
                }
            }

            // Adiciona CPF se disponível e necessário
            if ($signer->document_number) {
                $cpf = preg_replace('/\D/', '', $signer->document_number);
                if (mb_strlen($cpf) === 11) {
                    $signerData['cpf'] = $cpf;
                    $signerData['validate_cpf'] = true;
                }
            }

            // Adiciona requisitos de foto se necessário
            if ($signer->signature_with_photo) {
                $signerData['require_selfie_photo'] = true;
                $signerData['require_document_photo'] = true;
            }

            $signers[] = $signerData;
        }

        return $signers;
    }

    /**
     * Determina o método de autenticação baseado no tipo de signatário
     *
     * @param  \App\Models\DigitalSignature\Signer  $signer
     */
    private function getAuthMode($signer): string
    {
        // Método padrão: assinatura na tela + token por email
        $authMode = 'assinaturaTela';

        // Se tiver email, adiciona token por email
        if ($signer->email) {
            $authMode .= '-tokenEmail';
        }

        // Se tiver telefone e for assinatura com foto, pode adicionar WhatsApp
        if ($signer->phone && $signer->signature_with_photo) {
            // Opcionalmente pode adicionar tokenWhatsapp
            // $authMode .= '-tokenWhatsapp';
        }

        return $authMode;
    }

    /**
     * Prepara o documento para envio
     *
     *
     * @throws Exception
     */
    private function prepareDocument(Envelope $envelope): array
    {
        // Verifica se há documentos
        if (empty($envelope->documents) || ! is_array($envelope->documents)) {
            throw new Exception('Nenhum documento encontrado no envelope');
        }

        // Pega o primeiro documento (assumindo que é o principal)
        $documentPath = $envelope->documents[0];

        // Verifica se o arquivo existe
        if (! Storage::exists($documentPath)) {
            throw new Exception('Arquivo do documento não encontrado: '.$documentPath);
        }

        // Pega o conteúdo do arquivo
        $fileContent = Storage::get($documentPath);
        $base64Content = base64_encode($fileContent);

        // Verifica a extensão do arquivo
        $extension = mb_strtolower(pathinfo($documentPath, PATHINFO_EXTENSION));

        // Retorna o formato apropriado
        if ($extension === 'pdf') {
            return ['base64_pdf' => $base64Content];
        }
        if ($extension === 'docx') {
            return ['base64_docx' => $base64Content];
        }

        throw new Exception('Formato de documento não suportado. Use PDF ou DOCX.');
    }
}
