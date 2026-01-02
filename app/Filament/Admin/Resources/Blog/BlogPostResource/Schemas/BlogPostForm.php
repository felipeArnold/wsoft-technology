<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Blog\BlogPostResource\Schemas;

use App\Models\Blog\BlogCategory;
use App\Models\Blog\BlogPost;
use App\Services\AI\BlogPostGenerator;
use Exception;
use Filament\Actions\Action;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

final class BlogPostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('post_tabs')
                    ->columnSpanFull()
                    ->tabs([
                        Tab::make('content')
                            ->label('Conteúdo')
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                Section::make('Gerador de Conteúdo com IA')
                                    ->description('Gere automaticamente o conteúdo completo do post com IA')
                                    ->schema([
                                        TextInput::make('ai_topic')
                                            ->label('Tema do Post')
                                            ->placeholder('Ex: Como melhorar a gestão financeira da sua empresa')
                                            ->helperText('Digite o tema e clique no botão para gerar todo o conteúdo automaticamente')
                                            ->dehydrated(false)
                                            ->suffixActions([
                                                Action::make('generate_content')
                                                    ->label('Gerar')
                                                    ->icon('heroicon-o-sparkles')
                                                    ->color('primary')
                                                    ->requiresConfirmation()
                                                    ->modalHeading('Gerar conteúdo com IA?')
                                                    ->modalDescription('Isso vai gerar automaticamente o título, conteúdo, resumo e meta tags SEO baseado no tema fornecido. Os campos atuais serão substituídos.')
                                                    ->modalSubmitActionLabel('Gerar Agora')
                                                    ->action(function (Get $get, Set $set): void {
                                                        $topic = $get('ai_topic');

                                                        if (empty($topic)) {
                                                            Notification::make()
                                                                ->title('Tema obrigatório')
                                                                ->body('Por favor, digite o tema do post antes de gerar.')
                                                                ->warning()
                                                                ->send();

                                                            return;
                                                        }

                                                        try {
                                                            $generator = app(BlogPostGenerator::class);

                                                            $category = $get('category_id')
                                                                ? BlogCategory::query()->find($get('category_id'))
                                                                : null;

                                                            $postData = $generator->generatePost(
                                                                topic: $topic,
                                                                category: $category,
                                                                author: auth()->user(),
                                                                tone: 'profissional',
                                                                wordCount: 1000,
                                                            );

                                                            $set('title', $postData['title']);
                                                            $set('slug', $postData['slug']);
                                                            $set('excerpt', $postData['excerpt']);
                                                            $set('content', $postData['content']);
                                                            $set('meta_title', $postData['meta_title']);
                                                            $set('meta_description', $postData['meta_description']);
                                                            $set('meta_keywords', $postData['meta_keywords'] ?? '');
                                                            $set('featured_snippet', $postData['featured_snippet'] ?? '');
                                                            $set('ai_summary', $postData['ai_summary'] ?? []);
                                                            $set('faq', $postData['faq'] ?? []);
                                                            $set('discover_context', $postData['discover_context'] ?? '');
                                                            $set('internal_links_suggestions', $postData['internal_links_suggestions'] ?? []);
                                                            $set('featured_image', $postData['featured_image'] ?? 'images/logo.png');
                                                            $set('og_image', $postData['og_image'] ?? 'images/logo.png');
                                                            $set('ai_topic', '');

                                                            Notification::make()
                                                                ->title('Conteúdo gerado com sucesso!')
                                                                ->body('Todos os campos foram preenchidos. Revise e ajuste conforme necessário antes de salvar.')
                                                                ->success()
                                                                ->duration(5000)
                                                                ->send();
                                                        } catch (Exception $e) {
                                                            Notification::make()
                                                                ->title('Erro ao gerar conteúdo')
                                                                ->body($e->getMessage())
                                                                ->danger()
                                                                ->send();
                                                        }
                                                    }),
                                            ])
                                            ->columnSpanFull(),
                                    ])
                                    ->collapsible()
                                    ->collapsed(fn (?BlogPost $record) => $record !== null),

                                Section::make('Informações do Post')
                                    ->schema([
                                        TextInput::make('title')
                                            ->label('Título')
                                            ->required()
                                            ->maxLength(255)
                                            ->reactive()
                                            ->afterStateUpdated(function ($state, callable $set): void {
                                                $set('slug', Str::slug($state));
                                            })
                                            ->columnSpan(2),

                                        TextInput::make('slug')
                                            ->label('Slug')
                                            ->required()
                                            ->maxLength(255)
                                            ->unique(BlogPost::class, 'slug', ignoreRecord: true)
                                            ->helperText('URL amigável do post')
                                            ->columnSpan(1),

                                        Select::make('category_id')
                                            ->label('Categoria')
                                            ->options(BlogCategory::where('is_active', true)->pluck('name', 'id'))
                                            ->searchable()
                                            ->preload()
                                            ->columnSpan(1),

                                        Select::make('status')
                                            ->label('Status')
                                            ->options([
                                                'draft' => 'Rascunho',
                                                'published' => 'Publicado',
                                                'scheduled' => 'Agendado',
                                            ])
                                            ->default('draft')
                                            ->required()
                                            ->reactive()
                                            ->columnSpan(1),

                                        DateTimePicker::make('published_at')
                                            ->label('Data de Publicação')
                                            ->displayFormat('d/m/Y H:i')
                                            ->visible(fn ($get) => in_array($get('status'), ['published', 'scheduled']))
                                            ->required(fn ($get) => $get('status') === 'scheduled')
                                            ->columnSpan(1),

                                        Textarea::make('excerpt')
                                            ->label('Resumo')
                                            ->rows(3)
                                            ->maxLength(500)
                                            ->helperText('Breve descrição do post (máx. 500 caracteres)')
                                            ->columnSpanFull(),

                                        RichEditor::make('content')
                                            ->label('Conteúdo')
                                            ->required()
                                            ->toolbarButtons([
                                                'blockquote',
                                                'bold',
                                                'bulletList',
                                                'codeBlock',
                                                'h2',
                                                'h3',
                                                'italic',
                                                'link',
                                                'orderedList',
                                                'redo',
                                                'strike',
                                                'underline',
                                                'undo',
                                            ])
                                            ->columnSpanFull(),
                                    ])
                                    ->columns(3),

                                Section::make('Imagem Destaque')
                                    ->schema([
                                        FileUpload::make('featured_image')
                                            ->label('Imagem')
                                            ->image()
                                            ->imageEditor()
                                            ->directory('blog/featured')
                                            ->visibility('public')
                                            ->maxSize(2048)
                                            ->helperText('Imagem principal do post (máx. 2MB)'),

                                        Toggle::make('is_featured')
                                            ->label('Post em Destaque')
                                            ->helperText('Exibir este post em destaque no blog'),
                                    ])
                                    ->columns(2),
                            ]),

                        Tab::make('seo')
                            ->label('SEO')
                            ->icon('heroicon-o-magnifying-glass')
                            ->schema([
                                Section::make('Meta Tags')
                                    ->description('Configure as meta tags para melhor indexação nos mecanismos de busca')
                                    ->schema([
                                        TextInput::make('meta_title')
                                            ->label('Meta Title')
                                            ->maxLength(70)
                                            ->helperText('Título para SEO (máx. 70 caracteres). Se vazio, usa o título do post.')
                                            ->reactive()
                                            ->afterStateUpdated(function ($state, callable $set): void {
                                                // Contador de caracteres visual
                                            })
                                            ->columnSpanFull(),

                                        Textarea::make('meta_description')
                                            ->label('Meta Description')
                                            ->rows(3)
                                            ->maxLength(160)
                                            ->helperText('Descrição para SEO (máx. 160 caracteres). Se vazio, usa o resumo.')
                                            ->columnSpanFull(),

                                        TextInput::make('meta_keywords')
                                            ->label('Meta Keywords')
                                            ->maxLength(255)
                                            ->helperText('Palavras-chave separadas por vírgula')
                                            ->columnSpanFull(),
                                    ]),

                                Section::make('Open Graph')
                                    ->description('Configurações para compartilhamento em redes sociais')
                                    ->schema([
                                        FileUpload::make('og_image')
                                            ->label('Imagem OG')
                                            ->image()
                                            ->imageEditor()
                                            ->directory('blog/og')
                                            ->visibility('public')
                                            ->maxSize(2048)
                                            ->helperText('Imagem para compartilhamento (1200x630px recomendado). Se vazio, usa a imagem destaque.'),
                                    ]),

                                Section::make('Pré-visualização SEO')
                                    ->schema([
                                        Placeholder::make('seo_preview')
                                            ->label('')
                                            ->content(function ($get) {
                                                $title = $get('meta_title') ?: $get('title') ?: 'Título do Post';
                                                $description = $get('meta_description') ?: $get('excerpt') ?: 'Descrição do post aparecerá aqui...';
                                                $slug = $get('slug') ?: 'url-do-post';

                                                return new HtmlString("
                                                    <div style='font-family: Arial, sans-serif; max-width: 600px;'>
                                                        <div style='color: #1a0dab; font-size: 18px; margin-bottom: 3px;'>{$title}</div>
                                                        <div style='color: #006621; font-size: 14px; margin-bottom: 3px;'>seusite.com/blog/{$slug}</div>
                                                        <div style='color: #545454; font-size: 13px; line-height: 1.4;'>".Str::limit($description, 160).'</div>
                                                    </div>
                                                ');
                                            }),
                                    ])
                                    ->collapsible(),
                            ]),

                        Tab::make('advanced_seo')
                            ->label('SEO Avançado')
                            ->icon('heroicon-o-sparkles')
                            ->schema([
                                Section::make('Featured Snippet')
                                    ->description('Otimização para Posição Zero do Google (40-60 palavras)')
                                    ->schema([
                                        Textarea::make('featured_snippet')
                                            ->label('Featured Snippet')
                                            ->rows(3)
                                            ->maxLength(400)
                                            ->helperText('Resposta direta e objetiva, ideal para aparecer em destaque nos resultados (40-60 palavras)')
                                            ->placeholder('Ex: Um sistema de gestão é uma ferramenta que centraliza operações, controla estoque, gerencia clientes e automatiza processos financeiros, aumentando eficiência e reduzindo erros operacionais.')
                                            ->columnSpanFull(),
                                    ]),

                                Section::make('Resumo para IA')
                                    ->description('Resumo estruturado para mecanismos de busca baseados em IA (Google SGE, ChatGPT, Perplexity)')
                                    ->schema([
                                        Repeater::make('ai_summary')
                                            ->label('Bullet Points')
                                            ->schema([
                                                TextInput::make('point')
                                                    ->label('Ponto')
                                                    ->required()
                                                    ->maxLength(255)
                                                    ->placeholder('Ex: Reduz custos operacionais em até 30%'),
                                            ])
                                            ->minItems(3)
                                            ->maxItems(5)
                                            ->defaultItems(0)
                                            ->helperText('De 3 a 5 pontos objetivos e afirmativos sobre o tema')
                                            ->columnSpanFull()
                                            ->addActionLabel('Adicionar ponto'),
                                    ])
                                    ->collapsible(),

                                Section::make('FAQ (Perguntas Frequentes)')
                                    ->description('Otimizado para Rich Results, Featured Snippets e respostas por IA')
                                    ->schema([
                                        Repeater::make('faq')
                                            ->label('Perguntas e Respostas')
                                            ->schema([
                                                TextInput::make('question')
                                                    ->label('Pergunta')
                                                    ->required()
                                                    ->maxLength(255)
                                                    ->placeholder('Ex: Como funciona um sistema de gestão?')
                                                    ->columnSpanFull(),

                                                Textarea::make('answer')
                                                    ->label('Resposta')
                                                    ->required()
                                                    ->rows(2)
                                                    ->maxLength(500)
                                                    ->helperText('Resposta direta e clara (até 50 palavras)')
                                                    ->placeholder('Ex: É um software que centraliza operações, automatiza processos e fornece relatórios em tempo real.')
                                                    ->columnSpanFull(),
                                            ])
                                            ->minItems(3)
                                            ->maxItems(5)
                                            ->defaultItems(0)
                                            ->helperText('De 3 a 5 perguntas que as pessoas realmente fazem')
                                            ->columnSpanFull()
                                            ->addActionLabel('Adicionar pergunta')
                                            ->itemLabel(fn (array $state): ?string => $state['question'] ?? null),
                                    ])
                                    ->collapsible(),

                                Section::make('Google Discover')
                                    ->description('Otimização para Google Discover e feeds personalizados')
                                    ->schema([
                                        Textarea::make('discover_context')
                                            ->label('Por que isso é importante agora?')
                                            ->rows(3)
                                            ->maxLength(500)
                                            ->helperText('Contexto atual, relevância temporal ou impacto imediato')
                                            ->placeholder('Ex: Com o aumento da competitividade no mercado, empresas que não digitalizam seus processos perdem até 40% de eficiência operacional...')
                                            ->columnSpanFull(),
                                    ])
                                    ->collapsible(),

                                Section::make('Links Internos')
                                    ->description('Sugestões de links internos para construção de autoridade')
                                    ->schema([
                                        Repeater::make('internal_links_suggestions')
                                            ->label('Sugestões de Links')
                                            ->schema([
                                                TextInput::make('url')
                                                    ->label('URL')
                                                    ->required()
                                                    ->prefix('/')
                                                    ->placeholder('sistema-ordem-servico')
                                                    ->columnSpan(1),

                                                TextInput::make('anchor_text')
                                                    ->label('Texto Âncora')
                                                    ->required()
                                                    ->placeholder('sistema de ordem de serviço')
                                                    ->columnSpan(1),
                                            ])
                                            ->columns(2)
                                            ->defaultItems(0)
                                            ->helperText('Links para páginas pilares e conteúdos relacionados')
                                            ->columnSpanFull()
                                            ->addActionLabel('Adicionar link'),
                                    ])
                                    ->collapsible(),
                            ]),
                    ]),
            ]);
    }
}
