<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,viewport-fit=cover" />
    <meta name="format-detection" content="telephone=no">
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
    <meta name="author" content="WSoft Tecnologia" />
    <meta name="copyright" content="WSoft Tecnologia" />
    <meta name="application-name" content="WSoft" />
    <meta name="theme-color" content="#2563eb" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="apple-mobile-web-app-title" content="WSoft" />

    <!-- Geo Tags -->
    <meta name="geo.region" content="BR-RS" />
    <meta name="geo.placename" content="Rolante" />
    <meta name="geo.position" content="-29.65056;-50.57583" />
    <meta name="ICBM" content="-29.65056, -50.57583" />

    <link rel="alternate" href="{{ url()->current() }}" hreflang="pt-br" />
    <link rel="alternate" href="{{ url()->current() }}" hreflang="x-default" />
    <meta property="og:locale" content="pt_BR" />

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
    @php
        $globalSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => 'WSoft Tecnologia',
            'url' => 'https://www.wsoft.dev.br',
            'logo' => asset('images/logo.png'),
            'sameAs' => [
                'https://www.instagram.com/wsoft.tecnologia?igsh=MWlzdmZlYXhzcmlzYQ%3D%3D&utm_source=qr',
                'https://www.facebook.com/wsoft.tecnologia'
            ],
            'contactPoint' => [
                '@type' => 'ContactPoint',
                'telephone' => '+55-51-99999-9999',
                'contactType' => 'customer service',
                'areaServed' => 'BR',
                'availableLanguage' => 'Portuguese'
            ]
        ];

        if(isset($structuredData)) {
            // Se já existe structuredData da página, adicionamos o Organization como um elemento extra se for array de arrays,
            // ou se for um único objeto, transformamos em array.
            // O padrão adotado nas páginas é um array de objetos (schemas).
            $finalStructuredData = array_merge($structuredData, [$globalSchema]);
        } else {
            $finalStructuredData = [$globalSchema];
        }
    @endphp

    <script type="application/ld+json">
    {!! json_encode($finalStructuredData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
    </script>

    <link rel="icon" type="image/png" href="{{ asset('images/icon.webp') }}">
    <link rel="manifest" href="{{ asset('manifest.json') }}">

    <!-- Preload critical images -->
    <link rel="preload" href="{{ asset('images/logo.png') }}" as="image" fetchpriority="high">
    <link rel="preload" href="{{ asset('images/logo-white.png') }}" as="image">

    <!-- Critical CSS inline -->
    <style>
        body{margin:0;padding:0;font-family:system-ui,-apple-system,sans-serif;background-color:#f8fafc;color:#0f172a}
        header{position:fixed;top:0;left:0;right:0;z-index:50;background-color:rgba(255,255,255,0.9);backdrop-filter:blur(10px);border-bottom:1px solid #e2e8f0}
        img{max-width:100%;height:auto}
        .container{max-width:1280px;margin:0 auto;padding:0 1rem}
        @font-face{font-display:swap}
    </style>

    <!-- Critical CSS -->
    <link rel="stylesheet" href="{{ asset('css/site/index.css') }}">

    <!-- Load Tailwind -->
    <script src="{{ asset('js/tailwind.js') }}"></script>

    <!-- Performance monitoring -->
    <script src="{{ asset('js/performance.js') }}"></script>

    <!-- Lazy Loader for components -->
    <script src="{{ asset('js/lazy-loader.js') }}"></script>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="distribution" content="Global">
    <meta name="rating" content="General">
    <meta name="language" content="pt-BR">
    <meta name="content-language" content="pt-BR">

    <!-- Preconnect to external resources -->
    <link rel="preconnect" href="https://www.googletagmanager.com" crossorigin>
    <link rel="dns-prefetch" href="https://www.googletagmanager.com">

    <!-- Prefetch important pages -->
    <link rel="prefetch" href="/app/register" as="document">
    <link rel="prefetch" href="/app/login" as="document">

    <meta name="google-site-verification" content="kHvaTl5DHIzqDIdHK0WctKwaxOcLvpCKu9FZWGD6Yg8" />

    <!-- Google Analytics - Lazy loaded for better performance -->
    <script>
        // Initialize dataLayer
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}

        // Lazy load analytics after user interaction or 3 seconds
        let analyticsLoaded = false;

        function loadAnalytics() {
            if (analyticsLoaded) return;
            analyticsLoaded = true;

            const script = document.createElement('script');
            script.async = true;
            script.src = 'https://www.googletagmanager.com/gtag/js?id=G-MN5442GH2J';
            document.head.appendChild(script);

            script.onload = function() {
                gtag('js', new Date());
                gtag('config', 'G-MN5442GH2J');
                gtag('config', 'AW-11559494036');
                gtag('event', 'conversion', {'send_to': 'AW-11559494036/-uoWCOCWoIQaEJTD_4cr'});
            };
        }

        // Load on first user interaction
        ['scroll', 'mousedown', 'touchstart', 'keydown'].forEach(event => {
            window.addEventListener(event, loadAnalytics, { once: true, passive: true });
        });

        // Fallback: load after 3 seconds if no interaction
        setTimeout(loadAnalytics, 3000);
    </script>

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-WXTHV674');</script>
    <!-- End Google Tag Manager -->

    {{ $head ?? '' }}
</head>
<body class="bg-slate-50 text-slate-900 font-sans pt-10">

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WXTHV674" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <header class="fixed inset-x-0 top-0 z-50 bg-white/90 backdrop-blur border-b border-slate-100 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <a href="/" class="flex items-center space-x-3 text-blue-900 font-semibold">
                    <img src="{{ asset('images/logo.png') }}" alt="WSoft Tecnologia | Sistema de Gestão para Pequenas Empresas" class="h-16 w-auto" fetchpriority="high">
                </a>
                <nav class="hidden md:flex items-center space-x-6 text-sm font-medium">
                    <a href="/#beneficios" class="hover:text-blue-600 transition">Benefícios</a>
                    <a href="/#porque" class="hover:text-blue-600 transition">Por que WSoft</a>
                    <a href="/#demo" class="hover:text-blue-600 transition">Demonstração</a>
                    <a href="/#funcionalidades" class="hover:text-blue-600 transition">Funcionalidades</a>
                    <a href="/app/login" class="bg-transparent text-blue-600 border px-4 py-2 rounded-lg hover:bg-blue-50 transition shadow-lg shadow-blue-600/10">Login</a>
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

                <img src="{{ asset('images/logo-white.png') }}" alt="WSoft Tecnologia" class="mt-6 h-10 w-auto" loading="lazy">
                <p class="mt-3 text-sm text-slate-400">Sistema de gestão para pequenas empresas que une organização empresarial e crescimento previsível.</p>

                <div class="mt-6 flex space-x-4">
                    <a href="https://www.instagram.com/wsoft.tecnologia?igsh=MWlzdmZlYXhzcmlzYQ%3D%3D&utm_source=qr" target="_blank" rel="noopener noreferrer" class="text-slate-400 hover:text-white transition" aria-label="Instagram">
                        <i class="fa-brands fa-instagram text-2xl"></i>
                    </a>
                </div>
            </div>
            <div>
                <h4 class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Produto</h4>
                <ul class="mt-4 space-y-2 text-sm text-slate-300">
                    <li><a href="/beneficios" class="hover:text-white">Benefícios</a></li>
                    <li><a href="/demonstracao" class="hover:text-white">Demonstração</a></li>
                    <li><a href="/#precos" class="hover:text-white">Preços</a></li>
                    <li><a href="/faq" class="hover:text-white">FAQ</a></li>
                    <li><a href="{{ route('blog.index') }}" class="hover:text-white">Blog</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Soluções</h4>
                <ul class="mt-4 space-y-2 text-sm text-slate-300">
                    <li><a href="{{ route('landing.crm-gestao') }}" class="hover:text-white font-semibold">CRM Completo</a></li>
                    <li><a href="{{ route('landing.software-sob-medida') }}" class="hover:text-white font-semibold">Software Sob Medida</a></li>

                    <li class="pt-3 pb-1">
                        <span class="text-xs uppercase tracking-wider text-slate-600">Financeiro</span>
                    </li>
                    <li><a href="{{ route('landing.contas-pagar') }}" class="hover:text-white">Contas a Pagar</a></li>
                    <li><a href="{{ route('landing.contas-receber') }}" class="hover:text-white">Contas a Receber</a></li>
                    <li><a href="{{ route('landing.movimentacao-financeira') }}" class="hover:text-white">Fluxo de Caixa</a></li>
                    <li><a href="{{ route('landing.controle-inadimplencia') }}" class="hover:text-white">Controle de Inadimplência</a></li>

                    <li class="pt-3 pb-1">
                        <span class="text-xs uppercase tracking-wider text-slate-600">Gestão</span>
                    </li>
                    <li><a href="{{ route('landing.gestao-clientes') }}" class="hover:text-white">Gestão de Clientes</a></li>
                    <li><a href="{{ route('landing.gestao-fornecedores') }}" class="hover:text-white">Gestão de Fornecedores</a></li>
                    <li><a href="{{ route('landing.gestao-estoque') }}" class="hover:text-white">Gestão de Estoque</a></li>
                    <li><a href="{{ route('landing.ordem-servico') }}" class="hover:text-white">Ordem de Serviço</a></li>

                </ul>
            </div>
            <div>
                <h4 class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Contato</h4>
                <ul class="mt-4 space-y-2 text-sm text-slate-300">

                    <li><a href="{{ route('landing.oficina') }}" class="hover:text-white">Oficina Mecânica</a></li>
                    <li><a href="{{ route('landing.mecanica') }}" class="hover:text-white">Mecânica</a></li>
                    <li><a href="{{ route('landing.funilaria') }}" class="hover:text-white">Funilaria</a></li>
                    <li><a href="{{ route('landing.barbearia') }}" class="hover:text-white">Barbearia</a></li>

                    <li class="pt-3 pb-1">
                        <span class="text-xs uppercase tracking-wider text-slate-600">Recursos</span>
                    </li>
                    <li><a href="{{ route('landing.assinatura-digital') }}" class="hover:text-white">Assinatura Digital</a></li>

                    <li class="pt-3 pb-1">
                        <span class="text-xs uppercase tracking-wider text-slate-600">Fale Conosco</span>
                    </li>

                    <li>contato@wsoft.com.br</li>
                    <li>Rolante/RS</li>
                </ul>
            </div>
        </div>
        <p class="mt-10 text-center text-xs text-slate-500">&copy; {{ now()->year }} WSoft Tecnologia. Todos os direitos reservados.</p>
        <p class="mt-2 text-center text-xs text-slate-500">CNPJ: 58.622.735/0001-37</p>
    </footer>

    <script>
        // Mobile menu toggle - Critical, inline
        const button = document.getElementById('menu-button');
        const mobileNav = document.getElementById('mobile-nav');
        if (button) {
            button.addEventListener('click', () => {
                mobileNav.classList.toggle('hidden');
            }, { passive: true });
        }

        // Lazy load Service Worker registration
        function registerServiceWorker() {
            if ('serviceWorker' in navigator) {
                navigator.serviceWorker.register('/sw.js')
                    .then(reg => console.log('SW registered:', reg.scope))
                    .catch(err => console.log('SW failed:', err));
            }
        }

        // Register SW after page load
        if (document.readyState === 'complete') {
            setTimeout(registerServiceWorker, 2000);
        } else {
            window.addEventListener('load', () => {
                setTimeout(registerServiceWorker, 2000);
            });
        }

        // Predictive prefetching for likely navigation
        document.addEventListener('DOMContentLoaded', () => {
            // Prefetch register page on hover over CTA buttons
            const ctaButtons = document.querySelectorAll('a[href*="register"]');
            ctaButtons.forEach(btn => {
                btn.addEventListener('mouseenter', () => {
                    if (window.ResourceHints) {
                        window.ResourceHints.prefetch('/app/register');
                    }
                }, { once: true, passive: true });
            });

            // Load analytics component when user scrolls
            let analyticsComponentLoaded = false;
            window.addEventListener('scroll', () => {
                if (!analyticsComponentLoaded && window.scrollY > 100) {
                    analyticsComponentLoaded = true;
                    if (window.loadComponent) {
                        window.loadComponent('analytics').catch(() => {});
                    }
                }
            }, { once: true, passive: true });
        });
    </script>

    {{ $scripts ?? '' }}
</body>
</html>
