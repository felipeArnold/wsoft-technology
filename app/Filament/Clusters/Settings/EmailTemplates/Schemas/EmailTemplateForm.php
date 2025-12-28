<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\EmailTemplates\Schemas;

use App\Enum\Template\TemplateContext;
use App\Filament\Clusters\Settings\EmailTemplates\Actions\GenerateEmailTemplateWithAI;
use App\Services\Template\TemplateVariableRegistry;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Components\ViewField;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

final class EmailTemplateForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Template de E-mail')
                    ->description('Configure o template de e-mail usando as variáveis disponíveis.')
                    ->schema([
                        ToggleButtons::make('is_active')
                            ->label('Ativo')
                            ->boolean()
                            ->inline()
                            ->grouped()
                            ->default(true)
                            ->required()
                            ->columnSpan(2),
                        TextInput::make('name')
                            ->label('Nome')
                            ->required(),
                        TextInput::make('subject')
                            ->label('Assunto')
                            ->required()
                            ->helperText('Você pode usar variáveis, ex.: {{customer.name}}'),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
                Grid::make()
                    ->schema([
                        Section::make('Variáveis')
                            ->schema([
                                Select::make('context')
                                    ->label('Contexto para variáveis')
                                    ->enum(TemplateContext::class)
                                    ->default(TemplateContext::ServiceOrder)
                                    ->native(false)
                                    ->live(),
                                ViewField::make('variables_copy_list')
                                    ->view('filament.forms.components.template-variables-list')
                                    ->viewData(function (callable $get) {
                                        $context = $get('context') ?? TemplateContext::ServiceOrder;

                                        return [
                                            'variables' => TemplateVariableRegistry::variablesFor($context),
                                        ];
                                    })
                                    ->columnSpanFull()
                                    ->helperText('Clique em copiar para inserir no Assunto ou Conteúdo.'),
                            ]),
                        Section::make('Template')
                            ->schema([
                                RichEditor::make('body')
                                    ->label('Conteúdo do e-mail')
                                    ->columnSpanFull()
                                    ->required()
                                    ->toolbarButtons([
                                        'bold', 'italic', 'underline', 'strike', 'link', 'redo', 'undo', 'bulletList', 'orderedList', 'blockquote', 'codeBlock',
                                    ])
                                    ->helperText('Insira o corpo do e-mail usando as variáveis disponíveis na aba "Variáveis".')
                                    ->hintActions([
                                        GenerateEmailTemplateWithAI::make(),
                                    ]),
                            ])
                            ->description('Use o botão "Gerar com IA" para criar um template automaticamente.'),

                    ])
                    ->columns(2)
                    ->columnSpanFull(),

            ]);
    }
}
