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
                    ->sortable()
                    ->searchable()
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
                    })
                    ->icon(fn (string $state): string => match ($state) {
                        'draft' => 'heroicon-o-document',
                        'sent' => 'heroicon-o-paper-airplane',
                        'signed' => 'heroicon-o-check-circle',
                        'expired' => 'heroicon-o-clock',
                        'cancelled' => 'heroicon-o-x-circle',
                    }),
                TextColumn::make('deadline')
                    ->label('Prazo')
                    ->date('d/m/Y')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('signers_list')
                    ->label('Signatários')
                    ->state(function (Envelope $record): string {
                        if ($record->signers->isEmpty()) {
                            return '<span class="text-gray-400 text-sm">Nenhum signatário</span>';
                        }

                        $signersHtml = [];
                        foreach ($record->signers as $signer) {
                            $statusIcon = match ($signer->status) {
                                'signed' => '✓',
                                'rejected' => '✕',
                                'expired' => '⏱',
                                default => '○',
                            };

                            $statusColor = match ($signer->status) {
                                'signed' => 'text-success-600',
                                'rejected' => 'text-danger-600',
                                'expired' => 'text-warning-600',
                                default => 'text-gray-400',
                            };

                            $statusLabel = match ($signer->status) {
                                'pending' => 'Pendente',
                                'signed' => 'Assinado',
                                'rejected' => 'Rejeitado',
                                'expired' => 'Expirado',
                                default => 'Pendente',
                            };

                            $signersHtml[] = sprintf(
                                '<div class="flex items-center gap-1 text-sm py-0.5"><span class="%s font-bold text-base">%s</span> <span class="font-medium">%s</span> <span class="text-xs text-gray-500">(%s)</span></div>',
                                $statusColor,
                                $statusIcon,
                                e($signer->name),
                                $statusLabel
                            );
                        }

                        return implode('', $signersHtml);
                    })
                    ->html()
                    ->wrap(),
                TextColumn::make('progress')
                    ->label('Progresso')
                    ->formatStateUsing(function (Envelope $record): string {
                        $total = $record->signers->count();
                        if ($total === 0) {
                            return '0/0';
                        }

                        $signed = $record->signers->where('status', 'signed')->count();
                        $percentage = round(($signed / $total) * 100);

                        return sprintf('%d/%d (%d%%)', $signed, $total, $percentage);
                    })
                    ->badge()
                    ->color(function (Envelope $record): string {
                        $total = $record->signers->count();
                        if ($total === 0) {
                            return 'gray';
                        }

                        $signed = $record->signers->where('status', 'signed')->count();
                        $percentage = ($signed / $total) * 100;

                        return match (true) {
                            $percentage >= 100 => 'success',
                            $percentage >= 50 => 'warning',
                            default => 'danger',
                        };
                    }),
                TextColumn::make('user.name')
                    ->label('Criado por')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            ->filters([
                \Filament\Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'draft' => 'Rascunho',
                        'sent' => 'Enviado',
                        'signed' => 'Assinado',
                        'expired' => 'Expirado',
                        'cancelled' => 'Cancelado',
                    ])
                    ->multiple(),
                \Filament\Tables\Filters\SelectFilter::make('signer_status')
                    ->label('Status do Signatário')
                    ->options([
                        'pending' => 'Pendente',
                        'signed' => 'Assinado',
                        'rejected' => 'Rejeitado',
                        'expired' => 'Expirado',
                    ])
                    ->query(function ($query, array $data) {
                        if (! empty($data['value'])) {
                            $query->whereHas('signers', function ($q) use ($data) {
                                $q->where('status', $data['value']);
                            });
                        }
                    })
                    ->indicateUsing(function (array $data): ?string {
                        if (empty($data['value'])) {
                            return null;
                        }

                        $labels = [
                            'pending' => 'Pendente',
                            'signed' => 'Assinado',
                            'rejected' => 'Rejeitado',
                            'expired' => 'Expirado',
                        ];

                        return 'Signatários: '.$labels[$data['value']];
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
                FilamentExportBulkAction::make('export')->label('Exportar'),
            ])
            ->defaultSort('created_at', 'desc')
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
