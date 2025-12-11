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
            'url' => 'https://www.wsoft.dev.br/sistema-para-fluxo-de-caixa',
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
    ],
    [
        '@context' => 'https://schema.org',
        '@type' => 'HowTo',
        'name' => 'Como fazer Fluxo de Caixa com WSoft',
        'description' => 'Guia rápido para registrar movimentações e analisar a saúde financeira.',
        'step' => [
            [
                '@type' => 'HowToStep',
                'name' => 'Registre Tudo',
                'text' => 'Cada venda, cada pagamento, cada retirada. Tudo é registrado no sistema para compor o seu fluxo de caixa.',
                'position' => 1
            ],
            [
                '@type' => 'HowToStep',
                'name' => 'Acompanhe o Saldo',
                'text' => 'Veja o saldo de cada conta bancária e do caixa físico em tempo real. Faça transferências e sangrias com segurança.',
                'position' => 2
            ],
            [
                '@type' => 'HowToStep',
                'name' => 'Analise o Resultado',
                'text' => 'Gere o DRE (Demonstrativo de Resultado) e veja se sua empresa teve lucro ou prejuízo no mês.',
                'position' => 3
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

<x-site.hero
    badge="Fluxo de Caixa"
    title="Movimentação Financeira em Tempo Real"
    highlight="Controle sua "
    description="Tenha o controle total do seu dinheiro. Acompanhe entradas, saídas e saiba exatamente qual é o lucro da sua empresa em tempo real."
    primaryButtonText="Teste grátis por 7 dias"
    primaryButtonUrl="/app/register"
    secondaryButtonText="Como Funciona"
    secondaryButtonUrl="#como-funciona"
    :idealFor="['Todas as Empresas', 'MEI', 'Autônomos', 'Comércio e Serviços']"
    gradient="from-blue-950 to-blue-700"
    highlightGradient="from-blue-200 to-white"
>
    <div class="relative">
        <div class="absolute -inset-4 bg-gradient-to-r from-emerald-500 to-cyan-500 rounded-full blur-3xl opacity-20 animate-pulse"></div>
        <div class="bg-white/10 border border-white/20 rounded-3xl p-8 backdrop-blur-md shadow-2xl relative">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <p class="text-sm uppercase text-blue-200 font-semibold tracking-wider">Saldo Atual</p>
                    <h3 class="text-3xl font-bold mt-1">R$ 15.420,00</h3>
                    <div class="flex items-center gap-2 mt-2">
                        <span class="text-xs font-bold text-green-400 bg-green-400/10 px-2 py-0.5 rounded">+ R$ 2.300 hoje</span>
                    </div>
                </div>
                <div class="h-12 w-12 rounded-full bg-blue-500/20 flex items-center justify-center border border-blue-400/30">
                    <i class="fa-solid fa-scale-balanced text-blue-300 text-xl"></i>
                </div>
            </div>
            <div class="space-y-4">
                <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                    <div class="flex items-center justify-between mb-2">
                        <p class="text-xs text-blue-200">Lucro no Mês</p>
                        <span class="text-sm font-bold text-blue-300">R$ 8.900,00</span>
                    </div>
                    <div class="h-2 bg-blue-950/50 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-blue-400 to-cyan-400 w-[70%] rounded-full"></div>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                        <p class="text-xs text-blue-200">Entradas</p>
                        <p class="text-2xl font-bold mt-1 text-green-400">R$ 25k</p>
                    </div>
                    <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                        <p class="text-xs text-blue-200">Saídas</p>
                        <p class="text-2xl font-bold mt-1 text-red-400">R$ 16k</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-site.hero>

<!-- Pain vs Gain -->
<x-site.comparison
    title="Sua empresa dá lucro ou prejuízo?"
    subtitle="O problema da cegueira financeira"
    description="Muitos empresários trabalham muito e não veem a cor do dinheiro. Veja a diferença:"
    painTitle="Gestão no Escuro"
    :painItems="[
        'Mistura dinheiro pessoal com o da empresa',
        'Não sabe para onde foi o dinheiro no fim do mês',
        'Toma decisões baseadas em achismo',
        'Risco alto de quebrar por falta de caixa'
    ]"
    gainTitle="Visão Clara"
    :gainItems="[
        'Relatórios precisos de lucro e prejuízo (DRE)',
        'Controle de múltiplas contas e caixas',
        'Decisões estratégicas baseadas em dados',
        'Crescimento sustentável e previsível'
    ]"
    gainCardBg="bg-blue-900"
    gainCardBorder="border-blue-800"
    gainTitleColor="text-emerald-400"
    gainCheckColor="text-emerald-400"
    gainBadgeBg="bg-blue-500"
    gainBadgeText="COM WSOFT"
    buttonColor="blue"
/>


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

        <div class="mt-16 text-center">
            <a href="/app/register" class="inline-flex items-center gap-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-8 py-4 rounded-xl shadow-lg shadow-emerald-500/20 hover:shadow-emerald-500/40 transform hover:-translate-y-0.5 transition-all duration-300">
                <span>Testar Gratuitamente</span>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
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

<!-- CTA Inline -->
<section class="py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-site.cta-inline
            title="Diga Adeus às Planilhas de Fluxo de Caixa"
            description="Chega de planilhas complexas e erros manuais. Com o WSoft, você tem controle financeiro profissional, DRE automático e visão clara do lucro em tempo real."
            buttonText="Falar no WhatsApp"
            buttonUrl="https://wa.me/5551999350578"
            gradient="from-blue-900 to-blue-700"
            icon="fa-solid fa-chart-line"
        />

        <div class="mt-8 text-center">
            <a href="/app/register" class="inline-flex items-center gap-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-8 py-4 rounded-xl shadow-lg shadow-emerald-500/20 hover:shadow-emerald-500/40 transform hover:-translate-y-0.5 transition-all duration-300">
                <span>Testar Gratuitamente</span>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- CTA Section -->
<x-site.cta-final
    :title="'Escolha um sistema completo para controle de movimentação financeira'"
    :description="'Comece agora com 7 dias de teste grátis. Use o melhor <strong>sistema para controle de fluxo de caixa</strong> por apenas <span class=\'text-yellow-300 font-bold\'>R$ 29,90/mês</span>.'"
    :footer="'Junte-se a centenas de empresas que usam WSoft'"
    :gradient="'bg-gradient-to-br from-blue-950 to-blue-700'"
    :textColor="'text-blue-50'"
    :highlightColor="'text-yellow-300'"
/>

@livewire('landing-registration-form', [
    'source' => 'site_movimentacao_financeira',
    'title' => 'Comece agora gratuitamente',
    'subtitle' => 'Tenha controle total do seu fluxo de caixa e saiba exatamente qual é o lucro da sua empresa.',
    'gradient' => 'from-blue-900 to-blue-700',
    'buttonText' => 'Testar por 7 Dias Grátis',
    'buttonColor' => 'blue',
    'focusColor' => 'blue'
])


<x-site.faq
    title="Perguntas Frequentes sobre Fluxo de Caixa"
    subtitle="FAQ"
    subtitleColor="text-blue-600"
    :questions="[
        [
            'question' => 'O que é fluxo de caixa e para que serve?',
            'answer' => '<strong>Fluxo de caixa</strong> é o registro de todas as entradas (vendas, recebimentos) e saídas (pagamentos, despesas) de dinheiro da sua empresa. É fundamental para saber se o negócio está dando lucro ou prejuízo e planejar investimentos futuros.'
        ],
        [
            'question' => 'Como fazer controle de fluxo de caixa eficiente?',
            'answer' => 'Para um <strong>controle de fluxo de caixa eficiente</strong>, registre todas as movimentações diariamente, separe dinheiro pessoal do empresarial, categorize receitas e despesas, e analise relatórios mensais. Um sistema automatizado como o WSoft facilita muito esse processo.'
        ],
        [
            'question' => 'Qual a diferença entre fluxo de caixa e DRE?',
            'answer' => 'O <strong>fluxo de caixa</strong> mostra o movimento do dinheiro (quando entra e sai fisicamente). Já o <strong>DRE (Demonstrativo de Resultado)</strong> mostra o resultado econômico (receitas menos despesas), independente de quando o dinheiro entrou ou saiu. Ambos são importantes.'
        ],
        [
            'question' => 'Como saber se estou tendo lucro real?',
            'answer' => 'O WSoft gera o <strong>DRE automático</strong> que mostra exatamente quanto você vendeu (receita), quanto gastou (despesas) e qual foi o lucro líquido. Assim você sabe se está ganhando dinheiro de verdade, não apenas se tem dinheiro no caixa.'
        ],
        [
            'question' => 'Posso controlar várias contas bancárias no sistema?',
            'answer' => 'Sim! Você pode cadastrar <strong>múltiplas contas bancárias</strong>, caixa físico, carteiras digitais e acompanhar o saldo de cada uma separadamente. O sistema também permite fazer transferências entre contas.'
        ],
        [
            'question' => 'O sistema faz fechamento de caixa diário?',
            'answer' => 'Sim! O WSoft permite fazer <strong>abertura e fechamento de caixa</strong> conferindo valores em dinheiro, cartão, Pix e outros meios de pagamento. Isso evita desvios e erros no controle financeiro.'
        ],
        [
            'question' => 'Qual o melhor sistema para controle financeiro?',
            'answer' => 'O <strong>WSoft</strong> é ideal para pequenas empresas que buscam um sistema completo de controle financeiro com fluxo de caixa, DRE automático, controle de contas a pagar e receber, múltiplas contas bancárias e relatórios gerenciais por apenas R$ 29,90/mês.'
        ]
    ]"
/>

</x-site-layout>
