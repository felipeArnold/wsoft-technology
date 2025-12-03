@php
$structuredData = [
    [
        '@context' => 'https://schema.org',
        '@type' => 'SoftwareApplication',
        'name' => 'WSoft - Controle de Inadimplência',
        'url' => 'https://www.wsoft.dev.br/sistema-para-controle-de-inadimplencia',
        'description' => 'Sistema para controle e redução de inadimplência. Identifique devedores, automatize cobranças e recupere crédito.',
        'operatingSystem' => 'Web',
        'applicationCategory' => 'FinanceApplication',
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
            'ratingCount' => '78'
        ]
    ],
    [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => [
            [
                '@type' => 'Question',
                'name' => 'Como reduzir a inadimplência na minha empresa?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'O primeiro passo é organização. Com o WSoft, você sabe exatamente quem deve e há quanto tempo. O sistema envia lembretes automáticos para evitar o esquecimento.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'Posso bloquear clientes inadimplentes?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Sim! O sistema alerta quando você tenta vender para um cliente com pendências, permitindo bloquear novas vendas a prazo.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'O sistema envia cobrança por WhatsApp?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Sim! Você pode enviar lembretes de vencimento e mensagens de cobrança diretamente pelo WhatsApp com um clique.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'Como saber o total que tenho a receber?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'O painel de inadimplência mostra o valor total vencido, separado por tempo de atraso (30, 60, 90 dias), facilitando a priorização da cobrança.'
                ]
            ]
        ]
    ]
];
@endphp

<x-site-layout
    :title="'Controle de Inadimplência | Cobrança de Clientes | WSoft'"
    :description="'Reduza a inadimplência e recupere seu dinheiro. Sistema de cobrança e controle de devedores para pequenas empresas. Teste grátis!'"
    :keywords="'controle de inadimplência, cobrança de clientes, gestão de cobrança, software de cobrança, recuperar crédito, clientes devedores, gestão financeira'"
    :canonical="'https://www.wsoft.dev.br/sistema-para-controle-de-inadimplencia'"
    :ogTitle="'Sistema de Controle de Inadimplência | WSoft'"
    :ogDescription="'Pare de perder dinheiro. Identifique devedores, automatize cobranças e recupere seu capital com o WSoft.'"
    :structuredData="$structuredData"
>

<!-- Hero -->
<section id="hero" class="pt-32 pb-24 bg-gradient-to-b from-blue-950 via-blue-900 to-blue-800 text-white overflow-hidden relative">
    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 30px 30px;"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-16 items-center relative z-10">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-800/50 border border-blue-700 text-blue-200 text-xs font-semibold uppercase tracking-wider mb-6">
                <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                Controle de Inadimplência
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold leading-tight tracking-tight">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-200 to-white">Zero Inadimplência</span> na Sua Empresa
            </h1>
            <p class="mt-6 text-lg md:text-xl text-emerald-100 leading-relaxed max-w-lg">
                Pare de vender para quem não paga. Identifique devedores, automatize cobranças e recupere seu dinheiro de forma profissional.
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
                <p class="text-sm text-emerald-200 mb-4">Ideal para:</p>
                <div class="flex flex-wrap gap-3 text-sm font-medium text-white">
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Lojas de Roupas</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Mercadinhos</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Prestadores de Serviço</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Escolas e Cursos</span>
                </div>
            </div>
        </div>
        <div class="relative">
            <div class="absolute -inset-4 bg-gradient-to-r from-emerald-500 to-cyan-500 rounded-full blur-3xl opacity-20 animate-pulse"></div>
            <div class="bg-white/10 border border-white/20 rounded-3xl p-8 backdrop-blur-md shadow-2xl relative">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <p class="text-sm uppercase text-emerald-200 font-semibold tracking-wider">Total em Atraso</p>
                        <h3 class="text-3xl font-bold mt-1 text-red-400">R$ 4.250,00</h3>
                        <div class="flex items-center gap-2 mt-2">
                            <span class="text-xs font-bold text-red-400 bg-red-400/10 px-2 py-0.5 rounded">12 clientes</span>
                        </div>
                    </div>
                    <div class="h-12 w-12 rounded-full bg-red-500/20 flex items-center justify-center border border-red-400/30">
                        <i class="fa-solid fa-triangle-exclamation text-red-300 text-xl"></i>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-xs text-emerald-200">Recuperado este Mês</p>
                            <span class="text-sm font-bold text-emerald-300">R$ 1.800,00</span>
                        </div>
                        <div class="h-2 bg-emerald-950/50 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-emerald-400 to-cyan-400 w-[45%] rounded-full"></div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                            <p class="text-xs text-emerald-200">Atraso > 30 dias</p>
                            <p class="text-2xl font-bold mt-1 text-red-400">R$ 2k</p>
                        </div>
                        <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                            <p class="text-xs text-emerald-200">Acordos</p>
                            <p class="text-2xl font-bold mt-1 text-blue-400">3</p>
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
            <span class="text-red-600 font-bold tracking-wider uppercase text-sm">O problema do "fiado"</span>
            <h2 class="mt-2 text-3xl md:text-4xl font-extrabold text-slate-900">O lucro vai embora no calote?</h2>
            <p class="mt-4 text-lg text-slate-600">Vender é bom, mas receber é fundamental. A falta de controle de cobrança quebra empresas.</p>
        </div>
        <div class="grid md:grid-cols-2 gap-8">
            <!-- Pain -->
            <div class="p-8 rounded-3xl bg-red-50 border border-red-100 relative overflow-hidden group hover:shadow-lg transition">
                <div class="absolute top-0 right-0 bg-red-100 text-red-600 text-xs font-bold px-3 py-1 rounded-bl-xl">SEM SISTEMA</div>
                <h3 class="text-xl font-bold text-red-700 mb-6 flex items-center gap-2">
                    <i class="fa-solid fa-circle-xmark"></i> Prejuízo Certo
                </h3>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3 text-slate-700">
                        <i class="fa-solid fa-xmark text-red-500 mt-1"></i>
                        <span>Vende para quem já está devendo</span>
                    </li>
                    <li class="flex items-start gap-3 text-slate-700">
                        <i class="fa-solid fa-xmark text-red-500 mt-1"></i>
                        <span>Vergonha ou esquecimento de cobrar</span>
                    </li>
                    <li class="flex items-start gap-3 text-slate-700">
                        <i class="fa-solid fa-xmark text-red-500 mt-1"></i>
                        <span>Perde o controle de prazos e valores</span>
                    </li>
                    <li class="flex items-start gap-3 text-slate-700">
                        <i class="fa-solid fa-xmark text-red-500 mt-1"></i>
                        <span>Cliente some e você fica no prejuízo</span>
                    </li>
                </ul>
            </div>
            <!-- Gain -->
            <div class="p-8 rounded-3xl bg-green-50 border border-green-100 relative overflow-hidden shadow-md group hover:shadow-xl transition transform hover:-translate-y-1">
                <div class="absolute top-0 right-0 bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-bl-xl">COM WSOFT</div>
                <h3 class="text-xl font-bold text-green-700 mb-6 flex items-center gap-2">
                    <i class="fa-solid fa-circle-check"></i> Crédito Seguro
                </h3>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3 text-slate-700">
                        <i class="fa-solid fa-check text-green-600 mt-1"></i>
                        <span>Bloqueio automático de inadimplentes</span>
                    </li>
                    <li class="flex items-start gap-3 text-slate-700">
                        <i class="fa-solid fa-check text-green-600 mt-1"></i>
                        <span>Cobrança profissional e impessoal</span>
                    </li>
                    <li class="flex items-start gap-3 text-slate-700">
                        <i class="fa-solid fa-check text-green-600 mt-1"></i>
                        <span>Histórico de bom pagador</span>
                    </li>
                    <li class="flex items-start gap-3 text-slate-700">
                        <i class="fa-solid fa-check text-green-600 mt-1"></i>
                        <span>Régua de cobrança automatizada</span>
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
            <h2 class="mt-4 text-3xl md:text-4xl font-bold text-slate-900">Como reduzir a inadimplência</h2>
            <p class="mt-4 text-lg text-slate-600">Recupere seu crédito em 3 passos simples.</p>
        </div>

        <div class="space-y-24">
            <!-- Step 1 -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 group">
                        <div class="absolute inset-0 bg-emerald-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="/images/crm/registration.png" alt="Identificação de Devedores" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-emerald-100 text-emerald-700 font-bold text-xl">1</span>
                        <h3 class="text-2xl font-bold text-slate-900">Identifique o Atraso</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        O sistema monitora todos os vencimentos e destaca em vermelho quem não pagou. Você sabe na hora quem cobrar.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Lista de inadimplentes atualizada</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Filtro por dias de atraso</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-1">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-emerald-100 text-emerald-700 font-bold text-xl">2</span>
                        <h3 class="text-2xl font-bold text-slate-900">Notifique o Cliente</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Envie lembretes amigáveis antes do vencimento e avisos de cobrança após o atraso. Tudo via WhatsApp ou E-mail.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Envio de cobrança por WhatsApp</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Mensagens personalizáveis</span>
                        </li>
                    </ul>
                </div>
                <div class="order-2">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 group">
                        <div class="absolute inset-0 bg-emerald-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="/images/crm/history.png" alt="Envio de Cobrança" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 group">
                        <div class="absolute inset-0 bg-emerald-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="/images/crm/reports.png" alt="Bloqueio e Acordo" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-emerald-100 text-emerald-700 font-bold text-xl">3</span>
                        <h3 class="text-2xl font-bold text-slate-900">Bloqueie e Negocie</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        O sistema bloqueia novas vendas para devedores até a regularização. Registre acordos e parcele a dívida para recuperar o valor.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Bloqueio automático de vendas</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Renegociação de dívidas</span>
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
            <h2 class="mt-4 text-3xl md:text-4xl font-bold">Por que automatizar a cobrança?</h2>
            <p class="mt-4 text-lg text-slate-600">Profissionalismo que gera resultados</p>
        </div>
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-shield-halved text-emerald-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Mais Segurança</h3>
                    <p class="mt-3 text-slate-600">Venda com tranquilidade sabendo que o sistema barra clientes com histórico ruim.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-robot text-blue-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Cobrança Impessoal</h3>
                    <p class="mt-3 text-slate-600">Evite o constrangimento de cobrar amigos e conhecidos. Deixe que o sistema faça isso.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-sack-dollar text-purple-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Recuperação de Caixa</h3>
                    <p class="mt-3 text-slate-600">Transforme dívidas perdidas em dinheiro no caixa através de acordos e lembretes.</p>
                </div>
            </article>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-br from-emerald-600 to-blue-600 text-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold">Recupere seu dinheiro agora</h2>
        <p class="mt-4 text-lg text-white/90 max-w-2xl mx-auto">
            Teste o sistema de controle de inadimplência gratuitamente por 7 dias.
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
    </div>
</section>

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
                    O sistema bloqueia vendas automaticamente?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Sim! Você pode configurar para que o sistema bloqueie novas vendas a prazo para clientes com contas atrasadas.</p>
            </details>
            <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    Posso renegociar dívidas?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Sim! O sistema permite agrupar várias contas atrasadas e criar um novo parcelamento (acordo) para o cliente.</p>
            </details>
        </div>
    </div>
</section>

</x-site-layout>
