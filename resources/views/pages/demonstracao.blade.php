<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Veja o WSoft Tecnologia em ação - Demonstração do sistema de gestão para pequenas empresas com controle financeiro e ordens de serviço.">
    <title>Demonstração | WSoft Tecnologia - Sistema de Gestão Empresarial</title>
    <script src="{{ asset('js/tailwind.js') }}"></script>
    <link rel="icon" type="image/png" href="{{ asset('images/icon.webp') }}">
    <link rel="stylesheet" href="{{ asset('css/site/index.css') }}">
    <meta name="google-site-verification" content="kHvaTl5DHIzqDIdHK0WctKwaxOcLvpCKu9FZWGD6Yg8" />

    <script async src="https://www.googletagmanager.com/gtag/js?id=G-MN5442GH2J"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-MN5442GH2J');
    </script>
</head>
<body class="bg-slate-50 text-slate-900 font-sans">
    <header class="fixed inset-x-0 top-0 z-50 bg-white/90 backdrop-blur border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <a href="/" class="flex items-center space-x-3 text-blue-900 font-semibold">
                    <img src="{{ asset('images/logo-azul.webp') }}" alt="WSoft Tecnologia" class="h-16 w-auto">
                </a>
                <nav class="hidden md:flex items-center space-x-6 text-sm font-medium">
                    <a href="/#beneficios" class="hover:text-blue-600 transition">Benefícios</a>
                    <a href="/#funcionalidades" class="hover:text-blue-600 transition">Funcionalidades</a>
                    <a href="/#precos" class="hover:text-blue-600 transition">Preços</a>
                    <a href="/app/login" class="hover:text-blue-600 transition">Login</a>
                    <a href="/app/register" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Cadastrar</a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Hero -->
    <section class="pt-32 pb-20 bg-gradient-to-b from-blue-950 to-blue-700 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-sm uppercase tracking-[0.2em] text-blue-200 mb-4">Demonstração ao vivo</p>
            <h1 class="text-4xl md:text-5xl font-extrabold leading-tight">
                Veja o sistema em ação antes de decidir
            </h1>
            <p class="mt-6 text-lg text-blue-100 max-w-3xl mx-auto">
                Mostre para seu time como o software de gestão empresarial simplifica OS, financeiro e relacionamento com clientes em poucos cliques.
            </p>
        </div>
    </section>

    <!-- Área de Demonstração -->
    <section class="py-20">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="rounded-3xl border border-slate-200 bg-white shadow-xl overflow-hidden">
                <div class="aspect-video bg-gradient-to-r from-blue-800 to-blue-600 flex items-center justify-center">
                    <div class="text-center text-white p-8">
                        <i class="fa-solid fa-play-circle text-6xl mb-4 opacity-80"></i>
                        <p class="text-xl font-semibold">Vídeo demonstrativo em breve</p>
                        <p class="mt-2 text-blue-200">Enquanto isso, teste o sistema gratuitamente por 7 dias</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Funcionalidades em Destaque -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-12">
                <h2 class="text-3xl font-bold">O que você vai encontrar no sistema</h2>
                <p class="mt-4 text-slate-600">Principais módulos que facilitam a gestão do seu negócio.</p>
            </div>
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                <div class="p-6 rounded-2xl border border-slate-100 bg-slate-50">
                    <h3 class="font-semibold text-lg">Dashboard Principal</h3>
                    <p class="mt-2 text-slate-600 text-sm">Visão geral do faturamento, inadimplência e indicadores em tempo real.</p>
                </div>
                <div class="p-6 rounded-2xl border border-slate-100 bg-slate-50">
                    <h3 class="font-semibold text-lg">Gestão de Clientes</h3>
                    <p class="mt-2 text-slate-600 text-sm">Cadastro completo com histórico, anotações e documentos anexados.</p>
                </div>
                <div class="p-6 rounded-2xl border border-slate-100 bg-slate-50">
                    <h3 class="font-semibold text-lg">Ordens de Serviço</h3>
                    <p class="mt-2 text-slate-600 text-sm">Criação, acompanhamento e faturamento de OS em um único fluxo.</p>
                </div>
                <div class="p-6 rounded-2xl border border-slate-100 bg-slate-50">
                    <h3 class="font-semibold text-lg">Controle Financeiro</h3>
                    <p class="mt-2 text-slate-600 text-sm">Contas a pagar e receber com alertas e conciliação bancária.</p>
                </div>
                <div class="p-6 rounded-2xl border border-slate-100 bg-slate-50">
                    <h3 class="font-semibold text-lg">Fluxo de Caixa</h3>
                    <p class="mt-2 text-slate-600 text-sm">Projeções, simulações e controle de entradas e saídas.</p>
                </div>
                <div class="p-6 rounded-2xl border border-slate-100 bg-slate-50">
                    <h3 class="font-semibold text-lg">Relatórios</h3>
                    <p class="mt-2 text-slate-600 text-sm">Exportação de dados e análises detalhadas do seu negócio.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-20 bg-gradient-to-br from-emerald-500 to-blue-600 text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold">Experimente na prática</h2>
            <p class="mt-4 text-lg text-white/90">A melhor forma de conhecer o sistema é testando. Comece seu período de teste gratuito agora.</p>
            <div class="mt-8 flex flex-col sm:flex-row justify-center gap-4">
                <a href="/app/register" class="inline-flex justify-center items-center rounded-lg bg-white text-blue-700 font-semibold px-10 py-4 shadow-lg hover:-translate-y-0.5 transition">
                    Testar grátis por 7 dias
                </a>
                <a href="/#precos" class="inline-flex justify-center items-center rounded-lg border border-white/60 text-white font-semibold px-10 py-4 hover:bg-white/10 transition">
                    Ver preços
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-100 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h3 class="text-lg font-semibold">WSoft Tecnologia</h3>
                <p class="mt-3 text-sm text-slate-400">Sistema de gestão para pequenas empresas que une organização empresarial e crescimento previsível.</p>
                <p class="mt-6 text-xs text-slate-500">&copy; {{ now()->year }} WSoft Tecnologia. Todos os direitos reservados.</p>
            </div>
        </div>
    </footer>
</body>
</html>
