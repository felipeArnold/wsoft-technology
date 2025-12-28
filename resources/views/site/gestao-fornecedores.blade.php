@php
$structuredData = [
    [
        '@context' => 'https://schema.org',
        '@type' => 'SoftwareApplication',
        'name' => 'WSoft - Sistema de Gestão de Fornecedores',
        'url' => 'https://www.wsoft.dev.br/sistema-para-gestao-de-fornecedores',
        'description' => 'Sistema completo para gestão de fornecedores e compras. Centralize cadastros, histórico de pedidos, cotações e controle total do relacionamento com seus parceiros.',
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
            'ratingCount' => '98'
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
                'name' => 'Gestão de Fornecedores',
                'item' => 'https://www.wsoft.dev.br/sistema-para-gestao-de-fornecedores'
            ]
        ]
    ],
    [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => [
            [
                '@type' => 'Question',
                'name' => 'O que é um sistema de gestão de fornecedores?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Um sistema de gestão de fornecedores é uma plataforma que centraliza todas as informações dos seus parceiros comerciais: dados cadastrais, histórico de compras, prazos de entrega e avaliações. Com ele, você melhora o poder de negociação e evita rupturas no estoque.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'Como controlar compras e fornecedores?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'O sistema organiza o histórico de cada fornecedor, permite comparar preços, controlar prazos de pagamento e entrega. Com isso, você compra melhor e reduz custos operacionais.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'O WSoft é adequado para pequenas empresas?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Sim! O WSoft foi desenvolvido especialmente para pequenas empresas. Interface simples, preço acessível e todas as funcionalidades que você precisa para profissionalizar sua gestão de compras.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'Posso integrar com o estoque?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Sim! No WSoft, o cadastro de fornecedores está totalmente integrado com a entrada de notas, controle de estoque e contas a pagar. Tudo em um único sistema.'
                ]
            ]
        ]
    ],
    [
        '@context' => 'https://schema.org',
        '@type' => 'HowTo',
        'name' => 'Como gerenciar Fornecedores com WSoft',
        'description' => 'Passo a passo para cadastrar parceiros, registrar compras e reduzir custos.',
        'step' => [
            [
                '@type' => 'HowToStep',
                'name' => 'Cadastre seus Fornecedores',
                'text' => 'Centralize os dados de contato, CNPJ, prazos de pagamento e categorias de produtos de cada fornecedor.',
                'position' => 1
            ],
            [
                '@type' => 'HowToStep',
                'name' => 'Registre as Compras',
                'text' => 'Lance as notas de entrada e mantenha o histórico de tudo que foi comprado. O sistema atualiza o estoque e o financeiro automaticamente.',
                'position' => 2
            ],
            [
                '@type' => 'HowToStep',
                'name' => 'Analise Custos',
                'text' => 'Saiba quanto você está gastando com cada fornecedor e identifique oportunidades de economia.',
                'position' => 3
            ]
        ]
    ]
];
@endphp

<x-site-layout
    :title="'Sistema de Gestão de Fornecedores | Controle de Compras | WSoft'"
    :description="'Sistema completo de gestão de fornecedores e compras para pequenas empresas. Cadastro ilimitado, histórico de pedidos, cotações e controle total. Teste grátis!'"
    :keywords="'sistema de gestão de fornecedores, controle de compras, cadastro de fornecedores, software gestão compras, SRM simples, programa cadastro fornecedores, gestão relacionamento fornecedor, controle de compras, sistema compras online'"
    :canonical="'https://www.wsoft.dev.br/sistema-para-gestao-de-fornecedores'"
    :ogTitle="'Sistema de Gestão de Fornecedores e Compras | WSoft'"
    :ogDescription="'Organize seu cadastro de fornecedores, automatize pedidos e reduza custos com o sistema mais simples e completo para pequenas empresas.'"
    :structuredData="$structuredData"
>

<!-- Hero -->
<section id="hero" class="pt-32 pb-24 bg-gradient-to-b from-blue-950 via-blue-900 to-blue-800 text-white overflow-hidden relative">
    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 30px 30px;"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-16 items-center relative z-10">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-800/50 border border-blue-700 text-blue-200 text-xs font-semibold uppercase tracking-wider mb-6">
                <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                Software Online
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold leading-tight tracking-tight">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-200 to-white">Sistema de Gestão de Fornecedores</span>
            </h1>
            <p class="mt-6 text-lg md:text-xl text-emerald-100 leading-relaxed max-w-lg">
                Centralize cadastros, histórico de compras e cotações em um único lugar. Melhore suas negociações com um <strong>sistema de gestão de fornecedores</strong> completo. <span class="text-emerald-400 font-bold block mt-2">Apenas R$ 29,90/mês.</span>
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
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Lojas e Varejo</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Indústrias</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Distribuidores</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Prestadores de Serviço</span>
                </div>
            </div>
        </div>
        <div class="relative">
            <div class="absolute -inset-4 bg-gradient-to-r from-emerald-500 to-cyan-500 rounded-full blur-3xl opacity-20 animate-pulse"></div>
            <div class="bg-white/10 border border-white/20 rounded-3xl p-8 backdrop-blur-md shadow-2xl relative">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <p class="text-sm uppercase text-emerald-200 font-semibold tracking-wider">Base de Fornecedores</p>
                        <h3 class="text-3xl font-bold mt-1">142 Parceiros</h3>
                        <div class="flex items-center gap-2 mt-2">
                            <span class="text-xs font-bold text-green-400 bg-green-400/10 px-2 py-0.5 rounded">Ativos e Verificados</span>
                        </div>
                    </div>
                    <div class="h-12 w-12 rounded-full bg-emerald-500/20 flex items-center justify-center border border-emerald-400/30">
                        <i class="fa-solid fa-truck-field text-emerald-300 text-xl"></i>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-xs text-emerald-200">Pedidos no Mês</p>
                            <span class="text-sm font-bold text-emerald-300">R$ 45.230</span>
                        </div>
                        <div class="h-2 bg-emerald-950/50 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-emerald-400 to-cyan-400 w-[75%] rounded-full"></div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                            <p class="text-xs text-emerald-200">Entregas Pendentes</p>
                            <p class="text-2xl font-bold mt-1">8</p>
                        </div>
                        <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                            <p class="text-xs text-emerald-200">Cotações</p>
                            <p class="text-2xl font-bold mt-1">12</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pain vs Gain -->
<x-site.comparison
    title="Você perde dinheiro comprando mal?"
    subtitle="O problema da desorganização"
    description="Empresas sem um <strong>sistema de gestão de fornecedores</strong> pagam mais caro e sofrem com atrasos. Veja a diferença:"
    painTitle="Compras Desorganizadas"
    :painItems="[
        'Contatos de fornecedores perdidos em agendas',
        'Não lembra o último preço pago',
        'Esquece de cobrar entregas atrasadas',
        'Paga mais caro por falta de cotação'
    ]"
    gainTitle="Compras Inteligentes"
    :gainItems="[
        'Cadastro completo de fornecedores e produtos',
        'Histórico de preços e últimas compras',
        'Controle de prazos de entrega e pagamento',
        'Melhor negociação com dados em mãos'
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
            <h2 class="mt-4 text-3xl md:text-4xl font-bold text-slate-900">Como funciona a Gestão de Fornecedores</h2>
            <p class="mt-4 text-lg text-slate-600">Organize suas compras e parceiros em poucos cliques.</p>
        </div>

        <div class="space-y-24">
            <!-- Step 1 -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 group">
                        <div class="absolute inset-0 bg-emerald-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="/images/crm/registration.png" alt="Tela de Cadastro de Fornecedores" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-emerald-100 text-emerald-700 font-bold text-xl">1</span>
                        <h3 class="text-2xl font-bold text-slate-900">Cadastre seus Fornecedores</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Centralize os dados de contato, CNPJ, prazos de pagamento e categorias de produtos de cada fornecedor.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Cadastro ilimitado de parceiros</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Vínculo com produtos fornecidos</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-1">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-emerald-100 text-emerald-700 font-bold text-xl">2</span>
                        <h3 class="text-2xl font-bold text-slate-900">Registre as Compras</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Lance as notas de entrada e mantenha o histórico de tudo que foi comprado. O sistema atualiza o estoque e o financeiro automaticamente.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Entrada de notas fácil</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Histórico de preços pagos</span>
                        </li>
                    </ul>
                </div>
                <div class="order-2">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 group">
                        <div class="absolute inset-0 bg-emerald-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="/images/crm/history.png" alt="Histórico de Compras" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 group">
                        <div class="absolute inset-0 bg-emerald-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="/images/crm/reports.png" alt="Relatórios de Compras" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-emerald-100 text-emerald-700 font-bold text-xl">3</span>
                        <h3 class="text-2xl font-bold text-slate-900">Analise Custos</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Saiba quanto você está gastando com cada fornecedor e identifique oportunidades de economia.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Relatórios de compras por período</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Ranking de fornecedores</span>
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
            <p class="text-sm font-semibold text-emerald-600 uppercase tracking-[0.3em]">Benefícios</p>
            <h2 class="mt-4 text-3xl md:text-4xl font-bold">Por que organizar seus fornecedores?</h2>
            <p class="mt-4 text-lg text-slate-600">Gestão eficiente de compras gera lucro</p>
        </div>
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-hand-holding-dollar text-emerald-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Reduza Custos</h3>
                    <p class="mt-3 text-slate-600">Compare preços e negocie melhor tendo o histórico de compras sempre à mão.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-boxes-stacked text-blue-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Evite Rupturas</h3>
                    <p class="mt-3 text-slate-600">Controle prazos de entrega e saiba quando repor o estoque para não perder vendas.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-file-invoice-dollar text-purple-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Financeiro Integrado</h3>
                    <p class="mt-3 text-slate-600">As compras geram automaticamente contas a pagar, facilitando o fluxo de caixa.</p>
                </div>
            </article>
        </div>
    </div>
</section>

<!-- CTA Section -->
<x-site.cta-final
    :title="'Escolha um sistema completo para gestão de fornecedores'"
    :description="'Comece agora com 7 dias de teste grátis. Use o melhor <strong>sistema para controle de compras e fornecedores</strong> por apenas <span class=\'text-yellow-300 font-bold\'>R$ 29,90/mês</span>.'"
    :footer="'Junte-se a centenas de empresas que usam WSoft'"
    :gradient="'bg-gradient-to-br from-emerald-600 to-blue-600'"
    :textColor="'text-emerald-50'"
    :highlightColor="'text-yellow-300'"
/>


<!-- FAQ -->
<section id="faq" class="py-20 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <p class="text-sm font-semibold text-emerald-600 uppercase tracking-[0.3em]">FAQ</p>
            <h2 class="mt-4 text-3xl font-bold">Dúvidas Frequentes</h2>
        </div>
        <div class="space-y-4">
            <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    Posso cadastrar quantos fornecedores?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Ilimitado! Você pode cadastrar todos os seus parceiros sem custo adicional.</p>
            </details>
            <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    O sistema emite pedido de compra?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Sim, você pode gerar pedidos de compra e enviar por e-mail ou WhatsApp para seus fornecedores.</p>
            </details>
        </div>
    </div>
</section>

</x-site-layout>
