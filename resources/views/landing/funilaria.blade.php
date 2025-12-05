@php
$structuredData = [
    [
        '@context' => 'https://schema.org',
        '@type' => 'SoftwareApplication',
        'name' => 'WSoft - Sistema para Funilaria e Pintura',
        'url' => 'https://www.wsoft.dev.br/landing/funilaria',
        'description' => 'Sistema de gestão completo para funilarias e oficinas de pintura. Orçamentos com fotos, controle de OS e financeiro.',
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
            'ratingCount' => '85'
        ]
    ],
    [
        '@context' => 'https://schema.org',
        '@type' => 'AutoBodyShop',
        'name' => 'WSoft Tecnologia - Sistema para Funilaria',
        'image' => 'https://www.wsoft.dev.br/images/logo.png',
        'description' => 'Sistema de gestão completo para funilaria e pintura. Orçamentos com fotos, controle de OS e financeiro.',
        'url' => 'https://www.wsoft.dev.br/landing/funilaria',
        'priceRange' => '$$',
        'address' => [
            '@type' => 'PostalAddress',
            'addressCountry' => 'BR'
        ],
        'aggregateRating' => [
            '@type' => 'AggregateRating',
            'ratingValue' => '4.9',
            'ratingCount' => '85'
        ]
    ],
    [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => [
            [
                '@type' => 'Question',
                'name' => 'Consigo fazer orçamento com fotos?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Sim! O WSoft permite criar orçamentos detalhados com fotos do veículo para aprovação do cliente ou seguradora.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'Tem controle de etapas da funilaria?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Sim, você pode controlar cada fase: desmontagem, funilaria, preparação, pintura e montagem.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'O sistema controla o financeiro?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Completo. Contas a pagar, receber, fluxo de caixa e relatórios de lucro por serviço.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'Posso controlar o estoque de tintas?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Sim, controle o estoque de todos os materiais (lixas, massas, tintas) e lance o custo na OS.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'Quanto custa o sistema para funilaria?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'O WSoft custa apenas R$ 29,90 por mês no plano vitalício. Sem cobranças extras.'
                ]
            ]
        ]
    ]
];
@endphp

<x-site-layout
    :title="'Sistema para Funilaria e Pintura | Orçamentos e OS | WSoft'"
    :description="'Sistema completo para funilaria e pintura automotiva. Orçamentos com fotos, OS por etapas, financeiro e estoque. Teste grátis!'"
    :keywords="'sistema para funilaria, software funilaria, orcamento funilaria, gestão funilaria, oficina pintura software, sistema estética automotiva'"
    :canonical="'https://www.wsoft.dev.br/landing/funilaria'"
    :ogTitle="'Sistema de Gestão para Funilaria e Pintura | WSoft'"
    :ogDescription="'Crie orçamentos profissionais com fotos e organize sua funilaria com o sistema mais completo do mercado.'"
    :structuredData="$structuredData"
>

<!-- Hero -->
<section id="hero" class="pt-32 pb-24 bg-gradient-to-b from-slate-900 via-slate-800 to-slate-900 text-white overflow-hidden relative">
    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 30px 30px;"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-16 items-center relative z-10">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-700/50 border border-slate-600 text-slate-200 text-xs font-semibold uppercase tracking-wider mb-6">
                <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
                Sistema para Funilaria
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold leading-tight tracking-tight">
                Gestão Profissional para <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-200">Funilaria e Pintura</span>
            </h1>
            <p class="mt-6 text-lg md:text-xl text-slate-300 leading-relaxed max-w-lg">
                Orçamentos com fotos, controle de etapas e financeiro. O sistema ideal para funilarias e estética automotiva.
            </p>
            <div class="mt-10 flex flex-col sm:flex-row gap-4">
                <a href="/app/register" class="inline-flex justify-center items-center rounded-xl bg-blue-600 text-white font-bold px-8 py-4 shadow-lg shadow-blue-600/30 hover:bg-blue-700 hover:-translate-y-1 transition transform duration-200">
                    Testar por 7 Dias
                    <i class="fa-solid fa-arrow-right ml-2"></i>
                </a>
                <a href="#como-funciona" class="inline-flex justify-center items-center rounded-xl border border-white/30 text-white font-semibold px-8 py-4 hover:bg-white/10 transition backdrop-blur-sm">
                    <i class="fa-solid fa-play mr-2"></i>
                    Como Funciona
                </a>
            </div>
            <div class="mt-10 pt-8 border-t border-white/10">
                <p class="text-sm text-slate-400 mb-4">Ideal para:</p>
                <div class="flex flex-wrap gap-3 text-sm font-medium text-white">
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Funilarias</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Oficinas de Pintura</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Estética Automotiva</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Martelinho de Ouro</span>
                </div>
            </div>
        </div>
        <div class="relative">
            <div class="absolute -inset-4 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-full blur-3xl opacity-20 animate-pulse"></div>
            <div class="bg-slate-800/50 border border-slate-700/50 rounded-3xl p-8 backdrop-blur-md shadow-2xl relative">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <p class="text-sm uppercase text-slate-400 font-semibold tracking-wider">Faturamento Hoje</p>
                        <h3 class="text-3xl font-bold mt-1 text-white">R$ 5.200,00</h3>
                        <div class="flex items-center gap-2 mt-2">
                            <span class="text-xs font-bold text-green-400 bg-green-400/10 px-2 py-0.5 rounded">+12% vs ontem</span>
                        </div>
                    </div>
                    <div class="h-12 w-12 rounded-full bg-blue-500/20 flex items-center justify-center border border-blue-400/30">
                        <i class="fa-solid fa-spray-can text-blue-400 text-xl"></i>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="bg-slate-700/50 rounded-xl p-4 border border-slate-600/50">
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-xs text-slate-300">Orçamentos Aprovados</p>
                            <span class="text-sm font-bold text-blue-400">5 de 6</span>
                        </div>
                        <div class="h-2 bg-slate-900 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-blue-500 to-cyan-500 w-[83%] rounded-full"></div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-slate-700/50 rounded-xl p-4 border border-slate-600/50">
                            <p class="text-xs text-slate-300">Em Produção</p>
                            <p class="text-2xl font-bold mt-1 text-white">8 Carros</p>
                        </div>
                        <div class="bg-slate-700/50 rounded-xl p-4 border border-slate-600/50">
                            <p class="text-xs text-slate-300">Ticket Médio</p>
                            <p class="text-2xl font-bold mt-1 text-white">R$ 1.1k</p>
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
            <h2 class="mt-2 text-3xl md:text-4xl font-extrabold text-slate-900">Sua funilaria perde dinheiro em orçamentos?</h2>
            <p class="mt-4 text-lg text-slate-600">Erros na avaliação e demora no orçamento podem custar o serviço. Veja a diferença:</p>
        </div>
        <div class="grid md:grid-cols-2 gap-8">
            <!-- Pain -->
            <div class="p-8 rounded-3xl bg-red-50 border border-red-100 relative overflow-hidden group hover:shadow-lg transition">
                <div class="absolute top-0 right-0 bg-red-100 text-red-600 text-xs font-bold px-3 py-1 rounded-bl-xl">SEM SISTEMA</div>
                <h3 class="text-xl font-bold text-red-700 mb-6 flex items-center gap-2">
                    <i class="fa-solid fa-circle-xmark"></i> Gestão Manual
                </h3>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3 text-slate-700">
                        <i class="fa-solid fa-xmark text-red-500 mt-1"></i>
                        <span>Orçamentos sem fotos ou detalhes</span>
                    </li>
                    <li class="flex items-start gap-3 text-slate-700">
                        <i class="fa-solid fa-xmark text-red-500 mt-1"></i>
                        <span>Prejuízo com material desperdiçado</span>
                    </li>
                    <li class="flex items-start gap-3 text-slate-700">
                        <i class="fa-solid fa-xmark text-red-500 mt-1"></i>
                        <span>Demora para enviar o preço (cliente desiste)</span>
                    </li>
                    <li class="flex items-start gap-3 text-slate-700">
                        <i class="fa-solid fa-xmark text-red-500 mt-1"></i>
                        <span>Não sabe onde o dinheiro foi parar</span>
                    </li>
                </ul>
            </div>
            <!-- Gain -->
            <div class="p-8 rounded-3xl bg-green-50 border border-green-100 relative overflow-hidden shadow-md group hover:shadow-xl transition transform hover:-translate-y-1">
                <div class="absolute top-0 right-0 bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-bl-xl">COM WSOFT</div>
                <h3 class="text-xl font-bold text-green-700 mb-6 flex items-center gap-2">
                    <i class="fa-solid fa-circle-check"></i> Funilaria Organizada
                </h3>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3 text-slate-700">
                        <i class="fa-solid fa-check text-green-600 mt-1"></i>
                        <span>Orçamento com fotos em minutos</span>
                    </li>
                    <li class="flex items-start gap-3 text-slate-700">
                        <i class="fa-solid fa-check text-green-600 mt-1"></i>
                        <span>Controle de custo de material por OS</span>
                    </li>
                    <li class="flex items-start gap-3 text-slate-700">
                        <i class="fa-solid fa-check text-green-600 mt-1"></i>
                        <span>Acompanhamento por etapas (cliente feliz)</span>
                    </li>
                    <li class="flex items-start gap-3 text-slate-700">
                        <i class="fa-solid fa-check text-green-600 mt-1"></i>
                        <span>Financeiro na ponta do lápis</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- How it Works -->
<section id="como-funciona" class="py-24 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-20">
            <p class="text-sm font-semibold text-blue-600 uppercase tracking-[0.3em]">Passo a Passo</p>
            <h2 class="mt-4 text-3xl md:text-4xl font-bold text-slate-900">Como funciona o Sistema na Prática</h2>
            <p class="mt-4 text-lg text-slate-600">Simples de usar, feito para o dia a dia da funilaria e pintura.</p>
        </div>

        <div class="space-y-24">
            <!-- Step 1 -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 group">
                        <div class="absolute inset-0 bg-blue-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="{{ asset('images/sistema/os/os-digital.png') }}" alt="Tela de Orçamento" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-blue-100 text-blue-700 font-bold text-xl">1</span>
                        <h3 class="text-2xl font-bold text-slate-900">Faça o Orçamento com Fotos</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Registre o veículo, tire fotos dos danos pelo celular e monte o orçamento na hora. Envie para o cliente aprovar.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-blue-500"></i>
                            <span>Fotos ilimitadas</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-blue-500"></i>
                            <span>Checklist de entrada</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-blue-500"></i>
                            <span>Aprovação online</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-1">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-blue-100 text-blue-700 font-bold text-xl">2</span>
                        <h3 class="text-2xl font-bold text-slate-900">Acompanhe as Etapas</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Controle o progresso do serviço: Desmontagem, Funilaria, Preparação, Pintura, Polimento e Montagem.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-blue-500"></i>
                            <span>Status personalizados</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-blue-500"></i>
                            <span>Controle de materiais usados</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-blue-500"></i>
                            <span>Gestão da equipe</span>
                        </li>
                    </ul>
                </div>
                <div class="order-2">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 group">
                        <div class="absolute inset-0 bg-blue-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="{{ asset('images/sistema/financeiro/faturamento.png') }}" alt="Tela de Financeiro" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 group">
                        <div class="absolute inset-0 bg-blue-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="{{ asset('images/sistema/os/whatsapp-share.png') }}" alt="Envio WhatsApp" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-blue-100 text-blue-700 font-bold text-xl">3</span>
                        <h3 class="text-2xl font-bold text-slate-900">Entregue e Fidelize</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Avise que o carro está pronto, envie a fatura e garanta a satisfação do cliente com um serviço profissional.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-blue-500"></i>
                            <span>Aviso automático</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-blue-500"></i>
                            <span>Fotos do "Depois"</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-blue-500"></i>
                            <span>Financeiro integrado</span>
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
            <p class="text-sm font-semibold text-blue-600 uppercase tracking-[0.3em]">Vantagens</p>
            <h2 class="mt-4 text-3xl md:text-4xl font-bold">Por que usar o WSoft na sua funilaria?</h2>
            <p class="mt-4 text-lg text-slate-600">Ferramentas pensadas para organizar e aumentar o lucro</p>
        </div>
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-camera text-blue-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Orçamentos com Fotos</h3>
                    <p class="mt-3 text-slate-600">Documente os danos e justifique o valor do serviço. Transparência total.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-hand-holding-dollar text-green-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Gestão Financeira</h3>
                    <p class="mt-3 text-slate-600">Saiba o lucro real de cada serviço descontando material e comissão.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-spray-can text-orange-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Controle de Materiais</h3>
                    <p class="mt-3 text-slate-600">Controle o uso de tintas e insumos. Evite desperdícios.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-list-check text-purple-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Controle de Etapas</h3>
                    <p class="mt-3 text-slate-600">Organize o pátio. Saiba em que fase está cada veículo.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-teal-100 rounded-xl flex items-center justify-center">
                    <i class="fa-brands fa-whatsapp text-teal-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Tudo no WhatsApp</h3>
                    <p class="mt-3 text-slate-600">Envie orçamentos e fotos do andamento direto para o cliente.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-chart-line text-red-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Relatórios</h3>
                    <p class="mt-3 text-slate-600">Acompanhe seu faturamento e quantos orçamentos foram aprovados.</p>
                </div>
            </article>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-br from-slate-800 to-slate-900 text-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold">Profissionalize sua Funilaria</h2>
        <p class="mt-4 text-lg text-slate-300 max-w-2xl mx-auto">
            Comece agora com 7 dias de teste grátis. Aproveite a oferta vitalícia.
        </p>
        <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="/app/register" class="inline-flex justify-center items-center rounded-xl bg-blue-600 text-white font-bold px-10 py-4 shadow-lg shadow-blue-600/30 hover:bg-blue-700 hover:-translate-y-1 transition transform duration-200">
                Testar por 7 Dias
                <i class="fa-solid fa-arrow-right ml-2"></i>
            </a>
            <a href="/#precos" class="inline-flex justify-center items-center rounded-xl border border-white/60 text-white font-semibold px-10 py-4 hover:bg-white/10 transition backdrop-blur-sm">
                Ver Planos e Preços
            </a>
        </div>
        <p class="mt-6 text-sm text-slate-400">Junte-se a centenas de funilarias que usam WSoft</p>
    </div>
</section>

<!-- FAQ -->
<section id="faq" class="py-20 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <p class="text-sm font-semibold text-blue-600 uppercase tracking-[0.3em]">Dúvidas</p>
            <h2 class="mt-4 text-3xl font-bold">Perguntas Frequentes</h2>
        </div>
        <div class="space-y-4">
            <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    Consigo fazer orçamento com fotos?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Sim! O WSoft permite criar orçamentos detalhados com fotos do veículo para aprovação do cliente ou seguradora.</p>
            </details>
            <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    Tem controle de etapas da funilaria?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Sim, você pode controlar cada fase: desmontagem, funilaria, preparação, pintura e montagem.</p>
            </details>
            <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    O sistema controla o financeiro?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Completo. Contas a pagar, receber, fluxo de caixa e relatórios de lucro por serviço.</p>
            </details>
            <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    Posso controlar o estoque de tintas?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Sim, controle o estoque de todos os materiais (lixas, massas, tintas) e lance o custo na OS.</p>
            </details>
            <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    Quanto custa o sistema para funilaria?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">O WSoft custa apenas R$ 29,90 por mês no plano vitalício. Sem cobranças extras.</p>
            </details>
        </div>
    </div>
</section>

<!-- Social Proof -->
<section class="py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <p class="text-sm font-semibold text-blue-600 uppercase tracking-[0.3em]">Depoimentos</p>
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
                <p class="text-sm text-slate-600 italic">"Os orçamentos com foto mudaram tudo. O cliente aprova muito mais rápido quando vê a foto do detalhe."</p>
                <div class="mt-4 font-semibold">Andre Martines</div>
                <div class="text-sm text-slate-500">Funilaria São Jorge</div>
            </article>
            <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                <div class="flex gap-1 text-yellow-400 mb-4">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <p class="text-sm text-slate-600 italic">"Consigo controlar o que meus funileiros estão gastando de material. Acabou o desperdício."</p>
                <div class="mt-4 font-semibold">Marcelo Vieira</div>
                <div class="text-sm text-slate-500">Pintura & Cia</div>
            </article>
            <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                <div class="flex gap-1 text-yellow-400 mb-4">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <p class="text-sm text-slate-600 italic">"Simples e direto. Faço tudo pelo celular enquanto acompanho o serviço no pátio."</p>
                <div class="mt-4 font-semibold">Paulo Rocha</div>
                <div class="text-sm text-slate-500">Oficina Rocha</div>
            </article>
        </div>
    </div>
</section>

</x-site-layout>
