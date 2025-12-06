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
    :keywords="'contas a pagar, controle de despesas, gestão financeira, software financeiro, contas a pagar e receber, planilha de gastos, controle de pagamentos, contas a pagar planilha, planilha de contas a pagar e receber, planilha de contas a pagar para imprimir, sistema financeiro empresa, planilha contas a pagar mensal, contas a pagar excel'"
    :canonical="'https://www.wsoft.dev.br/sistema-para-contas-a-pagar'"
    :ogTitle="'Sistema de Contas a Pagar e Despesas | WSoft'"
    :ogDescription="'Evite juros e multas. Organize suas contas a pagar, controle vencimentos e tenha previsão de caixa com o WSoft.'"
    :structuredData="$structuredData"
>

<x-site.hero
    badge="Controle de Contas a Pagar"
    highlight="Contas a Pagar"
    title="sob Controle"
    description="Chega de pagar juros por esquecimento. Centralize suas despesas, receba alertas de vencimento e tenha previsibilidade financeira."
    :idealFor="['Pequenas Empresas', 'MEI', 'Prestadores de Serviço', 'Comércio']"
>
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
</x-site.hero>

<!-- Pain vs Gain -->
<x-site.comparison
    title="Você paga juros por esquecimento?"
    subtitle="Controle de Contas a Pagar"
    description="A falta de controle nas contas a pagar corrói o lucro da sua empresa. Veja a diferença:"
    painTitle="Financeiro Caótico"
    :painItems="[
    'Perde boletos e paga juros abusivos',
    'Não sabe quanto precisa pagar na semana',
    'Mistura contas pessoais com as da empresa',
    'Fica sem caixa por falta de previsão'
]"
        gainTitle="Contas em Dia"
        :gainItems="[
    'Alertas de vencimento automáticos',
    'Visão clara do fluxo de caixa futuro',
    'Categorização de despesas (água, luz, fornecedor)',
    'Controle de parcelamentos e recorrentes'
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
            <h2 class="mt-4 text-3xl md:text-4xl font-bold text-slate-900">Como funciona o Contas a Pagar</h2>
            <p class="mt-4 text-lg text-slate-600">Sistema completo de gestão financeira para sua empresa.</p>
        </div>

        <div class="space-y-24">
            <!-- Step 1 - Cadastro de Fornecedores -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 group">
                        <div class="absolute inset-0 bg-emerald-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="/images/crm/registration.png" alt="Cadastro de Fornecedores" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-emerald-100 text-emerald-700 font-bold text-xl">1</span>
                        <h3 class="text-2xl font-bold text-slate-900">Cadastre seus Fornecedores</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Organize todos os fornecedores em um único lugar. Tenha acesso rápido a contatos, dados bancários e histórico de pagamentos.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Dados completos: CNPJ, telefone, e-mail</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Informações bancárias para pagamento</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Histórico de relacionamento comercial</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Step 2 - Contas a Pagar -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-1">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-emerald-100 text-emerald-700 font-bold text-xl">2</span>
                        <h3 class="text-2xl font-bold text-slate-900">Lance suas Contas a Pagar</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Registre todas as despesas: luz, água, aluguel, fornecedores, impostos. Configure repetições mensais para contas fixas.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Lançamento rápido e intuitivo</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Anexo de boletos e comprovantes</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Parcelamento e contas recorrentes</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Categorização por tipo de despesa</span>
                        </li>
                    </ul>
                </div>
                <div class="order-2">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 group">
                        <div class="absolute inset-0 bg-emerald-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="/images/crm/history.png" alt="Cadastro de Contas a Pagar" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
            </div>

            <!-- Step 3 - Vencimentos -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 group">
                        <div class="absolute inset-0 bg-emerald-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="/images/crm/reports.png" alt="Calendário de Vencimentos" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-emerald-100 text-emerald-700 font-bold text-xl">3</span>
                        <h3 class="text-2xl font-bold text-slate-900">Acompanhe Vencimentos</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Visualize no calendário tudo que precisa ser pago. Alertas automáticos evitam esquecimentos e juros desnecessários.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Calendário financeiro visual</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Notificações de vencimento automáticas</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Destaque para contas em atraso</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Projeção de pagamentos futuros</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Step 4 - Movimentação Financeira -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-1">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-emerald-100 text-emerald-700 font-bold text-xl">4</span>
                        <h3 class="text-2xl font-bold text-slate-900">Controle a Movimentação Financeira</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Dê baixa nos pagamentos realizados e acompanhe o saldo em cada conta bancária. Tenha controle total do fluxo de caixa.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Baixa de pagamentos por conta bancária</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Controle de saldo de caixa e bancos</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Histórico completo de movimentações</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Transferências entre contas</span>
                        </li>
                    </ul>
                </div>
                <div class="order-2">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 group">
                        <div class="absolute inset-0 bg-emerald-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="/images/crm/dashboard-preview.png" alt="Movimentação Financeira" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
            </div>

            <!-- Step 5 - Relatórios -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 group">
                        <div class="absolute inset-0 bg-emerald-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="/images/crm/reports.png" alt="Relatórios Financeiros" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-emerald-100 text-emerald-700 font-bold text-xl">5</span>
                        <h3 class="text-2xl font-bold text-slate-900">Analise com Relatórios</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Relatórios completos mostram para onde está indo seu dinheiro. Identifique oportunidades de economia e melhore resultados.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Despesas por categoria e fornecedor</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Fluxo de caixa projetado e realizado</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Comparativo entre períodos</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Exportação para Excel e PDF</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

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
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-users text-orange-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Gestão de Fornecedores</h3>
                    <p class="mt-3 text-slate-600">Organize todos os fornecedores em um só lugar. Histórico completo de pagamentos e dados bancários.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-money-bill-trend-up text-red-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Fluxo de Caixa</h3>
                    <p class="mt-3 text-slate-600">Controle completo de entradas e saídas. Movimentação financeira organizada por conta bancária.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-teal-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-file-invoice-dollar text-teal-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Controle de Despesas</h3>
                    <p class="mt-3 text-slate-600">Categorize todas as despesas: aluguel, luz, água, impostos. Relatórios detalhados por categoria.</p>
                </div>
            </article>
        </div>

        <div class="text-center mt-16">
            <a
                href="/app/register"
                class="inline-flex items-center gap-3 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-500 hover:to-blue-400 text-white font-bold px-8 py-4 rounded-xl shadow-lg shadow-blue-500/20 hover:shadow-blue-500/40 transform hover:-translate-y-0.5 transition-all duration-300"
            >
                <i class="fa-solid fa-rocket text-xl"></i>
                <span>Experimente Grátis por 7 Dias</span>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
            <p class="mt-4 text-sm text-slate-500">Cancele quando quiser</p>
        </div>
    </div>
</section>

<!-- Planilha vs Sistema (New SEO Section) -->
<section class="py-24 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mt-16 text-center">
            <x-site.cta-inline
                title="Migre da Planilha de Contas a Pagar para um Sistema Profissional"
                description="Elimine erros manuais, fórmulas quebradas e retrabalho. Com o WSoft, automatize o controle de contas a pagar, receba alertas de vencimento e mantenha seu fluxo de caixa sempre organizado."
                buttonText="Testar Sistema Gratuitamente"
                buttonUrl="/app/register"
                gradient="from-blue-900 to-blue-700"
                icon="fa-solid fa-file-excel"
            />
        </div>
    </div>
</section>

<!-- Sistema Financeiro Completo (New SEO Section) -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div>
                <span class="text-blue-600 font-bold tracking-wider uppercase text-sm">Muito mais que o básico</span>
                <h2 class="mt-2 text-3xl md:text-4xl font-extrabold text-slate-900">Um Sistema Financeiro para Empresa Completo</h2>
                <p class="mt-6 text-lg text-slate-600">
                    Não se limite a uma <strong>planilha contas a pagar mensal</strong>. O WSoft oferece uma gestão 360º para o seu negócio crescer.
                </p>
                
                <div class="mt-8 space-y-6">
                    <div class="flex gap-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                            <i class="fa-solid fa-chart-line text-blue-600 text-xl"></i>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-slate-900">Relatórios Gerenciais</h4>
                            <p class="text-slate-600">Vá além do "pagar e receber". Analise DRE, fluxo de caixa e lucratividade em tempo real.</p>
                        </div>
                    </div>
                    
                    <div class="flex gap-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center">
                            <i class="fa-solid fa-file-invoice text-indigo-600 text-xl"></i>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-slate-900">Emissão de Boletos e Notas</h4>
                            <p class="text-slate-600">Integre suas contas a receber com emissão de boletos e notas fiscais em poucos cliques.</p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                            <i class="fa-solid fa-users text-emerald-600 text-xl"></i>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-slate-900">Gestão de Clientes</h4>
                            <p class="text-slate-600">Mantenha o histórico financeiro de cada cliente organizado e acessível.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="relative">
                <div class="absolute -inset-4 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-full blur-3xl opacity-20"></div>
                <img src="/images/crm/dashboard-preview.png" alt="Sistema Financeiro Completo" class="relative rounded-2xl shadow-2xl border border-slate-200" loading="lazy" decoding="async">
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<x-site.cta-final
    :title="'Escolha um sistema completo para gestão de contas a pagar'"
    :description="'Comece agora com 7 dias de teste grátis. Use o melhor <strong>sistema para controle de contas a pagar</strong> por apenas <span class=\'text-yellow-300 font-bold\'>R$ 29,90/mês</span>.'"
    :footer="'Junte-se a centenas de empresas que usam WSoft'"
    :gradient="'bg-gradient-to-br from-blue-950 to-blue-700'"
    :textColor="'text-blue-50'"
    :highlightColor="'text-yellow-300'"
/>

@livewire('landing-registration-form', [
    'source' => 'site_contas_pagar',
    'title' => 'Comece agora gratuitamente',
    'subtitle' => 'Junte-se a centenas de empresas que já eliminaram multas e juros por atraso com o WSoft.',
    'gradient' => 'from-blue-900 to-blue-700',
    'buttonText' => 'Testar por 7 Dias Grátis',
    'buttonColor' => 'blue',
    'focusColor' => 'blue'
])


<x-site.faq
    title="Perguntas Frequentes sobre Sistema de Contas a Pagar"
    subtitle="FAQ"
    subtitleColor="text-blue-600"
    :questions="[
        [
            'question' => 'Como funciona o controle de contas a pagar no WSoft?',
            'answer' => 'O <strong>sistema de contas a pagar</strong> do WSoft permite cadastrar todas as suas despesas, definir datas de vencimento, categorizar por fornecedor e receber <strong>alertas automáticos de vencimento</strong> por e-mail e WhatsApp. Você também pode anexar boletos e notas fiscais em cada lançamento para manter toda a documentação organizada em um só lugar.'
        ],
        [
            'question' => 'Posso parcelar despesas e controlar compras a prazo?',
            'answer' => 'Sim! O <strong>sistema para gerenciar contas a pagar</strong> permite lançar <strong>compras parceladas</strong> automaticamente. Ao cadastrar uma despesa, você informa o número de parcelas e o sistema gera todos os lançamentos futuros com as datas corretas, facilitando o <strong>controle financeiro</strong> e a <strong>previsão de caixa</strong>.'
        ],
        [
            'question' => 'O sistema substitui planilhas de contas a pagar Excel?',
            'answer' => 'Sim! O WSoft é a evolução da tradicional <strong>planilha de contas a pagar e receber</strong>. Diferente do Excel, oferece <strong>automação de processos</strong>, alertas inteligentes de vencimento, relatórios financeiros automáticos, acesso em nuvem de qualquer lugar, backup automático e segurança de dados. Sem fórmulas quebradas ou erros manuais.'
        ],
        [
            'question' => 'Como evitar multas e juros por atraso de pagamento?',
            'answer' => 'O WSoft envia <strong>notificações automáticas de vencimento</strong> por e-mail e WhatsApp antes das datas de pagamento. Você também pode visualizar o <strong>dashboard de contas a pagar</strong> com todas as obrigações do dia, da semana e do mês, garantindo que nenhuma conta seja esquecida. Ideal para pequenas empresas que querem evitar custos extras com multas.'
        ],
        [
            'question' => 'Posso integrar contas a pagar com fluxo de caixa?',
            'answer' => 'Sim! O <strong>módulo de contas a pagar</strong> está integrado ao <strong>fluxo de caixa</strong> do WSoft. Todas as despesas lançadas impactam automaticamente o saldo disponível, permitindo uma <strong>gestão financeira completa</strong> e <strong>previsibilidade de caixa</strong> para sua empresa.'
        ],
        [
            'question' => 'É possível categorizar fornecedores e tipos de despesa?',
            'answer' => 'Sim! O sistema permite criar categorias personalizadas de despesas (aluguel, fornecedores, impostos, salários, etc.) e vincular cada <strong>conta a pagar</strong> ao fornecedor correspondente. Isso facilita a geração de <strong>relatórios gerenciais</strong> e a análise de custos por categoria.'
        ],
        [
            'question' => 'Quanto custa um sistema de contas a pagar?',
            'answer' => 'O WSoft oferece um plano completo de <strong>gestão de contas a pagar</strong> a partir de <strong>R$ 29,90/mês</strong>, com <strong>7 dias de teste grátis</strong> e sem necessidade de cartão de crédito. Inclui contas a pagar e receber, fluxo de caixa, relatórios financeiros, alertas automáticos e suporte técnico.'
        ]
    ]"
/>

</x-site-layout>
