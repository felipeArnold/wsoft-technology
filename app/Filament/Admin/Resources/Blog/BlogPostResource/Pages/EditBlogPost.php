<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Blog\BlogPostResource\Pages;

use App\Filament\Admin\Resources\Blog\BlogPostResource\BlogPostResource;
use App\Models\Blog\BlogPost;
use App\Services\AI\BlogPostGenerator;
use Exception;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

final class EditBlogPost extends EditRecord
{
    protected static string $resource = BlogPostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('improve_with_ai')
                ->label('Melhorar com IA')
                ->icon('heroicon-o-sparkles')
                ->color('warning')
                ->requiresConfirmation()
                ->modalHeading('Melhorar post com IA?')
                ->modalDescription('A IA vai analisar o conteúdo atual e sugerir melhorias. Você poderá revisar antes de salvar.')
                ->modalSubmitActionLabel('Melhorar Post')
                ->action(function (BlogPostGenerator $generator): void {
                    try {
                        /** @var BlogPost $post */
                        $post = $this->record;
                        $improvedData = $generator->improveExistingPost($post);

                        $this->form->fill($improvedData);

                        Notification::make()
                            ->title('Post melhorado!')
                            ->body('O conteúdo foi atualizado. Revise as mudanças e salve se estiver satisfeito.')
                            ->success()
                            ->send();
                    } catch (Exception $e) {
                        Notification::make()
                            ->title('Erro ao melhorar post')
                            ->body($e->getMessage())
                            ->danger()
                            ->send();
                    }
                }),
            Action::make('generate_seo')
                ->label('Gerar SEO com IA')
                ->icon('heroicon-o-magnifying-glass')
                ->color('info')
                ->action(function (BlogPostGenerator $generator): void {
                    try {
                        /** @var BlogPost $post */
                        $post = $this->record;
                        $seoData = $generator->generateSEOMetadata(
                            $post->title,
                            $post->content,
                        );

                        $this->form->fill([
                            'meta_title' => $seoData['meta_title'],
                            'meta_description' => $seoData['meta_description'],
                        ]);

                        Notification::make()
                            ->title('Metadados SEO gerados!')
                            ->body('Os campos de SEO foram atualizados. Revise e salve se necessário.')
                            ->success()
                            ->send();
                    } catch (Exception $e) {
                        Notification::make()
                            ->title('Erro ao gerar SEO')
                            ->body($e->getMessage())
                            ->danger()
                            ->send();
                    }
                }),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if ($data['status'] === 'published' && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        return $data;
    }
}
