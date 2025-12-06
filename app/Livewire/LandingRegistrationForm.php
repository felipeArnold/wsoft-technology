<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Lead;
use App\Models\User;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;
use Livewire\Component;

class LandingRegistrationForm extends Component
{
    #[Validate('required|string|max:255', message: 'O nome é obrigatório')]
    public string $name = '';

    #[Validate('required|string|max:20', message: 'O telefone é obrigatório')]
    public string $phone = '';

    #[Validate('required|email|max:255|unique:users', message: 'Digite um e-mail válido que não esteja em uso')]
    public string $email = '';


    public string $source = 'landing_mecanica';

    public string $title = 'Crie sua conta grátis';
    public string $subtitle = 'Junte-se a mais de 500 oficinas que já modernizaram sua gestão com o WSoft.';
    public string $gradient = 'from-emerald-600 to-teal-700';
    public string $buttonText = 'Cadastrar Grátis';
    public string $buttonColor = 'emerald';
    public string $focusColor = 'emerald';

    public bool $showSuccessMessage = false;
    public bool $showErrorMessage = false;
    public string $errorMessage = '';

    public function submit(): void
    {
        $this->validate();

        try {
            $user = User::query()->create([
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'password' => Hash::make('password123'),
            ]);

            event(new Registered($user));

            Auth::login($user);

            $this->showSuccessMessage = true;
            $this->showErrorMessage = false;
            $this->reset(['name', 'phone', 'email']);

            $this->redirect(route('filament.app.tenant.registration'), navigate: false);

            $this->dispatch('lead-created');
        } catch (Exception $e) {
            $this->showErrorMessage = true;
            $this->errorMessage = 'Ocorreu um erro ao enviar seus dados. Tente novamente.';
            $this->showSuccessMessage = false;
        }
    }

    public function render()
    {
        return view('livewire.landing-registration-form');
    }
}
