<?php

declare(strict_types=1);

namespace App\Filament\Pages\Auth;

use App\Notifications\NewUserRegistered;
use Filament\Auth\Pages\Register;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Model;
use Leandrocfe\FilamentPtbrFormFields\PhoneNumber;

final class RegisterUser extends Register
{
    protected ?string $heading = 'Criar uma conta';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('info')
                    ->label('Preencha os dados abaixo para criar sua conta.')
                    ->state('Teste gratuitamente por 7 dias.')
                    ->badge()
                    ->extraAttributes(['class' => 'bg-primary-100 text-primary-800 dark:bg-primary-900 dark:text-primary-200'])
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
                    ->required()
                    ->maxLength(20),
                $this->getPasswordFormComponent()
                    ->label('Senha')
                    ->placeholder('Digite sua senha')
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
