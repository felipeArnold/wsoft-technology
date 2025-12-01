<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Blog\BlogPostResource\Pages;

use App\Filament\Admin\Resources\Blog\BlogPostResource\BlogPostResource;
use App\Models\Blog\BlogCategory;
use App\Services\AI\BlogPostGenerator;
use Exception;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;

final class ListBlogPosts extends ListRecords
{
    protected static string $resource = BlogPostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
            Action::make('generate_post')
                ->label('Gerar Post com IA')
                ->icon('heroicon-o-sparkles')
                ->color('primary')
                ->form([
                    TextInput::make('topic')
                        ->label('Tópico do Post')
                        ->placeholder('Ex: Como melhorar a gestão financeira da sua empresa')
                        ->required()
                        ->maxLength(255)
                        ->helperText('Descreva o assunto principal que o post deve abordar'),
                    Select::make('category_id')
                        ->label('Categoria')
                        ->options(BlogCategory::pluck('name', 'id'))
                        ->searchable()
                        ->preload()
                        ->helperText('Opcional: Selecione uma categoria para o post'),
                    Radio::make('tone')
                        ->label('Tom do Conteúdo')
                        ->options([
                            'profissional' => 'Profissional',
                            'casual' => 'Casual',
                            'técnico' => 'Técnico',
                            'educativo' => 'Educativo',
                        ])
                        ->default('profissional')
                        ->required()
                        ->inline()
                        ->inlineLabel(false),
                    Select::make('word_count')
                        ->label('Tamanho do Post')
                        ->options([
                            500 => 'Curto (~500 palavras)',
                            1000 => 'Médio (~1000 palavras)',
                            1500 => 'Longo (~1500 palavras)',
                            2000 => 'Muito Longo (~2000 palavras)',
                        ])
                        ->default(1000)
                        ->required(),
                ])
                ->action(function (array $data, BlogPostGenerator $generator): void {
                    try {
                        $category = isset($data['category_id'])
                            ? BlogCategory::find($data['category_id'])
                            : null;

                        $postData = $generator->generatePost(
                            topic: $data['topic'],
                            category: $category,
                            author: auth()->user(),
                            tone: $data['tone'],
                            wordCount: (int) $data['word_count'],
                        );

                        $post = static::getResource()::getModel()::create($postData);

                        Notification::make()
                            ->title('Post gerado com sucesso!')
                            ->body("O post '{$post->title}' foi criado como rascunho.")
                            ->success()
                            ->send();

                        $this->redirect(static::getResource()::getUrl('edit', ['record' => $post]));
                    } catch (Exception $e) {
                        Notification::make()
                            ->title('Erro ao gerar post')
                            ->body($e->getMessage())
                            ->danger()
                            ->send();
                    }
                })
                ->modalWidth('2xl')
                ->modalSubmitActionLabel('Gerar Post'),
            Action::make('generate_multiple_posts')
                ->label('Gerar Múltiplos Posts')
                ->icon('heroicon-o-document-duplicate')
                ->color('warning')
                ->form([
                    Textarea::make('topics')
                        ->label('Tópicos (um por linha)')
                        ->placeholder("Gestão financeira para pequenas empresas\nDicas de controle de estoque\nComo reduzir custos operacionais")
                        ->required()
                        ->rows(5)
                        ->helperText('Digite cada tópico em uma linha separada'),
                    Select::make('category_id')
                        ->label('Categoria')
                        ->options(BlogCategory::pluck('name', 'id'))
                        ->searchable()
                        ->preload(),
                    Radio::make('tone')
                        ->label('Tom do Conteúdo')
                        ->options([
                            'profissional' => 'Profissional',
                            'casual' => 'Casual',
                            'técnico' => 'Técnico',
                            'educativo' => 'Educativo',
                        ])
                        ->default('profissional')
                        ->required()
                        ->inline()
                        ->inlineLabel(false),
                    Select::make('word_count')
                        ->label('Tamanho dos Posts')
                        ->options([
                            500 => 'Curto (~500 palavras)',
                            1000 => 'Médio (~1000 palavras)',
                            1500 => 'Longo (~1500 palavras)',
                        ])
                        ->default(1000)
                        ->required(),
                ])
                ->action(function (array $data, BlogPostGenerator $generator): void {
                    try {
                        $topics = array_filter(
                            array_map('trim', explode("\n", $data['topics']))
                        );

                        if (count($topics) === 0) {
                            Notification::make()
                                ->title('Erro')
                                ->body('Por favor, forneça pelo menos um tópico.')
                                ->danger()
                                ->send();

                            return;
                        }

                        $category = isset($data['category_id'])
                            ? BlogCategory::find($data['category_id'])
                            : null;

                        $createdCount = 0;

                        foreach ($topics as $topic) {
                            $postData = $generator->generatePost(
                                topic: $topic,
                                category: $category,
                                author: auth()->user(),
                                tone: $data['tone'],
                                wordCount: (int) $data['word_count'],
                            );

                            static::getResource()::getModel()::create($postData);
                            $createdCount++;
                        }

                        Notification::make()
                            ->title('Posts gerados com sucesso!')
                            ->body("{$createdCount} posts foram criados como rascunhos.")
                            ->success()
                            ->send();
                    } catch (Exception $e) {
                        Notification::make()
                            ->title('Erro ao gerar posts')
                            ->body($e->getMessage())
                            ->danger()
                            ->send();
                    }
                })
                ->modalWidth('2xl')
                ->modalSubmitActionLabel('Gerar Posts'),
        ];
    }
}
