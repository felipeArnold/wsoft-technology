@php
$structuredData = [
    [
        '@context' => 'https://schema.org',
        '@type' => 'Organization',
        'name' => 'WSoft Tecnologia',
        'url' => 'https://www.wsoft.dev.br/software-sob-medida',
        'description' => 'Software House especializada em desenvolvimento de software sob medida para pequenas e médias empresas. Soluções personalizadas que atendem às necessidades específicas do seu negócio.',
        'logo' => 'https://www.wsoft.dev.br/images/logo.png',
        'sameAs' => [
            'https://www.wsoft.dev.br'
        ],
        'address' => [
            '@type' => 'PostalAddress',
            'addressLocality' => 'Rolante',
            'addressRegion' => 'RS',
            'addressCountry' => 'BR'
        ]
    ],
    [
        '@context' => 'https://schema.org',
        '@type' => 'Service',
        'serviceType' => 'Desenvolvimento de Software Sob Medida',
        'provider' => [
            '@type' => 'Organization',
            'name' => 'WSoft Tecnologia'
        ],
        'areaServed' => 'BR',
        'description' => 'Desenvolvimento de software personalizado para empresas. Sistemas web, aplicativos móveis e integrações customizadas.'
    ],
    [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => [
            [
                '@type' => 'Question',
                'name' => 'O que é software sob medida?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Software sob medida é um sistema desenvolvido especificamente para atender às necessidades únicas da sua empresa, diferente de soluções prontas de prateleira.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'Quanto tempo leva para desenvolver um software personalizado?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'O prazo varia de acordo com a complexidade do projeto, mas geralmente entre 2 a 6 meses, com entregas incrementais durante o desenvolvimento.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'Por que escolher a WSoft para desenvolver meu software?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'A WSoft combina experiência em desenvolvimento com profundo conhecimento em gestão empresarial, garantindo soluções técnicas que realmente resolvem problemas de negócio.'
                ]
            ]
        ]
    ],
    [
        '@context' => 'https://schema.org',
        '@type' => 'HowTo',
        'name' => 'Como desenvolvemos seu software sob medida',
        'description' => 'Metodologia ágil com entregas incrementais e feedback constante.',
        'step' => [
            [
                '@type' => 'HowToStep',
                'name' => 'Descoberta e Análise',
                'text' => 'Mergulhamos profundamente no seu negócio para entender seus desafios, processos e objetivos. Cada detalhe importa para criar a solução perfeita.',
                'position' => 1
            ],
            [
                '@type' => 'HowToStep',
                'name' => 'Design e Prototipação',
                'text' => 'Antes de escrever uma linha de código, você visualiza exatamente como será seu software. Aprovações claras em cada etapa.',
                'position' => 2
            ],
            [
                '@type' => 'HowToStep',
                'name' => 'Desenvolvimento Ágil',
                'text' => 'Desenvolvemos em sprints de 2 semanas com entregas incrementais. Você acompanha a evolução e pode testar funcionalidades antes da conclusão final.',
                'position' => 3
            ],
            [
                '@type' => 'HowToStep',
                'name' => 'Testes e Homologação',
                'text' => 'Rigoroso processo de testes para garantir que tudo funcione perfeitamente. Sua equipe valida cada funcionalidade antes do lançamento.',
                'position' => 4
            ],
            [
                '@type' => 'HowToStep',
                'name' => 'Implantação e Treinamento',
                'text' => 'Colocamos seu software em produção com todo suporte necessário. Sua equipe recebe treinamento completo para usar todas as funcionalidades.',
                'position' => 5
            ]
        ]
    ]
];
@endphp

<x-site-layout
    :title="'Software Sob Medida | Desenvolvimento Personalizado | WSoft'"
    :description="'Software House especializada em desenvolvimento de software sob medida. Transforme suas ideias em sistemas que impulsionam seu negócio. Consultoria grátis!'"
    :keywords="'software sob medida, desenvolvimento de software, software personalizado, software house, sistema customizado, desenvolvimento web, aplicativo personalizado, software empresarial, sistema sob medida, desenvolvimento de sistemas'"
    :canonical="'https://www.wsoft.dev.br/software-sob-medida'"
    :ogTitle="'Software Sob Medida para Sua Empresa | WSoft'"
    :ogDescription="'Software House especializada em criar soluções sob medida que atendem às necessidades específicas do seu negócio. Consultoria gratuita!'"
    :structuredData="$structuredData"
>

<x-site.hero
    badge="Software House"
    highlight="Software Sob Medida"
    title="para Sua Empresa"
    description="Não se limite a sistemas prontos. Tenha um software desenvolvido especificamente para as necessidades do seu negócio, com as funcionalidades que você realmente precisa."
    :idealFor="['Empresas que precisam de soluções específicas', 'Negócios com processos únicos', 'Empresas em crescimento', 'Organizações que buscam diferencial competitivo']"
>
    <div class="relative">
        <div class="absolute -inset-4 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full blur-3xl opacity-20 animate-pulse"></div>
        <div class="bg-white/10 border border-white/20 rounded-3xl p-8 backdrop-blur-md shadow-2xl relative">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <p class="text-sm uppercase text-blue-200 font-semibold tracking-wider">Nossa Especialidade</p>
                    <h3 class="text-3xl font-bold mt-1">Desenvolvimento Personalizado</h3>
                    <div class="flex items-center gap-2 mt-2">
                        <span class="text-xs font-bold text-green-400 bg-green-400/10 px-2 py-0.5 rounded">100% Customizado</span>
                    </div>
                </div>
                <div class="h-12 w-12 rounded-full bg-blue-500/20 flex items-center justify-center border border-blue-400/30">
                    <i class="fa-solid fa-code text-blue-300 text-xl"></i>
                </div>
            </div>
            <div class="space-y-4">
                <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                    <div class="flex items-center justify-between mb-2">
                        <p class="text-xs text-blue-200">Tecnologias Modernas</p>
                        <span class="text-sm font-bold text-blue-300">Web & Mobile</span>
                    </div>
                    <div class="h-2 bg-blue-950/50 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-blue-400 to-purple-400 w-[90%] rounded-full"></div>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                        <p class="text-xs text-blue-200">Projetos Concluídos</p>
                        <p class="text-2xl font-bold mt-1 text-green-400">50+</p>
                    </div>
                    <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                        <p class="text-xs text-blue-200">Clientes Satisfeitos</p>
                        <p class="text-2xl font-bold mt-1 text-blue-400">45+</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-site.hero>

<!-- Pain vs Gain -->
<x-site.comparison
    title="Por que investir em software sob medida?"
    subtitle="Software Personalizado vs Sistema Pronto"
    description="Sistemas prontos não atendem todas as necessidades. Veja a diferença entre usar uma solução genérica e ter seu próprio software:"
    painTitle="Sistema Pronto (Off-the-shelf)"
    :painItems="[
    'Paga por funcionalidades que não usa',
    'Precisa adaptar seus processos ao sistema',
    'Limitado às funcionalidades disponíveis',
    'Depende de atualizações de terceiros',
    'Dificuldade de integração com outros sistemas',
    'Licenças caras e recorrentes'
]"
    gainTitle="Software Sob Medida WSoft"
    :gainItems="[
    'Sistema desenvolvido para seus processos',
    'Funcionalidades exatamente como você precisa',
    'Escalável conforme seu negócio cresce',
    'Integração nativa com seus sistemas atuais',
    'Propriedade completa do código',
    'Suporte direto do time de desenvolvimento'
]"
    gainCardBg="bg-blue-900"
    gainCardBorder="border-blue-800"
    gainTitleColor="text-blue-400"
    gainCheckColor="text-blue-400"
    gainBadgeBg="bg-blue-500"
    gainBadgeText="COM WSOFT"
/>

<!-- How it Works -->
<section id="como-funciona" class="py-24 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-20">
            <p class="text-sm font-semibold text-blue-600 uppercase tracking-[0.3em]">Processo de Desenvolvimento</p>
            <h2 class="mt-4 text-3xl md:text-4xl font-bold text-slate-900">Como desenvolvemos seu software</h2>
            <p class="mt-4 text-lg text-slate-600">Metodologia ágil com entregas incrementais e feedback constante.</p>
        </div>

        <div class="space-y-24">
            <!-- Step 1 - Descoberta -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 group">
                        <div class="absolute inset-0 bg-blue-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="/images/crm/registration.png" alt="Descoberta e Análise" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-blue-100 text-blue-700 font-bold text-xl">1</span>
                        <h3 class="text-2xl font-bold text-slate-900">Descoberta e Análise</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Mergulhamos profundamente no seu negócio para entender seus desafios, processos e objetivos. Cada detalhe importa para criar a solução perfeita.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-blue-500"></i>
                            <span>Reuniões de imersão com sua equipe</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-blue-500"></i>
                            <span>Mapeamento completo dos processos</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-blue-500"></i>
                            <span>Definição de requisitos funcionais</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-blue-500"></i>
                            <span>Estimativa de prazo e investimento</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Step 2 - Design e Prototipação -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-1">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-blue-100 text-blue-700 font-bold text-xl">2</span>
                        <h3 class="text-2xl font-bold text-slate-900">Design e Prototipação</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Antes de escrever uma linha de código, você visualiza exatamente como será seu software. Aprovações claras em cada etapa.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-blue-500"></i>
                            <span>Wireframes e mockups de telas</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-blue-500"></i>
                            <span>Protótipo interativo navegável</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-blue-500"></i>
                            <span>Validação de fluxos de usuário</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-blue-500"></i>
                            <span>Ajustes baseados no seu feedback</span>
                        </li>
                    </ul>
                </div>
                <div class="order-2">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 group">
                        <div class="absolute inset-0 bg-blue-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="/images/crm/dashboard-preview.png" alt="Design e Prototipação" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
            </div>

            <!-- Step 3 - Desenvolvimento -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 group">
                        <div class="absolute inset-0 bg-blue-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="/images/crm/history.png" alt="Desenvolvimento" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-blue-100 text-blue-700 font-bold text-xl">3</span>
                        <h3 class="text-2xl font-bold text-slate-900">Desenvolvimento Ágil</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Desenvolvemos em sprints de 2 semanas com entregas incrementais. Você acompanha a evolução e pode testar funcionalidades antes da conclusão final.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-blue-500"></i>
                            <span>Código limpo e documentado</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-blue-500"></i>
                            <span>Entregas parciais funcionais</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-blue-500"></i>
                            <span>Testes automatizados de qualidade</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-blue-500"></i>
                            <span>Reuniões de acompanhamento semanais</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Step 4 - Testes e Homologação -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-1">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-blue-100 text-blue-700 font-bold text-xl">4</span>
                        <h3 class="text-2xl font-bold text-slate-900">Testes e Homologação</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Rigoroso processo de testes para garantir que tudo funcione perfeitamente. Sua equipe valida cada funcionalidade antes do lançamento.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-blue-500"></i>
                            <span>Testes funcionais completos</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-blue-500"></i>
                            <span>Testes de performance e segurança</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-blue-500"></i>
                            <span>Validação com usuários reais</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-blue-500"></i>
                            <span>Correções e ajustes finais</span>
                        </li>
                    </ul>
                </div>
                <div class="order-2">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 group">
                        <div class="absolute inset-0 bg-blue-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="/images/crm/reports.png" alt="Testes e Homologação" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
            </div>

            <!-- Step 5 - Implantação e Treinamento -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 group">
                        <div class="absolute inset-0 bg-blue-900/10 group-hover:bg-transparent transition duration-500"></div>
                        <img src="/images/crm/dashboard-preview.png" alt="Implantação" class="w-full h-auto transform group-hover:scale-105 transition duration-700" loading="lazy" decoding="async">
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-blue-100 text-blue-700 font-bold text-xl">5</span>
                        <h3 class="text-2xl font-bold text-slate-900">Implantação e Treinamento</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Colocamos seu software em produção com todo suporte necessário. Sua equipe recebe treinamento completo para usar todas as funcionalidades.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-blue-500"></i>
                            <span>Deploy em ambiente de produção</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-blue-500"></i>
                            <span>Treinamento prático da equipe</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-blue-500"></i>
                            <span>Documentação completa do sistema</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-blue-500"></i>
                            <span>Suporte pós-lançamento garantido</span>
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
            <p class="text-sm font-semibold text-blue-600 uppercase tracking-[0.3em]">Vantagens</p>
            <h2 class="mt-4 text-3xl md:text-4xl font-bold">Por que escolher a WSoft como sua Software House?</h2>
            <p class="mt-4 text-lg text-slate-600">Experiência, tecnologia e foco em resultados para o seu negócio</p>
        </div>
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-lightbulb text-blue-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Solução Única</h3>
                    <p class="mt-3 text-slate-600">Software desenvolvido especificamente para seus processos e necessidades, não o contrário.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-rocket text-purple-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Tecnologia Moderna</h3>
                    <p class="mt-3 text-slate-600">Utilizamos as melhores tecnologias do mercado para garantir performance, segurança e escalabilidade.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-chart-line text-green-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Escalável</h3>
                    <p class="mt-3 text-slate-600">Software preparado para crescer junto com seu negócio, sem limitações de licenças ou usuários.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-handshake text-orange-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Parceria de Longo Prazo</h3>
                    <p class="mt-3 text-slate-600">Não entregamos e sumimos. Somos seu parceiro tecnológico para evolução contínua do sistema.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-shield-halved text-red-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Propriedade do Código</h3>
                    <p class="mt-3 text-slate-600">O código fonte é 100% seu. Total independência e segurança para o seu investimento.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-teal-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-plug text-teal-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Integração Total</h3>
                    <p class="mt-3 text-slate-600">Conectamos seu novo software com sistemas existentes, ERPs, APIs e serviços externos.</p>
                </div>
            </article>
        </div>

        <div class="text-center mt-16">
            <a
                href="https://wa.me/5551999350578"
                target="_blank"
                rel="noopener noreferrer"
                class="inline-flex items-center gap-3 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-500 hover:to-purple-500 text-white font-bold px-8 py-4 rounded-xl shadow-lg shadow-blue-500/20 hover:shadow-blue-500/40 transform hover:-translate-y-0.5 transition-all duration-300"
            >
                <i class="fa-brands fa-whatsapp text-xl"></i>
                <span>Solicitar Consultoria Grátis</span>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
            <p class="mt-4 text-sm text-slate-500">Sem compromisso. Vamos conversar sobre seu projeto.</p>
        </div>
    </div>
</section>

<!-- Tecnologias -->
<section class="py-24 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <p class="text-sm font-semibold text-blue-600 uppercase tracking-[0.3em]">Stack Tecnológico</p>
            <h2 class="mt-4 text-3xl md:text-4xl font-bold text-slate-900">Tecnologias que Utilizamos</h2>
            <p class="mt-4 text-lg text-slate-600">As melhores ferramentas para criar software robusto e confiável</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 hover:shadow-lg transition">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mb-4">
                    <i class="fa-brands fa-react text-blue-600 text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900">Frontend Moderno</h3>
                <p class="mt-2 text-sm text-slate-600">React, Vue.js, Angular, Tailwind CSS</p>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 hover:shadow-lg transition">
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mb-4">
                    <i class="fa-brands fa-node text-green-600 text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900">Backend Robusto</h3>
                <p class="mt-2 text-sm text-slate-600">Node.js, Laravel, Python, .NET</p>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 hover:shadow-lg transition">
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mb-4">
                    <i class="fa-solid fa-database text-purple-600 text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900">Bancos de Dados</h3>
                <p class="mt-2 text-sm text-slate-600">PostgreSQL, MySQL, MongoDB, Redis</p>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 hover:shadow-lg transition">
                <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center mb-4">
                    <i class="fa-brands fa-aws text-orange-600 text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900">Cloud & DevOps</h3>
                <p class="mt-2 text-sm text-slate-600">AWS, Azure, Docker, Kubernetes</p>
            </div>
        </div>
    </div>
</section>

<!-- Tipos de Projetos -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <p class="text-sm font-semibold text-blue-600 uppercase tracking-[0.3em]">Nossos Serviços</p>
            <h2 class="mt-4 text-3xl md:text-4xl font-bold">Tipos de Software que Desenvolvemos</h2>
            <p class="mt-4 text-lg text-slate-600">Soluções completas para diversos segmentos e necessidades</p>
        </div>

        <div class="grid md:grid-cols-2 gap-8">
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-8 rounded-2xl border border-blue-200">
                <div class="w-14 h-14 bg-blue-500 rounded-xl flex items-center justify-center mb-4">
                    <i class="fa-solid fa-desktop text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-slate-900">Sistemas Web</h3>
                <p class="mt-3 text-slate-700">Plataformas web completas, dashboards gerenciais, portais corporativos e aplicações SaaS.</p>
                <ul class="mt-4 space-y-2 text-sm text-slate-700">
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check-circle text-blue-500"></i> ERPs customizados</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check-circle text-blue-500"></i> CRMs personalizados</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check-circle text-blue-500"></i> Sistemas de gestão</li>
                </ul>
            </div>

            <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-8 rounded-2xl border border-purple-200">
                <div class="w-14 h-14 bg-purple-500 rounded-xl flex items-center justify-center mb-4">
                    <i class="fa-solid fa-mobile-screen-button text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-slate-900">Aplicativos Mobile</h3>
                <p class="mt-3 text-slate-700">Apps nativos para iOS e Android, ou cross-platform com React Native e Flutter.</p>
                <ul class="mt-4 space-y-2 text-sm text-slate-700">
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check-circle text-purple-500"></i> Apps para clientes</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check-circle text-purple-500"></i> Apps internos</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check-circle text-purple-500"></i> Apps de vendas</li>
                </ul>
            </div>

            <div class="bg-gradient-to-br from-green-50 to-green-100 p-8 rounded-2xl border border-green-200">
                <div class="w-14 h-14 bg-green-500 rounded-xl flex items-center justify-center mb-4">
                    <i class="fa-solid fa-plug text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-slate-900">APIs e Integrações</h3>
                <p class="mt-3 text-slate-700">Desenvolvimento de APIs REST, integrações entre sistemas e automações de processos.</p>
                <ul class="mt-4 space-y-2 text-sm text-slate-700">
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check-circle text-green-500"></i> APIs RESTful</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check-circle text-green-500"></i> Integrações ERP</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check-circle text-green-500"></i> Automações</li>
                </ul>
            </div>

            <div class="bg-gradient-to-br from-orange-50 to-orange-100 p-8 rounded-2xl border border-orange-200">
                <div class="w-14 h-14 bg-orange-500 rounded-xl flex items-center justify-center mb-4">
                    <i class="fa-solid fa-store text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-slate-900">E-commerce Personalizado</h3>
                <p class="mt-3 text-slate-700">Lojas virtuais sob medida com funcionalidades específicas para seu modelo de negócio.</p>
                <ul class="mt-4 space-y-2 text-sm text-slate-700">
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check-circle text-orange-500"></i> Marketplaces</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check-circle text-orange-500"></i> B2B/B2C</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check-circle text-orange-500"></i> Subscriptions</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<x-site.cta-final
    :title="'Transforme sua ideia em realidade com a WSoft'"
    :description="'Agende uma consultoria gratuita e descubra como um <strong>software sob medida</strong> pode revolucionar seu negócio. Sem compromisso, vamos entender seus desafios e apresentar soluções.'"
    :footer="'Junte-se a dezenas de empresas que já transformaram seus negócios com software personalizado'"
    :gradient="'bg-gradient-to-br from-blue-950 to-purple-900'"
    :textColor="'text-blue-50'"
    :highlightColor="'text-yellow-300'"
/>

<x-site.cta-whatsapp
    title="Solicite uma Consultoria Gratuita"
    subtitle="Vamos conversar sobre seu projeto e apresentar as melhores soluções para suas necessidades."
    buttonText="Agendar Consultoria Grátis"
    gradient="from-blue-900 to-purple-900"
/>

<!-- FAQ -->
<x-site.faq
    title="Perguntas Frequentes sobre Software Sob Medida"
    subtitle="FAQ"
    subtitleColor="text-blue-600"
    :questions="[
        [
            'question' => 'O que é software sob medida?',
            'answer' => '<strong>Software sob medida</strong> é um sistema desenvolvido especificamente para atender às necessidades únicas da sua empresa. Diferente de soluções prontas (off-the-shelf), o software personalizado é criado do zero com funcionalidades exatamente como você precisa, adaptando-se aos seus processos de negócio ao invés de forçar sua empresa a se adaptar ao software.'
        ],
        [
            'question' => 'Quanto tempo leva para desenvolver um software personalizado?',
            'answer' => 'O prazo de desenvolvimento varia conforme a complexidade e escopo do projeto. Projetos simples podem levar de <strong>2 a 3 meses</strong>, enquanto sistemas mais complexos podem precisar de <strong>4 a 6 meses</strong> ou mais. Utilizamos <strong>metodologia ágil</strong> com entregas incrementais, então você pode começar a usar partes do sistema antes da conclusão total.'
        ],
        [
            'question' => 'Quanto custa desenvolver um software sob medida?',
            'answer' => 'O investimento depende da complexidade, quantidade de funcionalidades, integrações necessárias e tecnologias utilizadas. Projetos podem variar de <strong>R$ 15.000 a R$ 150.000+</strong>. Oferecemos uma <strong>consultoria gratuita</strong> para analisar suas necessidades e apresentar um orçamento detalhado e transparente, sem compromisso.'
        ],
        [
            'question' => 'Quais as vantagens de um software sob medida comparado a um sistema pronto?',
            'answer' => 'Com <strong>software personalizado</strong> você tem: funcionalidades exatamente como precisa, adaptação total aos seus processos, escalabilidade sem limitações de licenças, integração nativa com seus sistemas atuais, propriedade completa do código-fonte, suporte direto do time de desenvolvimento, e não paga por recursos que não usa. Sistemas prontos são genéricos e forçam sua empresa a se adaptar a eles.'
        ],
        [
            'question' => 'Posso fazer mudanças no software depois que ele estiver pronto?',
            'answer' => 'Sim! Como você é o <strong>proprietário do código</strong>, pode fazer qualquer alteração ou adicionar novas funcionalidades quando quiser. Oferecemos contratos de <strong>manutenção e evolução</strong> para continuar desenvolvendo novas features, ou você pode contratar outro desenvolvedor caso prefira. Não há lock-in ou dependência obrigatória.'
        ],
        [
            'question' => 'Vocês fazem integração com sistemas que já uso na empresa?',
            'answer' => 'Sim! Fazemos <strong>integrações completas</strong> com ERPs, sistemas legados, plataformas de pagamento, APIs de terceiros, ferramentas de e-mail, WhatsApp, marketplaces e praticamente qualquer sistema que tenha uma API ou banco de dados acessível. Analisamos seu ecossistema tecnológico atual e desenvolvemos as integrações necessárias.'
        ],
        [
            'question' => 'Como funciona o processo de desenvolvimento?',
            'answer' => 'Seguimos uma <strong>metodologia ágil</strong> com 5 etapas principais: <strong>1) Descoberta</strong> - entendemos seu negócio e necessidades; <strong>2) Design e Prototipação</strong> - você aprova as telas e fluxos antes do desenvolvimento; <strong>3) Desenvolvimento em Sprints</strong> - entregas incrementais a cada 2 semanas; <strong>4) Testes e Homologação</strong> - validação completa com sua equipe; <strong>5) Implantação e Treinamento</strong> - colocamos em produção e treinamos seus usuários.'
        ],
        [
            'question' => 'Por que escolher a WSoft para desenvolver meu software?',
            'answer' => 'A WSoft combina <strong>experiência técnica</strong> com <strong>profundo conhecimento em gestão empresarial</strong>. Não somos apenas programadores - entendemos de negócios e processos. Já desenvolvemos dezenas de projetos bem-sucedidos, usamos tecnologias modernas, oferecemos propriedade total do código, mantemos comunicação clara durante todo o projeto e somos seu parceiro de longo prazo para evolução contínua do sistema.'
        ]
    ]"
/>

</x-site-layout>
