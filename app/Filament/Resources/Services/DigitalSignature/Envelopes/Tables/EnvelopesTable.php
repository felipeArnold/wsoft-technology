<?php

declare(strict_types=1);

namespace App\Filament\Resources\Services\DigitalSignature\Envelopes\Tables;

use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use App\Models\DigitalSignature\Envelope;
use App\Services\DigitalSignature\ZapSignService;
use Exception;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class EnvelopesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nome')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('status')
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
                TextColumn::make('deadline')
                    ->label('Prazo')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('signers_count')
                    ->label('Signatários')
                    ->counts('signers')
                    ->badge()
                    ->color('primary'),
                TextColumn::make('user.name')
                    ->label('Criado por')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                Action::make('send_to_zapsign')
                    ->label('Enviar para Assinatura')
                    ->icon(Heroicon::PaperAirplane)
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Enviar para ZApSign')
                    ->modalDescription('Deseja enviar este envelope para assinatura digital via ZApSign?')
                    ->modalSubmitActionLabel('Enviar')
                    ->visible(fn (Envelope $record): bool => $record->zapsign_token === null)
                    ->action(function (Envelope $record): void {
                        // Validações
                        if ($record->signers()->count() === 0) {
                            Notification::make()
                                ->title('Erro ao enviar')
                                ->body('O envelope precisa ter pelo menos um signatário.')
                                ->danger()
                                ->send();

                            return;
                        }

                        if (empty($record->documents) || ! is_array($record->documents)) {
                            Notification::make()
                                ->title('Erro ao enviar')
                                ->body('O envelope precisa ter pelo menos um documento.')
                                ->danger()
                                ->send();

                            return;
                        }

                        try {
                            $zapSignService = app(ZapSignService::class);
                            $response = $zapSignService->createDocument($record);

                            // Atualiza o envelope e signatários com os dados retornados
                            $zapSignService->updateEnvelopeFromZapSign(
                                $response['token'],
                                $record,
                                $response['signers'] ?? []
                            );

                            // Atualiza campos adicionais específicos do envio
                            $record->update([
                                'zapsign_sent_at' => now(),
                                'status' => 'sent',
                            ]);

                            Notification::make()
                                ->title('Envelope enviado com sucesso')
                                ->body('O envelope foi enviado para assinatura digital via ZApSign.')
                                ->success()
                                ->send();
                        } catch (Exception $e) {
                            dd($e);
                            Notification::make()
                                ->title('Erro ao enviar envelope')
                                ->body($e->getMessage())
                                ->danger()
                                ->send();
                        }
                    }),
                Action::make('update_status')
                    ->label('Atualizar Status')
                    ->icon(Heroicon::ArrowPath)
                    ->color('info')
                    ->visible(fn (Envelope $record): bool => $record->zapsign_token !== null)
                    ->action(function (Envelope $record): void {
                        try {
                            $zapSignService = app(ZapSignService::class);

                            // Atualiza os dados do envelope consultando a API do ZapSign
                            $zapSignService->updateEnvelopeFromZapSign(
                                $record->zapsign_token,
                                $record
                            );

                            Notification::make()
                                ->title('Status atualizado com sucesso')
                                ->body('Os dados do envelope foram atualizados com sucesso.')
                                ->success()
                                ->send();
                        } catch (Exception $e) {
                            Notification::make()
                                ->title('Erro ao atualizar status')
                                ->body($e->getMessage())
                                ->danger()
                                ->send();
                        }
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
                FilamentExportBulkAction::make('export')->label('Exportar'),
            ])
            ->striped()
            ->emptyStateIcon('heroicon-o-inbox')
            ->emptyStateHeading('Nenhum envelope encontrado')
            ->emptyStateDescription('Crie um novo envelope para começar a enviar documentos para assinatura.')
            ->emptyStateActions([
                Action::make('create')
                    ->label('Criar Envelope')
                    ->url('envelopes/create')
                    ->icon('heroicon-o-plus'),
            ]);
    }
}
