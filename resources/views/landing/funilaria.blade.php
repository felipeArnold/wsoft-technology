<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistema para funilaria com controle de OS, orçamentos, gestão financeira e cadastro de clientes. Software completo para funilarias e oficinas de pintura.">
    <meta property="og:title" content="WSoft Tecnologia | Sistema para Funilaria e Pintura">
    <meta property="og:description" content="Software para funilaria que organiza OS, controla orçamentos e aumenta seus lucros.">
    <title>WSoft Tecnologia | Sistema para Funilaria e Pintura Automotiva</title>
    <script src="{{ asset('js/tailwind.js') }}"></script>
    <link rel="icon" type="image/png" href="{{ asset('images/icon.webp') }}">
    <link rel="stylesheet" href="{{ asset('css/site/index.css') }}">
    <meta name="google-site-verification" content="kHvaTl5DHIzqDIdHK0WctKwaxOcLvpCKu9FZWGD6Yg8" />
    @livewireStyles

    <script async src="https://www.googletagmanager.com/gtag/js?id=G-MN5442GH2J"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-MN5442GH2J');
    </script>

    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-11559494036"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'AW-11559494036');
    </script>
    <script type="application/ld+json">
    {
      "@type": "AutoBodyShop",
      "name": "WSoft Tecnologia - Sistema para Funilaria",
      "image": "https://www.wsoft.dev.br/images/logo.png",
      "description": "Sistema de gestão completo para funilaria e pintura. Orçamentos com fotos, controle de OS e financeiro.",
      "url": "https://www.wsoft.dev.br/landing/funilaria",
      "priceRange": "$$",
      "address": {
        "@type": "PostalAddress",
        "addressCountry": "BR"
      },
      "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "4.9",
        "ratingCount": "85"
      }
    }
    </script>
</head>
<body class="bg-slate-50 text-slate-900 font-sans pt-10">
    <!-- Top Banner -->
    <div class="fixed inset-x-0 top-0 z-[60] bg-gradient-to-r from-red-600 to-red-500 text-white text-xs md:text-sm font-bold h-10 flex items-center justify-center px-4 shadow-md">
        <span class="animate-pulse mr-2">🔥 OFERTA RELÂMPAGO:</span>
        <span>Plano Vitalício de <span class="line-through opacity-70">R$ 47,90</span> por <span class="text-yellow-300 text-base">R$ 29,90</span> (Apenas para os próximos 100 clientes)</span>
        <a href="#precos" class="ml-4 bg-white text-red-600 px-3 py-0.5 rounded-full hover:bg-red-50 transition text-xs uppercase tracking-wider">Pegar Agora</a>
    </div>

    <!-- Hero -->
    <section id="hero" class="pt-32 pb-24 bg-gradient-to-b from-blue-950 via-blue-900 to-blue-800 text-white overflow-hidden relative">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 30px 30px;"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-16 items-center relative z-10">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-800/50 border border-blue-700 text-blue-200 text-xs font-semibold uppercase tracking-wider mb-6">
                    <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                    Sistema para Funilaria e Pintura
                </div>
                <h1 class="text-4xl md:text-6xl font-extrabold leading-tight tracking-tight">
                    Gestão de Funilaria <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-200 to-white">Profissional e Simples</span>
                </h1>
                <p class="mt-6 text-lg md:text-xl text-blue-100 leading-relaxed max-w-lg">
                    Gerencie orçamentos detalhados com fotos, ordens de serviço e financeiro em uma plataforma feita para quem quer crescer.
                </p>
                <div class="mt-10 flex flex-col sm:flex-row gap-4">
                    <a href="#precos" class="inline-flex justify-center items-center rounded-xl bg-green-500 text-white font-bold px-8 py-4 shadow-lg shadow-green-500/30 hover:bg-green-600 hover:-translate-y-1 transition transform duration-200">
                        Quero Aproveitar a Oferta
                        <i class="fa-solid fa-arrow-right ml-2"></i>
                    </a>
                    <a href="#demo" class="inline-flex justify-center items-center rounded-xl border border-white/30 text-white font-semibold px-8 py-4 hover:bg-white/10 transition backdrop-blur-sm">
                        <i class="fa-solid fa-play mr-2"></i>
                        Ver Demonstração
                    </a>
                </div>
                <div class="mt-10 pt-8 border-t border-white/10">
                    <p class="text-sm text-blue-200 mb-4">Ideal para:</p>
                    <div class="flex flex-wrap gap-3 text-sm font-medium text-white">
                        <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Funilarias</span>
                        <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Oficinas de Pintura</span>
                        <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Estética Automotiva</span>
                    </div>
                </div>
            </div>
            <div class="relative">
                <div class="absolute -inset-4 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-full blur-3xl opacity-20 animate-pulse"></div>
                <div class="bg-white/10 border border-white/20 rounded-3xl p-8 backdrop-blur-md shadow-2xl relative">
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <p class="text-sm uppercase text-blue-200 font-semibold tracking-wider">Faturamento Mensal</p>
                            <h3 class="text-3xl font-bold mt-1">R$ 84.500,00</h3>
                            <div class="flex items-center gap-2 mt-2">
                                <span class="text-xs font-bold text-green-400 bg-green-400/10 px-2 py-0.5 rounded">+18% vs mês anterior</span>
                            </div>
                        </div>
                        <div class="h-12 w-12 rounded-full bg-blue-500/20 flex items-center justify-center border border-blue-400/30">
                            <i class="fa-solid fa-spray-can text-blue-300 text-xl"></i>
                        </div>
                    </div>
                    <div class="space-y-6">
                        <div class="space-y-2">
                            <div class="flex justify-between text-sm">
                                <span class="text-blue-100">Meta de Serviços</span>
                                <span class="font-semibold">92%</span>
                            </div>
                            <div class="h-2 bg-blue-950/50 rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-blue-400 to-cyan-400 w-[92%] rounded-full"></div>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                                <p class="text-xs text-blue-200">Orçamentos</p>
                                <p class="text-lg font-bold mt-1">15 Aprovados</p>
                            </div>
                            <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                                <p class="text-xs text-blue-200">Em Andamento</p>
                                <p class="text-lg font-bold mt-1 text-yellow-300">8 Veículos</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefícios principais -->
    <section id="beneficios" class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto">
                <p class="text-sm font-semibold text-blue-600 uppercase tracking-[0.3em]">Benefícios para sua funilaria</p>
                <h2 class="mt-4 text-3xl md:text-4xl font-bold">Por que escolher nosso sistema para funilaria?</h2>
                <p class="mt-4 text-slate-600">Tudo que sua funilaria precisa para organizar processos, criar orçamentos profissionais e fidelizar clientes.</p>
            </div>
            <div class="mt-12 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                    <h3 class="text-xl font-semibold">Orçamentos com fotos</h3>
                    <p class="mt-3 text-slate-600">Crie orçamentos detalhados com fotos do veículo, descrição dos danos e valores discriminados por serviço.</p>
                </article>
                <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                    <h3 class="text-xl font-semibold">OS por etapas</h3>
                    <p class="mt-3 text-slate-600">Acompanhe cada fase do serviço: desmontagem, funilaria, preparação, pintura e montagem.</p>
                </article>
                <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                    <h3 class="text-xl font-semibold">Gestão de clientes</h3>
                    <p class="mt-3 text-slate-600">CRM completo para funilarias com histórico de serviços, veículos atendidos e comunicação integrada.</p>
                </article>
                <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                    <h3 class="text-xl font-semibold">Controle financeiro</h3>
                    <p class="mt-3 text-slate-600">Contas a pagar e receber, fluxo de caixa e relatórios financeiros para sua funilaria.</p>
                </article>
                <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                    <h3 class="text-xl font-semibold">Controle de materiais</h3>
                    <p class="mt-3 text-slate-600">Gerencie tintas, massas, lixas e outros materiais com controle de estoque e custos por OS.</p>
                </article>
                <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                    <h3 class="text-xl font-semibold">Fotos antes e depois</h3>
                    <p class="mt-3 text-slate-600">Documente cada serviço com fotos do estado inicial e final do veículo para transparência total.</p>
                </article>
                <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                    <h3 class="text-xl font-semibold">Relatórios gerenciais</h3>
                    <p class="mt-3 text-slate-600">Dashboard com indicadores de faturamento, tempo médio de serviço e performance da equipe.</p>
                </article>
            </div>
        </div>
    </section>

    <!-- Sales Focus (Pain vs Gain) -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-red-600 font-bold tracking-wider uppercase text-sm">Pare de perder dinheiro</span>
                <h2 class="mt-2 text-3xl md:text-4xl font-extrabold text-slate-900">Sua funilaria está perdendo serviços?</h2>
                <p class="mt-4 text-lg text-slate-600">A desorganização é a maior inimiga do lucro na funilaria. Veja a diferença:</p>
            </div>
            <div class="grid md:grid-cols-2 gap-8">
                <!-- Pain -->
                <div class="p-8 rounded-3xl bg-red-50 border border-red-100 relative overflow-hidden group hover:shadow-lg transition">
                    <div class="absolute top-0 right-0 bg-red-100 text-red-600 text-xs font-bold px-3 py-1 rounded-bl-xl">CENÁRIO ATUAL</div>
                    <h3 class="text-xl font-bold text-red-700 mb-6 flex items-center gap-2">
                        <i class="fa-solid fa-circle-xmark"></i> Sem WSoft
                    </h3>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3 text-slate-700">
                            <i class="fa-solid fa-xmark text-red-500 mt-1"></i>
                            <span>Orçamentos demorados e sem fotos</span>
                        </li>
                        <li class="flex items-start gap-3 text-slate-700">
                            <i class="fa-solid fa-xmark text-red-500 mt-1"></i>
                            <span>Cliente reclama da demora na entrega</span>
                        </li>
                        <li class="flex items-start gap-3 text-slate-700">
                            <i class="fa-solid fa-xmark text-red-500 mt-1"></i>
                            <span>Prejuízo com material desperdiçado</span>
                        </li>
                    </ul>
                </div>
                <!-- Gain -->
                <div class="p-8 rounded-3xl bg-green-50 border border-green-100 relative overflow-hidden shadow-md group hover:shadow-xl transition transform hover:-translate-y-1">
                    <div class="absolute top-0 right-0 bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-bl-xl">CENÁRIO DESEJADO</div>
                    <h3 class="text-xl font-bold text-green-700 mb-6 flex items-center gap-2">
                        <i class="fa-solid fa-circle-check"></i> Com WSoft
                    </h3>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-green-600 mt-1"></i>
                            <span>Orçamentos profissionais em minutos</span>
                        </li>
                        <li class="flex items-start gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-green-600 mt-1"></i>
                            <span>Acompanhamento por etapas (cliente feliz)</span>
                        </li>
                        <li class="flex items-start gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-green-600 mt-1"></i>
                            <span>Controle total de custos e lucro</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing (Scarcity) -->
    <section id="precos" class="py-20 bg-slate-50">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto">
                <p class="text-sm font-semibold text-blue-600 uppercase tracking-[0.3em]">Planos e Preços</p>
                <h2 class="mt-4 text-3xl md:text-4xl font-bold">Investimento que se paga no primeiro serviço</h2>
            </div>
            <div class="mt-12 max-w-lg mx-auto relative">
                <!-- Scarcity Badge -->
                <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 bg-red-600 text-white text-xs font-bold px-4 py-1 rounded-full shadow-lg z-10 animate-bounce">
                    RESTAM POUCAS VAGAS
                </div>
                
                <div class="rounded-3xl bg-white border-2 border-blue-600 shadow-2xl overflow-hidden relative">
                    <div class="bg-blue-600 text-white text-center py-4 relative overflow-hidden">
                        <div class="absolute inset-0 bg-white/10 transform -skew-x-12"></div>
                        <span class="text-sm font-bold uppercase tracking-wider relative z-10">Oferta Exclusiva Vitalícia</span>
                    </div>
                    <div class="p-8">
                        <div class="text-center">
                            <p class="text-sm text-slate-500 mb-2">De <span class="line-through text-red-400">R$ 47,90</span> por apenas:</p>
                            <div class="flex items-center justify-center gap-1">
                                <span class="text-2xl font-bold text-slate-700 mt-2">R$</span>
                                <span class="text-6xl font-extrabold text-blue-600">29</span>
                                <div class="flex flex-col items-start">
                                    <span class="text-2xl font-bold text-blue-600">,90</span>
                                    <span class="text-xs text-slate-500">/mês</span>
                                </div>
                            </div>
                            <div class="mt-4 bg-yellow-50 border border-yellow-200 rounded-lg p-3">
                                <p class="text-xs text-yellow-800 font-semibold mb-1">🔥 87% dos cupons já utilizados</p>
                                <div class="w-full bg-yellow-200 rounded-full h-2">
                                    <div class="bg-yellow-500 h-2 rounded-full" style="width: 87%"></div>
                                </div>
                                <p class="text-[10px] text-yellow-700 mt-1">Oferta válida para os próximos 100 clientes</p>
                            </div>
                        </div>
                        <ul class="mt-8 space-y-4">
                            <li class="flex items-start gap-3">
                                <div class="bg-green-100 p-1 rounded-full">
                                    <i class="fa-solid fa-check text-green-600 text-xs"></i>
                                </div>
                                <span class="text-slate-700 font-medium">Orçamentos com fotos ilimitados</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <div class="bg-green-100 p-1 rounded-full">
                                    <i class="fa-solid fa-check text-green-600 text-xs"></i>
                                </div>
                                <span class="text-slate-700 font-medium">Controle de OS e Etapas</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <div class="bg-green-100 p-1 rounded-full">
                                    <i class="fa-solid fa-check text-green-600 text-xs"></i>
                                </div>
                                <span class="text-slate-700 font-medium">Financeiro completo</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <div class="bg-green-100 p-1 rounded-full">
                                    <i class="fa-solid fa-check text-green-600 text-xs"></i>
                                </div>
                                <span class="text-slate-700 font-medium">Suporte via WhatsApp incluso</span>
                            </li>
                        </ul>
                        <div class="mt-8">
                            <a href="/app/register" class="block w-full text-center rounded-lg bg-blue-600 text-white font-semibold px-8 py-4 hover:bg-blue-700 transition shadow-lg shadow-blue-600/30">
                                GARANTIR MEU DESCONTO
                            </a>
                        </div>
                        <p class="mt-4 text-center text-sm text-slate-500">Sem fidelidade. Cancele quando quiser.</p>
                    </div>
                </div>
            </div>
        </div>

    <!-- Por que WSoft -->
    <section id="porque" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-12 items-center">
            <div>
                <p class="text-sm font-semibold text-blue-600 uppercase tracking-[0.3em]">Por que o WSoft Tecnologia?</p>
                <h2 class="mt-4 text-3xl font-bold">Software para funilaria pensado por quem entende do ramo</h2>
                <p class="mt-4 text-slate-600">
                    O WSoft foi desenvolvido especificamente para as necessidades de funilarias e oficinas de pintura. Diferente de sistemas genéricos, nosso software entende a rotina de uma funilaria: orçamentos detalhados com fotos, acompanhamento por etapas e controle de materiais.
                </p>
                <p class="mt-4 text-slate-600">
                    Com o WSoft, você transforma sua funilaria em um negócio organizado, profissional e lucrativo. Impressione seus clientes com orçamentos profissionais e acompanhamento transparente.
                </p>
                <ul class="mt-6 space-y-3 text-slate-800">
                    <li class="flex items-start gap-3"><i class="fa-solid fa-circle-check text-green-500 mt-1"></i> Interface simples que qualquer colaborador aprende rápido.</li>
                    <li class="flex items-start gap-3"><i class="fa-solid fa-circle-check text-green-500 mt-1"></i> Suporte especializado no setor automotivo.</li>
                    <li class="flex items-start gap-3"><i class="fa-solid fa-circle-check text-green-500 mt-1"></i> Implantação em dias com treinamento incluído.</li>
                </ul>
            </div>
            <div class="rounded-3xl bg-gradient-to-br from-blue-100 via-white to-emerald-100 p-8 shadow-xl border border-slate-100">
                <div class="grid grid-cols-2 gap-6 text-center">
                    <div>
                        <p class="text-4xl font-bold text-blue-700">+60%</p>
                        <p class="text-xs uppercase tracking-widest text-slate-500 mt-2">Orçamentos aprovados</p>
                    </div>
                    <div>
                        <p class="text-4xl font-bold text-blue-700">2x</p>
                        <p class="text-xs uppercase tracking-widest text-slate-500 mt-2">Mais serviços por mês</p>
                    </div>
                    <div>
                        <p class="text-4xl font-bold text-blue-700">10 min</p>
                        <p class="text-xs uppercase tracking-widest text-slate-500 mt-2">Para criar orçamento</p>
                    </div>
                    <div>
                        <p class="text-4xl font-bold text-blue-700">R$ 0</p>
                        <p class="text-xs uppercase tracking-widest text-slate-500 mt-2">Custos escondidos</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        const button = document.getElementById('menu-button');
        const mobileNav = document.getElementById('mobile-nav');
        if (button) {
            button.addEventListener('click', () => {
                mobileNav.classList.toggle('hidden');
            });
        }
    </script>
    @livewireScripts
</body>
</html>
