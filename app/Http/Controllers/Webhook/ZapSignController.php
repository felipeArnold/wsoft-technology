<?php

declare(strict_types=1);

namespace App\Http\Controllers\Webhook;

use App\Http\Controllers\Controller;
use App\Models\DigitalSignature\Envelope;
use App\Services\DigitalSignature\ZapSignService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

final class ZapSignController extends Controller
{
    public function __invoke(Request $request)
    {
        try {
            // Log do payload recebido para debug
            Log::info('ZapSign webhook received', [
                'payload' => $request->all(),
            ]);

            // Extrai os dados do webhook
            $eventType = $request->input('event_type');
            $token = $request->input('token');
            $externalId = $request->input('external_id');

            // Valida se recebemos os dados mínimos necessários
            if (! $token && ! $externalId) {
                Log::warning('ZapSign webhook missing required fields', [
                    'payload' => $request->all(),
                ]);

                return response()->json([
                    'success' => false,
                    'message' => 'Missing required fields: token or external_id',
                ], 400);
            }

            // Busca o envelope pelo token ou external_id
            $envelope = $this->findEnvelope($token, $externalId);

            if (! $envelope) {
                Log::warning('ZapSign webhook - envelope not found', [
                    'token' => $token,
                    'external_id' => $externalId,
                ]);

                // Retorna 200 mesmo assim para evitar retries do ZapSign
                return response()->json([
                    'success' => true,
                    'message' => 'Envelope not found, but acknowledged',
                ], 200);
            }

            // Processa os diferentes tipos de eventos
            $this->processWebhookEvent($envelope, $eventType, $request->all());

            // Retorna 200 para o ZapSign
            return response()->json([
                'success' => true,
                'message' => 'Webhook processed successfully',
            ], 200);
        } catch (Exception $e) {
            Log::error('Error processing ZapSign webhook', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'payload' => $request->all(),
            ]);

            // Retorna 200 mesmo com erro para evitar retries infinitos
            return response()->json([
                'success' => true,
                'message' => 'Webhook acknowledged with errors',
            ], 200);
        }
    }

    /**
     * Busca o envelope pelo token do ZapSign ou external_id
     */
    private function findEnvelope(?string $token, ?string $externalId): ?Envelope
    {
        // Primeiro tenta buscar pelo token do ZapSign
        if ($token) {
            $envelope = Envelope::where('zapsign_token', $token)->first();
            if ($envelope) {
                return $envelope;
            }
        }

        // Se não encontrou, tenta pelo external_id
        if ($externalId) {
            // O external_id tem formato "envelope_{id}"
            $envelopeId = str_replace('envelope_', '', $externalId);
            if (is_numeric($envelopeId)) {
                return Envelope::find($envelopeId);
            }
        }

        return null;
    }

    /**
     * Processa o evento do webhook
     */
    private function processWebhookEvent(Envelope $envelope, ?string $eventType, array $payload): void
    {
        $zapSignService = app(ZapSignService::class);

        // Eventos que devem atualizar o envelope e os signatários
        $updateEvents = [
            'doc_signed',           // Signatário assinou
            'doc_refused',          // Documento foi recusado
            'doc_expired',          // Documento expirou
            'created_signer',       // Novo signatário adicionado
            'doc_viewed',           // Signatário visualizou
            'doc_read_confirmation', // Signatário confirmou leitura
        ];

        if (in_array($eventType, $updateEvents) || ! $eventType) {
            // Extrai dados dos signatários se disponíveis no payload
            $signersData = $payload['signers'] ?? null;

            // Atualiza o envelope usando o serviço
            $zapSignService->updateEnvelopeFromZapSign(
                $envelope->zapsign_token,
                $envelope,
                $signersData
            );

            Log::info('Envelope updated from webhook', [
                'envelope_id' => $envelope->id,
                'event_type' => $eventType,
            ]);
        }

        // Para evento de documento deletado, pode marcar como cancelado
        if ($eventType === 'doc_deleted') {
            $envelope->update([
                'status' => 'cancelled',
                'zapsign_status' => 'deleted',
            ]);

            Log::info('Envelope marked as deleted', [
                'envelope_id' => $envelope->id,
            ]);
        }
    }
}
