<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\EmailTemplates\Actions;

use App\Services\AI\EmailTemplateAIGenerator;
use Exception;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;

final class GenerateEmailTemplateWithAI extends Action
{
    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->label('Gerar com IA')
            ->icon('heroicon-o-sparkles')
            ->color('primary')
            ->visible(fn (string $operation): bool => in_array($operation, ['create', 'edit']))
            ->requiresConfirmation()
            ->modalHeading('Gerar Template de Email com IA')
            ->modalDescription('Escolha o tipo de email que deseja gerar e a IA criará um template profissional para você.')
            ->modalSubmitActionLabel('Gerar')
            ->modalIcon('heroicon-o-sparkles')
            ->modalWidth('2xl')
            ->form($this->getFormSchema())
            ->action(fn (array $data, callable $set) => $this->execute($data, $set));
    }

    public static function make(?string $name = 'generateWithAI'): static
    {
        return parent::make($name);
    }

    protected function getFormSchema(): array
    {
        return [
            Select::make('template_type')
                ->label('Tipo de Email')
                ->options(function () {
                    $generator = new EmailTemplateAIGenerator;
                    $types = $generator->getTemplateTypes();

                    return collect($types)->mapWithKeys(fn ($type, $key) => [$key => $type['label']]);
                })
                ->required()
                ->native(false)
                ->live()
                ->afterStateUpdated(function ($state, callable $set) {
                    if ($state === 'custom') {
                        $set('context', '');
                    } else {
                        $generator = new EmailTemplateAIGenerator;
                        $types = $generator->getTemplateTypes();
                        $set('context', $types[$state]['context'] ?? '');
                    }
                })
                ->helperText('Selecione o tipo de email que deseja gerar.'),

            Textarea::make('context')
                ->label('Contexto/Instruções')
                ->rows(3)
                ->required()
                ->helperText('Descreva o contexto ou forneça instruções específicas para o template (ex: "Incluir informações sobre garantia de 90 dias").'),

            Select::make('tone')
                ->label('Tom do Email')
                ->options([
                    'profissional' => 'Profissional',
                    'amigável' => 'Amigável',
                    'formal' => 'Formal',
                    'casual' => 'Casual',
                    'urgente' => 'Urgente',
                ])
                ->default('profissional')
                ->required()
                ->native(false)
                ->helperText('Escolha o tom apropriado para o email.'),
        ];
    }

    protected function execute(array $data, callable $set): void
    {
        try {
            $generator = new EmailTemplateAIGenerator;

            // Pega as variáveis do tipo selecionado
            $types = $generator->getTemplateTypes();
            $variables = $types[$data['template_type']]['variables'] ?? [];

            $result = $generator->generateEmailTemplate(
                templateType: $types[$data['template_type']]['label'] ?? $data['template_type'],
                context: $data['context'],
                tone: $data['tone'],
                variables: $variables,
            );

            // Atualiza os campos do formulário
            $set('subject', $result['subject']);
            $set('body', $result['body']);

            Notification::make()
                ->success()
                ->title('Template gerado com sucesso!')
                ->body('O template de email foi gerado pela IA. Revise e ajuste conforme necessário.')
                ->send();
        } catch (Exception $e) {
            Notification::make()
                ->danger()
                ->title('Erro ao gerar template')
                ->body($e->getMessage())
                ->persistent()
                ->send();
        }
    }
}
