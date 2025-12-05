@php
$structuredData = [
    [
        '@context' => 'https://schema.org',
        '@type' => 'SoftwareApplication',
        'name' => 'WSoft - Sistema para Oficina Mecânica',
        'url' => 'https://www.wsoft.dev.br/landing/oficina',
        'description' => 'Sistema de gestão completo para oficinas mecânicas. Controle de OS, financeiro, estoque e cadastro de clientes.',
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
    ]
];
@endphp

<x-site-layout
    :title="'Sistema para Oficina Mecânica | Gestão e OS | WSoft'"
    :description="'Sistema de gestão para oficinas mecânicas com OS digital, controle financeiro, fluxo de caixa e cadastro de clientes e fornecedores.'"
    :keywords="'sistema oficina mecanica, software oficina, ordem de serviço oficina, gestão oficina, programa para oficina, controle financeiro oficina, sistema para auto center'"
    :canonical="'https://www.wsoft.dev.br/landing/oficina'"
    :ogTitle="'Sistema de Gestão para Oficinas Mecânicas | WSoft'"
    :ogDescription="'Organize sua oficina, controle OS e aumente seus lucros com o sistema mais simples e completo do mercado.'"
    :structuredData="$structuredData"
>

<!-- Hero -->
<section id="hero" class="pt-32 pb-24 bg-gradient-to-b from-slate-900 via-slate-800 to-slate-900 text-white overflow-hidden relative">
    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 30px 30px;"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-16 items-center relative z-10">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-700/50 border border-slate-600 text-slate-200 text-xs font-semibold uppercase tracking-wider mb-6">
                <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
                Sistema para Oficina
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold leading-tight tracking-tight">
                Gestão Profissional para sua <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-200">Oficina Mecânica</span>
            </h1>
            <p class="mt-6 text-lg md:text-xl text-slate-300 leading-relaxed max-w-lg">
                Ordem de serviço digital, controle financeiro e estoque de peças. O sistema ideal para mecânicas e auto centers.
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
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Oficinas Mecânicas</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Auto Centers</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Funilarias</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Troca de Óleo</span>
                </div>
            </div>
        </div>
        <div class="relative">
            <div class="absolute -inset-4 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-full blur-3xl opacity-20 animate-pulse"></div>
            <div class="bg-slate-800/50 border border-slate-700/50 rounded-3xl p-8 backdrop-blur-md shadow-2xl relative">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <p class="text-sm uppercase text-slate-400 font-semibold tracking-wider">Faturamento Hoje</p>
                        <h3 class="text-3xl font-bold mt-1 text-white">R$ 3.850,00</h3>
                        <div class="flex items-center gap-2 mt-2">
                            <span class="text-xs font-bold text-green-400 bg-green-400/10 px-2 py-0.5 rounded">+22% vs ontem</span>
                        </div>
                    </div>
                    <div class="h-12 w-12 rounded-full bg-blue-500/20 flex items-center justify-center border border-blue-400/30">
                        <i class="fa-solid fa-wrench text-blue-400 text-xl"></i>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="bg-slate-700/50 rounded-xl p-4 border border-slate-600/50">
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-xs text-slate-300">Meta Mensal</p>
                            <span class="text-sm font-bold text-blue-400">88% Atingida</span>
                        </div>
                        <div class="h-2 bg-slate-900 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-blue-500 to-cyan-500 w-[88%] rounded-full"></div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-slate-700/50 rounded-xl p-4 border border-slate-600/50">
                            <p class="text-xs text-slate-300">OS Abertas</p>
                            <p class="text-2xl font-bold mt-1 text-white">12</p>
                        </div>
                        <div class="bg-slate-700/50 rounded-xl p-4 border border-slate-600/50">
                            <p class="text-xs text-slate-300">Ticket Médio</p>
                            <p class="text-2xl font-bold mt-1 text-white">R$ 420</p>
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
            <h2 class="mt-2 text-3xl md:text-4xl font-extrabold text-slate-900">Sua oficina está perdendo dinheiro?</h2>
            <p class="mt-4 text-lg text-slate-600">A falta de gestão pode estar custando caro para o seu negócio. Veja a diferença:</p>
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
                        <span>OS de papel que somem ou rasgam</span>
                    </li>
                    <li class="flex items-start gap-3 text-slate-700">
                        <i class="fa-solid fa-xmark text-red-500 mt-1"></i>
                        <span>Esquece de cobrar peças usadas na OS</span>
                    </li>
                    <li class="flex items-start gap-3 text-slate-700">
                        <i class="fa-solid fa-xmark text-red-500 mt-1"></i>
                        <span>Não sabe quem deve (Inadimplência alta)</span>
                    </li>
                    <li class="flex items-start gap-3 text-slate-700">
                        <i class="fa-solid fa-xmark text-red-500 mt-1"></i>
                        <span>Mistura dinheiro da oficina com pessoal</span>
                    </li>
                </ul>
            </div>
            <!-- Gain -->
            <div class="p-8 rounded-3xl bg-green-50 border border-green-100 relative overflow-hidden shadow-md group hover:shadow-xl transition transform hover:-translate-y-1">
                <div class="absolute top-0 right-0 bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-bl-xl">COM WSOFT</div>
                <h3 class="text-xl font-bold text-green-700 mb-6 flex items-center gap-2">
                    <i class="fa-solid fa-circle-check"></i> Oficina Organizada
                </h3>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3 text-slate-700">
                        <i class="fa-solid fa-check text-green-600 mt-1"></i>
                        <span>OS digital profissional e organizada</span>
                    </li>
                    <li class="flex items-start gap-3 text-slate-700">
                        <i class="fa-solid fa-check text-green-600 mt-1"></i>
                        <span>Controle automático de estoque de peças</span>
                    </li>
                    <li class="flex items-start gap-3 text-slate-700">
                        <i class="fa-solid fa-check text-green-600 mt-1"></i>
                        <span>Controle financeiro e cobrança automática</span>
                    </li>
                    <li class="flex items-start gap-3 text-slate-700">
                        <i class="fa-solid fa-check text-green-600 mt-1"></i>
                        <span>Histórico completo do veículo (confiança)</span>
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
            <h2 class="mt-4 text-3xl md:text-4xl font-bold text-slate-900">Como funciona o Sistema para Oficina</h2>
            <p class="mt-4 text-lg text-slate-600">Simples de usar, feito para o dia a dia corrido da mecânica.</p>
        </div>

        <div class="space-y-24">
            <!-- Step 1 -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 group">
                        <div class="absolute inset-0 bg-blue-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="{{ asset('images/sistema/os/os-digital.png') }}" alt="Tela de Ordem de Serviço" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-blue-100 text-blue-700 font-bold text-xl">1</span>
                        <h3 class="text-2xl font-bold text-slate-900">Crie a Ordem de Serviço</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Registre a entrada do veículo, adicione fotos do estado inicial, relate o defeito e inicie o atendimento com profissionalismo.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-blue-500"></i>
                            <span>Checklist de entrada</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-blue-500"></i>
                            <span>Fotos ilimitadas</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-blue-500"></i>
                            <span>Cadastro rápido de cliente e veículo</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-1">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-blue-100 text-blue-700 font-bold text-xl">2</span>
                        <h3 class="text-2xl font-bold text-slate-900">Adicione Peças e Serviços</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Lance as peças utilizadas (com baixa automática no estoque) e a mão de obra. O sistema calcula o total na hora.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-blue-500"></i>
                            <span>Controle de estoque de peças</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-blue-500"></i>
                            <span>Cadastro de serviços padrão</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-blue-500"></i>
                            <span>Valor de custo e venda</span>
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
                        <img src="{{ asset('images/sistema/os/whatsapp-share.png') }}" alt="Envio via WhatsApp" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-blue-100 text-blue-700 font-bold text-xl">3</span>
                        <h3 class="text-2xl font-bold text-slate-900">Receba e Fidelize</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Envie a OS pronta pelo WhatsApp, receba o pagamento e mantenha o histórico do cliente para futuras revisões.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-blue-500"></i>
                            <span>Envio PDF no WhatsApp</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-blue-500"></i>
                            <span>Controle de garantia</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-blue-500"></i>
                            <span>Lembretes de revisão</span>
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
            <h2 class="mt-4 text-3xl md:text-4xl font-bold">Por que usar o WSoft na sua oficina?</h2>
            <p class="mt-4 text-lg text-slate-600">Ferramentas pensadas para facilitar a vida do mecânico e do gestor</p>
        </div>
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-file-invoice-dollar text-blue-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">OS Digital</h3>
                    <p class="mt-3 text-slate-600">Elimine o papel. Tenha todas as ordens de serviço organizadas e acessíveis a qualquer momento.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-money-bill-trend-up text-green-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Controle Financeiro</h3>
                    <p class="mt-3 text-slate-600">Fluxo de caixa, contas a pagar e receber. Saiba exatamente quanto sua oficina lucra.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-box-open text-orange-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Controle de Estoque</h3>
                    <p class="mt-3 text-slate-600">Baixa automática de peças ao lançar na OS. Evite furos e falta de material.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-car text-purple-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Histórico de Veículos</h3>
                    <p class="mt-3 text-slate-600">Saiba tudo que já foi feito em cada carro. Passe confiança para seu cliente.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-teal-100 rounded-xl flex items-center justify-center">
                    <i class="fa-brands fa-whatsapp text-teal-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Avisos Automáticos</h3>
                    <p class="mt-3 text-slate-600">Envie orçamentos e situação da OS direto no WhatsApp do cliente.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-chart-pie text-red-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Relatórios</h3>
                    <p class="mt-3 text-slate-600">Faturamento, peças mais vendidas e desempenho da oficina em gráficos simples.</p>
                </div>
            </article>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-br from-slate-800 to-slate-900 text-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold">Profissionalize sua Oficina</h2>
        <p class="mt-4 text-lg text-slate-300 max-w-2xl mx-auto">
            Comece agora com 7 dias de teste grátis. Sem cartão de crédito, sem compromisso.
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
        <p class="mt-6 text-sm text-slate-400">Junte-se a centenas de oficinas que usam WSoft</p>
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
