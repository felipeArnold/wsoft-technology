@php
$structuredData = [
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
                'name' => 'Revenda Oficina',
                'item' => 'https://www.wsoft.dev.br/revenda-sistema-oficina'
            ]
        ]
    ],
    [
        '@context' => 'https://schema.org',
        '@type' => 'SoftwareApplication',
        'name' => 'WSoft - Revenda de Sistema para Oficina Mecânica',
        'url' => 'https://www.wsoft.dev.br/revenda-sistema-oficina',
        'description' => 'Lucre revendendo o sistema de gestão mais completo para oficinas mecânicas. Ganhe comissões recorrentes vitalícias. Sem custo inicial.',
        'operatingSystem' => 'Web',
        'applicationCategory' => 'BusinessApplication',
        'offers' => [
            '@type' => 'Offer',
            'price' => '0',
            'priceCurrency' => 'BRL',
            'url' => 'https://www.wsoft.dev.br/revenda-sistema-oficina',
            'description' => 'Programa de parceria para revenda de software sem custo inicial'
        ],
        'aggregateRating' => [
            '@type' => 'AggregateRating',
            'ratingValue' => '4.9',
            'ratingCount' => '150'
        ]
    ],
    [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => [
            [
                '@type' => 'Question',
                'name' => 'Preciso pagar para ser revendedor?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Não! O programa de revenda WSoft é totalmente gratuito. Você não paga taxa de adesão nem mensalidade.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'Como recebo minhas comissões?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Você recebe comissões recorrentes mensais sobre cada cliente ativo que indicar. Os pagamentos são feitos diretamente na sua conta bancária.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'Preciso dar suporte técnico?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Não. A WSoft cuida de todo o suporte técnico e atendimento ao cliente. Seu foco é apenas indicar e vender.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'Para quem posso vender?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Nosso sistema é focado em oficinas mecânicas, auto centers, funilarias, auto elétricas, troca de óleo e empresas do setor automotivo.'
                ]
            ]
        ]
    ]
];
@endphp

<x-site-layout
    :title="'Revenda de Sistema para Oficina Mecânica | Ganhe Dinheiro Revendendo Software'"
    :description="'Torne-se parceiro WSoft e lucre revendendo o melhor sistema para oficina mecânica. Comissões recorrentes, sem custo inicial. Mercado aquecido!'"
    :keywords="'revenda de sistema para oficina mecânica, software para oficina mecânica, revender software, ganhar dinheiro com software, sistema de gestão para oficina, programa para oficina mecânica'"
    :canonical="'https://www.wsoft.dev.br/revenda-sistema-oficina'"
    :ogTitle="'Lucre Revendendo Software para Oficinas Mecânicas'"
    :ogDescription="'Oportunidade de negócio sem investimento. Ganhe comissões recorrentes vitalícias revendendo o sistema líder para mecânicas.'"
    :structuredData="$structuredData"
>

<x-site.hero
    badge="Oportunidade de Negócio"
    highlight="Lucre Todo Mês"
    title="Revendendo Software"
    description="O mercado automotivo não para. Torne-se parceiro WSoft e ganhe comissões recorrentes vitalícias oferecendo um software que toda oficina mecânica precisa. Sem investimento inicial."
    primaryButtonText="Quero ser Revendedor"
    primaryButtonUrl="https://wa.me/5551999350578"
>
    <div class="relative">
        <div class="absolute -inset-4 bg-gradient-to-r from-blue-600 to-emerald-500 rounded-full blur-3xl opacity-20 animate-pulse"></div>
        <div class="bg-white/10 border border-white/20 rounded-3xl p-8 backdrop-blur-md shadow-2xl relative">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <p class="text-sm uppercase text-blue-200 font-semibold tracking-wider">Potencial de Ganho</p>
                    <h3 class="text-3xl font-bold mt-1 text-white">Renda Passiva</h3>
                    <div class="flex items-center gap-2 mt-2">
                        <span class="text-xs font-bold text-emerald-400 bg-emerald-400/10 px-2 py-0.5 rounded">Comissão Recorrente Vitalícia</span>
                    </div>
                </div>
                <div class="h-12 w-12 rounded-full bg-blue-500/20 flex items-center justify-center border border-blue-400/30">
                    <i class="fa-solid fa-chart-line text-blue-300 text-xl"></i>
                </div>
            </div>
            <div class="space-y-4">
                <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                    <div class="flex items-center justify-between mb-2">
                        <p class="text-xs text-blue-200">Clientes Indicados</p>
                        <span class="text-sm font-bold text-emerald-300">Crescimento Constante</span>
                    </div>
                    <div class="h-2 bg-blue-950/50 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-blue-400 to-emerald-400 w-[75%] rounded-full"></div>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                        <p class="text-xs text-blue-200">Investimento</p>
                        <p class="text-2xl font-bold mt-1 text-emerald-400">R$ 0</p>
                    </div>
                    <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                        <p class="text-xs text-blue-200">Mercado</p>
                        <p class="text-xl font-bold mt-1 text-white">Gigante</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-site.hero>

<!-- Market Opportunity -->
<section id="mercado" class="py-24 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <p class="text-sm font-semibold text-blue-600 uppercase tracking-[0.3em]">Oportunidade</p>
            <h2 class="mt-4 text-3xl md:text-4xl font-bold text-slate-900">Por que revender para Oficinas Mecânicas?</h2>
            <p class="mt-4 text-lg text-slate-600">Um mercado gigante, carente de tecnologia e altamente lucrativo.</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="bg-white rounded-2xl p-6 shadow-lg border border-slate-200 hover:-translate-y-1 transition-transform duration-300">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mb-4">
                    <i class="fa-solid fa-store text-blue-600 text-xl"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Mercado Aquecido</h3>
                <p class="text-slate-600 text-sm">Milhares de oficinas no Brasil precisam se digitalizar para sobreviver e crescer. A demanda é enorme.</p>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-lg border border-slate-200 hover:-translate-y-1 transition-transform duration-300">
                <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center mb-4">
                    <i class="fa-solid fa-file-invoice text-emerald-600 text-xl"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Produto Obrigatório</h3>
                <p class="text-slate-600 text-sm">Oficinas precisam emitir OS, NFE e controlar estoque. Não é um luxo, é uma necessidade básica.</p>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-lg border border-slate-200 hover:-translate-y-1 transition-transform duration-300">
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mb-4">
                    <i class="fa-solid fa-handshake text-purple-600 text-xl"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Fidelidade Alta</h3>
                <p class="text-slate-600 text-sm">Uma vez que a oficina implanta o sistema, raramente troca. Sua comissão é garantida por anos (LTV alto).</p>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-lg border border-slate-200 hover:-translate-y-1 transition-transform duration-300">
                <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center mb-4">
                    <i class="fa-solid fa-bolt text-orange-600 text-xl"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Venda Fácil</h3>
                <p class="text-slate-600 text-sm">O sistema WSoft é simples e intuitivo. Ofereça 7 dias grátis e o produto se vende sozinho.</p>
            </div>
        </div>
    </div>
</section>

<!-- Reseller Benefits -->
<section id="beneficios" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <p class="text-sm font-semibold text-blue-600 uppercase tracking-[0.3em]">Vantagens</p>
            <h2 class="mt-4 text-3xl md:text-4xl font-bold">Vantagens Exclusivas para Parceiros</h2>
            <p class="mt-4 text-lg text-slate-600">Lucro real, sem letras miúdas e com suporte total.</p>
        </div>
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-money-bill-trend-up text-green-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Comissão Recorrente</h3>
                    <p class="mt-3 text-slate-600">Receba mensalmente uma porcentagem sobre cada cliente ativo. Faça a venda uma vez e ganhe para sempre.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-ban text-blue-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Sem Custo de Entrada</h3>
                    <p class="mt-3 text-slate-600">Não cobramos taxa de adesão, franquia ou kit inicial. Você começa com custo zero e risco zero.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-check-double text-purple-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Produto Validado</h3>
                    <p class="mt-3 text-slate-600">Revenda um software com milhares de usuários satisfeitos, focado 100% nas necessidades reais das oficinas.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-headset text-orange-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Todo Suporte é Nosso</h3>
                    <p class="mt-3 text-slate-600">Nós cuidamos do suporte técnico do cliente final. Você não precisa resolver problemas técnicos, só vender.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-bullhorn text-red-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Material de Apoio</h3>
                    <p class="mt-3 text-slate-600">Receba apresentações, vídeos e materiais de marketing prontos para divulgar e convencer seus clientes.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-teal-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-chart-pie text-teal-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Painel de Controle</h3>
                    <p class="mt-3 text-slate-600">Acompanhe suas indicações e comissões em tempo real através de um painel exclusivo para parceiros.</p>
                </div>
            </article>
        </div>

        <div class="mt-16 text-center">
            <a href="https://wa.me/5551999350578" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-3 bg-blue-600 hover:bg-blue-700 text-white font-bold px-8 py-4 rounded-xl shadow-lg shadow-blue-500/20 hover:shadow-blue-500/40 transform hover:-translate-y-0.5 transition-all duration-300">
                <i class="fa-brands fa-whatsapp text-xl"></i>
                <span>Quero ser Parceiro Agora</span>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- Product Highlights -->
<section class="py-24 bg-slate-900 text-white relative overflow-hidden">
    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 30px 30px;"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div>
                <span class="text-emerald-400 font-bold tracking-wider uppercase text-sm">O Produto</span>
                <h2 class="mt-2 text-3xl md:text-4xl font-extrabold text-white">O Software que Seus Clientes Vão Amar</h2>
                <p class="mt-6 text-lg text-slate-300">
                    Facilite a vida do dono da oficina com recursos essenciais que eles procuram todos os dias. Você estará vendendo solução, não problema.
                </p>
                
                <div class="mt-10 space-y-6">
                    <div class="flex gap-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-emerald-500/10 rounded-xl flex items-center justify-center border border-emerald-500/20">
                            <i class="fa-solid fa-file-invoice text-emerald-400 text-xl"></i>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-white">Ordem de Serviço Digital</h4>
                            <p class="text-slate-400">Fim dos papéis. OS completa com fotos, checklist e envio por WhatsApp.</p>
                        </div>
                    </div>
                    
                    <div class="flex gap-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-blue-500/10 rounded-xl flex items-center justify-center border border-blue-500/20">
                            <i class="fa-solid fa-car text-blue-400 text-xl"></i>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-white">Consulta Placa FIPE</h4>
                            <p class="text-slate-400">Agilidade no cadastro e profissionalismo no orçamento. Puxa dados do veículo automaticamente.</p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-purple-500/10 rounded-xl flex items-center justify-center border border-purple-500/20">
                            <i class="fa-solid fa-money-bill-1-wave text-purple-400 text-xl"></i>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-white">Financeiro e Estoque</h4>
                            <p class="text-slate-400">Controle total de contas a pagar/receber e baixa automática de peças no estoque.</p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-orange-500/10 rounded-xl flex items-center justify-center border border-orange-500/20">
                            <i class="fa-solid fa-barcode text-orange-400 text-xl"></i>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-white">Emissão Fiscal (NFE)</h4>
                            <p class="text-slate-400">Integração simples para emitir nota fiscal de peças e serviços sem dor de cabeça.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="relative">
                <div class="absolute -inset-4 bg-gradient-to-r from-blue-500 to-emerald-500 rounded-full blur-3xl opacity-20"></div>
                <img src="/images/crm/dashboard-preview.png" alt="WSoft Sistema para Mecânica" class="relative rounded-2xl shadow-2xl border border-white/10" loading="lazy" decoding="async">
            </div>
        </div>
    </div>
</section>

<!-- How it Works -->
<section id="como-funciona" class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-20">
            <p class="text-sm font-semibold text-blue-600 uppercase tracking-[0.3em]">Passo a Passo</p>
            <h2 class="mt-4 text-3xl md:text-4xl font-bold text-slate-900">Como Começar a Faturar</h2>
            <p class="mt-4 text-lg text-slate-600">Simples, rápido e descomplicado.</p>
        </div>

        <div class="grid md:grid-cols-3 gap-12 relative">
            <!-- Connector Line (Desktop) -->
            <div class="hidden md:block absolute top-12 left-[16%] right-[16%] h-0.5 bg-slate-200 -z-10"></div>

            <div class="text-center bg-white p-6 relative">
                <div class="w-24 h-24 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-6 border-4 border-white shadow-lg">
                    <span class="text-3xl font-bold text-blue-600">1</span>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">Cadastre-se Grátis</h3>
                <p class="text-slate-600">Fale com nosso time e faça seu cadastro de parceiro. É rápido e sem burocracia.</p>
            </div>

            <div class="text-center bg-white p-6 relative">
                <div class="w-24 h-24 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-6 border-4 border-white shadow-lg">
                    <span class="text-3xl font-bold text-blue-600">2</span>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">Indique Oficinas</h3>
                <p class="text-slate-600">Use seu link exclusivo ou cadastre seus clientes. Ofereça 7 dias grátis para facilitar o fechamento.</p>
            </div>

            <div class="text-center bg-white p-6 relative">
                 <div class="w-24 h-24 bg-green-50 rounded-full flex items-center justify-center mx-auto mb-6 border-4 border-white shadow-lg">
                    <span class="text-3xl font-bold text-green-600">3</span>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">Receba Comissões</h3>
                <p class="text-slate-600">Acompanhe seus ganhos e receba mensalmente sua comissão recorrente na conta.</p>
            </div>
        </div>

        <div class="mt-16 text-center">
            <a href="https://wa.me/5551999350578" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-3 bg-blue-600 hover:bg-blue-700 text-white font-bold px-8 py-4 rounded-xl shadow-lg shadow-blue-500/20 hover:shadow-blue-500/40 transform hover:-translate-y-0.5 transition-all duration-300">
                <span>Começar Agora Mesmo</span>
            </a>
        </div>
    </div>
</section>

<!-- CTA Final -->
<x-site.cta-final
    :title="'Transforme seu Networking Automotivo em Renda'"
    :description="'Não deixe dinheiro na mesa. Comece hoje mesmo a revender a solução líder para oficinas mecânicas e construa sua renda passiva.'"
    :footer="'Junte-se aos parceiros de sucesso da WSoft'"
    :gradient="'bg-gradient-to-br from-blue-900 to-emerald-800'"
    :textColor="'text-white'"
    :highlightColor="'text-emerald-400'"
/>

<x-site.cta-whatsapp
    title="Ainda tem dúvidas sobre a parceria?"
    subtitle="Chame nosso gerente de parcerias no WhatsApp e entenda todos os detalhes."
    buttonText="Falar com Gerente"
    gradient="from-blue-600 to-blue-800"
/>

<x-site.faq
    title="Dúvidas sobre a Revenda"
    subtitle="FAQ"
    subtitleColor="text-blue-600"
    :questions="[
        [
            'question' => 'Quanto posso ganhar por indicação?',
            'answer' => 'Você ganha uma porcentagem recorrente da mensalidade de cada cliente enquanto ele estiver ativo. Quanto mais clientes você tiver, maior será sua renda mensal (efeito bola de neve).'
        ],
        [
            'question' => 'Existe vínculo empregatício?',
            'answer' => 'Não. A parceria é comercial, você tem total liberdade para trabalhar como e quando quiser, sem chefes ou horários fixos.'
        ],
        [
            'question' => 'O cliente paga para mim ou para a WSoft?',
            'answer' => 'O cliente paga diretamente para a WSoft. Nós cuidamos de toda a cobrança e burocracia, e repassamos sua comissão mensalmente.'
        ],
        [
            'question' => 'Preciso ter empresa aberta (CNPJ)?',
            'answer' => 'Não é obrigatório, mas é recomendado para emissão de nota fiscal dos seus serviços de representação. Você pode começar como pessoa física e formalizar depois.'
        ],
        [
            'question' => 'Vocês oferecem treinamento?',
            'answer' => 'Sim! Oferecemos treinamento completo sobre o sistema e técnicas de vendas para te ajudar a fechar mais negócios.'
        ]
    ]"
/>

</x-site-layout>
