@php
$structuredData = [
    [
        '@context' => 'https://schema.org',
        '@type' => 'SoftwareApplication',
        'name' => 'WSoft - Sistema para Pizzaria',
        'url' => 'https://www.wsoft.dev.br/sistema-para-pizzaria',
        'description' => 'Sistema completo para gestão de pizzarias e delivery. Controle de pedidos, estoque, financeiro e clientes.',
        'operatingSystem' => 'Web',
        'applicationCategory' => 'FoodServiceApplication',
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
            'ratingCount' => '110'
        ]
    ],
    [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            [
                '@type' => 'ListItem',
                'position' => 1,
                'name' => 'Início',
                'item' => 'https://www.wsoft.dev.br/'
            ],
            [
                '@type' => 'ListItem',
                'position' => 2,
                'name' => 'Sistema para Pizzaria',
                'item' => 'https://www.wsoft.dev.br/sistema-para-pizzaria'
            ]
    ],
    [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => [
            [
                '@type' => 'Question',
                'name' => 'Funciona para Delivery e Balcão?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Sim! Gerencie pedidos de entrega, retirada no balcão e consumo no local em uma única tela.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'Posso cadastrar sabores e bordas?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Sim! Cadastre seus produtos, bebidas e adicionais de forma flexível para agilizar o atendimento.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'O sistema controla o entregador?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Você pode vincular o entregador ao pedido para controle de taxas e conferência no final do expediente.'
                ]
            ],
             [
                '@type' => 'Question',
                'name' => 'Tem cadastro de clientes?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Sim, ao digitar o telefone o sistema já busca o cadastro do cliente, agilizando o pedido.'
                ]
            ]
        ]
    ],
    [
        '@context' => 'https://schema.org',
        '@type' => 'HowTo',
        'name' => 'Como gerenciar sua Pizzaria com WSoft',
        'description' => 'Passo a passo para organizar pedidos, entregas e financeiro da sua pizzaria.',
        'step' => [
            [
                '@type' => 'HowToStep',
                'name' => 'Receba o Pedido',
                'text' => 'Lance pedidos de forma rápida. Identifique o cliente e seus dados de entrega automaticamente.',
                'position' => 1
            ],
            [
                '@type' => 'HowToStep',
                'name' => 'Controle a Produção',
                'text' => 'Organize a fila de pedidos. Evite erros na cozinha e atrasos na entrega.',
                'position' => 2
            ],
            [
                '@type' => 'HowToStep',
                'name' => 'Gerencie Entregas',
                'text' => 'Controle quais pedidos saíram, quem levou e o valor a receber. Fechamento de caixa sem erros.',
                'position' => 3
            ]
        ]
    ]
];
@endphp

<x-site-layout
    :title="'Sistema para Pizzaria e Delivery | Gestão Completa | WSoft'"
    :description="'Sistema para pizzaria e delivery. Controle pedidos, entregas, estoque e financeiro. Simples e rápido. Teste grátis!'"
    :keywords="'sistema para pizzaria, sistema delivery pizza, software pizzaria, programa para pizzaria, gestão de pizzaria, pdv pizzaria, controle de entregas, sistema para delivery'"
    :canonical="'https://www.wsoft.dev.br/sistema-para-pizzaria'"
    :ogTitle="'Sistema para Pizzaria e Delivery | WSoft'"
    :ogDescription="'Agilize seu delivery e organize sua pizzaria com o sistema WSoft.'"
    :structuredData="$structuredData"
>

<!-- Hero -->
<section id="hero" class="pt-32 pb-24 bg-gradient-to-b from-red-950 via-red-900 to-slate-900 text-white overflow-hidden relative">
    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 30px 30px;"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-16 items-center relative z-10">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-red-800/50 border border-red-700 text-red-100 text-xs font-semibold uppercase tracking-wider mb-6">
                <span class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></span>
                Sistema para Delivery e Salão
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold leading-tight tracking-tight">
                Sistema para <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-500 to-orange-400">Pizzaria e Delivery</span>
            </h1>
            <p class="mt-6 text-lg md:text-xl text-red-100/80 leading-relaxed max-w-lg">
                Atenda mais rápido, elimine erros nos pedidos e controle suas entregas e motoboys com eficiência. O sistema ideal para seu delivery. <span class="text-red-400 font-bold block mt-2">Apenas R$ 29,90/mês.</span>
            </p>
            <div class="mt-10 flex flex-col sm:flex-row gap-4">
                <a href="/app/register" class="inline-flex justify-center items-center rounded-xl bg-red-600 text-white font-bold px-8 py-4 shadow-lg shadow-red-600/30 hover:bg-red-700 hover:-translate-y-1 transition transform duration-200">
                    Teste grátis por 7 dias
                    <i class="fa-solid fa-arrow-right ml-2"></i>
                </a>
                <a href="#como-funciona" class="inline-flex justify-center items-center rounded-xl border border-white/30 text-white font-semibold px-8 py-4 hover:bg-white/10 transition backdrop-blur-sm">
                    <i class="fa-solid fa-play mr-2"></i>
                    Como Funciona
                </a>
            </div>
            <div class="mt-10 pt-8 border-t border-red-800/30">
                <p class="text-sm text-red-200/60 mb-4">Ideal para:</p>
                <div class="flex flex-wrap gap-3 text-sm font-medium text-white">
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Pizzarias</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Delivery</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Hamburguerias</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Lanchonetes</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Restaurantes</span>
                </div>
            </div>
        </div>
        <div class="relative">
            <div class="absolute -inset-4 bg-gradient-to-r from-red-600 to-orange-500 rounded-full blur-3xl opacity-20 animate-pulse"></div>
            <div class="bg-red-900/40 border border-red-700/50 rounded-3xl p-8 backdrop-blur-md shadow-2xl relative">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <p class="text-sm uppercase text-red-200/70 font-semibold tracking-wider">Pedidos Hoje</p>
                        <p class="text-3xl font-bold mt-1 text-white">85</p>
                        <div class="flex items-center gap-2 mt-2">
                            <span class="text-xs font-bold text-red-300 bg-red-500/20 px-2 py-0.5 rounded">Alta demanda</span>
                        </div>
                    </div>
                    <div class="h-12 w-12 rounded-full bg-red-500/20 flex items-center justify-center border border-red-400/30">
                        <i class="fa-solid fa-pizza-slice text-red-300 text-xl"></i>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="bg-red-800/40 rounded-xl p-4 border border-red-700/50">
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-xs text-red-200">Ticket Médio</p>
                            <span class="text-sm font-bold text-red-300">R$ 65,00</span>
                        </div>
                         <div class="h-2 bg-red-950 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-red-500 to-orange-500 w-[75%] rounded-full"></div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-red-800/40 rounded-xl p-4 border border-red-700/50">
                            <p class="text-xs text-red-200">Entregas</p>
                            <p class="text-2xl font-bold mt-1 text-white">62</p>
                        </div>
                        <div class="bg-red-800/40 rounded-xl p-4 border border-red-700/50">
                            <p class="text-xs text-red-200">Balcão</p>
                            <p class="text-2xl font-bold mt-1 text-white">23</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pain vs Gain -->
<x-site.comparison
    :subtitle="'Acabe com os erros'"
    :title="'Delivery atrasado e pedidos errados?'"
    :description="'A confusão nos pedidos faz você perder clientes. Organize sua pizzaria:'"
    :painTitle="'Pizzaria Caótica'"
    :painItems="[
        'Anota pedidos em papel e erra sabores',
        'Motoboy sai sem saber endereço',
        'Cliente reclama da demora',
        'Não sabe o lucro real da noite'
    ]"
    :gainTitle="'Gestão Eficiente'"
    :gainItems="[
        'Pedidos digitais sem erros',
        'Controle de taxas e entregadores',
        'Cadastro de clientes automático',
        'Fechamento de caixa preciso'
    ]"
    :gainCardBg="'bg-red-900'"
    :gainCardBorder="'border-red-800'"
    :gainTitleColor="'text-red-300'"
    :gainCheckColor="'text-red-400'"
    :gainBadgeBg="'bg-red-600'"
/>

<!-- How it Works -->
<section id="como-funciona" class="py-24 bg-red-50/30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-20">
            <p class="text-sm font-semibold text-red-600 uppercase tracking-[0.3em]">Passo a Passo</p>
            <h2 class="mt-4 text-3xl md:text-4xl font-bold text-slate-900">Como funciona no Dia a Dia</h2>
            <p class="mt-4 text-lg text-slate-600">Feito para agilizar o atendimento, do pedido à entrega.</p>
        </div>

        <div class="space-y-24">
             <!-- Step 1 -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-red-200 group">
                        <div class="absolute inset-0 bg-red-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="{{ asset('images/sistema/vendas/nova-venda.png') }}" alt="Tela de Pedidos" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-red-100 text-red-700 font-bold text-xl">1</span>
                        <h3 class="text-2xl font-bold text-slate-900">Atendimento Rápido</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Lance o pedido em segundos. O sistema puxa o cadastro do cliente pelo telefone e já sugere o último pedido.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-red-500"></i>
                            <span>Busca automática de cliente</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-red-500"></i>
                            <span>Impressão de pedido para cozinha</span>
                        </li>
                         <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-red-500"></i>
                            <span>Opção de sabores, bordas e adicionais</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-1">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-red-100 text-red-700 font-bold text-xl">2</span>
                        <h3 class="text-2xl font-bold text-slate-900">Controle Financeiro</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Saiba exatamente quanto vendeu, quais as taxas dos motoboys e o lucro da noite.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-red-500"></i>
                            <span>Fechamento de caixa simplificado</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-red-500"></i>
                            <span>Controle de taxas de entrega</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-red-500"></i>
                            <span>Relatórios de vendas por produto</span>
                        </li>
                    </ul>
                </div>
                <div class="order-2">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-red-200 group">
                        <div class="absolute inset-0 bg-red-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="/images/crm/dashboard-preview.png" alt="Financeiro Pizzaria" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-16 text-center">
            <a href="/app/register" class="inline-flex items-center gap-3 bg-red-600 hover:bg-red-700 text-white font-bold px-8 py-4 rounded-xl shadow-lg shadow-red-500/20 hover:shadow-red-500/40 transform hover:-translate-y-0.5 transition-all duration-300">
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
            <p class="text-sm font-semibold text-red-600 uppercase tracking-[0.3em]">Vantagens</p>
            <h2 class="mt-4 text-3xl md:text-4xl font-bold">Pizza quentinha, Gestão em dia</h2>
        </div>
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            <article class="group rounded-2xl border border-slate-100 bg-red-50/20 p-6 shadow-sm hover:shadow-lg hover:border-red-200 transition-all duration-300">
                <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-red-600 transition-colors duration-300">
                    <i class="fa-solid fa-motorcycle text-red-600 group-hover:text-white text-xl transition-colors duration-300"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Delivery Eficiente</h3>
                <p class="text-sm text-slate-600 leading-relaxed">Organize as entregas, taxas e rotas dos motoqueiros.</p>
            </article>
            <article class="group rounded-2xl border border-slate-100 bg-red-50/20 p-6 shadow-sm hover:shadow-lg hover:border-orange-200 transition-all duration-300">
                <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-orange-600 transition-colors duration-300">
                    <i class="fa-solid fa-clipboard-list text-orange-600 group-hover:text-white text-xl transition-colors duration-300"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Pedidos e Sabores</h3>
                <p class="text-sm text-slate-600 leading-relaxed">Controle de pizzas meio a meio, bordas recheadas e adicionais de forma simples.</p>
            </article>
            <article class="group rounded-2xl border border-slate-100 bg-red-50/20 p-6 shadow-sm hover:shadow-lg hover:border-yellow-200 transition-all duration-300">
                <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-yellow-600 transition-colors duration-300">
                    <i class="fa-solid fa-users text-yellow-600 group-hover:text-white text-xl transition-colors duration-300"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Cadastro de Clientes</h3>
                <p class="text-sm text-slate-600 leading-relaxed">Histórico de pedidos e dados de entrega sempre à mão.</p>
            </article>
        </div>
    </div>
</section>

<!-- CTA Section -->
<x-site.cta-final
    :title="'O sistema que sua Pizzaria precisa'"
    :description="'Comece agora com 7 dias de teste grátis. Delivery organizado por apenas <span class=\'text-red-300 font-bold\'>R$ 29,90/mês</span>.'"
    :footer="'Especialista em Food Service'"
    :gradient="'bg-gradient-to-br from-red-950 to-red-700'"
    :textColor="'text-red-50'"
    :highlightColor="'text-red-300'"
    :buttonColor="'bg-red-500 shadow-red-500/30 hover:bg-red-600'"
    :priceUrl="false"
/>

<!-- FAQ -->
<section id="faq" class="py-20 bg-red-50/20">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <p class="text-sm font-semibold text-red-600 uppercase tracking-[0.3em]">Dúvidas</p>
            <h2 class="mt-4 text-3xl font-bold">Perguntas Frequentes</h2>
        </div>
        <div class="space-y-4">
            <details class="group rounded-2xl border border-slate-100 bg-white p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    Funciona para Delivery e Balcão?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Sim! Gerencie pedidos de entrega, retirada no balcão e consumo no local em uma única tela.</p>
            </details>
            <details class="group rounded-2xl border border-slate-100 bg-white p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    Posso cadastrar sabores e bordas?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Sim! Cadastre seus produtos, bebidas e adicionais de forma flexível para agilizar o atendimento.</p>
            </details>
             <details class="group rounded-2xl border border-slate-100 bg-white p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    O sistema controla o entregador?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Você pode vincular o entregador ao pedido para controle de taxas e conferência no final do expediente.</p>
            </details>
        </div>
    </div>
</section>

</x-site-layout>
