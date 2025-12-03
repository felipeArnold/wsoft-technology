@php
$structuredData = [
    [
        '@context' => 'https://schema.org',
        '@type' => 'SoftwareApplication',
        'name' => 'WSoft Tecnologia',
        'url' => 'https://www.wsoft.dev.br/',
        'description' => 'Sistema de gestão online com financeiro, contas a pagar e receber, ordem de serviço, controle de estoque e assinatura digital.',
        'operatingSystem' => 'Web',
        'applicationCategory' => 'BusinessApplication',
        'offers' => [
            '@type' => 'Offer',
            'price' => '29.90',
            'priceCurrency' => 'BRL',
            'url' => 'https://www.wsoft.dev.br/app/register',
            'description' => 'Teste grátis por 7 dias'
        ],
        'aggregateRating' => [
            '@type' => 'AggregateRating',
            'ratingValue' => '4.8',
            'ratingCount' => '124'
        ]
    ],
    [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => [
            [
                '@type' => 'Question',
                'name' => 'Como o WSoft ajuda no controle financeiro diário?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'O painel unifica entradas, saídas, projeções e limites para que você acompanhe o sistema de fluxo de caixa em tempo real.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'Posso controlar ordens de serviço e estoque?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Sim, o sistema de ordem de serviço integra peças, mão de obra e controle de produtos para evitar erros e retrabalhos.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'Há recursos de contas a pagar e receber automáticos?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Alertas, conciliações e integrações bancárias reduzem esquecimentos e mantêm o financeiro organizado.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'O que muda para quem precisa de controle de inadimplência?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Você segmenta devedores, dispara lembretes e acompanha negociações diretamente do painel.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'Preciso de equipe grande para usar o sistema?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Não. O layout foi desenhado para pequenas empresas que querem profissionalizar processos sem burocracia.'
                ]
            ]
        ]
    ]
];
@endphp

<x-site-layout
    :title="'Sistema de Gestão Financeira para Pequenas Empresas | WSoft'"
    :description="'WSoft - Sistema de gestão financeira simples para pequenas empresas e MEI. Controle contas a pagar, receber, estoque, OS e emita notas fiscais. Teste grátis!'"
    :keywords="'sistema de gestão financeira, pequenas empresas, MEI, controle financeiro, ordem de serviço, emissão de notas, WSoft'"
    :canonical="'https://www.wsoft.dev.br/'"
    :ogTitle="'Sistema de Gestão Financeira para Pequenas Empresas | WSoft'"
    :ogDescription="'Controle financeiro, ordem de serviço, vendas, estoque e assinatura digital em um único sistema simples e eficiente. Teste grátis por 7 dias.'"
    :twitterTitle="'WSoft - Sistema de Gestão Online'"
    :twitterDescription="'Sistema de gestão com financeiro, OS, vendas e assinatura digital. Ideal para mecânicas e pequenas empresas.'"
    :structuredData="$structuredData"
>

    <!-- Hero -->
    <section id="hero" class="pt-32 pb-24 bg-gradient-to-b from-blue-950 via-blue-900 to-blue-800 text-white overflow-hidden relative">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 30px 30px;"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-16 items-center relative z-10">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-800/50 border border-blue-700 text-blue-200 text-xs font-semibold uppercase tracking-wider mb-6">
                    <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                    Sistema Online para Pequenas Empresas
                </div>
                <h1 class="text-4xl md:text-6xl font-extrabold leading-tight tracking-tight">
                    Gestão Financeira <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-200 to-white">Simples</span> para o seu Negócio
                </h1>
                <p class="mt-6 text-lg md:text-xl text-blue-100 leading-relaxed max-w-lg">
                    Abandone as planilhas complicadas. Centralize financeiro, vendas, estoque e OS em uma plataforma feita para quem quer crescer de verdade.
                </p>
                <div class="mt-10 flex flex-col sm:flex-row gap-4">
                    <a href="https://bit.ly/3MDiwix" target="_blank" class="inline-flex justify-center items-center rounded-xl bg-green-500 text-white font-bold px-8 py-4 shadow-lg shadow-green-500/30 hover:bg-green-600 hover:-translate-y-1 transition transform duration-200">
                        Teste Grátis 7 Dias
                        <i class="fa-solid fa-arrow-right ml-2"></i>
                    </a>
                    <a href="#demo" class="inline-flex justify-center items-center rounded-xl border border-white/30 text-white font-semibold px-8 py-4 hover:bg-white/10 transition backdrop-blur-sm">
                        <i class="fa-solid fa-play mr-2"></i>
                        Ver Demonstração
                    </a>
                </div>
                <div class="mt-10 pt-8 border-t border-white/10">
                    <p class="text-sm text-blue-200 mb-4">Ideal para:</p>
                    <div class="flex flex-wrap gap-3 text-sm font-medium text-white">
                        <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">MEI e Autônomos</span>
                        <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Pequenas Oficinas</span>
                        <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Comércio e Varejo</span>
                        <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Prestadores de Serviço</span>
                        <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Lojas de Manutenção</span>
                        <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">E muito mais...</span>
                    </div>
                </div>
            </div>
            <div class="relative">
                <div class="absolute -inset-4 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-full blur-3xl opacity-20 animate-pulse"></div>
                <div class="bg-white/10 border border-white/20 rounded-3xl p-8 backdrop-blur-md shadow-2xl relative">
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <p class="text-sm uppercase text-blue-200 font-semibold tracking-wider">Faturamento Mensal</p>
                            <h3 class="text-3xl font-bold mt-1">R$ 124.890,00</h3>
                            <div class="flex items-center gap-2 mt-2">
                                <span class="text-xs font-bold text-green-400 bg-green-400/10 px-2 py-0.5 rounded">+15% vs mês anterior</span>
                            </div>
                        </div>
                        <div class="h-12 w-12 rounded-full bg-blue-500/20 flex items-center justify-center border border-blue-400/30">
                            <i class="fa-solid fa-wallet text-blue-300 text-xl"></i>
                        </div>
                    </div>
                    <div class="space-y-6">
                        <div class="space-y-2">
                            <div class="flex justify-between text-sm">
                                <span class="text-blue-100">Meta de Vendas</span>
                                <span class="font-semibold">85%</span>
                            </div>
                            <div class="h-2 bg-blue-950/50 rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-blue-400 to-cyan-400 w-[85%] rounded-full"></div>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                                <p class="text-xs text-blue-200">A Receber</p>
                                <p class="text-lg font-bold mt-1">R$ 12.450</p>
                            </div>
                            <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                                <p class="text-xs text-blue-200">A Pagar</p>
                                <p class="text-lg font-bold mt-1 text-rose-300">R$ 4.320</p>
                            </div>
                        </div>
                        <div class="pt-4 border-t border-white/10 flex items-center gap-4">
                            <div class="flex -space-x-3">
                                <div class="w-8 h-8 rounded-full bg-blue-400 border-2 border-blue-900"></div>
                                <div class="w-8 h-8 rounded-full bg-cyan-400 border-2 border-blue-900"></div>
                                <div class="w-8 h-8 rounded-full bg-indigo-400 border-2 border-blue-900"></div>
                            </div>
                            <p class="text-xs text-blue-200">Equipe conectada agora</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sales Focus (Pain vs Gain) -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-red-600 font-bold tracking-wider uppercase text-sm">Pare de perder dinheiro</span>
                <h2 class="mt-2 text-3xl md:text-4xl font-extrabold text-slate-900">Sua empresa está sangrando e você nem percebe</h2>
                <p class="mt-4 text-lg text-slate-600">A falta de gestão profissional é o principal motivo de quebra de pequenas empresas no Brasil. Em qual cenário você está hoje?</p>
            </div>
            <div class="grid md:grid-cols-2 gap-8">
                <!-- Pain -->
                <div class="p-8 rounded-3xl bg-red-50 border border-red-100 relative overflow-hidden group hover:shadow-lg transition">
                    <div class="absolute top-0 right-0 bg-red-100 text-red-600 text-xs font-bold px-3 py-1 rounded-bl-xl">CENÁRIO ATUAL</div>
                    <h3 class="text-xl font-bold text-red-700 mb-6 flex items-center gap-2">
                        <i class="fa-solid fa-circle-xmark"></i> Sem WSoft
                    </h3>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3 text-slate-700">
                            <i class="fa-solid fa-xmark text-red-500 mt-1"></i>
                            <span>Não sabe quanto lucrou no fim do mês</span>
                        </li>
                        <li class="flex items-start gap-3 text-slate-700">
                            <i class="fa-solid fa-xmark text-red-500 mt-1"></i>
                            <span>Esquece de cobrar clientes (inadimplência alta)</span>
                        </li>
                        <li class="flex items-start gap-3 text-slate-700">
                            <i class="fa-solid fa-xmark text-red-500 mt-1"></i>
                            <span>Estoque furado e prejuízo com mercadoria parada</span>
                        </li>
                        <li class="flex items-start gap-3 text-slate-700">
                            <i class="fa-solid fa-xmark text-red-500 mt-1"></i>
                            <span>Perde horas em planilhas que não funcionam</span>
                        </li>
                    </ul>
                </div>
                <!-- Gain -->
                <div class="p-8 rounded-3xl bg-green-50 border border-green-100 relative overflow-hidden shadow-md group hover:shadow-xl transition transform hover:-translate-y-1">
                    <div class="absolute top-0 right-0 bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-bl-xl">CENÁRIO DESEJADO</div>
                    <h3 class="text-xl font-bold text-green-700 mb-6 flex items-center gap-2">
                        <i class="fa-solid fa-circle-check"></i> Com WSoft
                    </h3>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-green-600 mt-1"></i>
                            <span>Lucro real na tela em tempo real</span>
                        </li>
                        <li class="flex items-start gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-green-600 mt-1"></i>
                            <span>Cobranças automáticas (receba enquanto dorme)</span>
                        </li>
                        <li class="flex items-start gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-green-600 mt-1"></i>
                            <span>Estoque controlado e compras inteligentes</span>
                        </li>
                        <li class="flex items-start gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-green-600 mt-1"></i>
                            <span>Mais tempo livre para vender e crescer</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="flex align-center justify-center mt-12">
                <a href="https://bit.ly/3MDiwix" target="_blank" class="inline-flex justify-center items-center rounded-xl bg-green-500 text-white font-bold px-8 py-4 shadow-lg shadow-green-500/30 hover:bg-green-600 hover:-translate-y-1 transition transform duration-200">
                    Comece seu teste grátis agora
                    <i class="fa-solid fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Benefícios principais -->
    <section id="beneficios" class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto">
                <p class="text-sm font-semibold text-blue-600 uppercase tracking-[0.3em]">Benefícios principais</p>
                <h2 class="mt-4 text-3xl md:text-4xl font-bold">Controle total com linguagem simples e persuasiva</h2>
                <p class="mt-4 text-slate-600">Tudo o que sua empresa precisa para organizar processos, reduzir custos e aumentar receita.</p>
            </div>
            <div class="grid gap-12 md:grid-cols-2 mt-4">
                <article class="flex gap-6">
                    <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                        <i class="fa-solid fa-chart-line text-blue-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold">Gestão Financeira Completa</h3>
                        <p class="mt-3 text-slate-600">Centralize entradas, saídas, projeções e limites em um único painel. Acompanhe o fluxo de caixa em tempo real e tome decisões baseadas em dados concretos.</p>
                    </div>
                </article>
                <article class="flex gap-6">
                    <div class="flex-shrink-0 w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                        <i class="fa-solid fa-users text-green-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold">Cadastro de Clientes e Fornecedores</h3>
                        <p class="mt-3 text-slate-600">Mantenha todos os dados organizados com tags, anotações e histórico completo. Nunca mais perca informações importantes sobre seus contatos.</p>
                    </div>
                </article>
                <article class="flex gap-6">
                    <div class="flex-shrink-0 w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                        <i class="fa-solid fa-file-invoice text-purple-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold">Contas a Pagar e Receber</h3>
                        <p class="mt-3 text-slate-600">Automatize cobranças e acompanhe prazos com alertas inteligentes. Mantenha o caixa previsível e evite surpresas desagradáveis.</p>
                    </div>
                </article>
                <article class="flex gap-6">
                    <div class="flex-shrink-0 w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                        <i class="fa-solid fa-clipboard-list text-orange-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold">Sistema de Ordem de Serviço</h3>
                        <p class="mt-3 text-slate-600">Crie, aprove e monitore cada OS com fotos, checklist e notificações. Workflow completo do orçamento ao faturamento.</p>
                    </div>
                </article>
                <article class="flex gap-6">
                    <div class="flex-shrink-0 w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                        <i class="fa-solid fa-triangle-exclamation text-red-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold">Redução de Inadimplência</h3>
                        <p class="mt-3 text-slate-600">Configure régua automática com lembretes por e-mail e WhatsApp. Segmente devedores e acompanhe negociações diretamente do painel.</p>
                    </div>
                </article>
                <article class="flex gap-6">
                    <div class="flex-shrink-0 w-12 h-12 bg-teal-100 rounded-xl flex items-center justify-center">
                        <i class="fa-solid fa-box text-teal-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold">Controle de Produtos, Estoque e Vendas</h3>
                        <p class="mt-3 text-slate-600">Gerencie estoque com lote, alertas de mínimo e preços atualizados, além de integrar vendas diretamente com ordens de serviço.</p>
                    </div>
                </article>
                <article class="flex gap-6">
                    <div class="flex-shrink-0 w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center">
                        <i class="fa-solid fa-gauge-high text-indigo-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold">Dashboard Inteligente</h3>
                        <p class="mt-3 text-slate-600">Indicadores visuais sobre faturamento, inadimplência e performance comercial. Visualize o que importa em um único lugar.</p>
                    </div>
                </article>
                <article class="flex gap-6">
                    <div class="flex-shrink-0 w-12 h-12 bg-pink-100 rounded-xl flex items-center justify-center">
                        <i class="fa-solid fa-signature text-pink-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold">Assinatura Digital Integrada</h3>
                        <p class="mt-3 text-slate-600">Envie contratos e documentos para assinatura digital diretamente pelo sistema, garantindo segurança jurídica e agilidade nos processos.</p>
                    </div>
                </article>
                <article class="flex gap-6">
                    <div class="flex-shrink-0 w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center">
                        <i class="fa-solid fa-headset text-yellow-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold">Suporte Humanizado</h3>
                        <p class="mt-3 text-slate-600">Equipe especializada em pequenos negócios pronta para ajudar. Implantação em dias, não em meses.</p>
                    </div>
                </article>
            </div>

            <div class="flex align-center justify-center mt-12">
                <a href="https://bit.ly/3MDiwix" target="_blank" class="inline-flex justify-center items-center rounded-xl bg-blue-500 text-white font-bold px-8 py-4 shadow-lg shadow-blue-500/30 hover:bg-blue-600 hover:-translate-y-1 transition transform duration-200">
                    Experimente grátis por 7 dias
                    <i class="fa-solid fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <section id="beneficios" class="mt-8 bg-gradient-to-b from-slate-50  bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900">Benefícios que geram resultado</h2>
                <p class="mt-4 text-lg text-slate-600 max-w-2xl mx-auto">Transforme a gestão do seu negócio com ferramentas que realmente fazem a diferença</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="group p-8 bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 border border-slate-100 hover:border-blue-200">
                    <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center mb-6 group-hover:bg-blue-600 transition-colors duration-300">
                        <svg aria-hidden="true" class="w-7 h-7 text-blue-600 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Reduza inadimplência</h3>
                    <p class="text-slate-600 leading-relaxed">Automatize cobranças por WhatsApp e e-mail e transforme sua recuperação de recebíveis.</p>
                </div>
                <div class="group p-8 bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 border border-slate-100 hover:border-blue-200">
                    <div class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center mb-6 group-hover:bg-green-600 transition-colors duration-300">
                        <svg aria-hidden="true" class="w-7 h-7 text-green-600 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Acelere o fluxo de trabalho</h3>
                    <p class="text-slate-600 leading-relaxed">Menos retrabalho com processos centralizados e integrados — aumente a produtividade da equipe.</p>
                </div>
                <div class="group p-8 bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 border border-slate-100 hover:border-blue-200">
                    <div class="w-14 h-14 bg-purple-100 rounded-xl flex items-center justify-center mb-6 group-hover:bg-purple-600 transition-colors duration-300">
                        <svg aria-hidden="true" class="w-7 h-7 text-purple-600 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Decisões baseadas em dados</h3>
                    <p class="text-slate-600 leading-relaxed">Relatórios e dashboards para tomada de decisão rápida e segura.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Por que WSoft -->
    <section id="porque" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-12 items-center">
            <div>
                <p class="text-sm font-semibold text-blue-600 uppercase tracking-[0.3em]">Por que o WSoft Tecnologia?</p>
                <h2 class="mt-4 text-3xl font-bold">Um ERP simples, rápido e pensado para o dia a dia</h2>
                <p class="mt-4 text-slate-600">
                    O WSoft nasceu para ser um ERP simples, intuitivo e pronto para acelerar oficinas, mecânicas, lojas de serviços e qualquer sistema para microempresa que precise profissionalizar a operação.
                </p>
                <p class="mt-4 text-slate-600">
                    Com processos guiados e dashboards objetivos, você garante organização empresarial, previsibilidade e mais tempo para vender.
                </p>
                <ul class="mt-6 space-y-3 text-slate-800">
                    <li class="flex items-start gap-3"><i class="fa-solid fa-circle-check text-green-500 mt-1"></i> Implantação em dias, não em meses.</li>
                    <li class="flex items-start gap-3"><i class="fa-solid fa-circle-check text-green-500 mt-1"></i> Suporte humano especializado em pequenos negócios.</li>
                    <li class="flex items-start gap-3"><i class="fa-solid fa-circle-check text-green-500 mt-1"></i> Treinamentos rápidos para equipes administrativas e técnicas.</li>
                </ul>

                <div class="mt-8">
                    <a href="https://bit.ly/3MDiwix" target="_blank" class="inline-flex justify-center items-center rounded-xl bg-blue-500 text-white font-bold px-8 py-4 shadow-lg shadow-blue-500/30 hover:bg-blue-600 hover:-translate-y-1 transition transform duration-200">
                        Comece seu teste grátis agora
                        <i class="fa-solid fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
            <div class="rounded-3xl bg-gradient-to-br from-blue-100 via-white to-emerald-100 p-8 shadow-xl border border-slate-100">
                <div class="grid grid-cols-2 gap-6 text-center">
                    <div>
                        <p class="text-4xl font-bold text-blue-700">97%</p>
                        <p class="text-xs uppercase tracking-widest text-slate-500 mt-2">Clientes recomendam</p>
                    </div>
                    <div>
                        <p class="text-4xl font-bold text-blue-700">3x</p>
                        <p class="text-xs uppercase tracking-widest text-slate-500 mt-2">Mais produtividade</p>
                    </div>
                    <div>
                        <p class="text-4xl font-bold text-blue-700">15 min</p>
                        <p class="text-xs uppercase tracking-widest text-slate-500 mt-2">OS emitida</p>
                    </div>
                    <div>
                        <p class="text-4xl font-bold text-blue-700">R$ 0</p>
                        <p class="text-xs uppercase tracking-widest text-slate-500 mt-2">Custos ocultos</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Demonstração -->
    <section id="demo" class="py-20 bg-slate-900 text-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-sm uppercase tracking-[0.3em] text-blue-300">Demonstração ao vivo</p>
            <h2 class="mt-4 text-3xl font-bold">Veja o sistema em ação antes de decidir</h2>
            <p class="mt-4 text-blue-100 max-w-3xl mx-auto">
                Mostre para seu time como o software de gestão empresarial simplifica OS, financeiro e relacionamento com clientes em poucos cliques.
            </p>
            <div class="mt-10 rounded-3xl border border-white/20 bg-gradient-to-r from-blue-800 to-blue-600 p-4 md:p-10 shadow-2xl">
                <div class="rounded-2xl border border-white/30 bg-white/5 overflow-hidden shadow-2xl">
                    <img src="{{ asset('images/dashboard-screenshot.png') }}" alt="Dashboard WSoft - Sistema de Gestão" class="w-full h-auto transform hover:scale-105 transition duration-700">
                </div>
            </div>
        </div>
    </section>

    <!-- Funcionalidades detalhadas -->
    <section id="funcionalidades" class="py-20 bg-gradient-to-b from-white to-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <p class="text-sm font-semibold text-blue-600 uppercase tracking-[0.3em]">Funcionalidades detalhadas</p>
                <h2 class="mt-4 text-3xl md:text-4xl font-bold text-slate-900">Tudo o que você precisa para crescer</h2>
                <p class="mt-4 text-lg text-slate-600">Ferramentas completas e integradas para otimizar cada área do seu negócio</p>
            </div>
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
                <a href="{{ route('landing.gestao-clientes') }}" class="group block rounded-2xl border border-slate-100 bg-white p-6 shadow-sm hover:shadow-lg hover:border-blue-200 transition-all duration-300 cursor-pointer">
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-blue-600 transition-colors duration-300">
                        <svg aria-hidden="true" class="w-6 h-6 text-blue-600 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2 group-hover:text-blue-600 transition-colors duration-300">Gestão de Clientes</h3>
                    <p class="text-sm text-slate-600 leading-relaxed mb-3">Sistema de <b>gestão de clientes</b> ideal para empresas que precisam aumentar produtividade e reduzir erros no atendimento.</p>
                    <div class="flex items-center text-blue-600 text-sm font-semibold group-hover:translate-x-1 transition-transform duration-300">
                        <span>Saiba mais</span>
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </a>
                <a href="{{ route('landing.gestao-fornecedores') }}" class="group block rounded-2xl border border-slate-100 bg-white p-6 shadow-sm hover:shadow-lg hover:border-green-200 transition-all duration-300 cursor-pointer">
                    <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-green-600 transition-colors duration-300">
                        <svg aria-hidden="true" class="w-6 h-6 text-green-600 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2 group-hover:text-green-600 transition-colors duration-300">Gestão de Fornecedores</h3>
                    <p class="text-sm text-slate-600 leading-relaxed mb-3">Organize contratos, contatos e documentos com um cadastro de fornecedores seguro e integrado ao financeiro.</p>
                    <div class="flex items-center text-green-600 text-sm font-semibold group-hover:translate-x-1 transition-transform duration-300">
                        <span>Saiba mais</span>
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </a>
                <a href="{{ route('landing.controle-inadimplencia') }}" class="group block rounded-2xl border border-slate-100 bg-white p-6 shadow-sm hover:shadow-lg hover:border-red-200 transition-all duration-300 cursor-pointer">
                    <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-red-600 transition-colors duration-300">
                        <svg aria-hidden="true" class="w-6 h-6 text-red-600 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2 group-hover:text-red-600 transition-colors duration-300">Controle de inadimplência</h3>
                    <p class="text-sm text-slate-600 leading-relaxed mb-3">Reduza perdas financeiras com ferramentas avançadas para <b>controle de inadimplência</b>.</p>
                    <div class="flex items-center text-red-600 text-sm font-semibold group-hover:translate-x-1 transition-transform duration-300">
                        <span>Saiba mais</span>
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </a>
                <a href="{{ route('landing.contas-pagar') }}" class="group block rounded-2xl border border-slate-100 bg-white p-6 shadow-sm hover:shadow-lg hover:border-purple-200 transition-all duration-300 cursor-pointer">
                    <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-purple-600 transition-colors duration-300">
                        <svg aria-hidden="true" class="w-6 h-6 text-purple-600 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2 group-hover:text-purple-600 transition-colors duration-300">Contas a Pagar e Receber</h3>
                    <p class="text-sm text-slate-600 leading-relaxed mb-3">Ganhe visibilidade total do seu <b>fluxo de caixa</b> com um sistema completo de <b>contas a pagar</b>.</p>
                    <div class="flex items-center text-purple-600 text-sm font-semibold group-hover:translate-x-1 transition-transform duration-300">
                        <span>Saiba mais</span>
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </a>
                <a href="{{ route('landing.gestao-estoque') }}" class="group block rounded-2xl border border-slate-100 bg-white p-6 shadow-sm hover:shadow-lg hover:border-amber-200 transition-all duration-300 cursor-pointer">
                    <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-amber-600 transition-colors duration-300">
                        <svg aria-hidden="true" class="w-6 h-6 text-amber-600 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2 group-hover:text-amber-600 transition-colors duration-300">Controle de estoque e Vendas</h3>
                    <p class="text-sm text-slate-600 leading-relaxed mb-3">Gerencie seu estoque com precisão usando um controle de produtos integrado às vendas.</p>
                    <div class="flex items-center text-amber-600 text-sm font-semibold group-hover:translate-x-1 transition-transform duration-300">
                        <span>Saiba mais</span>
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </a>
                <a href="{{ route('landing.movimentacao-financeira') }}" class="group block rounded-2xl border border-slate-100 bg-white p-6 shadow-sm hover:shadow-lg hover:border-cyan-200 transition-all duration-300 cursor-pointer">
                    <div class="w-12 h-12 bg-cyan-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-cyan-600 transition-colors duration-300">
                        <svg aria-hidden="true" class="w-6 h-6 text-cyan-600 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2 group-hover:text-cyan-600 transition-colors duration-300">Movimentação Financeira</h3>
                    <p class="text-sm text-slate-600 leading-relaxed mb-3">Acompanhe toda a movimentação financeira da empresa em painéis simples e intuitivos.</p>
                    <div class="flex items-center text-cyan-600 text-sm font-semibold group-hover:translate-x-1 transition-transform duration-300">
                        <span>Saiba mais</span>
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </a>
                <article class="group rounded-2xl border border-slate-100 bg-white p-6 shadow-sm hover:shadow-lg hover:border-indigo-200 transition-all duration-300">
                    <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-indigo-600 transition-colors duration-300">
                        <svg aria-hidden="true" class="w-6 h-6 text-indigo-600 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Sistema de ordem de serviço</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">Automatize processos e elimine papeladas com um sistema de ordem de serviço online.</p>
                </article>
                <article class="group rounded-2xl border border-slate-100 bg-white p-6 shadow-sm hover:shadow-lg hover:border-emerald-200 transition-all duration-300">
                    <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-emerald-600 transition-colors duration-300">
                        <svg aria-hidden="true" class="w-6 h-6 text-emerald-600 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Assinatura digital</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">Assine contratos e documentos com segurança utilizando assinatura digital integrada ao sistema.</p>
                </article>
            </div>

            <div class="mt-8">
                <a href="https://bit.ly/3MDiwix" target="_blank" class="inline-flex justify-center items-center rounded-xl bg-blue-500 text-white font-bold px-8 py-4 shadow-lg shadow-blue-500/30 hover:bg-blue-600 hover:-translate-y-1 transition transform duration-200">
                    Experimente grátis por 7 dias
                    <i class="fa-solid fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Prova social -->
    <section class="py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto">
                <p class="text-sm font-semibold text-blue-600 uppercase tracking-[0.3em]">Prova social</p>
                <h2 class="mt-4 text-3xl font-bold">O que nossos clientes dizem</h2>
                <p class="mt-4 text-slate-600">Depoimentos reais de quem já transformou a gestão do negócio com o WSoft.</p>
            </div>
            <div class="mt-12 grid gap-6 md:grid-cols-3">
                <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                    <p class="text-sm text-slate-600 italic">"A WSoft transformou nossa rotina. Agora controlamos estoque, financeiro e as OS com muito mais eficiência."</p>
                    <div class="mt-4 font-semibold">Mêcanica Fischer</div>
                    <div class="text-sm text-slate-500">Rolante/RS</div>
                </article>
                <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                    <p class="text-sm text-slate-600 italic">"Redução de inadimplência significativa desde que começamos a usar o sistema."</p>
                    <div class="mt-4 font-semibold">Oficina AutoPlus</div>
                    <div class="text-sm text-slate-500">São Paulo/SP</div>
                </article>
                <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                    <p class="text-sm text-slate-600 italic">"Assinaturas digitais fáceis e com validade jurídica — muito prático."</p>
                    <div class="mt-4 font-semibold">Consulta Fipe</div>
                    <div class="text-sm text-slate-500">Porto Alegre/RS</div>
                </article>
            </div>
        </div>
    </section>

    <!-- Oferta -->
    <section id="oferta" class="py-20 bg-gradient-to-br from-emerald-500 to-blue-600 text-white">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-sm uppercase tracking-[0.3em] text-white/80">Oferta exclusiva</p>
            <h2 class="mt-4 text-3xl font-bold">Sistema sem mensalidade com teste gratuito</h2>
            <p class="mt-4 text-lg text-white/90">
                Assuma o controle do seu negócio com um modelo híbrido: comece com 7 dias de teste, migre para o plano completo e mantenha o WSoft como seu sistema sem mensalidade fixa por licença vitalícia.
            </p>
            <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="/app/register" class="inline-flex justify-center items-center rounded-lg bg-white text-blue-700 font-semibold px-10 py-4 shadow-lg hover:-translate-y-0.5 transition">
                    Testar por 7 Dias
                </a>
                <a href="#contato" class="inline-flex justify-center items-center rounded-lg border border-white/60 text-white font-semibold px-10 py-4 hover:bg-white/10 transition">
                    Quero organizar minha empresa
                </a>
            </div>
            <p class="mt-6 text-sm text-white/80">Sem taxa de implantação, suporte humano ilimitado.</p>
        </div>
    </section>

    <!-- Preços -->
    <section id="precos" class="py-20 bg-slate-50">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto">
                <p class="text-sm font-semibold text-blue-600 uppercase tracking-[0.3em]">Planos e Preços</p>
                <h2 class="mt-4 text-3xl md:text-4xl font-bold">Investimento acessível para seu negócio crescer</h2>
                <p class="mt-4 text-slate-600">Todas as funcionalidades que você precisa por um preço que cabe no bolso.</p>
            </div>
            <div class="mt-12 max-w-lg mx-auto relative">
                <!-- Scarcity Badge -->
                <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 bg-red-600 text-white text-xs font-bold px-4 py-1 rounded-full shadow-lg z-10 animate-bounce">
                    RESTAM POUCAS VAGAS
                </div>

                <div class="rounded-3xl bg-white border-2 border-blue-600 shadow-2xl overflow-hidden relative">
                    <div class="bg-blue-600 text-white text-center py-4 relative overflow-hidden">
                        <div class="absolute inset-0 bg-white/10 transform -skew-x-12"></div>
                        <span class="text-sm font-bold uppercase tracking-wider relative z-10">Oferta Exclusiva Vitalícia</span>
                    </div>
                    <div class="p-8">
                        <div class="text-center">
                            <p class="text-sm text-slate-500 mb-2">De <span class="line-through text-red-400">R$ 47,90</span> por apenas:</p>
                            <div class="flex items-center justify-center gap-1">
                                <span class="text-2xl font-bold text-slate-700 mt-2">R$</span>
                                <span class="text-6xl font-extrabold text-blue-600">29</span>
                                <div class="flex flex-col items-start">
                                    <span class="text-2xl font-bold text-blue-600">,90</span>
                                    <span class="text-xs text-slate-500">/mês</span>
                                </div>
                            </div>
                            <div class="mt-4 bg-yellow-50 border border-yellow-200 rounded-lg p-3">
                                <p class="text-xs text-yellow-800 font-semibold mb-1">🔥 87% dos cupons já utilizados</p>
                                <div class="w-full bg-yellow-200 rounded-full h-2">
                                    <div class="bg-yellow-500 h-2 rounded-full" style="width: 87%"></div>
                                </div>
                                <p class="text-[10px] text-yellow-700 mt-1">Oferta válida para os próximos 100 clientes</p>
                            </div>
                        </div>
                        <ul class="mt-8 space-y-4">
                            <li class="flex items-start gap-3">
                                <div class="bg-green-100 p-1 rounded-full">
                                    <i class="fa-solid fa-check text-green-600 text-xs"></i>
                                </div>
                                <span class="text-slate-700 font-medium">Cadastro ilimitado de clientes</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <div class="bg-green-100 p-1 rounded-full">
                                    <i class="fa-solid fa-check text-green-600 text-xs"></i>
                                </div>
                                <span class="text-slate-700 font-medium">Controle de estoque e produtos</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <div class="bg-green-100 p-1 rounded-full">
                                    <i class="fa-solid fa-check text-green-600 text-xs"></i>
                                </div>
                                <span class="text-slate-700 font-medium">Financeiro completo (Contas a Pagar/Receber)</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <div class="bg-green-100 p-1 rounded-full">
                                    <i class="fa-solid fa-check text-green-600 text-xs"></i>
                                </div>
                                <span class="text-slate-700 font-medium">Emissão de Ordens de Serviço (OS)</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <div class="bg-green-100 p-1 rounded-full">
                                    <i class="fa-solid fa-check text-green-600 text-xs"></i>
                                </div>
                                <span class="text-slate-700 font-medium">Suporte via WhatsApp incluso</span>
                            </li>
                        </ul>
                        <div class="mt-8">
                            <a href="/app/register" class="block w-full text-center rounded-lg bg-blue-600 text-white font-semibold px-8 py-4 hover:bg-blue-700 transition">
                                Começar teste grátis de 7 dias
                            </a>
                        </div>
                        <p class="mt-4 text-center text-sm text-slate-500">Sem compromisso. Cancele quando quiser.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section id="faq" class="py-20 bg-white">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto">
                <p class="text-sm font-semibold text-blue-600 uppercase tracking-[0.3em]">FAQ</p>
                <h2 class="mt-4 text-3xl font-bold">Perguntas frequentes sobre gestão, financeiro e fluxo de caixa</h2>
            </div>
            <div class="mt-12 space-y-4">
                <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                    <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                        Como o WSoft ajuda no controle financeiro diário?
                        <span class="text-sm text-slate-500 group-open:hidden">+</span>
                        <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                    </summary>
                    <p class="mt-3 text-slate-600">O painel unifica entradas, saídas, projeções e limites para que você acompanhe o sistema de fluxo de caixa em tempo real.</p>
                </details>
                <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                    <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                        Posso controlar ordens de serviço e estoque?
                        <span class="text-sm text-slate-500 group-open:hidden">+</span>
                        <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                    </summary>
                    <p class="mt-3 text-slate-600">Sim, o sistema de ordem de serviço integra peças, mão de obra e controle de produtos para evitar erros e retrabalhos.</p>
                </details>
                <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                    <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                        Há recursos de contas a pagar e receber automáticos?
                        <span class="text-sm text-slate-500 group-open:hidden">+</span>
                        <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                    </summary>
                    <p class="mt-3 text-slate-600">Alertas, conciliações e integrações bancárias reduzem esquecimentos e mantêm o financeiro organizado.</p>
                </details>
                <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                    <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                        O que muda para quem precisa de controle de inadimplência?
                        <span class="text-sm text-slate-500 group-open:hidden">+</span>
                        <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                    </summary>
                    <p class="mt-3 text-slate-600">Você segmenta devedores, dispara lembretes e acompanha negociações diretamente do painel.</p>
                </details>
                <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                    <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                        Preciso de equipe grande para usar o sistema?
                        <span class="text-sm text-slate-500 group-open:hidden">+</span>
                        <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                    </summary>
                    <p class="mt-3 text-slate-600">Não. O layout foi desenhado para pequenas empresas que querem profissionalizar processos sem burocracia.</p>
                </details>
            </div>
        </div>
    </section>

</x-site-layout>
