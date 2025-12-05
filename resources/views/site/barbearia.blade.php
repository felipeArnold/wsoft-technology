@php
$structuredData = [
    [
        '@context' => 'https://schema.org',
        '@type' => 'SoftwareApplication',
        'name' => 'WSoft - Sistema para Barbearia',
        'url' => 'https://www.wsoft.dev.br/sistema-para-barbearia',
        'description' => 'Sistema completo para gestão de barbearias. Agendamento, comissões, financeiro e controle total do seu negócio.',
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
            'ratingCount' => '87'
        ]
    ],
    [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => [
            [
                '@type' => 'Question',
                'name' => 'O sistema calcula comissão dos barbeiros?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Sim! O WSoft calcula automaticamente as comissões de cada barbeiro, permitindo configurar porcentagens diferentes por profissional ou serviço.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'Posso controlar o agendamento de clientes?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Com certeza. O sistema possui uma agenda completa e intuitiva para organizar os horários de todos os profissionais da barbearia.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'O sistema emite comprovante para o cliente?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Sim, você pode emitir e enviar comprovantes de serviços e vendas diretamente pelo WhatsApp para seus clientes.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'Consigo controlar o estoque de produtos?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Sim! Controle o estoque de produtos para venda (pomadas, shampoos) e também o consumo interno da barbearia.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'Quanto custa o sistema para barbearia?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'O WSoft custa apenas R$ 29,90 por mês com todas as funcionalidades incluídas: agenda, comissões, financeiro e estoque. Teste grátis por 7 dias.'
                ]
            ]
        ]
    ]
];
@endphp

<x-site-layout
    :title="'Sistema para Barbearia | Gestão e Agenda | WSoft'"
    :description="'Sistema completo de gestão para barbearias. Agenda, cálculo de comissões, financeiro e estoque. Teste grátis por 7 dias!'"
    :keywords="'sistema para barbearia, software barbearia, agenda barbearia, gestão barbearia, programa para barbearia, sistema barbeiro, controle comissão barbearia'"
    :canonical="'https://www.wsoft.dev.br/sistema-para-barbearia'"
    :ogTitle="'Sistema de Gestão para Barbearias | WSoft'"
    :ogDescription="'Organize sua barbearia, controle comissões e fidelize clientes com o sistema mais simples e completo do mercado.'"
    :structuredData="$structuredData"
>

<!-- Hero -->
<section id="hero" class="pt-32 pb-24 bg-gradient-to-b from-slate-900 via-slate-800 to-slate-900 text-white overflow-hidden relative">
    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 30px 30px;"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-16 items-center relative z-10">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-700/50 border border-slate-600 text-slate-200 text-xs font-semibold uppercase tracking-wider mb-6">
                <span class="w-2 h-2 rounded-full bg-orange-500 animate-pulse"></span>
                Sistema para Barbearia
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold leading-tight tracking-tight">
                Gestão Profissional para sua <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-amber-200">Barbearia</span>
            </h1>
            <p class="mt-6 text-lg md:text-xl text-slate-300 leading-relaxed max-w-lg">
                Agenda organizada, comissões automáticas e financeiro em dia. O sistema ideal para barbeiros que querem crescer.
            </p>
            <div class="mt-10 flex flex-col sm:flex-row gap-4">
                <a href="/app/register" class="inline-flex justify-center items-center rounded-xl bg-orange-500 text-white font-bold px-8 py-4 shadow-lg shadow-orange-500/30 hover:bg-orange-600 hover:-translate-y-1 transition transform duration-200">
                    Testar por 7 Dias
                    <i class="fa-solid fa-arrow-right ml-2"></i>
                </a>
                <a href="#como-funciona" class="inline-flex justify-center items-center rounded-xl border border-white/30 text-white font-semibold px-8 py-4 hover:bg-white/10 transition backdrop-blur-sm">
                    <i class="fa-solid fa-play mr-2"></i>
                    Como Funciona
                </a>
            </div>
            <div class="mt-10 pt-8 border-t border-white/10">
                <p class="text-sm text-slate-400 mb-4">Ideal para:</p>
                <div class="flex flex-wrap gap-3 text-sm font-medium text-white">
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Barbearias</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Salões Masculinos</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Barbeiros Autônomos</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Studios</span>
                </div>
            </div>
        </div>
        <div class="relative">
            <div class="absolute -inset-4 bg-gradient-to-r from-orange-500 to-amber-500 rounded-full blur-3xl opacity-20 animate-pulse"></div>
            <div class="bg-slate-800/50 border border-slate-700/50 rounded-3xl p-8 backdrop-blur-md shadow-2xl relative">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <p class="text-sm uppercase text-slate-400 font-semibold tracking-wider">Faturamento Hoje</p>
                        <h3 class="text-3xl font-bold mt-1 text-white">R$ 1.250,00</h3>
                        <div class="flex items-center gap-2 mt-2">
                            <span class="text-xs font-bold text-green-400 bg-green-400/10 px-2 py-0.5 rounded">+15% vs ontem</span>
                        </div>
                    </div>
                    <div class="h-12 w-12 rounded-full bg-orange-500/20 flex items-center justify-center border border-orange-400/30">
                        <i class="fa-solid fa-scissors text-orange-400 text-xl"></i>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="bg-slate-700/50 rounded-xl p-4 border border-slate-600/50">
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-xs text-slate-300">Agenda do Dia</p>
                            <span class="text-sm font-bold text-orange-400">85% Ocupada</span>
                        </div>
                        <div class="h-2 bg-slate-900 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-orange-500 to-amber-500 w-[85%] rounded-full"></div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-slate-700/50 rounded-xl p-4 border border-slate-600/50">
                            <p class="text-xs text-slate-300">Atendimentos</p>
                            <p class="text-2xl font-bold mt-1 text-white">24</p>
                        </div>
                        <div class="bg-slate-700/50 rounded-xl p-4 border border-slate-600/50">
                            <p class="text-xs text-slate-300">Ticket Médio</p>
                            <p class="text-2xl font-bold mt-1 text-white">R$ 52</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pain vs Gain -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-red-600 font-bold tracking-wider uppercase text-sm">O problema da agenda de papel</span>
            <h2 class="mt-2 text-3xl md:text-4xl font-extrabold text-slate-900">Sua barbearia está perdendo dinheiro?</h2>
            <p class="mt-4 text-lg text-slate-600">A falta de organização pode estar custando caro para o seu negócio. Veja a diferença:</p>
        </div>
        <div class="grid md:grid-cols-2 gap-8">
            <!-- Pain -->
            <div class="p-8 rounded-3xl bg-red-50 border border-red-100 relative overflow-hidden group hover:shadow-lg transition">
                <div class="absolute top-0 right-0 bg-red-100 text-red-600 text-xs font-bold px-3 py-1 rounded-bl-xl">SEM SISTEMA</div>
                <h3 class="text-xl font-bold text-red-700 mb-6 flex items-center gap-2">
                    <i class="fa-solid fa-circle-xmark"></i> Gestão Manual
                </h3>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3 text-slate-700">
                        <i class="fa-solid fa-xmark text-red-500 mt-1"></i>
                        <span>Agenda bagunçada e horários duplicados</span>
                    </li>
                    <li class="flex items-start gap-3 text-slate-700">
                        <i class="fa-solid fa-xmark text-red-500 mt-1"></i>
                        <span>Erros no cálculo de comissões</span>
                    </li>
                    <li class="flex items-start gap-3 text-slate-700">
                        <i class="fa-solid fa-xmark text-red-500 mt-1"></i>
                        <span>Não sabe quanto lucrou no mês</span>
                    </li>
                    <li class="flex items-start gap-3 text-slate-700">
                        <i class="fa-solid fa-xmark text-red-500 mt-1"></i>
                        <span>Esquece de avisar clientes e leva "bolo"</span>
                    </li>
                </ul>
            </div>
            <!-- Gain -->
            <div class="p-8 rounded-3xl bg-green-50 border border-green-100 relative overflow-hidden shadow-md group hover:shadow-xl transition transform hover:-translate-y-1">
                <div class="absolute top-0 right-0 bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-bl-xl">COM WSOFT</div>
                <h3 class="text-xl font-bold text-green-700 mb-6 flex items-center gap-2">
                    <i class="fa-solid fa-circle-check"></i> Barbearia Organizada
                </h3>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3 text-slate-700">
                        <i class="fa-solid fa-check text-green-600 mt-1"></i>
                        <span>Agenda digital simples e organizada</span>
                    </li>
                    <li class="flex items-start gap-3 text-slate-700">
                        <i class="fa-solid fa-check text-green-600 mt-1"></i>
                        <span>Cálculo automático de comissões</span>
                    </li>
                    <li class="flex items-start gap-3 text-slate-700">
                        <i class="fa-solid fa-check text-green-600 mt-1"></i>
                        <span>Controle financeiro completo</span>
                    </li>
                    <li class="flex items-start gap-3 text-slate-700">
                        <i class="fa-solid fa-check text-green-600 mt-1"></i>
                        <span>Histórico de cortes de cada cliente</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- How it Works -->
<section id="como-funciona" class="py-24 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-20">
            <p class="text-sm font-semibold text-orange-600 uppercase tracking-[0.3em]">Passo a Passo</p>
            <h2 class="mt-4 text-3xl md:text-4xl font-bold text-slate-900">Como funciona o Sistema para Barbearia</h2>
            <p class="mt-4 text-lg text-slate-600">Simples de usar, feito para o dia a dia corrido da barbearia.</p>
        </div>

        <div class="space-y-24">
            <!-- Step 1 -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 group">
                        <div class="absolute inset-0 bg-orange-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="{{ asset('images/sistema/clientes/cadastro.png') }}" alt="Tela de Agenda" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-orange-100 text-orange-700 font-bold text-xl">1</span>
                        <h3 class="text-2xl font-bold text-slate-900">Organize a Agenda</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Adeus papel e caneta. Tenha uma visão clara de todos os horários, encaixes e profissionais disponíveis.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-orange-500"></i>
                            <span>Agenda por profissional</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-orange-500"></i>
                            <span>Status do agendamento (Confirmado, Pendente)</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-orange-500"></i>
                            <span>Fácil de remarcar</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-1">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-orange-100 text-orange-700 font-bold text-xl">2</span>
                        <h3 class="text-2xl font-bold text-slate-900">Controle Comissões</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Defina a porcentagem de comissão para cada barbeiro e deixe o sistema calcular tudo automaticamente. Fechamento de caixa sem dor de cabeça.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-orange-500"></i>
                            <span>Comissão por serviço ou produto</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-orange-500"></i>
                            <span>Relatório de pagamentos</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-orange-500"></i>
                            <span>Transparência para a equipe</span>
                        </li>
                    </ul>
                </div>
                <div class="order-2">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 group">
                        <div class="absolute inset-0 bg-orange-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="/images/crm/history.png" alt="Tela de Financeiro" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 group">
                        <div class="absolute inset-0 bg-orange-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="/images/crm/reports.png" alt="Relatórios de Gestão" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-orange-100 text-orange-700 font-bold text-xl">3</span>
                        <h3 class="text-2xl font-bold text-slate-900">Fidelize Clientes</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Saiba quem são seus melhores clientes, a frequência de corte e ofereça um atendimento personalizado.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-orange-500"></i>
                            <span>Histórico de serviços</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-orange-500"></i>
                            <span>Lembretes de retorno</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-orange-500"></i>
                            <span>Cadastro completo</span>
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
            <p class="text-sm font-semibold text-orange-600 uppercase tracking-[0.3em]">Vantagens</p>
            <h2 class="mt-4 text-3xl md:text-4xl font-bold">Por que usar o WSoft na sua barbearia?</h2>
            <p class="mt-4 text-lg text-slate-600">Ferramentas pensadas para facilitar a vida do barbeiro e do gestor</p>
        </div>
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-calendar-check text-orange-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Agenda Simples</h3>
                    <p class="mt-3 text-slate-600">Visualize e gerencie horários com facilidade. Evite conflitos e organize o dia.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-money-bill-trend-up text-blue-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Controle Financeiro</h3>
                    <p class="mt-3 text-slate-600">Saiba exatamente quanto entrou e saiu. Fluxo de caixa, contas a pagar e receber.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-users text-purple-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Gestão de Equipe</h3>
                    <p class="mt-3 text-slate-600">Controle de comissões e desempenho individual de cada barbeiro.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                    <i class="fa-brands fa-whatsapp text-green-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Comunicação</h3>
                    <p class="mt-3 text-slate-600">Envie comprovantes e lembretes para seus clientes via WhatsApp.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-box-open text-red-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Controle de Estoque</h3>
                    <p class="mt-3 text-slate-600">Gerencie produtos de venda e consumo interno. Evite faltar material.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-teal-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-mobile-screen text-teal-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Acesso de Qualquer Lugar</h3>
                    <p class="mt-3 text-slate-600">Acesse o sistema pelo celular, tablet ou computador. Seus dados sempre à mão.</p>
                </div>
            </article>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-br from-slate-800 to-slate-900 text-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold">Profissionalize sua Barbearia</h2>
        <p class="mt-4 text-lg text-slate-300 max-w-2xl mx-auto">
            Comece agora com 7 dias de teste grátis. Sem cartão de crédito, sem compromisso.
        </p>
        <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="/app/register" class="inline-flex justify-center items-center rounded-xl bg-orange-500 text-white font-bold px-10 py-4 shadow-lg shadow-orange-500/30 hover:bg-orange-600 hover:-translate-y-1 transition transform duration-200">
                Testar por 7 Dias
                <i class="fa-solid fa-arrow-right ml-2"></i>
            </a>
            <a href="/#precos" class="inline-flex justify-center items-center rounded-xl border border-white/60 text-white font-semibold px-10 py-4 hover:bg-white/10 transition backdrop-blur-sm">
                Ver Planos e Preços
            </a>
        </div>
        <p class="mt-6 text-sm text-slate-400">Junte-se a centenas de barbearias que usam WSoft</p>
    </div>
</section>

<!-- FAQ -->
<section id="faq" class="py-20 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <p class="text-sm font-semibold text-orange-600 uppercase tracking-[0.3em]">Dúvidas</p>
            <h2 class="mt-4 text-3xl font-bold">Perguntas Frequentes</h2>
        </div>
        <div class="space-y-4">
            <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    O sistema calcula comissão dos barbeiros?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Sim! O WSoft calcula automaticamente as comissões de cada barbeiro, permitindo configurar porcentagens diferentes por profissional ou serviço.</p>
            </details>
            <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    Posso controlar o agendamento de clientes?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Com certeza. O sistema possui uma agenda completa e intuitiva para organizar os horários de todos os profissionais da barbearia.</p>
            </details>
            <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    O sistema emite comprovante para o cliente?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Sim, você pode emitir e enviar comprovantes de serviços e vendas diretamente pelo WhatsApp para seus clientes.</p>
            </details>
            <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    Consigo controlar o estoque de produtos?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Sim! Controle o estoque de produtos para venda (pomadas, shampoos) e também o consumo interno da barbearia.</p>
            </details>
            <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    Quanto custa o sistema para barbearia?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">O WSoft custa apenas R$ 29,90 por mês com todas as funcionalidades incluídas: agenda, comissões, financeiro e estoque. Teste grátis por 7 dias.</p>
            </details>
        </div>
    </div>
</section>

<!-- Prova Social -->
<section class="py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <p class="text-sm font-semibold text-orange-600 uppercase tracking-[0.3em]">Depoimentos</p>
            <h2 class="mt-4 text-3xl font-bold">Quem usa aprova</h2>
        </div>
        <div class="grid gap-6 md:grid-cols-3">
            <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                <div class="flex gap-1 text-yellow-400 mb-4">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <p class="text-sm text-slate-600 italic">"O controle de comissões facilitou muito o fechamento do mês. Antes era uma dor de cabeça, agora é automático."</p>
                <div class="mt-4 font-semibold">Carlos Eduardo</div>
                <div class="text-sm text-slate-500">Barbearia Vintage</div>
            </article>
            <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                <div class="flex gap-1 text-yellow-400 mb-4">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <p class="text-sm text-slate-600 italic">"Sistema simples e direto. Consigo ver minha agenda pelo celular e já deixar tudo organizado para o dia seguinte."</p>
                <div class="mt-4 font-semibold">Rafael Santos</div>
                <div class="text-sm text-slate-500">Barbeiro Autônomo</div>
            </article>
            <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                <div class="flex gap-1 text-yellow-400 mb-4">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <p class="text-sm text-slate-600 italic">"Melhor custo-benefício. Tem tudo que preciso: agenda, financeiro e estoque. Recomendo!"</p>
                <div class="mt-4 font-semibold">André Oliveira</div>
                <div class="text-sm text-slate-500">The Barber Club</div>
            </article>
        </div>
    </div>
</section>

</x-site-layout>
