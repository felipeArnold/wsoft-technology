@php
$structuredData = [
    [
        '@context' => 'https://schema.org',
        '@type' => 'SoftwareApplication',
        'name' => 'WSoft - Sistema para Funilaria e Pintura',
        'url' => 'https://www.wsoft.dev.br/landing/funilaria',
        'description' => 'Sistema de gestão completo para funilarias e pintura. Controle de OS, financeiro, estoque e cadastro de clientes.',
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
        'name' => 'WSoft Tecnologia - Sistema de Gestão para Funilarias',
        'image' => 'https://www.wsoft.dev.br/images/logo.png',
        'description' => 'Sistema de gestão completo para oficinas mecânicas e auto centers. Controle financeiro, estoque e OS.',
        'url' => 'https://www.wsoft.dev.br/landing/funilaria',
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
                'name' => 'Sistema para Funilaria',
                'item' => 'https://www.wsoft.dev.br/landing/funilaria'
            ]
        ]
    ],
    [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => [
            [
                '@type' => 'Question',
                'name' => 'O sistema emite Ordem de Serviço (OS)?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Sim! O WSoft permite criar ordens de serviço completas, com cadastro de peças, mão de obra, fotos e status de acompanhamento.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'Consigo controlar o financeiro da oficina?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Com certeza. O sistema possui controle completo de contas a pagar e receber, fluxo de caixa e relatórios de lucratividade.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'Tem controle de estoque de peças?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Sim, você pode controlar o estoque de peças, definir estoque mínimo e vincular produtos diretamente nas Ordens de Serviço.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'O sistema envia mensagens para clientes?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Sim, você pode enviar orçamentos e avisos sobre o status da OS diretamente pelo WhatsApp para seus clientes.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'Quanto custa o sistema para oficina?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'O WSoft custa apenas R$ 29,90 por mês no plano vitalício. Sem taxa de adesão e com todas as funcionalidades liberadas.'
                ]
            ]
        ]
    ],
    [
        '@context' => 'https://schema.org',
        '@type' => 'HowTo',
        'name' => 'Como gerenciar Funilaria e Pintura com WSoft',
        'description' => 'Passo a passo para organizar sua funilaria, das Ordens de Serviço ao financeiro.',
        'step' => [
            [
                '@type' => 'HowToStep',
                'name' => 'Crie a Ordem de Serviço',
                'text' => 'Registre a entrada do veículo, adicione fotos do estado inicial, relate o defeito e inicie o atendimento com profissionalismo.',
                'position' => 1
            ],
            [
                '@type' => 'HowToStep',
                'name' => 'Adicione Peças e Serviços',
                'text' => 'Lance as peças utilizadas (com baixa automática no estoque) e a mão de obra. O sistema calcula o total na hora.',
                'position' => 2
            ],
            [
                '@type' => 'HowToStep',
                'name' => 'Receba e Fidelize',
                'text' => 'Envie a OS pronta pelo WhatsApp, receba o pagamento e mantenha o histórico do cliente para futuras revisões.',
                'position' => 3
            ]
        ]
    ]
];
@endphp

<x-site-layout
    :title="'Sistema para Funilaria e Pintura | Gestão e OS | WSoft'"
    :description="'Sistema de gestão para oficinas mecânicas com OS digital, controle financeiro, fluxo de caixa e cadastro de clientes e fornecedores.'"
    :keywords="'sistema oficina mecanica, software oficina, ordem de serviço oficina, gestão oficina, programa para oficina, controle financeiro oficina, sistema para auto center'"
    :canonical="'https://www.wsoft.dev.br/landing/funilaria'"
    :ogTitle="'Sistema de Gestão para Oficinas Mecânicas | WSoft'"
    :ogDescription="'Organize sua oficina, controle OS e aumente seus lucros com o sistema mais simples e completo do mercado.'"
    :structuredData="$structuredData"
>

<!-- Hero -->
<section id="hero" class="pt-32 pb-24 bg-gradient-to-b from-blue-950 via-blue-900 to-blue-800 text-white overflow-hidden relative">
    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 30px 30px;"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-16 items-center relative z-10">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-800/50 border border-blue-700 text-blue-200 text-xs font-semibold uppercase tracking-wider mb-6">
                <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                Sistema para Funilaria
            </div>
            <h1 class="text-4xl md:text-5xl font-extrabold leading-tight tracking-tight">
                Sistema de Gestão para <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-200 to-white">Funilaria e Pintura</span>
            </h1>
            <p class="mt-6 text-lg md:text-xl text-emerald-100 leading-relaxed max-w-lg">
                Ordem de serviço digital, controle financeiro e estoque de peças. O sistema ideal para mecânicas e auto centers.
            </p>
            <div class="mt-10 flex flex-col sm:flex-row gap-4">
                <a href="#cadastro" class="inline-flex justify-center items-center rounded-xl bg-white text-emerald-700 font-bold px-8 py-4 shadow-lg shadow-white/30 hover:bg-emerald-50 hover:-translate-y-1 transition transform duration-200">
                    Teste grátis por 7 dias
                    <i class="fa-solid fa-arrow-right ml-2"></i>
                </a>
                <a href="#como-funciona" class="inline-flex justify-center items-center rounded-xl border border-white/30 text-white font-semibold px-8 py-4 hover:bg-white/10 transition backdrop-blur-sm">
                    <i class="fa-solid fa-play mr-2"></i>
                    Como Funciona
                </a>
            </div>
            <div class="mt-10 pt-8 border-t border-white/10">
                <p class="text-sm text-emerald-200 mb-4">Ideal para:</p>
                <div class="flex flex-wrap gap-3 text-sm font-medium text-white">
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Oficinas Mecânicas</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Auto Centers</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Funilarias</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Troca de Óleo</span>
                </div>
            </div>
        </div>
        <div class="relative">
            <div class="absolute -inset-4 bg-gradient-to-r from-emerald-500 to-cyan-500 rounded-full blur-3xl opacity-20 animate-pulse"></div>
            <div class="bg-white/10 border border-white/20 rounded-3xl p-8 backdrop-blur-md shadow-2xl relative">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <p class="text-sm uppercase text-emerald-200 font-semibold tracking-wider">Faturamento Hoje</p>
                        <h3 class="text-3xl font-bold mt-1">R$ 3.850,00</h3>
                        <div class="flex items-center gap-2 mt-2">
                            <span class="text-xs font-bold text-green-400 bg-green-400/10 px-2 py-0.5 rounded">+22% vs ontem</span>
                        </div>
                    </div>
                    <div class="h-12 w-12 rounded-full bg-emerald-500/20 flex items-center justify-center border border-emerald-400/30">
                        <i class="fa-solid fa-wrench text-emerald-300 text-xl"></i>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-xs text-emerald-200">Meta Mensal</p>
                            <span class="text-sm font-bold text-emerald-300">88% Atingida</span>
                        </div>
                        <div class="h-2 bg-emerald-950/50 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-emerald-400 to-cyan-400 w-[88%] rounded-full"></div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                            <p class="text-xs text-emerald-200">OS Abertas</p>
                            <p class="text-2xl font-bold mt-1">12</p>
                        </div>
                        <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                            <p class="text-xs text-emerald-200">Ticket Médio</p>
                            <p class="text-2xl font-bold mt-1">R$ 420</p>
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
            <h2 class="mt-4 text-3xl md:text-4xl font-bold text-slate-900">Como funciona o Sistema para Oficina</h2>
            <p class="mt-4 text-lg text-slate-600">Simples de usar, feito para o dia a dia corrido da mecânica.</p>
        </div>

        <div class="space-y-24">
            <!-- Step 1 -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 group">
                        <div class="absolute inset-0 bg-emerald-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="{{ asset('images/sistema/os/os-digital.png') }}" alt="Tela de Ordem de Serviço" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-emerald-100 text-emerald-700 font-bold text-xl">1</span>
                        <h3 class="text-2xl font-bold text-slate-900">Crie a Ordem de Serviço</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Registre a entrada do veículo, adicione fotos do estado inicial, relate o defeito e inicie o atendimento com profissionalismo.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Checklist de entrada</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Fotos ilimitadas</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Cadastro rápido de cliente e veículo</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-1">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-emerald-100 text-emerald-700 font-bold text-xl">2</span>
                        <h3 class="text-2xl font-bold text-slate-900">Adicione Peças e Serviços</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Lance as peças utilizadas (com baixa automática no estoque) e a mão de obra. O sistema calcula o total na hora.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Controle de estoque de peças</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Cadastro de serviços padrão</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Valor de custo e venda</span>
                        </li>
                    </ul>
                </div>
                <div class="order-2">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 group">
                        <div class="absolute inset-0 bg-emerald-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="{{ asset('images/sistema/financeiro/faturamento.png') }}" alt="Tela de Financeiro" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 group">
                        <div class="absolute inset-0 bg-emerald-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="{{ asset('images/sistema/os/whatsapp-share.png') }}" alt="Envio via WhatsApp" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-emerald-100 text-emerald-700 font-bold text-xl">3</span>
                        <h3 class="text-2xl font-bold text-slate-900">Receba e Fidelize</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Envie a OS pronta pelo WhatsApp, receba o pagamento e mantenha o histórico do cliente para futuras revisões.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Envio PDF no WhatsApp</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Controle de garantia</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Lembretes de revisão</span>
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
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 group">
                        <div class="absolute inset-0 bg-emerald-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="{{ asset('images/sistema/dashboard/visao-geral.png') }}" alt="Dashboard Visão Geral" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
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

<!-- Funcionalidades Completas -->
<section id="funcionalidades" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <p class="text-sm font-semibold text-emerald-600 uppercase tracking-[0.3em]">Funcionalidades</p>
            <h2 class="mt-4 text-3xl md:text-4xl font-bold">Tudo que sua oficina precisa</h2>
            <p class="mt-4 text-lg text-slate-600">Da OS ao financeiro, controle total do seu negócio automotivo</p>
        </div>
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            <article class="group rounded-2xl border border-slate-100 bg-slate-50 p-6 shadow-sm hover:shadow-lg hover:border-emerald-200 transition-all duration-300">
                <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-emerald-600 transition-colors duration-300">
                    <i class="fa-solid fa-file-invoice text-emerald-600 group-hover:text-white text-xl transition-colors duration-300"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Ordem de Serviço</h3>
                <p class="text-sm text-slate-600 leading-relaxed">Crie OS completas com placa, modelo, peças, serviços, defeito e solução. Imprima ou envie PDF.</p>
            </article>
            <article class="group rounded-2xl border border-slate-100 bg-slate-50 p-6 shadow-sm hover:shadow-lg hover:border-blue-200 transition-all duration-300">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-blue-600 transition-colors duration-300">
                    <i class="fa-solid fa-wrench text-blue-600 group-hover:text-white text-xl transition-colors duration-300"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Controle de Estoque</h3>
                <p class="text-sm text-slate-600 leading-relaxed">Cadastro de peças com preço de compra e venda. Baixa automática ao inserir na OS.</p>
            </article>
            <article class="group rounded-2xl border border-slate-100 bg-slate-50 p-6 shadow-sm hover:shadow-lg hover:border-purple-200 transition-all duration-300">
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-purple-600 transition-colors duration-300">
                    <i class="fa-solid fa-money-bill-transfer text-purple-600 group-hover:text-white text-xl transition-colors duration-300"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Gestão Financeira</h3>
                <p class="text-sm text-slate-600 leading-relaxed">Contas a pagar e receber, fluxo de caixa diário e mensal. Saiba onde vai cada centavo.</p>
            </article>
            <article class="group rounded-2xl border border-slate-100 bg-slate-50 p-6 shadow-sm hover:shadow-lg hover:border-orange-200 transition-all duration-300">
                <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-orange-600 transition-colors duration-300">
                    <i class="fa-solid fa-car text-orange-600 group-hover:text-white text-xl transition-colors duration-300"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Cadastro de Veículos</h3>
                <p class="text-sm text-slate-600 leading-relaxed">Histórico completo por placa. Saiba todas as revisões que o veículo já fez na sua oficina.</p>
            </article>
            <article class="group rounded-2xl border border-slate-100 bg-slate-50 p-6 shadow-sm hover:shadow-lg hover:border-red-200 transition-all duration-300">
                <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-red-600 transition-colors duration-300">
                    <i class="fa-brands fa-whatsapp text-red-600 group-hover:text-white text-xl transition-colors duration-300"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Avisos no WhatsApp</h3>
                <p class="text-sm text-slate-600 leading-relaxed">Notifique seu cliente quando o carro estiver pronto ou envie orçamentos com um clique.</p>
            </article>
            <article class="group rounded-2xl border border-slate-100 bg-slate-50 p-6 shadow-sm hover:shadow-lg hover:border-teal-200 transition-all duration-300">
                <div class="w-12 h-12 bg-teal-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-teal-600 transition-colors duration-300">
                    <i class="fa-solid fa-calendar-check text-teal-600 group-hover:text-white text-xl transition-colors duration-300"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Agenda de Serviços</h3>
                <p class="text-sm text-slate-600 leading-relaxed">Organize e agende os serviços. Evite filas e melhore o atendimento na sua oficina.</p>
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

<!-- Benefícios -->
<section id="vantagens" class="py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <p class="text-sm font-semibold text-emerald-600 uppercase tracking-[0.3em]">Vantagens</p>
            <h2 class="mt-4 text-3xl md:text-4xl font-bold">Por que escolher o WSoft?</h2>
            <p class="mt-4 text-lg text-slate-600">Simples, prático e eficiente</p>
        </div>
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-check-circle text-emerald-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Fácil de Usar</h3>
                    <p class="mt-3 text-slate-600">Interface intuitiva, sem complicações. Você aprende a usar em minutos.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-cloud text-blue-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">100% Online</h3>
                    <p class="mt-3 text-slate-600">Acesse de onde estiver: computador, celular ou tablet. Seus dados sempre seguros.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-headset text-orange-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Suporte Humanizado</h3>
                    <p class="mt-3 text-slate-600">Equipe pronta para te ajudar via WhatsApp. Nada de robôs, fale com gente.</p>
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

<!-- Price Section -->
<section id="precos" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <p class="text-sm font-semibold text-emerald-600 uppercase tracking-[0.3em]">Planos</p>
            <h2 class="mt-4 text-3xl md:text-4xl font-bold text-slate-900">Preço justo para sua oficina</h2>
            <p class="mt-4 text-lg text-slate-600">Comece grátis, sem cartão de crédito.</p>
        </div>

        <div class="max-w-md mx-auto">
            <div class="rounded-3xl bg-white border-2 border-emerald-500 shadow-2xl p-8 relative overflow-hidden">
                <div class="absolute top-0 right-0 bg-emerald-500 text-white text-xs font-bold px-4 py-1 rounded-bl-xl">MAIS POPULAR</div>
                <h3 class="text-2xl font-bold text-slate-900">{{ $product_name ?? 'Plano Profissional' }}</h3>
                <p class="mt-2 text-slate-500">{{ $product_description ?? 'Acesso completo a todas as ferramentas' }}</p>

                <div class="my-6">
                    <div class="flex items-baseline justify-center">
                        <span class="text-5xl font-extrabold text-slate-900">R$ {{ $price_formatted ?? '29,90' }}</span>
                        <span class="text-slate-500 ml-2">/{{ $interval_label ?? 'mês' }}</span>
                    </div>
                </div>

                <ul class="space-y-4 mb-8">
                    <li class="flex items-center gap-3 text-slate-700">
                        <i class="fa-solid fa-check text-emerald-500"></i>
                        <span>Emissão de OS Ilimitada</span>
                    </li>
                    <li class="flex items-center gap-3 text-slate-700">
                        <i class="fa-solid fa-check text-emerald-500"></i>
                        <span>Controle de Estoque e Financeiro</span>
                    </li>
                     <li class="flex items-center gap-3 text-slate-700">
                        <i class="fa-solid fa-check text-emerald-500"></i>
                        <span>Cadastro de Clientes e Veículos</span>
                    </li>
                    <li class="flex items-center gap-3 text-slate-700">
                        <i class="fa-solid fa-check text-emerald-500"></i>
                        <span>Envio via WhatsApp</span>
                    </li>
                    <li class="flex items-center gap-3 text-slate-700">
                        <i class="fa-solid fa-check text-emerald-500"></i>
                        <span>Suporte Prioritário</span>
                    </li>
                </ul>

                <a href="#cadastro" class="block w-full py-4 px-6 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-center rounded-xl transition duration-200">
                    Começar Teste Grátis
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Cadastro (Form Section) -->
<section id="cadastro" class="py-20 bg-slate-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
            <div class="grid md:grid-cols-2">
                <div class="p-10 bg-gradient-to-br from-emerald-600 to-teal-700 text-white flex flex-col justify-center">
                    <h3 class="text-2xl font-bold mb-4">Crie sua conta grátis</h3>
                    <p class="mb-6 opacity-90">Junte-se a mais de 500 oficinas que já modernizaram sua gestão com o WSoft.</p>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-center gap-2"><i class="fa-solid fa-check"></i> 7 dias grátis</li>
                        <li class="flex items-center gap-2"><i class="fa-solid fa-check"></i> Sem cartão de crédito</li>
                        <li class="flex items-center gap-2"><i class="fa-solid fa-check"></i> Cancelamento fácil</li>
                    </ul>
                </div>
                <div class="p-10">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <ul class="list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('landing.funilaria.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="source" value="landing_funilaria">
                        <div>
                            <label for="name" class="block text-sm font-medium text-slate-700 mb-1">Seu Nome</label>
                            <input type="text" name="name" id="name" required class="w-full rounded-lg border-slate-300 focus:border-emerald-500 focus:ring-emerald-500" placeholder="Ex: João Silva" value="{{ old('name') }}">
                        </div>
                        <div>
                            <label for="company_name" class="block text-sm font-medium text-slate-700 mb-1">Nome da Oficina</label>
                            <input type="text" name="company_name" id="company_name" required class="w-full rounded-lg border-slate-300 focus:border-emerald-500 focus:ring-emerald-500" placeholder="Ex: Auto Center Silva" value="{{ old('company_name') }}">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-slate-700 mb-1">E-mail</label>
                            <input type="email" name="email" id="email" required class="w-full rounded-lg border-slate-300 focus:border-emerald-500 focus:ring-emerald-500" placeholder="seu@email.com" value="{{ old('email') }}">
                        </div>
                        <div>
                            <label for="phone" class="block text-sm font-medium text-slate-700 mb-1">WhatsApp</label>
                            <input type="tel" name="phone" id="phone" required class="w-full rounded-lg border-slate-300 focus:border-emerald-500 focus:ring-emerald-500" placeholder="(11) 99999-9999" value="{{ old('phone') }}">
                        </div>
                        <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 px-4 rounded-xl transition duration-200">
                            Cadastrar Grátis
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<x-site.cta-final
    :title="'Escolha um sistema completo para gestão de funilaria e pintura'"
    :description="'Comece agora com 7 dias de teste grátis. Use o melhor <strong>sistema para funilaria e pintura</strong> por apenas <span class=\'text-yellow-300 font-bold\'>R$ 29,90/mês</span>.'"
    :footer="'Junte-se a centenas de funilarias que usam WSoft'"
    :gradient="'bg-gradient-to-br from-emerald-600 to-blue-600'"
    :textColor="'text-emerald-50'"
    :highlightColor="'text-yellow-300'"
/>


<!-- FAQ -->
<section id="faq_section" class="py-20 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <p class="text-sm font-semibold text-emerald-600 uppercase tracking-[0.3em]">Dúvidas</p>
            <h2 class="mt-4 text-3xl font-bold">Perguntas Frequentes</h2>
        </div>
        <div class="space-y-4">
            <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    O sistema emite Ordem de Serviço (OS)?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Sim! O WSoft permite criar ordens de serviço completas, com cadastro de peças, mão de obra, fotos e status de acompanhamento.</p>
            </details>
            <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    Consigo controlar o financeiro da oficina?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Com certeza. O sistema possui controle completo de contas a pagar e receber, fluxo de caixa e relatórios de lucratividade.</p>
            </details>
            <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    Tem controle de estoque de peças?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Sim, você pode controlar o estoque de peças, definir estoque mínimo e vincular produtos diretamente nas Ordens de Serviço.</p>
            </details>
            <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    O sistema envia mensagens para clientes?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Sim, você pode enviar orçamentos e avisos sobre o status da OS diretamente pelo WhatsApp para seus clientes.</p>
            </details>
            <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    Quanto custa o sistema para oficina?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">O WSoft custa apenas R$ 29,90 por mês no plano vitalício. Sem taxa de adesão e com todas as funcionalidades liberadas.</p>
            </details>
        </div>
    </div>
</section>

<!-- Social Proof -->
<section class="py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <p class="text-sm font-semibold text-emerald-600 uppercase tracking-[0.3em]">Depoimentos</p>
            <h2 class="mt-4 text-3xl font-bold">Quem usa aprova</h2>
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
                <p class="text-sm text-slate-600 italic">"Organizou minha oficina. Antes eu perdia muito papel, agora tenho tudo no sistema e ainda ganho tempo."</p>
                <div class="mt-4 font-semibold">José Almeida</div>
                <div class="text-sm text-slate-500">Mecânica Almeida</div>
            </article>
            <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                <div class="flex gap-1 text-yellow-400 mb-4">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <p class="text-sm text-slate-600 italic">"O controle financeiro é excelente. Consigo ver exatamente onde estou ganhando e onde estou gastando."</p>
                <div class="mt-4 font-semibold">Marcos Silva</div>
                <div class="text-sm text-slate-500">Auto Center Silva</div>
            </article>
            <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                <div class="flex gap-1 text-yellow-400 mb-4">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <p class="text-sm text-slate-600 italic">"Gosto muito do cadastro de veículos e do envio pelo WhatsApp. Passa muito profissionalismo para o cliente."</p>
                <div class="mt-4 font-semibold">Ricardo Oliveira</div>
                <div class="text-sm text-slate-500">Oficina Prime</div>
            </article>
        </div>
    </div>
</section>

</x-site-layout>
