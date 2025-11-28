<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta name="robots" content="index,follow" />

    <title>{{ $title ?? 'Sistema de Gestão para Pequenas Empresas | WSoft' }}</title>
    <meta name="description" content="{{ $description ?? 'WSoft - Sistema de gestão completo para pequenas empresas e MEI. Controle financeiro, clientes, estoque e OS. Teste grátis!' }}" />
    <meta name="keywords" content="{{ $keywords ?? 'sistema de gestão, pequenas empresas, MEI, controle financeiro, ordem de serviço, WSoft' }}" />
    <link rel="canonical" href="{{ $canonical ?? url()->current() }}" />

    <!-- Open Graph -->
    <meta property="og:site_name" content="WSoft Tecnologia" />
    <meta property="og:title" content="{{ $ogTitle ?? $title ?? 'Sistema de Gestão para Pequenas Empresas | WSoft' }}" />
    <meta property="og:description" content="{{ $ogDescription ?? $description ?? 'Controle financeiro, ordem de serviço, vendas, estoque e assinatura digital em um único sistema. Teste grátis!' }}" />
    <meta property="og:type" content="website" />

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{ $twitterTitle ?? $title ?? 'WSoft - Sistema de Gestão Online' }}" />
    <meta name="twitter:description" content="{{ $twitterDescription ?? $description ?? 'Sistema de gestão com financeiro, OS, vendas e assinatura digital.' }}" />

    <!-- Structured Data -->
    @if(isset($structuredData))
        <script type="application/ld+json">
        {!! json_encode($structuredData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
        </script>
    @endif

    <script src="{{ asset('js/tailwind.js') }}"></script>
    <link rel="icon" type="image/png" href="{{ asset('images/icon.webp') }}">
    <link rel="stylesheet" href="{{ asset('css/site/index.css') }}">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="distribution" content="Global">
    <meta name="rating" content="General">
    <meta name="language" content="pt-BR">
    <meta name="content-language" content="pt-BR">

    <meta name="google-site-verification" content="kHvaTl5DHIzqDIdHK0WctKwaxOcLvpCKu9FZWGD6Yg8" />
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-MN5442GH2J"></script>

    <script async src="https://www.googletagmanager.com/gtag/js?id=G-MN5442GH2J"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-MN5442GH2J');
    </script>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-11559494036"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'AW-11559494036');
    </script>

    <!-- Event snippet for Inscrição conversion page -->
    <script>
        gtag('event', 'conversion', {'send_to': 'AW-11559494036/-uoWCOCWoIQaEJTD_4cr'});
    </script>

    {{ $head ?? '' }}
</head>
<body class="bg-slate-50 text-slate-900 font-sans pt-10">

    <header class="fixed inset-x-0 top-0 z-50 bg-white/90 backdrop-blur border-b border-slate-100 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <a href="/" class="flex items-center space-x-3 text-blue-900 font-semibold">
                    <img src="{{ asset('images/logo.png') }}" alt="WSoft Tecnologia | Sistema de Gestão para Pequenas Empresas" class="h-16 w-auto">
                </a>
                <nav class="hidden md:flex items-center space-x-6 text-sm font-medium">
                    <a href="/#beneficios" class="hover:text-blue-600 transition">Benefícios</a>
                    <a href="/#porque" class="hover:text-blue-600 transition">Por que WSoft</a>
                    <a href="/#demo" class="hover:text-blue-600 transition">Demonstração</a>
                    <a href="/#funcionalidades" class="hover:text-blue-600 transition">Funcionalidades</a>
                    <a href="/#precos" class="text-red-600 font-bold hover:text-red-700 transition">Oferta Especial 🔥</a>
                    <a href="/blog" class="hover:text-blue-600 transition">Blog</a>
                    <a href="/#faq" class="hover:text-blue-600 transition">FAQ</a>
                    <a href="/app/login" class="hover:text-blue-600 transition border rounded-2xl">Login</a>
                    <a href="/app/register" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition shadow-lg shadow-blue-600/20">Cadastrar</a>
                </nav>
                <button id="menu-button" class="md:hidden text-2xl text-slate-700" aria-label="Abrir menu">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
            <div id="mobile-nav" class="md:hidden hidden pb-4">
                <nav class="flex flex-col space-y-2 text-sm font-semibold text-slate-700">
                    <a href="/#beneficios" class="py-2 border-b border-slate-100">Benefícios</a>
                    <a href="/#porque" class="py-2 border-b border-slate-100">Por que WSoft</a>
                    <a href="/#demo" class="py-2 border-b border-slate-100">Demonstração</a>
                    <a href="/#funcionalidades" class="py-2 border-b border-slate-100">Funcionalidades</a>
                    <a href="/#precos" class="py-2 border-b border-slate-100">Preços</a>
                    <a href="/#faq" class="py-2 border-b border-slate-100">FAQ</a>
                    <a href="/app/login" class="py-2 border-b border-slate-100">Login</a>
                    <a href="/app/register" class="py-2 text-blue-600">Cadastrar</a>
                </nav>
            </div>
        </div>
    </header>

    {{ $slot }}

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
                    <li><a href="{{ route('landing.gestao-clientes') }}" class="hover:text-white">Sistema de Gestão de Clientes</a></li>
                    <li><a href="{{ route('landing.gestao-fornecedores') }}" class="hover:text-white">Sistema de Gestão de Fornecedores</a></li>
                    <li><a href="{{ route('landing.gestao-estoque') }}" class="hover:text-white">Sistema de Gestão de Estoque</a></li>
                    <li><a href="{{ route('landing.contas-pagar') }}" class="hover:text-white">Sistema de Contas a Pagar</a></li>
                    <li><a href="{{ route('landing.contas-receber') }}" class="hover:text-white">Sistema de Contas a Receber</a></li>
                    <li><a href="{{ route('landing.controle-inadimplencia') }}" class="hover:text-white">Controle de Inadimplência</a></li>
                    <li><a href="{{ route('landing.movimentacao-financeira') }}" class="hover:text-white">Fluxo de Caixa</a></li>
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

    {{ $scripts ?? '' }}
</body>
</html>
