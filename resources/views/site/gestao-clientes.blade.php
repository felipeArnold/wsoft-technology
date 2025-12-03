@php
$structuredData = [
    [
        '@context' => 'https://schema.org',
        '@type' => 'SoftwareApplication',
        'name' => 'WSoft - Sistema de Gestão de Clientes',
        'url' => 'https://www.wsoft.dev.br/gestao-clientes',
        'description' => 'Sistema completo para gestão de clientes e CRM. Centralize cadastros, histórico de atendimentos, vendas e controle total do relacionamento com seus clientes.',
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
            'ratingValue' => '4.8',
            'ratingCount' => '124'
        ]
    ],
    [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => [
            [
                '@type' => 'Question',
                'name' => 'O que é um sistema de gestão de clientes?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Um sistema de gestão de clientes (CRM) é uma plataforma que centraliza todas as informações dos seus clientes: dados cadastrais, histórico de compras, interações, atendimentos e muito mais. Com ele, você melhora o relacionamento e aumenta as vendas.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'Como um CRM ajuda a aumentar vendas?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'O CRM organiza o histórico de cada cliente, identifica oportunidades de venda, automatiza follow-ups e permite segmentação inteligente. Com isso, você vende mais para quem já é cliente e reduz a perda de oportunidades.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'O WSoft é adequado para pequenas empresas?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Sim! O WSoft foi desenvolvido especialmente para pequenas empresas, MEI e autônomos. Interface simples, preço acessível e todas as funcionalidades que você precisa para profissionalizar sua gestão.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'Posso integrar o cadastro de clientes com vendas e financeiro?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Sim! No WSoft, o cadastro de clientes está totalmente integrado com vendas, ordens de serviço, contas a receber e relatórios. Tudo em um único sistema.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'Quanto custa o sistema de gestão de clientes WSoft?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'O WSoft custa apenas R$ 29,90 por mês com todas as funcionalidades incluídas: cadastro ilimitado de clientes, CRM, vendas, financeiro, estoque e ordem de serviço. Teste grátis por 7 dias.'
                ]
            ]
        ]
    ]
];
@endphp

<x-site-layout
    :title="'Sistema de Gestão de Clientes | CRM para Pequenas Empresas | WSoft'"
    :description="'Sistema completo de gestão de clientes e CRM para pequenas empresas. Cadastro ilimitado, histórico de vendas, segmentação inteligente e controle total. Teste grátis!'"
    :keywords="'sistema de gestão de clientes, CRM pequenas empresas, cadastro de clientes, software gestão clientes, CRM simples, programa cadastro clientes, gestão relacionamento cliente, controle de clientes, CRM online, sistema CRM gratuito'"
    :canonical="'https://www.wsoft.dev.br/gestao-clientes'"
    :ogTitle="'Sistema de Gestão de Clientes e CRM | WSoft'"
    :ogDescription="'Organize seu cadastro de clientes, automatize follow-ups e aumente suas vendas com o CRM mais simples e completo para pequenas empresas.'"
    :structuredData="$structuredData"
>

<!-- Hero -->
<section id="hero" class="pt-32 pb-24 bg-gradient-to-b from-blue-950 via-blue-900 to-blue-800 text-white overflow-hidden relative">
    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 30px 30px;"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-16 items-center relative z-10">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-800/50 border border-blue-700 text-blue-200 text-xs font-semibold uppercase tracking-wider mb-6">
                <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                Sistema de Gestão de Clientes
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold leading-tight tracking-tight">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-200 to-white">Gestão de Clientes</span> Simples e Inteligente
            </h1>
            <p class="mt-6 text-lg md:text-xl text-emerald-100 leading-relaxed max-w-lg">
                Centralize cadastros, histórico de vendas e atendimentos em um único lugar. O <strong>sistema de gestão de clientes</strong> ideal para quem quer crescer.
            </p>
            <div class="mt-10 flex flex-col sm:flex-row gap-4">
                <a href="/app/register" class="inline-flex justify-center items-center rounded-xl bg-white text-emerald-700 font-bold px-8 py-4 shadow-lg shadow-white/30 hover:bg-emerald-50 hover:-translate-y-1 transition transform duration-200">
                    Testar por 7 Dias
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
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Lojas e Comércio</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Prestadores de Serviço</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Oficinas e Mecânicas</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Consultórios</span>
                </div>
            </div>
        </div>
        <div class="relative">
            <div class="absolute -inset-4 bg-gradient-to-r from-emerald-500 to-cyan-500 rounded-full blur-3xl opacity-20 animate-pulse"></div>
            <div class="bg-white/10 border border-white/20 rounded-3xl p-8 backdrop-blur-md shadow-2xl relative">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <p class="text-sm uppercase text-emerald-200 font-semibold tracking-wider">Base de Clientes</p>
                        <h3 class="text-3xl font-bold mt-1">1.847 Clientes</h3>
                        <div class="flex items-center gap-2 mt-2">
                            <span class="text-xs font-bold text-green-400 bg-green-400/10 px-2 py-0.5 rounded">+23% este mês</span>
                        </div>
                    </div>
                    <div class="h-12 w-12 rounded-full bg-emerald-500/20 flex items-center justify-center border border-emerald-400/30">
                        <i class="fa-solid fa-users text-emerald-300 text-xl"></i>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-xs text-emerald-200">Taxa de Retenção</p>
                            <span class="text-sm font-bold text-emerald-300">94%</span>
                        </div>
                        <div class="h-2 bg-emerald-950/50 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-emerald-400 to-cyan-400 w-[94%] rounded-full"></div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                            <p class="text-xs text-emerald-200">Novos este Mês</p>
                            <p class="text-2xl font-bold mt-1">124</p>
                        </div>
                        <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                            <p class="text-xs text-emerald-200">Ativos</p>
                            <p class="text-2xl font-bold mt-1">1.623</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pain vs Gain -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-red-600 font-bold tracking-wider uppercase text-sm">O problema da desorganização</span>
            <h2 class="mt-2 text-3xl md:text-4xl font-extrabold text-slate-900">Você está perdendo clientes por falta de controle?</h2>
            <p class="mt-4 text-lg text-slate-600">Empresas sem um <strong>sistema de gestão de clientes</strong> perdem oportunidades todos os dias. Veja a diferença:</p>
        </div>
        <div class="grid md:grid-cols-2 gap-8">
            <!-- Pain -->
            <div class="p-8 rounded-3xl bg-red-50 border border-red-100 relative overflow-hidden group hover:shadow-lg transition">
                <div class="absolute top-0 right-0 bg-red-100 text-red-600 text-xs font-bold px-3 py-1 rounded-bl-xl">SEM SISTEMA</div>
                <h3 class="text-xl font-bold text-red-700 mb-6 flex items-center gap-2">
                    <i class="fa-solid fa-circle-xmark"></i> Cadastro Desorganizado
                </h3>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3 text-slate-700">
                        <i class="fa-solid fa-xmark text-red-500 mt-1"></i>
                        <span>Informações espalhadas em papéis e planilhas</span>
                    </li>
                    <li class="flex items-start gap-3 text-slate-700">
                        <i class="fa-solid fa-xmark text-red-500 mt-1"></i>
                        <span>Esquece de dar follow-up e perde vendas</span>
                    </li>
                    <li class="flex items-start gap-3 text-slate-700">
                        <i class="fa-solid fa-xmark text-red-500 mt-1"></i>
                        <span>Não sabe o histórico de compras de cada cliente</span>
                    </li>
                    <li class="flex items-start gap-3 text-slate-700">
                        <i class="fa-solid fa-xmark text-red-500 mt-1"></i>
                        <span>Atendimento despersonalizado e genérico</span>
                    </li>
                </ul>
            </div>
            <!-- Gain -->
            <div class="p-8 rounded-3xl bg-green-50 border border-green-100 relative overflow-hidden shadow-md group hover:shadow-xl transition transform hover:-translate-y-1">
                <div class="absolute top-0 right-0 bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-bl-xl">COM WSOFT</div>
                <h3 class="text-xl font-bold text-green-700 mb-6 flex items-center gap-2">
                    <i class="fa-solid fa-circle-check"></i> Gestão Profissional
                </h3>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3 text-slate-700">
                        <i class="fa-solid fa-check text-green-600 mt-1"></i>
                        <span>Cadastro completo e organizado em um só lugar</span>
                    </li>
                    <li class="flex items-start gap-3 text-slate-700">
                        <i class="fa-solid fa-check text-green-600 mt-1"></i>
                        <span>Alertas automáticos para não perder oportunidades</span>
                    </li>
                    <li class="flex items-start gap-3 text-slate-700">
                        <i class="fa-solid fa-check text-green-600 mt-1"></i>
                        <span>Histórico completo de vendas e interações</span>
                    </li>
                    <li class="flex items-start gap-3 text-slate-700">
                        <i class="fa-solid fa-check text-green-600 mt-1"></i>
                        <span>Atendimento personalizado e profissional</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- How it Works (New Section) -->
<section id="como-funciona" class="py-24 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-20">
            <p class="text-sm font-semibold text-emerald-600 uppercase tracking-[0.3em]">Passo a Passo</p>
            <h2 class="mt-4 text-3xl md:text-4xl font-bold text-slate-900">Como funciona o Sistema de Gestão de Clientes</h2>
            <p class="mt-4 text-lg text-slate-600">Simples, intuitivo e poderoso. Veja como é fácil organizar sua empresa.</p>
        </div>

        <div class="space-y-24">
            <!-- Step 1 -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 group">
                        <div class="absolute inset-0 bg-emerald-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="{{ asset('images/sistema/clientes/cadastro.png') }}" alt="Tela de Cadastro de Clientes" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-emerald-100 text-emerald-700 font-bold text-xl">1</span>
                        <h3 class="text-2xl font-bold text-slate-900">Cadastre seus Clientes</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Mantenha todos os dados organizados em um só lugar. Registre informações de contato, documentos, endereço e adicione tags para segmentar sua base.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Cadastro ilimitado de clientes</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Importação fácil de planilhas</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Campos personalizados</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-1">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-emerald-100 text-emerald-700 font-bold text-xl">2</span>
                        <h3 class="text-2xl font-bold text-slate-900">Acompanhe o Histórico</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Saiba exatamente o que acontece com cada cliente. Registre atendimentos, ligações, orçamentos e vendas. Tenha uma visão 360º do relacionamento.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Linha do tempo de interações</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Agendamento de follow-ups</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Histórico de compras integrado</span>
                        </li>
                    </ul>
                </div>
                <div class="order-2">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 group">
                        <div class="absolute inset-0 bg-emerald-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="/images/crm/history.png" alt="Tela de Histórico do Cliente" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 group">
                        <div class="absolute inset-0 bg-emerald-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="/images/crm/reports.png" alt="Relatórios de Gestão" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-emerald-100 text-emerald-700 font-bold text-xl">3</span>
                        <h3 class="text-2xl font-bold text-slate-900">Analise e Venda Mais</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Tome decisões baseadas em dados. Identifique seus melhores clientes, produtos mais vendidos e oportunidades de crescimento com relatórios automáticos.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Relatórios de vendas por cliente</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Curva ABC de clientes</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Indicadores de desempenho</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Benefícios -->
<section id="beneficios" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <p class="text-sm font-semibold text-emerald-600 uppercase tracking-[0.3em]">Benefícios do CRM</p>
            <h2 class="mt-4 text-3xl md:text-4xl font-bold">Por que investir em um sistema de gestão de clientes?</h2>
            <p class="mt-4 text-lg text-slate-600">Transforme o relacionamento com seus clientes e aumente suas vendas</p>
        </div>
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-chart-line text-emerald-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Aumente suas Vendas</h3>
                    <p class="mt-3 text-slate-600">Identifique oportunidades de cross-sell e up-sell analisando o histórico de compras. Venda mais para quem já é seu cliente.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-heart text-blue-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Fidelize Clientes</h3>
                    <p class="mt-3 text-slate-600">Atendimento personalizado com base no histórico. Clientes satisfeitos voltam sempre e indicam sua empresa.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-clock text-purple-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Economize Tempo</h3>
                    <p class="mt-3 text-slate-600">Acabe com planilhas e anotações. Todas as informações organizadas e acessíveis em segundos.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-bell text-orange-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Nunca Perca Follow-ups</h3>
                    <p class="mt-3 text-slate-600">Receba alertas automáticos para retomar contato com clientes inativos e aproveitar oportunidades.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-bullseye text-red-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Segmentação Inteligente</h3>
                    <p class="mt-3 text-slate-600">Separe clientes por tags, região, ticket médio ou qualquer critério. Campanhas mais assertivas.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-teal-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-shield-halved text-teal-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Dados Seguros e Organizados</h3>
                    <p class="mt-3 text-slate-600">Backup automático, controle de acesso e conformidade com LGPD. Seus dados sempre protegidos.</p>
                </div>
            </article>
        </div>
    </div>
</section>

<!-- Funcionalidades -->
<section id="funcionalidades" class="py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <p class="text-sm font-semibold text-emerald-600 uppercase tracking-[0.3em]">Funcionalidades Completas</p>
            <h2 class="mt-4 text-3xl md:text-4xl font-bold">Tudo que você precisa em um <strong>software de gestão de clientes</strong></h2>
            <p class="mt-4 text-lg text-slate-600">Cadastro, relacionamento, vendas e muito mais em uma única plataforma</p>
        </div>
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            <article class="group rounded-2xl border border-slate-100 bg-white p-6 shadow-sm hover:shadow-lg hover:border-emerald-200 transition-all duration-300">
                <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-emerald-600 transition-colors duration-300">
                    <i class="fa-solid fa-user-plus text-emerald-600 group-hover:text-white text-xl transition-colors duration-300"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Cadastro Completo de Clientes</h3>
                <p class="text-sm text-slate-600 leading-relaxed">Armazene dados cadastrais, documentos, fotos, observações e tudo que precisa sobre cada cliente em um único lugar.</p>
            </article>
            <article class="group rounded-2xl border border-slate-100 bg-white p-6 shadow-sm hover:shadow-lg hover:border-blue-200 transition-all duration-300">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-blue-600 transition-colors duration-300">
                    <i class="fa-solid fa-clock-rotate-left text-blue-600 group-hover:text-white text-xl transition-colors duration-300"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Histórico de Interações</h3>
                <p class="text-sm text-slate-600 leading-relaxed">Registre todos os contatos, vendas, orçamentos e atendimentos. Saiba exatamente o que aconteceu em cada interação.</p>
            </article>
            <article class="group rounded-2xl border border-slate-100 bg-white p-6 shadow-sm hover:shadow-lg hover:border-purple-200 transition-all duration-300">
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-purple-600 transition-colors duration-300">
                    <i class="fa-solid fa-tags text-purple-600 group-hover:text-white text-xl transition-colors duration-300"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Segmentação com Tags</h3>
                <p class="text-sm text-slate-600 leading-relaxed">Organize clientes por categorias personalizadas: VIP, inadimplente, potencial, região e muito mais.</p>
            </article>
            <article class="group rounded-2xl border border-slate-100 bg-white p-6 shadow-sm hover:shadow-lg hover:border-orange-200 transition-all duration-300">
                <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-orange-600 transition-colors duration-300">
                    <i class="fa-solid fa-chart-simple text-orange-600 group-hover:text-white text-xl transition-colors duration-300"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Relatórios de Vendas por Cliente</h3>
                <p class="text-sm text-slate-600 leading-relaxed">Veja quanto cada cliente comprou, ticket médio, frequência de compras e identifique os melhores clientes.</p>
            </article>
            <article class="group rounded-2xl border border-slate-100 bg-white p-6 shadow-sm hover:shadow-lg hover:border-red-200 transition-all duration-300">
                <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-red-600 transition-colors duration-300">
                    <i class="fa-solid fa-envelope text-red-600 group-hover:text-white text-xl transition-colors duration-300"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Comunicação Integrada</h3>
                <p class="text-sm text-slate-600 leading-relaxed">Envie e-mails, WhatsApp e lembretes automáticos direto do sistema. Mantenha seus clientes sempre informados.</p>
            </article>
            <article class="group rounded-2xl border border-slate-100 bg-white p-6 shadow-sm hover:shadow-lg hover:border-teal-200 transition-all duration-300">
                <div class="w-12 h-12 bg-teal-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-teal-600 transition-colors duration-300">
                    <i class="fa-solid fa-link text-teal-600 group-hover:text-white text-xl transition-colors duration-300"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Integração com Vendas e Financeiro</h3>
                <p class="text-sm text-slate-600 leading-relaxed">Cadastro de clientes integrado com ordens de serviço, vendas, contas a receber e estoque. Tudo conectado.</p>
            </article>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-br from-emerald-600 to-blue-600 text-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold">Organize seus clientes e venda mais</h2>
        <p class="mt-4 text-lg text-white/90 max-w-2xl mx-auto">
            Comece agora com 7 dias de teste grátis. Sem cartão de crédito, sem compromisso.
        </p>
        <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="/app/register" class="inline-flex justify-center items-center rounded-xl bg-white text-emerald-700 font-bold px-10 py-4 shadow-lg shadow-white/30 hover:bg-emerald-50 hover:-translate-y-1 transition transform duration-200">
                Testar por 7 Dias
                <i class="fa-solid fa-arrow-right ml-2"></i>
            </a>
            <a href="/#precos" class="inline-flex justify-center items-center rounded-xl border border-white/60 text-white font-semibold px-10 py-4 hover:bg-white/10 transition backdrop-blur-sm">
                Ver Planos e Preços
            </a>
        </div>
        <p class="mt-6 text-sm text-white/80">Mais de 500 empresas já organizaram seus clientes com o WSoft</p>
    </div>
</section>

<!-- FAQ -->
<section id="faq" class="py-20 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <p class="text-sm font-semibold text-emerald-600 uppercase tracking-[0.3em]">FAQ</p>
            <h2 class="mt-4 text-3xl font-bold">Perguntas frequentes sobre gestão de clientes</h2>
        </div>
        <div class="space-y-4">
            <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    O que é um sistema de gestão de clientes?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Um sistema de gestão de clientes (CRM) é uma plataforma que centraliza todas as informações dos seus clientes: dados cadastrais, histórico de compras, interações, atendimentos e muito mais. Com ele, você melhora o relacionamento e aumenta as vendas.</p>
            </details>
            <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    Como um CRM ajuda a aumentar vendas?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">O CRM organiza o histórico de cada cliente, identifica oportunidades de venda, automatiza follow-ups e permite segmentação inteligente. Com isso, você vende mais para quem já é cliente e reduz a perda de oportunidades.</p>
            </details>
            <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    O WSoft é adequado para pequenas empresas?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Sim! O WSoft foi desenvolvido especialmente para pequenas empresas, MEI e autônomos. Interface simples, preço acessível e todas as funcionalidades que você precisa para profissionalizar sua gestão.</p>
            </details>
            <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    Posso integrar o cadastro de clientes com vendas e financeiro?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Sim! No WSoft, o cadastro de clientes está totalmente integrado com vendas, ordens de serviço, contas a receber e relatórios. Tudo em um único sistema.</p>
            </details>
            <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    Quanto custa o sistema de gestão de clientes WSoft?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">O WSoft custa apenas R$ 29,90 por mês com todas as funcionalidades incluídas: cadastro ilimitado de clientes, CRM, vendas, financeiro, estoque e ordem de serviço. Teste grátis por 7 dias.</p>
            </details>
            <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    Posso importar minha base de clientes atual?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Sim! O WSoft permite importar clientes de planilhas Excel/CSV. Nossa equipe ajuda na importação durante a implantação para você começar com tudo organizado.</p>
            </details>
            <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    O sistema atende as exigências da LGPD?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Sim! O WSoft está em conformidade com a LGPD. Temos controle de acesso, registro de atividades, criptografia de dados e recursos para gerenciar consentimento dos clientes.</p>
            </details>
            <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    Há limite de cadastros de clientes?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Não! Você pode cadastrar quantos clientes quiser, sem limite. Ideal para empresas em crescimento que precisam escalar sem custos adicionais.</p>
            </details>
        </div>
    </div>
</section>

<!-- Prova Social -->
<section class="py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <p class="text-sm font-semibold text-emerald-600 uppercase tracking-[0.3em]">Depoimentos</p>
            <h2 class="mt-4 text-3xl font-bold">O que nossos clientes dizem sobre a gestão de clientes</h2>
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
                <p class="text-sm text-slate-600 italic">"Com o WSoft, nossa base de clientes ficou organizada. Agora sabemos exatamente o histórico de cada um e conseguimos fazer vendas mais assertivas."</p>
                <div class="mt-4 font-semibold">Marcos Silva</div>
                <div class="text-sm text-slate-500">Loja de Autopeças</div>
            </article>
            <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                <div class="flex gap-1 text-yellow-400 mb-4">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <p class="text-sm text-slate-600 italic">"Antes perdia muitas oportunidades por falta de follow-up. Agora o sistema me alerta e consigo retomar contato na hora certa. Minhas vendas aumentaram 40%!"</p>
                <div class="mt-4 font-semibold">Juliana Costa</div>
                <div class="text-sm text-slate-500">Consultoria Empresarial</div>
            </article>
            <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                <div class="flex gap-1 text-yellow-400 mb-4">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <p class="text-sm text-slate-600 italic">"O melhor CRM para pequenas empresas que já usei. Simples, completo e com preço justo. Recomendo!"</p>
                <div class="mt-4 font-semibold">Ricardo Almeida</div>
                <div class="text-sm text-slate-500">Prestador de Serviços</div>
            </article>
        </div>
    </div>
</section>

</x-site-layout>
