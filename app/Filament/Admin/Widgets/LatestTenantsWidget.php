<?php

declare(strict_types=1);

namespace App\Filament\Admin\Widgets;

use App\Filament\Admin\Resources\TenantResource;
use App\Models\Tenant;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

final class LatestTenantsWidget extends BaseWidget
{
    protected static ?int $sort = 4;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->heading('Últimas Empresas Cadastradas')
            ->query(
                Tenant::query()->latest()->limit(10)
            )
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                TextColumn::make('name')
                    ->label('Nome')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                TextColumn::make('members_count')
                    ->label('Usuários')
                    ->counts('members'),
                TextColumn::make('subscriptions.stripe_status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success',
                        'trialing' => 'info',
                        'canceled' => 'danger',
                        'past_due' => 'warning',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'active' => 'Ativa',
                        'trialing' => 'Trial',
                        'canceled' => 'Cancelada',
                        'past_due' => 'Vencida',
                        default => 'Sem assinatura',
                    }),
                TextColumn::make('created_at')
                    ->label('Cadastrado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->actions([
                Action::make('view')
                    ->label('Ver')
                    ->icon('heroicon-m-eye')
                    ->url(fn (Tenant $record): string => TenantResource::getUrl('view', ['record' => $record])),
            ]);
    }
}
