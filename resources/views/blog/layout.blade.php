<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1" />

    <title>@yield('title', 'Blog') | WSoft Tecnologia</title>
    <meta name="description" content="@yield('meta_description', 'Blog da WSoft Tecnologia - Dicas e conteúdos sobre gestão empresarial, controle financeiro, ordem de serviço e muito mais.')" />
    <link rel="canonical" href="{{ url()->current() }}" />

    @if(\Illuminate\Support\Facades\View::hasSection('meta_keywords'))
    <meta name="keywords" content="@yield('meta_keywords')" />
    @endif

    <!-- Open Graph -->
    <meta property="og:locale" content="pt_BR" />
    <meta property="og:site_name" content="WSoft Tecnologia" />
    <meta property="og:title" content="@yield('og_title', 'Blog | WSoft Tecnologia')" />
    <meta property="og:description" content="@yield('og_description', 'Blog da WSoft Tecnologia - Dicas e conteúdos sobre gestão empresarial.')" />
    <meta property="og:type" content="@yield('og_type', 'website')" />
    <meta property="og:url" content="{{ url()->current() }}" />
    @if(\Illuminate\Support\Facades\View::hasSection('og_image'))
    <meta property="og:image" content="@yield('og_image')" />
    <meta property="og:image:alt" content="@yield('og_title', 'Blog WSoft Tecnologia')" />
    @else
    <meta property="og:image" content="{{ asset('images/og-default.jpg') }}" />
    @endif

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@wsofttecnologia" />
    <meta name="twitter:title" content="@yield('twitter_title', 'Blog | WSoft Tecnologia')" />
    <meta name="twitter:description" content="@yield('twitter_description', 'Blog da WSoft Tecnologia - Dicas e conteúdos sobre gestão empresarial.')" />
    @if(\Illuminate\Support\Facades\View::hasSection('og_image'))
    <meta name="twitter:image" content="@yield('og_image')" />
    @else
    <meta name="twitter:image" content="{{ asset('images/og-default.jpg') }}" />
    @endif

    <!-- AI-Friendly Article Metadata -->
    @if(\Illuminate\Support\Facades\View::hasSection('article_author'))
    <meta name="article:author" content="@yield('article_author')" />
    @endif
    @if(\Illuminate\Support\Facades\View::hasSection('article_published_time'))
    <meta name="article:published_time" content="@yield('article_published_time')" />
    @endif
    @if(\Illuminate\Support\Facades\View::hasSection('article_modified_time'))
    <meta name="article:modified_time" content="@yield('article_modified_time')" />
    @endif
    @if(\Illuminate\Support\Facades\View::hasSection('article_section'))
    <meta name="article:section" content="@yield('article_section')" />
    @endif
    @if(\Illuminate\Support\Facades\View::hasSection('article_tag'))
    <meta name="article:tag" content="@yield('article_tag')" />
    @endif
    <meta name="article:publisher" content="WSoft Tecnologia" />

    <!-- AI Search Optimization -->
    <meta name="searchgpt:content-type" content="@yield('content_type', 'blog-article')" />
    <meta name="perplexity:primary-topic" content="@yield('primary_topic', 'Gestão Empresarial')" />

    <!-- Structured Data -->
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "Organization",
        "name": "WSoft Tecnologia",
        "url": "{{ url('/') }}",
        "logo": "{{ asset('images/logo.png') }}",
        "sameAs": [
            "https://www.facebook.com/wsoft.tecnologia",
            "https://www.instagram.com/wsoft.tecnologia",
            "https://www.linkedin.com/company/wsoft-tecnologia"
        ],
        "contactPoint": {
            "@@type": "ContactPoint",
            "telephone": "+55-51-99999-9999",
            "contactType": "customer service",
            "areaServed": "BR",
            "availableLanguage": "Portuguese"
        }
    }
    </script>
    @yield('structured_data')

    <script src="{{ asset('js/tailwind.js') }}"></script>
    <link rel="icon" type="image/png" href="{{ asset('images/icon.webp') }}">
    <link rel="stylesheet" href="{{ asset('css/site/index.css') }}">

    @stack('styles')

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="distribution" content="Global">
    <meta name="rating" content="General">
    <meta name="language" content="pt-BR">
    <meta name="content-language" content="pt-BR">

    <meta name="google-site-verification" content="kHvaTl5DHIzqDIdHK0WctKwaxOcLvpCKu9FZWGD6Yg8" />
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-MN5442GH2J"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-MN5442GH2J');
    </script>

    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1979897360190795"
     crossorigin="anonymous"></script>
</head>
<body class="bg-slate-50 text-slate-900 font-sans">
    <header class="fixed inset-x-0 top-0 z-50 bg-white/90 backdrop-blur border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <a href="/" class="flex items-center space-x-3 text-blue-900 font-semibold">
                    <img src="{{ asset('images/logo.png') }}" alt="WSoft Tecnologia | Sistema de Gestão para Pequenas Empresas" class="h-16 w-auto">
                </a>
                <nav class="hidden md:flex items-center space-x-6 text-sm font-medium">
                    <a href="/#beneficios" class="hover:text-blue-600 transition">Benefícios</a>
                    <a href="/#funcionalidades" class="hover:text-blue-600 transition">Funcionalidades</a>
                    <a href="/#precos" class="hover:text-blue-600 transition">Preços</a>
                    <a href="{{ route('blog.index') }}" class="text-blue-600 font-semibold">Blog</a>
                    <a href="/app/login" class="hover:text-blue-600 transition border rounded-2xl px-3 py-1">Login</a>
                    <a href="/app/register" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Cadastrar</a>
                </nav>
                <button id="menu-button" class="md:hidden text-2xl text-slate-700" aria-label="Abrir menu">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
            <div id="mobile-nav" class="md:hidden hidden pb-4">
                <nav class="flex flex-col space-y-2 text-sm font-semibold text-slate-700">
                    <a href="/#beneficios" class="py-2 border-b border-slate-100">Benefícios</a>
                    <a href="/#funcionalidades" class="py-2 border-b border-slate-100">Funcionalidades</a>
                    <a href="/#precos" class="py-2 border-b border-slate-100">Preços</a>
                    <a href="{{ route('blog.index') }}" class="py-2 border-b border-slate-100 text-blue-600">Blog</a>
                    <a href="/app/login" class="py-2 border-b border-slate-100">Login</a>
                    <a href="/app/register" class="py-2 text-blue-600">Cadastrar</a>
                </nav>
            </div>
        </div>
    </header>

    <main class="pt-16">
        @yield('content')
    </main>

    <footer id="contato" class="bg-slate-900 text-slate-100 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid md:grid-cols-5 gap-10">
            <div>
                <h3 class="text-lg font-semibold">WSoft Tecnologia</h3>
                <p class="mt-3 text-sm text-slate-400">Sistema de gestão para pequenas empresas que une organização empresarial e crescimento previsível.</p>
            </div>
            <div>
                <h4 class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Produto</h4>
                <ul class="mt-4 space-y-2 text-sm text-slate-300">
                    <li><a href="/beneficios" class="hover:text-white">Benefícios</a></li>
                    <li><a href="/demonstracao" class="hover:text-white">Demonstração</a></li>
                    <li><a href="/#precos" class="hover:text-white">Preços</a></li>
                    <li><a href="/faq" class="hover:text-white">FAQ</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Soluções</h4>
                <ul class="mt-4 space-y-2 text-sm text-slate-300">
                    <li><a href="/oficina" class="hover:text-white">Sistema para Oficina</a></li>
                    <li><a href="/mecanica" class="hover:text-white">Sistema para Mecânica</a></li>
                    <li><a href="/funilaria" class="hover:text-white">Sistema para Funilaria</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Blog</h4>
                <ul class="mt-4 space-y-2 text-sm text-slate-300">
                    <li><a href="{{ route('blog.index') }}" class="hover:text-white">Todos os Posts</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Contato</h4>
                <ul class="mt-4 space-y-2 text-sm text-slate-300">
                    <li>contato@wsoft.com.br</li>
                    <li>Rolante/RS</li>
                </ul>
            </div>
        </div>
        <p class="mt-10 text-center text-xs text-slate-500">&copy; {{ now()->year }} WSoft Tecnologia. Todos os direitos reservados.</p>
    </footer>

    <script>
        const button = document.getElementById('menu-button');
        const mobileNav = document.getElementById('mobile-nav');
        if (button) {
            button.addEventListener('click', () => {
                mobileNav.classList.toggle('hidden');
            });
        }
    </script>
</body>
</html>
