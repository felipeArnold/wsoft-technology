@php
$structuredData = [
    [
        '@context' => 'https://schema.org',
        '@type' => 'SoftwareApplication',
        'name' => 'WSoft - Sistema para Loja de Roupas',
        'url' => 'https://www.wsoft.dev.br/sistema-para-loja-de-roupas',
        'description' => 'Sistema completo para gestão de lojas de roupas e confecções. Controle de estoque, vendas, PDV e financeiro.',
        'operatingSystem' => 'Web',
        'applicationCategory' => 'RetailApplication',
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
            'ratingCount' => '95'
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
                'name' => 'Loja de Roupas',
                'item' => 'https://www.wsoft.dev.br/sistema-para-loja-de-roupas'
            ]
        ]
    ],
    [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => [
            [
                '@type' => 'Question',
                'name' => 'O sistema emite etiquetas de código de barras?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'O sistema gera códigos de barras para seus produtos, facilitando a venda e o controle de estoque.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'Consigo controlar o estoque por categoria?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Sim! Organize suas roupas por coleção, tipo, marca e estação. Saiba exatamente o que vende mais.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'Posso vender no crediário?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Sim, você pode registrar vendas a prazo (fiado/crediário) e controlar os recebimentos futuros de cada cliente.'
                ]
            ],
             [
                '@type' => 'Question',
                'name' => 'Funciona no celular?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Sim! O WSoft é totalmente online e responsivo. Você pode consultar estoque e realizar vendas pelo celular ou tablet.'
                ]
            ]
        ]
    ],
    [
        '@context' => 'https://schema.org',
        '@type' => 'HowTo',
        'name' => 'Como organizar sua Loja de Roupas com WSoft',
        'description' => 'Guia prático para organizar estoque, vendas e financeiro da sua loja de moda.',
        'step' => [
            [
                '@type' => 'HowToStep',
                'name' => 'Cadastre os Produtos',
                'text' => 'Registre suas peças com fotos, preços e custos. Organize por categorias para facilitar a busca.',
                'position' => 1
            ],
            [
                '@type' => 'HowToStep',
                'name' => 'Controle o Estoque',
                'text' => 'Acompanhe entradas e saídas. Evite furos de estoque e saiba a hora certa de repor mercadoria.',
                'position' => 2
            ],
            [
                '@type' => 'HowToStep',
                'name' => 'Gerencie Vendas',
                'text' => 'Faça vendas rápidas, emita comprovantes e controle o fiado com eficiência.',
                'position' => 3
            ]
        ]
    ]
];
@endphp

<x-site-layout
    :title="'Sistema para Loja de Roupas | Controle de Estoque | WSoft'"
    :description="'Sistema para loja de roupas simples e eficiente. Controle de estoque, vendas e financeiro. Teste grátis por 7 dias!'"
    :keywords="'sistema para loja de roupas, software loja de roupas, controle de estoque roupas, programa para loja de roupa, gestão de loja de moda, sistema de vendas roupas, pdv loja roupas'"
    :canonical="'https://www.wsoft.dev.br/sistema-para-loja-de-roupas'"
    :ogTitle="'Sistema para Loja de Roupas | WSoft'"
    :ogDescription="'Organize o estoque e aumente as vendas da sua loja de roupas com o WSoft.'"
    :structuredData="$structuredData"
>

<!-- Hero -->
<section id="hero" class="pt-32 pb-24 bg-gradient-to-b from-violet-950 via-violet-900 to-slate-900 text-white overflow-hidden relative">
    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 30px 30px;"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-16 items-center relative z-10">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-violet-800/50 border border-violet-700 text-violet-100 text-xs font-semibold uppercase tracking-wider mb-6">
                <span class="w-2 h-2 rounded-full bg-violet-400 animate-pulse"></span>
                Sistema para Varejo de Moda
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold leading-tight tracking-tight">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-violet-400 to-fuchsia-300">Sistema de Gestão</span> para Loja de Roupas
            </h1>
            <p class="mt-6 text-lg md:text-xl text-violet-100/80 leading-relaxed max-w-lg">
                Controle de estoque, impressão de etiquetas e gestão financeira em um único lugar. O sistema perfeito para sua boutique ou loja. <span class="text-violet-400 font-bold block mt-2">Apenas R$ 29,90/mês.</span>
            </p>
            <div class="mt-10 flex flex-col sm:flex-row gap-4">
                <a href="/app/register" class="inline-flex justify-center items-center rounded-xl bg-violet-600 text-white font-bold px-8 py-4 shadow-lg shadow-violet-600/30 hover:bg-violet-700 hover:-translate-y-1 transition transform duration-200">
                    Teste grátis por 7 dias
                    <i class="fa-solid fa-arrow-right ml-2"></i>
                </a>
                <a href="#como-funciona" class="inline-flex justify-center items-center rounded-xl border border-white/30 text-white font-semibold px-8 py-4 hover:bg-white/10 transition backdrop-blur-sm">
                    <i class="fa-solid fa-play mr-2"></i>
                    Como Funciona
                </a>
            </div>
            <div class="mt-10 pt-8 border-t border-violet-800/30">
                <p class="text-sm text-violet-200/60 mb-4">Ideal para:</p>
                <div class="flex flex-wrap gap-3 text-sm font-medium text-white">
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Lojas de Roupas</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Boutiques</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Moda Íntima</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Calçados</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Acessórios</span>
                </div>
            </div>
        </div>
        <div class="relative">
            <div class="absolute -inset-4 bg-gradient-to-r from-violet-500 to-fuchsia-500 rounded-full blur-3xl opacity-20 animate-pulse"></div>
            <div class="bg-violet-900/40 border border-violet-700/50 rounded-3xl p-8 backdrop-blur-md shadow-2xl relative">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <p class="text-sm uppercase text-violet-200/70 font-semibold tracking-wider">Vendas Hoje</p>
                        <p class="text-3xl font-bold mt-1 text-white">R$ 3.850,00</p>
                        <div class="flex items-center gap-2 mt-2">
                            <span class="text-xs font-bold text-violet-300 bg-violet-500/20 px-2 py-0.5 rounded">32 vendas</span>
                        </div>
                    </div>
                    <div class="h-12 w-12 rounded-full bg-violet-500/20 flex items-center justify-center border border-violet-400/30">
                        <i class="fa-solid fa-shirt text-violet-300 text-xl"></i>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="bg-violet-800/40 rounded-xl p-4 border border-violet-700/50">
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-xs text-violet-200">Peças em Estoque</p>
                            <span class="text-sm font-bold text-violet-300">1.240 Unid.</span>
                        </div>
                         <div class="h-2 bg-violet-950 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-violet-400 to-fuchsia-400 w-[60%] rounded-full"></div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-violet-800/40 rounded-xl p-4 border border-violet-700/50">
                            <p class="text-xs text-violet-200">Lucro do Dia</p>
                            <p class="text-2xl font-bold mt-1 text-white">R$ 1.2k</p>
                        </div>
                        <div class="bg-violet-800/40 rounded-xl p-4 border border-violet-700/50">
                            <p class="text-xs text-violet-200">Ticket Médio</p>
                            <p class="text-2xl font-bold mt-1 text-white">R$ 180</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pain vs Gain -->
<x-site.comparison
    :subtitle="'Não perca o controle'"
    :title="'Seu estoque está uma bagunça?'"
    :description="'Peças paradas, furos de estoque e dinheiro perdido. Resolva isso agora:'"
    :painTitle="'Loja Desorganizada'"
    :painItems="[
        'Não sabe quantas peças tem no estoque',
        'Vende o que não tem e frustra o cliente',
        'Caderninho de fiado difícil de cobrar',
        'Não sabe qual coleção dá mais lucro'
    ]"
    :gainTitle="'Gestão de Moda'"
    :gainItems="[
        'Estoque atualizado em tempo real',
        'Alerta de produtos acabando',
        'Controle de crediário organizado',
        'Relatórios de peças mais vendidas'
    ]"
    :gainCardBg="'bg-violet-900'"
    :gainCardBorder="'border-violet-800'"
    :gainTitleColor="'text-violet-300'"
    :gainCheckColor="'text-violet-400'"
    :gainBadgeBg="'bg-violet-600'"
/>

<!-- How it Works -->
<section id="como-funciona" class="py-24 bg-violet-50/30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-20">
            <p class="text-sm font-semibold text-violet-600 uppercase tracking-[0.3em]">Passo a Passo</p>
            <h2 class="mt-4 text-3xl md:text-4xl font-bold text-slate-900">Como funciona o Sistema para Loja</h2>
            <p class="mt-4 text-lg text-slate-600">Simples, visual e rápido. Feito para você vender mais.</p>
        </div>

        <div class="space-y-24">
             <!-- Step 1 -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-violet-200 group">
                        <div class="absolute inset-0 bg-violet-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="{{ asset('images/sistema/estoque/produtos.png') }}" alt="Cadastro de Produtos" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-violet-100 text-violet-700 font-bold text-xl">1</span>
                        <h3 class="text-2xl font-bold text-slate-900">Cadastre suas Peças</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Registre suas roupas com fotos, preços, custos e categorias.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-violet-500"></i>
                            <span>Organize por coleção e marca</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-violet-500"></i>
                            <span>Defina preço de custo e venda</span>
                        </li>
                         <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-violet-500"></i>
                            <span>Acompanhe a margem de lucro</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-1">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-violet-100 text-violet-700 font-bold text-xl">2</span>
                        <h3 class="text-2xl font-bold text-slate-900">Venda no Balcão ou Celular</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Realize vendas de forma ágil, selecione o cliente e a forma de pagamento.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-violet-500"></i>
                            <span>Venda em poucos cliques</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-violet-500"></i>
                            <span>Controle de fiado/crediário</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-violet-500"></i>
                            <span>Envio de comprovante no WhatsApp</span>
                        </li>
                    </ul>
                </div>
                <div class="order-2">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-violet-200 group">
                        <div class="absolute inset-0 bg-violet-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="/images/crm/dashboard-preview.png" alt="Vendas" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-16 text-center">
            <a href="/app/register" class="inline-flex items-center gap-3 bg-violet-600 hover:bg-violet-700 text-white font-bold px-8 py-4 rounded-xl shadow-lg shadow-violet-500/20 hover:shadow-violet-500/40 transform hover:-translate-y-0.5 transition-all duration-300">
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
            <p class="text-sm font-semibold text-violet-600 uppercase tracking-[0.3em]">Vantagens</p>
            <h2 class="mt-4 text-3xl md:text-4xl font-bold">Gerencie sua Loja</h2>
        </div>
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            <article class="group rounded-2xl border border-slate-100 bg-violet-50/20 p-6 shadow-sm hover:shadow-lg hover:border-violet-200 transition-all duration-300">
                <div class="w-12 h-12 bg-violet-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-violet-600 transition-colors duration-300">
                    <i class="fa-solid fa-tags text-violet-600 group-hover:text-white text-xl transition-colors duration-300"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Etiquetas e Estoque</h3>
                <p class="text-sm text-slate-600 leading-relaxed">Gere etiquetas de código de barras e controle seu estoque por grade de cor e tamanho.</p>
            </article>
            <article class="group rounded-2xl border border-slate-100 bg-violet-50/20 p-6 shadow-sm hover:shadow-lg hover:border-fuchsia-200 transition-all duration-300">
                <div class="w-12 h-12 bg-fuchsia-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-fuchsia-600 transition-colors duration-300">
                    <i class="fa-solid fa-cash-register text-fuchsia-600 group-hover:text-white text-xl transition-colors duration-300"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Frente de Caixa</h3>
                <p class="text-sm text-slate-600 leading-relaxed">Vendas rápidas e intuitivas. Aceite cartão, dinheiro e PIX.</p>
            </article>
            <article class="group rounded-2xl border border-slate-100 bg-violet-50/20 p-6 shadow-sm hover:shadow-lg hover:border-purple-200 transition-all duration-300">
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-purple-600 transition-colors duration-300">
                    <i class="fa-solid fa-address-book text-purple-600 group-hover:text-white text-xl transition-colors duration-300"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Gestão de Clientes</h3>
                <p class="text-sm text-slate-600 leading-relaxed">Mantenha o histórico de compras e controle o conta-corrente (fiado).</p>
            </article>
        </div>
    </div>
</section>

<!-- CTA Section -->
<x-site.cta-final
    :title="'A solução completa para sua Loja de Roupas'"
    :description="'Comece agora com 7 dias de teste grátis. Aumente suas vendas por apenas <span class=\'text-violet-300 font-bold\'>R$ 29,90/mês</span>.'"
    :footer="'Junte-se a lojistas de sucesso'"
    :gradient="'bg-gradient-to-br from-violet-950 to-violet-700'"
    :textColor="'text-violet-50'"
    :highlightColor="'text-violet-300'"
    :buttonColor="'bg-violet-500 shadow-violet-500/30 hover:bg-violet-600'"
    :priceUrl="false"
/>

<!-- FAQ -->
<section id="faq" class="py-20 bg-violet-50/20">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <p class="text-sm font-semibold text-violet-600 uppercase tracking-[0.3em]">Dúvidas</p>
            <h2 class="mt-4 text-3xl font-bold">Perguntas Frequentes</h2>
        </div>
        <div class="space-y-4">
             <details class="group rounded-2xl border border-slate-100 bg-white p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    O sistema emite etiquetas de código de barras?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">O sistema gera códigos de barras para seus produtos, facilitando a venda e o controle de estoque.</p>
            </details>
            <details class="group rounded-2xl border border-slate-100 bg-white p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    Consigo controlar o estoque por categoria?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Sim! Organize suas roupas por coleção, tipo, marca e estação. Saiba exatamente o que vende mais.</p>
            </details>
            <details class="group rounded-2xl border border-slate-100 bg-white p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    Posso vender no crediário?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Sim, você pode registrar vendas a prazo (fiado/crediário) e controlar os recebimentos futuros de cada cliente.</p>
            </details>
        </div>
    </div>
</section>

</x-site-layout>
