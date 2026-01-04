@php
$structuredData = [
    [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
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
            ]
        ]
    ],
    [
        '@context' => 'https://schema.org',
        '@type' => 'Blog',
        'name' => 'Blog WSoft Tecnologia',
        'description' => 'Blog com dicas e conteúdos sobre gestão empresarial, controle financeiro, ordem de serviço e otimização de processos para pequenas empresas.',
        'url' => route('blog.index'),
        'publisher' => [
            '@type' => 'Organization',
            'name' => 'WSoft Tecnologia',
            'url' => url('/'),
            'logo' => [
                '@type' => 'ImageObject',
                'url' => asset('images/logo.png')
            ]
        ],
        'inLanguage' => 'pt-BR'
    ],
    [
        '@context' => 'https://schema.org',
        '@type' => 'CollectionPage',
        'name' => 'Blog WSoft Tecnologia - Gestão Empresarial e Controle Financeiro',
        'description' => 'Artigos sobre gestão empresarial, controle financeiro, ordem de serviço e otimização de processos para pequenas e médias empresas',
        'url' => route('blog.index'),
        'isPartOf' => [
            '@type' => 'WebSite',
            'name' => 'WSoft Tecnologia',
            'url' => url('/')
        ],
        'about' => [
            ['@type' => 'Thing', 'name' => 'Gestão Empresarial'],
            ['@type' => 'Thing', 'name' => 'Controle Financeiro'],
            ['@type' => 'Thing', 'name' => 'Ordem de Serviço'],
            ['@type' => 'Thing', 'name' => 'Sistema de Gestão']
        ]
    ],
    [
        '@context' => 'https://schema.org',
        '@type' => 'WebSite',
        'name' => 'WSoft Tecnologia',
        'url' => url('/'),
        'potentialAction' => [
            '@type' => 'SearchAction',
            'target' => [
                '@type' => 'EntryPoint',
                'urlTemplate' => route('blog.index') . '?busca={search_term_string}'
            ],
            'query-input' => 'required name=search_term_string'
        ]
    ]
];
@endphp

@extends('blog.layout')

@section('title', 'Blog WSoft | Gestão Empresarial, Controle Financeiro e Ordem de Serviço')
@section('meta_description', 'Aprenda a otimizar a gestão do seu negócio com dicas práticas sobre controle financeiro, ordem de serviço, CRM, gestão de clientes e muito mais. Conteúdo gratuito para empreendedores.')
@section('meta_keywords', 'gestão empresarial, controle financeiro, ordem de serviço, sistema de gestão, CRM, gestão de clientes, gestão de oficina, administração de empresas, empreendedorismo')

@section('og_title', 'Blog WSoft | Dicas de Gestão Empresarial e Controle Financeiro')
@section('og_description', 'Dicas práticas e tutoriais sobre gestão empresarial, controle financeiro, ordem de serviço e otimização de processos para pequenas e médias empresas.')
@section('og_type', 'website')

@section('twitter_title', 'Blog WSoft | Gestão Empresarial Simplificada')
@section('twitter_description', 'Aprenda a otimizar a gestão do seu negócio com dicas práticas sobre controle financeiro, ordem de serviço e gestão de clientes.')

@section('structured_data')
@foreach($structuredData as $data)
<script type="application/ld+json">{!! json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}</script>
@endforeach
@endsection

@section('content')
    <section class="bg-white border-b border-slate-100 py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="text-sm text-slate-500" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2">
                    <li><a href="/" class="hover:text-blue-600 transition-colors">Home</a></li>
                    <li><span class="text-slate-300">/</span></li>
                    <li class="text-slate-900 font-medium">Blog</li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="bg-gradient-to-b from-blue-950 to-blue-700 text-white py-16 md:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-sm uppercase tracking-[0.2em] text-blue-200 mb-4">Nosso Blog</p>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold leading-tight mb-6">Blog de Gestão Empresarial, Controle Financeiro e Ordem de Serviço</h1>
            <p class="text-lg md:text-xl text-blue-100 max-w-3xl mx-auto">Dicas práticas, tutoriais e estratégias para otimizar a gestão do seu negócio e aumentar sua produtividade</p>
        </div>
    </section>

    <section class="py-12 md:py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-12">
                <div class="flex-1">
                    <div class="mb-8 bg-slate-50 rounded-2xl p-6 border border-slate-100">
                        <form method="GET" action="{{ route('blog.index') }}" role="search" aria-label="Buscar artigos do blog" class="flex flex-col md:flex-row gap-4">
                            <div class="flex-1 relative">
                                <input type="search" name="busca" value="{{ request('busca') }}" placeholder="Buscar artigos sobre gestão, financeiro, ordem de serviço..." aria-label="Campo de busca" class="w-full px-4 py-3 pl-11 rounded-lg border border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition">
                                <i class="fa-solid fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400" aria-hidden="true"></i>
                            </div>
                            <button type="submit" class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition shadow-sm" aria-label="Buscar artigos">Buscar</button>
                        </form>
                    </div>

                    <div class="flex items-center justify-between mb-8">
                        <h2 class="text-2xl font-bold text-slate-900">Últimos Artigos</h2>
                        <p class="text-sm text-slate-500">{{ $posts->total() }} {{ Str::plural('artigo', $posts->total()) }}</p>
                    </div>

                    @if($posts->count() > 0)
                    <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3" role="feed" aria-label="Artigos do blog">
                        @foreach($posts as $post)
                        <article class="group flex flex-col bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300" itemscope itemtype="https://schema.org/BlogPosting">
                            @if($post->featured_image)
                            <a href="{{ route('blog.show', $post->slug) }}" class="relative overflow-hidden aspect-video" aria-label="Ler artigo: {{ $post->title }}">
                                <img src="{{ asset('images/logo-white.png') }}" alt="{{ $post->title }} - Artigo sobre {{ $post->category?->name ?? 'gestão empresarial' }}" class="w-full h-full object-cover transform group-hover:scale-105 transition duration-500 bg-gray-200" itemprop="image">
                            </a>
                            @else
                            <div class="w-full aspect-video bg-gradient-to-br from-slate-100 to-slate-50 flex items-center justify-center">
                                <i class="fa-solid fa-file-lines text-4xl text-slate-300" aria-hidden="true"></i>
                            </div>
                            @endif
                            <div class="flex-1 p-6 flex flex-col">
                                @if($post->category)
                                <a href="{{ route('blog.category', $post->category->slug) }}" class="inline-block px-3 py-1 text-xs font-semibold text-blue-700 bg-blue-50 rounded-full mb-3 hover:bg-blue-100 transition-colors w-fit" aria-label="Ver mais artigos sobre {{ $post->category->name }}">{{ $post->category->name }}</a>
                                @endif
                                <h3 class="text-lg font-bold text-slate-900 mb-3 group-hover:text-blue-600 transition-colors line-clamp-2" itemprop="headline">
                                    <a href="{{ route('blog.show', $post->slug) }}" itemprop="url">{{ $post->title }}</a>
                                </h3>
                                <p class="text-sm text-slate-600 line-clamp-3 mb-4 flex-1" itemprop="description">{{ $post->excerpt ?: Str::limit(strip_tags($post->content), 100) }}</p>
                                <div class="pt-4 border-t border-slate-50 flex items-center justify-between">
                                    <div class="text-xs font-medium text-slate-500 flex items-center gap-2">
                                        <i class="fa-regular fa-calendar" aria-hidden="true"></i>
                                        <time datetime="{{ $post->published_at->toIso8601String() }}" itemprop="datePublished">{{ $post->published_at->format('d M, Y') }}</time>
                                    </div>
                                    <div class="text-xs font-medium text-slate-400 flex items-center gap-1">
                                        <i class="fa-regular fa-clock" aria-hidden="true"></i>
                                        <span itemprop="timeRequired">{{ $post->reading_time }} min de leitura</span>
                                    </div>
                                </div>
                                <meta itemprop="author" content="WSoft Tecnologia">
                                <meta itemprop="publisher" content="WSoft Tecnologia">
                            </div>
                        </article>
                        @endforeach
                    </div>

                    @if($posts->hasPages())
                    <div class="mt-12">{{ $posts->links() }}</div>
                    @endif
                    @else
                    <div class="text-center py-16 bg-slate-50 rounded-2xl">
                        <i class="fa-solid fa-search text-5xl text-slate-300 mb-6"></i>
                        <h3 class="text-xl font-bold text-slate-900 mb-2">Nenhum post encontrado</h3>
                        <p class="text-slate-600 mb-6">Tente buscar por outros termos ou navegue pelas categorias.</p>
                        <a href="{{ route('blog.index') }}" class="inline-block px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">Ver todos os posts</a>
                    </div>
                    @endif
                </div>

                <aside class="lg:w-80 space-y-6" role="complementary" aria-label="Sidebar do blog">
                    @if($categories->count() > 0)
                    <nav class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6" aria-label="Categorias do blog">
                        <h2 class="text-lg font-bold text-slate-900 mb-4 flex items-center gap-2">
                            <i class="fa-solid fa-folder text-blue-600" aria-hidden="true"></i>
                            Categorias de Artigos
                        </h2>
                        <ul class="space-y-3" role="list">
                            @foreach($categories as $category)
                            <li>
                                <a href="{{ route('blog.category', $category->slug) }}" class="flex items-center justify-between py-2 px-3 rounded-lg transition text-slate-600 hover:bg-slate-50 hover:text-blue-600" aria-label="Filtrar artigos sobre {{ $category->name }} ({{ $category->posts_count }} artigos)">
                                    <span>{{ $category->name }}</span>
                                    <span class="text-xs bg-slate-100 px-2 py-1 rounded-full" aria-label="{{ $category->posts_count }} artigos">{{ $category->posts_count }}</span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </nav>
                    @endif

                    <div class="bg-gradient-to-br from-blue-600 to-blue-700 rounded-2xl p-6 text-white shadow-lg shadow-blue-600/20">
                        <div class="mb-4"><i class="fa-solid fa-rocket text-3xl" aria-hidden="true"></i></div>
                        <h3 class="text-lg font-bold mb-2">Teste o WSoft Grátis</h3>
                        <p class="text-sm text-blue-100 mb-4">Experimente todas as funcionalidades por 7 dias sem compromisso.</p>
                        <a href="/app/register" class="block w-full text-center bg-white text-blue-600 font-semibold px-4 py-3 rounded-lg hover:bg-blue-50 transition shadow-md">Começar Agora</a>
                        <p class="text-xs text-blue-200 mt-3 text-center">Sem cartão de crédito</p>
                    </div>
                </aside>
            </div>
        </div>
    </section>

    <section class="py-20 bg-slate-900 text-white relative overflow-hidden" aria-label="Chamada para ação">
        <div class="absolute inset-0 bg-gradient-to-b from-slate-900 via-slate-900 to-blue-900/20"></div>
        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-6 tracking-tight">Pronto para Transformar sua Gestão Empresarial?</h2>
            <p class="text-xl text-slate-300 mb-10 max-w-2xl mx-auto">Junte-se a milhares de empreendedores que usam o WSoft para crescer seus negócios com controle financeiro eficiente e gestão de ordem de serviço inteligente.</p>
            <a href="/app/register" class="inline-flex items-center gap-2 bg-blue-600 text-white font-bold px-10 py-4 rounded-xl hover:bg-blue-500 transition shadow-lg shadow-blue-600/20 active:scale-95 text-lg" aria-label="Começar teste grátis de 7 dias">
                Começar Teste Grátis de 7 Dias
                <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
            </a>
            <p class="mt-6 text-sm text-slate-500">Teste grátis de 7 dias • Sem cartão de crédito • Sem compromisso</p>
        </div>
    </section>
@endsection
