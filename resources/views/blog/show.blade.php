@php
$structuredData = [
    [
        '@context' => 'https://schema.org',
        '@type' => 'BlogPosting',
        'headline' => $post->title,
        'description' => $post->effective_meta_description,
        'url' => route('blog.show', $post->slug),
        'datePublished' => $post->published_at->toIso8601String(),
        'dateModified' => $post->updated_at->toIso8601String(),
        'author' => [
            '@type' => $post->author ? 'Person' : 'Organization',
            'name' => $post->author?->name ?? 'WSoft Tecnologia'
        ],
        'publisher' => [
            '@type' => 'Organization',
            'name' => 'WSoft Tecnologia',
            'url' => url('/'),
            'logo' => [
                '@type' => 'ImageObject',
                'url' => asset('images/logo.png')
            ]
        ],
        'mainEntityOfPage' => [
            '@type' => 'WebPage',
            '@id' => route('blog.show', $post->slug)
        ],
        'image' => $post->effective_og_image ? [
            '@type' => 'ImageObject',
            'url' => Storage::url($post->effective_og_image),
            'width' => 1200,
            'height' => 630
        ] : null,
        'articleSection' => $post->category?->name,
        'keywords' => $post->meta_keywords,
        'wordCount' => str_word_count(strip_tags($post->content)),
        'timeRequired' => 'PT' . $post->reading_time . 'M',
        'inLanguage' => 'pt-BR'
    ],
    [
        '@context' => 'https://schema.org',
        '@type' => 'Article',
        'headline' => $post->title,
        'description' => $post->effective_meta_description,
        'url' => route('blog.show', $post->slug),
        'datePublished' => $post->published_at->toIso8601String(),
        'dateModified' => $post->updated_at->toIso8601String(),
        'author' => [
            '@type' => $post->author ? 'Person' : 'Organization',
            'name' => $post->author?->name ?? 'WSoft Tecnologia'
        ],
        'publisher' => [
            '@type' => 'Organization',
            'name' => 'WSoft Tecnologia',
            'logo' => [
                '@type' => 'ImageObject',
                'url' => asset('images/logo.png')
            ]
        ],
        'mainEntityOfPage' => route('blog.show', $post->slug)
    ],
    [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => array_filter([
            [
                '@type' => 'ListItem',
                'position' => 1,
                'name' => 'Home',
                'item' => url('/')
            ],
            [
                '@type' => 'ListItem',
                'position' => 2,
                'name' => 'Blog',
                'item' => route('blog.index')
            ],
            $post->category ? [
                '@type' => 'ListItem',
                'position' => 3,
                'name' => $post->category->name,
                'item' => route('blog.category', $post->category->slug)
            ] : null,
            [
                '@type' => 'ListItem',
                'position' => $post->category ? 4 : 3,
                'name' => $post->title
            ]
        ])
    ],
    [
        '@context' => 'https://schema.org',
        '@type' => 'WebPage',
        'name' => $post->title,
        'description' => $post->effective_meta_description,
        'url' => route('blog.show', $post->slug),
        'inLanguage' => 'pt-BR',
        'isPartOf' => [
            '@type' => 'WebSite',
            'name' => 'WSoft Tecnologia',
            'url' => url('/')
        ],
        'about' => [
            '@type' => 'Thing',
            'name' => $post->category?->name ?? 'Gestão Empresarial'
        ],
        'primaryImageOfPage' => $post->effective_og_image ? [
            '@type' => 'ImageObject',
            'url' => Storage::url($post->effective_og_image)
        ] : null
    ]
];

// Remove null values
$structuredData = array_map(function($schema) {
    return array_filter($schema, function($value) {
        return $value !== null;
    });
}, $structuredData);
@endphp

@extends('blog.layout')

@section('title', $post->effective_meta_title)
@section('meta_description', $post->effective_meta_description)

@section('meta_keywords', $post->meta_keywords ?? '')

@section('og_title', $post->effective_meta_title)
@section('og_description', $post->effective_meta_description)
@section('og_type', 'article')

@section('og_image', $post->effective_og_image ? Storage::url($post->effective_og_image) : '')

@section('twitter_title', $post->effective_meta_title)
@section('twitter_description', $post->effective_meta_description)

@push('styles')
<style>
    .blog-content h2 {
        font-size: 1.875rem;
        font-weight: 800;
        color: #0f172a;
        margin-top: 3rem;
        margin-bottom: 1.5rem;
        line-height: 1.2;
        letter-spacing: -0.025em;
        border-bottom: 2px solid #e2e8f0;
        padding-bottom: 0.75rem;
    }

    .blog-content h3 {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1e293b;
        margin-top: 2.5rem;
        margin-bottom: 1rem;
        line-height: 1.3;
        letter-spacing: -0.015em;
    }

    .blog-content h4 {
        font-size: 1.25rem;
        font-weight: 600;
        color: #334155;
        margin-top: 2rem;
        margin-bottom: 0.75rem;
        line-height: 1.4;
    }

    .blog-content p {
        font-size: 1.125rem;
        color: #475569;
        margin-bottom: 1.75rem;
        line-height: 1.9;
        letter-spacing: 0.01em;
    }

    .blog-content p:first-of-type {
        font-size: 1.25rem;
        color: #334155;
        line-height: 1.8;
    }

    .blog-content ul {
        margin: 2rem 0;
        padding-left: 0;
        list-style: none;
    }

    .blog-content ul li {
        font-size: 1.125rem;
        color: #475569;
        line-height: 1.8;
        margin-bottom: 1rem;
        padding-left: 2rem;
        position: relative;
    }

    .blog-content ul li::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0.6rem;
        width: 8px;
        height: 8px;
        background: #3b82f6;
        border-radius: 50%;
    }

    .blog-content ul ul {
        margin: 0.75rem 0;
    }

    .blog-content ul ul li::before {
        background: transparent;
        border: 2px solid #3b82f6;
        width: 6px;
        height: 6px;
    }

    .blog-content ol {
        margin: 2rem 0;
        padding-left: 0;
        list-style: none;
        counter-reset: item;
    }

    .blog-content ol li {
        font-size: 1.125rem;
        color: #475569;
        line-height: 1.8;
        margin-bottom: 1rem;
        padding-left: 2.5rem;
        position: relative;
        counter-increment: item;
    }

    .blog-content ol li::before {
        content: counter(item);
        position: absolute;
        left: 0;
        top: 0.1rem;
        width: 1.5rem;
        height: 1.5rem;
        background: #3b82f6;
        color: white;
        font-size: 0.875rem;
        font-weight: 600;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .blog-content li strong {
        color: #1e293b;
    }

    .blog-content li p {
        margin-bottom: 0.5rem;
    }

    .blog-content blockquote {
        border-left: 4px solid #3b82f6;
        background: #eff6ff;
        padding: 1.25rem 1.5rem;
        margin: 2rem 0;
        border-radius: 0 0.5rem 0.5rem 0;
    }

    .blog-content blockquote p {
        font-size: 1.125rem;
        font-style: italic;
        color: #1e40af;
        margin-bottom: 0;
    }

    .blog-content a {
        color: #2563eb;
        font-weight: 600;
        text-decoration: none;
        border-bottom: 2px solid transparent;
        transition: border-color 0.2s ease;
    }

    .blog-content a:hover {
        border-bottom-color: #2563eb;
    }

    .blog-content img {
        border-radius: 1rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        margin: 2rem 0;
    }

    .blog-content strong {
        font-weight: 700;
        color: #0f172a;
    }

    .blog-content code {
        background: #f1f5f9;
        padding: 0.25rem 0.5rem;
        border-radius: 0.375rem;
        font-size: 0.875rem;
        color: #2563eb;
        font-family: ui-monospace, monospace;
    }

    .blog-content pre {
        background: #0f172a;
        border-radius: 0.75rem;
        padding: 1.5rem;
        margin: 2rem 0;
        overflow-x: auto;
    }

    .blog-content pre code {
        background: transparent;
        padding: 0;
        color: #e2e8f0;
        font-size: 0.875rem;
    }
</style>
@endpush

@section('structured_data')
@foreach($structuredData as $data)
<script type="application/ld+json">{!! json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) !!}</script>
@endforeach
@endsection

@section('content')
    <!-- Breadcrumb -->
    <section class="bg-white border-b border-slate-100 py-4">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="text-sm text-slate-500" aria-label="Breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
                <ol class="flex items-center space-x-2">
                    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                        <a href="/" itemprop="item" class="hover:text-blue-600 transition-colors">
                            <span itemprop="name">Home</span>
                        </a>
                        <meta itemprop="position" content="1" />
                    </li>
                    <li><span class="text-slate-300">/</span></li>
                    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                        <a href="{{ route('blog.index') }}" itemprop="item" class="hover:text-blue-600 transition-colors">
                            <span itemprop="name">Blog</span>
                        </a>
                        <meta itemprop="position" content="2" />
                    </li>
                    @if($post->category)
                    <li><span class="text-slate-300">/</span></li>
                    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                        <a href="{{ route('blog.category', $post->category->slug) }}" itemprop="item" class="hover:text-blue-600 transition-colors">
                            <span itemprop="name">{{ $post->category->name }}</span>
                        </a>
                        <meta itemprop="position" content="3" />
                    </li>
                    @endif
                    <li><span class="text-slate-300">/</span></li>
                    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="text-slate-900 font-medium truncate max-w-[200px] md:max-w-none">
                        <span itemprop="name">{{ Str::limit($post->title, 40) }}</span>
                        <meta itemprop="position" content="{{ $post->category ? 4 : 3 }}" />
                    </li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Artigo -->
    <article class="py-12 md:py-16 bg-slate-50/30" itemscope itemtype="https://schema.org/BlogPosting">
        <meta itemprop="datePublished" content="{{ $post->published_at->toIso8601String() }}">
        <meta itemprop="dateModified" content="{{ $post->updated_at->toIso8601String() }}">
        <meta itemprop="inLanguage" content="pt-BR">
        <meta itemprop="wordCount" content="{{ str_word_count(strip_tags($post->content)) }}">

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header do Post -->
            <header class="mb-10 text-center md:text-left">
                @if($post->category)
                <a href="{{ route('blog.category', $post->category->slug) }}"
                    class="inline-block px-4 py-1.5 text-sm font-semibold text-blue-700 bg-blue-50 rounded-full mb-6 hover:bg-blue-100 transition-colors"
                    aria-label="Ver mais artigos sobre {{ $post->category->name }}"
                    itemprop="articleSection">
                    {{ $post->category->name }}
                </a>
                @endif

                <h1 class="text-3xl md:text-5xl lg:text-6xl font-extrabold text-slate-900 leading-tight tracking-tight mb-8" itemprop="headline name">
                    {{ $post->title }}
                </h1>

                <div class="flex flex-wrap items-center justify-center md:justify-start gap-6 text-sm text-slate-600 border-y border-slate-100 py-6">
                    @if($post->author)
                    <div class="flex items-center gap-3" itemprop="author" itemscope itemtype="https://schema.org/Person">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center shadow-md shadow-blue-500/20 text-white font-bold text-lg">
                            {{ substr($post->author->name, 0, 1) }}
                        </div>
                        <div class="flex flex-col text-left">
                            <span class="text-xs text-slate-400 font-medium uppercase tracking-wider">Autor</span>
                            <span class="font-semibold text-slate-900" itemprop="name">{{ $post->author->name }}</span>
                        </div>
                    </div>
                    @else
                    <meta itemprop="author" content="WSoft Tecnologia">
                    @endif

                    <div class="hidden md:block w-px h-10 bg-slate-200" aria-hidden="true"></div>

                    <div class="flex items-center gap-2">
                        <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-500" aria-hidden="true">
                            <i class="fa-regular fa-calendar"></i>
                        </div>
                        <div class="flex flex-col text-left">
                            <span class="text-xs text-slate-400 font-medium uppercase tracking-wider">Publicado em</span>
                            <time datetime="{{ $post->published_at->toIso8601String() }}" class="font-semibold text-slate-900">{{ $post->published_at->format('d M, Y') }}</time>
                        </div>
                    </div>

                    <div class="hidden md:block w-px h-10 bg-slate-200" aria-hidden="true"></div>

                    <div class="flex items-center gap-2">
                        <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-500" aria-hidden="true">
                            <i class="fa-regular fa-clock"></i>
                        </div>
                        <div class="flex flex-col text-left">
                            <span class="text-xs text-slate-400 font-medium uppercase tracking-wider">Leitura</span>
                            <span class="font-semibold text-slate-900" itemprop="timeRequired" content="PT{{ $post->reading_time }}M">{{ $post->reading_time }} min</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Publisher meta -->
            <div itemprop="publisher" itemscope itemtype="https://schema.org/Organization" style="display:none;">
                <span itemprop="name">WSoft Tecnologia</span>
                <div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
                    <meta itemprop="url" content="{{ asset('images/logo.png') }}">
                </div>
            </div>

            <!-- Imagem Destaque -->
            @if($post->featured_image)
            <figure class="mb-12 relative group" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                <div class="absolute inset-0 bg-blue-600/5 rounded-3xl transform rotate-1 group-hover:rotate-2 transition-transform duration-500" aria-hidden="true"></div>
                <img src="{{ Storage::url($post->featured_image) }}"
                     alt="{{ $post->title }} - Artigo sobre {{ $post->category?->name ?? 'gestão empresarial' }}"
                     itemprop="url contentUrl"
                     class="relative w-full rounded-3xl shadow-2xl shadow-slate-200/50">
                <meta itemprop="width" content="1200">
                <meta itemprop="height" content="630">
                <meta itemprop="description" content="{{ $post->title }}">
            </figure>
            @endif

            <!-- Conteúdo -->
            <div class="blog-content max-w-none prose prose-lg prose-slate prose-headings:font-bold prose-a:text-blue-600 hover:prose-a:text-blue-700 prose-img:rounded-2xl prose-img:shadow-lg" itemprop="articleBody">
                {!! $post->content !!}
            </div>

            <!-- Description meta -->
            <meta itemprop="description" content="{{ $post->effective_meta_description }}">
            @if($post->meta_keywords)
            <meta itemprop="keywords" content="{{ $post->meta_keywords }}">
            @endif
            <link itemprop="mainEntityOfPage" href="{{ route('blog.show', $post->slug) }}">

            <!-- CTA Inline -->
            <div class="mt-16 mb-12 p-8 md:p-10 bg-gradient-to-br from-blue-600 to-indigo-700 rounded-3xl text-white shadow-xl shadow-blue-600/20 relative overflow-hidden group">
                <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-white/10 rounded-full blur-3xl group-hover:bg-white/20 transition-colors duration-500" aria-hidden="true"></div>
                <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-40 h-40 bg-blue-500/20 rounded-full blur-3xl" aria-hidden="true"></div>

                <div class="relative flex flex-col md:flex-row items-center gap-8">
                    <div class="flex-shrink-0 relative">
                        <div class="w-24 h-24 bg-white/10 backdrop-blur-sm rounded-2xl flex items-center justify-center shadow-inner border border-white/20" aria-hidden="true">
                            <i class="fa-solid fa-tags text-4xl text-white"></i>
                        </div>
                        <div class="absolute -top-3 -right-3 bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg animate-bounce">
                            OFERTA
                        </div>
                    </div>
                    <div class="flex-1 text-center md:text-left">
                        <h3 class="text-2xl font-bold mb-2">
                            Organize sua empresa hoje mesmo!
                        </h3>
                        <p class="text-blue-100 text-lg leading-relaxed mb-4">
                            Tenha controle total do seu negócio com o WSoft.
                        </p>
                        <div class="flex items-center justify-center md:justify-start gap-3">
                            <span class="text-blue-200 line-through text-lg">de R$ 47,00</span>
                            <span class="text-white font-extrabold text-3xl">por R$ 29,90</span>
                            <span class="text-xs font-medium bg-white/20 px-2 py-1 rounded text-blue-50">/mês</span>
                        </div>
                    </div>
                    <div class="flex-shrink-0">
                        <a href="/app/register"
                            class="inline-flex items-center gap-2 bg-white text-blue-700 font-bold px-8 py-4 rounded-xl hover:bg-blue-50 transition shadow-lg active:scale-95 transform hover:-translate-y-1"
                            aria-label="Aproveitar oferta - Cadastrar no WSoft">
                            Aproveitar Oferta
                            <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                        </a>
                        <p class="mt-3 text-xs text-center text-blue-200">Teste grátis por 7 dias</p>
                    </div>
                </div>
            </div>

            <!-- Tags/Keywords -->
            @if($post->meta_keywords)
            <div class="mt-12 pt-8 border-t border-slate-200">
                <div class="flex items-center gap-2 mb-4">
                    <i class="fa-solid fa-tags text-blue-500" aria-hidden="true"></i>
                    <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wide">Tópicos Relacionados</h3>
                </div>
                <div class="flex flex-wrap gap-2" role="list" aria-label="Tags do artigo">
                    @foreach(explode(',', $post->meta_keywords) as $keyword)
                    <a href="{{ route('blog.index', ['busca' => trim($keyword)]) }}"
                       class="inline-flex items-center px-4 py-2 text-sm font-medium bg-white border border-slate-200 text-slate-600 rounded-lg hover:bg-blue-50 hover:text-blue-600 hover:border-blue-200 transition-all shadow-sm"
                       aria-label="Buscar artigos sobre {{ trim($keyword) }}">
                        {{ trim($keyword) }}
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Compartilhar -->
            <div class="mt-8 pt-8 border-t border-slate-200">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <h3 class="text-base font-bold text-slate-900">Gostou do artigo? Compartilhe:</h3>
                    <div class="flex gap-3" role="group" aria-label="Compartilhar artigo nas redes sociais">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('blog.show', $post->slug)) }}"
                            target="_blank" rel="noopener noreferrer"
                            class="w-10 h-10 flex items-center justify-center bg-[#1877F2] text-white rounded-full hover:scale-110 transition-transform shadow-md" aria-label="Compartilhar no Facebook">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('blog.show', $post->slug)) }}&text={{ urlencode($post->title) }}"
                            target="_blank" rel="noopener noreferrer"
                            class="w-10 h-10 flex items-center justify-center bg-[#1DA1F2] text-white rounded-full hover:scale-110 transition-transform shadow-md" aria-label="Compartilhar no Twitter">
                            <i class="fa-brands fa-twitter"></i>
                        </a>
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(route('blog.show', $post->slug)) }}&title={{ urlencode($post->title) }}"
                            target="_blank" rel="noopener noreferrer"
                            class="w-10 h-10 flex items-center justify-center bg-[#0A66C2] text-white rounded-full hover:scale-110 transition-transform shadow-md" aria-label="Compartilhar no LinkedIn">
                            <i class="fa-brands fa-linkedin-in"></i>
                        </a>
                        <a href="https://api.whatsapp.com/send?text={{ urlencode($post->title . ' - ' . route('blog.show', $post->slug)) }}"
                            target="_blank" rel="noopener noreferrer"
                            class="w-10 h-10 flex items-center justify-center bg-[#25D366] text-white rounded-full hover:scale-110 transition-transform shadow-md" aria-label="Compartilhar no WhatsApp">
                            <i class="fa-brands fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </article>

    <!-- Posts Relacionados -->
    @if($relatedPosts->count() > 0)
    <section class="py-16 bg-white border-t border-slate-100" aria-label="Artigos relacionados">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl md:text-3xl font-bold text-slate-900 mb-10 text-center">Continue Lendo</h2>
            <div class="grid gap-8 md:grid-cols-3" role="feed" aria-label="Lista de artigos relacionados">
                @foreach($relatedPosts as $relatedPost)
                <article class="group flex flex-col bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300" itemscope itemtype="https://schema.org/BlogPosting">
                    @if($relatedPost->featured_image)
                    <a href="{{ route('blog.show', $relatedPost->slug) }}" class="relative overflow-hidden aspect-video" aria-label="Ler artigo: {{ $relatedPost->title }}">
                        <div class="absolute inset-0 bg-slate-900/0 group-hover:bg-slate-900/10 transition-colors z-10" aria-hidden="true"></div>
                        <img src="{{ Storage::url($relatedPost->featured_image) }}"
                             alt="{{ $relatedPost->title }} - Artigo sobre {{ $relatedPost->category?->name ?? 'gestão empresarial' }}"
                             itemprop="image"
                             class="w-full h-full object-cover transform group-hover:scale-105 transition duration-500">
                    </a>
                    @else
                    <div class="w-full aspect-video bg-gradient-to-br from-slate-100 to-slate-50 flex items-center justify-center">
                        <i class="fa-solid fa-file-lines text-4xl text-slate-300" aria-hidden="true"></i>
                    </div>
                    @endif
                    <div class="flex-1 p-6 flex flex-col">
                        <h3 class="text-lg font-bold text-slate-900 mb-3 group-hover:text-blue-600 transition-colors line-clamp-2" itemprop="headline">
                            <a href="{{ route('blog.show', $relatedPost->slug) }}" itemprop="url">{{ $relatedPost->title }}</a>
                        </h3>
                        <p class="text-sm text-slate-600 line-clamp-3 mb-4 flex-1" itemprop="description">
                            {{ $relatedPost->excerpt ?: Str::limit(strip_tags($relatedPost->content), 100) }}
                        </p>
                        <div class="pt-4 border-t border-slate-50 text-xs font-medium text-slate-500 flex items-center gap-2">
                            <i class="fa-regular fa-calendar" aria-hidden="true"></i>
                            <time datetime="{{ $relatedPost->published_at->toIso8601String() }}" itemprop="datePublished">{{ $relatedPost->published_at->format('d M, Y') }}</time>
                        </div>
                        <meta itemprop="author" content="WSoft Tecnologia">
                    </div>
                </article>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- CTA Final -->
    <section class="py-20 bg-slate-900 text-white relative overflow-hidden" aria-label="Chamada para ação">
        <div class="absolute inset-0 bg-[url('/images/grid-pattern.svg')] opacity-5" aria-hidden="true"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-slate-900 via-slate-900 to-blue-900/20" aria-hidden="true"></div>

        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-6 tracking-tight">Pronto para Transformar sua Gestão Empresarial?</h2>
            <p class="text-xl text-slate-300 mb-10 max-w-2xl mx-auto">
                Junte-se a milhares de empreendedores que usam o WSoft para crescer seus negócios com controle financeiro eficiente.
            </p>
            <a href="/app/register"
               class="inline-flex items-center gap-2 bg-blue-600 text-white font-bold px-10 py-4 rounded-xl hover:bg-blue-500 transition shadow-lg shadow-blue-600/20 active:scale-95 text-lg"
               aria-label="Começar teste grátis de 7 dias">
                Começar Teste Grátis de 7 Dias
                <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
            </a>
            <p class="mt-6 text-sm text-slate-500">
                Teste grátis de 7 dias • Sem cartão de crédito • Sem compromisso
            </p>
        </div>
    </section>
@endsection
