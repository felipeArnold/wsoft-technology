<?php

declare(strict_types=1);

namespace App\Filament\Pages\Auth;

use App\Notifications\NewUserRegistered;
use Carbon\Carbon;
use Filament\Auth\Pages\Register;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Model;
use Leandrocfe\FilamentPtbrFormFields\PhoneNumber;

final class RegisterUser extends Register
{
    protected ?string $heading = 'Comece seu teste grátis de 7 dias';

    protected ?string $subheading = 'Sem cartão de crédito. Cancele quando quiser.';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([

                TextEntry::make('trial_info')
                    ->label('7 DIAS GRÁTIS')
                    ->state('Teste completo sem limitações.')
                    ->badge()
                    ->color('success')
                    ->size('lg')
                    ->extraAttributes(['class' => 'text-center'])
                    ->columnSpanFull(),

                TextEntry::make('pricing_info')
                    ->hiddenLabel()
                    ->state('Após o período de teste: R$ 29,90/mês (sem contratos ou taxas ocultas)')
                    ->extraAttributes(['class' => 'text-center text-sm text-gray-600 dark:text-gray-400 font-medium'])
                    ->columnSpanFull(),

                TextEntry::make('guarantee')
                    ->hiddenLabel()
                    ->state('🔒 Seus dados estão seguros | ⚡ Cancele quando quiser, sem multas')
                    ->extraAttributes(['class' => 'text-center text-xs text-gray-500 dark:text-gray-500 mt-2'])
                    ->columnSpanFull(),

                TextEntry::make('billing_date_info')
                    ->hiddenLabel()
                    ->state(function () {
                        $billingDate = Carbon::now()->addDays(7);

                        return '💳 Primeira cobrança somente em: '.$billingDate->format('d/m/Y').' (daqui a 7 dias)';
                    })
                    ->extraAttributes(['class' => 'text-center text-sm bg-blue-50 dark:bg-blue-900/20 text-blue-700 dark:text-blue-300 p-3 rounded-lg border border-blue-200 dark:border-blue-800 font-medium mt-4'])
                    ->columnSpanFull(),

                $this->getNameFormComponent()
                    ->label('Nome completo')
                    ->placeholder('Digite seu nome completo')
                    ->required()
                    ->maxLength(255),
                $this->getEmailFormComponent()
                    ->label('E-mail')
                    ->placeholder('seu@email.com')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                PhoneNumber::make('phone')
                    ->label('Telefone')
                    ->placeholder('(00) 00000-0000')
                    ->required()
                    ->maxLength(20),
                $this->getPasswordFormComponent()
                    ->label('Senha')
                    ->placeholder('Mínimo 8 caracteres')
                    ->required()
                    ->minLength(8)
                    ->password()
                    ->revealable(),
                $this->getPasswordConfirmationFormComponent()
                    ->label('Confirmar senha')
                    ->placeholder('Digite sua senha novamente')
                    ->required()
                    ->password()
                    ->revealable(),
            ]);
    }

    protected function handleRegistration(array $data): Model
    {
        $user = $this->getUserModel()::create($data);

        // Send notification to user
        $user->notify(new NewUserRegistered($user));

        return $user;
    }
}
