@php
$structuredData = [
    [
        '@context' => 'https://schema.org',
        '@type' => 'SoftwareApplication',
        'name' => 'WSoft - Sistema de Gestão de Estoque',
        'url' => 'https://www.wsoft.dev.br/sistema-para-gestao-de-estoque',
        'description' => 'Sistema completo para controle de estoque e produtos. Evite perdas, controle validade, faça inventário e tenha total gestão do seu almoxarifado.',
        'operatingSystem' => 'Web',
        'applicationCategory' => 'BusinessApplication',
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
            'ratingCount' => '156'
        ]
    ],
    [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => [
            [
                '@type' => 'Question',
                'name' => 'O que é um sistema de controle de estoque?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Um sistema de controle de estoque é uma ferramenta para registrar, fiscalizar e gerir a entrada e saída de mercadorias. Ele ajuda a evitar perdas, roubos e falta de produtos.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'Como evitar perdas no estoque?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Com o WSoft, você controla a validade dos produtos, define estoque mínimo e máximo e registra todas as movimentações. Isso reduz drasticamente perdas e desperdícios.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'O sistema faz controle de validade?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Sim! O sistema alerta sobre produtos próximos ao vencimento para que você possa fazer promoções e evitar prejuízos.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'Posso usar leitor de código de barras?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Sim! O WSoft é compatível com leitores de código de barras para agilizar as vendas e a conferência de estoque.'
                ]
            ]
        ]
    ],
    [
        '@context' => 'https://schema.org',
        '@type' => 'HowTo',
        'name' => 'Como fazer Controle de Estoque com WSoft',
        'description' => 'Guia prático para cadastrar produtos, movimentar estoque e analisar resultados.',
        'step' => [
            [
                '@type' => 'HowToStep',
                'name' => 'Cadastre seus Produtos',
                'text' => 'Registre seus produtos com código de barras, preço de custo, preço de venda, estoque mínimo e validade.',
                'position' => 1
            ],
            [
                '@type' => 'HowToStep',
                'name' => 'Movimente o Estoque',
                'text' => 'As vendas dão baixa automática no estoque. As compras alimentam o estoque. Tudo integrado e automático.',
                'position' => 2
            ],
            [
                '@type' => 'HowToStep',
                'name' => 'Acompanhe os Resultados',
                'text' => 'Veja quais produtos vendem mais (Curva ABC), quais estão parados e qual o lucro real da sua operação.',
                'position' => 3
            ]
        ]
    ]
];
@endphp

<x-site-layout
    :title="'Sistema de Gestão de Estoque | Controle de Produtos | WSoft'"
    :description="'Sistema completo de controle de estoque e produtos para pequenas empresas. Evite perdas, controle validade e faça inventário fácil. Teste grátis!'"
    :keywords="'sistema de gestão de estoque, controle de estoque, cadastro de produtos, software estoque, controle de validade, inventário, gestão de almoxarifado, sistema de loja, controle de mercadorias'"
    :canonical="'https://www.wsoft.dev.br/sistema-para-gestao-de-estoque'"
    :ogTitle="'Sistema de Gestão de Estoque e Produtos | WSoft'"
    :ogDescription="'Evite perdas e rupturas. Tenha controle total do seu estoque, validade de produtos e inventário com o sistema mais simples do mercado.'"
    :structuredData="$structuredData"
>

<!-- Hero -->
<section id="hero" class="pt-32 pb-24 bg-gradient-to-b from-blue-950 via-blue-900 to-blue-800 text-white overflow-hidden relative">
    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 30px 30px;"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-16 items-center relative z-10">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-800/50 border border-blue-700 text-blue-200 text-xs font-semibold uppercase tracking-wider mb-6">
                <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                Sistema de Controle de Estoque
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold leading-tight tracking-tight">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-200 to-white">Controle de Estoque</span> para Pequenas Empresas
            </h1>
            <p class="mt-6 text-lg md:text-xl text-emerald-100 leading-relaxed max-w-lg">
                O sistema completo para você gerenciar seu estoque, controlar a validade dos produtos e evitar perdas.
            </p>
            <div class="mt-10 flex flex-col sm:flex-row gap-4">
                <a href="/app/register" class="inline-flex justify-center items-center rounded-xl bg-white text-emerald-700 font-bold px-8 py-4 shadow-lg shadow-white/30 hover:bg-emerald-50 hover:-translate-y-1 transition transform duration-200">
                    Teste grátis por 7 dias
                    <i class="fa-solid fa-arrow-right ml-2"></i>
                </a>
                <a href="#como-funciona" class="inline-flex justify-center items-center rounded-xl border border-white/30 text-white font-semibold px-8 py-4 hover:bg-white/10 transition backdrop-blur-sm">
                    <i class="fa-solid fa-play mr-2"></i>
                    Como Funciona
                </a>
            </div>
            <div class="mt-10 pt-8 border-t border-white/10">
                <p class="text-sm text-emerald-200 mb-4">Perfeito para:</p>
                <div class="flex flex-wrap gap-3 text-sm font-medium text-white">
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Lojas de Roupas</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Mercadinhos</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Autopeças</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Cosméticos</span>
                </div>
            </div>
        </div>
        <div class="relative">
            <div class="absolute -inset-4 bg-gradient-to-r from-emerald-500 to-cyan-500 rounded-full blur-3xl opacity-20 animate-pulse"></div>
            <div class="bg-white/10 border border-white/20 rounded-3xl p-8 backdrop-blur-md shadow-2xl relative">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <p class="text-sm uppercase text-emerald-200 font-semibold tracking-wider">Total em Estoque</p>
                        <h3 class="text-3xl font-bold mt-1">3.450 Itens</h3>
                        <div class="flex items-center gap-2 mt-2">
                            <span class="text-xs font-bold text-green-400 bg-green-400/10 px-2 py-0.5 rounded">Valor: R$ 125.400,00</span>
                        </div>
                    </div>
                    <div class="h-12 w-12 rounded-full bg-emerald-500/20 flex items-center justify-center border border-emerald-400/30">
                        <i class="fa-solid fa-boxes-stacked text-emerald-300 text-xl"></i>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-xs text-emerald-200">Giro de Estoque</p>
                            <span class="text-sm font-bold text-emerald-300">Alta Rotatividade</span>
                        </div>
                        <div class="h-2 bg-emerald-950/50 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-emerald-400 to-cyan-400 w-[88%] rounded-full"></div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                            <p class="text-xs text-emerald-200">Estoque Baixo</p>
                            <p class="text-2xl font-bold mt-1 text-yellow-400">15</p>
                        </div>
                        <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                            <p class="text-xs text-emerald-200">Vencendo</p>
                            <p class="text-2xl font-bold mt-1 text-red-400">3</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pain vs Gain -->
<x-site.comparison
    :subtitle="'O problema da desorganização'"
    :title="'Seu dinheiro está parado no estoque?'"
    :description="'Lojas sem um <strong>sistema de controle de estoque</strong> perdem vendas e dinheiro. Veja a diferença:'"
    :painTitle="'Estoque Furado'"
    :painItems="[
        'Produtos vencem na prateleira',
        'Perde vendas por falta de mercadoria',
        'Não sabe o valor total do estoque',
        'Furtos e desvios passam despercebidos'
    ]"
    :gainTitle="'Estoque Controlado'"
    :gainItems="[
        'Controle rigoroso de validade',
        'Alerta de estoque mínimo para reposição',
        'Inventário rápido e preciso',
        'Relatórios de giro e lucratividade'
    ]"
    :gainCardBg="'bg-emerald-900'"
    :gainCardBorder="'border-emerald-800'"
    :gainTitleColor="'text-emerald-400'"
    :gainCheckColor="'text-emerald-400'"
    :gainBadgeBg="'bg-emerald-500'"
/>

<!-- How it Works (New Section) -->
<section id="como-funciona" class="py-24 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-20">
            <p class="text-sm font-semibold text-emerald-600 uppercase tracking-[0.3em]">Passo a Passo</p>
            <h2 class="mt-4 text-3xl md:text-4xl font-bold text-slate-900">Como funciona o Controle de Estoque</h2>
            <p class="mt-4 text-lg text-slate-600">Mantenha seu estoque em dia sem dor de cabeça.</p>
        </div>

        <div class="space-y-24">
            <!-- Step 1 -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 group">
                        <div class="absolute inset-0 bg-emerald-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="/images/crm/registration.png" alt="Tela de Cadastro de Produtos" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-emerald-100 text-emerald-700 font-bold text-xl">1</span>
                        <h3 class="text-2xl font-bold text-slate-900">Cadastre seus Produtos</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Registre seus produtos com código de barras, preço de custo, preço de venda, estoque mínimo e validade.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Cadastro com foto e categoria</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Importação de XML de notas fiscais</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-1">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-emerald-100 text-emerald-700 font-bold text-xl">2</span>
                        <h3 class="text-2xl font-bold text-slate-900">Movimente o Estoque</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        As vendas dão baixa automática no estoque. As compras alimentam o estoque. Tudo integrado e automático.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Baixa automática na venda</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Ajustes manuais e inventário</span>
                        </li>
                    </ul>
                </div>
                <div class="order-2">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 group">
                        <div class="absolute inset-0 bg-emerald-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="/images/crm/history.png" alt="Movimentação de Estoque" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 group">
                        <div class="absolute inset-0 bg-emerald-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="/images/crm/reports.png" alt="Relatórios de Estoque" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-emerald-100 text-emerald-700 font-bold text-xl">3</span>
                        <h3 class="text-2xl font-bold text-slate-900">Acompanhe os Resultados</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Veja quais produtos vendem mais (Curva ABC), quais estão parados e qual o lucro real da sua operação.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Relatório de Curva ABC</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Lucratividade por produto</span>
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
            <h2 class="mt-4 text-3xl md:text-4xl font-bold">Por que controlar o estoque?</h2>
            <p class="mt-4 text-lg text-slate-600">Estoque parado é dinheiro perdido</p>
        </div>
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-arrow-trend-up text-emerald-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Aumente o Giro</h3>
                    <p class="mt-3 text-slate-600">Identifique o que vende e o que encalha. Faça promoções certas e compre melhor.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-barcode text-blue-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Agilidade no Caixa</h3>
                    <p class="mt-3 text-slate-600">Use leitor de código de barras para vender rápido e sem erros de preço.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-triangle-exclamation text-purple-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Sem Prejuízos</h3>
                    <p class="mt-3 text-slate-600">Controle de validade e perdas. Saiba exatamente para onde vai cada item.</p>
                </div>
            </article>
        </div>
    </div>
</section>

<!-- CTA Section -->
<x-site.cta-final
    :title="'Escolha um sistema completo para controle de estoque'"
    :description="'Comece agora com 7 dias de teste grátis. Use o melhor <strong>sistema para gestão de estoque e vendas</strong> por apenas <span class=\'text-yellow-300 font-bold\'>R$ 29,90/mês</span>.'"
    :footer="'Junte-se a centenas de lojas e varejos que usam WSoft'"
    :gradient="'bg-gradient-to-br from-emerald-600 to-blue-600'"
    :textColor="'text-emerald-50'"
    :highlightColor="'text-yellow-300'"
/>


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
                    O sistema imprime etiquetas?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Sim! Você pode gerar e imprimir etiquetas de código de barras para seus produtos diretamente do sistema.</p>
            </details>
            <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    Funciona para grade de cores e tamanhos?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Sim! O WSoft permite cadastrar produtos com variações de cor, tamanho ou voltagem (grade).</p>
            </details>
        </div>
    </div>
</section>

</x-site-layout>
