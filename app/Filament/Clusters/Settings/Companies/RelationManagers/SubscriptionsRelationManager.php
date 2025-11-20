<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\Companies\RelationManagers;

use Filament\Actions\Action;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Laravel\Cashier\Subscription;
use Stripe\StripeClient;

final class SubscriptionsRelationManager extends RelationManager
{
    protected static string $relationship = 'subscriptions';

    protected static ?string $title = 'Assinaturas';

    protected static ?string $modelLabel = 'Assinatura';

    protected static ?string $pluralModelLabel = 'Assinaturas';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nome')
                    ->searchable(),
                TextColumn::make('stripe_status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success',
                        'trialing' => 'info',
                        'past_due' => 'warning',
                        'canceled', 'incomplete', 'incomplete_expired', 'unpaid' => 'danger',
                        default => 'gray',
                    }),
                TextColumn::make('stripe_price')
                    ->label('Preço ID')
                    ->copyable()
                    ->copyMessage('Copiado!'),
                TextColumn::make('quantity')
                    ->label('Quantidade'),
                TextColumn::make('trial_ends_at')
                    ->label('Fim do Trial')
                    ->dateTime('d/m/Y H:i')
                    ->placeholder('—'),
                TextColumn::make('ends_at')
                    ->label('Termina em')
                    ->dateTime('d/m/Y H:i')
                    ->placeholder('—'),
                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->recordActions([
                Action::make('view_invoice')
                    ->label('Ver Fatura')
                    ->icon('heroicon-o-document-text')
                    ->url(function (Action $action): ?string {
                        /** @var Subscription $subscription */
                        $subscription = $action->getRecord();

                        $stripe = new StripeClient(config('cashier.secret'));

                        $invoices = $stripe->invoices->all([
                            'subscription' => $subscription->stripe_id,
                            'limit' => 1,
                        ]);

                        if ($invoices->data && count($invoices->data) > 0) {
                            return $invoices->data[0]->hosted_invoice_url;
                        }

                        return null;
                    })
                    ->openUrlInNewTab(),
                Action::make('download_invoice')
                    ->label('Baixar PDF')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->url(function (Action $action): ?string {
                        /** @var Subscription $subscription */
                        $subscription = $action->getRecord();

                        $stripe = new StripeClient(config('cashier.secret'));

                        $invoices = $stripe->invoices->all([
                            'subscription' => $subscription->stripe_id,
                            'limit' => 1,
                        ]);

                        if ($invoices->data && count($invoices->data) > 0) {
                            return $invoices->data[0]->invoice_pdf;
                        }

                        return null;
                    })
                    ->openUrlInNewTab(),
            ])
            ->defaultSort('created_at', 'desc')
            ->paginated(false);
    }
}
