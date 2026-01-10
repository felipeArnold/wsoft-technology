@php
$structuredData = [
    [
        '@context' => 'https://schema.org',
        '@type' => 'SoftwareApplication',
        'name' => 'WSoft - Sistema para Pet Shop',
        'url' => 'https://www.wsoft.dev.br/sistema-para-pet-shop',
        'description' => 'Sistema completo para gestão de Pet Shop e Banho e Tosa. Agendamento, cadastro de animais, vacinas e vendas.',
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
            'ratingCount' => '72'
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
                'name' => 'Pet Shop',
                'item' => 'https://www.wsoft.dev.br/sistema-para-pet-shop'
            ]
        ]
    ],
    [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => [
            [
                '@type' => 'Question',
                'name' => 'O sistema tem agenda para banho e tosa?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Sim! Agenda completa para organizar horários de banho, tosa e consultas veterinárias, com separação por profissional.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'Posso cadastrar vacinas?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Com certeza. Mantenha o histórico de vacinas e vermífugos em dia, com alertas para os tutores.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'Tem controle de pacote de banho?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Sim, você vende o pacote e o sistema controla as sessões utilizadas e restantes automaticamente.'
                ]
            ],
             [
                '@type' => 'Question',
                'name' => 'Funciona para clínica veterinária?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Sim, atende perfeitamente pet shops com serviços clínicos, permitindo prontuário e histórico de saúde.'
                ]
            ]
        ]
    ],
    [
        '@context' => 'https://schema.org',
        '@type' => 'HowTo',
        'name' => 'Como organizar seu Pet Shop com WSoft',
        'description' => 'Guia prático para organizar agenda, pets e vendas do seu banho e tosa.',
        'step' => [
            [
                '@type' => 'HowToStep',
                'name' => 'Cadastre os Pets',
                'text' => 'Registre nome, raça, porte e dados do tutor. Tenha a ficha completa do animal.',
                'position' => 1
            ],
            [
                '@type' => 'HowToStep',
                'name' => 'Organize a Agenda',
                'text' => 'Agende banhos e tosas evitando conflitos. Controle o tempo de cada serviço.',
                'position' => 2
            ],
            [
                '@type' => 'HowToStep',
                'name' => 'Controle Vendas e Serviços',
                'text' => 'Venda produtos e serviços na mesma tela. Emita comprovante e controle o caixa.',
                'position' => 3
            ]
        ]
    ]
];
@endphp

<x-site-layout
    :title="'Sistema para Pet Shop e Banho e Tosa | WSoft'"
    :description="'Sistema para Pet Shop completo. Agenda de banho e tosa, cadastro de animais, vacinas e financeiro. Teste grátis!'"
    :keywords="'sistema para pet shop, software banho e tosa, gestão pet shop, agenda banho e tosa, programa para pet shop, sistema veterinário, controle de vacinas pet, software para clínica veterinária'"
    :canonical="'https://www.wsoft.dev.br/sistema-para-pet-shop'"
    :ogTitle="'Sistema para Pet Shop e Banho e Tosa | WSoft'"
    :ogDescription="'Otimize seu Pet Shop. Agenda organizada, histórico de pets e controle financeiro completo.'"
    :structuredData="$structuredData"
>

<!-- Hero -->
<section id="hero" class="pt-32 pb-24 bg-gradient-to-b from-sky-950 via-sky-900 to-slate-900 text-white overflow-hidden relative">
    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 30px 30px;"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-16 items-center relative z-10">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-sky-800/50 border border-sky-700 text-sky-100 text-xs font-semibold uppercase tracking-wider mb-6">
                <span class="w-2 h-2 rounded-full bg-sky-400 animate-pulse"></span>
                Sistema para Pet Shop
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold leading-tight tracking-tight">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-sky-400 to-cyan-300">Sistema de Gestão</span> para Pet Shop
            </h1>
            <p class="mt-6 text-lg md:text-xl text-sky-100/80 leading-relaxed max-w-lg">
                Agenda de banho e tosa, carteira de vacinação digital e controle de vendas. Tudo o que seu negócio precisa para crescer. <span class="text-sky-400 font-bold block mt-2">Apenas R$ 79,90/mês.</span>
            </p>
            <div class="mt-10 flex flex-col sm:flex-row gap-4">
                <a href="/app/register" class="inline-flex justify-center items-center rounded-xl bg-sky-600 text-white font-bold px-8 py-4 shadow-lg shadow-sky-600/30 hover:bg-sky-700 hover:-translate-y-1 transition transform duration-200">
                    Teste grátis por 7 dias
                    <i class="fa-solid fa-arrow-right ml-2"></i>
                </a>
                <a href="#como-funciona" class="inline-flex justify-center items-center rounded-xl border border-white/30 text-white font-semibold px-8 py-4 hover:bg-white/10 transition backdrop-blur-sm">
                    <i class="fa-solid fa-play mr-2"></i>
                    Como Funciona
                </a>
            </div>
            <div class="mt-10 pt-8 border-t border-sky-800/30">
                <p class="text-sm text-sky-200/60 mb-4">Ideal para:</p>
                <div class="flex flex-wrap gap-3 text-sm font-medium text-white">
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Pet Shops</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Banho e Tosa</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Clínicas Veterinárias</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Creches Pet</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Dog Walkers</span>
                </div>
            </div>
        </div>
        <div class="relative">
            <div class="absolute -inset-4 bg-gradient-to-r from-sky-500 to-cyan-500 rounded-full blur-3xl opacity-20 animate-pulse"></div>
            <div class="bg-sky-900/40 border border-sky-700/50 rounded-3xl p-8 backdrop-blur-md shadow-2xl relative">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <p class="text-sm uppercase text-sky-200/70 font-semibold tracking-wider">Banhos Hoje</p>
                        <p class="text-3xl font-bold mt-1 text-white">28</p>
                        <div class="flex items-center gap-2 mt-2">
                            <span class="text-xs font-bold text-sky-300 bg-sky-500/20 px-2 py-0.5 rounded">Agenda Cheia</span>
                        </div>
                    </div>
                    <div class="h-12 w-12 rounded-full bg-sky-500/20 flex items-center justify-center border border-sky-400/30">
                        <i class="fa-solid fa-paw text-sky-300 text-xl"></i>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="bg-sky-800/40 rounded-xl p-4 border border-sky-700/50">
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-xs text-sky-200">Faturamento do Dia</p>
                            <span class="text-sm font-bold text-sky-300">R$ 2.150,00</span>
                        </div>
                         <div class="h-2 bg-sky-950 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-sky-400 to-cyan-400 w-[80%] rounded-full"></div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-sky-800/40 rounded-xl p-4 border border-sky-700/50">
                            <p class="text-xs text-sky-200">Novos Pets</p>
                            <p class="text-2xl font-bold mt-1 text-white">4</p>
                        </div>
                        <div class="bg-sky-800/40 rounded-xl p-4 border border-sky-700/50">
                            <p class="text-xs text-sky-200">Pacotes</p>
                            <p class="text-2xl font-bold mt-1 text-white">12</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pain vs Gain -->
<x-site.comparison
    :subtitle="'Não perca clientes'"
    :title="'Agenda bagunçada no Pet Shop?'"
    :description="'Atendimentos atrasados e clientes insatisfeitos prejudicam seu negócio. Mude isso:'"
    :painTitle="'Controle Manual'"
    :painItems="[
        'Atrasos nos banhos por agenda confusa',
        'Falta de histórico de saúde do pet',
        'Esquece de avisar vacinas vencidas',
        'Prejuízo com estoque de ração'
    ]"
    :gainTitle="'Pet Shop de Sucesso'"
    :gainItems="[
        'Agenda organizada por profissional',
        'Ficha completa com histórico do pet',
        'Lembretes automáticos de vacina',
        'Controle de estoque e validade'
    ]"
    :gainCardBg="'bg-sky-900'"
    :gainCardBorder="'border-sky-800'"
    :gainTitleColor="'text-sky-300'"
    :gainCheckColor="'text-sky-400'"
    :gainBadgeBg="'bg-sky-600'"
/>

<!-- How it Works -->
<section id="como-funciona" class="py-24 bg-sky-50/30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-20">
            <p class="text-sm font-semibold text-sky-600 uppercase tracking-[0.3em]">Passo a Passo</p>
            <h2 class="mt-4 text-3xl md:text-4xl font-bold text-slate-900">Como funciona o Sistema Pet</h2>
            <p class="mt-4 text-lg text-slate-600">Simples e prático, para você cuidar dos animais com tranquilidade.</p>
        </div>

        <div class="space-y-24">
             <!-- Step 1 -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-sky-200 group">
                        <div class="absolute inset-0 bg-sky-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="{{ asset('images/sistema/clientes/cadastro.png') }}" alt="Cadastro de Pets" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-sky-100 text-sky-700 font-bold text-xl">1</span>
                        <h3 class="text-2xl font-bold text-slate-900">Cadastre Pets e Tutores</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Registre os dados do animal (nome, raça, peso, nascimento) e do responsável.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-sky-500"></i>
                            <span>Ficha completa do animal</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-sky-500"></i>
                            <span>Histórico de atendimentos</span>
                        </li>
                         <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-sky-500"></i>
                            <span>Controle de vacinas e vermífugos</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-1">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-sky-100 text-sky-700 font-bold text-xl">2</span>
                        <h3 class="text-2xl font-bold text-slate-900">Agenda de Banho e Tosa</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Organize os horários de banho, tosa e consultas veterinárias.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-sky-500"></i>
                            <span>Agenda por tosador/veterinário</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-sky-500"></i>
                            <span>Controle de pacotes de banho</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-sky-500"></i>
                            <span>Lembretes de agendamento</span>
                        </li>
                    </ul>
                </div>
                <div class="order-2">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-sky-200 group">
                        <div class="absolute inset-0 bg-sky-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="/images/crm/dashboard-preview.png" alt="Agenda Pet Shop" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-16 text-center">
            <a href="/app/register" class="inline-flex items-center gap-3 bg-sky-600 hover:bg-sky-700 text-white font-bold px-8 py-4 rounded-xl shadow-lg shadow-sky-500/20 hover:shadow-sky-500/40 transform hover:-translate-y-0.5 transition-all duration-300">
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
            <p class="text-sm font-semibold text-sky-600 uppercase tracking-[0.3em]">Vantagens</p>
            <h2 class="mt-4 text-3xl md:text-4xl font-bold">Tudo para seu Pet Shop</h2>
        </div>
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            <article class="group rounded-2xl border border-slate-100 bg-sky-50/20 p-6 shadow-sm hover:shadow-lg hover:border-sky-200 transition-all duration-300">
                <div class="w-12 h-12 bg-sky-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-sky-600 transition-colors duration-300">
                    <i class="fa-solid fa-shower text-sky-600 group-hover:text-white text-xl transition-colors duration-300"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Banho e Tosa</h3>
                <p class="text-sm text-slate-600 leading-relaxed">Agenda específica para estética animal, com controle de pacotes e comissões.</p>
            </article>
            <article class="group rounded-2xl border border-slate-100 bg-sky-50/20 p-6 shadow-sm hover:shadow-lg hover:border-cyan-200 transition-all duration-300">
                <div class="w-12 h-12 bg-cyan-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-cyan-600 transition-colors duration-300">
                    <i class="fa-solid fa-syringe text-cyan-600 group-hover:text-white text-xl transition-colors duration-300"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Vacinas e Alertas</h3>
                <p class="text-sm text-slate-600 leading-relaxed">Carteira de vacinação digital com envio automático de lembretes para os tutores.</p>
            </article>
            <article class="group rounded-2xl border border-slate-100 bg-sky-50/20 p-6 shadow-sm hover:shadow-lg hover:border-blue-200 transition-all duration-300">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-blue-600 transition-colors duration-300">
                    <i class="fa-solid fa-bone text-blue-600 group-hover:text-white text-xl transition-colors duration-300"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Venda de Produtos</h3>
                <p class="text-sm text-slate-600 leading-relaxed">PDV para venda de ração, brinquedos e acessórios com baixa automática no estoque.</p>
            </article>
        </div>
    </div>
</section>

<!-- CTA Section -->
<x-site.cta-final
    :title="'A melhor solução para seu Pet Shop'"
    :description="'Comece agora com 7 dias de teste grátis. Gerencie banho, tosa e loja por apenas <span class=\'text-sky-300 font-bold\'>R$ 79,90/mês</span>.'"
    :footer="'Usado por Pet Shops em todo o Brasil'"
    :gradient="'bg-gradient-to-br from-sky-950 to-sky-700'"
    :textColor="'text-sky-50'"
    :highlightColor="'text-sky-300'"
    :buttonColor="'bg-sky-500 shadow-sky-500/30 hover:bg-sky-600'"
    :priceUrl="false"
/>

<!-- FAQ -->
<section id="faq" class="py-20 bg-sky-50/20">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <p class="text-sm font-semibold text-sky-600 uppercase tracking-[0.3em]">Dúvidas</p>
            <h2 class="mt-4 text-3xl font-bold">Perguntas Frequentes</h2>
        </div>
        <div class="space-y-4">
             <details class="group rounded-2xl border border-slate-100 bg-white p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    O sistema tem agenda para banho e tosa?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Sim! Agenda completa para organizar horários de banho, tosa e consultas veterinárias, com separação por profissional.</p>
            </details>
            <details class="group rounded-2xl border border-slate-100 bg-white p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    Posso cadastrar vacinas?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Com certeza. Mantenha o histórico de vacinas e vermífugos em dia, com alertas para os tutores.</p>
            </details>
            <details class="group rounded-2xl border border-slate-100 bg-white p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    Tem controle de pacote de banho?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Sim, você vende o pacote e o sistema controla as sessões utilizadas e restantes automaticamente.</p>
            </details>
        </div>
    </div>
</section>

</x-site-layout>
