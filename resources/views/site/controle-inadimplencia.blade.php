@php
$structuredData = [
    [
        '@context' => 'https://schema.org',
        '@type' => 'SoftwareApplication',
        'name' => 'WSoft - Controle de Inadimplência',
        'url' => 'https://www.wsoft.dev.br/sistema-para-controle-de-inadimplencia',
        'description' => 'Sistema para controle e redução de inadimplência. Identifique devedores, automatize cobranças e recupere crédito.',
        'operatingSystem' => 'Web',
        'applicationCategory' => 'FinanceApplication',
        'offers' => [
            '@type' => 'Offer',
            'price' => '29.90',
            'priceCurrency' => 'BRL',
            'url' => 'https://www.wsoft.dev.br/sistema-para-controle-de-inadimplencia',
            'description' => 'Plano mensal com todas as funcionalidades'
        ],
        'aggregateRating' => [
            '@type' => 'AggregateRating',
            'ratingValue' => '4.9',
            'ratingCount' => '78'
        ]
    ],
    [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => [
            [
                '@type' => 'Question',
                'name' => 'Como reduzir a inadimplência na minha empresa?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'O primeiro passo é organização. Com o WSoft, você sabe exatamente quem deve e há quanto tempo. O sistema envia lembretes automáticos para evitar o esquecimento.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'Posso bloquear clientes inadimplentes?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Sim! O sistema alerta quando você tenta vender para um cliente com pendências, permitindo bloquear novas vendas a prazo.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'O sistema envia cobrança por WhatsApp?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Sim! Você pode enviar lembretes de vencimento e mensagens de cobrança diretamente pelo WhatsApp com um clique.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'Como saber o total que tenho a receber?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'O painel de inadimplência mostra o valor total vencido, separado por tempo de atraso (30, 60, 90 dias), facilitando a priorização da cobrança.'
                ]
            ]
        ]
    ]
];
@endphp

<x-site-layout
    :title="'Controle de Inadimplência | Cobrança de Clientes | WSoft'"
    :description="'Reduza a inadimplência e recupere seu dinheiro. Sistema de cobrança e controle de devedores para pequenas empresas. Teste grátis!'"
    :keywords="'controle de inadimplência, cobrança de clientes, gestão de cobrança, software de cobrança, recuperar crédito, clientes devedores, gestão financeira'"
    :canonical="'https://www.wsoft.dev.br/sistema-para-controle-de-inadimplencia'"
    :ogTitle="'Sistema de Controle de Inadimplência | WSoft'"
    :ogDescription="'Pare de perder dinheiro. Identifique devedores, automatize cobranças e recupere seu capital com o WSoft.'"
    :structuredData="$structuredData"
>

<x-site.hero
    badge="Controle de Inadimplência"
    title="na Sua Empresa"
    highlight="Zero Inadimplência"
    description="Pare de vender para quem não paga. Identifique devedores, automatize cobranças e recupere seu dinheiro de forma profissional."
    primaryButtonText="Falar no WhatsApp"
    primaryButtonUrl="https://wa.me/5551999350578"
    secondaryButtonText="Como Funciona"
    secondaryButtonUrl="#como-funciona"
    :idealFor="['Lojas de Roupas', 'Mercadinhos', 'Prestadores de Serviço', 'Escolas e Cursos']"
    gradient="from-blue-950 to-blue-700"
    highlightGradient="from-blue-200 to-white"
>
    <div class="bg-white/10 border border-white/20 rounded-3xl p-8 backdrop-blur-md shadow-2xl relative">
        <div class="flex items-center justify-between mb-6">
            <div>
                <p class="text-sm uppercase text-blue-200 font-semibold tracking-wider">Total em Atraso</p>
                <h3 class="text-3xl font-bold mt-1 text-red-400">R$ 4.250,00</h3>
                <div class="flex items-center gap-2 mt-2">
                    <span class="text-xs font-bold text-red-400 bg-red-400/10 px-2 py-0.5 rounded">12 clientes</span>
                </div>
            </div>
            <div class="h-12 w-12 rounded-full bg-red-500/20 flex items-center justify-center border border-red-400/30">
                <i class="fa-solid fa-triangle-exclamation text-red-300 text-xl"></i>
            </div>
        </div>
        <div class="space-y-4">
            <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-xs text-blue-200">Recuperado este Mês</p>
                    <span class="text-sm font-bold text-blue-300">R$ 1.800,00</span>
                </div>
                <div class="h-2 bg-blue-950/50 rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-blue-400 to-cyan-400 w-[45%] rounded-full"></div>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                    <p class="text-xs text-blue-200">Atraso > 30 dias</p>
                    <p class="text-2xl font-bold mt-1 text-red-400">R$ 2k</p>
                </div>
                <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                    <p class="text-xs text-blue-200">Acordos</p>
                    <p class="text-2xl font-bold mt-1 text-blue-400">3</p>
                </div>
            </div>
        </div>
    </div>
</x-site.hero>

<!-- Pain vs Gain -->
<x-site.comparison
    title="O lucro vai embora no calote?"
    subtitle="O problema do fiado"
    description="Vender é bom, mas receber é fundamental. A falta de controle de cobrança quebra empresas."
    painTitle="Prejuízo Certo"
    :painItems="[
        'Vende para quem já está devendo',
        'Vergonha ou esquecimento de cobrar',
        'Perde o controle de prazos e valores',
        'Cliente some e você fica no prejuízo'
    ]"
    gainTitle="Crédito Seguro"
    :gainItems="[
        'Bloqueio automático de inadimplentes',
        'Cobrança profissional e impessoal',
        'Histórico de bom pagador',
        'Régua de cobrança automatizada'
    ]"
    gainCardBg="bg-blue-900"
    gainCardBorder="border-blue-800"
    gainTitleColor="text-blue-400"
    gainCheckColor="text-blue-400"
    gainBadgeBg="bg-blue-500"
    gainBadgeText="COM WSOFT"
    buttonColor="blue"
/>

<!-- How it Works (New Section) -->
<section id="como-funciona" class="py-24 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-20">
            <p class="text-sm font-semibold text-emerald-600 uppercase tracking-[0.3em]">Passo a Passo</p>
            <h2 class="mt-4 text-3xl md:text-4xl font-bold text-slate-900">Como reduzir a inadimplência</h2>
            <p class="mt-4 text-lg text-slate-600">Recupere seu crédito em 3 passos simples.</p>
        </div>

        <div class="space-y-24">
            <!-- Step 1 -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 group">
                        <div class="absolute inset-0 bg-emerald-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="/images/crm/registration.png" alt="Identificação de Devedores" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-emerald-100 text-emerald-700 font-bold text-xl">1</span>
                        <h3 class="text-2xl font-bold text-slate-900">Identifique o Atraso</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        O sistema monitora todos os vencimentos e destaca em vermelho quem não pagou. Você sabe na hora quem cobrar.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Lista de inadimplentes atualizada</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Filtro por dias de atraso</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-1">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-emerald-100 text-emerald-700 font-bold text-xl">2</span>
                        <h3 class="text-2xl font-bold text-slate-900">Notifique o Cliente</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Envie lembretes amigáveis antes do vencimento e avisos de cobrança após o atraso. Tudo via WhatsApp ou E-mail.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Envio de cobrança por WhatsApp</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Mensagens personalizáveis</span>
                        </li>
                    </ul>
                </div>
                <div class="order-2">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 group">
                        <div class="absolute inset-0 bg-emerald-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="/images/crm/history.png" alt="Envio de Cobrança" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 group">
                        <div class="absolute inset-0 bg-emerald-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="/images/crm/reports.png" alt="Bloqueio e Acordo" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-emerald-100 text-emerald-700 font-bold text-xl">3</span>
                        <h3 class="text-2xl font-bold text-slate-900">Bloqueie e Negocie</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        O sistema bloqueia novas vendas para devedores até a regularização. Registre acordos e parcele a dívida para recuperar o valor.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Bloqueio automático de vendas</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Renegociação de dívidas</span>
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
            <h2 class="mt-4 text-3xl md:text-4xl font-bold">Por que automatizar a cobrança?</h2>
            <p class="mt-4 text-lg text-slate-600">Profissionalismo que gera resultados</p>
        </div>
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-shield-halved text-emerald-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Mais Segurança</h3>
                    <p class="mt-3 text-slate-600">Venda com tranquilidade sabendo que o sistema barra clientes com histórico ruim.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-robot text-blue-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Cobrança Impessoal</h3>
                    <p class="mt-3 text-slate-600">Evite o constrangimento de cobrar amigos e conhecidos. Deixe que o sistema faça isso.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-sack-dollar text-purple-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Recuperação de Caixa</h3>
                    <p class="mt-3 text-slate-600">Transforme dívidas perdidas em dinheiro no caixa através de acordos e lembretes.</p>
                </div>
            </article>
        </div>

        <div class="text-center mt-16">
            <a
                href="https://wa.me/5551999350578"
                target="_blank"
                rel="noopener noreferrer"
                class="inline-flex items-center gap-3 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-500 hover:to-blue-400 text-white font-bold px-8 py-4 rounded-xl shadow-lg shadow-blue-500/20 hover:shadow-blue-500/40 transform hover:-translate-y-0.5 transition-all duration-300"
            >
                <i class="fa-brands fa-whatsapp text-xl"></i>
                <span>Falar com Especialista</span>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
            <p class="mt-4 text-sm text-slate-500">Tire suas dúvidas pelo WhatsApp</p>
        </div>
    </div>
</section>

<!-- CTA Inline -->
<section class="py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-site.cta-inline
            title="Pare de Perder Dinheiro com Inadimplência"
            description="Diga adeus aos calotes e recupere o controle do seu crédito. Com o WSoft, você automatiza cobranças, bloqueia maus pagadores e recupera valores que seriam perdidos."
            buttonText="Falar no WhatsApp"
            buttonUrl="https://wa.me/5551999350578"
            gradient="from-blue-900 to-blue-700"
            icon="fa-solid fa-shield-halved"
        />
    </div>
</section>

<!-- CTA Section -->
<x-site.cta-final
    :title="'Escolha um sistema completo para controle de inadimplência'"
    :description="'Comece agora com 7 dias de teste grátis. Use o melhor <strong>sistema para cobrança e recuperação</strong> por apenas <span class=\'text-yellow-300 font-bold\'>R$ 29,90/mês</span>.'"
    :footer="'Junte-se a centenas de empresas que usam WSoft'"
    :gradient="'bg-gradient-to-br from-blue-950 to-blue-700'"
    :textColor="'text-blue-50'"
    :highlightColor="'text-yellow-300'"
/>

<x-site.cta-whatsapp
    title="Comece Gratuitamente pelo WhatsApp"
    subtitle="Reduza a inadimplência e recupere seu crédito com o WSoft."
    buttonText="Começar Agora"
    gradient="from-blue-900 to-blue-700"
/>


<x-site.faq
    title="Perguntas Frequentes sobre Controle de Inadimplência"
    subtitle="FAQ"
    subtitleColor="text-blue-600"
    :questions="[
        [
            'question' => 'Como reduzir a inadimplência na minha empresa?',
            'answer' => 'O primeiro passo é ter <strong>organização e controle</strong>. Com um sistema de controle de inadimplência como o WSoft, você sabe exatamente quem deve, há quanto tempo e pode automatizar lembretes de cobrança. Bloqueie novas vendas para devedores e envie mensagens profissionais via WhatsApp ou e-mail.'
        ],
        [
            'question' => 'O que é um sistema de controle de inadimplência?',
            'answer' => 'Um <strong>sistema de controle de inadimplência</strong> é uma ferramenta que monitora todos os pagamentos em atraso, identifica clientes devedores, envia cobranças automáticas e permite bloquear novas vendas a prazo. É essencial para empresas que vendem no crediário ou \'fiado\'.'
        ],
        [
            'question' => 'O sistema bloqueia vendas automaticamente para inadimplentes?',
            'answer' => 'Sim! Você pode configurar o <strong>bloqueio automático de vendas</strong> para clientes com contas atrasadas. Quando tentar vender para um devedor, o sistema alertará e poderá impedir novas vendas a prazo até a regularização.'
        ],
        [
            'question' => 'Como fazer cobrança de clientes de forma profissional?',
            'answer' => 'O WSoft permite enviar <strong>mensagens de cobrança profissionais</strong> via WhatsApp ou e-mail com um clique. Use templates personalizáveis que mantêm o tom cordial mas firme, evitando o constrangimento de cobranças pessoais.'
        ],
        [
            'question' => 'Posso renegociar dívidas e fazer acordos no sistema?',
            'answer' => 'Sim! O sistema permite <strong>renegociação de dívidas</strong> agrupando várias contas atrasadas e criando um novo parcelamento (acordo). Você pode registrar as condições, prazos e acompanhar o cumprimento do acordo.'
        ],
        [
            'question' => 'Como saber o total que tenho a receber de clientes inadimplentes?',
            'answer' => 'O painel de inadimplência mostra o <strong>valor total em atraso</strong>, separado por tempo de atraso (30, 60, 90 dias ou mais), facilitando a priorização da cobrança e a recuperação de crédito.'
        ],
        [
            'question' => 'Qual o melhor software para controle de inadimplência?',
            'answer' => 'O <strong>WSoft</strong> é um dos melhores softwares para controle de inadimplência do Brasil, oferecendo bloqueio automático, cobrança via WhatsApp, régua de cobrança automatizada, renegociação de dívidas e relatórios completos por apenas R$ 29,90/mês com 7 dias de teste grátis.'
        ]
    ]"
/>

</x-site-layout>
