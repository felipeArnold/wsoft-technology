@extends('blog.layout')

@section('title', 'Blog - Dicas de Gestão Empresarial')
@section('meta_description', 'Confira nosso blog com dicas sobre gestão empresarial, controle financeiro, ordem de serviço, redução de inadimplência e muito mais.')
@section('meta_keywords', 'gestão empresarial, controle financeiro, ordem de serviço, sistema de gestão, dicas empresariais')

{{--@section('structured_data')--}}
{{--<script type="application/ld+json">--}}
{{--{--}}
{{--    "@context": "https://schema.org",--}}
{{--    "@type": "Blog",--}}
{{--    "name": "Blog WSoft Tecnologia",--}}
{{--    "description": "Blog com dicas e conteúdos sobre gestão empresarial",--}}
{{--    "url": "{{ route('blog.index') }}",--}}
{{--    "publisher": {--}}
{{--        "@type": "Organization",--}}
{{--        "name": "WSoft Tecnologia",--}}
{{--        "logo": {--}}
{{--            "@type": "ImageObject",--}}
{{--            "url": "{{ asset('images/logo.png') }}"--}}
{{--        }--}}
{{--    }--}}
{{--}--}}
{{--</script>--}}
{{--@endsection--}}

@section('content')
<!-- Hero do Blog -->
<section class="bg-gradient-to-b from-blue-950 to-blue-700 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <p class="text-sm uppercase tracking-[0.2em] text-blue-200 mb-4">Blog WSoft</p>
        <h1 class="text-4xl md:text-5xl font-extrabold leading-tight">
            Dicas e Conteúdos sobre Gestão Empresarial
        </h1>
        <p class="mt-6 text-lg text-blue-100 max-w-3xl mx-auto">
            Acompanhe nossos artigos sobre controle financeiro, ordem de serviço, vendas e muito mais para melhorar a gestão do seu negócio.
        </p>
    </div>
</section>

<!-- Busca e Filtros -->
<section class="py-8 bg-white border-b border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <form action="{{ route('blog.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <input type="text" name="busca" value="{{ request('busca') }}" placeholder="Buscar artigos..."
                    class="w-full px-4 py-3 border border-slate-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="md:w-64">
                <select name="categoria" class="w-full px-4 py-3 border border-slate-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Todas as categorias</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->slug }}" {{ request('categoria') == $category->slug ? 'selected' : '' }}>
                            {{ $category->name }} ({{ $category->posts_count }})
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
                Buscar
            </button>
        </form>
    </div>
</section>

<!-- Posts em Destaque -->
@if($featuredPosts->count() > 0 && !request('busca') && !request('categoria'))
<section class="py-12 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-slate-900 mb-8">Posts em Destaque</h2>
        <div class="grid gap-8 md:grid-cols-3">
            @foreach($featuredPosts as $post)
            <article class="group bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden hover:shadow-lg transition">
                @if($post->featured_image)
                <a href="{{ route('blog.show', $post->slug) }}">
                    <img src="{{ Storage::disk('public')->url($post->featured_image) }}" alt="{{ $post->title }}"
                        class="w-full h-48 object-cover group-hover:scale-105 transition duration-300">
                </a>
                @else
                <div class="w-full h-48 bg-gradient-to-br from-blue-100 to-blue-50 flex items-center justify-center">
                    <i class="fa-solid fa-newspaper text-4xl text-blue-300"></i>
                </div>
                @endif
                <div class="p-6">
                    @if($post->category)
                    <span class="inline-block px-3 py-1 text-xs font-semibold text-blue-600 bg-blue-50 rounded-full mb-3">
                        {{ $post->category->name }}
                    </span>
                    @endif
                    <h3 class="text-lg font-bold text-slate-900 mb-2 group-hover:text-blue-600 transition">
                        <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                    </h3>
                    <p class="text-sm text-slate-600 line-clamp-2">
                        {{ $post->excerpt ?: Str::limit(strip_tags($post->content), 120) }}
                    </p>
                    <div class="mt-4 flex items-center text-xs text-slate-500">
                        <span>{{ $post->published_at->format('d/m/Y') }}</span>
                        <span class="mx-2">•</span>
                        <span>{{ $post->reading_time }} min de leitura</span>
                    </div>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Lista de Posts -->
<section class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-12">
            <!-- Posts -->
            <div class="flex-1">
                <h2 class="text-2xl font-bold text-slate-900 mb-8">
                    @if(request('busca'))
                        Resultados para "{{ request('busca') }}"
                    @elseif(request('categoria'))
                        Posts em {{ $categories->firstWhere('slug', request('categoria'))?->name }}
                    @else
                        Últimos Posts
                    @endif
                </h2>

                @if($posts->count() > 0)
                <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-2">
                    @foreach($posts as $post)
                    <article class="group bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden hover:shadow-lg transition">
                        @if($post->featured_image)
                        <a href="{{ route('blog.show', $post->slug) }}">
                            <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}"
                                class="w-full h-48 object-cover group-hover:scale-105 transition duration-300">
                        </a>
                        @else
                        <div class="w-full h-48 bg-gradient-to-br from-slate-100 to-slate-50 flex items-center justify-center">
                            <i class="fa-solid fa-file-lines text-4xl text-slate-300"></i>
                        </div>
                        @endif
                        <div class="p-6">
                            @if($post->category)
                            <a href="{{ route('blog.category', $post->category->slug) }}"
                                class="inline-block px-3 py-1 text-xs font-semibold text-blue-600 bg-blue-50 rounded-full mb-3 hover:bg-blue-100 transition">
                                {{ $post->category->name }}
                            </a>
                            @endif
                            <h3 class="text-lg font-bold text-slate-900 mb-2 group-hover:text-blue-600 transition">
                                <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                            </h3>
                            <p class="text-sm text-slate-600 line-clamp-3">
                                {{ $post->excerpt ?: Str::limit(strip_tags($post->content), 150) }}
                            </p>
                            <div class="mt-4 flex items-center justify-between">
                                <div class="flex items-center text-xs text-slate-500">
                                    <span>{{ $post->published_at->format('d/m/Y') }}</span>
                                    <span class="mx-2">•</span>
                                    <span>{{ $post->reading_time }} min</span>
                                </div>
                                <a href="{{ route('blog.show', $post->slug) }}"
                                    class="text-sm font-semibold text-blue-600 hover:text-blue-700 transition">
                                    Ler mais →
                                </a>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>

                <!-- Paginação -->
                <div class="mt-12">
                    {{ $posts->withQueryString()->links() }}
                </div>
                @else
                <div class="text-center py-12 bg-slate-50 rounded-2xl">
                    <i class="fa-solid fa-search text-4xl text-slate-300 mb-4"></i>
                    <p class="text-slate-600">Nenhum post encontrado.</p>
                    @if(request('busca') || request('categoria'))
                    <a href="{{ route('blog.index') }}" class="mt-4 inline-block text-blue-600 hover:text-blue-700 font-semibold">
                        Ver todos os posts
                    </a>
                    @endif
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <aside class="lg:w-80">
                <!-- Categorias -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 mb-6">
                    <h3 class="text-lg font-bold text-slate-900 mb-4">Categorias</h3>
                    <ul class="space-y-3">
                        @foreach($categories as $category)
                        <li>
                            <a href="{{ route('blog.category', $category->slug) }}"
                                class="flex items-center justify-between text-slate-600 hover:text-blue-600 transition">
                                <span>{{ $category->name }}</span>
                                <span class="text-xs bg-slate-100 px-2 py-1 rounded-full">{{ $category->posts_count }}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <!-- CTA -->
                <div class="bg-gradient-to-br from-blue-600 to-blue-700 rounded-2xl p-6 text-white">
                    <h3 class="text-lg font-bold mb-2">Teste o WSoft Grátis</h3>
                    <p class="text-sm text-blue-100 mb-4">
                        Experimente todas as funcionalidades por 7 dias sem compromisso.
                    </p>
                    <a href="/app/register" class="inline-block w-full text-center bg-white text-blue-600 font-semibold px-4 py-3 rounded-lg hover:bg-blue-50 transition">
                        Começar Agora
                    </a>
                </div>
            </aside>
        </div>
    </div>
</section>
@endsection
