@php
$structuredData = [
    [
        '@context' => 'https://schema.org',
        '@type' => 'SoftwareApplication',
        'name' => 'WSoft - Sistema de Contas a Pagar',
        'url' => 'https://www.wsoft.dev.br/sistema-para-contas-a-pagar',
        'description' => 'Sistema completo para controle de contas a pagar. Organize despesas, evite juros, controle vencimentos e tenha previsão financeira.',
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
            'ratingCount' => '85'
        ]
    ],
    [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => [
            [
                '@type' => 'Question',
                'name' => 'Como organizar as contas a pagar da empresa?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Com o WSoft, você lança todas as despesas, define datas de vencimento e recebe alertas. O sistema organiza tudo por categoria e fornecedor.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'O sistema avisa quando uma conta vai vencer?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Sim! Você recebe notificações de contas próximas ao vencimento para evitar o pagamento de juros e multas por atraso.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'Posso parcelar despesas no sistema?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Sim! É possível lançar despesas parceladas ou recorrentes (como aluguel e internet) de forma automática.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'Consigo ver o total de despesas do mês?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Sim! O painel financeiro mostra o total a pagar no dia, na semana e no mês, permitindo um planejamento de caixa eficiente.'
                ]
            ]
        ]
    ]
];
@endphp

<x-site-layout
    :title="'Sistema de Contas a Pagar | Controle Financeiro | WSoft'"
    :description="'Organize suas despesas e nunca mais pague juros. Sistema de contas a pagar simples e eficiente para pequenas empresas. Teste grátis!'"
    :keywords="'contas a pagar, controle de despesas, gestão financeira, software financeiro, contas a pagar e receber, planilha de gastos, controle de pagamentos'"
    :canonical="'https://www.wsoft.dev.br/sistema-para-contas-a-pagar'"
    :ogTitle="'Sistema de Contas a Pagar e Despesas | WSoft'"
    :ogDescription="'Evite juros e multas. Organize suas contas a pagar, controle vencimentos e tenha previsão de caixa com o WSoft.'"
    :structuredData="$structuredData"
>

<!-- Hero -->
<section id="hero" class="pt-32 pb-24 bg-gradient-to-b from-blue-950 via-blue-900 to-blue-800 text-white overflow-hidden relative">
    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 30px 30px;"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-16 items-center relative z-10">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-800/50 border border-blue-700 text-blue-200 text-xs font-semibold uppercase tracking-wider mb-6">
                <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                Controle de Contas a Pagar
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold leading-tight tracking-tight">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-200 to-white">Contas a Pagar</span> sob Controle
            </h1>
            <p class="mt-6 text-lg md:text-xl text-emerald-100 leading-relaxed max-w-lg">
                Chega de pagar juros por esquecimento. Centralize suas despesas, receba alertas de vencimento e tenha previsibilidade financeira.
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
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Pequenas Empresas</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">MEI</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Prestadores de Serviço</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Comércio</span>
                </div>
            </div>
        </div>
        <div class="relative">
            <div class="absolute -inset-4 bg-gradient-to-r from-emerald-500 to-cyan-500 rounded-full blur-3xl opacity-20 animate-pulse"></div>
            <div class="bg-white/10 border border-white/20 rounded-3xl p-8 backdrop-blur-md shadow-2xl relative">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <p class="text-sm uppercase text-emerald-200 font-semibold tracking-wider">A Pagar Hoje</p>
                        <h3 class="text-3xl font-bold mt-1">R$ 1.250,00</h3>
                        <div class="flex items-center gap-2 mt-2">
                            <span class="text-xs font-bold text-green-400 bg-green-400/10 px-2 py-0.5 rounded">3 contas vencendo</span>
                        </div>
                    </div>
                    <div class="h-12 w-12 rounded-full bg-emerald-500/20 flex items-center justify-center border border-emerald-400/30">
                        <i class="fa-solid fa-file-invoice-dollar text-emerald-300 text-xl"></i>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-xs text-emerald-200">Total no Mês</p>
                            <span class="text-sm font-bold text-emerald-300">R$ 12.450,00</span>
                        </div>
                        <div class="h-2 bg-emerald-950/50 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-emerald-400 to-cyan-400 w-[65%] rounded-full"></div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                            <p class="text-xs text-emerald-200">Em Atraso</p>
                            <p class="text-2xl font-bold mt-1 text-red-400">0</p>
                        </div>
                        <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                            <p class="text-xs text-emerald-200">Pago</p>
                            <p class="text-2xl font-bold mt-1 text-green-400">R$ 8k</p>
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
            <h2 class="mt-2 text-3xl md:text-4xl font-extrabold text-slate-900">Você paga juros por esquecimento?</h2>
            <p class="mt-4 text-lg text-slate-600">A falta de controle nas contas a pagar corrói o lucro da sua empresa. Veja a diferença:</p>
        </div>
        <div class="grid md:grid-cols-2 gap-8">
            <!-- Pain -->
            <div class="p-8 rounded-3xl bg-red-50 border border-red-100 relative overflow-hidden group hover:shadow-lg transition">
                <div class="absolute top-0 right-0 bg-red-100 text-red-600 text-xs font-bold px-3 py-1 rounded-bl-xl">SEM SISTEMA</div>
                <h3 class="text-xl font-bold text-red-700 mb-6 flex items-center gap-2">
                    <i class="fa-solid fa-circle-xmark"></i> Financeiro Caótico
                </h3>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3 text-slate-700">
                        <i class="fa-solid fa-xmark text-red-500 mt-1"></i>
                        <span>Perde boletos e paga juros abusivos</span>
                    </li>
                    <li class="flex items-start gap-3 text-slate-700">
                        <i class="fa-solid fa-xmark text-red-500 mt-1"></i>
                        <span>Não sabe quanto precisa pagar na semana</span>
                    </li>
                    <li class="flex items-start gap-3 text-slate-700">
                        <i class="fa-solid fa-xmark text-red-500 mt-1"></i>
                        <span>Mistura contas pessoais com as da empresa</span>
                    </li>
                    <li class="flex items-start gap-3 text-slate-700">
                        <i class="fa-solid fa-xmark text-red-500 mt-1"></i>
                        <span>Fica sem caixa por falta de previsão</span>
                    </li>
                </ul>
            </div>
            <!-- Gain -->
            <div class="p-8 rounded-3xl bg-green-50 border border-green-100 relative overflow-hidden shadow-md group hover:shadow-xl transition transform hover:-translate-y-1">
                <div class="absolute top-0 right-0 bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-bl-xl">COM WSOFT</div>
                <h3 class="text-xl font-bold text-green-700 mb-6 flex items-center gap-2">
                    <i class="fa-solid fa-circle-check"></i> Contas em Dia
                </h3>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3 text-slate-700">
                        <i class="fa-solid fa-check text-green-600 mt-1"></i>
                        <span>Alertas de vencimento automáticos</span>
                    </li>
                    <li class="flex items-start gap-3 text-slate-700">
                        <i class="fa-solid fa-check text-green-600 mt-1"></i>
                        <span>Visão clara do fluxo de caixa futuro</span>
                    </li>
                    <li class="flex items-start gap-3 text-slate-700">
                        <i class="fa-solid fa-check text-green-600 mt-1"></i>
                        <span>Categorização de despesas (água, luz, fornecedor)</span>
                    </li>
                    <li class="flex items-start gap-3 text-slate-700">
                        <i class="fa-solid fa-check text-green-600 mt-1"></i>
                        <span>Controle de parcelamentos e recorrentes</span>
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
            <h2 class="mt-4 text-3xl md:text-4xl font-bold text-slate-900">Como funciona o Contas a Pagar</h2>
            <p class="mt-4 text-lg text-slate-600">Organização financeira simplificada para sua tranquilidade.</p>
        </div>

        <div class="space-y-24">
            <!-- Step 1 -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 group">
                        <div class="absolute inset-0 bg-emerald-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="/images/crm/registration.png" alt="Lançamento de Despesas" class="w-full h-auto transform group-hover:scale-105 transition duration-700">
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-emerald-100 text-emerald-700 font-bold text-xl">1</span>
                        <h3 class="text-2xl font-bold text-slate-900">Lance suas Despesas</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Registre contas de luz, água, aluguel e boletos de fornecedores. Configure repetições mensais para não precisar lançar todo mês.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Lançamento rápido e intuitivo</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Anexo de comprovantes e boletos</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-1">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-emerald-100 text-emerald-700 font-bold text-xl">2</span>
                        <h3 class="text-2xl font-bold text-slate-900">Acompanhe Vencimentos</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Veja no calendário o que precisa ser pago. O sistema destaca o que está vencendo hoje e o que está atrasado.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Calendário financeiro visual</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Notificações de vencimento</span>
                        </li>
                    </ul>
                </div>
                <div class="order-2">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 group">
                        <div class="absolute inset-0 bg-emerald-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="/images/crm/history.png" alt="Calendário de Pagamentos" class="w-full h-auto transform group-hover:scale-105 transition duration-700">
                    </div>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 group">
                        <div class="absolute inset-0 bg-emerald-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="/images/crm/reports.png" alt="Relatórios Financeiros" class="w-full h-auto transform group-hover:scale-105 transition duration-700">
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-emerald-100 text-emerald-700 font-bold text-xl">3</span>
                        <h3 class="text-2xl font-bold text-slate-900">Controle o Fluxo</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Dê baixa nos pagamentos realizados e veja relatórios de despesas por categoria. Saiba para onde está indo seu dinheiro.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Relatórios de despesas por categoria</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Conciliação bancária simples</span>
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
            <h2 class="mt-4 text-3xl md:text-4xl font-bold">Por que usar um sistema de contas a pagar?</h2>
            <p class="mt-4 text-lg text-slate-600">Mais organização e menos gastos desnecessários</p>
        </div>
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-piggy-bank text-emerald-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Economia Real</h3>
                    <p class="mt-3 text-slate-600">Elimine multas e juros por atraso. O sistema lembra você de pagar na data certa.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-chart-pie text-blue-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Visão de Custos</h3>
                    <p class="mt-3 text-slate-600">Entenda seus custos fixos e variáveis. Saiba onde cortar gastos para aumentar o lucro.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-calendar-check text-purple-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Previsibilidade</h3>
                    <p class="mt-3 text-slate-600">Saiba exatamente quanto precisará ter em caixa na próxima semana ou mês.</p>
                </div>
            </article>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-br from-emerald-600 to-blue-600 text-white relative overflow-hidden">
    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 30px 30px;"></div>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 border border-white/20 text-white text-xs font-semibold uppercase tracking-wider mb-6">
            <i class="fa-solid fa-tag text-yellow-300"></i>
            Oferta Especial
        </div>
        <h2 class="text-3xl md:text-5xl font-bold leading-tight">
            Tenha controle total por apenas <br>
            <span class="text-yellow-300">R$ 29,90/mês</span>
        </h2>
        <p class="mt-6 text-lg md:text-xl text-emerald-50 max-w-2xl mx-auto">
            Menos de R$ 1,00 por dia para organizar o financeiro da sua empresa e nunca mais pagar juros.
        </p>
        
        <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="/app/register" class="group inline-flex justify-center items-center rounded-xl bg-white text-emerald-700 font-bold px-10 py-5 text-lg shadow-xl shadow-emerald-900/20 hover:bg-emerald-50 hover:-translate-y-1 transition transform duration-200">
                Quero Organizar Minha Empresa
                <i class="fa-solid fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>
        <p class="mt-6 text-sm text-emerald-100 flex items-center justify-center gap-6">
            <span class="flex items-center gap-2"><i class="fa-solid fa-check-circle text-emerald-300"></i> 7 dias grátis</span>
            <span class="flex items-center gap-2"><i class="fa-solid fa-check-circle text-emerald-300"></i> Sem fidelidade</span>
            <span class="flex items-center gap-2"><i class="fa-solid fa-check-circle text-emerald-300"></i> Cancelamento fácil</span>
        </p>
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
                    Posso anexar o boleto na conta?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Sim! Você pode anexar arquivos (PDF, imagens) em cada lançamento para manter tudo organizado.</p>
            </details>
            <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    Consigo lançar compras parceladas?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Sim! Ao lançar uma despesa, você pode informar o número de parcelas e o sistema gera os lançamentos futuros automaticamente.</p>
            </details>
        </div>
    </div>
</section>

</x-site-layout>
