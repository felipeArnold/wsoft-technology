<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Blog\BlogPostResource\Schemas;

use App\Models\Blog\BlogCategory;
use App\Models\Blog\BlogPost;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
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
                                        \Filament\Forms\Components\Placeholder::make('seo_preview')
                                            ->label('')
                                            ->content(function ($get) {
                                                $title = $get('meta_title') ?: $get('title') ?: 'Título do Post';
                                                $description = $get('meta_description') ?: $get('excerpt') ?: 'Descrição do post aparecerá aqui...';
                                                $slug = $get('slug') ?: 'url-do-post';

                                                return new \Illuminate\Support\HtmlString("
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
                    ]),
            ]);
    }
}
