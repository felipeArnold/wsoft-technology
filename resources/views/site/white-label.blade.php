@php
$structuredData = [
    [
        '@context' => 'https://schema.org',
        '@type' => 'SoftwareApplication',
        'name' => 'WSoft - Sistema White Label para Revenda',
        'url' => 'https://www.wsoft.dev.br/sistema-white-label-para-revenda',
        'description' => 'Plataforma white label completa para revenda de software de gestão. Revenda com sua marca, ganhe comissões recorrentes e cresça seu negócio.',
        'operatingSystem' => 'Web',
        'applicationCategory' => 'BusinessApplication',
        'offers' => [
            '@type' => 'Offer',
            'price' => '0',
            'priceCurrency' => 'BRL',
            'url' => 'https://www.wsoft.dev.br/sistema-white-label-para-revenda',
            'description' => 'Programa de parceria white label sem custo inicial'
        ],
        'aggregateRating' => [
            '@type' => 'AggregateRating',
            'ratingValue' => '4.9',
            'ratingCount' => '42'
        ]
    ],
    [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => [
            [
                '@type' => 'Question',
                'name' => 'O que é um sistema white label?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'White label é uma solução que você revende com sua própria marca. O WSoft fornece toda a plataforma e você vende como se fosse seu produto.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'Preciso investir para começar a revender?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Não! O programa white label do WSoft não possui custo inicial. Você ganha comissão recorrente sobre cada cliente que trouxer.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'Quanto ganho por cliente?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Você recebe comissões recorrentes mensais sobre cada assinatura ativa. Os valores variam de acordo com o plano contratado pelo cliente.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'Posso personalizar o sistema com minha marca?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Sim! Você pode usar seu próprio domínio, logotipo, cores e identidade visual. O cliente só vê sua marca.'
                ]
            ]
        ]
    ],
    [
        '@context' => 'https://schema.org',
        '@type' => 'HowTo',
        'name' => 'Como funciona o Sistema White Label WSoft',
        'description' => 'Passo a passo para começar a revender software de gestão com sua marca.',
        'step' => [
            [
                '@type' => 'HowToStep',
                'name' => 'Torne-se Parceiro',
                'text' => 'Cadastre-se gratuitamente no programa de parceria white label. Sem custos iniciais, sem mensalidade fixa.',
                'position' => 1
            ],
            [
                '@type' => 'HowToStep',
                'name' => 'Personalize com Sua Marca',
                'text' => 'Configure seu domínio personalizado, adicione seu logo, escolha suas cores. O sistema terá 100% a cara da sua empresa.',
                'position' => 2
            ],
            [
                '@type' => 'HowToStep',
                'name' => 'Venda para Seus Clientes',
                'text' => 'Ofereça a solução completa de gestão para seus clientes. Eles usarão o sistema com sua marca, sem saber que é white label.',
                'position' => 3
            ],
            [
                '@type' => 'HowToStep',
                'name' => 'Gerencie Seus Clientes',
                'text' => 'Acesse o painel do parceiro para gerenciar todos os seus clientes, acompanhar assinaturas e controlar seu faturamento.',
                'position' => 4
            ],
            [
                '@type' => 'HowToStep',
                'name' => 'Receba Comissões Recorrentes',
                'text' => 'Receba mensalmente sua comissão sobre cada assinatura ativa. Construa uma renda recorrente e previsível.',
                'position' => 5
            ]
        ]
    ]
];
@endphp

<x-site-layout
    :title="'Sistema White Label para Revenda | Software de Gestão | WSoft'"
    :description="'Revenda software de gestão com sua marca! Plataforma white label completa, sem investimento inicial. Ganhe comissões recorrentes mensais. Teste grátis!'"
    :keywords="'sistema white label, software white label, white label para revenda, plataforma white label, revenda de software, software para revenda, sistema de revenda, white label saas, programa de parceria software, revenda white label'"
    :canonical="'https://www.wsoft.dev.br/sistema-white-label-para-revenda'"
    :ogTitle="'Sistema White Label para Revenda de Software | WSoft'"
    :ogDescription="'Monte seu negócio de software sem desenvolver nada! Revenda com sua marca, ganhe comissões recorrentes e cresça exponencialmente.'"
    :structuredData="$structuredData"
>

<x-site.hero
    badge="Programa White Label"
    highlight="Revenda Software"
    title="com Sua Marca"
    description="Monte seu negócio de software sem desenvolver nada. Revenda nosso sistema de gestão completo com sua marca e logotipo. Comissões recorrentes garantidas."
    primaryButtonText="Quero ser parceiro"
    primaryButtonUrl="https://wa.me/5551999350578"
>
    <div class="relative">
        <div class="absolute -inset-4 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full blur-3xl opacity-20 animate-pulse"></div>
        <div class="bg-white/10 border border-white/20 rounded-3xl p-8 backdrop-blur-md shadow-2xl relative">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <p class="text-sm uppercase text-purple-200 font-semibold tracking-wider">Programa de Parceria</p>
                    <h3 class="text-3xl font-bold mt-1">White Label</h3>
                    <div class="flex items-center gap-2 mt-2">
                        <span class="text-xs font-bold text-green-400 bg-green-400/10 px-2 py-0.5 rounded">Sem investimento inicial</span>
                    </div>
                </div>
                <div class="h-12 w-12 rounded-full bg-purple-500/20 flex items-center justify-center border border-purple-400/30">
                    <i class="fa-solid fa-handshake text-purple-300 text-xl"></i>
                </div>
            </div>
            <div class="space-y-4">
                <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                    <div class="flex items-center justify-between mb-2">
                        <p class="text-xs text-purple-200">Potencial de Renda</p>
                        <span class="text-sm font-bold text-purple-300">Recorrente</span>
                    </div>
                    <div class="h-2 bg-purple-950/50 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-purple-400 to-pink-400 w-[85%] rounded-full"></div>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                        <p class="text-xs text-purple-200">Custo Inicial</p>
                        <p class="text-2xl font-bold mt-1 text-green-400">R$ 0</p>
                    </div>
                    <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                        <p class="text-xs text-purple-200">Comissão</p>
                        <p class="text-2xl font-bold mt-1 text-green-400">Mensal</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-site.hero>

<!-- Pain vs Gain -->
<x-site.comparison
    title="Por que não criar seu próprio software?"
    subtitle="White Label vs Desenvolvimento Próprio"
    description="Desenvolver um sistema do zero custa caro e demora anos. Veja a diferença:"
    painTitle="Desenvolvimento Próprio"
    :painItems="[
    'Investimento inicial de R$ 100k a R$ 500k',
    'Mínimo de 12 a 24 meses para lançar',
    'Custos mensais com programadores e infraestrutura',
    'Risco alto de não validar o produto no mercado'
]"
    gainTitle="Sistema White Label"
    :gainItems="[
    'Comece hoje sem investimento inicial',
    'Sistema pronto e testado no mercado',
    'Sem custos fixos com desenvolvimento',
    'Foco 100% em vendas e crescimento'
]"
    gainCardBg="bg-purple-900"
    gainCardBorder="border-purple-800"
    gainTitleColor="text-purple-400"
    gainCheckColor="text-purple-400"
    gainBadgeBg="bg-purple-500"
    gainBadgeText="COM WSOFT"
/>

<!-- How it Works (New Section) -->
<section id="como-funciona" class="py-24 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-20">
            <p class="text-sm font-semibold text-purple-600 uppercase tracking-[0.3em]">Passo a Passo</p>
            <h2 class="mt-4 text-3xl md:text-4xl font-bold text-slate-900">Como funciona o White Label</h2>
            <p class="mt-4 text-lg text-slate-600">Monte seu negócio de software em poucos dias.</p>
        </div>

        <div class="space-y-24">
            <!-- Step 1 - Parceria -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 group">
                        <div class="absolute inset-0 bg-purple-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="/images/crm/registration.png" alt="Cadastro de Parceiro" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-purple-100 text-purple-700 font-bold text-xl">1</span>
                        <h3 class="text-2xl font-bold text-slate-900">Torne-se Parceiro</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Cadastre-se gratuitamente no programa de parceria white label. Sem custos iniciais, sem mensalidade fixa.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-purple-500"></i>
                            <span>Cadastro 100% gratuito</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-purple-500"></i>
                            <span>Sem mensalidade ou taxa fixa</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-purple-500"></i>
                            <span>Acesso imediato ao painel do parceiro</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Step 2 - Personalização -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-1">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-purple-100 text-purple-700 font-bold text-xl">2</span>
                        <h3 class="text-2xl font-bold text-slate-900">Personalize com Sua Marca</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Configure seu domínio personalizado, adicione seu logo, escolha suas cores. O sistema terá 100% a cara da sua empresa.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-purple-500"></i>
                            <span>Domínio personalizado (seusite.com.br)</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-purple-500"></i>
                            <span>Logo e identidade visual customizados</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-purple-500"></i>
                            <span>Cores personalizadas da sua marca</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-purple-500"></i>
                            <span>E-mails transacionais com sua marca</span>
                        </li>
                    </ul>
                </div>
                <div class="order-2">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 group">
                        <div class="absolute inset-0 bg-purple-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="/images/crm/dashboard-preview.png" alt="Personalização White Label" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
            </div>

            <!-- Step 3 - Vendas -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 group">
                        <div class="absolute inset-0 bg-purple-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="/images/crm/history.png" alt="Vendas e Clientes" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-purple-100 text-purple-700 font-bold text-xl">3</span>
                        <h3 class="text-2xl font-bold text-slate-900">Venda para Seus Clientes</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Ofereça a solução completa de gestão para seus clientes. Eles usarão o sistema com sua marca, sem saber que é white label.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-purple-500"></i>
                            <span>Material de vendas pronto para usar</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-purple-500"></i>
                            <span>Suporte técnico incluído</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-purple-500"></i>
                            <span>Atualizações automáticas do sistema</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-purple-500"></i>
                            <span>Preço flexível: você define sua margem</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Step 4 - Gestão -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-1">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-purple-100 text-purple-700 font-bold text-xl">4</span>
                        <h3 class="text-2xl font-bold text-slate-900">Gerencie Seus Clientes</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Acesse o painel do parceiro para gerenciar todos os seus clientes, acompanhar assinaturas e controlar seu faturamento.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-purple-500"></i>
                            <span>Dashboard completo do parceiro</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-purple-500"></i>
                            <span>Visão de todas as assinaturas ativas</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-purple-500"></i>
                            <span>Relatórios de faturamento em tempo real</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-purple-500"></i>
                            <span>Controle de cancelamentos e renovações</span>
                        </li>
                    </ul>
                </div>
                <div class="order-2">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 group">
                        <div class="absolute inset-0 bg-purple-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="/images/crm/dashboard-preview.png" alt="Painel do Parceiro" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
            </div>

            <!-- Step 5 - Comissões -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 group">
                        <div class="absolute inset-0 bg-purple-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="/images/crm/reports.png" alt="Comissões Recorrentes" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-purple-100 text-purple-700 font-bold text-xl">5</span>
                        <h3 class="text-2xl font-bold text-slate-900">Receba Comissões Recorrentes</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Receba mensalmente sua comissão sobre cada assinatura ativa. Construa uma renda recorrente e previsível.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-purple-500"></i>
                            <span>Comissões mensais recorrentes</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-purple-500"></i>
                            <span>Pagamentos automáticos todo mês</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-purple-500"></i>
                            <span>Escale sua renda sem limite</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-purple-500"></i>
                            <span>Transparência total de ganhos</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="mt-16 text-center">
            <a href="https://wa.me/5551999350578" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-3 bg-purple-600 hover:bg-purple-700 text-white font-bold px-8 py-4 rounded-xl shadow-lg shadow-purple-500/20 hover:shadow-purple-500/40 transform hover:-translate-y-0.5 transition-all duration-300">
                <i class="fa-brands fa-whatsapp text-xl"></i>
                <span>Quero ser Parceiro White Label</span>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<section id="beneficios" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <p class="text-sm font-semibold text-purple-600 uppercase tracking-[0.3em]">Benefícios</p>
            <h2 class="mt-4 text-3xl md:text-4xl font-bold">Por que escolher o White Label WSoft?</h2>
            <p class="mt-4 text-lg text-slate-600">Monte seu negócio de software com todas as vantagens</p>
        </div>
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-rocket text-purple-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Comece Hoje Mesmo</h3>
                    <p class="mt-3 text-slate-600">Não espere meses ou anos. Comece a vender seu software hoje, sem desenvolvimento.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-hand-holding-dollar text-blue-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Sem Investimento Inicial</h3>
                    <p class="mt-3 text-slate-600">Zero investimento para começar. Sem custos de desenvolvimento, hospedagem ou manutenção.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-chart-line text-green-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Renda Recorrente</h3>
                    <p class="mt-3 text-slate-600">Construa uma base sólida de renda mensal recorrente. Quanto mais clientes, maior seu faturamento.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-paintbrush text-orange-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">100% Sua Marca</h3>
                    <p class="mt-3 text-slate-600">Logo, cores, domínio - tudo personalizado. O cliente só vê sua marca, nunca o white label.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-headset text-red-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Suporte Técnico Incluso</h3>
                    <p class="mt-3 text-slate-600">Nossa equipe cuida de toda infraestrutura e suporte técnico. Você foca só nas vendas.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-teal-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-arrows-rotate text-teal-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Sempre Atualizado</h3>
                    <p class="mt-3 text-slate-600">Novas funcionalidades e melhorias lançadas automaticamente. Seus clientes sempre têm o melhor.</p>
                </div>
            </article>
        </div>

        <div class="mt-16 flex flex-col md:flex-row justify-center items-center gap-4">
            <a
                href="https://wa.me/5551999350578"
                target="_blank"
                rel="noopener noreferrer"
                class="inline-flex items-center gap-3 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-500 hover:to-pink-500 text-white font-bold px-8 py-4 rounded-xl shadow-lg shadow-purple-500/20 hover:shadow-purple-500/40 transform hover:-translate-y-0.5 transition-all duration-300"
            >
                <i class="fa-brands fa-whatsapp text-xl"></i>
                <span>Quero Ser Parceiro</span>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- Para quem é indicado -->
<section class="py-24 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <p class="text-sm font-semibold text-purple-600 uppercase tracking-[0.3em]">Ideal Para</p>
            <h2 class="mt-4 text-3xl md:text-4xl font-bold text-slate-900">Para quem é o Sistema White Label?</h2>
            <p class="mt-4 text-lg text-slate-600">Veja se o programa de parceria é para você</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="bg-white rounded-2xl p-8 shadow-lg border border-slate-200 hover:shadow-xl transition-shadow">
                <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fa-solid fa-user-tie text-purple-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">Consultorias e Contabilidades</h3>
                <p class="text-slate-600">Agregue valor aos seus clientes oferecendo um sistema completo de gestão.</p>
            </div>

            <div class="bg-white rounded-2xl p-8 shadow-lg border border-slate-200 hover:shadow-xl transition-shadow">
                <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fa-solid fa-laptop-code text-blue-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">Agências e Desenvolvedores</h3>
                <p class="text-slate-600">Ofereça soluções completas aos seus clientes sem precisar desenvolver do zero.</p>
            </div>

            <div class="bg-white rounded-2xl p-8 shadow-lg border border-slate-200 hover:shadow-xl transition-shadow">
                <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fa-solid fa-handshake text-green-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">Vendedores e Representantes</h3>
                <p class="text-slate-600">Crie uma nova fonte de renda recorrente vendendo software com sua marca.</p>
            </div>

            <div class="bg-white rounded-2xl p-8 shadow-lg border border-slate-200 hover:shadow-xl transition-shadow">
                <div class="w-16 h-16 bg-orange-100 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fa-solid fa-building text-orange-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">Empresas de TI</h3>
                <p class="text-slate-600">Expanda seu portfólio com um sistema de gestão completo e testado.</p>
            </div>

            <div class="bg-white rounded-2xl p-8 shadow-lg border border-slate-200 hover:shadow-xl transition-shadow">
                <div class="w-16 h-16 bg-red-100 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fa-solid fa-lightbulb text-red-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">Empreendedores Digitais</h3>
                <p class="text-slate-600">Monte seu negócio de SaaS sem investir em desenvolvimento e infraestrutura.</p>
            </div>

            <div class="bg-white rounded-2xl p-8 shadow-lg border border-slate-200 hover:shadow-xl transition-shadow">
                <div class="w-16 h-16 bg-teal-100 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fa-solid fa-store text-teal-600 text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">Revendedores de Software</h3>
                <p class="text-slate-600">Adicione mais produtos ao seu catálogo com comissões recorrentes garantidas.</p>
            </div>
        </div>

        <div class="mt-16 text-center">
            <a href="https://wa.me/5551999350578" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-3 bg-purple-600 hover:bg-purple-700 text-white font-bold px-8 py-4 rounded-xl shadow-lg shadow-purple-500/20 hover:shadow-purple-500/40 transform hover:-translate-y-0.5 transition-all duration-300">
                <i class="fa-brands fa-whatsapp text-xl"></i>
                <span>Falar com Especialista</span>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- O que está incluído -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div>
                <span class="text-purple-600 font-bold tracking-wider uppercase text-sm">Plataforma Completa</span>
                <h2 class="mt-2 text-3xl md:text-4xl font-extrabold text-slate-900">Sistema de Gestão Completo para Seus Clientes</h2>
                <p class="mt-6 text-lg text-slate-600">
                    Não é só um software, é uma <strong>plataforma white label completa</strong> com todos os módulos que pequenas e médias empresas precisam.
                </p>
                
                <div class="mt-8 space-y-6">
                    <div class="flex gap-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                            <i class="fa-solid fa-file-invoice-dollar text-purple-600 text-xl"></i>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-slate-900">Financeiro Completo</h4>
                            <p class="text-slate-600">Contas a pagar, receber, fluxo de caixa, DRE e relatórios gerenciais.</p>
                        </div>
                    </div>
                    
                    <div class="flex gap-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                            <i class="fa-solid fa-users text-blue-600 text-xl"></i>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-slate-900">CRM e Gestão de Clientes</h4>
                            <p class="text-slate-600">Controle completo de clientes, histórico de compras e relacionamento.</p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                            <i class="fa-solid fa-box text-green-600 text-xl"></i>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-slate-900">Controle de Estoque</h4>
                            <p class="text-slate-600">Gestão de produtos, entrada e saída, relatórios de inventário.</p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                            <i class="fa-solid fa-file-invoice text-orange-600 text-xl"></i>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-slate-900">Emissão de Notas e Boletos</h4>
                            <p class="text-slate-600">Integração para emissão de notas fiscais e boletos bancários.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="relative">
                <div class="absolute -inset-4 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full blur-3xl opacity-20"></div>
                <img src="/images/crm/dashboard-preview.png" alt="Plataforma White Label Completa" class="relative rounded-2xl shadow-2xl border border-slate-200" loading="lazy" decoding="async">
            </div>
        </div>

        <div class="mt-12 text-center">
            <a href="https://wa.me/5551999350578" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-3 bg-purple-600 hover:bg-purple-700 text-white font-bold px-8 py-4 rounded-xl shadow-lg shadow-purple-500/20 hover:shadow-purple-500/40 transform hover:-translate-y-0.5 transition-all duration-300">
                <i class="fa-brands fa-whatsapp text-xl"></i>
                <span>Quero Conhecer o Sistema</span>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- CTA Section -->
<x-site.cta-final
    :title="'Comece a Revender Software com Sua Marca Hoje'"
    :description="'Sem investimento inicial, sem mensalidade fixa. Monte seu negócio de software e comece a gerar <span class=\'text-yellow-300 font-bold\'>renda recorrente mensal</span>.'"
    :footer="'Junte-se aos parceiros que já faturam com o WSoft White Label'"
    :gradient="'bg-gradient-to-br from-purple-950 to-pink-700'"
    :textColor="'text-purple-50'"
    :highlightColor="'text-yellow-300'"
/>

<x-site.cta-whatsapp
    title="Dúvidas sobre o Programa White Label?"
    subtitle="Fale agora com nosso time e descubra como começar a revender software com sua marca."
    buttonText="Falar no WhatsApp"
/>

<x-site.faq
    title="Perguntas Frequentes sobre White Label"
    subtitle="FAQ"
    subtitleColor="text-purple-600"
    :questions="[
        [
            'question' => 'O que é exatamente um sistema white label?',
            'answer' => '<strong>White label</strong> é quando você revende um produto ou serviço com sua própria marca. No caso do <strong>software white label WSoft</strong>, você oferece nosso sistema completo de gestão aos seus clientes, mas eles veem apenas sua marca, logo, cores e domínio. É como se você tivesse desenvolvido o software, mas sem os custos e tempo de desenvolvimento.'
        ],
        [
            'question' => 'Preciso investir algum valor para começar a revender?',
            'answer' => 'Não! O <strong>programa de parceria white label</strong> do WSoft não possui custo inicial. Você não paga mensalidade fixa, não paga setup, não paga nada para começar. Você só ganha comissões recorrentes sobre cada cliente que trouxer. É um modelo de <strong>revenda de software</strong> sem risco financeiro.'
        ],
        [
            'question' => 'Como funcionam as comissões e quanto posso ganhar?',
            'answer' => 'Você recebe <strong>comissões recorrentes mensais</strong> sobre cada assinatura ativa dos seus clientes. Os valores variam de acordo com o plano contratado. Quanto mais clientes você trouxer, maior será sua renda recorrente. Não há limite de ganhos - você pode escalar quanto quiser.'
        ],
        [
            'question' => 'Posso realmente personalizar tudo com minha marca?',
            'answer' => 'Sim! Com a <strong>plataforma white label</strong> do WSoft você pode personalizar: domínio personalizado (seusite.com.br), logotipo da sua empresa, cores da sua identidade visual, e-mails transacionais com sua marca, e muito mais. Seus clientes nunca saberão que é um white label.'
        ],
        [
            'question' => 'Quem cuida do suporte técnico dos meus clientes?',
            'answer' => 'Nossa equipe WSoft cuida de toda a infraestrutura técnica: hospedagem, segurança, backups, atualizações e suporte técnico de segundo nível. Você foca apenas em vendas e relacionamento com cliente. É possível também personalizar o atendimento para que seus clientes entrem em contato diretamente com você.'
        ],
        [
            'question' => 'O sistema recebe atualizações e melhorias?',
            'answer' => 'Sim! O <strong>sistema white label para revenda</strong> está em constante evolução. Lançamos novas funcionalidades e melhorias regularmente, e tudo é aplicado automaticamente para todos os clientes. Seus clientes sempre terão acesso às últimas inovações sem custo adicional.'
        ],
        [
            'question' => 'Quanto tempo leva para começar a revender?',
            'answer' => 'Você pode começar em poucos dias! Após o cadastro como parceiro, fazemos a configuração da sua marca (logo, cores, domínio) e você já pode começar a oferecer o <strong>software white label</strong> aos seus clientes. Não há tempo de desenvolvimento - o sistema está pronto.'
        ],
        [
            'question' => 'Posso definir meu próprio preço de venda?',
            'answer' => 'Sim! Você tem total liberdade para definir sua margem de lucro e o preço que vai cobrar dos seus clientes. O <strong>programa white label</strong> é flexível para você montar sua estratégia comercial da forma que preferir.'
        ]
    ]"
/>

</x-site-layout>
