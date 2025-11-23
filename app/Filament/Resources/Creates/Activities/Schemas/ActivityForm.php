<?php

declare(strict_types=1);

namespace App\Filament\Resources\Creates\Activities\Schemas;

use App\Models\Person\Person;
use Filament\Facades\Filament;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

final class ActivityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informações da Atividade')
                    ->icon('heroicon-o-clipboard-document-check')
                    ->description('Defina os detalhes principais da atividade')
                    ->schema([
                        TextInput::make('title')
                            ->label('Título')
                            ->required()
                            ->placeholder('Ex: Ligar para cliente sobre proposta')
                            ->maxLength(255)
                            ->columnSpan(2),
                        Select::make('type')
                            ->label('Tipo')
                            ->options([
                                'call' => 'Ligação',
                                'meeting' => 'Reunião',
                                'email' => 'E-mail',
                                'task' => 'Tarefa',
                                'follow_up' => 'Follow-up',
                                'other' => 'Outro',
                            ])
                            ->default('task')
                            ->required()
                            ->native(false)
                            ->columnSpan(1),
                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'pending' => 'Pendente',
                                'in_progress' => 'Em Andamento',
                                'completed' => 'Concluído',
                                'cancelled' => 'Cancelado',
                            ])
                            ->default('pending')
                            ->required()
                            ->native(false)
                            ->columnSpan(1),
                        Select::make('priority')
                            ->label('Prioridade')
                            ->options([
                                'low' => 'Baixa',
                                'medium' => 'Média',
                                'high' => 'Alta',
                                'urgent' => 'Urgente',
                            ])
                            ->default('medium')
                            ->required()
                            ->native(false)
                            ->columnSpan(1),
                        DatePicker::make('due_date')
                            ->label('Data de Vencimento')
                            ->displayFormat('d/m/Y')
                            ->native(false)
                            ->columnSpan(1),
                        RichEditor::make('description')
                            ->label('Descrição')
                            ->placeholder('Descreva os detalhes da atividade...')
                            ->columnSpanFull(),
                    ])
                    ->columns(3)
                    ->columnSpanFull(),

                Section::make('Relacionamentos')
                    ->icon('heroicon-o-link')
                    ->description('Vincule a atividade a clientes e responsáveis')
                    ->schema([
                        Select::make('person_id')
                            ->label('Cliente/Contato')
                            ->relationship('person', 'name')
                            ->searchable()
                            ->preload()
                            ->placeholder('Selecione um cliente')
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->label('Nome')
                                    ->required(),
                                TextInput::make('cpf_cnpj')
                                    ->label('CPF/CNPJ')
                                    ->required(),
                                TextInput::make('mobile_phone')
                                    ->label('Telefone'),
                                TextInput::make('email')
                                    ->label('E-mail')
                                    ->email(),
                            ])
                            ->createOptionUsing(function (array $data): int {
                                $person = Person::create([
                                    'client_or_supplier' => 'client',
                                    'name' => $data['name'],
                                    'cpf_cnpj' => $data['cpf_cnpj'],
                                    'mobile_phone' => $data['mobile_phone'] ?? null,
                                    'email' => $data['email'] ?? null,
                                    'type' => 'PF',
                                    'tenant_id' => Filament::getTenant()->id,
                                ]);

                                return $person->id;
                            })
                            ->columnSpan(1),
                        Select::make('assigned_to')
                            ->label('Responsável')
                            ->relationship('assignedTo', 'name')
                            ->searchable()
                            ->preload()
                            ->placeholder('Selecione um responsável')
                            ->columnSpan(1),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                Section::make('Observações')
                    ->icon('heroicon-o-chat-bubble-bottom-center-text')
                    ->schema([
                        Textarea::make('notes')
                            ->label('Notas Adicionais')
                            ->placeholder('Adicione observações ou notas importantes...')
                            ->rows(4)
                            ->columnSpanFull(),
                    ])
                    ->collapsible()
                    ->collapsed()
                    ->columnSpanFull(),
            ]);
    }
}
