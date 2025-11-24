@extends('blog.layout')

@section('title', 'Blog - Dicas de Gestão Empresarial')
@section('meta_description', 'Confira nosso blog com dicas sobre gestão empresarial, controle financeiro, ordem de serviço, redução de inadimplência e muito mais.')
@section('meta_keywords', 'gestão empresarial, controle financeiro, ordem de serviço, sistema de gestão, dicas empresariais')



@section('content')
<!-- Hero do Blog -->
<section class="relative bg-slate-900 text-white py-20 overflow-hidden">
    <div class="absolute inset-0 bg-[url('/images/grid-pattern.svg')] opacity-10"></div>
    <div class="absolute inset-0 bg-gradient-to-br from-blue-900/50 to-slate-900/80"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-block py-1 px-3 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-300 text-xs font-semibold uppercase tracking-wider mb-6">
            Blog WSoft
        </span>
        <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight mb-6">
            Gestão Inteligente <br class="hidden md:block" /> para o seu Negócio
        </h1>
        <p class="mt-6 text-lg md:text-xl text-slate-300 max-w-2xl mx-auto leading-relaxed">
            Descubra estratégias comprovadas de gestão, dicas financeiras e tendências de mercado para impulsionar o crescimento da sua empresa.
        </p>
    </div>
</section>

<!-- Busca e Filtros -->
<section class="relative -mt-8 z-10 mb-12">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/50 p-6 border border-slate-100">
            <form action="{{ route('blog.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                <div class="flex-1 relative">
                    <i class="fa-solid fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                    <input type="text" name="busca" value="{{ request('busca') }}" placeholder="O que você quer aprender hoje?"
                        class="w-full pl-12 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all placeholder:text-slate-400 text-slate-700">
                </div>
                <div class="md:w-72">
                    <select name="categoria" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all text-slate-700 cursor-pointer">
                        <option value="">Todas as categorias</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->slug }}" {{ request('categoria') == $category->slug ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="bg-blue-600 text-white px-8 py-3.5 rounded-xl hover:bg-blue-700 transition-all font-semibold shadow-lg shadow-blue-600/20 hover:shadow-blue-600/30 active:scale-95">
                    Buscar
                </button>
            </form>
        </div>
    </div>
</section>

<!-- Posts em Destaque -->
@if($featuredPosts->count() > 0 && !request('busca') && !request('categoria'))
<section class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl font-bold text-slate-900 flex items-center gap-2">
                <i class="fa-solid fa-star text-yellow-500"></i> Destaques
            </h2>
        </div>
        <div class="grid gap-8 md:grid-cols-3">
            @foreach($featuredPosts as $post)
            <article class="group flex flex-col bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                @if($post->featured_image)
                <a href="{{ route('blog.show', $post->slug) }}" class="relative overflow-hidden aspect-video">
                    <div class="absolute inset-0 bg-slate-900/0 group-hover:bg-slate-900/10 transition-colors z-10"></div>
                    <img src="{{ Storage::disk('public')->url($post->featured_image) }}" alt="{{ $post->title }}"
                        class="w-full h-full object-cover transform group-hover:scale-105 transition duration-500">
                </a>
                @else
                <div class="w-full aspect-video bg-gradient-to-br from-blue-50 to-slate-50 flex items-center justify-center">
                    <i class="fa-solid fa-newspaper text-4xl text-blue-200"></i>
                </div>
                @endif
                <div class="flex-1 p-6 flex flex-col">
                    @if($post->category)
                    <div class="mb-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700">
                            {{ $post->category->name }}
                        </span>
                    </div>
                    @endif
                    <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-blue-600 transition-colors line-clamp-2">
                        <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                    </h3>
                    <p class="text-slate-600 text-sm leading-relaxed line-clamp-3 mb-6 flex-1">
                        {{ $post->excerpt ?: Str::limit(strip_tags($post->content), 120) }}
                    </p>
                    <div class="flex items-center justify-between pt-6 border-t border-slate-50">
                        <div class="flex items-center text-xs text-slate-500 font-medium">
                            <i class="fa-regular fa-calendar mr-1.5"></i>
                            {{ $post->published_at->format('d M, Y') }}
                        </div>
                        <div class="flex items-center text-xs text-slate-500 font-medium">
                            <i class="fa-regular fa-clock mr-1.5"></i>
                            {{ $post->reading_time }} min
                        </div>
                    </div>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Lista de Posts -->
<section class="py-12 bg-slate-50/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-12">
            <!-- Posts -->
            <div class="flex-1">
                <h2 class="text-2xl font-bold text-slate-900 mb-8 pb-4 border-b border-slate-200">
                    @if(request('busca'))
                        Resultados para "<span class="text-blue-600">{{ request('busca') }}</span>"
                    @elseif(request('categoria'))
                        Categoria: <span class="text-blue-600">{{ $categories->firstWhere('slug', request('categoria'))?->name }}</span>
                    @else
                        Últimas Publicações
                    @endif
                </h2>

                @if($posts->count() > 0)
                <div class="grid gap-8 md:grid-cols-2">
                    @foreach($posts as $post)
                    <article class="group bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden hover:shadow-lg transition-all duration-300">
                        @if($post->featured_image)
                        <a href="{{ route('blog.show', $post->slug) }}" class="block overflow-hidden aspect-[16/9]">
                            <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        </a>
                        @else
                        <div class="w-full aspect-[16/9] bg-gradient-to-br from-slate-100 to-slate-50 flex items-center justify-center">
                            <i class="fa-solid fa-file-lines text-4xl text-slate-300"></i>
                        </div>
                        @endif
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-3">
                                @if($post->category)
                                <a href="{{ route('blog.category', $post->category->slug) }}"
                                    class="text-xs font-semibold text-blue-600 hover:text-blue-700 transition">
                                    {{ $post->category->name }}
                                </a>
                                @endif
                                <span class="text-xs text-slate-400">{{ $post->published_at->format('d M, Y') }}</span>
                            </div>
                            <h3 class="text-lg font-bold text-slate-900 mb-2 group-hover:text-blue-600 transition-colors line-clamp-2">
                                <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                            </h3>
                            <p class="text-sm text-slate-600 line-clamp-3 mb-4 leading-relaxed">
                                {{ $post->excerpt ?: Str::limit(strip_tags($post->content), 150) }}
                            </p>
                            <a href="{{ route('blog.show', $post->slug) }}"
                                class="inline-flex items-center text-sm font-semibold text-blue-600 hover:text-blue-700 transition group/link">
                                Ler artigo completo
                                <i class="fa-solid fa-arrow-right ml-1.5 transform group-hover/link:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </article>
                    @endforeach
                </div>

                <!-- Paginação -->
                <div class="mt-12">
                    {{ $posts->withQueryString()->links() }}
                </div>
                @else
                <div class="text-center py-16 bg-white rounded-2xl border border-dashed border-slate-300">
                    <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fa-solid fa-search text-2xl text-slate-400"></i>
                    </div>
                    <h3 class="text-lg font-medium text-slate-900 mb-2">Nenhum post encontrado</h3>
                    <p class="text-slate-500 mb-6">Tente buscar por outros termos ou categorias.</p>
                    @if(request('busca') || request('categoria'))
                    <a href="{{ route('blog.index') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-blue-700 bg-blue-100 hover:bg-blue-200 transition">
                        Limpar filtros
                    </a>
                    @endif
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <aside class="lg:w-80 space-y-8">
                <!-- Categorias -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                    <h3 class="text-lg font-bold text-slate-900 mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-folder-open text-blue-500"></i> Categorias
                    </h3>
                    <ul class="space-y-2">
                        @foreach($categories as $category)
                        <li>
                            <a href="{{ route('blog.category', $category->slug) }}"
                                class="group flex items-center justify-between p-2 rounded-lg hover:bg-slate-50 transition-colors">
                                <span class="text-slate-600 group-hover:text-blue-600 transition-colors font-medium text-sm">{{ $category->name }}</span>
                                <span class="text-xs font-semibold bg-slate-100 text-slate-500 px-2 py-0.5 rounded-full group-hover:bg-blue-100 group-hover:text-blue-600 transition-colors">{{ $category->posts_count }}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Newsletter / CTA -->
                <div class="bg-gradient-to-br from-blue-600 to-indigo-700 rounded-2xl p-6 text-white text-center shadow-lg shadow-blue-600/20">
                    <div class="w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center mx-auto mb-4 backdrop-blur-sm">
                        <i class="fa-solid fa-rocket text-xl text-white"></i>
                    </div>
                    <h3 class="text-lg font-bold mb-2">Potencialize sua Gestão</h3>
                    <p class="text-sm text-blue-100 mb-6 leading-relaxed">
                        Experimente o WSoft gratuitamente e transforme a administração da sua empresa.
                    </p>
                    <a href="/app/register" class="block w-full bg-white text-blue-600 font-bold py-3 rounded-xl hover:bg-blue-50 transition shadow-md active:scale-95">
                        Começar Teste Grátis
                    </a>
                    <p class="mt-4 text-xs text-blue-200/80">
                        Sem cartão de crédito • Cancele quando quiser
                    </p>
                </div>
            </aside>
        </div>
    </div>
</section>
@endsection
