@php
$structuredData = [
    [
        '@context' => 'https://schema.org',
        '@type' => 'SoftwareApplication',
        'name' => 'WSoft - CRM e Gestão Empresarial',
        'url' => 'https://www.wsoft.dev.br/landing/crm-gestao',
        'description' => 'Sistema de CRM completo com controle financeiro, gestão de estoque e vendas. Centralize sua empresa em um só lugar.',
        'operatingSystem' => 'Web',
        'applicationCategory' => 'BusinessApplication',
        'offers' => [
            '@type' => 'Offer',
            'price' => '29.90',
            'priceCurrency' => 'BRL',
            'url' => 'https://www.wsoft.dev.br/landing/crm-gestao',
            'description' => 'Plano mensal com todas as funcionalidades'
        ],
        'aggregateRating' => [
            '@type' => 'AggregateRating',
            'ratingValue' => '4.8',
            'ratingCount' => '156'
        ]
    ],
    [
        '@context' => 'https://schema.org',
        '@type' => 'HowTo',
        'name' => 'Como organizar sua empresa com WSoft',
        'description' => 'Passo a passo completo para implementar gestão financeira e CRM na sua empresa.',
        'step' => [
            [
                '@type' => 'HowToStep',
                'name' => 'Cadastre Clientes e Fornecedores',
                'text' => 'Centralize todos os contatos. Tenha histórico completo e dados acessíveis em um só lugar.',
                'position' => 1
            ],
            [
                '@type' => 'HowToStep',
                'name' => 'Organize o Financeiro',
                'text' => 'Lance contas a pagar e receber. Emita boletos e notas fiscais de forma simples.',
                'position' => 2
            ],
            [
                '@type' => 'HowToStep',
                'name' => 'Gerencie Vendas e Estoque',
                'text' => 'Controle seu estoque, faça orçamentos e acompanhe suas vendas em tempo real.',
                'position' => 3
            ],
            [
                '@type' => 'HowToStep',
                'name' => 'Analise Resultados',
                'text' => 'Use relatórios gerenciais para tomar decisões estratégicas e crescer com segurança.',
                'position' => 4
            ]
        ]
    ]
];
@endphp

<x-site-layout
    :title="'CRM e Gestão Empresarial | Controle Financeiro | WSoft'"
    :description="'Centralize clientes, vendas, financeiro e estoque. O CRM completo para pequenas empresas. Teste grátis por 7 dias!'"
    :keywords="'crm, gestão empresarial, controle financeiro, sistema de gestão, controle de estoque, vendas, emissão de boletos, sistema para pequenas empresas'"
    :canonical="'https://www.wsoft.dev.br/landing/crm-gestao'"
    :ogTitle="'O CRM Definitivo para Gestão e Financeiro | WSoft'"
    :ogDescription="'Diga adeus às planilhas. Centralize clientes, vendas e financeiro em uma única plataforma.'"
    :structuredData="$structuredData"
>

<x-site.hero
    badge="Gestão Completa e Simplificada"
    highlight="O CRM Definitivo para"
    title="Gestão Financeira"
    description="Centralize clientes, vendas, financeiro e estoque em uma única plataforma. Diga adeus às planilhas e assuma o controle do seu negócio. <span class='text-emerald-400 font-bold block mt-2'>Apenas R$ 29,90/mês.</span>"
    primaryButtonText="Teste grátis por 7 dias"
    primaryButtonUrl="/app/register"
>
    <div class="relative">
        <div class="absolute -inset-4 bg-gradient-to-r from-emerald-500 to-cyan-500 rounded-full blur-3xl opacity-20 animate-pulse"></div>
        <div class="bg-white/10 border border-white/20 rounded-3xl p-8 backdrop-blur-md shadow-2xl relative">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <p class="text-sm uppercase text-emerald-200 font-semibold tracking-wider">Faturamento Mês</p>
                    <h3 class="text-3xl font-bold mt-1">R$ 45.280,00</h3>
                    <div class="flex items-center gap-2 mt-2">
                        <span class="text-xs font-bold text-green-400 bg-green-400/10 px-2 py-0.5 rounded">+ 15% vs mês anterior</span>
                    </div>
                </div>
                <div class="h-12 w-12 rounded-full bg-emerald-500/20 flex items-center justify-center border border-emerald-400/30">
                    <i class="fa-solid fa-chart-line text-emerald-300 text-xl"></i>
                </div>
            </div>
            <div class="space-y-4">
                <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                    <div class="flex items-center justify-between mb-2">
                        <p class="text-xs text-emerald-200">Vendas Hoje</p>
                        <span class="text-sm font-bold text-emerald-300">8 Vendas</span>
                    </div>
                    <div class="h-2 bg-emerald-950/50 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-emerald-400 to-cyan-400 w-[80%] rounded-full"></div>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                        <p class="text-xs text-emerald-200">Clientes</p>
                        <p class="text-2xl font-bold mt-1 text-white">1.250</p>
                    </div>
                    <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                        <p class="text-xs text-emerald-200">Propostas</p>
                        <p class="text-2xl font-bold mt-1 text-white">42</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-site.hero>

<x-site.comparison
    title="Sua empresa está crescendo ou sobrevivendo?"
    subtitle="Gestão Integrada"
    description="A falta de processos definidos impede o crescimento do seu negócio. Veja a diferença:"
    painTitle="Gestão Desconectada"
    :painItems="[
        'Planilhas que não conversam entre si',
        'Esquecimento de cobranças e follow-up',
        'Sem histórico de relacionamento com clientes',
        'Decisões baseadas em achismo'
    ]"
    gainTitle="Gestão WSoft"
    :gainItems="[
        'Dados centralizados em um só lugar',
        'Automação de cobranças e lembretes',
        'Histórico completo de cada cliente',
        'Visão 360º do negócio em tempo real'
    ]"
    gainCardBg="bg-blue-900"
    gainCardBorder="border-blue-800"
    gainTitleColor="text-emerald-400"
    gainCheckColor="text-emerald-400"
    gainBadgeBg="bg-blue-500"
    gainBadgeText="COM WSOFT"
/>

<div class="bg-slate-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <a href="/app/register" class="inline-flex items-center gap-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-8 py-4 rounded-xl shadow-lg shadow-emerald-500/20 hover:shadow-emerald-500/40 transform hover:-translate-y-0.5 transition-all duration-300">
            <span>Testar Gratuitamente</span>
            <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>
</div>

<section id="como-funciona" class="py-24 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-20">
            <p class="text-sm font-semibold text-emerald-600 uppercase tracking-[0.3em]">Passo a Passo</p>
            <h2 class="mt-4 text-3xl md:text-4xl font-bold text-slate-900">Como funciona a Gestão WSoft</h2>
            <p class="mt-4 text-lg text-slate-600">Sistema completo para organizar e crescer sua empresa.</p>
        </div>

        <div class="space-y-24">
            <!-- Step 1 - Cadastro -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 group">
                        <div class="absolute inset-0 bg-emerald-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="/images/crm/registration.png" alt="Cadastro de Clientes" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-emerald-100 text-emerald-700 font-bold text-xl">1</span>
                        <h3 class="text-2xl font-bold text-slate-900">Cadastre Clientes e Produtos</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Centralize todos os dados em um só lugar. Tenha histórico completo, dados de contato e informações de estoque sempre à mão.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Cadastro completo de clientes e fornecedores</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Controle de estoque e serviços</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Importação de dados simplificada</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Step 2 - Vendas -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-1">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-emerald-100 text-emerald-700 font-bold text-xl">2</span>
                        <h3 class="text-2xl font-bold text-slate-900">Gere Orçamentos e Vendas</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Crie orçamentos profissionais em segundos. Envie por WhatsApp e transforme em venda com apenas um clique.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Emissão de orçamentos e pedidos</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Envio direto por WhatsApp e E-mail</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Controle de comissões</span>
                        </li>
                    </ul>
                </div>
                <div class="order-2">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 group">
                        <div class="absolute inset-0 bg-emerald-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="/images/crm/dashboard-preview.png" alt="Gestão de Vendas" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
            </div>

            <!-- Step 3 - Financeiro -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 group">
                        <div class="absolute inset-0 bg-emerald-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="/images/crm/reports.png" alt="Controle Financeiro" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-emerald-100 text-emerald-700 font-bold text-xl">3</span>
                        <h3 class="text-2xl font-bold text-slate-900">Controle o Financeiro</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Contas a pagar, receber e fluxo de caixa integrados. Emita boletos e notas fiscais sem complicação.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Fluxo de caixa e DRE</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Emissão de Boletos e Notas Fiscais</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Alertas de cobrança automáticos</span>
                        </li>
                    </ul>
                </div>
            </div>

        </div>

            <!-- Step 4 - Dashboard -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-1">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-emerald-100 text-emerald-700 font-bold text-xl">4</span>
                        <h3 class="text-2xl font-bold text-slate-900">Visão Geral do Negócio</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Tenha o controle total na palma da mão. Acompanhe gráficos, faturamento e alertas importantes em um único painel inteligente.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Resumo financeiro diário</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Gráficos de desempenho</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Alertas de pendências</span>
                        </li>
                    </ul>
                </div>
                <div class="order-2">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 group">
                        <div class="absolute inset-0 bg-emerald-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="{{ asset('images/sistema/dashboard/visao-geral.png') }}" alt="Dashboard Visão Geral" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
            </div>

        </div>

        <div class="mt-16 text-center">
            <a href="/app/register" class="inline-flex items-center gap-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-8 py-4 rounded-xl shadow-lg shadow-emerald-500/20 hover:shadow-emerald-500/40 transform hover:-translate-y-0.5 transition-all duration-300">
                <span>Testar Gratuitamente</span>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<section id="beneficios" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <p class="text-sm font-semibold text-emerald-600 uppercase tracking-[0.3em]">Benefícios</p>
            <h2 class="mt-4 text-3xl md:text-4xl font-bold">Por que escolher o WSoft CRM?</h2>
            <p class="mt-4 text-lg text-slate-600">A ferramenta certa para impulsionar seu crescimento</p>
        </div>
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-rocket text-emerald-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Agilidade</h3>
                    <p class="mt-3 text-slate-600">Automatize tarefas repetitivas e ganhe tempo para focar no que realmente importa: vender.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-chart-pie text-blue-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Visão 360º</h3>
                    <p class="mt-3 text-slate-600">Acompanhe todos os números da sua empresa em um único painel intuitivo.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-users text-purple-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Fidelização</h3>
                    <p class="mt-3 text-slate-600">Conheça melhor seus clientes e ofereça um atendimento personalizado e eficiente.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-shield-halved text-orange-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Segurança</h3>
                    <p class="mt-3 text-slate-600">Seus dados protegidos em nuvem com backup automático diário e criptografia.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-file-invoice-dollar text-red-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Redução de Inadimplência</h3>
                    <p class="mt-3 text-slate-600">Lembretes automáticos de cobrança ajudam a manter seu fluxo de caixa saudável.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-teal-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-mobile-screen text-teal-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Acesso Mobile</h3>
                    <p class="mt-3 text-slate-600">Acesse seu sistema de qualquer lugar, pelo computador, tablet ou celular.</p>
                </div>
            </article>
        </div>

        <div class="mt-16 flex flex-col md:flex-row justify-center items-center gap-4">
            <a href="/app/register" class="inline-flex items-center gap-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-8 py-4 rounded-xl shadow-lg shadow-emerald-500/20 hover:shadow-emerald-500/40 transform hover:-translate-y-0.5 transition-all duration-300">
                <span>Testar Gratuitamente</span>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
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

<section class="py-24 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mt-16 text-center">
            <x-site.cta-inline
                title="Sua empresa merece uma gestão profissional"
                description="Pare de perder tempo com planilhas e processos manuais. O WSoft é a solução completa que integra todos os setores da sua empresa."
                buttonText="Falar no WhatsApp"
                buttonUrl="https://wa.me/5551999350578"
                gradient="from-blue-900 to-blue-700"
                icon="fa-solid fa-building"
            />
        </div>

        <div class="mt-8 text-center">
            <a href="/app/register" class="inline-flex items-center gap-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-8 py-4 rounded-xl shadow-lg shadow-emerald-500/20 hover:shadow-emerald-500/40 transform hover:-translate-y-0.5 transition-all duration-300">
                <span>Testar Gratuitamente</span>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<x-site.cta-final
    :title="'Escolha a melhor gestão para sua empresa'"
    :description="'Comece agora com 7 dias de teste grátis. Use o melhor <strong>sistema de CRM e Gestão Empresarial</strong> por apenas <span class=\'text-yellow-300 font-bold\'>R$ 29,90/mês</span>.'"
    :footer="'Junte-se a centenas de empresas que usam WSoft'"
    :gradient="'bg-gradient-to-br from-blue-950 to-blue-700'"
    :textColor="'text-blue-50'"
    :highlightColor="'text-yellow-300'"
/>

@livewire('landing-registration-form', [
    'source' => 'landing_crm',
    'title' => 'Comece agora gratuitamente',
    'subtitle' => 'Junte-se a centenas de empresas que já transformaram sua gestão com o WSoft.',
    'gradient' => 'from-blue-900 to-blue-700',
    'buttonText' => 'Testar por 7 Dias Grátis',
    'buttonColor' => 'blue',
    'focusColor' => 'blue'
])

<x-site.faq
    title="Perguntas Frequentes sobre o CRM WSoft"
    subtitle="FAQ"
    subtitleColor="text-blue-600"
    :questions="[
        [
            'question' => 'O sistema serve para minha empresa?',
            'answer' => 'O WSoft é ideal para prestadores de serviços, comércios, oficinas e pequenas empresas que precisam organizar vendas, financeiro e clientes em um só lugar.'
        ],
        [
            'question' => 'Consigo importar meus dados atuais?',
            'answer' => 'Sim! Você pode cadastrar seus clientes e produtos facilmente. Nossa equipe de suporte também pode auxiliar na migração de dados.'
        ],
        [
            'question' => 'O sistema emite notas fiscais?',
            'answer' => 'Sim! O WSoft é um emissor completo de NF-e, NFS-e e NFC-e, integrado ao seu financeiro e vendas.'
        ],
        [
            'question' => 'Como funciona o teste grátis?',
            'answer' => 'Você tem 7 dias de acesso total a todas as funcionalidades do sistema, sem compromisso e sem necessidade de cartão de crédito. É só se cadastrar e usar.'
        ],
        [
            'question' => 'Preciso instalar algo no computador?',
            'answer' => 'Não! O WSoft é 100% em nuvem (online). Você acessa pelo navegador do seu computador, tablet ou celular, de onde estiver.'
        ],
        [
            'question' => 'Os dados da minha empresa estão seguros?',
            'answer' => 'Sim, utilizamos servidores de alta performance com backups diários automáticos e criptografia de ponta para garantir a segurança das suas informações.'
        ]
    ]"
/>

</x-site-layout>
