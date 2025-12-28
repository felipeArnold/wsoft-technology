@php
$structuredData = [
    [
        '@context' => 'https://schema.org',
        '@type' => 'SoftwareApplication',
        'name' => 'WSoft - Sistema para Clínica de Estética',
        'url' => 'https://www.wsoft.dev.br/sistema-para-clinica-estetica',
        'description' => 'Sistema completo para gestão de clínicas de estética. Agendamento, controle de sessões, anamnese e financeiro.',
        'operatingSystem' => 'Web',
        'applicationCategory' => 'MedicalApplication',
        'offers' => [
            '@type' => 'Offer',
            'price' => '29.90',
            'priceCurrency' => 'BRL',
            'url' => 'https://www.wsoft.dev.br/app/register',
            'description' => 'Plano mensal com todas as funcionalidades'
        ],
        'aggregateRating' => [
            '@type' => 'AggregateRating',
            'ratingValue' => '5.0',
            'ratingCount' => '65'
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
                'name' => 'Clínica de Estética',
                'item' => 'https://www.wsoft.dev.br/sistema-para-clinica-estetica'
            ]
        ]
    ],
    [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => [
            [
                '@type' => 'Question',
                'name' => 'O sistema controla pacotes e sessões?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Sim! Você vende o pacote e o sistema debita as sessões automaticamente a cada agendamento realizado.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'Posso anexar fotos de antes e depois?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Sim! O sistema permite anexar fotos e documentos (como ficha de anamnese) ao cadastro do cliente.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'Tem controle de comissões?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Sim, cálculo automático de comissões para esteticistas, biomédicos e outros profissionais da clínica.'
                ]
            ],
             [
                '@type' => 'Question',
                'name' => 'O sistema emite lembretes de consulta?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Sim, envie lembretes de agendamento via WhatsApp para reduzir faltas e manter a agenda organizada.'
                ]
            ]
        ]
    ],
    [
        '@context' => 'https://schema.org',
        '@type' => 'HowTo',
        'name' => 'Como gerenciar sua Clínica de Estética com WSoft',
        'description' => 'Guia prático para organizar agenda, pacientes e financeiro da sua clínica de estética.',
        'step' => [
            [
                '@type' => 'HowToStep',
                'name' => 'Cadastre os Pacientes',
                'text' => 'Tenha um prontuário digital completo com histórico de procedimentos e dados para contato.',
                'position' => 1
            ],
            [
                '@type' => 'HowToStep',
                'name' => 'Controle Sessões',
                'text' => 'Gerencie pacotes de tratamento. Saiba quantas sessões o cliente já fez e quantas restam.',
                'position' => 2
            ],
            [
                '@type' => 'HowToStep',
                'name' => 'Organize o Financeiro',
                'text' => 'Controle pagamentos, parcele tratamentos e acompanhe o fluxo de caixa da clínica.',
                'position' => 3
            ]
        ]
    ]
];
@endphp

<x-site-layout
    :title="'Sistema para Clínica de Estética | Gestão e Agenda | WSoft'"
    :description="'Software de gestão para clínicas de estética. Controle sessões, pacotes, anamnese e financeiro. Teste grátis por 7 dias!'"
    :keywords="'sistema para clínica de estética, software estética, gestão de estética, ficha de anamnese estética, controle de sessões estética, agenda estética, sistema para esteticistas, programa para clínica de estética'"
    :canonical="'https://www.wsoft.dev.br/sistema-para-clinica-estetica'"
    :ogTitle="'Sistema para Clínica de Estética | WSoft'"
    :ogDescription="'Organize sua clínica de estética. Controle pacotes, sessões e financeiro em um só lugar.'"
    :structuredData="$structuredData"
>

<!-- Hero -->
<section id="hero" class="pt-32 pb-24 bg-gradient-to-b from-teal-950 via-teal-900 to-slate-900 text-white overflow-hidden relative">
    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 30px 30px;"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-16 items-center relative z-10">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-teal-800/50 border border-teal-700 text-teal-100 text-xs font-semibold uppercase tracking-wider mb-6">
                <span class="w-2 h-2 rounded-full bg-teal-400 animate-pulse"></span>
                Sistema para Clínica de Estética
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold leading-tight tracking-tight">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-400 to-cyan-300">Sistema de Gestão</span> para Clínica de Estética
            </h1>
            <p class="mt-6 text-lg md:text-xl text-teal-100/80 leading-relaxed max-w-lg">
                Controle sessões, pacotes, anamnese digital e agenda. Organize seu negócio e proporcione a melhor experiência aos pacientes. <span class="text-teal-400 font-bold block mt-2">Apenas R$ 29,90/mês.</span>
            </p>
            <div class="mt-10 flex flex-col sm:flex-row gap-4">
                <a href="/app/register" class="inline-flex justify-center items-center rounded-xl bg-teal-600 text-white font-bold px-8 py-4 shadow-lg shadow-teal-600/30 hover:bg-teal-700 hover:-translate-y-1 transition transform duration-200">
                    Teste grátis por 7 dias
                    <i class="fa-solid fa-arrow-right ml-2"></i>
                </a>
                <a href="#como-funciona" class="inline-flex justify-center items-center rounded-xl border border-white/30 text-white font-semibold px-8 py-4 hover:bg-white/10 transition backdrop-blur-sm">
                    <i class="fa-solid fa-play mr-2"></i>
                    Como Funciona
                </a>
            </div>
            <div class="mt-10 pt-8 border-t border-teal-800/30">
                <p class="text-sm text-teal-200/60 mb-4">Ideal para:</p>
                <div class="flex flex-wrap gap-3 text-sm font-medium text-white">
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Clínicas de Estética</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Esteticistas</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Harmonização Facial</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Depilação a Laser</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Biomédicos</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Botox e Preenchimento</span>
                </div>
            </div>
        </div>
        <div class="relative">
            <div class="absolute -inset-4 bg-gradient-to-r from-teal-500 to-cyan-500 rounded-full blur-3xl opacity-20 animate-pulse"></div>
            <div class="bg-teal-900/40 border border-teal-700/50 rounded-3xl p-8 backdrop-blur-md shadow-2xl relative">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <p class="text-sm uppercase text-teal-200/70 font-semibold tracking-wider">Tratamentos Realizados</p>
                        <p class="text-3xl font-bold mt-1 text-white">142</p>
                        <div class="flex items-center gap-2 mt-2">
                            <span class="text-xs font-bold text-teal-300 bg-teal-500/20 px-2 py-0.5 rounded">Mês Atual</span>
                        </div>
                    </div>
                    <div class="h-12 w-12 rounded-full bg-teal-500/20 flex items-center justify-center border border-teal-400/30">
                        <i class="fa-solid fa-spa text-teal-300 text-xl"></i>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="bg-teal-800/40 rounded-xl p-4 border border-teal-700/50">
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-xs text-teal-200">Faturamento Previsto</p>
                            <span class="text-sm font-bold text-teal-300">R$ 18.500,00</span>
                        </div>
                         <div class="h-2 bg-teal-950 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-teal-400 to-cyan-400 w-[70%] rounded-full"></div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-teal-800/40 rounded-xl p-4 border border-teal-700/50">
                            <p class="text-xs text-teal-200">Novos Pacientes</p>
                            <p class="text-2xl font-bold mt-1 text-white">15</p>
                        </div>
                        <div class="bg-teal-800/40 rounded-xl p-4 border border-teal-700/50">
                            <p class="text-xs text-teal-200">Sessões Agendadas</p>
                            <p class="text-2xl font-bold mt-1 text-white">48</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pain vs Gain -->
<x-site.comparison
    :subtitle="'Organize seus atendimentos'"
    :title="'Dificuldade em controlar pacotes e sessões?'"
    :description="'Pare de usar fichas de papel e planilhas confusas. Profissionalize sua clínica:'"
    :painTitle="'Controle Manual'"
    :painItems="[
        'Perde a conta das sessões dos pacotes',
        'Fichas de papel que somem ou rasgam',
        'Dificuldade em calcular comissões',
        'Agenda confusa e horários vagos'
    ]"
    :gainTitle="'Clínica Digital'"
    :gainItems="[
        'Controle automático de sessões',
        'Anamnese e fotos digitais seguras',
        'Comissões calculadas sem erro',
        'Lembretes automáticos para pacientes'
    ]"
    :gainCardBg="'bg-teal-900'"
    :gainCardBorder="'border-teal-800'"
    :gainTitleColor="'text-teal-300'"
    :gainCheckColor="'text-teal-400'"
    :gainBadgeBg="'bg-teal-600'"
/>

<!-- How it Works -->
<section id="como-funciona" class="py-24 bg-teal-50/30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-20">
            <p class="text-sm font-semibold text-teal-600 uppercase tracking-[0.3em]">Passo a Passo</p>
            <h2 class="mt-4 text-3xl md:text-4xl font-bold text-slate-900">Gestão Simples e Eficiente</h2>
            <p class="mt-4 text-lg text-slate-600">Foque no atendimento aos pacientes e deixe a organização com o WSoft.</p>
        </div>

        <div class="space-y-24">
             <!-- Step 1 -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-teal-200 group">
                        <div class="absolute inset-0 bg-teal-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="{{ asset('images/sistema/clientes/cadastro.png') }}" alt="Cadastro de Pacientes" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-teal-100 text-teal-700 font-bold text-xl">1</span>
                        <h3 class="text-2xl font-bold text-slate-900">Cadastro e Anamnese</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Tenha um cadastro completo dos seus pacientes.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-teal-500"></i>
                            <span>Dados pessoais e contato</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-teal-500"></i>
                            <span>Anexar fichas e documentos PDF</span>
                        </li>
                         <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-teal-500"></i>
                            <span>Histórico de atendimentos centralizado</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-1">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-teal-100 text-teal-700 font-bold text-xl">2</span>
                        <h3 class="text-2xl font-bold text-slate-900">Controle de Pacotes</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Venda pacotes de tratamentos e controle as sessões automaticamente.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-teal-500"></i>
                            <span>Debita sessão ao agendar/concluir</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-teal-500"></i>
                            <span>Controle financeiro do pacote</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-teal-500"></i>
                            <span>Acompanhamento da evolução do tratamento</span>
                        </li>
                    </ul>
                </div>
                <div class="order-2">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-teal-200 group">
                        <div class="absolute inset-0 bg-teal-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="/images/crm/history.png" alt="Controle de Sessões" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-16 text-center">
            <a href="/app/register" class="inline-flex items-center gap-3 bg-teal-600 hover:bg-teal-700 text-white font-bold px-8 py-4 rounded-xl shadow-lg shadow-teal-500/20 hover:shadow-teal-500/40 transform hover:-translate-y-0.5 transition-all duration-300">
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
            <p class="text-sm font-semibold text-teal-600 uppercase tracking-[0.3em]">Vantagens</p>
            <h2 class="mt-4 text-3xl md:text-4xl font-bold">Ferramentas para sua Clínica</h2>
        </div>
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            <article class="group rounded-2xl border border-slate-100 bg-teal-50/20 p-6 shadow-sm hover:shadow-lg hover:border-teal-200 transition-all duration-300">
                <div class="w-12 h-12 bg-teal-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-teal-600 transition-colors duration-300">
                    <i class="fa-solid fa-calendar-check text-teal-600 group-hover:text-white text-xl transition-colors duration-300"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Agenda Multi-profissional</h3>
                <p class="text-sm text-slate-600 leading-relaxed">Organize a agenda de todas as salas e profissionais da clínica.</p>
            </article>
            <article class="group rounded-2xl border border-slate-100 bg-teal-50/20 p-6 shadow-sm hover:shadow-lg hover:border-cyan-200 transition-all duration-300">
                <div class="w-12 h-12 bg-cyan-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-cyan-600 transition-colors duration-300">
                    <i class="fa-solid fa-file-medical text-cyan-600 group-hover:text-white text-xl transition-colors duration-300"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Fichas e Anexos</h3>
                <p class="text-sm text-slate-600 leading-relaxed">Armazene fichas de anamnese, contratos e fotos de antes/depois.</p>
            </article>
            <article class="group rounded-2xl border border-slate-100 bg-teal-50/20 p-6 shadow-sm hover:shadow-lg hover:border-emerald-200 transition-all duration-300">
                <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-emerald-600 transition-colors duration-300">
                    <i class="fa-solid fa-hand-holding-dollar text-emerald-600 group-hover:text-white text-xl transition-colors duration-300"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Financeiro</h3>
                <p class="text-sm text-slate-600 leading-relaxed">Controle total de receitas, despesas, fluxo de caixa e comissões.</p>
            </article>
        </div>
    </div>
</section>

<!-- CTA Section -->
<x-site.cta-final
    :title="'Modernize sua Clínica de Estética'"
    :description="'Comece agora com 7 dias de teste grátis. Gestão profissional de estética por apenas <span class=\'text-teal-300 font-bold\'>R$ 29,90/mês</span>.'"
    :footer="'Usado por clínicas e esteticistas em todo Brasil'"
    :gradient="'bg-gradient-to-br from-teal-950 to-teal-700'"
    :textColor="'text-teal-50'"
    :highlightColor="'text-teal-300'"
    :buttonColor="'bg-teal-500 shadow-teal-500/30 hover:bg-teal-600'"
    :priceUrl="false"
/>

<!-- FAQ -->
<section id="faq" class="py-20 bg-teal-50/20">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <p class="text-sm font-semibold text-teal-600 uppercase tracking-[0.3em]">Dúvidas</p>
            <h2 class="mt-4 text-3xl font-bold">Perguntas Frequentes</h2>
        </div>
        <div class="space-y-4">
            <details class="group rounded-2xl border border-slate-100 bg-white p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    O sistema controla pacotes e sessões?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Sim! Você vende o pacote e o sistema debita as sessões automaticamente a cada agendamento realizado.</p>
            </details>
            <details class="group rounded-2xl border border-slate-100 bg-white p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    Posso anexar fotos de antes e depois?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Sim! O sistema permite anexar fotos e documentos (como ficha de anamnese) ao cadastro do cliente.</p>
            </details>
            <details class="group rounded-2xl border border-slate-100 bg-white p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    Tem controle de comissões?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Sim, cálculo automático de comissões para esteticistas, biomédicos e outros profissionais da clínica.</p>
            </details>
        </div>
    </div>
</section>

</x-site-layout>
