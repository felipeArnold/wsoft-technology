@php
$structuredData = [
    [
        '@context' => 'https://schema.org',
        '@type' => 'SoftwareApplication',
        'name' => 'WSoft - Sistema com Assinatura Digital',
        'url' => 'https://www.wsoft.dev.br/assinatura-digital',
        'description' => 'Sistema de gestão com assinatura digital integrada. Assine contratos, propostas e documentos com validade jurídica sem sair do sistema.',
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
                'name' => 'O que é assinatura digital?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Assinatura digital é uma tecnologia que garante autenticidade, integridade e validade jurídica de documentos eletrônicos. Substitui assinaturas manuscritas com mais segurança e praticidade.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'Assinatura digital tem validade jurídica?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Sim! A assinatura digital tem total validade jurídica no Brasil, conforme a Lei 14.063/2020 e a Medida Provisória 2.200-2/2001. É aceita em contratos, propostas e documentos oficiais.'
                ]
            ],
            [
                '@type' => 'Question',
                'name' => 'Como funciona a assinatura digital no WSoft?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'No WSoft, você cria seus documentos (contratos, propostas, OS) e envia para assinatura digital. O cliente recebe por e-mail, assina online e o documento volta automaticamente para o sistema.'
                ]
            ]
        ]
    ],
    [
        '@context' => 'https://schema.org',
        '@type' => 'HowTo',
        'name' => 'Como usar Assinatura Digital no WSoft',
        'description' => 'Passo a passo para criar, enviar e assinar documentos digitalmente com validade jurídica usando o sistema WSoft.',
        'step' => [
            [
                '@type' => 'HowToStep',
                'name' => 'Crie Seu Documento',
                'text' => 'Gere contratos, propostas ou ordens de serviço direto no sistema. Use templates prontos ou personalize do seu jeito.',
                'position' => 1
            ],
            [
                '@type' => 'HowToStep',
                'name' => 'Envie para Assinatura',
                'text' => 'Com um clique, envie o documento por e-mail ou WhatsApp. O cliente recebe um link seguro para assinar de qualquer dispositivo.',
                'position' => 2
            ],
            [
                '@type' => 'HowToStep',
                'name' => 'Documento Assinado e Arquivado',
                'text' => 'Assim que assinado, o documento retorna automaticamente ao sistema. Tudo salvo na nuvem com certificado digital e validade jurídica.',
                'position' => 3
            ]
        ]
    ]
];
@endphp

<x-site-layout
    :title="'Assinatura Digital Integrada | Sistema com e-Signature | WSoft'"
    :description="'Sistema de gestão com assinatura digital integrada. Assine contratos, propostas e documentos online com validade jurídica. Seguro, rápido e profissional. Teste grátis!'"
    :keywords="'assinatura digital, e-signature, assinatura eletrônica, contrato digital, assinar documentos online, sistema assinatura digital, software assinatura eletrônica'"
    :canonical="'https://www.wsoft.dev.br/assinatura-digital'"
    :ogTitle="'Assinatura Digital Integrada ao Sistema de Gestão | WSoft'"
    :ogDescription="'Assine contratos e documentos com segurança usando assinatura digital. Integrado ao seu sistema de gestão para máxima praticidade.'"
    :structuredData="$structuredData"
>

<!-- Hero -->
<section id="hero" class="pt-32 pb-24 bg-gradient-to-b from-emerald-950 via-emerald-900 to-emerald-800 text-white overflow-hidden relative">
    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 30px 30px;"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-16 items-center relative z-10">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-800/50 border border-emerald-700 text-emerald-200 text-xs font-semibold uppercase tracking-wider mb-6">
                <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                Assinatura Digital
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold leading-tight tracking-tight">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-200 to-white">Assinatura Digital</span> Integrada ao Sistema
            </h1>
            <p class="mt-6 text-lg md:text-xl text-green-100 leading-relaxed max-w-lg">
                Assine contratos, propostas e documentos online com <strong>validade jurídica</strong>. Tudo integrado ao seu sistema de gestão.
            </p>
            <div class="mt-10 flex flex-col sm:flex-row gap-4">
                <a href="/app/register" class="inline-flex justify-center items-center rounded-xl bg-white text-emerald-700 font-bold px-8 py-4 shadow-lg shadow-white/30 hover:bg-emerald-50 hover:-translate-y-1 transition transform duration-200">
                    Testar por 7 Dias
                    <i class="fa-solid fa-arrow-right ml-2"></i>
                </a>
                <a href="#como-funciona" class="inline-flex justify-center items-center rounded-xl border border-white/30 text-white font-semibold px-8 py-4 hover:bg-white/10 transition backdrop-blur-sm">
                    <i class="fa-solid fa-play mr-2"></i>
                    Como Funciona
                </a>
            </div>
            <div class="mt-10 pt-8 border-t border-white/10">
                <p class="text-sm text-green-200 mb-4">Perfeito para:</p>
                <div class="flex flex-wrap gap-3 text-sm font-medium text-white">
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Contratos</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Propostas Comerciais</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Ordens de Serviço</span>
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">Termos de Aceite</span>
                </div>
            </div>
        </div>
        <div class="relative">
            <div class="absolute -inset-4 bg-gradient-to-r from-green-500 to-emerald-500 rounded-full blur-3xl opacity-20 animate-pulse"></div>
            <div class="bg-white/10 border border-white/20 rounded-3xl p-8 backdrop-blur-md shadow-2xl relative">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <p class="text-sm uppercase text-green-200 font-semibold tracking-wider">Documentos Assinados</p>
                        <h3 class="text-3xl font-bold mt-1">1.234</h3>
                        <div class="flex items-center gap-2 mt-2">
                            <span class="text-xs font-bold text-green-400 bg-green-400/10 px-2 py-0.5 rounded">+45% este mês</span>
                        </div>
                    </div>
                    <div class="h-12 w-12 rounded-full bg-green-500/20 flex items-center justify-center border border-green-400/30">
                        <i class="fa-solid fa-file-signature text-green-300 text-xl"></i>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-xs text-green-200">Taxa de Conclusão</p>
                            <span class="text-sm font-bold text-green-300">96%</span>
                        </div>
                        <div class="h-2 bg-emerald-950/50 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-green-400 to-emerald-400 w-[96%] rounded-full"></div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                            <p class="text-xs text-green-200">Pendentes</p>
                            <p class="text-2xl font-bold mt-1">12</p>
                        </div>
                        <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                            <p class="text-xs text-green-200">Hoje</p>
                            <p class="text-2xl font-bold mt-1">18</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pain vs Gain -->
<x-site.comparison
    title="Ainda imprime, assina e escaneia documentos?"
    subtitle="O problema da burocracia"
    description="Empresas que ainda usam papel perdem tempo e oportunidades. Veja a diferença:"
    painTitle="Processo Lento e Burocrático"
    :painItems="[
        'Imprime, envia para assinatura e aguarda retorno',
        'Perde negócios por demora na formalização',
        'Documentos extraviados ou perdidos',
        'Custo com impressão, correio e armazenamento'
    ]"
    gainTitle="100% Digital e Rápido"
    :gainItems="[
        'Cliente assina em minutos pelo celular',
        'Feche negócios 10x mais rápido',
        'Tudo organizado e armazenado na nuvem',
        'Economia total: zero papel, zero correio'
    ]"
    gainCardBg="bg-emerald-900"
    gainCardBorder="border-emerald-800"
    gainTitleColor="text-emerald-400"
    gainCheckColor="text-emerald-400"
    gainBadgeBg="bg-emerald-500"
    gainBadgeText="COM WSOFT"
/>

<!-- How it Works -->
<section id="como-funciona" class="py-24 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-20">
            <p class="text-sm font-semibold text-emerald-600 uppercase tracking-[0.3em]">Passo a Passo</p>
            <h2 class="mt-4 text-3xl md:text-4xl font-bold text-slate-900">Como funciona a Assinatura Digital no WSoft</h2>
            <p class="mt-4 text-lg text-slate-600">Simples, seguro e com validade jurídica.</p>
        </div>

        <div class="space-y-24">
            <!-- Step 1 -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 bg-slate-100 flex items-center justify-center h-96">
                        <i class="fa-solid fa-file-contract text-emerald-300 text-9xl"></i>
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-emerald-100 text-emerald-700 font-bold text-xl">1</span>
                        <h3 class="text-2xl font-bold text-slate-900">Crie Seu Documento</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Gere contratos, propostas ou ordens de serviço direto no sistema. Use templates prontos ou personalize do seu jeito.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Templates personalizáveis</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Preenchimento automático de dados</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Sua marca e identidade visual</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-1">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-emerald-100 text-emerald-700 font-bold text-xl">2</span>
                        <h3 class="text-2xl font-bold text-slate-900">Envie para Assinatura</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Com um clique, envie o documento por e-mail ou WhatsApp. O cliente recebe um link seguro para assinar de qualquer dispositivo.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Envio automático por e-mail</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Compatível com celular e tablet</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Notificações de status em tempo real</span>
                        </li>
                    </ul>
                </div>
                <div class="order-2">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 bg-slate-100 flex items-center justify-center h-96">
                        <i class="fa-solid fa-envelope-open-text text-emerald-300 text-9xl"></i>
                    </div>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 bg-slate-100 flex items-center justify-center h-96">
                        <i class="fa-solid fa-circle-check text-emerald-300 text-9xl"></i>
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-emerald-100 text-emerald-700 font-bold text-xl">3</span>
                        <h3 class="text-2xl font-bold text-slate-900">Documento Assinado e Arquivado</h3>
                    </div>
                    <p class="text-lg text-slate-600 mb-6">
                        Assim que assinado, o documento retorna automaticamente ao sistema. Tudo salvo na nuvem com certificado digital e validade jurídica.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Validade jurídica garantida</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Armazenamento seguro na nuvem</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>Histórico completo de assinaturas</span>
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
            <p class="text-sm font-semibold text-emerald-600 uppercase tracking-[0.3em]">Vantagens</p>
            <h2 class="mt-4 text-3xl md:text-4xl font-bold">Por que usar assinatura digital?</h2>
            <p class="mt-4 text-lg text-slate-600">Agilidade, segurança e economia para o seu negócio</p>
        </div>
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-rocket text-emerald-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Feche Negócios Mais Rápido</h3>
                    <p class="mt-3 text-slate-600">Cliente assina em minutos pelo celular. Não perca mais oportunidades por burocracia.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-shield-halved text-blue-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Validade Jurídica</h3>
                    <p class="mt-3 text-slate-600">Assinatura digital tem valor legal no Brasil conforme Lei 14.063/2020. Total segurança jurídica.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-piggy-bank text-purple-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Economize com Papel</h3>
                    <p class="mt-3 text-slate-600">Elimine custos com impressão, correio e armazenamento físico. Tudo 100% digital.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-mobile-screen-button text-orange-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Assine de Qualquer Lugar</h3>
                    <p class="mt-3 text-slate-600">Cliente assina pelo celular, tablet ou computador. Trabalhe remotamente sem limitações.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-lock text-red-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Máxima Segurança</h3>
                    <p class="mt-3 text-slate-600">Criptografia de ponta, certificado digital e rastreabilidade completa de cada assinatura.</p>
                </div>
            </article>
            <article class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-teal-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-link text-teal-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Integração Total</h3>
                    <p class="mt-3 text-slate-600">Assinatura digital integrada com vendas, financeiro e OS. Tudo em um único sistema.</p>
                </div>
            </article>
        </div>
    </div>
</section>

<!-- CTA Section -->
<x-site.cta-final
    :title="'Escolha um sistema completo para assinatura digital de documentos'"
    :description="'Comece agora com 7 dias de teste grátis. Use o melhor <strong>sistema com assinatura eletrônica integrada</strong> por apenas <span class=\'text-yellow-300 font-bold\'>R$ 29,90/mês</span>.'"
    :footer="'Junte-se a centenas de empresas que usam WSoft'"
    :gradient="'bg-gradient-to-br from-emerald-600 to-green-600'"
    :textColor="'text-emerald-50'"
    :highlightColor="'text-yellow-300'"
/>


<!-- FAQ -->
<section id="faq" class="py-20 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <p class="text-sm font-semibold text-emerald-600 uppercase tracking-[0.3em]">FAQ</p>
            <h2 class="mt-4 text-3xl font-bold">Perguntas frequentes sobre assinatura digital</h2>
        </div>
        <div class="space-y-4">
            <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    O que é assinatura digital?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Assinatura digital é uma tecnologia que garante autenticidade, integridade e validade jurídica de documentos eletrônicos. Substitui assinaturas manuscritas com mais segurança e praticidade.</p>
            </details>
            <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    Assinatura digital tem validade jurídica?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Sim! A assinatura digital tem total validade jurídica no Brasil, conforme a Lei 14.063/2020 e a Medida Provisória 2.200-2/2001. É aceita em contratos, propostas e documentos oficiais.</p>
            </details>
            <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    Como funciona a assinatura digital no WSoft?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">No WSoft, você cria seus documentos (contratos, propostas, OS) e envia para assinatura digital. O cliente recebe por e-mail, assina online e o documento volta automaticamente para o sistema.</p>
            </details>
            <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    Qual a diferença entre assinatura digital e eletrônica?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">A assinatura digital usa certificado digital e criptografia, oferecendo o mais alto nível de segurança jurídica. Já a assinatura eletrônica é mais simples, mas ainda possui validade legal para a maioria dos documentos empresariais.</p>
            </details>
            <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                    Posso assinar contratos de qualquer valor?
                    <span class="text-sm text-slate-500 group-open:hidden">+</span>
                    <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                </summary>
                <p class="mt-3 text-slate-600">Sim! A assinatura digital é válida para contratos comerciais de qualquer valor, propostas, ordens de serviço, termos de aceite e outros documentos empresariais.</p>
            </details>
        </div>
    </div>
</section>

</x-site-layout>
