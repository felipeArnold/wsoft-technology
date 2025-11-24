@extends('blog.layout')

@section('title', $category->name . ' - Blog')
@section('meta_description', $category->description ?: 'Confira todos os artigos sobre ' . $category->name . ' no blog da WSoft Tecnologia.')

{{--@section('structured_data')--}}
{{--<script type="application/ld+json">--}}
{{--{--}}
{{--    "@context": "https://schema.org",--}}
{{--    "@type": "CollectionPage",--}}
{{--    "name": "{{ $category->name }}",--}}
{{--    "description": "{{ $category->description ?: 'Artigos sobre ' . $category->name }}",--}}
{{--    "url": "{{ route('blog.category', $category->slug) }}",--}}
{{--    "isPartOf": {--}}
{{--        "@type": "Blog",--}}
{{--        "name": "Blog WSoft Tecnologia",--}}
{{--        "url": "{{ route('blog.index') }}"--}}
{{--    }--}}
{{--}--}}
{{--</script>--}}
{{--@endsection--}}

@section('content')
    <!-- Hero da Categoria -->
    <section class="bg-gradient-to-b from-blue-950 to-blue-700 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-sm uppercase tracking-[0.2em] text-blue-200 mb-4">Categoria</p>
            <h1 class="text-4xl md:text-5xl font-extrabold leading-tight">
                {{ $category->name }}
            </h1>
            @if($category->description)
            <p class="mt-6 text-lg text-blue-100 max-w-3xl mx-auto">
                {{ $category->description }}
            </p>
            @endif
        </div>
    </section>

    <!-- Lista de Posts -->
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-12">
                <!-- Posts -->
                <div class="flex-1">
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
                        {{ $posts->links() }}
                    </div>
                    @else
                    <div class="text-center py-12 bg-slate-50 rounded-2xl">
                        <i class="fa-solid fa-folder-open text-4xl text-slate-300 mb-4"></i>
                        <p class="text-slate-600">Nenhum post nesta categoria ainda.</p>
                        <a href="{{ route('blog.index') }}" class="mt-4 inline-block text-blue-600 hover:text-blue-700 font-semibold">
                            Ver todos os posts
                        </a>
                    </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <aside class="lg:w-80">
                    <!-- Categorias -->
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 mb-6">
                        <h3 class="text-lg font-bold text-slate-900 mb-4">Categorias</h3>
                        <ul class="space-y-3">
                            @foreach($categories as $cat)
                            <li>
                                <a href="{{ route('blog.category', $cat->slug) }}"
                                    class="flex items-center justify-between transition {{ $cat->id === $category->id ? 'text-blue-600 font-semibold' : 'text-slate-600 hover:text-blue-600' }}">
                                    <span>{{ $cat->name }}</span>
                                    <span class="text-xs bg-slate-100 px-2 py-1 rounded-full">{{ $cat->posts_count }}</span>
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
