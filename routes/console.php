<?php

declare(strict_types=1);

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function (): void {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Agenda geração de posts de blog para atrair leads (2x ao dia)
Schedule::command('blog:generate-daily --publish')
    ->twiceDaily(9, 15)
    ->timezone('America/Sao_Paulo')
    ->withoutOverlapping()
    ->onSuccess(function (): void {
        Log::info('Post de blog gerado com sucesso via schedule');
    })
    ->onFailure(function (): void {
        Log::error('Falha ao gerar post de blog via schedule');
    });

// Agenda envio de notificações de trial e cadastro incompleto
Schedule::command('trial:notify')
    ->dailyAt('10:00')
    ->timezone('America/Sao_Paulo')
    ->withoutOverlapping()
    ->onSuccess(function (): void {
        Log::info('Notificações de trial enviadas com sucesso via schedule');
    })
    ->onFailure(function (): void {
        Log::error('Falha ao enviar notificações de trial via schedule');
    });
