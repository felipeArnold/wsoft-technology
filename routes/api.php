<?php

declare(strict_types=1);

use App\Http\Controllers\Webhook\ZapSignController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Webhooks - Rotas públicas (sem autenticação)
Route::post('/webhooks/zapsign', ZapSignController::class);

Route::post('/stripe/webhook', App\Http\Controllers\Stripe\StripeWebhookController::class);
