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
            'price' => '79.90',
            'priceCurrency' => 'BRL',
            'url' => 'https://www.wsoft.dev.br/sistema-para-gestao-de-clientes',
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
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            [
                '@type' => 'ListItem',
                'position' => 1,
                'name' => 'Home',
                'item' => 'https://www.wsoft.dev.br/'
            ],
            [
                '@type' => 'ListItem',
                'position' => 2,
                'name' => 'Gestão de Clientes',
                'item' => 'https://www.wsoft.dev.br/gestao-clientes'
            ]
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
                    'text' => 'O WSoft custa apenas R$ 79,90 por mês com todas as funcionalidades incluídas: cadastro ilimitado de clientes, CRM, vendas, financeiro, estoque e ordem de serviço. Teste grátis por 7 dias.'
                ]
            ]
        ]
    ],
    [
        '@context' => 'https://schema.org',
        '@type' => 'HowTo',
        'name' => 'Como organizar a Gestão de Clientes com WSoft',
        'description' => 'Passo a passo para centralizar dados, acompanhar histórico e vender mais.',
        'step' => [
            [
                '@type' => 'HowToStep',
                'name' => 'Cadastre seus Clientes',
                'text' => 'Mantenha todos os dados organizados em um só lugar. Registre informações de contato, documentos, endereço e adicione tags para segmentar sua base.',
                'position' => 1
            ],
            [
                '@type' => 'HowToStep',
                'name' => 'Acompanhe o Histórico',
                'text' => 'Saiba exatamente o que acontece com cada cliente. Registre atendimentos, ligações, orçamentos e vendas. Tenha uma visão 360º do relacionamento.',
                'position' => 2
            ],
            [
                '@type' => 'HowToStep',
                'name' => 'Analise e Venda Mais',
                'text' => 'Tome decisões baseadas em dados. Identifique seus melhores clientes, produtos mais vendidos e oportunidades de crescimento com relatórios automáticos.',
                'position' => 3
            ]
        ]
    ],
    [
        '@context' => 'https://schema.org',
        '@type' => 'VideoObject',
        'name' => 'Como Funciona o Sistema de Gestão de Clientes WSoft',
        'description' => 'Demonstração prática do sistema de gestão de clientes WSoft. Veja como cadastrar clientes, acompanhar histórico de vendas e gerenciar seu CRM de forma simples e profissional.',
        'thumbnailUrl' => 'https://img.youtube.com/vi/5SufzoP1Toc/maxresdefault.jpg',
        'uploadDate' => '2026-01-08T00:00:00-03:00',
        'contentUrl' => 'https://www.youtube.com/watch?v=5SufzoP1Toc',
        'embedUrl' => 'https://www.youtube.com/embed/5SufzoP1Toc',
        'duration' => 'PT5M',
        'publisher' => [
            '@type' => 'Organization',
            'name' => 'WSoft',
            'logo' => [
                '@type' => 'ImageObject',
                'url' => 'https://www.wsoft.dev.br/logo.png'
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

<div x-data="{ videoModal: false }" @open-video-modal.window="videoModal = true">
    <x-site.hero
        badge="Software CRM"
        highlight="Sistema de Gestão de Clientes"
        title=""
        description="Centralize cadastros, histórico de vendas e atendimentos em um único lugar. O sistema de gestão de clientes ideal para quem quer crescer. <span class='text-emerald-400 font-bold block mt-2'>Apenas R$ 79,90/mês.</span>"
        :idealFor="['Lojas e Comércio', 'Prestadores de Serviço', 'Oficinas e Mecânicas', 'Consultórios']"
        idealForTitle="Perfeito para:"
        primaryButtonText="Teste grátis por 7 dias"
        primaryButtonUrl="/app/register"
        secondaryButtonText="Ver Demonstração"
        secondaryButtonUrl="#video-demo"
        secondaryButtonIcon="fa-solid fa-play"
    >
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
</x-site.hero>

    <!-- Video Modal -->
    <div
        x-show="videoModal"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click.self="videoModal = false"
        @keydown.escape.window="videoModal = false"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm p-4"
        style="display: none;"
    >
        <div
            x-show="videoModal"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-90"
            class="relative w-full max-w-5xl bg-slate-900 rounded-2xl shadow-2xl overflow-hidden"
        >
            <!-- Close Button -->
            <button
                @click="videoModal = false"
                class="absolute top-4 right-4 z-10 flex items-center justify-center w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 text-white backdrop-blur-sm transition-colors"
            >
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>

            <!-- Video Container -->
            <div class="relative" style="padding-bottom: 56.25%;">
                <iframe
                    x-show="videoModal"
                    :src="videoModal ? 'https://www.youtube.com/embed/5SufzoP1Toc?autoplay=1' : ''"
                    class="absolute top-0 left-0 w-full h-full border-0"
                    title="Demonstração - Sistema de Gestão de Clientes WSoft"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen
                ></iframe>
            </div>
        </div>
    </div>

    <!-- Script to open video modal -->
    <script>
        document.addEventListener('click', function(e) {
            // Check if clicked element is the video demo button
            if (e.target.closest('a[href="#video-demo"]')) {
                e.preventDefault();
                // Dispatch custom event to trigger modal
                window.dispatchEvent(new CustomEvent('open-video-modal'));
            }
        });
    </script>
</div>

<!-- Pain vs Gain -->
<x-site.comparison
    title="Você está perdendo clientes por falta de controle?"
    subtitle="O problema da desorganização"
    description="Empresas sem um <strong>sistema de gestão de clientes</strong> perdem oportunidades todos os dias. Veja a diferença:"
    painTitle="Cadastro Desorganizado"
    :painItems="[
        'Informações espalhadas em papéis e planilhas',
        'Esquece de dar follow-up e perde vendas',
        'Não sabe o histórico de compras de cada cliente',
        'Atendimento despersonalizado e genérico'
    ]"
    gainTitle="Gestão Profissional"
    :gainItems="[
        'Cadastro completo e organizado em um só lugar',
        'Alertas automáticos para não perder oportunidades',
        'Histórico completo de vendas e interações',
        'Atendimento personalizado e profissional'
    ]"
    gainCardBg="bg-blue-900"
    gainCardBorder="border-blue-800"
    gainTitleColor="text-emerald-400"
    gainCheckColor="text-emerald-400"
    gainBadgeBg="bg-blue-500"
    gainBadgeText="COM WSOFT"
/>

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
                        <img src="{{ asset('images/sistema/clientes/historico-cliente.png') }}" alt="Tela de Histórico do Cliente" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 group">
                        <div class="absolute inset-0 bg-emerald-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="{{ asset('images/sistema/dashboard/metricas.png') }}" alt="Relatórios de Gestão" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
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

            <!-- Step 4 -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-1">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-emerald-100 text-emerald-700 font-bold text-xl">4</span>
                        <h3 class="text-2xl font-bold text-slate-900">Visão Geral do Negócio</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Tenha o controle total na palma da mão. Acompanhe gráficos, faturamento e alertas importantes em um único painel inteligente.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Resumo financeiro diário</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Gráficos de desempenho</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Alertas de pendências</span>
                        </li>
                    </ul>
                </div>
                <div class="order-2">
                    <div class="relative group">
                        <img src="{{ asset('images/sistema/dashboard/visao-geral.png') }}" alt="Dashboard Visão Geral" class="w-full h-auto transform group-hover:scale-105 transition duration-700 rounded-xl shadow-2xl" loading="lazy" decoding="async">
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA -->
        <div class="mt-20 text-center">
            <div class="inline-block">
                <p class="text-sm font-semibold text-emerald-600 uppercase tracking-wider mb-4">Pronto para começar?</p>
                <a href="/app/register" class="inline-flex items-center gap-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-10 py-5 rounded-xl shadow-xl shadow-emerald-500/20 hover:shadow-emerald-500/40 transform hover:-translate-y-1 transition-all duration-300 text-lg">
                    <span>Teste Grátis por 7 Dias</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
                <p class="mt-4 text-sm text-slate-500">Cancele quando quiser</p>
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

        <div class="mt-16 flex flex-col md:flex-row justify-center items-center gap-4">
            <a href="/app/register" class="inline-flex items-center gap-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-8 py-4 rounded-xl shadow-lg shadow-emerald-500/20 hover:shadow-emerald-500/40 transform hover:-translate-y-0.5 transition-all duration-300">
                <span>Testar Gratuitamente</span>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
            <a
                href="https://wa.me/5551999350578"
                target="_blank"
                rel="noopener noreferrer"
                class="inline-flex items-center gap-3 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-500 hover:to-blue-400 text-white font-bold px-8 py-4 rounded-xl shadow-lg shadow-blue-500/20 hover:shadow-blue-500/40 transform hover:-translate-y-0.5 transition-all duration-300"
            >
                <i class="fa-brands fa-whatsapp text-xl"></i>
                <span>Falar com Especialista</span>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
            <p class="mt-4 text-sm text-slate-500">Tire suas dúvidas pelo WhatsApp</p>
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

        <div class="mt-16 text-center">
            <x-site.cta-inline
                title="Substitua Cadernos e Planilhas por um Sistema Profissional de Gestão de Clientes"
                description="Chega de perder informações importantes em anotações espalhadas. Centralize tudo em um sistema de gestão de clientes completo, aumente vendas e fidelize mais."
                buttonText="Falar no WhatsApp"
                buttonUrl="https://wa.me/5551999350578"
                gradient="from-blue-900 to-blue-700"
                icon="fa-solid fa-users"
            />

            <div class="mt-8 text-center">
                <a href="/app/register" class="inline-flex items-center gap-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-8 py-4 rounded-xl shadow-lg shadow-emerald-500/20 hover:shadow-emerald-500/40 transform hover:-translate-y-0.5 transition-all duration-300">
                    <span>Testar Gratuitamente</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<x-site.cta-final
    :title="'Escolha um sistema completo para gestão de clientes'"
    :description="'Comece agora com 7 dias de teste grátis. Use o melhor <strong>sistema para gestão de clientes e CRM</strong> por apenas <span class=\'text-yellow-300 font-bold\'>R$ 79,90/mês</span>.'"
    :footer="'Junte-se a centenas de empresas que usam WSoft'"
    :gradient="'bg-gradient-to-br from-blue-950 to-blue-700'"
    :textColor="'text-blue-50'"
    :highlightColor="'text-yellow-300'"
/>

@livewire('landing-registration-form', [
    'source' => 'site_gestao_clientes',
    'title' => 'Comece agora gratuitamente',
    'subtitle' => 'Junte-se a centenas de empresas que organizaram a gestão de clientes e aumentaram vendas com o WSoft.',
    'gradient' => 'from-blue-900 to-blue-700',
    'buttonText' => 'Testar por 7 Dias Grátis',
    'buttonColor' => 'blue',
    'focusColor' => 'blue'
])


<x-site.faq
    title="Perguntas Frequentes sobre Sistema de Gestão de Clientes"
    subtitle="FAQ"
    subtitleColor="text-blue-600"
    :questions="[
        [
            'question' => 'O que é um sistema de gestão de clientes e como funciona?',
            'answer' => 'Um <strong>sistema de gestão de clientes</strong> (CRM) é uma plataforma que centraliza todas as informações dos seus clientes: dados cadastrais, histórico de compras, interações e atendimentos. Com um <strong>software de gestão de clientes</strong> profissional, você melhora o relacionamento, automatiza follow-ups e aumenta as vendas com base em dados reais.'
        ],
        [
            'question' => 'Como um CRM ajuda a aumentar vendas e fidelizar clientes?',
            'answer' => 'O <strong>sistema para gestão de clientes</strong> organiza o histórico completo de cada cliente, identifica oportunidades de venda cruzada (cross-sell) e up-sell, automatiza lembretes de follow-up e permite <strong>segmentação inteligente</strong>. Com isso, você vende mais para quem já é cliente, reduz a perda de oportunidades e melhora a taxa de retenção.'
        ],
        [
            'question' => 'O WSoft é adequado para pequenas empresas e MEI?',
            'answer' => 'Sim! O WSoft foi desenvolvido especialmente para <strong>pequenas empresas, MEI e autônomos</strong>. Oferecemos um <strong>CRM simples e completo</strong> com interface intuitiva, preço acessível (R$ 79,90/mês) e todas as funcionalidades que você precisa para profissionalizar a gestão de clientes sem complexidade.'
        ],
        [
            'question' => 'Posso integrar o cadastro de clientes com vendas e financeiro?',
            'answer' => 'Sim! No WSoft, o <strong>cadastro de clientes</strong> está totalmente integrado com módulos de vendas, ordens de serviço, contas a receber, estoque e relatórios gerenciais. Tudo em um único <strong>sistema integrado de gestão</strong>, sem necessidade de múltiplas ferramentas.'
        ],
        [
            'question' => 'Posso importar minha base de clientes atual para o sistema?',
            'answer' => 'Sim! O WSoft permite <strong>importar clientes</strong> de planilhas Excel/CSV de forma rápida e fácil. Nossa equipe técnica ajuda na importação durante a implantação do sistema, garantindo que você comece com toda a base de clientes organizada e sem retrabalho.'
        ],
        [
            'question' => 'O sistema atende as exigências da LGPD para proteção de dados?',
            'answer' => 'Sim! O WSoft está em <strong>conformidade com a LGPD</strong> (Lei Geral de Proteção de Dados). Temos controle de acesso por perfil, registro de atividades (auditoria), criptografia de dados sensíveis e recursos para gerenciar consentimento e exclusão de dados dos clientes conforme a legislação.'
        ],
        [
            'question' => 'Há limite de cadastros de clientes no sistema?',
            'answer' => 'Não! Você pode cadastrar <strong>clientes ilimitados</strong> no WSoft, sem custos adicionais. Ideal para empresas em crescimento que precisam escalar a base de clientes sem se preocupar com tarifas extras ou limitações de uso.'
        ],
        [
            'question' => 'Quanto custa um sistema de gestão de clientes profissional?',
            'answer' => 'O WSoft oferece um <strong>sistema completo de gestão de clientes e CRM</strong> a partir de <strong>R$ 79,90/mês</strong>, com <strong>7 dias de teste grátis</strong> e sem necessidade de cartão de crédito. Inclui cadastro ilimitado, histórico de interações, segmentação, relatórios, integração com vendas e financeiro, e suporte técnico.'
        ]
    ]"
/>

</x-site-layout>
