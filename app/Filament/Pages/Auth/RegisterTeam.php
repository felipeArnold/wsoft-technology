<?php

declare(strict_types=1);

namespace App\Filament\Pages\Auth;

use App\Helpers\FormatterHelper;
use App\Models\Tenant;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Tenancy\RegisterTenant;
use Filament\Schemas\Schema;
use Leandrocfe\FilamentPtbrFormFields\Document;

final class RegisterTeam extends RegisterTenant
{
    public static function getLabel(): string
    {
        return 'Registrar Empresa';
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nome da empresa')
                    ->required()
                    ->maxLength(255),
                Document::make('document')
                    ->label('CPF/CNPJ')
                    ->dynamic(),
                TextInput::make('website')
                    ->label('Website')
                    ->url()
                    ->maxLength(255),
            ]);
    }

    protected function handleRegistration(array $data): Tenant
    {
        $data['slug'] = Tenant::generateUniqueSlug($data['name']);
        $data['document'] = FormatterHelper::onlyNumbers($data['document'] ?? '');
        $team = Tenant::query()->create($data);

        $team->members()->attach(auth()->user());

        return $team;
    }
}
