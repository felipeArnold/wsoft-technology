<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Conheça todos os benefícios do WSoft Tecnologia - Sistema de gestão para pequenas empresas com controle financeiro, ordens de serviço e muito mais.">
    <title>Benefícios | WSoft Tecnologia - Sistema de Gestão Empresarial</title>
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
            <p class="text-sm uppercase tracking-[0.2em] text-blue-200 mb-4">Benefícios do WSoft</p>
            <h1 class="text-4xl md:text-5xl font-extrabold leading-tight">
                Tudo que seu negócio precisa para crescer
            </h1>
            <p class="mt-6 text-lg text-blue-100 max-w-3xl mx-auto">
                Descubra como o WSoft pode transformar a gestão da sua empresa com ferramentas práticas e resultados reais.
            </p>
        </div>
    </section>

    <!-- Benefícios Detalhados -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid gap-12 md:grid-cols-2">
                <article class="flex gap-6">
                    <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                        <i class="fa-solid fa-chart-line text-blue-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold">Gestão Financeira Completa</h3>
                        <p class="mt-3 text-slate-600">Centralize entradas, saídas, projeções e limites em um único painel. Acompanhe o fluxo de caixa em tempo real e tome decisões baseadas em dados concretos.</p>
                    </div>
                </article>
                <article class="flex gap-6">
                    <div class="flex-shrink-0 w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                        <i class="fa-solid fa-users text-green-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold">Cadastro de Clientes e Fornecedores</h3>
                        <p class="mt-3 text-slate-600">Mantenha todos os dados organizados com tags, anotações e histórico completo. Nunca mais perca informações importantes sobre seus contatos.</p>
                    </div>
                </article>
                <article class="flex gap-6">
                    <div class="flex-shrink-0 w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                        <i class="fa-solid fa-file-invoice text-purple-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold">Contas a Pagar e Receber</h3>
                        <p class="mt-3 text-slate-600">Automatize cobranças e acompanhe prazos com alertas inteligentes. Mantenha o caixa previsível e evite surpresas desagradáveis.</p>
                    </div>
                </article>
                <article class="flex gap-6">
                    <div class="flex-shrink-0 w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                        <i class="fa-solid fa-clipboard-list text-orange-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold">Sistema de Ordem de Serviço</h3>
                        <p class="mt-3 text-slate-600">Crie, aprove e monitore cada OS com fotos, checklist e notificações. Workflow completo do orçamento ao faturamento.</p>
                    </div>
                </article>
                <article class="flex gap-6">
                    <div class="flex-shrink-0 w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                        <i class="fa-solid fa-triangle-exclamation text-red-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold">Redução de Inadimplência</h3>
                        <p class="mt-3 text-slate-600">Configure régua automática com lembretes por e-mail e WhatsApp. Segmente devedores e acompanhe negociações diretamente do painel.</p>
                    </div>
                </article>
                <article class="flex gap-6">
                    <div class="flex-shrink-0 w-12 h-12 bg-teal-100 rounded-xl flex items-center justify-center">
                        <i class="fa-solid fa-box text-teal-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold">Controle de Produtos</h3>
                        <p class="mt-3 text-slate-600">Gerencie estoque com lote, alertas de mínimo e preços atualizados. Integração completa com ordens de serviço.</p>
                    </div>
                </article>
                <article class="flex gap-6">
                    <div class="flex-shrink-0 w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center">
                        <i class="fa-solid fa-gauge-high text-indigo-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold">Dashboard Inteligente</h3>
                        <p class="mt-3 text-slate-600">Indicadores visuais sobre faturamento, inadimplência e performance comercial. Visualize o que importa em um único lugar.</p>
                    </div>
                </article>
                <article class="flex gap-6">
                    <div class="flex-shrink-0 w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center">
                        <i class="fa-solid fa-headset text-yellow-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold">Suporte Humanizado</h3>
                        <p class="mt-3 text-slate-600">Equipe especializada em pequenos negócios pronta para ajudar. Implantação em dias, não em meses.</p>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-20 bg-gradient-to-br from-emerald-500 to-blue-600 text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold">Pronto para transformar seu negócio?</h2>
            <p class="mt-4 text-lg text-white/90">Comece hoje mesmo com 7 dias de teste grátis e veja a diferença na prática.</p>
            <div class="mt-8">
                <a href="/app/register" class="inline-flex justify-center items-center rounded-lg bg-white text-blue-700 font-semibold px-10 py-4 shadow-lg hover:-translate-y-0.5 transition">
                    Testar por 7 Dias
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
