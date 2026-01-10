@php
$structuredData = [
    [
        '@context' => 'https://schema.org',
        '@type' => 'SoftwareApplication',
        'name' => 'WSoft - Sistema para Salão de Beleza',
        'url' => 'https://www.wsoft.dev.br/sistema-para-salao-de-beleza',
        'description' => 'Sistema completo para gestão de salão de beleza. Agenda, comissões, financeiro e controle total do seu negócio.',
        'operatingSystem' => 'Web',
        'applicationCategory' => 'BusinessApplication',
        'offers' => [
            '@type' => 'Offer',
            'price' => '79.90',
            'priceCurrency' => 'BRL',
            'url' => 'https://www.wsoft.dev.br/app/register',
            'description' => 'Plano mensal com todas as funcionalidades'
        ],
        'aggregateRating' => [
            '@type' => 'AggregateRating',
            'ratingValue' => '4.9',
            'ratingCount' => '120'
        ]
    ],
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
                'name' => 'Salão de Beleza',
                'item' => 'https://www.wsoft.dev.br/sistema-para-salao-de-beleza'
            ]
        ]
    ],
    [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => [
            [
                '@type' => 'Question',
                'name' => 'O sistema calcula comissão dos cabeleireiros e manicures?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Sim! O WSoft calcula automaticamente as comissões, permitindo configurar porcentagens diferentes por profissional ou serviço.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'Posso agendar horários online?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Sim! O sistema organiza a agenda de todos os profissionais e permite fácil visualização para evitar conflitos de horário.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'Funciona para esmalteria e spa?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Perfeitamente. O sistema é flexível e atende salões de beleza, esmalterias, spas e clínicas de estética.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'Consigo controlar pacotes de serviços?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Sim, você pode gerenciar pacotes, histórico de atendimentos e fidelização de clientes.'
                ]
            ]
        ]
    ],
    [
        '@context' => 'https://schema.org',
        '@type' => 'HowTo',
        'name' => 'Como organizar seu Salão de Beleza com WSoft',
        'description' => 'Guia prático para organizar agenda, comissões e financeiro do seu salão de beleza usando o sistema WSoft.',
        'step' => [
            [
                '@type' => 'HowToStep',
                'name' => 'Organize a Agenda',
                'text' => 'Centralize todos os agendamentos. Evite choques de horário e organize a fila de espera.',
                'position' => 1
            ],
            [
                '@type' => 'HowToStep',
                'name' => 'Controle Comissões',
                'text' => 'Automatize o cálculo de comissões por procedimento. Saiba exatamente quanto pagar a cada profissional.',
                'position' => 2
            ],
            [
                '@type' => 'HowToStep',
                'name' => 'Gestão Financeira',
                'text' => 'Controle o fluxo de caixa, despesas e receitas do salão. Tenha visão clara do lucro.',
                'position' => 3
            ]
        ]
    ]
];
@endphp

<x-site-layout
    :title="'Sistema para Salão de Beleza | Agenda e Gestão | WSoft'"
    :description="'Sistema completo para gestão de salão de beleza. Agenda, comissões, financeiro e estoque. Teste grátis por 7 dias!'"
    :keywords="'sistema para salão de beleza, software para salão de beleza, agenda salão de beleza, gestão de salão, programa para cabeleireiro, sistema para manicures, controle de comissão salão, sistema para esmalteria, software de estética'"
    :canonical="'https://www.wsoft.dev.br/sistema-para-salao-de-beleza'"
    :ogTitle="'Sistema para Salão de Beleza | WSoft'"
    :ogDescription="'Organize sua agenda, controle comissões e fidelize clientes com o melhor sistema para salão de beleza.'"
    :structuredData="$structuredData"
>

<!-- Hero -->
<section id="hero" class="pt-32 pb-24 bg-gradient-to-b from-rose-950 via-rose-900 to-slate-900 text-white overflow-hidden relative">
    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 30px 30px;"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-16 items-center relative z-10">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-rose-800/50 border border-rose-700 text-rose-100 text-xs font-semibold uppercase tracking-wider mb-6">
                <span class="w-2 h-2 rounded-full bg-rose-400 animate-pulse"></span>
                Sistema para Salão de Beleza
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold leading-tight tracking-tight">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-rose-400 to-pink-300">Sistema de Gestão</span> para Salão de Beleza
            </h1>
            <p class="mt-6 text-lg md:text-xl text-rose-100/80 leading-relaxed max-w-lg">
                Agenda organizada, comissões automáticas, confirmação via WhatsApp e financeiro em dia. O sistema ideal para <strong>salões de beleza e esmalterias</strong>. <span class="text-rose-400 font-bold block mt-2">Apenas R$ 79,90/mês.</span>
            </p>
            <div class="mt-10 flex flex-col sm:flex-row gap-4">
                <a href="/app/register" class="inline-flex justify-center items-center rounded-xl bg-rose-600 text-white font-bold px-8 py-4 shadow-lg shadow-rose-600/30 hover:bg-rose-700 hover:-translate-y-1 transition transform duration-200">
                    Teste grátis por 7 dias
                    <i class="fa-solid fa-arrow-right ml-2"></i>
                </a>
                <a href="#como-funciona" class="inline-flex justify-center items-center rounded-xl border border-white/30 text-white font-semibold px-8 py-4 hover:bg-white/10 transition backdrop-blur-sm">
                    <i class="fa-solid fa-play mr-2"></i>
                    Como Funciona
                </a>
            </div>
            <div class="mt-10 pt-8 border-t border-rose-800/30">
                <p class="text-sm text-rose-200/60 mb-4">Ideal para:</p>
                <div class="flex flex-wrap gap-3 text-sm font-medium text-white">
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Salões de Beleza</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Esmalterias</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Spas</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Clínicas de Estética</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Design de Sobrancelhas</span>
                </div>
            </div>
        </div>
        <div class="relative">
            <div class="absolute -inset-4 bg-gradient-to-r from-rose-500 to-pink-500 rounded-full blur-3xl opacity-20 animate-pulse"></div>
            <div class="bg-rose-900/40 border border-rose-700/50 rounded-3xl p-8 backdrop-blur-md shadow-2xl relative">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <p class="text-sm uppercase text-rose-200/70 font-semibold tracking-wider">Faturamento Hoje</p>
                        <p class="text-3xl font-bold mt-1 text-white">R$ 2.450,00</p>
                        <div class="flex items-center gap-2 mt-2">
                            <span class="text-xs font-bold text-green-400 bg-green-400/10 px-2 py-0.5 rounded">+18% vs ontem</span>
                        </div>
                    </div>
                    <div class="h-12 w-12 rounded-full bg-rose-500/20 flex items-center justify-center border border-rose-400/30">
                        <i class="fa-solid fa-spa text-rose-300 text-xl"></i>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="bg-rose-800/40 rounded-xl p-4 border border-rose-700/50">
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-xs text-rose-200">Agenda do Dia</p>
                            <span class="text-sm font-bold text-rose-300">92% Ocupada</span>
                        </div>
                        <div class="h-2 bg-rose-950 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-rose-400 to-pink-400 w-[92%] rounded-full"></div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-rose-800/40 rounded-xl p-4 border border-rose-700/50">
                            <p class="text-xs text-rose-200">Clientes</p>
                            <p class="text-2xl font-bold mt-1 text-white">42</p>
                        </div>
                        <div class="bg-rose-800/40 rounded-xl p-4 border border-rose-700/50">
                            <p class="text-xs text-rose-200">Ticket Médio</p>
                            <p class="text-2xl font-bold mt-1 text-white">R$ 120</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pain vs Gain -->
<x-site.comparison
    :subtitle="'Chega de confusão na agenda'"
    :title="'Seu salão precisa de mais organização?'"
    :description="'Não deixe a desorganização atrapalhar o crescimento do seu negócio.'"
    :painTitle="'Gestão Manual'"
    :painItems="[
        'Agenda dupla e clientes insatisfeitos',
        'Erros no pagamento de comissões',
        'Não sabe qual o serviço mais lucrativo',
        'Falta de controle de estoque de produtos'
    ]"
    :gainTitle="'Salão Profissional'"
    :gainItems="[
        'Agenda organizada e sem conflitos',
        'Comissões calculadas automaticamente',
        'Relatórios financeiros detalhados',
        'Controle de estoque inteligente'
    ]"
    :gainCardBg="'bg-rose-900'"
    :gainCardBorder="'border-rose-800'"
    :gainTitleColor="'text-rose-300'"
    :gainCheckColor="'text-rose-400'"
    :gainBadgeBg="'bg-rose-600'"
/>

<!-- How it Works -->
<section id="como-funciona" class="py-24 bg-rose-50/30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-20">
            <p class="text-sm font-semibold text-rose-600 uppercase tracking-[0.3em]">Passo a Passo</p>
            <h2 class="mt-4 text-3xl md:text-4xl font-bold text-slate-900">Como o WSoft transforma seu Salão</h2>
            <p class="mt-4 text-lg text-slate-600">Simples, prático e feito para profissionais de beleza.</p>
        </div>

        <div class="space-y-24">
            <!-- Step 1 -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-rose-200 group">
                        <div class="absolute inset-0 bg-rose-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="{{ asset('images/sistema/clientes/cadastro.png') }}" alt="Agenda Salão" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-rose-100 text-rose-700 font-bold text-xl">1</span>
                        <h3 class="text-2xl font-bold text-slate-900">Agenda Simplificada</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                         Centralize todos os agendamentos. Evite choques de horário, organize a fila de espera e envie lembretes para seus clientes.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-rose-500"></i>
                            <span>Visualização diária, semanal e mensal</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-rose-500"></i>
                            <span>Agendamento por profissional</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-rose-500"></i>
                            <span>Histórico de atendimentos do cliente</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-1">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-rose-100 text-rose-700 font-bold text-xl">2</span>
                        <h3 class="text-2xl font-bold text-slate-900">Controle Financeiro e Comissões</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Automatize o cálculo de comissões. Saiba exatamente quanto pagar a cada profissional e acompanhe o lucro real do salão.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-rose-500"></i>
                            <span>Comissões configuráveis por serviço</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-rose-500"></i>
                            <span>Caixa diário e fechamento simples</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-rose-500"></i>
                            <span>Contas a pagar e receber</span>
                        </li>
                    </ul>
                </div>
                <div class="order-2">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-rose-200 group">
                        <div class="absolute inset-0 bg-rose-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="/images/crm/history.png" alt="Financeiro Salão" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-16 text-center">
            <a href="/app/register" class="inline-flex items-center gap-3 bg-rose-600 hover:bg-rose-700 text-white font-bold px-8 py-4 rounded-xl shadow-lg shadow-rose-500/20 hover:shadow-rose-500/40 transform hover:-translate-y-0.5 transition-all duration-300">
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
            <p class="text-sm font-semibold text-rose-600 uppercase tracking-[0.3em]">Vantagens</p>
            <h2 class="mt-4 text-3xl md:text-4xl font-bold">Tudo em um só lugar</h2>
        </div>
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            <article class="group rounded-2xl border border-slate-100 bg-rose-50/20 p-6 shadow-sm hover:shadow-lg hover:border-rose-200 transition-all duration-300">
                <div class="w-12 h-12 bg-rose-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-rose-600 transition-colors duration-300">
                    <i class="fa-solid fa-calendar-days text-rose-600 group-hover:text-white text-xl transition-colors duration-300"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Agenda e Lembretes</h3>
                <p class="text-sm text-slate-600 leading-relaxed">Organize horários e envie lembretes automáticos via WhatsApp para reduzir faltas.</p>
            </article>
            <article class="group rounded-2xl border border-slate-100 bg-rose-50/20 p-6 shadow-sm hover:shadow-lg hover:border-pink-200 transition-all duration-300">
                <div class="w-12 h-12 bg-pink-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-pink-600 transition-colors duration-300">
                    <i class="fa-solid fa-percentage text-pink-600 group-hover:text-white text-xl transition-colors duration-300"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Comissões</h3>
                <p class="text-sm text-slate-600 leading-relaxed">Cálculo automático de comissões para cabeleireiros, manicures e esteticistas.</p>
            </article>
            <article class="group rounded-2xl border border-slate-100 bg-rose-50/20 p-6 shadow-sm hover:shadow-lg hover:border-purple-200 transition-all duration-300">
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-purple-600 transition-colors duration-300">
                    <i class="fa-solid fa-pump-soap text-purple-600 group-hover:text-white text-xl transition-colors duration-300"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Estoque de Produtos</h3>
                <p class="text-sm text-slate-600 leading-relaxed">Controle produtos de revenda e uso interno (shampoos, tintas, cremes).</p>
            </article>
        </div>
    </div>
</section>

<!-- CTA Section -->
<x-site.cta-final
    :title="'Transforme a gestão do seu Salão de Beleza'"
    :description="'Comece agora com 7 dias de teste grátis. O melhor sistema para salões e esmalterias por apenas <span class=\'text-rose-300 font-bold\'>R$ 79,90/mês</span>.'"
    :footer="'Junte-se aos melhores salões do Brasil'"
    :gradient="'bg-gradient-to-br from-rose-950 to-rose-700'"
    :textColor="'text-rose-50'"
    :highlightColor="'text-rose-300'"
    :buttonColor="'bg-rose-500 shadow-rose-500/30 hover:bg-rose-600'"
    :priceUrl="false"
/>

<!-- FAQ -->
<section id="faq" class="py-20 bg-rose-50/20">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <p class="text-sm font-semibold text-rose-600 uppercase tracking-[0.3em]">Dúvidas</p>
            <h2 class="mt-4 text-3xl font-bold">Perguntas Frequentes</h2>
        </div>
        <div class="space-y-4">
             <details class="group rounded-2xl border border-slate-100 bg-white p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    O sistema calcula comissão dos cabeleireiros e manicures?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Sim! O WSoft calcula automaticamente as comissões, permitindo configurar porcentagens diferentes por profissional ou serviço.</p>
            </details>
             <details class="group rounded-2xl border border-slate-100 bg-white p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    Posso agendar horários online?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Sim! O sistema organiza a agenda de todos os profissionais e permite fácil visualização para evitar conflitos de horário.</p>
            </details>
            <details class="group rounded-2xl border border-slate-100 bg-white p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    Funciona para esmalteria e spa?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Perfeitamente. O sistema é flexível e atende salões de beleza, esmalterias, spas e clínicas de estética.</p>
            </details>
        </div>
    </div>
</section>

</x-site-layout>
