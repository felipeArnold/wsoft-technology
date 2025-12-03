@php
$structuredData = [
    [
        '@context' => 'https://schema.org',
        '@type' => 'SoftwareApplication',
        'name' => 'WSoft - Sistema de Fluxo de Caixa',
        'url' => 'https://www.wsoft.dev.br/sistema-para-fluxo-de-caixa',
        'description' => 'Sistema completo para controle de fluxo de caixa e movimentação financeira. Acompanhe entradas e saídas, saldo diário e saúde financeira.',
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
            'ratingCount' => '134'
        ]
    ],
    [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => [
            [
                '@type' => 'Question',
                'name' => 'O que é fluxo de caixa?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Fluxo de caixa é o controle de todas as entradas (vendas) e saídas (despesas) de dinheiro da sua empresa. É essencial para saber se o negócio está dando lucro.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'Como saber se estou tendo lucro?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'O WSoft gera relatórios automáticos (DRE) que mostram exatamente quanto você vendeu, quanto gastou e qual foi o seu lucro líquido no período.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'Posso controlar contas bancárias?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Sim! Você pode cadastrar várias contas (caixa físico, bancos) e controlar o saldo de cada uma separadamente.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'O sistema faz fechamento de caixa?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Sim! O sistema permite realizar a abertura e fechamento de caixa diário, conferindo os valores em dinheiro, cartão e outros meios.'
                ]
            ]
        ]
    ]
];
@endphp

<x-site-layout
    :title="'Sistema de Fluxo de Caixa | Movimentação Financeira | WSoft'"
    :description="'Controle total do seu dinheiro. Sistema de fluxo de caixa e movimentação financeira para pequenas empresas. Teste grátis!'"
    :keywords="'fluxo de caixa, movimentação financeira, controle financeiro, gestão de caixa, livro caixa, sistema financeiro, controle de gastos'"
    :canonical="'https://www.wsoft.dev.br/sistema-para-fluxo-de-caixa'"
    :ogTitle="'Sistema de Fluxo de Caixa e Financeiro | WSoft'"
    :ogDescription="'Saiba para onde vai cada centavo. Controle entradas, saídas e tenha visão total da saúde financeira da sua empresa.'"
    :structuredData="$structuredData"
>

<!-- Hero -->
<section id="hero" class="pt-32 pb-24 bg-gradient-to-b from-blue-950 via-blue-900 to-blue-800 text-white overflow-hidden relative">
    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 30px 30px;"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-16 items-center relative z-10">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-800/50 border border-blue-700 text-blue-200 text-xs font-semibold uppercase tracking-wider mb-6">
                <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                Fluxo de Caixa
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold leading-tight tracking-tight">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-200 to-white">Saúde Financeira</span> em Dia
            </h1>
            <p class="mt-6 text-lg md:text-xl text-emerald-100 leading-relaxed max-w-lg">
                Tenha o controle total do seu dinheiro. Acompanhe entradas, saídas e saiba exatamente qual é o lucro da sua empresa em tempo real.
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
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Todas as Empresas</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">MEI</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Autônomos</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Comércio e Serviços</span>
                </div>
            </div>
        </div>
        <div class="relative">
            <div class="absolute -inset-4 bg-gradient-to-r from-emerald-500 to-cyan-500 rounded-full blur-3xl opacity-20 animate-pulse"></div>
            <div class="bg-white/10 border border-white/20 rounded-3xl p-8 backdrop-blur-md shadow-2xl relative">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <p class="text-sm uppercase text-emerald-200 font-semibold tracking-wider">Saldo Atual</p>
                        <h3 class="text-3xl font-bold mt-1">R$ 15.420,00</h3>
                        <div class="flex items-center gap-2 mt-2">
                            <span class="text-xs font-bold text-green-400 bg-green-400/10 px-2 py-0.5 rounded">+ R$ 2.300 hoje</span>
                        </div>
                    </div>
                    <div class="h-12 w-12 rounded-full bg-emerald-500/20 flex items-center justify-center border border-emerald-400/30">
                        <i class="fa-solid fa-scale-balanced text-emerald-300 text-xl"></i>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-xs text-emerald-200">Lucro no Mês</p>
                            <span class="text-sm font-bold text-emerald-300">R$ 8.900,00</span>
                        </div>
                        <div class="h-2 bg-emerald-950/50 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-emerald-400 to-cyan-400 w-[70%] rounded-full"></div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                            <p class="text-xs text-emerald-200">Entradas</p>
                            <p class="text-2xl font-bold mt-1 text-green-400">R$ 25k</p>
                        </div>
                        <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                            <p class="text-xs text-emerald-200">Saídas</p>
                            <p class="text-2xl font-bold mt-1 text-red-400">R$ 16k</p>
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
            <span class="text-red-600 font-bold tracking-wider uppercase text-sm">O problema da cegueira financeira</span>
            <h2 class="mt-2 text-3xl md:text-4xl font-extrabold text-slate-900">Sua empresa dá lucro ou prejuízo?</h2>
            <p class="mt-4 text-lg text-slate-600">Muitos empresários trabalham muito e não veem a cor do dinheiro. Veja a diferença:</p>
        </div>
        <div class="grid md:grid-cols-2 gap-8">
            <!-- Pain -->
            <div class="p-8 rounded-3xl bg-red-50 border border-red-100 relative overflow-hidden group hover:shadow-lg transition">
                <div class="absolute top-0 right-0 bg-red-100 text-red-600 text-xs font-bold px-3 py-1 rounded-bl-xl">SEM SISTEMA</div>
                <h3 class="text-xl font-bold text-red-700 mb-6 flex items-center gap-2">
                    <i class="fa-solid fa-circle-xmark"></i> Gestão no Escuro
                </h3>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3 text-slate-700">
                        <i class="fa-solid fa-xmark text-red-500 mt-1"></i>
                        <span>Mistura dinheiro pessoal com o da empresa</span>
                    </li>
                    <li class="flex items-start gap-3 text-slate-700">
                        <i class="fa-solid fa-xmark text-red-500 mt-1"></i>
                        <span>Não sabe para onde foi o dinheiro no fim do mês</span>
                    </li>
                    <li class="flex items-start gap-3 text-slate-700">
                        <i class="fa-solid fa-xmark text-red-500 mt-1"></i>
                        <span>Toma decisões baseadas em "achismo"</span>
                    </li>
                    <li class="flex items-start gap-3 text-slate-700">
                        <i class="fa-solid fa-xmark text-red-500 mt-1"></i>
                        <span>Risco alto de quebrar por falta de caixa</span>
                    </li>
                </ul>
            </div>
            <!-- Gain -->
            <div class="p-8 rounded-3xl bg-green-50 border border-green-100 relative overflow-hidden shadow-md group hover:shadow-xl transition transform hover:-translate-y-1">
                <div class="absolute top-0 right-0 bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-bl-xl">COM WSOFT</div>
                <h3 class="text-xl font-bold text-green-700 mb-6 flex items-center gap-2">
                    <i class="fa-solid fa-circle-check"></i> Visão Clara
                </h3>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3 text-slate-700">
                        <i class="fa-solid fa-check text-green-600 mt-1"></i>
                        <span>Relatórios precisos de lucro e prejuízo (DRE)</span>
                    </li>
                    <li class="flex items-start gap-3 text-slate-700">
                        <i class="fa-solid fa-check text-green-600 mt-1"></i>
                        <span>Controle de múltiplas contas e caixas</span>
                    </li>
                    <li class="flex items-start gap-3 text-slate-700">
                        <i class="fa-solid fa-check text-green-600 mt-1"></i>
                        <span>Decisões estratégicas baseadas em dados</span>
                    </li>
                    <li class="flex items-start gap-3 text-slate-700">
                        <i class="fa-solid fa-check text-green-600 mt-1"></i>
                        <span>Crescimento sustentável e previsível</span>
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
            <h2 class="mt-4 text-3xl md:text-4xl font-bold text-slate-900">Como funciona o Fluxo de Caixa</h2>
            <p class="mt-4 text-lg text-slate-600">Controle financeiro completo em 3 etapas.</p>
        </div>

        <div class="space-y-24">
            <!-- Step 1 -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 group">
                        <div class="absolute inset-0 bg-emerald-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="/images/crm/registration.png" alt="Registro de Movimentações" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-emerald-100 text-emerald-700 font-bold text-xl">1</span>
                        <h3 class="text-2xl font-bold text-slate-900">Registre Tudo</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Cada venda, cada pagamento, cada retirada. Tudo é registrado no sistema para compor o seu fluxo de caixa.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Lançamentos simples e rápidos</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Categorização automática</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-1">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-emerald-100 text-emerald-700 font-bold text-xl">2</span>
                        <h3 class="text-2xl font-bold text-slate-900">Acompanhe o Saldo</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Veja o saldo de cada conta bancária e do caixa físico em tempo real. Faça transferências e sangrias com segurança.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Saldo consolidado e por conta</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Fechamento de caixa diário</span>
                        </li>
                    </ul>
                </div>
                <div class="order-2">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 group">
                        <div class="absolute inset-0 bg-emerald-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="/images/crm/history.png" alt="Acompanhamento de Saldo" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 group">
                        <div class="absolute inset-0 bg-emerald-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="/images/crm/reports.png" alt="Relatórios de DRE" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-emerald-100 text-emerald-700 font-bold text-xl">3</span>
                        <h3 class="text-2xl font-bold text-slate-900">Analise o Resultado</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Gere o DRE (Demonstrativo de Resultado) e veja se sua empresa teve lucro ou prejuízo no mês.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>DRE Gerencial automático</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Gráficos de evolução financeira</span>
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
            <h2 class="mt-4 text-3xl md:text-4xl font-bold">Por que controlar o fluxo de caixa?</h2>
            <p class="mt-4 text-lg text-slate-600">O coração da sua empresa</p>
        </div>
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-chart-line text-emerald-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Crescimento</h3>
                    <p class="mt-3 text-slate-600">Só cresce quem tem controle. Saiba onde investir e onde cortar custos.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-eye text-blue-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Transparência</h3>
                    <p class="mt-3 text-slate-600">Tenha os números do seu negócio na palma da mão, a qualquer hora e lugar.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-lock text-purple-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Segurança</h3>
                    <p class="mt-3 text-slate-600">Evite desvios e erros de caixa com o fechamento diário e conferência de valores.</p>
                </div>
            </article>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-br from-emerald-600 to-blue-600 text-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold">Assuma o controle financeiro</h2>
        <p class="mt-4 text-lg text-white/90 max-w-2xl mx-auto">
            Teste o sistema de fluxo de caixa gratuitamente por 7 dias.
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
                    Posso separar contas pessoais e da empresa?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Sim! O ideal é não misturar, mas o sistema permite criar categorias separadas ou contas diferentes para organizar tudo.</p>
            </details>
            <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    O sistema gera relatórios para o contador?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Sim! Você pode exportar relatórios financeiros e enviar para seu contador facilitar a contabilidade.</p>
            </details>
        </div>
    </div>
</section>

</x-site-layout>
