@php
$structuredData = [
    [
        '@context' => 'https://schema.org',
        '@type' => 'SoftwareApplication',
        'name' => 'WSoft - Sistema de Ordem de Serviço',
        'url' => 'https://www.wsoft.dev.br/sistema-ordem-servico',
        'description' => 'Sistema completo para gestão de ordens de serviço online. Automatize processos, elimine papeladas e profissionalize seu atendimento.',
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
            'ratingValue' => '4.8',
            'ratingCount' => '124'
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
                'name' => 'Ordem de Serviço',
                'item' => 'https://www.wsoft.dev.br/sistema-ordem-servico'
            ]
        ]
    ],
    [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => [
            [
                '@type' => 'Question',
                'name' => 'O que é um sistema de ordem de serviço?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Um sistema de ordem de serviço (OS) é uma plataforma digital que automatiza todo o processo de criação, acompanhamento e finalização de serviços. Substitui papel e planilhas por um sistema profissional e organizado.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'Como funciona o sistema de OS online?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Você registra os serviços no sistema, acompanha o status em tempo real, gera documentos automáticos e envia para o cliente por e-mail ou WhatsApp. Tudo digitalizado e profissional.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'Posso usar em oficinas mecânicas?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Sim! O WSoft é ideal para oficinas, mecânicas, assistências técnicas, prestadores de serviço e qualquer empresa que precise gerenciar ordens de serviço de forma profissional.'
                ]
            ]
        ]
    ]
];
@endphp

<x-site-layout
    :title="'Sistema de Ordem de Serviço Online | Software OS | WSoft'"
    :description="'Sistema de ordem de serviço online completo. Crie OS profissionais, acompanhe status, gere relatórios e elimine papeladas. Ideal para oficinas e assistências. Teste grátis!'"
    :keywords="'sistema ordem de serviço, software OS, ordem de serviço online, sistema OS oficina, programa ordem de serviço, gestão de serviços, OS digital, controle de serviços'"
    :canonical="'https://www.wsoft.dev.br/sistema-ordem-servico'"
    :ogTitle="'Sistema de Ordem de Serviço Online | WSoft'"
    :ogDescription="'Automatize ordens de serviço, elimine papeladas e profissionalize seu atendimento com o sistema de OS mais completo do mercado.'"
    :structuredData="$structuredData"
>

<!-- Hero -->
<section id="hero" class="pt-32 pb-24 bg-gradient-to-b from-indigo-950 via-indigo-900 to-indigo-800 text-white overflow-hidden relative">
    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 30px 30px;"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-16 items-center relative z-10">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-800/50 border border-indigo-700 text-indigo-200 text-xs font-semibold uppercase tracking-wider mb-6">
                <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                Sistema de Ordem de Serviço
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold leading-tight tracking-tight">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-200 to-white">Sistema de Ordem de Serviço</span> Online
            </h1>
            <p class="mt-6 text-lg md:text-xl text-blue-100 leading-relaxed max-w-lg">
                Automatize processos, elimine papeladas e profissionalize seu atendimento com o <strong>sistema de OS</strong> mais completo.
            </p>
            <div class="mt-10 flex flex-col sm:flex-row gap-4">
                <a href="/app/register" class="inline-flex justify-center items-center rounded-xl bg-white text-indigo-700 font-bold px-8 py-4 shadow-lg shadow-white/30 hover:bg-indigo-50 hover:-translate-y-1 transition transform duration-200">
                    Teste grátis por 7 dias
                    <i class="fa-solid fa-arrow-right ml-2"></i>
                </a>
                <a href="#como-funciona" class="inline-flex justify-center items-center rounded-xl border border-white/30 text-white font-semibold px-8 py-4 hover:bg-white/10 transition backdrop-blur-sm">
                    <i class="fa-solid fa-play mr-2"></i>
                    Como Funciona
                </a>
            </div>
            <div class="mt-10 pt-8 border-t border-white/10">
                <p class="text-sm text-blue-200 mb-4">Perfeito para:</p>
                <div class="flex flex-wrap gap-3 text-sm font-medium text-white">
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Oficinas Mecânicas</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Assistências Técnicas</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Prestadores de Serviço</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Manutenções</span>
                </div>
            </div>
        </div>
        <div class="relative">
            <div class="absolute -inset-4 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-full blur-3xl opacity-20 animate-pulse"></div>
            <div class="bg-white/10 border border-white/20 rounded-3xl p-8 backdrop-blur-md shadow-2xl relative">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <p class="text-sm uppercase text-blue-200 font-semibold tracking-wider">Ordens Ativas</p>
                        <h3 class="text-3xl font-bold mt-1">47 Serviços</h3>
                        <div class="flex items-center gap-2 mt-2">
                            <span class="text-xs font-bold text-green-400 bg-green-400/10 px-2 py-0.5 rounded">+18% este mês</span>
                        </div>
                    </div>
                    <div class="h-12 w-12 rounded-full bg-blue-500/20 flex items-center justify-center border border-blue-400/30">
                        <i class="fa-solid fa-clipboard-list text-blue-300 text-xl"></i>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-xs text-blue-200">Em Andamento</p>
                            <span class="text-sm font-bold text-blue-300">32</span>
                        </div>
                        <div class="h-2 bg-indigo-950/50 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-blue-400 to-indigo-400 w-[68%] rounded-full"></div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                            <p class="text-xs text-blue-200">Finalizadas Hoje</p>
                            <p class="text-2xl font-bold mt-1">8</p>
                        </div>
                        <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                            <p class="text-xs text-blue-200">Aguardando</p>
                            <p class="text-2xl font-bold mt-1">7</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pain vs Gain -->
<x-site.comparison
    :subtitle="'O problema do papel'"
    :title="'Ainda usa papel para ordens de serviço?'"
    :description="'Empresas sem um <strong>sistema de OS digital</strong> perdem tempo e dinheiro. Veja a diferença:'"
    :painTitle="'Desorganização Total'"
    :painItems="[
        'Perde tempo preenchendo papel à mão',
        'Ordens de serviço extraviadas ou ilegíveis',
        'Não sabe o status dos serviços em andamento',
        'Imagem amadora e pouco profissional'
    ]"
    :gainTitle="'Profissionalismo Digital'"
    :gainItems="[
        'Crie OS profissionais em menos de 1 minuto',
        'Tudo salvo na nuvem, acessível de qualquer lugar',
        'Acompanhe status em tempo real com filtros',
        'Envio automático por e-mail e WhatsApp'
    ]"
    :gainCardBg="'bg-indigo-900'"
    :gainCardBorder="'border-indigo-800'"
    :gainTitleColor="'text-indigo-400'"
    :gainCheckColor="'text-indigo-400'"
    :gainBadgeBg="'bg-indigo-500'"
/>

<!-- How it Works -->
<section id="como-funciona" class="py-24 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-20">
            <p class="text-sm font-semibold text-indigo-600 uppercase tracking-[0.3em]">Passo a Passo</p>
            <h2 class="mt-4 text-3xl md:text-4xl font-bold text-slate-900">Como funciona o Sistema de Ordem de Serviço</h2>
            <p class="mt-4 text-lg text-slate-600">Do registro à finalização, tudo automatizado e profissional.</p>
        </div>

        <div class="space-y-24">
            <!-- Step 1 -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 bg-slate-100 flex items-center justify-center h-96">
                        <i class="fa-solid fa-file-circle-plus text-indigo-300 text-9xl"></i>
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-indigo-100 text-indigo-700 font-bold text-xl">1</span>
                        <h3 class="text-2xl font-bold text-slate-900">Crie Ordens de Serviço</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Registre serviços em segundos com formulários inteligentes. Vincule cliente, produtos, defeitos, observações e fotos em um único documento.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-indigo-500"></i>
                            <span>Templates personalizáveis</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-indigo-500"></i>
                            <span>Anexo de fotos e documentos</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-indigo-500"></i>
                            <span>Código de barras e numeração automática</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-1">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-indigo-100 text-indigo-700 font-bold text-xl">2</span>
                        <h3 class="text-2xl font-bold text-slate-900">Acompanhe em Tempo Real</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Controle o status de cada ordem: aguardando peças, em execução, finalizada. Organize por filtros, prioridade e técnico responsável.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-indigo-500"></i>
                            <span>Dashboard visual com status</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-indigo-500"></i>
                            <span>Alertas para OS atrasadas</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-indigo-500"></i>
                            <span>Histórico completo de alterações</span>
                        </li>
                    </ul>
                </div>
                <div class="order-2">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 bg-slate-100 flex items-center justify-center h-96">
                        <i class="fa-solid fa-list-check text-indigo-300 text-9xl"></i>
                    </div>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 bg-slate-100 flex items-center justify-center h-96">
                        <i class="fa-solid fa-paper-plane text-indigo-300 text-9xl"></i>
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-indigo-100 text-indigo-700 font-bold text-xl">3</span>
                        <h3 class="text-2xl font-bold text-slate-900">Finalize e Envie</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Gere documentos profissionais automaticamente. Envie por e-mail, WhatsApp ou imprima. Cliente recebe tudo de forma rápida e organizada.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-indigo-500"></i>
                            <span>Geração automática de PDF</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-indigo-500"></i>
                            <span>Envio por e-mail e WhatsApp</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-indigo-500"></i>
                            <span>Integração com financeiro</span>
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
            <p class="text-sm font-semibold text-indigo-600 uppercase tracking-[0.3em]">Vantagens</p>
            <h2 class="mt-4 text-3xl md:text-4xl font-bold">Por que usar um sistema de ordem de serviço?</h2>
            <p class="mt-4 text-lg text-slate-600">Elimine papel, ganhe tempo e profissionalize seu negócio</p>
        </div>
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-bolt text-indigo-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Ganhe Produtividade</h3>
                    <p class="mt-3 text-slate-600">Crie ordens de serviço 10x mais rápido do que no papel. Mais tempo para atender clientes.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-shield-halved text-blue-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Dados Seguros</h3>
                    <p class="mt-3 text-slate-600">Nunca perca uma OS novamente. Tudo salvo na nuvem com backup automático.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-award text-purple-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Imagem Profissional</h3>
                    <p class="mt-3 text-slate-600">Ordens de serviço com sua logo, limpas e organizadas. Cliente nota a diferença.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-money-bill-trend-up text-orange-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Controle Financeiro</h3>
                    <p class="mt-3 text-slate-600">Integre OS com contas a receber. Saiba exatamente o faturamento por serviço.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-chart-line text-red-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Relatórios Completos</h3>
                    <p class="mt-3 text-slate-600">Identifique serviços mais rentáveis, técnicos mais produtivos e tome decisões baseadas em dados.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-teal-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-mobile-screen-button text-teal-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Acesso em Qualquer Lugar</h3>
                    <p class="mt-3 text-slate-600">Consulte e crie OS pelo celular, tablet ou computador. Trabalhe de onde estiver.</p>
                </div>
            </article>
        </div>
    </div>
</section>

<!-- CTA Section -->
<x-site.cta-final
    :title="'Escolha um sistema completo para gestão de ordens de serviço'"
    :description="'Comece agora com 7 dias de teste grátis. Use o melhor <strong>sistema para controle de OS e serviços</strong> por apenas <span class=\'text-yellow-300 font-bold\'>R$ 79,90/mês</span>.'"
    :footer="'Junte-se a centenas de prestadores de serviço que usam WSoft'"
    :gradient="'bg-gradient-to-br from-indigo-600 to-blue-600'"
    :textColor="'text-indigo-50'"
    :highlightColor="'text-yellow-300'"
/>


<!-- FAQ -->
<section id="faq" class="py-20 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <p class="text-sm font-semibold text-indigo-600 uppercase tracking-[0.3em]">FAQ</p>
            <h2 class="mt-4 text-3xl font-bold">Perguntas frequentes sobre ordem de serviço</h2>
        </div>
        <div class="space-y-4">
            <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    O que é um sistema de ordem de serviço?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Um sistema de ordem de serviço (OS) é uma plataforma digital que automatiza todo o processo de criação, acompanhamento e finalização de serviços. Substitui papel e planilhas por um sistema profissional e organizado.</p>
            </details>
            <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    Como funciona o sistema de OS online?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Você registra os serviços no sistema, acompanha o status em tempo real, gera documentos automáticos e envia para o cliente por e-mail ou WhatsApp. Tudo digitalizado e profissional.</p>
            </details>
            <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    Posso usar em oficinas mecânicas?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Sim! O WSoft é ideal para oficinas, mecânicas, assistências técnicas, prestadores de serviço e qualquer empresa que precise gerenciar ordens de serviço de forma profissional.</p>
            </details>
            <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    Posso personalizar o layout da OS?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Sim! Você pode adicionar sua logo, escolher cores, definir campos personalizados e criar templates específicos para cada tipo de serviço que você oferece.</p>
            </details>
            <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    A OS integra com o financeiro?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Sim! Ao finalizar uma OS, você pode gerar automaticamente contas a receber, controlar pagamentos e ter visão completa do faturamento por serviço.</p>
            </details>
        </div>
    </div>
</section>

</x-site-layout>
