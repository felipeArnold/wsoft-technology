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

{{--@section('structured_data')--}}
{{--<script type="application/ld+json">--}}
{{--{--}}
{{--    "@context": "https://schema.org",--}}
{{--    "@type": "BlogPosting",--}}
{{--    "headline": "{{ $post->title }}",--}}
{{--    "description": "{{ $post->effective_meta_description }}",--}}
{{--    "url": "{{ route('blog.show', $post->slug) }}",--}}
{{--    "datePublished": "{{ $post->published_at->toIso8601String() }}",--}}
{{--    "dateModified": "{{ $post->updated_at->toIso8601String() }}",--}}
{{--    @if($post->effective_og_image)--}}
{{--    "image": "{{ Storage::url($post->effective_og_image) }}",--}}
{{--    @endif--}}
{{--    "author": {--}}
{{--        "@type": "Person",--}}
{{--        "name": "{{ $post->author?->name ?? 'WSoft Tecnologia' }}"--}}
{{--    },--}}
{{--    "publisher": {--}}
{{--        "@type": "Organization",--}}
{{--        "name": "WSoft Tecnologia",--}}
{{--        "logo": {--}}
{{--            "@type": "ImageObject",--}}
{{--            "url": "{{ asset('images/logo.png') }}"--}}
{{--        }--}}
{{--    },--}}
{{--    "mainEntityOfPage": {--}}
{{--        "@type": "WebPage",--}}
{{--        "@id": "{{ route('blog.show', $post->slug) }}"--}}
{{--    }--}}
{{--    @if($post->category)--}}
{{--    ,"articleSection": "{{ $post->category->name }}"--}}
{{--    @endif--}}
{{--}--}}
{{--</script>--}}
{{--@endsection--}}

{{--@section('structured_data')--}}

<!-- BreadcrumbList -->
{{--<script type="application/ld+json">--}}
{{--{--}}
{{--    "@context": "https://schema.org",--}}
{{--    "@type": "BreadcrumbList",--}}
{{--    "itemListElement": [--}}
{{--        {--}}
{{--            "@type": "ListItem",--}}
{{--            "position": 1,--}}
{{--            "name": "Home",--}}
{{--            "item": "{{ url('/') }}"--}}
{{--        },--}}
{{--        {--}}
{{--            "@type": "ListItem",--}}
{{--            "position": 2,--}}
{{--            "name": "Blog",--}}
{{--            "item": "{{ route('blog.index') }}"--}}
{{--        }--}}
{{--        @if($post->category)--}}
{{--        ,{--}}
{{--            "@type": "ListItem",--}}
{{--            "position": 3,--}}
{{--            "name": "{{ $post->category->name }}",--}}
{{--            "item": "{{ route('blog.category', $post->category->slug) }}"--}}
{{--        },--}}
{{--        {--}}
{{--            "@type": "ListItem",--}}
{{--            "position": 4,--}}
{{--            "name": "{{ $post->title }}"--}}
{{--        }--}}
{{--        @else--}}
{{--        ,{--}}
{{--            "@type": "ListItem",--}}
{{--            "position": 3,--}}
{{--            "name": "{{ $post->title }}"--}}
{{--        }--}}
{{--        @endif--}}
{{--    ]--}}
{{--}--}}
{{--</script>--}}




@section('content')
    <!-- Breadcrumb -->
    <section class="bg-slate-100 py-4">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="text-sm text-slate-600">
                <ol class="flex items-center space-x-2">
                    <li><a href="/" class="hover:text-blue-600">Home</a></li>
                    <li><span class="text-slate-400">/</span></li>
                    <li><a href="{{ route('blog.index') }}" class="hover:text-blue-600">Blog</a></li>
                    @if($post->category)
                    <li><span class="text-slate-400">/</span></li>
                    <li><a href="{{ route('blog.category', $post->category->slug) }}" class="hover:text-blue-600">{{ $post->category->name }}</a></li>
                    @endif
                    <li><span class="text-slate-400">/</span></li>
                    <li class="text-slate-900 font-medium truncate">{{ Str::limit($post->title, 30) }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Artigo -->
    <article class="py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header do Post -->
            <header class="mb-8">
                @if($post->category)
                <a href="{{ route('blog.category', $post->category->slug) }}"
                    class="inline-block px-4 py-1 text-sm font-semibold text-blue-600 bg-blue-50 rounded-full mb-4 hover:bg-blue-100 transition">
                    {{ $post->category->name }}
                </a>
                @endif

                <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-slate-900 leading-tight">
                    {{ $post->title }}
                </h1>

                <div class="mt-6 flex flex-wrap items-center gap-4 text-sm text-slate-600">
                    @if($post->author)
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                            <span class="text-blue-600 font-semibold text-xs">{{ substr($post->author->name, 0, 1) }}</span>
                        </div>
                        <span>{{ $post->author->name }}</span>
                    </div>
                    @endif
                    <span class="flex items-center gap-1">
                        <i class="fa-regular fa-calendar"></i>
                        {{ $post->published_at->format('d/m/Y') }}
                    </span>
                    <span class="flex items-center gap-1">
                        <i class="fa-regular fa-clock"></i>
                        {{ $post->reading_time }} min de leitura
                    </span>
                    <span class="flex items-center gap-1">
                        <i class="fa-regular fa-eye"></i>
                        {{ number_format($post->view_count) }} visualizações
                    </span>
                </div>
            </header>

            <!-- Imagem Destaque -->
            @if($post->featured_image)
            <figure class="mb-8">
                <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}"
                    class="w-full rounded-2xl shadow-lg">
            </figure>
            @endif

            <!-- Conteúdo -->
            <div class="blog-content max-w-none">
                {!! $post->content !!}
            </div>

            <!-- CTA Inline -->
            <div class="mt-12 mb-10 p-8 bg-gradient-to-br from-blue-50 to-indigo-50 border border-blue-100 rounded-2xl">
                <div class="flex flex-col md:flex-row items-center gap-6">
                    <div class="flex-shrink-0">
                        <div class="w-16 h-16 bg-blue-600 rounded-xl flex items-center justify-center shadow-lg">
                            <i class="fa-solid fa-rocket text-2xl text-white"></i>
                        </div>
                    </div>
                    <div class="flex-1 text-center md:text-left">
                        <h3 class="text-xl font-bold text-slate-900 mb-2">
                            Coloque em prática o que você aprendeu!
                        </h3>
                        <p class="text-slate-600">
                            Experimente o WSoft gratuitamente por 7 dias e organize sua empresa de forma simples e eficiente.
                        </p>
                    </div>
                    <div class="flex-shrink-0">
                        <a href="/app/register"
                            class="inline-flex items-center gap-2 bg-blue-600 text-white font-semibold px-6 py-3 rounded-lg hover:bg-blue-700 transition shadow-md hover:shadow-lg">
                            Começar Grátis
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Tags/Keywords -->
            @if($post->meta_keywords)
            <div class="mt-10 pt-8 border-t border-slate-200">
                <div class="flex items-center gap-2 mb-4">
                    <i class="fa-solid fa-tags text-blue-500"></i>
                    <h3 class="text-sm font-semibold text-slate-700 uppercase tracking-wide">Tags</h3>
                </div>
                <div class="flex flex-wrap gap-3">
                    @foreach(explode(',', $post->meta_keywords) as $keyword)
                    <span class="inline-flex items-center px-4 py-2 text-sm font-medium bg-slate-100 text-slate-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors cursor-default">
                        {{ trim($keyword) }}
                    </span>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Compartilhar -->
            <div class="mt-8 pt-8 border-t border-slate-200">
                <h3 class="text-sm font-semibold text-slate-700 mb-3">Compartilhar:</h3>
                <div class="flex gap-3">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('blog.show', $post->slug)) }}"
                        target="_blank" rel="noopener noreferrer"
                        class="w-10 h-10 flex items-center justify-center bg-blue-600 text-white rounded-full hover:bg-blue-700 transition">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('blog.show', $post->slug)) }}&text={{ urlencode($post->title) }}"
                        target="_blank" rel="noopener noreferrer"
                        class="w-10 h-10 flex items-center justify-center bg-sky-500 text-white rounded-full hover:bg-sky-600 transition">
                        <i class="fa-brands fa-twitter"></i>
                    </a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(route('blog.show', $post->slug)) }}&title={{ urlencode($post->title) }}"
                        target="_blank" rel="noopener noreferrer"
                        class="w-10 h-10 flex items-center justify-center bg-blue-700 text-white rounded-full hover:bg-blue-800 transition">
                        <i class="fa-brands fa-linkedin-in"></i>
                    </a>
                    <a href="https://api.whatsapp.com/send?text={{ urlencode($post->title . ' - ' . route('blog.show', $post->slug)) }}"
                        target="_blank" rel="noopener noreferrer"
                        class="w-10 h-10 flex items-center justify-center bg-green-500 text-white rounded-full hover:bg-green-600 transition">
                        <i class="fa-brands fa-whatsapp"></i>
                    </a>
                </div>
            </div>
        </div>
    </article>

    <!-- Posts Relacionados -->
    @if($relatedPosts->count() > 0)
    <section class="py-12 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-slate-900 mb-8">Posts Relacionados</h2>
            <div class="grid gap-8 md:grid-cols-3">
                @foreach($relatedPosts as $relatedPost)
                <article class="group bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden hover:shadow-lg transition">
                    @if($relatedPost->featured_image)
                    <a href="{{ route('blog.show', $relatedPost->slug) }}">
                        <img src="{{ Storage::url($relatedPost->featured_image) }}" alt="{{ $relatedPost->title }}"
                            class="w-full h-48 object-cover group-hover:scale-105 transition duration-300">
                    </a>
                    @else
                    <div class="w-full h-48 bg-gradient-to-br from-slate-100 to-slate-50 flex items-center justify-center">
                        <i class="fa-solid fa-file-lines text-4xl text-slate-300"></i>
                    </div>
                    @endif
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-slate-900 mb-2 group-hover:text-blue-600 transition">
                            <a href="{{ route('blog.show', $relatedPost->slug) }}">{{ $relatedPost->title }}</a>
                        </h3>
                        <p class="text-sm text-slate-600 line-clamp-2">
                            {{ $relatedPost->excerpt ?: Str::limit(strip_tags($relatedPost->content), 100) }}
                        </p>
                        <div class="mt-4 text-xs text-slate-500">
                            {{ $relatedPost->published_at->format('d/m/Y') }}
                        </div>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- CTA -->
    <section class="py-16 bg-gradient-to-br from-blue-600 to-blue-700 text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-4">Pronto para organizar sua empresa?</h2>
            <p class="text-lg text-blue-100 mb-8">
                Teste o WSoft gratuitamente por 7 dias e veja como podemos ajudar seu negócio a crescer.
            </p>
            <a href="/app/register" class="inline-block bg-white text-blue-600 font-semibold px-8 py-4 rounded-lg hover:bg-blue-50 transition shadow-lg">
                Começar Teste Grátis
            </a>
        </div>
    </section>
@endsection
