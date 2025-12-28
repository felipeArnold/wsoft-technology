@php
$structuredData = [
    [
        '@context' => 'https://schema.org',
        '@type' => 'SoftwareApplication',
        'name' => 'WSoft - Sistema para Lava Rápido',
        'url' => 'https://www.wsoft.dev.br/sistema-para-lava-rapido',
        'description' => 'Sistema completo para gestão de Lava Rápido e Estética Automotiva. Controle de lavagens, comissões e financeiro.',
        'operatingSystem' => 'Web',
        'applicationCategory' => 'AutomotiveApplication',
        'offers' => [
            '@type' => 'Offer',
            'price' => '29.90',
            'priceCurrency' => 'BRL',
            'url' => 'https://www.wsoft.dev.br/app/register',
            'description' => 'Plano mensal com todas as funcionalidades'
        ],
        'aggregateRating' => [
            '@type' => 'AggregateRating',
            'ratingValue' => '4.8',
            'ratingCount' => '68'
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
                'name' => 'Lava Rápido',
                'item' => 'https://www.wsoft.dev.br/sistema-para-lava-rapido'
            ]
        ]
    ],
    [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => [
            [
                '@type' => 'Question',
                'name' => 'O sistema emite recibo com a placa?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Sim! Ao cadastrar o serviço, você informa a placa e pode imprimir ou enviar o recibo pelo WhatsApp.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'Tem controle de comissões?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Sim, controle as comissões dos lavadores automaticamente por serviço realizado.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'Posso controlar pacotes de lavagem?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Sim! Venda planos mensais ou pacotes de lavagens e controle o uso de cada cliente.'
                ]
            ],
             [
                '@type' => 'Question',
                'name' => 'Funciona no celular?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Sim, você pode registrar a entrada dos veículos usando seu celular ou tablet direto do pátio.'
                ]
            ]
        ]
    ],
    [
        '@context' => 'https://schema.org',
        '@type' => 'HowTo',
        'name' => 'Como organizar seu Lava Rápido com WSoft',
        'description' => 'Guia prático para organizar a fila, serviços e financeiro do seu lava rápido.',
        'step' => [
            [
                '@type' => 'HowToStep',
                'name' => 'Cadastre a Entrada',
                'text' => 'Registre a placa do veículo e o serviço desejado (ducha, completa, cera).',
                'position' => 1
            ],
            [
                '@type' => 'HowToStep',
                'name' => 'Controle o Serviço',
                'text' => 'Acompanhe o status (na fila, lavando, finalizado). Saiba qual lavador realizou o serviço.',
                'position' => 2
            ],
            [
                '@type' => 'HowToStep',
                'name' => 'Finalize e Receba',
                'text' => 'Encerre a ordem de serviço, receba o pagamento e fidelize o cliente.',
                'position' => 3
            ]
        ]
    ]
];
@endphp

<x-site-layout
    :title="'Sistema para Lava Rápido | Controle de Lavagens | WSoft'"
    :description="'Sistema para Lava Rápido e Estética Automotiva. Controle de lavagens, financeiro, comissões de lavadores. Teste grátis!'"
    :keywords="'sistema para lava rápido, software lava rápido, gestão de lava jato, controle de lavagens, sistema estética automotiva, programa para lava rápido, comissão lavadores'"
    :canonical="'https://www.wsoft.dev.br/sistema-para-lava-rapido'"
    :ogTitle="'Sistema para Lava Rápido | WSoft'"
    :ogDescription="'Organize a fila, controle comissões e aumente o lucro do seu Lava Rápido.'"
    :structuredData="$structuredData"
>

<!-- Hero -->
<section id="hero" class="pt-32 pb-24 bg-gradient-to-b from-blue-950 via-blue-900 to-slate-900 text-white overflow-hidden relative">
    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 30px 30px;"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-16 items-center relative z-10">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-800/50 border border-blue-700 text-blue-100 text-xs font-semibold uppercase tracking-wider mb-6">
                <span class="w-2 h-2 rounded-full bg-blue-400 animate-pulse"></span>
                Sistema Automotivo
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold leading-tight tracking-tight">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-300">Sistema de Gestão</span> para Lava Rápido
            </h1>
            <p class="mt-6 text-lg md:text-xl text-blue-100/80 leading-relaxed max-w-lg">
                Gerencie lavagens, controle a fila de espera, checklist de entrada e comissões. O sistema feito para otimizar seu tempo. <span class="text-blue-400 font-bold block mt-2">Apenas R$ 29,90/mês.</span>
            </p>
            <div class="mt-10 flex flex-col sm:flex-row gap-4">
                <a href="/app/register" class="inline-flex justify-center items-center rounded-xl bg-blue-600 text-white font-bold px-8 py-4 shadow-lg shadow-blue-600/30 hover:bg-blue-700 hover:-translate-y-1 transition transform duration-200">
                    Teste grátis por 7 dias
                    <i class="fa-solid fa-arrow-right ml-2"></i>
                </a>
                <a href="#como-funciona" class="inline-flex justify-center items-center rounded-xl border border-white/30 text-white font-semibold px-8 py-4 hover:bg-white/10 transition backdrop-blur-sm">
                    <i class="fa-solid fa-play mr-2"></i>
                    Como Funciona
                </a>
            </div>
            <div class="mt-10 pt-8 border-t border-blue-800/30">
                <p class="text-sm text-blue-200/60 mb-4">Ideal para:</p>
                <div class="flex flex-wrap gap-3 text-sm font-medium text-white">
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Lava Rápidos</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Estética Automotiva</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Lava Jato</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Polimento</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Higienização</span>
                </div>
            </div>
        </div>
        <div class="relative">
            <div class="absolute -inset-4 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-full blur-3xl opacity-20 animate-pulse"></div>
            <div class="bg-blue-900/40 border border-blue-700/50 rounded-3xl p-8 backdrop-blur-md shadow-2xl relative">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <p class="text-sm uppercase text-blue-200/70 font-semibold tracking-wider">Lavagens Hoje</p>
                        <p class="text-3xl font-bold mt-1 text-white">45</p>
                        <div class="flex items-center gap-2 mt-2">
                            <span class="text-xs font-bold text-blue-300 bg-blue-500/20 px-2 py-0.5 rounded">Sol a pino</span>
                        </div>
                    </div>
                    <div class="h-12 w-12 rounded-full bg-blue-500/20 flex items-center justify-center border border-blue-400/30">
                        <i class="fa-solid fa-car-side text-blue-300 text-xl"></i>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="bg-blue-800/40 rounded-xl p-4 border border-blue-700/50">
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-xs text-blue-200">Faturamento</p>
                            <span class="text-sm font-bold text-blue-300">R$ 1.890,00</span>
                        </div>
                         <div class="h-2 bg-blue-950 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-blue-400 to-cyan-400 w-[65%] rounded-full"></div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-blue-800/40 rounded-xl p-4 border border-blue-700/50">
                            <p class="text-xs text-blue-200">Na Fila</p>
                            <p class="text-2xl font-bold mt-1 text-white">3</p>
                        </div>
                        <div class="bg-blue-800/40 rounded-xl p-4 border border-blue-700/50">
                            <p class="text-xs text-blue-200">Finalizados</p>
                            <p class="text-2xl font-bold mt-1 text-white">42</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pain vs Gain -->
<x-site.comparison
    :subtitle="'Chega de papelada'"
    :title="'Perdendo dinheiro no Lava Rápido?'"
    :description="'A falta de controle gera desconfiança e prejuízo. Mude sua realidade:'"
    :painTitle="'Sem Controle'"
    :painItems="[
        'Não sabe quantos carros foram lavados',
        'Confusão no pagamento dos lavadores',
        'Cliente reclama que pulou a vez',
        'Não tem histórico dos clientes'
    ]"
    :gainTitle="'Lava Rápido Digital'"
    :gainItems="[
        'Registro digital de todas as entradas',
        'Comissões calculadas automaticamente',
        'Fila de espera organizada',
        'Cadastro de clientes e veículos'
    ]"
    :gainCardBg="'bg-blue-900'"
    :gainCardBorder="'border-blue-800'"
    :gainTitleColor="'text-blue-300'"
    :gainCheckColor="'text-blue-400'"
    :gainBadgeBg="'bg-blue-600'"
/>

<!-- How it Works -->
<section id="como-funciona" class="py-24 bg-blue-50/30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-20">
            <p class="text-sm font-semibold text-blue-600 uppercase tracking-[0.3em]">Passo a Passo</p>
            <h2 class="mt-4 text-3xl md:text-4xl font-bold text-slate-900">Como funciona o Sistema</h2>
            <p class="mt-4 text-lg text-slate-600">Do pátio ao caixa, controle total do seu negócio.</p>
        </div>

        <div class="space-y-24">
             <!-- Step 1 -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-blue-200 group">
                        <div class="absolute inset-0 bg-blue-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="{{ asset('images/sistema/ordem_servico/nova-os.png') }}" alt="Entrada de Veículos" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-blue-100 text-blue-700 font-bold text-xl">1</span>
                        <h3 class="text-2xl font-bold text-slate-900">Receba o Veículo</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Registre a placa, modelo e o serviço desejado (ducha, completa, polimento).
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-blue-500"></i>
                            <span>Cadastro rápido pela placa</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-blue-500"></i>
                            <span>Checklist de entrada (avarias)</span>
                        </li>
                         <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-blue-500"></i>
                            <span>Previsão de entrega</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-1">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-blue-100 text-blue-700 font-bold text-xl">2</span>
                        <h3 class="text-2xl font-bold text-slate-900">Acompanhe e Finalize</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Controle o andamento dos serviços e saiba quem lavou cada carro para pagar a comissão correta.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-blue-500"></i>
                            <span>Status do serviço (lavando, secando, pronto)</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-blue-500"></i>
                            <span>Vinculação de lavadores ao serviço</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-blue-500"></i>
                            <span>Aviso de veículo pronto</span>
                        </li>
                    </ul>
                </div>
                <div class="order-2">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-blue-200 group">
                        <div class="absolute inset-0 bg-blue-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="/images/crm/dashboard-preview.png" alt="Controle Lava Rápido" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-16 text-center">
            <a href="/app/register" class="inline-flex items-center gap-3 bg-blue-600 hover:bg-blue-700 text-white font-bold px-8 py-4 rounded-xl shadow-lg shadow-blue-500/20 hover:shadow-blue-500/40 transform hover:-translate-y-0.5 transition-all duration-300">
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
            <p class="text-sm font-semibold text-blue-600 uppercase tracking-[0.3em]">Vantagens</p>
            <h2 class="mt-4 text-3xl md:text-4xl font-bold">Gestão Automotiva</h2>
        </div>
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            <article class="group rounded-2xl border border-slate-100 bg-blue-50/20 p-6 shadow-sm hover:shadow-lg hover:border-blue-200 transition-all duration-300">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-blue-600 transition-colors duration-300">
                    <i class="fa-solid fa-car text-blue-600 group-hover:text-white text-xl transition-colors duration-300"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Checklist Digital</h3>
                <p class="text-sm text-slate-600 leading-relaxed">Registre avarias, objetos no veículo e estado de entrada para evitar problemas.</p>
            </article>
            <article class="group rounded-2xl border border-slate-100 bg-blue-50/20 p-6 shadow-sm hover:shadow-lg hover:border-cyan-200 transition-all duration-300">
                <div class="w-12 h-12 bg-cyan-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-cyan-600 transition-colors duration-300">
                    <i class="fa-solid fa-droplet text-cyan-600 group-hover:text-white text-xl transition-colors duration-300"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Serviços e Estética</h3>
                <p class="text-sm text-slate-600 leading-relaxed">Gerencie duchas, lavagens completas, polimentos, higienização e muito mais.</p>
            </article>
            <article class="group rounded-2xl border border-slate-100 bg-blue-50/20 p-6 shadow-sm hover:shadow-lg hover:border-sky-200 transition-all duration-300">
                <div class="w-12 h-12 bg-sky-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-sky-600 transition-colors duration-300">
                    <i class="fa-solid fa-users-gear text-sky-600 group-hover:text-white text-xl transition-colors duration-300"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Comissões</h3>
                <p class="text-sm text-slate-600 leading-relaxed">Cálculo automático de comissões para sua equipe de lavadores.</p>
            </article>
        </div>
    </div>
</section>

<!-- CTA Section -->
<x-site.cta-final
    :title="'Agilize seu Lava Rápido'"
    :description="'Comece agora com 7 dias de teste grátis. Organização profissional por apenas <span class=\'text-blue-300 font-bold\'>R$ 29,90/mês</span>.'"
    :footer="'Usado por Lava Rápidos em todo o Brasil'"
    :gradient="'bg-gradient-to-br from-blue-950 to-blue-700'"
    :textColor="'text-blue-50'"
    :highlightColor="'text-blue-300'"
    :buttonColor="'bg-blue-500 shadow-blue-500/30 hover:bg-blue-600'"
    :priceUrl="false"
/>

<!-- FAQ -->
<section id="faq" class="py-20 bg-blue-50/20">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <p class="text-sm font-semibold text-blue-600 uppercase tracking-[0.3em]">Dúvidas</p>
            <h2 class="mt-4 text-3xl font-bold">Perguntas Frequentes</h2>
        </div>
        <div class="space-y-4">
             <details class="group rounded-2xl border border-slate-100 bg-white p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    O sistema emite recibo com a placa?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Sim! Ao cadastrar o serviço, você informa a placa e pode imprimir ou enviar o recibo pelo WhatsApp.</p>
            </details>
            <details class="group rounded-2xl border border-slate-100 bg-white p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    Tem controle de comissões?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Sim, controle as comissões dos lavadores automaticamente por serviço realizado.</p>
            </details>
             <details class="group rounded-2xl border border-slate-100 bg-white p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    Posso controlar pacotes de lavagem?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Sim! Venda planos mensais ou pacotes de lavagens e controle o uso de cada cliente.</p>
            </details>
        </div>
    </div>
</section>

</x-site-layout>
