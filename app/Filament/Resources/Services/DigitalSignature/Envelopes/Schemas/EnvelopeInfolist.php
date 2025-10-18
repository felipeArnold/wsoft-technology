<?php

declare(strict_types=1);

namespace App\Filament\Resources\Services\DigitalSignature\Envelopes\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ViewEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

final class EnvelopeInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Informações do Envelope')
                ->icon('heroicon-o-envelope')
                ->schema([
                    TextEntry::make('name')
                        ->label('Nome do Envelope'),
                    TextEntry::make('description')
                        ->label('Descrição')
                        ->html(),
                    TextEntry::make('deadline')
                        ->label('Prazo para Assinatura')
                        ->date('d/m/Y'),
                    TextEntry::make('status')
                        ->label('Status')
                        ->badge()
                        ->color(fn (string $state): string => match ($state) {
                            'draft' => 'gray',
                            'sent' => 'warning',
                            'signed' => 'success',
                            'expired' => 'danger',
                            'cancelled' => 'danger',
                        })
                        ->formatStateUsing(fn (string $state): string => match ($state) {
                            'draft' => 'Rascunho',
                            'sent' => 'Enviado',
                            'signed' => 'Assinado',
                            'expired' => 'Expirado',
                            'cancelled' => 'Cancelado',
                        }),
                ])
                ->columns(2)
                ->columnSpanFull(),

            Section::make('Documentos')
                ->icon('heroicon-o-document')
                ->schema([
                    ViewEntry::make('documents')
                        ->label('Documentos')
                        ->view('filament.infolists.components.document-list'),
                ])
                ->columnSpanFull(),

            Section::make('Informações do Sistema')
                ->icon('heroicon-o-information-circle')
                ->schema([
                    TextEntry::make('user.name')
                        ->label('Criado por'),
                    TextEntry::make('created_at')
                        ->label('Criado em')
                        ->dateTime('d/m/Y H:i'),
                    TextEntry::make('updated_at')
                        ->label('Atualizado em')
                        ->dateTime('d/m/Y H:i'),
                ])
                ->columns(3)
                ->columnSpanFull(),
        ]);
    }
}
