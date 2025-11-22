<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta name="robots" content="index,follow" />

    <title>Sistema de Gestão Online | WSoft Tecnologia - Financeiro, OS, Vendas e Assinatura Digital</title>
    <meta name="description" content="WSoft - Sistema de gestão online para pequenas e médias empresas. Controle financeiro, contas a pagar e receber, ordem de serviço, estoque, vendas e assinatura digital. Teste grátis por 7 dias." />
    <link rel="canonical" href="https://www.wsoft.dev.br/" />

    <!-- Open Graph -->
    <meta property="og:site_name" content="WSoft Tecnologia" />
    <meta property="og:title" content="Sistema de Gestão Online | WSoft Tecnologia" />
    <meta property="og:description" content="Controle financeiro, ordem de serviço, vendas, estoque e assinatura digital em um único sistema. Teste grátis por 7 dias." />
    <meta property="og:type" content="website" />


    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="WSoft - Sistema de Gestão Online" />
    <meta name="twitter:description" content="Sistema de gestão com financeiro, OS, vendas e assinatura digital. Ideal para mecânicas e pequenas empresas." />

    <!-- Structured Data (SoftwareApplication) -->
    <script type="application/ld+json">
        {
          "@type": "SoftwareApplication",
          "name": "WSoft Tecnologia",
          "url": "https://www.wsoft.dev.br/",
          "description": "Sistema de gestão online com financeiro, contas a pagar e receber, ordem de serviço, controle de estoque e assinatura digital.",
          "operatingSystem": "Web",
          "applicationCategory": "BusinessApplication",
         "offers": {
          "@type": "Offer",
          "price": "0.00",
          "priceCurrency": "BRL",
          "url": "https://www.wsoft.dev.br/app/register",
          "description": "Teste grátis por 7 dias"
        }
      }
    </script>

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
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-MN5442GH2J');
    </script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'AW-11559494036');
    </script>
</head>
<body class="bg-slate-50 text-slate-900 font-sans">
    <header class="fixed inset-x-0 top-0 z-50 bg-white/90 backdrop-blur border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <a href="#hero" class="flex items-center space-x-3 text-blue-900 font-semibold">
                    <img src="{{ asset('images/logo.png') }}" alt="WSoft Tecnologia | Sistema de Gestão para Pequenas Empresas" class="h-16 w-auto">
                </a>
                <nav class="hidden md:flex items-center space-x-6 text-sm font-medium">
                    <a href="#beneficios" class="hover:text-blue-600 transition">Benefícios</a>
                    <a href="#porque" class="hover:text-blue-600 transition">Por que WSoft</a>
                    <a href="#demo" class="hover:text-blue-600 transition">Demonstração</a>
                    <a href="#funcionalidades" class="hover:text-blue-600 transition">Funcionalidades</a>
                    <a href="#precos" class="hover:text-blue-600 transition">Preços</a>
                    <a href="#faq" class="hover:text-blue-600 transition">FAQ</a>
                    <a href="/app/login" class="hover:text-blue-600 transition border rounded-2xl">Login</a>
                    <a href="/app/register" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Cadastrar</a>
                </nav>
                <button id="menu-button" class="md:hidden text-2xl text-slate-700" aria-label="Abrir menu">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
            <div id="mobile-nav" class="md:hidden hidden pb-4">
                <nav class="flex flex-col space-y-2 text-sm font-semibold text-slate-700">
                    <a href="#beneficios" class="py-2 border-b border-slate-100">Benefícios</a>
                    <a href="#porque" class="py-2 border-b border-slate-100">Por que WSoft</a>
                    <a href="#demo" class="py-2 border-b border-slate-100">Demonstração</a>
                    <a href="#funcionalidades" class="py-2 border-b border-slate-100">Funcionalidades</a>
                    <a href="#precos" class="py-2 border-b border-slate-100">Preços</a>
                    <a href="#faq" class="py-2 border-b border-slate-100">FAQ</a>
                    <a href="/app/login" class="py-2 border-b border-slate-100">Login</a>
                    <a href="/app/register" class="py-2 text-blue-600">Cadastrar</a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Hero -->
    <section id="hero" class="pt-32 pb-20 bg-gradient-to-b from-blue-950 to-blue-700 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-12 items-center">
            <div>
                <p class="text-sm uppercase tracking-[0.2em] text-blue-200 mb-4">Software de gestão empresarial completo</p>
                <h1 class="text-4xl md:text-5xl font-extrabold leading-tight">
                    Sistema de Gestão Online Completo para Empresas — Financeiro, Vendas, Ordem de Serviço e Assinatura Digital
                </h1>
                <p class="mt-6 text-lg text-blue-100">
                    Centralize clientes, fornecedores, contas a pagar e receber, estoque, ordens de serviço e assinatura digital em uma plataforma única. Reduza inadimplência, automatize cobranças e ganhe tempo operacional.
                </p>
                <div class="mt-8 flex flex-col sm:flex-row gap-4">
                    <a href="/app/register" class="inline-flex justify-center items-center rounded-lg bg-white text-blue-700 font-semibold px-8 py-4 shadow-sm hover:shadow-lg transition">
                        Testar grátis por 7 dias
                    </a>
                    <a href="#demo" class="inline-flex justify-center items-center rounded-lg border border-white/60 text-white font-semibold px-8 py-4 hover:bg-white/10 transition">
                        Acessar demonstração
                    </a>
                </div>
                <div class="mt-8 flex flex-wrap gap-4 text-sm text-blue-200">
                    <span class="inline-flex items-center gap-2"><i class="fa-solid fa-circle-check text-green-200"></i> Controle de clientes e fornecedores</span>
                    <span class="inline-flex items-center gap-2"><i class="fa-solid fa-circle-check text-green-200"></i> Contas a pagar e receber</span>
                    <span class="inline-flex items-center gap-2"><i class="fa-solid fa-circle-check text-green-200"></i> Movimentação de fluxo de caixa</span>
                    <span class="inline-flex items-center gap-2"><i class="fa-solid fa-circle-check text-green-200"></i> Sistema de ordem de serviço (OS)</span>
                </div>
            </div>
            <div class="bg-white/10 border border-white/20 rounded-3xl p-8 backdrop-blur shadow-2xl">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm uppercase text-blue-200">Dash Financeiro</p>
                        <h3 class="text-2xl font-bold mt-1">R$ 124.890</h3>
                        <p class="text-xs text-blue-100">Receitas 30 dias</p>
                    </div>
                    <span class="text-xs px-3 py-1 rounded-full bg-white/20">Sistema para microempresa</span>
                </div>
                <div class="mt-8 space-y-4 text-sm">
                    <div class="flex justify-between border-b border-white/10 pb-4">
                        <span>Fluxo de caixa</span>
                        <span class="font-semibold">+21%</span>
                    </div>
                    <div class="flex justify-between border-b border-white/10 pb-4">
                        <span>Ordens de serviço abertas</span>
                        <span class="font-semibold">42</span>
                    </div>
                    <div class="flex justify-between border-b border-white/10 pb-4">
                        <span>Controle de inadimplência</span>
                        <span class="font-semibold text-rose-100">-35%</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Cadastro de clientes e fornecedores atualizados</span>
                        <span class="font-semibold">2.347</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefícios principais -->
    <section id="beneficios" class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto">
                <p class="text-sm font-semibold text-blue-600 uppercase tracking-[0.3em]">Benefícios principais</p>
                <h2 class="mt-4 text-3xl md:text-4xl font-bold">Controle total com linguagem simples e persuasiva</h2>
                <p class="mt-4 text-slate-600">Tudo o que sua empresa precisa para organizar processos, reduzir custos e aumentar receita.</p>
            </div>
            <div class="grid gap-12 md:grid-cols-2 mt-4">
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
                        <h3 class="text-xl font-semibold">Controle de Produtos, Estoque e Vendas</h3>
                        <p class="mt-3 text-slate-600">Gerencie estoque com lote, alertas de mínimo e preços atualizados, além de integrar vendas diretamente com ordens de serviço.</p>
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
                    <div class="flex-shrink-0 w-12 h-12 bg-pink-100 rounded-xl flex items-center justify-center">
                        <i class="fa-solid fa-signature text-pink-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold">Assinatura Digital Integrada</h3>
                        <p class="mt-3 text-slate-600">Envie contratos e documentos para assinatura digital diretamente pelo sistema, garantindo segurança jurídica e agilidade nos processos.</p>
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

    <section id="beneficios" class="mt-8 bg-gradient-to-b from-slate-50  bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900">Benefícios que geram resultado</h2>
                <p class="mt-4 text-lg text-slate-600 max-w-2xl mx-auto">Transforme a gestão do seu negócio com ferramentas que realmente fazem a diferença</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="group p-8 bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 border border-slate-100 hover:border-blue-200">
                    <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center mb-6 group-hover:bg-blue-600 transition-colors duration-300">
                        <svg class="w-7 h-7 text-blue-600 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Reduza inadimplência</h3>
                    <p class="text-slate-600 leading-relaxed">Automatize cobranças por WhatsApp e e-mail e transforme sua recuperação de recebíveis.</p>
                </div>
                <div class="group p-8 bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 border border-slate-100 hover:border-blue-200">
                    <div class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center mb-6 group-hover:bg-green-600 transition-colors duration-300">
                        <svg class="w-7 h-7 text-green-600 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Acelere o fluxo de trabalho</h3>
                    <p class="text-slate-600 leading-relaxed">Menos retrabalho com processos centralizados e integrados — aumente a produtividade da equipe.</p>
                </div>
                <div class="group p-8 bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 border border-slate-100 hover:border-blue-200">
                    <div class="w-14 h-14 bg-purple-100 rounded-xl flex items-center justify-center mb-6 group-hover:bg-purple-600 transition-colors duration-300">
                        <svg class="w-7 h-7 text-purple-600 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Decisões baseadas em dados</h3>
                    <p class="text-slate-600 leading-relaxed">Relatórios e dashboards para tomada de decisão rápida e segura.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Por que WSoft -->
    <section id="porque" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-12 items-center">
            <div>
                <p class="text-sm font-semibold text-blue-600 uppercase tracking-[0.3em]">Por que o WSoft Tecnologia?</p>
                <h2 class="mt-4 text-3xl font-bold">Um ERP simples, rápido e pensado para o dia a dia</h2>
                <p class="mt-4 text-slate-600">
                    O WSoft nasceu para ser um ERP simples, intuitivo e pronto para acelerar oficinas, mecânicas, lojas de serviços e qualquer sistema para microempresa que precise profissionalizar a operação.
                </p>
                <p class="mt-4 text-slate-600">
                    Com processos guiados e dashboards objetivos, você garante organização empresarial, previsibilidade e mais tempo para vender.
                </p>
                <ul class="mt-6 space-y-3 text-slate-800">
                    <li class="flex items-start gap-3"><i class="fa-solid fa-circle-check text-green-500 mt-1"></i> Implantação em dias, não em meses.</li>
                    <li class="flex items-start gap-3"><i class="fa-solid fa-circle-check text-green-500 mt-1"></i> Suporte humano especializado em pequenos negócios.</li>
                    <li class="flex items-start gap-3"><i class="fa-solid fa-circle-check text-green-500 mt-1"></i> Treinamentos rápidos para equipes administrativas e técnicas.</li>
                </ul>
            </div>
            <div class="rounded-3xl bg-gradient-to-br from-blue-100 via-white to-emerald-100 p-8 shadow-xl border border-slate-100">
                <div class="grid grid-cols-2 gap-6 text-center">
                    <div>
                        <p class="text-4xl font-bold text-blue-700">97%</p>
                        <p class="text-xs uppercase tracking-widest text-slate-500 mt-2">Clientes recomendam</p>
                    </div>
                    <div>
                        <p class="text-4xl font-bold text-blue-700">3x</p>
                        <p class="text-xs uppercase tracking-widest text-slate-500 mt-2">Mais produtividade</p>
                    </div>
                    <div>
                        <p class="text-4xl font-bold text-blue-700">15 min</p>
                        <p class="text-xs uppercase tracking-widest text-slate-500 mt-2">OS emitida</p>
                    </div>
                    <div>
                        <p class="text-4xl font-bold text-blue-700">R$ 0</p>
                        <p class="text-xs uppercase tracking-widest text-slate-500 mt-2">Custos ocultos</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Demonstração -->
    <section id="demo" class="py-20 bg-slate-900 text-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-sm uppercase tracking-[0.3em] text-blue-300">Demonstração ao vivo</p>
            <h2 class="mt-4 text-3xl font-bold">Veja o sistema em ação antes de decidir</h2>
            <p class="mt-4 text-blue-100 max-w-3xl mx-auto">
                Mostre para seu time como o software de gestão empresarial simplifica OS, financeiro e relacionamento com clientes em poucos cliques.
            </p>
            <div class="mt-10 rounded-3xl border border-white/20 bg-gradient-to-r from-blue-800 to-blue-600 p-10 shadow-2xl">
                <div class="aspect-video rounded-2xl border border-white/30 bg-white/5 flex items-center justify-center text-blue-100 text-lg">
                    Espaço reservado para print, mockup ou vídeo do sistema.
                </div>
            </div>
        </div>
    </section>

    <!-- Funcionalidades detalhadas -->
    <section id="funcionalidades" class="py-20 bg-gradient-to-b from-white to-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <p class="text-sm font-semibold text-blue-600 uppercase tracking-[0.3em]">Funcionalidades detalhadas</p>
                <h2 class="mt-4 text-3xl md:text-4xl font-bold text-slate-900">Tudo o que você precisa para crescer</h2>
                <p class="mt-4 text-lg text-slate-600">Ferramentas completas e integradas para otimizar cada área do seu negócio</p>
            </div>
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
                <article class="group rounded-2xl border border-slate-100 bg-white p-6 shadow-sm hover:shadow-lg hover:border-blue-200 transition-all duration-300">
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-blue-600 transition-colors duration-300">
                        <svg class="w-6 h-6 text-blue-600 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Gestão de Clientes</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">Sistema de <b>gestão de clientes</b> ideal para empresas que precisam aumentar produtividade e reduzir erros no atendimento.</p>
                </article>
                <article class="group rounded-2xl border border-slate-100 bg-white p-6 shadow-sm hover:shadow-lg hover:border-green-200 transition-all duration-300">
                    <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-green-600 transition-colors duration-300">
                        <svg class="w-6 h-6 text-green-600 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Gestão de Fornecedores</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">Organize contratos, contatos e documentos com um cadastro de fornecedores seguro e integrado ao financeiro.</p>
                </article>
                <article class="group rounded-2xl border border-slate-100 bg-white p-6 shadow-sm hover:shadow-lg hover:border-red-200 transition-all duration-300">
                    <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-red-600 transition-colors duration-300">
                        <svg class="w-6 h-6 text-red-600 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Controle de inadimplência</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">Reduza perdas financeiras com ferramentas avançadas para <b>controle de inadimplência</b>.</p>
                </article>
                <article class="group rounded-2xl border border-slate-100 bg-white p-6 shadow-sm hover:shadow-lg hover:border-purple-200 transition-all duration-300">
                    <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-purple-600 transition-colors duration-300">
                        <svg class="w-6 h-6 text-purple-600 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Contas a Pagar e Receber</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">Ganhe visibilidade total do seu <b>fluxo de caixa</b> com um sistema completo de <b>contas a pagar</b>.</p>
                </article>
                <article class="group rounded-2xl border border-slate-100 bg-white p-6 shadow-sm hover:shadow-lg hover:border-amber-200 transition-all duration-300">
                    <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-amber-600 transition-colors duration-300">
                        <svg class="w-6 h-6 text-amber-600 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Controle de estoque e Vendas</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">Gerencie seu estoque com precisão usando um controle de produtos integrado às vendas.</p>
                </article>
                <article class="group rounded-2xl border border-slate-100 bg-white p-6 shadow-sm hover:shadow-lg hover:border-cyan-200 transition-all duration-300">
                    <div class="w-12 h-12 bg-cyan-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-cyan-600 transition-colors duration-300">
                        <svg class="w-6 h-6 text-cyan-600 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Movimentação Financeira</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">Acompanhe toda a movimentação financeira da empresa em painéis simples e intuitivos.</p>
                </article>
                <article class="group rounded-2xl border border-slate-100 bg-white p-6 shadow-sm hover:shadow-lg hover:border-indigo-200 transition-all duration-300">
                    <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-indigo-600 transition-colors duration-300">
                        <svg class="w-6 h-6 text-indigo-600 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Sistema de ordem de serviço</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">Automatize processos e elimine papeladas com um sistema de ordem de serviço online.</p>
                </article>
                <article class="group rounded-2xl border border-slate-100 bg-white p-6 shadow-sm hover:shadow-lg hover:border-emerald-200 transition-all duration-300">
                    <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-emerald-600 transition-colors duration-300">
                        <svg class="w-6 h-6 text-emerald-600 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Assinatura digital</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">Assine contratos e documentos com segurança utilizando assinatura digital integrada ao sistema.</p>
                </article>
            </div>
        </div>
    </section>

    <!-- Prova social -->
    <section class="py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto">
                <p class="text-sm font-semibold text-blue-600 uppercase tracking-[0.3em]">Prova social</p>
                <h2 class="mt-4 text-3xl font-bold">O que nossos clientes dizem</h2>
                <p class="mt-4 text-slate-600">Depoimentos reais de quem já transformou a gestão do negócio com o WSoft.</p>
            </div>
            <div class="mt-12 grid gap-6 md:grid-cols-3">
                <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                    <p class="text-sm text-slate-600 italic">“A WSoft transformou nossa rotina. Agora controlamos estoque, financeiro e as OS com muito mais eficiência.”</p>
                    <div class="mt-4 font-semibold">Mêcanica Fischer</div>
                    <div class="text-sm text-slate-500">Rolante/RS</div>
                </article>
                <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                    <p class="text-sm text-slate-600 italic">“Redução de inadimplência significativa desde que começamos a usar o sistema.”</p>
                    <div class="mt-4 font-semibold">Oficina AutoPlus</div>
                    <div class="text-sm text-slate-500">São Paulo/SP</div>
                </article>
                <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                    <p class="text-sm text-slate-600 italic">“Assinaturas digitais fáceis e com validade jurídica — muito prático.”</p>
                    <div class="mt-4 font-semibold">Consulta Fipe</div>
                    <div class="text-sm text-slate-500">Porto Alegre/RS</div>
                </article>
            </div>
        </div>
    </section>

    <!-- Oferta -->
    <section id="oferta" class="py-20 bg-gradient-to-br from-emerald-500 to-blue-600 text-white">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-sm uppercase tracking-[0.3em] text-white/80">Oferta exclusiva</p>
            <h2 class="mt-4 text-3xl font-bold">Sistema sem mensalidade com teste gratuito</h2>
            <p class="mt-4 text-lg text-white/90">
                Assuma o controle do seu negócio com um modelo híbrido: comece com 7 dias de teste, migre para o plano completo e mantenha o WSoft como seu sistema sem mensalidade fixa por licença vitalícia.
            </p>
            <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="/app/register" class="inline-flex justify-center items-center rounded-lg bg-white text-blue-700 font-semibold px-10 py-4 shadow-lg hover:-translate-y-0.5 transition">
                    Testar grátis por 7 dias
                </a>
                <a href="#contato" class="inline-flex justify-center items-center rounded-lg border border-white/60 text-white font-semibold px-10 py-4 hover:bg-white/10 transition">
                    Quero organizar minha empresa
                </a>
            </div>
            <p class="mt-6 text-sm text-white/80">Sem taxa de implantação, suporte humano ilimitado.</p>
        </div>
    </section>

    <!-- Preços -->
    <section id="precos" class="py-20 bg-slate-50">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto">
                <p class="text-sm font-semibold text-blue-600 uppercase tracking-[0.3em]">Planos e Preços</p>
                <h2 class="mt-4 text-3xl md:text-4xl font-bold">Investimento acessível para seu negócio crescer</h2>
                <p class="mt-4 text-slate-600">Todas as funcionalidades que você precisa por um preço que cabe no bolso.</p>
            </div>
            <div class="mt-12 max-w-lg mx-auto">
                <div class="rounded-3xl bg-white border-2 border-blue-600 shadow-xl overflow-hidden">
                    <div class="bg-blue-600 text-white text-center py-4">
                        <span class="text-sm font-semibold uppercase tracking-wider">Plano Completo</span>
                    </div>
                    <div class="p-8">
                        <div class="text-center">
                            <span class="text-sm text-slate-500">A partir de</span>
                            <div class="mt-2">
                                <span class="text-5xl font-bold text-slate-900">R$ 29</span>
                                <span class="text-2xl font-bold text-slate-900">,90</span>
                                <span class="text-slate-500">/mês</span>
                            </div>
                        </div>
                        <ul class="mt-8 space-y-4">
                            <li class="flex items-start gap-3">
                                <i class="fa-solid fa-circle-check text-green-500 mt-1"></i>
                                <span class="text-slate-700">Cadastro ilimitado de clientes e fornecedores</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="fa-solid fa-circle-check text-green-500 mt-1"></i>
                                <span class="text-slate-700">Controle completo de produtos e estoque</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="fa-solid fa-circle-check text-green-500 mt-1"></i>
                                <span class="text-slate-700">Contas a pagar e receber automatizadas</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="fa-solid fa-circle-check text-green-500 mt-1"></i>
                                <span class="text-slate-700">Sistema de ordem de serviço (OS) completo</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="fa-solid fa-circle-check text-green-500 mt-1"></i>
                                <span class="text-slate-700">Fluxo de caixa e controle financeiro</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="fa-solid fa-circle-check text-green-500 mt-1"></i>
                                <span class="text-slate-700">Dashboard com indicadores em tempo real</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="fa-solid fa-circle-check text-green-500 mt-1"></i>
                                <span class="text-slate-700">Controle de inadimplência e cobranças</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="fa-solid fa-circle-check text-green-500 mt-1"></i>
                                <span class="text-slate-700">Suporte humano ilimitado</span>
                            </li>
                        </ul>
                        <div class="mt-8">
                            <a href="/app/register" class="block w-full text-center rounded-lg bg-blue-600 text-white font-semibold px-8 py-4 hover:bg-blue-700 transition">
                                Começar teste grátis de 7 dias
                            </a>
                        </div>
                        <p class="mt-4 text-center text-sm text-slate-500">Sem compromisso. Cancele quando quiser.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section id="faq" class="py-20 bg-white">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto">
                <p class="text-sm font-semibold text-blue-600 uppercase tracking-[0.3em]">FAQ</p>
                <h2 class="mt-4 text-3xl font-bold">Perguntas frequentes sobre gestão, financeiro e fluxo de caixa</h2>
            </div>
            <div class="mt-12 space-y-4">
                <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                    <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                        Como o WSoft ajuda no controle financeiro diário?
                        <span class="text-sm text-slate-500 group-open:hidden">+</span>
                        <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                    </summary>
                    <p class="mt-3 text-slate-600">O painel unifica entradas, saídas, projeções e limites para que você acompanhe o sistema de fluxo de caixa em tempo real.</p>
                </details>
                <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                    <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                        Posso controlar ordens de serviço e estoque?
                        <span class="text-sm text-slate-500 group-open:hidden">+</span>
                        <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                    </summary>
                    <p class="mt-3 text-slate-600">Sim, o sistema de ordem de serviço integra peças, mão de obra e controle de produtos para evitar erros e retrabalhos.</p>
                </details>
                <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                    <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                        Há recursos de contas a pagar e receber automáticos?
                        <span class="text-sm text-slate-500 group-open:hidden">+</span>
                        <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                    </summary>
                    <p class="mt-3 text-slate-600">Alertas, conciliações e integrações bancárias reduzem esquecimentos e mantêm o financeiro organizado.</p>
                </details>
                <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                    <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                        O que muda para quem precisa de controle de inadimplência?
                        <span class="text-sm text-slate-500 group-open:hidden">+</span>
                        <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                    </summary>
                    <p class="mt-3 text-slate-600">Você segmenta devedores, dispara lembretes e acompanha negociações diretamente do painel.</p>
                </details>
                <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                    <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                        Preciso de equipe grande para usar o sistema?
                        <span class="text-sm text-slate-500 group-open:hidden">+</span>
                        <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                    </summary>
                    <p class="mt-3 text-slate-600">Não. O layout foi desenhado para pequenas empresas que querem profissionalizar processos sem burocracia.</p>
                </details>
            </div>
        </div>
    </section>

    <!-- Footer -->
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
                    <li><a href="#precos" class="hover:text-white">Preços</a></li>
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
                <h4 class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Contato</h4>
                <ul class="mt-4 space-y-2 text-sm text-slate-300">
                    <li>contato@wsoft.com.br</li>
                    <li>Rolante/RS</li>
                </ul>
            </div>
{{--            <div>--}}
{{--                <h4 class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Redes</h4>--}}
{{--                <div class="mt-4 flex gap-3 text-lg">--}}
{{--                    <a href="#" class="hover:text-white"><i class="fa-brands fa-instagram"></i></a>--}}
{{--                    <a href="#" class="hover:text-white"><i class="fa-brands fa-linkedin"></i></a>--}}
{{--                    <a href="#" class="hover:text-white"><i class="fa-brands fa-facebook"></i></a>--}}
{{--                </div>--}}
{{--            </div>--}}
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

