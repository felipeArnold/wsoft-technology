@php
$structuredData = [
    [
        '@context' => 'https://schema.org',
        '@type' => 'SoftwareApplication',
        'name' => 'WSoft - Sistema de Contas a Receber',
        'url' => 'https://www.wsoft.dev.br/sistema-para-contas-a-receber',
        'description' => 'Sistema completo para controle de contas a receber. Gerencie recebimentos, reduza inadimplência e tenha previsão de caixa.',
        'operatingSystem' => 'Web',
        'applicationCategory' => 'FinanceApplication',
        'offers' => [
            '@type' => 'Offer',
            'price' => '29.90',
            'priceCurrency' => 'BRL',
            'url' => 'https://www.wsoft.dev.br/sistema-para-contas-a-receber',
            'description' => 'Plano mensal com todas as funcionalidades'
        ],
        'aggregateRating' => [
            '@type' => 'AggregateRating',
            'ratingValue' => '4.8',
            'ratingCount' => '112'
        ]
    ],
    [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => [
            [
                '@type' => 'Question',
                'name' => 'Como controlar o que tenho a receber?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'O WSoft centraliza todas as suas vendas a prazo, boletos e cartões. Você sabe exatamente quanto e quando vai receber.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'O sistema ajuda a cobrar clientes?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Sim! Você identifica facilmente quem está em atraso e pode enviar lembretes de cobrança via WhatsApp ou E-mail.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'Posso ver recebimentos futuros?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Sim! O fluxo de caixa projetado mostra seus recebimentos futuros, permitindo planejar investimentos e pagamentos.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'Funciona para vendas no cartão?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Sim! Você pode lançar as vendas no cartão e controlar as datas de repasse das operadoras.'
                ]
            ]
        ]
    ],
    [
        '@context' => 'https://schema.org',
        '@type' => 'HowTo',
        'name' => 'Como controlar Contas a Receber com WSoft',
        'description' => 'Guia rápido para registrar vendas, monitorar recebimentos e reduzir inadimplência com o sistema WSoft.',
        'step' => [
            [
                '@type' => 'HowToStep',
                'name' => 'Registre a Venda',
                'text' => 'Ao fazer uma venda, o sistema já lança o contas a receber automaticamente, seja boleto, cartão ou crediário.',
                'position' => 1
            ],
            [
                '@type' => 'HowToStep',
                'name' => 'Monitore Recebimentos',
                'text' => 'Acompanhe dia a dia o que deve entrar no caixa. Identifique atrasos rapidamente e tome providências.',
                'position' => 2
            ],
            [
                '@type' => 'HowToStep',
                'name' => 'Baixa e Conciliação',
                'text' => 'Confirme o recebimento com um clique. O valor entra no saldo do caixa ou banco e o cliente fica em dia.',
                'position' => 3
            ]
        ]
    ]
];
@endphp

<x-site-layout
    :title="'Sistema de Contas a Receber | Controle Financeiro | WSoft'"
    :description="'Controle seus recebimentos e reduza a inadimplência. Sistema de contas a receber simples e eficiente para pequenas empresas. Teste grátis!'"
    :keywords="'contas a receber, controle de recebimentos, gestão financeira, software financeiro, fluxo de caixa, controle de inadimplência, cobrança de clientes'"
    :canonical="'https://www.wsoft.dev.br/sistema-para-contas-a-receber'"
    :ogTitle="'Sistema de Contas a Receber e Cobrança | WSoft'"
    :ogDescription="'Receba em dia e organize seu financeiro. Controle total de contas a receber, boletos e cartões com o WSoft.'"
    :structuredData="$structuredData"
>

<x-site.hero
    badge="Controle de Contas a Receber"
    highlight="Receba em Dia"
    title="e Cresça"
    description="Controle todos os seus recebimentos em um só lugar. Automatize cobranças, reduza a inadimplência e tenha previsibilidade de caixa. <span class='text-emerald-400 font-bold block mt-2'>Apenas R$ 29,90/mês.</span>"
    primaryButtonText="Teste grátis por 7 dias"
    primaryButtonUrl="/app/register"
>
    <div class="relative">
        <div class="absolute -inset-4 bg-gradient-to-r from-emerald-500 to-cyan-500 rounded-full blur-3xl opacity-20 animate-pulse"></div>
        <div class="bg-white/10 border border-white/20 rounded-3xl p-8 backdrop-blur-md shadow-2xl relative">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <p class="text-sm uppercase text-emerald-200 font-semibold tracking-wider">A Receber Hoje</p>
                    <h3 class="text-3xl font-bold mt-1">R$ 3.450,00</h3>
                    <div class="flex items-center gap-2 mt-2">
                        <span class="text-xs font-bold text-green-400 bg-green-400/10 px-2 py-0.5 rounded">5 clientes</span>
                    </div>
                </div>
                <div class="h-12 w-12 rounded-full bg-emerald-500/20 flex items-center justify-center border border-emerald-400/30">
                    <i class="fa-solid fa-hand-holding-dollar text-emerald-300 text-xl"></i>
                </div>
            </div>
            <div class="space-y-4">
                <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                    <div class="flex items-center justify-between mb-2">
                        <p class="text-xs text-emerald-200">Total a Receber (Mês)</p>
                        <span class="text-sm font-bold text-emerald-300">R$ 28.900,00</span>
                    </div>
                    <div class="h-2 bg-emerald-950/50 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-emerald-400 to-cyan-400 w-[80%] rounded-full"></div>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                        <p class="text-xs text-emerald-200">Inadimplência</p>
                        <p class="text-2xl font-bold mt-1 text-red-400">R$ 450</p>
                    </div>
                    <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                        <p class="text-xs text-emerald-200">Recebido</p>
                        <p class="text-2xl font-bold mt-1 text-green-400">R$ 15k</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-site.hero>

<!-- Pain vs Gain -->
<x-site.comparison
    title="Você sabe quem te deve?"
    subtitle="O problema da inadimplência"
    description="Vender e não receber é o pior pesadelo do empresário. Veja a diferença:"
    painTitle="Cobrança Falha"
    :painItems="[
        'Esquece de cobrar clientes devedores',
        'Perde o controle de vendas no \'fiado\'',
        'Não sabe quanto vai entrar no caixa',
        'Prejuízo com calotes não identificados'
    ]"
    gainTitle="Recebimento Garantido"
    :gainItems="[
        'Controle total de quem deve e quanto deve',
        'Lembretes de cobrança automáticos',
        'Previsão exata de entradas futuras',
        'Redução drástica da inadimplência'
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
            <h2 class="mt-4 text-3xl md:text-4xl font-bold text-slate-900">Como funciona o Contas a Receber</h2>
            <p class="mt-4 text-lg text-slate-600">Gestão de recebimentos simples e eficaz.</p>
        </div>

        <div class="space-y-24">
            <!-- Step 1 -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 group">
                        <div class="absolute inset-0 bg-emerald-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="/images/crm/registration.png" alt="Venda e Lançamento" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-emerald-100 text-emerald-700 font-bold text-xl">1</span>
                        <h3 class="text-2xl font-bold text-slate-900">Registre a Venda</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Ao fazer uma venda, o sistema já lança o contas a receber automaticamente, seja boleto, cartão ou crediário.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Integração automática com vendas</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Parcelamento flexível</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-1">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-emerald-100 text-emerald-700 font-bold text-xl">2</span>
                        <h3 class="text-2xl font-bold text-slate-900">Monitore Recebimentos</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Acompanhe dia a dia o que deve entrar no caixa. Identifique atrasos rapidamente e tome providências.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Painel de recebimentos intuitivo</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Status de pagamento claro</span>
                        </li>
                    </ul>
                </div>
                <div class="order-2">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 group">
                        <div class="absolute inset-0 bg-emerald-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="/images/crm/history.png" alt="Monitoramento de Recebimentos" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 group">
                        <div class="absolute inset-0 bg-emerald-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="/images/crm/reports.png" alt="Relatórios de Recebimento" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-emerald-100 text-emerald-700 font-bold text-xl">3</span>
                        <h3 class="text-2xl font-bold text-slate-900">Baixa e Conciliação</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Confirme o recebimento com um clique. O valor entra no saldo do caixa ou banco e o cliente fica em dia.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Baixa simples e rápida</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Histórico financeiro do cliente</span>
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
            <h2 class="mt-4 text-3xl md:text-4xl font-bold">Por que controlar o contas a receber?</h2>
            <p class="mt-4 text-lg text-slate-600">Saúde financeira para sua empresa</p>
        </div>
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-money-bill-trend-up text-emerald-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Fluxo de Caixa</h3>
                    <p class="mt-3 text-slate-600">Tenha previsibilidade de quanto dinheiro vai entrar e planeje seus pagamentos.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-user-check text-blue-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Menos Inadimplência</h3>
                    <p class="mt-3 text-slate-600">Cobre quem deve na hora certa e recupere valores que seriam perdidos.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-file-contract text-purple-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Organização</h3>
                    <p class="mt-3 text-slate-600">Fim das anotações em caderno. Tudo digital, seguro e fácil de consultar.</p>
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

        <div class="mt-16 text-center">
            <x-site.cta-inline
                title="Abandone Planilhas de Controle de Recebimentos"
                description="Pare de perder tempo com planilhas manuais. Com o WSoft, você automatiza o controle de recebimentos, reduz inadimplência e tem previsão exata do que vai entrar no caixa."
                buttonText="Falar no WhatsApp"
                buttonUrl="https://wa.me/5551999350578"
                gradient="from-blue-900 to-blue-700"
                icon="fa-solid fa-file-excel"
            />
        </div>

        <div class="mt-8 text-center">
            <a href="/app/register" class="inline-flex items-center gap-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-8 py-4 rounded-xl shadow-lg shadow-emerald-500/20 hover:shadow-emerald-500/40 transform hover:-translate-y-0.5 transition-all duration-300">
                <span>Testar Gratuitamente</span>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<x-site.cta-final
    :title="'Escolha um sistema completo para gestão de contas a receber'"
    :description="'Comece agora com 7 dias de teste grátis. Use o melhor <strong>sistema para controle de recebimentos</strong> por apenas <span class=\'text-yellow-300 font-bold\'>R$ 29,90/mês</span>.'"
    :footer="'Junte-se a centenas de empresas que usam WSoft'"
    :gradient="'bg-gradient-to-br from-blue-950 to-blue-700'"
    :textColor="'text-blue-50'"
    :highlightColor="'text-yellow-300'"
/>

@livewire('landing-registration-form', [
    'source' => 'site_contas_receber',
    'title' => 'Comece agora gratuitamente',
    'subtitle' => 'Junte-se a centenas de empresas que reduziram inadimplência e aumentaram o fluxo de caixa com o WSoft.',
    'gradient' => 'from-blue-900 to-blue-700',
    'buttonText' => 'Testar por 7 Dias Grátis',
    'buttonColor' => 'blue',
    'focusColor' => 'blue'
])


<x-site.faq
    title="Perguntas Frequentes sobre Sistema de Contas a Receber"
    subtitle="FAQ"
    subtitleColor="text-blue-600"
    :questions="[
        [
            'question' => 'Como funciona o controle de contas a receber no WSoft?',
            'answer' => 'O <strong>sistema de contas a receber</strong> do WSoft permite cadastrar todas as suas vendas a prazo, boletos e cartões. Você acompanha em tempo real quanto vai receber, quando e de quem, com <strong>alertas automáticos de vencimento</strong> e recursos de cobrança integrados.'
        ],
        [
            'question' => 'O sistema ajuda a reduzir a inadimplência?',
            'answer' => 'Sim! Com o <strong>controle de recebimentos</strong> você identifica rapidamente clientes em atraso, envia lembretes de cobrança automatizados por WhatsApp ou e-mail, e mantém histórico completo de pagamentos. Isso reduz drasticamente a <strong>inadimplência</strong> e melhora seu fluxo de caixa.'
        ],
        [
            'question' => 'Posso controlar vendas no cartão de crédito e débito?',
            'answer' => 'Sim! O <strong>sistema de gestão de recebimentos</strong> permite lançar vendas em cartão, controlando as taxas das operadoras, datas de repasse e conciliando automaticamente com seu extrato bancário. Ideal para lojistas que precisam de <strong>controle financeiro completo</strong>.'
        ],
        [
            'question' => 'O sistema emite boletos bancários?',
            'answer' => 'Sim! Você pode gerar <strong>boletos bancários</strong> diretamente pelo WSoft e enviar para seus clientes. O sistema registra automaticamente quando o boleto é pago e atualiza o saldo do seu caixa. Consulte as condições de integração bancária disponíveis.'
        ],
        [
            'question' => 'Como visualizar recebimentos futuros e fazer projeções?',
            'answer' => 'O <strong>módulo de fluxo de caixa projetado</strong> mostra todos os seus recebimentos futuros organizados por data. Você tem <strong>previsibilidade financeira</strong> para planejar investimentos, pagamentos de fornecedores e tomar decisões estratégicas com segurança.'
        ],
        [
            'question' => 'Posso parcelar vendas e controlar cada parcela?',
            'answer' => 'Sim! Ao lançar uma <strong>venda parcelada</strong>, o sistema gera automaticamente todas as parcelas com datas de vencimento corretas. Você acompanha cada parcela individualmente, sabe quais foram pagas e quais estão pendentes, facilitando a <strong>gestão de crediário</strong>.'
        ],
        [
            'question' => 'Quanto custa um sistema de contas a receber?',
            'answer' => 'O WSoft oferece um plano completo de <strong>gestão de contas a receber</strong> a partir de <strong>R$ 29,90/mês</strong>, com <strong>7 dias de teste grátis</strong> e sem necessidade de cartão de crédito. Inclui controle de recebimentos, cobrança automática, fluxo de caixa, relatórios gerenciais e suporte técnico.'
        ]
    ]"
/>

</x-site-layout>
