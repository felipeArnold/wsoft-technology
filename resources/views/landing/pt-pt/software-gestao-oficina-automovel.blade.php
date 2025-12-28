@php
$structuredData = [
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
                'name' => 'Oficina Automóvel PT',
                'item' => 'https://www.wsoft.dev.br/pt-pt/software-gestao-oficina-automovel'
            ]
        ]
    ],
    [
        '@context' => 'https://schema.org',
        '@type' => 'SoftwareApplication',
        'name' => 'WSoft - Software de Gestão para Oficina Automóvel',
        'url' => 'https://www.wsoft.dev.br/pt-pt/software-gestao-oficina-automovel',
        'description' => 'Software de gestão completo para oficinas automóveis em Portugal. Controlo de ordens de serviço, controlo financeiro, stock de peças e emissão de faturas.',
        'operatingSystem' => 'Web',
        'applicationCategory' => 'BusinessApplication',
        'offers' => [
            '@type' => 'Offer',
            'price' => '9.90',
            'priceCurrency' => 'EUR',
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
        'name' => 'WSoft Tecnologia - Software para Oficina Automóvel',
        'image' => 'https://www.wsoft.dev.br/images/logo.png',
        'description' => 'Software de gestão completo para oficinas automóveis em Portugal. Controlo financeiro, ordem de serviço digital e stock de peças.',
        'url' => 'https://www.wsoft.dev.br/pt-pt/software-gestao-oficina-automovel',
        'priceRange' => '$$',
        'address' => [
            '@type' => 'PostalAddress',
            'addressCountry' => 'PT'
        ],
        'aggregateRating' => [
            '@type' => 'AggregateRating',
            'ratingValue' => '4.9',
            'ratingCount' => '145'
        ]
    ],
    [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => [
            [
                '@type' => 'Question',
                'name' => 'O que é um software de gestão para oficina automóvel?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Um software de gestão para oficina automóvel é um sistema que ajuda a organizar e controlar todos os processos da oficina: ordens de serviço, controlo financeiro, stock de peças, registo de clientes e veículos.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'Como funciona a ordem de serviço digital?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'A ordem de serviço digital permite criar OS completas no sistema, com dados do cliente, veículo, defeito relatado, peças utilizadas e serviços executados. Pode adicionar fotos, gerar PDF e enviar por WhatsApp.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'O software faz controlo financeiro da oficina?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Sim! O WSoft possui controlo financeiro completo com contas a pagar e receber, fluxo de caixa diário e mensal, relatórios de rentabilidade e controlo de incumprimento.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'Como funciona o controlo de stock de peças?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Regista as peças com preço de custo e venda. Quando adiciona uma peça na ordem de serviço, o sistema dá baixa automática no stock.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'O sistema emite faturas para oficina automóvel?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Sim, o WSoft possui integração para emissão de faturas eletrónicas. Pode emitir faturas diretamente da ordem de serviço.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'Quanto custa o software para oficina automóvel?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'O WSoft custa apenas 9,90€ por mês. Sem taxa de adesão, sem letras pequenas. Todas as funcionalidades estão incluídas: ordem de serviço, controlo financeiro, stock, registo de clientes e suporte via WhatsApp.'
                ]
            ]
        ]
    ],
    [
        '@context' => 'https://schema.org',
        '@type' => 'HowTo',
        'name' => 'Como gerir a sua Oficina Automóvel com WSoft',
        'description' => 'Passo a passo para emitir OS, controlar peças e fidelizar clientes.',
        'step' => [
            [
                '@type' => 'HowToStep',
                'name' => 'Crie a Ordem de Serviço',
                'text' => 'Registe a entrada do veículo, adicione fotos do estado inicial, relate o defeito e inicie o atendimento com profissionalismo.',
                'position' => 1
            ],
            [
                '@type' => 'HowToStep',
                'name' => 'Adicione Peças e Serviços',
                'text' => 'Lance as peças utilizadas (com baixa automática no stock) e a mão de obra. O sistema calcula o total na hora.',
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
    :title="'Software de Gestão para Oficina Automóvel em Portugal | WSoft'"
    :description="'Programa de gestão para oficinas automóveis em Portugal. Controle clientes, orçamentos e faturação de forma simples. Teste grátis por 7 dias!'"
    :keywords="'software de gestão para oficina automóvel, software para oficina automóvel em Portugal, sistema para oficina automóvel, programa de controlo financeiro para oficina automóvel, software para gestão de oficina automóvel, faturação para oficina automóvel'"
    :canonical="'https://www.wsoft.dev.br/pt-pt/software-gestao-oficina-automovel'"
    :ogTitle="'Software de Gestão para Oficina Automóvel em Portugal | WSoft'"
    :ogDescription="'Controlo financeiro, ordens de serviço e stock de peças num só sistema. Teste grátis por 7 dias. Apenas 9,90€/mês'"
    :structuredData="$structuredData"
>

@push('head')
<!-- Hreflang Tags -->
<link rel="alternate" hreflang="pt-PT" href="https://www.wsoft.dev.br/pt-pt/software-gestao-oficina-automovel" />
<link rel="alternate" hreflang="pt-BR" href="https://www.wsoft.dev.br/software-gestao-oficina-mecanica" />
<link rel="alternate" hreflang="x-default" href="https://www.wsoft.dev.br/software-gestao-oficina-mecanica" />
@endpush

<!-- Hero -->
<section id="hero" class="pt-32 pb-24 bg-gradient-to-b from-blue-950 via-blue-900 to-blue-800 text-white overflow-hidden relative">
    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 30px 30px;"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-16 items-center relative z-10">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-800/50 border border-blue-700 text-blue-200 text-xs font-semibold uppercase tracking-wider mb-6">
                <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                Sistema para Oficina Automóvel
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold leading-tight tracking-tight">
                Software de Gestão para <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-200 to-white">Oficina Automóvel em Portugal</span>
            </h1>
            <p class="mt-6 text-lg md:text-xl text-emerald-100 leading-relaxed max-w-lg">
                Controlo financeiro completo, ordem de serviço digital e gestão de stock de peças. Tudo o que a sua oficina automóvel em Portugal precisa para crescer. <span class="text-emerald-400 font-bold block mt-2">Teste grátis por 7 dias. Apenas 9,90€/mês.</span>
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
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Oficinas Automóveis</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Auto Centros</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Bate-Chapa</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Mudança de Óleo</span>
                </div>
            </div>
        </div>
        <div class="relative">
            <div class="absolute -inset-4 bg-gradient-to-r from-emerald-500 to-cyan-500 rounded-full blur-3xl opacity-20 animate-pulse"></div>
            <div class="bg-white/10 border border-white/20 rounded-3xl p-8 backdrop-blur-md shadow-2xl relative">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <p class="text-sm uppercase text-emerald-200 font-semibold tracking-wider">Faturação Hoje</p>
                        <h3 class="text-3xl font-bold mt-1">€ 1.250,00</h3>
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
                            <p class="text-2xl font-bold mt-1">€ 140</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Introduction Section -->
<section class="py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <p class="text-sm font-semibold text-emerald-600 uppercase tracking-[0.3em]">Solução Completa</p>
            <h2 class="mt-4 text-3xl md:text-4xl font-bold text-slate-900">A gestão da sua oficina automóvel num só lugar</h2>
            <p class="mt-4 text-lg text-slate-600">Centralize todos os processos e ganhe tempo para focar no que realmente importa</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8 mb-12">
            <div class="bg-white rounded-2xl border border-slate-200 p-8 shadow-sm hover:shadow-lg transition-all duration-300">
                <div class="w-14 h-14 bg-emerald-100 rounded-xl flex items-center justify-center mb-6">
                    <i class="fa-solid fa-file-invoice text-emerald-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">Gestão Simplificada</h3>
                <p class="text-slate-600 leading-relaxed">
                    Se é dono de uma oficina automóvel em Portugal, sabe como é desafiador gerir ordens de serviço, controlar peças do stock, acompanhar o financeiro e ainda lidar com clientes. <strong>Um software de gestão para oficina automóvel resolve isso.</strong>
                </p>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 p-8 shadow-sm hover:shadow-lg transition-all duration-300">
                <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center mb-6">
                    <i class="fa-solid fa-layer-group text-blue-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">Sistema Completo</h3>
                <p class="text-slate-600 leading-relaxed">
                    O WSoft é um <strong>programa para oficina automóvel</strong> completo que centraliza tudo num único sistema: emissão de ordens de serviço digitais, controlo financeiro sem folhas de cálculo, gestão de stock de peças com baixa automática e até emissão de faturas.
                </p>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 p-8 shadow-sm hover:shadow-lg transition-all duration-300">
                <div class="w-14 h-14 bg-purple-100 rounded-xl flex items-center justify-center mb-6">
                    <i class="fa-solid fa-rocket text-purple-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">Fácil de Usar</h3>
                <p class="text-slate-600 leading-relaxed">
                    O nosso <strong>sistema para oficina automóvel</strong> foi desenvolvido para ser simples e prático. Mesmo quem nunca usou um software consegue começar a usar no mesmo dia. E o melhor: testa grátis por 7 dias, sem precisar de cadastrar cartão de crédito.
                </p>
            </div>
        </div>

        <div class="bg-gradient-to-r from-emerald-600 to-teal-600 rounded-2xl p-8 md:p-12 text-white text-center shadow-xl">
            <div class="max-w-3xl mx-auto">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/20 border border-white/30 text-white text-sm font-semibold uppercase tracking-wider mb-6">
                    <i class="fa-solid fa-gift"></i>
                    <span>Teste Grátis</span>
                </div>
                <h3 class="text-2xl md:text-3xl font-bold mb-4">Comece a organizar a sua oficina hoje mesmo</h3>
                <p class="text-lg text-emerald-50 mb-6">
                    Teste todas as funcionalidades por 7 dias, sem compromisso. Depois, apenas <span class="font-bold text-yellow-300">9,90€/mês</span> para ter controlo total da sua oficina automóvel.
                </p>
                <a href="#cadastro" class="inline-flex items-center gap-3 bg-white text-emerald-700 font-bold px-8 py-4 rounded-xl shadow-lg hover:bg-emerald-50 transform hover:-translate-y-0.5 transition-all duration-300">
                    <span>Começar Teste Grátis</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Pain vs Gain -->
<x-site.comparison
    title="A sua oficina automóvel está a perder dinheiro?"
    subtitle="O custo da desorganização"
    description="Sem um software de gestão para oficina automóvel, perde controlo do financeiro, stock e clientes. Veja a diferença:"
    painTitle="Gestão Manual"
    :painItems="[
        'OS de papel que desaparecem ou rasgam',
        'Esquece de cobrar peças usadas na OS',
        'Não sabe quem deve (Incumprimento alto)',
        'Mistura dinheiro da oficina com pessoal'
    ]"
    gainTitle="Oficina Organizada"
    :gainItems="[
        'OS digital profissional e organizada',
        'Controlo automático de stock de peças',
        'Controlo financeiro e cobrança automática',
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
            <h2 class="mt-4 text-3xl md:text-4xl font-bold text-slate-900">Como funciona o nosso software para oficina automóvel</h2>
            <p class="mt-4 text-lg text-slate-600">Simples de usar, feito para o dia a dia agitado da sua oficina.</p>
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
                        <h3 class="text-2xl font-bold text-slate-900">Crie Ordens de Serviço Digitais</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Registe cada entrada de veículo com ordem de serviço profissional. Adicione fotos, descreva o defeito e acompanhe todo o processo de forma organizada. Acabe com papéis perdidos e OS rasgadas.
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
                            <span>Registo rápido de cliente e veículo</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-1">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-emerald-100 text-emerald-700 font-bold text-xl">2</span>
                        <h3 class="text-2xl font-bold text-slate-900">Controle Stock e Calcule Valores</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Lance peças e serviços direto na OS. O software para gestão de oficina automóvel dá baixa automática no stock e calcula o valor total na hora. Nunca mais esqueça de cobrar uma peça.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Controlo de stock de peças</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Registo de serviços padrão</span>
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
                        <h3 class="text-2xl font-bold text-slate-900">Finalize e Fidelize Clientes</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Envie a OS pelo WhatsApp, receba o pagamento e mantenha histórico completo do veículo. Os seus clientes vão lembrar-se da sua oficina quando precisarem de manutenção novamente.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Envio PDF no WhatsApp</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Controlo de garantia</span>
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
                        <h3 class="text-2xl font-bold text-slate-900">Acompanhe o Controlo Financeiro</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Tenha visão completa do financeiro da sua oficina. Veja faturação, contas a pagar e receber, fluxo de caixa e muito mais. Um verdadeiro programa de controlo financeiro para oficina automóvel.
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
            <p class="text-sm font-semibold text-emerald-600 uppercase tracking-[0.3em]">Recursos Completos</p>
            <h2 class="mt-4 text-3xl md:text-4xl font-bold">Funcionalidades do software para oficina automóvel</h2>
            <p class="mt-4 text-lg text-slate-600">Da ordem de serviço ao controlo financeiro, tudo integrado num só lugar</p>
        </div>
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            <article class="group rounded-2xl border border-slate-100 bg-slate-50 p-6 shadow-sm hover:shadow-lg hover:border-emerald-200 transition-all duration-300">
                <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-emerald-600 transition-colors duration-300">
                    <i class="fa-solid fa-file-invoice text-emerald-600 group-hover:text-white text-xl transition-colors duration-300"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Ordem de Serviço Digital</h3>
                <p class="text-sm text-slate-600 leading-relaxed">Crie ordens de serviço completas com matrícula, modelo, peças, serviços e histórico. Imprima PDF ou envie por WhatsApp.</p>
            </article>
            <article class="group rounded-2xl border border-slate-100 bg-slate-50 p-6 shadow-sm hover:shadow-lg hover:border-blue-200 transition-all duration-300">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-blue-600 transition-colors duration-300">
                    <i class="fa-solid fa-wrench text-blue-600 group-hover:text-white text-xl transition-colors duration-300"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Gestão de Stock de Peças</h3>
                <p class="text-sm text-slate-600 leading-relaxed">Controlo de peças com preço de compra e venda. Baixa automática ao inserir peças na ordem de serviço.</p>
            </article>
            <article class="group rounded-2xl border border-slate-100 bg-slate-50 p-6 shadow-sm hover:shadow-lg hover:border-purple-200 transition-all duration-300">
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-purple-600 transition-colors duration-300">
                    <i class="fa-solid fa-money-bill-transfer text-purple-600 group-hover:text-white text-xl transition-colors duration-300"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Controlo Financeiro Completo</h3>
                <p class="text-sm text-slate-600 leading-relaxed">Contas a pagar e receber, fluxo de caixa diário e mensal. Controle cada cêntimo da sua oficina sem folhas de cálculo.</p>
            </article>
            <article class="group rounded-2xl border border-slate-100 bg-slate-50 p-6 shadow-sm hover:shadow-lg hover:border-orange-200 transition-all duration-300">
                <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-orange-600 transition-colors duration-300">
                    <i class="fa-solid fa-car text-orange-600 group-hover:text-white text-xl transition-colors duration-300"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Registo de Clientes e Veículos</h3>
                <p class="text-sm text-slate-600 leading-relaxed">Histórico completo por matrícula e cliente. Saiba todas as manutenções que o veículo já fez na sua oficina automóvel.</p>
            </article>
            <article class="group rounded-2xl border border-slate-100 bg-slate-50 p-6 shadow-sm hover:shadow-lg hover:border-red-200 transition-all duration-300">
                <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-red-600 transition-colors duration-300">
                    <i class="fa-brands fa-whatsapp text-red-600 group-hover:text-white text-xl transition-colors duration-300"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Integração com WhatsApp</h3>
                <p class="text-sm text-slate-600 leading-relaxed">Envie orçamentos e notifique clientes quando o carro estiver pronto. Tudo com um clique direto do sistema.</p>
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

<!-- NFE and Reports Section -->
<section class="py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900">Emissão de Faturas e Relatórios de Gestão</h2>
            <p class="mt-4 text-lg text-slate-600">Software para oficina automóvel com faturação integrada e relatórios completos</p>
        </div>

        <div class="grid gap-8 md:grid-cols-2">
            <article class="bg-white rounded-2xl border border-slate-100 p-8 shadow-sm hover:shadow-lg transition-all duration-300">
                <div class="w-14 h-14 bg-emerald-100 rounded-xl flex items-center justify-center mb-6">
                    <i class="fa-solid fa-file-invoice text-emerald-600 text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-slate-900 mb-4">Emissão de Faturas Integrada</h3>
                <p class="text-slate-600 leading-relaxed mb-4">
                    Para oficinas automóveis em Portugal que precisam de emitir faturas, o nosso software possui integração completa para emissão de faturas eletrónicas diretamente do sistema.
                </p>
                <ul class="space-y-3">
                    <li class="flex items-center gap-3 text-slate-700">
                        <i class="fa-solid fa-check text-emerald-500"></i>
                        <span>Emita faturas direto da ordem de serviço</span>
                    </li>
                    <li class="flex items-center gap-3 text-slate-700">
                        <i class="fa-solid fa-check text-emerald-500"></i>
                        <span>Controlo completo de impostos</span>
                    </li>
                    <li class="flex items-center gap-3 text-slate-700">
                        <i class="fa-solid fa-check text-emerald-500"></i>
                        <span>Envio automático por e-mail</span>
                    </li>
                </ul>
            </article>

            <article class="bg-white rounded-2xl border border-slate-100 p-8 shadow-sm hover:shadow-lg transition-all duration-300">
                <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center mb-6">
                    <i class="fa-solid fa-chart-line text-blue-600 text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-slate-900 mb-4">Relatórios para Gestão</h3>
                <p class="text-slate-600 leading-relaxed mb-4">
                    Tome decisões com base em dados. O nosso programa de controlo financeiro para oficina automóvel oferece relatórios completos e detalhados.
                </p>
                <ul class="space-y-3">
                    <li class="flex items-center gap-3 text-slate-700">
                        <i class="fa-solid fa-check text-blue-500"></i>
                        <span>Faturação por período</span>
                    </li>
                    <li class="flex items-center gap-3 text-slate-700">
                        <i class="fa-solid fa-check text-blue-500"></i>
                        <span>Serviços mais executados</span>
                    </li>
                    <li class="flex items-center gap-3 text-slate-700">
                        <i class="fa-solid fa-check text-blue-500"></i>
                        <span>Peças mais vendidas</span>
                    </li>
                    <li class="flex items-center gap-3 text-slate-700">
                        <i class="fa-solid fa-check text-blue-500"></i>
                        <span>Rentabilidade da oficina</span>
                    </li>
                </ul>
            </article>
        </div>

        <div class="mt-12 text-center">
            <a href="#cadastro" class="inline-flex items-center gap-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-8 py-4 rounded-xl shadow-lg shadow-emerald-500/20 hover:shadow-emerald-500/40 transform hover:-translate-y-0.5 transition-all duration-300">
                <span>Organize a sua oficina hoje</span>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- Benefícios -->
<section id="vantagens" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <p class="text-sm font-semibold text-emerald-600 uppercase tracking-[0.3em]">Diferenciais WSoft</p>
            <h2 class="mt-4 text-3xl md:text-4xl font-bold">Por que usar o WSoft na sua oficina automóvel?</h2>
            <p class="mt-4 text-lg text-slate-600">Benefícios práticos para o dia a dia da sua oficina</p>
        </div>
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-check-circle text-emerald-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Fácil de Usar</h3>
                    <p class="mt-3 text-slate-600">Interface intuitiva desenvolvida para donos de oficina. Aprende a usar em minutos, sem complicação.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-cloud text-blue-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">100% Online e Seguro</h3>
                    <p class="mt-3 text-slate-600">Aceda de qualquer lugar: computador, telemóvel ou tablet. Os seus dados sempre seguros na nuvem, com backup automático.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-headset text-orange-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Suporte Humanizado</h3>
                    <p class="mt-3 text-slate-600">Equipa pronta para o ajudar via WhatsApp. Nada de robôs, fale com pessoas.</p>
                </div>
            </article>
        </div>

        <div class="mt-16 text-center">
            <a href="#cadastro" class="inline-flex items-center gap-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-8 py-4 rounded-xl shadow-lg shadow-emerald-500/20 hover:shadow-emerald-500/40 transform hover:-translate-y-0.5 transition-all duration-300">
                <span>Controlo financeiro sem folhas de cálculo</span>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- Price Section -->
<section id="precos" class="py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <p class="text-sm font-semibold text-emerald-600 uppercase tracking-[0.3em]">Investimento</p>
            <h2 class="mt-4 text-3xl md:text-4xl font-bold text-slate-900">Quanto custa um software para oficina automóvel?</h2>
            <p class="mt-4 text-lg text-slate-600">Preço justo e transparente. Teste grátis por 7 dias sem cartão de crédito.</p>
        </div>

        <div class="max-w-md mx-auto">
            <div class="rounded-3xl bg-white border-2 border-emerald-500 shadow-2xl p-8 relative overflow-hidden">
                <div class="absolute top-0 right-0 bg-emerald-500 text-white text-xs font-bold px-4 py-1 rounded-bl-xl">MAIS POPULAR</div>
                <h3 class="text-2xl font-bold text-slate-900">{{ $product_name ?? 'Plano Profissional' }}</h3>
                <p class="mt-2 text-slate-500">{{ $product_description ?? 'Acesso completo a todas as ferramentas' }}</p>

                <div class="my-6">
                    <div class="flex items-baseline justify-center">
                        <span class="text-5xl font-extrabold text-slate-900">€ 9,90</span>
                        <span class="text-slate-500 ml-2">/mês</span>
                    </div>
                </div>

                <ul class="space-y-4 mb-8">
                    <li class="flex items-center gap-3 text-slate-700">
                        <i class="fa-solid fa-check text-emerald-500"></i>
                        <span>Emissão de OS Ilimitada</span>
                    </li>
                    <li class="flex items-center gap-3 text-slate-700">
                        <i class="fa-solid fa-check text-emerald-500"></i>
                        <span>Controlo de Stock e Financeiro</span>
                    </li>
                     <li class="flex items-center gap-3 text-slate-700">
                        <i class="fa-solid fa-check text-emerald-500"></i>
                        <span>Registo de Clientes e Veículos</span>
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
<x-site.cta-whatsapp
    title="Teste o software para oficina automóvel grátis por 7 dias"
    subtitle="Mais de 500 oficinas já modernizaram a sua gestão com o WSoft. Comece agora sem compromisso."
    buttonText="Começar teste grátis"
    gradient="from-emerald-600 to-teal-700"
/>

<!-- CTA Section -->
<x-site.cta-final
    :title="'Comece a usar o melhor software de gestão para oficina automóvel'"
    :description="'Teste grátis por 7 dias sem cartão de crédito. Depois apenas <span class=\'text-yellow-300 font-bold\'>9,90€/mês</span> para ter controlo total da sua oficina.'"
    :footer="'Junte-se a mais de 500 oficinas automóveis que usam WSoft'"
    :gradient="'bg-gradient-to-br from-emerald-600 to-blue-600'"
    :textColor="'text-emerald-50'"
    :highlightColor="'text-yellow-300'"
/>


<!-- FAQ -->
<section id="faq_section" class="py-20 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <p class="text-sm font-semibold text-emerald-600 uppercase tracking-[0.3em]">Dúvidas Frequentes</p>
            <h2 class="mt-4 text-3xl font-bold">Perguntas sobre software para oficina automóvel</h2>
        </div>
        <div class="space-y-4">
            <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    O que é um software de gestão para oficina automóvel?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Um software de gestão para oficina automóvel é um sistema que ajuda a organizar e controlar todos os processos da oficina: ordens de serviço, controlo financeiro, stock de peças, registo de clientes e veículos. Ele substitui cadernos, papéis e folhas de cálculo por um sistema integrado e profissional.</p>
            </details>
            <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    Como funciona a ordem de serviço digital?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">A ordem de serviço digital permite criar OS completas no sistema, com dados do cliente, veículo, defeito relatado, peças utilizadas e serviços executados. Pode adicionar fotos, gerar PDF e enviar por WhatsApp. Tudo fica registado e organizado no histórico.</p>
            </details>
            <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    O software faz controlo financeiro da oficina?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Sim! O WSoft possui controlo financeiro completo com contas a pagar e receber, fluxo de caixa diário e mensal, relatórios de rentabilidade e controlo de incumprimento. Não precisa mais de usar folhas de cálculo para controlar o dinheiro da oficina.</p>
            </details>
            <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    Como funciona o controlo de stock de peças?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Regista as peças com preço de custo e venda. Quando adiciona uma peça na ordem de serviço, o sistema dá baixa automática no stock. Assim sabe sempre quantas peças tem disponíveis e nunca esquece de cobrar uma peça utilizada.</p>
            </details>
            <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    O sistema emite faturas para oficina automóvel?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Sim, o WSoft possui integração para emissão de faturas eletrónicas. Pode emitir faturas diretamente da ordem de serviço, facilitando a formalização dos serviços prestados pela sua oficina automóvel.</p>
            </details>
            <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    Posso testar o software antes de pagar?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Sim! Oferecemos 7 dias de teste grátis, sem precisar de cadastrar cartão de crédito. Pode testar todas as funcionalidades do software para oficina automóvel e decidir se atende as suas necessidades.</p>
            </details>
            <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    Quanto custa o software para oficina automóvel?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">O WSoft custa apenas 9,90€ por mês. Sem taxa de adesão, sem letras pequenas. Todas as funcionalidades estão incluídas: ordem de serviço, controlo financeiro, stock, registo de clientes e suporte via WhatsApp.</p>
            </details>
            <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    Preciso de instalar algum programa no computador?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Não! O WSoft é 100% online (na nuvem). Acede diretamente do navegador, de qualquer computador, telemóvel ou tablet. Não precisa de instalar nada e os seus dados ficam sempre seguros com backup automático.</p>
            </details>
        </div>
    </div>
</section>


</x-site-layout>
