@php
$structuredData = [
    [
        '@context' => 'https://schema.org',
        '@type' => 'SoftwareApplication',
        'name' => 'WSoft - Sistema de Gestão para Oficinas Mecânicas',
        'url' => 'https://www.wsoft.dev.br/landing/oficina',
        'description' => 'Sistema completo para gestão de oficinas mecânicas. Controle de OS, financeiro, estoque, cadastro de clientes e fornecedores.',
        'operatingSystem' => 'Web',
        'applicationCategory' => 'BusinessApplication',
        'offers' => [
            '@type' => 'Offer',
            'price' => '29.90',
            'priceCurrency' => 'BRL',
            'url' => 'https://www.wsoft.dev.br/app/register',
            'description' => 'Plano mensal com todas as funcionalidades'
        ],
        'aggregateRating' => [
            '@type' => 'AggregateRating',
            'ratingValue' => '4.9',
            'ratingCount' => '145'
        ]
    ],
    [
        '@context' => 'https://schema.org',
        '@type' => 'AutoRepair',
        'name' => 'WSoft Tecnologia - Sistema de Gestão para Oficinas',
        'image' => 'https://www.wsoft.dev.br/images/logo.png',
        'description' => 'Sistema de gestão completo para oficinas mecânicas e auto centers. Controle financeiro, estoque e OS.',
        'url' => 'https://www.wsoft.dev.br/landing/oficina',
        'priceRange' => '$$',
        'address' => [
            '@type' => 'PostalAddress',
            'addressCountry' => 'BR'
        ],
        'aggregateRating' => [
            '@type' => 'AggregateRating',
            'ratingValue' => '4.9',
            'ratingCount' => '145'
        ]
    ],
    [
        '@context' => 'https://schema.org',
        '@type' => 'HowTo',
        'name' => 'Como organizar sua Oficina Mecânica com WSoft',
        'description' => 'Passo a passo para emitir OS, controlar financeiro e crescer seu negócio.',
        'step' => [
            [
                '@type' => 'HowToStep',
                'name' => 'Crie Ordens de Serviço',
                'text' => 'Emita ordens de serviço digitais com fotos, descrição de serviços, peças utilizadas e valores. Sistema de ordem de serviço completo e profissional.',
                'position' => 1
            ],
            [
                '@type' => 'HowToStep',
                'name' => 'Controle Financeiro Completo',
                'text' => 'Tenha controle total do financeiro com contas a pagar e receber, sistema de fluxo de caixa e relatórios detalhados. Organização empresarial real.',
                'position' => 2
            ],
            [
                '@type' => 'HowToStep',
                'name' => 'Analise e Cresça',
                'text' => 'Tome decisões baseadas em dados. Veja relatórios de vendas, controle de produtos, cadastro de clientes e fornecedores em um único painel.',
                'position' => 3
            ]
        ]
    ]
];
@endphp

<x-site-layout
    :title="'Sistema de Gestão para Oficinas Mecânicas | WSoft Tecnologia'"
    :description="'Sistema completo para gestão de oficinas mecânicas. Controle de OS, financeiro, estoque, cadastro de clientes e fornecedores. Teste grátis!'"
    :keywords="'sistema de gestão para pequenas empresas, software de gestão empresarial, sistema para microempresa, sistema financeiro online, sistema de ordem de serviço, controle financeiro, contas a pagar e receber, controle de inadimplência, cadastro de clientes e fornecedores, sistema de fluxo de caixa, ERP simples, sistema sem mensalidade, controle de clientes, organização empresarial, controle de produtos'"
    :canonical="'https://www.wsoft.dev.br/landing/oficina'"
    :ogTitle="'Sistema de Gestão para Oficinas Mecânicas | WSoft'"
    :ogDescription="'Pare de Perder Dinheiro com Desorganização. Sistema de Gestão Empresarial que organiza seu financeiro, elimina inadimplência e aumenta seus lucros.'"
    :structuredData="$structuredData"
>

<!-- Hero -->
<section id="hero" class="pt-32 pb-24 bg-gradient-to-b from-blue-950 via-blue-900 to-blue-800 text-white overflow-hidden relative">
    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 30px 30px;"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-16 items-center relative z-10">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-800/50 border border-blue-700 text-blue-200 text-xs font-semibold uppercase tracking-wider mb-6">
                <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                Sistema de Gestão para Oficinas
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold leading-tight tracking-tight">
                Pare de Perder Dinheiro com <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-200 to-white">Desorganização</span>
            </h1>
            <p class="mt-6 text-lg md:text-xl text-emerald-100 leading-relaxed max-w-lg">
                Sistema de Gestão Empresarial que organiza seu financeiro, elimina inadimplência e aumenta seus lucros. O <strong>sistema de gestão para pequenas empresas</strong> ideal para oficinas mecânicas.
            </p>
            <div class="mt-10 flex flex-col sm:flex-row gap-4">
                <a href="/app/register" class="inline-flex justify-center items-center rounded-xl bg-white text-emerald-700 font-bold px-8 py-4 shadow-lg shadow-white/30 hover:bg-emerald-50 hover:-translate-y-1 transition transform duration-200">
                    Teste grátis por 7 dias
                    <i class="fa-solid fa-arrow-right ml-2"></i>
                </a>
                <a href="#como-funciona" class="inline-flex justify-center items-center rounded-xl border border-white/30 text-white font-semibold px-8 py-4 hover:bg-white/10 transition backdrop-blur-sm">
                    <i class="fa-solid fa-play mr-2"></i>
                    Como Funciona
                </a>
            </div>
            <div class="mt-10 pt-8 border-t border-white/10">
                <p class="text-sm text-emerald-200 mb-4">Perfeito para:</p>
                <div class="flex flex-wrap gap-3 text-sm font-medium text-white">
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Oficinas Mecânicas</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Auto Centers</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Funilarias</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Pequenas Empresas</span>
                </div>
            </div>
        </div>
        <div class="relative">
            <div class="absolute -inset-4 bg-gradient-to-r from-emerald-500 to-cyan-500 rounded-full blur-3xl opacity-20 animate-pulse"></div>
            <div class="bg-white/10 border border-white/20 rounded-3xl p-8 backdrop-blur-md shadow-2xl relative">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <p class="text-sm uppercase text-emerald-200 font-semibold tracking-wider">Dashboard Financeiro</p>
                        <h3 class="text-3xl font-bold mt-1">R$ 87.420</h3>
                        <div class="flex items-center gap-2 mt-2">
                            <span class="text-xs font-bold text-green-400 bg-green-400/10 px-2 py-0.5 rounded">+23% este mês</span>
                        </div>
                    </div>
                    <div class="h-12 w-12 rounded-full bg-emerald-500/20 flex items-center justify-center border border-emerald-400/30">
                        <i class="fa-solid fa-chart-line text-emerald-300 text-xl"></i>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-xs text-emerald-200">Sistema de fluxo de caixa</p>
                            <span class="text-sm font-bold text-emerald-300">Atualizado</span>
                        </div>
                        <div class="h-2 bg-emerald-950/50 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-emerald-400 to-cyan-400 w-[85%] rounded-full"></div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                            <p class="text-xs text-emerald-200">Ordens de serviço</p>
                            <p class="text-2xl font-bold mt-1">42</p>
                        </div>
                        <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                            <p class="text-xs text-emerald-200">Controle de inadimplência</p>
                            <p class="text-2xl font-bold mt-1 text-rose-300">-32%</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pain vs Gain -->
<x-site.comparison
    title="Sua oficina está perdendo dinheiro?"
    subtitle="O problema da desorganização"
    description="A falta de gestão pode estar custando caro para o seu negócio. Veja a diferença:"
    painTitle="Gestão Manual"
    :painItems="[
        'OS de papel que somem ou rasgam',
        'Esquece de cobrar peças usadas na OS',
        'Não sabe quem deve (Inadimplência alta)',
        'Mistura dinheiro da oficina com pessoal'
    ]"
    gainTitle="Oficina Organizada"
    :gainItems="[
        'OS digital profissional e organizada',
        'Controle automático de estoque de peças',
        'Controle financeiro e cobrança automática',
        'Histórico completo do veículo (confiança)'
    ]"
    gainCardBg="bg-blue-900"
    gainCardBorder="border-blue-800"
    gainTitleColor="text-emerald-400"
    gainCheckColor="text-emerald-400"
    gainBadgeBg="bg-blue-500"
    gainBadgeText="COM WSOFT"
/>

<!-- How it Works -->
<section id="como-funciona" class="py-24 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-20">
            <p class="text-sm font-semibold text-emerald-600 uppercase tracking-[0.3em]">Passo a Passo</p>
            <h2 class="mt-4 text-3xl md:text-4xl font-bold text-slate-900">Como funciona o Sistema de Gestão para Oficinas</h2>
            <p class="mt-4 text-lg text-slate-600">Simples, intuitivo e poderoso. Veja como é fácil organizar sua oficina.</p>
        </div>

        <div class="space-y-24">
            <!-- Step 1 -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 group">
                        <div class="absolute inset-0 bg-emerald-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <div class="aspect-video bg-gradient-to-br from-blue-100 to-emerald-100 flex items-center justify-center text-slate-400">
                            <i class="fa-solid fa-clipboard-list text-6xl"></i>
                        </div>
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-emerald-100 text-emerald-700 font-bold text-xl">1</span>
                        <h3 class="text-2xl font-bold text-slate-900">Crie Ordens de Serviço</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Emita ordens de serviço digitais com fotos, descrição de serviços, peças utilizadas e valores. Sistema de ordem de serviço completo e profissional.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>OS numeradas automaticamente</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Integração com cadastro de clientes</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Controle de status e prazos</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-1">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-emerald-100 text-emerald-700 font-bold text-xl">2</span>
                        <h3 class="text-2xl font-bold text-slate-900">Controle Financeiro Completo</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Tenha controle total do financeiro com contas a pagar e receber, sistema de fluxo de caixa e relatórios detalhados. Organização empresarial real.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Contas a pagar e receber automatizadas</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Controle de inadimplência com alertas</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Dashboard financeiro em tempo real</span>
                        </li>
                    </ul>
                </div>
                <div class="order-2">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 group">
                        <div class="absolute inset-0 bg-emerald-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <div class="aspect-video bg-gradient-to-br from-green-100 to-blue-100 flex items-center justify-center text-slate-400">
                            <i class="fa-solid fa-money-bill-trend-up text-6xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 group">
                        <div class="absolute inset-0 bg-emerald-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <div class="aspect-video bg-gradient-to-br from-purple-100 to-pink-100 flex items-center justify-center text-slate-400">
                            <i class="fa-solid fa-chart-line text-6xl"></i>
                        </div>
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-emerald-100 text-emerald-700 font-bold text-xl">3</span>
                        <h3 class="text-2xl font-bold text-slate-900">Analise e Cresça</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Tome decisões baseadas em dados. Veja relatórios de vendas, controle de produtos, cadastro de clientes e fornecedores em um único painel.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Relatórios de OS e faturamento</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Controle de produtos e estoque</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Indicadores de desempenho</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="mt-16 text-center">
            <a href="/app/register" class="inline-flex items-center gap-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-8 py-4 rounded-xl shadow-lg shadow-emerald-500/20 hover:shadow-emerald-500/40 transform hover:-translate-y-0.5 transition-all duration-300">
                <span>Testar Gratuitamente</span>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- Benefícios -->
<section id="beneficios" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <p class="text-sm font-semibold text-emerald-600 uppercase tracking-[0.3em]">Benefícios do Sistema</p>
            <h2 class="mt-4 text-3xl md:text-4xl font-bold">Por que investir em um sistema de gestão para pequenas empresas?</h2>
            <p class="mt-4 text-lg text-slate-600">Transforme a gestão da sua oficina e aumente seus lucros</p>
        </div>
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-chart-line text-emerald-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Aumente seus Lucros</h3>
                    <p class="mt-3 text-slate-600">Controle financeiro completo com sistema de fluxo de caixa em tempo real. Saiba exatamente quanto você lucra.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-clipboard-check text-blue-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Sistema de Ordem de Serviço</h3>
                    <p class="mt-3 text-slate-600">OS digital completa com fotos, peças e valores. Nunca mais perca informações importantes.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-shield-halved text-purple-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Controle de Inadimplência</h3>
                    <p class="mt-3 text-slate-600">Régua automática de cobrança com alertas. Reduza inadimplência e aumente o recebimento.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-users text-orange-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Cadastro de Clientes e Fornecedores</h3>
                    <p class="mt-3 text-slate-600">Organize todos os contatos em um só lugar. Histórico completo de cada cliente e fornecedor.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-boxes text-red-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Controle de Produtos</h3>
                    <p class="mt-3 text-slate-600">Estoque organizado com alertas de estoque mínimo. Nunca mais fique sem peças essenciais.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-teal-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-clock text-teal-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Economize Tempo</h3>
                    <p class="mt-3 text-slate-600">ERP simples que automatiza processos. Mais tempo para focar no que realmente importa: seu negócio.</p>
                </div>
            </article>
        </div>

        <div class="mt-16 text-center">
            <a href="/app/register" class="inline-flex items-center gap-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-8 py-4 rounded-xl shadow-lg shadow-emerald-500/20 hover:shadow-emerald-500/40 transform hover:-translate-y-0.5 transition-all duration-300">
                <span>Testar Gratuitamente</span>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- Funcionalidades -->
<section id="funcionalidades" class="py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <p class="text-sm font-semibold text-emerald-600 uppercase tracking-[0.3em]">Funcionalidades Completas</p>
            <h2 class="mt-4 text-3xl md:text-4xl font-bold">Tudo que você precisa em um <strong>software de gestão empresarial</strong></h2>
            <p class="mt-4 text-lg text-slate-600">Sistema financeiro online, OS, estoque e muito mais em uma única plataforma</p>
        </div>
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            <article class="group rounded-2xl border border-slate-100 bg-white p-6 shadow-sm hover:shadow-lg hover:border-emerald-200 transition-all duration-300">
                <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-emerald-600 transition-colors duration-300">
                    <i class="fa-solid fa-clipboard-list text-emerald-600 group-hover:text-white text-xl transition-colors duration-300"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Sistema de Ordem de Serviço</h3>
                <p class="text-sm text-slate-600 leading-relaxed">OS digital completa com numeração automática, fotos, peças, valores e status de acompanhamento.</p>
            </article>
            <article class="group rounded-2xl border border-slate-100 bg-white p-6 shadow-sm hover:shadow-lg hover:border-blue-200 transition-all duration-300">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-blue-600 transition-colors duration-300">
                    <i class="fa-solid fa-money-bill-trend-up text-blue-600 group-hover:text-white text-xl transition-colors duration-300"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Controle Financeiro</h3>
                <p class="text-sm text-slate-600 leading-relaxed">Contas a pagar e receber, sistema de fluxo de caixa, relatórios e dashboards financeiros completos.</p>
            </article>
            <article class="group rounded-2xl border border-slate-100 bg-white p-6 shadow-sm hover:shadow-lg hover:border-purple-200 transition-all duration-300">
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-purple-600 transition-colors duration-300">
                    <i class="fa-solid fa-exclamation-triangle text-purple-600 group-hover:text-white text-xl transition-colors duration-300"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Controle de Inadimplência</h3>
                <p class="text-sm text-slate-600 leading-relaxed">Régua automática de cobrança, alertas, segmentação de devedores e relatórios de inadimplência.</p>
            </article>
            <article class="group rounded-2xl border border-slate-100 bg-white p-6 shadow-sm hover:shadow-lg hover:border-orange-200 transition-all duration-300">
                <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-orange-600 transition-colors duration-300">
                    <i class="fa-solid fa-users text-orange-600 group-hover:text-white text-xl transition-colors duration-300"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Cadastro de Clientes e Fornecedores</h3>
                <p class="text-sm text-slate-600 leading-relaxed">CRM completo com histórico, anexos, veículos, contratos e relacionamento integrado.</p>
            </article>
            <article class="group rounded-2xl border border-slate-100 bg-white p-6 shadow-sm hover:shadow-lg hover:border-red-200 transition-all duration-300">
                <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-red-600 transition-colors duration-300">
                    <i class="fa-solid fa-boxes text-red-600 group-hover:text-white text-xl transition-colors duration-300"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Controle de Produtos</h3>
                <p class="text-sm text-slate-600 leading-relaxed">Estoque com SKU, alertas de estoque mínimo, previsão de compras e integração com OS.</p>
            </article>
            <article class="group rounded-2xl border border-slate-100 bg-white p-6 shadow-sm hover:shadow-lg hover:border-teal-200 transition-all duration-300">
                <div class="w-12 h-12 bg-teal-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-teal-600 transition-colors duration-300">
                    <i class="fa-solid fa-chart-pie text-teal-600 group-hover:text-white text-xl transition-colors duration-300"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Dashboard e Relatórios</h3>
                <p class="text-sm text-slate-600 leading-relaxed">Indicadores em tempo real, relatórios de vendas, OS, financeiro e controle de inadimplência.</p>
            </article>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-br from-emerald-600 to-blue-600 text-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold">Organize sua oficina e aumente seus lucros</h2>
        <p class="mt-4 text-lg text-white/90 max-w-2xl mx-auto">
            Comece agora com 7 dias de teste grátis. Sem cartão de crédito, sem compromisso.
        </p>
        <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="/app/register" class="inline-flex justify-center items-center rounded-xl bg-white text-emerald-700 font-bold px-10 py-4 shadow-lg shadow-white/30 hover:bg-emerald-50 hover:-translate-y-1 transition transform duration-200">
                Teste grátis por 7 dias
                <i class="fa-solid fa-arrow-right ml-2"></i>
            </a>
            <a href="#valores" class="inline-flex justify-center items-center rounded-xl border border-white/60 text-white font-semibold px-10 py-4 hover:bg-white/10 transition backdrop-blur-sm">
                Ver Planos e Preços
            </a>
        </div>
        <p class="mt-6 text-sm text-white/80">Mais de 500 oficinas já organizaram seus negócios com o WSoft</p>
    </div>
</section>

<!-- Valores/Preços -->
<section id="valores" class="py-20 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <p class="text-sm font-semibold text-emerald-600 uppercase tracking-[0.3em]">Investimento</p>
            <h2 class="mt-4 text-3xl font-bold">Planos que cabem no seu bolso</h2>
            <p class="mt-4 text-lg text-slate-600">Sistema sem mensalidade fixa ou com plano mensal acessível. Escolha o que faz sentido para sua oficina.</p>
        </div>

        <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
            <!-- Plano Mensal -->
            <div class="bg-white rounded-3xl shadow-xl border-2 border-slate-200 p-8 hover:border-emerald-500 transition relative">
                <div class="absolute top-0 right-0 bg-emerald-500 text-white font-bold px-4 py-1 rounded-bl-xl text-xs">POPULAR</div>
                <h3 class="text-2xl font-bold text-slate-900 mb-2 mt-4">Plano Mensal</h3>
                <div class="mb-6">
                    <div class="flex items-baseline gap-1">
                        <span class="text-5xl font-extrabold text-emerald-600">R$ 29</span>
                        <span class="text-2xl font-bold text-emerald-600">,90</span>
                        <span class="text-slate-600 text-lg">/mês</span>
                    </div>
                    <p class="text-sm text-slate-500 mt-2">Cancele quando quiser</p>
                </div>
                <ul class="space-y-4 mb-8">
                    <li class="flex items-start gap-3">
                        <i class="fa-solid fa-check text-emerald-500 mt-1"></i>
                        <span class="text-slate-700">Sistema de ordem de serviço ilimitado</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fa-solid fa-check text-emerald-500 mt-1"></i>
                        <span class="text-slate-700">Controle financeiro completo</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fa-solid fa-check text-emerald-500 mt-1"></i>
                        <span class="text-slate-700">Cadastro de clientes e fornecedores</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fa-solid fa-check text-emerald-500 mt-1"></i>
                        <span class="text-slate-700">Controle de produtos e estoque</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fa-solid fa-check text-emerald-500 mt-1"></i>
                        <span class="text-slate-700">Sistema de fluxo de caixa</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fa-solid fa-check text-emerald-500 mt-1"></i>
                        <span class="text-slate-700">Controle de inadimplência</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fa-solid fa-check text-emerald-500 mt-1"></i>
                        <span class="text-slate-700">Suporte via WhatsApp</span>
                    </li>
                </ul>
                <a href="/app/register" class="block w-full text-center bg-emerald-600 text-white font-bold px-8 py-4 rounded-xl hover:bg-emerald-700 transition shadow-lg">
                    Testar Grátis por 7 Dias
                </a>
                <p class="text-center text-sm text-slate-500 mt-4">7 dias grátis • Sem cartão de crédito</p>
            </div>

            <!-- Plano Anual -->
            <div class="bg-gradient-to-br from-slate-50 to-white rounded-3xl shadow-xl border-2 border-slate-200 p-8 hover:border-blue-500 transition">
                <h3 class="text-2xl font-bold text-slate-900 mb-2">Plano Anual</h3>
                <div class="mb-6">
                    <div class="flex items-baseline gap-1">
                        <span class="text-5xl font-extrabold text-blue-600">R$ 24</span>
                        <span class="text-2xl font-bold text-blue-600">,90</span>
                        <span class="text-slate-600 text-lg">/mês</span>
                    </div>
                    <p class="text-sm text-slate-500 mt-2">Economia de 17% • Pago anualmente</p>
                    <p class="text-xs text-emerald-600 font-semibold mt-1">Economize R$ 60/ano</p>
                </div>
                <ul class="space-y-4 mb-8">
                    <li class="flex items-start gap-3">
                        <i class="fa-solid fa-check text-blue-500 mt-1"></i>
                        <span class="text-slate-700">Tudo do plano mensal</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fa-solid fa-check text-blue-500 mt-1"></i>
                        <span class="text-slate-700">Suporte prioritário</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fa-solid fa-check text-blue-500 mt-1"></i>
                        <span class="text-slate-700">Atualizações antecipadas</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fa-solid fa-check text-blue-500 mt-1"></i>
                        <span class="text-slate-700">Treinamento personalizado</span>
                    </li>
                </ul>
                <a href="/app/register" class="block w-full text-center bg-blue-600 text-white font-bold px-8 py-4 rounded-xl hover:bg-blue-700 transition shadow-lg">
                    Testar Grátis por 7 Dias
                </a>
                <p class="text-center text-sm text-slate-500 mt-4">7 dias grátis • Sem cartão de crédito</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<x-site.cta-final
    :title="'Escolha um sistema completo para gestão de oficina mecânica'"
    :description="'Comece agora com 7 dias de teste grátis. Use o melhor <strong>sistema para oficina mecânica</strong> por apenas <span class=\'text-yellow-300 font-bold\'>R$ 29,90/mês</span>.'"
    :footer="'Junte-se a centenas de oficinas que usam WSoft'"
    :gradient="'bg-gradient-to-br from-emerald-600 to-blue-600'"
    :textColor="'text-emerald-50'"
    :highlightColor="'text-yellow-300'"
/>


<!-- FAQ -->
<section id="faq" class="py-20 bg-slate-50">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <p class="text-sm font-semibold text-emerald-600 uppercase tracking-[0.3em]">FAQ</p>
            <h2 class="mt-4 text-3xl font-bold">Perguntas frequentes sobre gestão de oficinas</h2>
        </div>
        <div class="space-y-4">
            <details class="group rounded-2xl border border-slate-100 bg-white p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    O sistema emite Ordem de Serviço (OS)?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Sim! O WSoft possui sistema de ordem de serviço completo e digital. Você emite OS numeradas automaticamente, com fotos, descrição de serviços, peças utilizadas e valores. Tudo integrado com o cadastro de clientes e controle financeiro.</p>
            </details>
            <details class="group rounded-2xl border border-slate-100 bg-white p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    Como funciona o controle financeiro?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">O sistema financeiro online do WSoft inclui contas a pagar e receber, sistema de fluxo de caixa em tempo real, relatórios detalhados e dashboards. Você tem controle total do financeiro da sua oficina.</p>
            </details>
            <details class="group rounded-2xl border border-slate-100 bg-white p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    O sistema ajuda no controle de inadimplência?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Sim! O WSoft possui controle de inadimplência completo com régua automática de cobrança, alertas, segmentação de devedores e relatórios. Reduza inadimplência e aumente o recebimento.</p>
            </details>
            <details class="group rounded-2xl border border-slate-100 bg-white p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    Posso cadastrar clientes e fornecedores?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Sim! O sistema possui cadastro completo de clientes e fornecedores com histórico, anexos, veículos, contratos e relacionamento integrado. Tudo organizado em um só lugar.</p>
            </details>
            <details class="group rounded-2xl border border-slate-100 bg-white p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    Há controle de produtos e estoque?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Sim! O controle de produtos inclui estoque com SKU, alertas de estoque mínimo, previsão de compras e integração completa com as ordens de serviço.</p>
            </details>
            <details class="group rounded-2xl border border-slate-100 bg-white p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    Quanto custa o sistema?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">O WSoft custa apenas R$ 29,90 por mês com todas as funcionalidades incluídas: sistema de ordem de serviço, controle financeiro, cadastro de clientes e fornecedores, controle de produtos, sistema de fluxo de caixa e controle de inadimplência. Teste grátis por 7 dias.</p>
            </details>
            <details class="group rounded-2xl border border-slate-100 bg-white p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    Posso testar antes de contratar?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Sim! Oferecemos 7 dias de teste grátis, sem necessidade de cartão de crédito. Você pode testar todas as funcionalidades antes de decidir.</p>
            </details>
        </div>
    </div>
</section>

<!-- Prova Social -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <p class="text-sm font-semibold text-emerald-600 uppercase tracking-[0.3em]">Depoimentos</p>
            <h2 class="mt-4 text-3xl font-bold">O que nossos clientes dizem sobre o sistema</h2>
        </div>
        <div class="grid gap-6 md:grid-cols-3">
            <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                <div class="flex gap-1 text-yellow-400 mb-4">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <p class="text-sm text-slate-600 italic">"Com o WSoft, nossa oficina ficou organizada. Agora temos controle total do financeiro, OS digital e conseguimos reduzir inadimplência em 40%."</p>
                <div class="mt-4 font-semibold">Marcos Silva</div>
                <div class="text-sm text-slate-500">Oficina Mecânica - São Paulo</div>
            </article>
            <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                <div class="flex gap-1 text-yellow-400 mb-4">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <p class="text-sm text-slate-600 italic">"O melhor sistema para oficinas que já usei. Simples, completo e com preço justo. O controle de produtos e estoque mudou nossa operação."</p>
                <div class="mt-4 font-semibold">Juliana Costa</div>
                <div class="text-sm text-slate-500">Auto Center - Rio de Janeiro</div>
            </article>
            <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                <div class="flex gap-1 text-yellow-400 mb-4">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <p class="text-sm text-slate-600 italic">"ERP simples e direto ao ponto. Sistema de fluxo de caixa em tempo real nos ajuda a tomar decisões melhores. Recomendo!"</p>
                <div class="mt-4 font-semibold">Ricardo Almeida</div>
                <div class="text-sm text-slate-500">Funilaria - Belo Horizonte</div>
            </article>
        </div>
    </div>
</section>

</x-site-layout>
