<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Software completo para gestão de oficinas mecânicas. Controle ordens de serviço, estoque, clientes e financeiro em um só lugar.">
    <title>Sistema para Oficina Mecânica | Gestão Completa</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Meta Tags para Anúncios -->
    <meta property="og:title" content="Sistema Completo para Oficinas Mecânicas">
    <meta property="og:description" content="Gerencie sua oficina de forma profissional. Ordem de serviço digital, controle de estoque e financeiro.">
    <meta property="og:type" content="website">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-blue-600 via-blue-700 to-blue-900 text-white">
        <div class="container mx-auto px-4 py-16 md:py-24">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
                    Sistema Completo para Sua Oficina Mecânica
                </h1>
                <p class="text-xl md:text-2xl mb-8 text-blue-100">
                    Profissionalize sua gestão com ordem de serviço digital, controle financeiro e muito mais
                </p>

                <!-- CTA Principal -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-8">
                    <a href="{{ route('filament.app.auth.register') }}" class="bg-yellow-400 text-blue-900 px-8 py-4 rounded-lg text-lg font-bold hover:bg-yellow-300 transition-all transform hover:scale-105 shadow-xl">
                        Começar Agora - Grátis por 7 Dias
                    </a>
                    <a href="#funcionalidades" class="bg-white/10 backdrop-blur-sm text-white px-8 py-4 rounded-lg text-lg font-semibold hover:bg-white/20 transition-all border border-white/30">
                        Ver Demonstração
                    </a>
                </div>

                <p class="text-sm text-blue-200">
                    ✓ Sem cartão de crédito • ✓ Cancelamento gratuito • ✓ Suporte incluído
                </p>
            </div>
        </div>
    </section>

    <!-- Benefícios Rápidos -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                <div class="text-center">
                    <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-lg mb-2">Aumente Seu Faturamento</h3>
                    <p class="text-gray-600">Não perca mais serviços. Controle total das ordens de serviço.</p>
                </div>

                <div class="text-center">
                    <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-lg mb-2">Economia de Tempo</h3>
                    <p class="text-gray-600">Menos papel, mais produtividade. Tudo digital e organizado.</p>
                </div>

                <div class="text-center">
                    <div class="bg-purple-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-lg mb-2">Controle Total</h3>
                    <p class="text-gray-600">Saiba exatamente quanto você tem a receber e a pagar.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Funcionalidades -->
    <section id="funcionalidades" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-bold text-center mb-4">
                    Tudo que Sua Oficina Precisa
                </h2>
                <p class="text-xl text-gray-600 text-center mb-12">
                    Sistema completo desenvolvido especialmente para oficinas mecânicas
                </p>

                <div class="grid md:grid-cols-2 gap-8">
                    <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex items-start">
                            <div class="bg-blue-600 text-white p-3 rounded-lg mr-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-lg mb-2">Ordem de Serviço Digital</h3>
                                <p class="text-gray-600">Crie, edite e acompanhe todas as OS. Envie por WhatsApp para seus clientes.</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex items-start">
                            <div class="bg-green-600 text-white p-3 rounded-lg mr-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-lg mb-2">Gestão Financeira</h3>
                                <p class="text-gray-600">Contas a pagar, a receber, fluxo de caixa e relatórios financeiros completos.</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex items-start">
                            <div class="bg-orange-600 text-white p-3 rounded-lg mr-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-lg mb-2">Controle de Estoque</h3>
                                <p class="text-gray-600">Gerencie peças, produtos e serviços. Alerta de estoque mínimo.</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex items-start">
                            <div class="bg-purple-600 text-white p-3 rounded-lg mr-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-lg mb-2">Cadastro de Clientes</h3>
                                <p class="text-gray-600">Histórico completo de cada cliente e veículo. Nunca esqueça os detalhes.</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex items-start">
                            <div class="bg-red-600 text-white p-3 rounded-lg mr-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-lg mb-2">Relatórios e Gráficos</h3>
                                <p class="text-gray-600">Dashboards com métricas importantes. Tome decisões baseadas em dados.</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex items-start">
                            <div class="bg-indigo-600 text-white p-3 rounded-lg mr-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-lg mb-2">Acesse de Qualquer Lugar</h3>
                                <p class="text-gray-600">Sistema online. Use no computador, tablet ou celular.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Chamativo -->
    <section class="py-20 bg-gradient-to-r from-yellow-400 via-orange-500 to-red-500 relative overflow-hidden">
        <!-- Padrão de fundo animado -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute transform rotate-45 -left-20 -top-20 w-96 h-96 bg-white rounded-full"></div>
            <div class="absolute transform -rotate-45 -right-20 -bottom-20 w-96 h-96 bg-white rounded-full"></div>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-4xl mx-auto text-center">
                <!-- Badge de urgência -->
                <div class="inline-block bg-white/90 backdrop-blur-sm text-red-600 px-6 py-2 rounded-full font-bold text-sm mb-6 animate-pulse shadow-lg">
                    🔥 OFERTA LIMITADA - Últimas Vagas do Mês
                </div>

                <h2 class="text-4xl md:text-6xl font-black text-white mb-6 leading-tight drop-shadow-lg">
                    Pare de Perder Dinheiro com Desorganização!
                </h2>

                <p class="text-xl md:text-2xl text-white/95 mb-8 font-semibold">
                    Oficinas estão faturando até <span class="text-yellow-200 font-black text-3xl">30% A MAIS</span> com nosso sistema
                </p>

                <!-- Stats rápidos -->
                <div class="grid grid-cols-3 gap-4 max-w-2xl mx-auto mb-10">
                    <div class="bg-white/20 backdrop-blur-md p-4 rounded-lg border-2 border-white/40">
                        <div class="text-3xl md:text-4xl font-black text-white">+500</div>
                        <div class="text-sm text-white/90 font-semibold">Oficinas Ativas</div>
                    </div>
                    <div class="bg-white/20 backdrop-blur-md p-4 rounded-lg border-2 border-white/40">
                        <div class="text-3xl md:text-4xl font-black text-white">98%</div>
                        <div class="text-sm text-white/90 font-semibold">Satisfação</div>
                    </div>
                    <div class="bg-white/20 backdrop-blur-md p-4 rounded-lg border-2 border-white/40">
                        <div class="text-3xl md:text-4xl font-black text-white">24/7</div>
                        <div class="text-sm text-white/90 font-semibold">Suporte</div>
                    </div>
                </div>

                <!-- CTA Principal Destacado -->
                <div class="bg-white/95 backdrop-blur-sm p-8 md:p-10 rounded-2xl shadow-2xl max-w-2xl mx-auto mb-6">
                    <div class="mb-6">
                        <p class="text-gray-700 font-bold text-lg mb-2">🎁 BÔNUS ESPECIAL HOJE:</p>
                        <ul class="text-left space-y-2 text-gray-700 max-w-md mx-auto">
                            <li class="flex items-start">
                                <svg class="w-6 h-6 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span><strong>Setup gratuito</strong> - Nossa equipe configura tudo pra você</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-6 h-6 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span><strong>Treinamento completo</strong> - Você e sua equipe</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-6 h-6 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span><strong>30 dias de suporte VIP</strong> - Tire todas suas dúvidas</span>
                            </li>
                        </ul>
                    </div>

                    <a href="{{ route('filament.app.auth.register') }}" class="block w-full bg-gradient-to-r from-green-500 to-green-600 text-white px-10 py-6 rounded-xl text-xl md:text-2xl font-black hover:from-green-600 hover:to-green-700 transition-all transform hover:scale-105 shadow-2xl mb-4 uppercase">
                        👉 Quero Transformar Minha Oficina Agora!
                    </a>

                    <div class="flex items-center justify-center space-x-6 text-sm text-gray-600">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="font-semibold">7 dias grátis</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="font-semibold">Sem cartão</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="font-semibold">Cancele quando quiser</span>
                        </div>
                    </div>
                </div>

                <p class="text-white/90 text-sm font-semibold">
                    ⏰ Apenas <span class="text-yellow-200 font-black text-lg">12 vagas</span> disponíveis este mês
                </p>
            </div>
        </div>
    </section>

    <!-- Preços -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-bold text-center mb-4">
                    Investimento Simples e Transparente
                </h2>
                <p class="text-xl text-gray-600 text-center mb-12">
                    Sem surpresas. Sem taxas escondidas.
                </p>

                <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12 text-center max-w-md mx-auto border-4 border-blue-600">
                    <div class="mb-6">
                        <p class="text-gray-600 text-lg mb-2">A partir de</p>
                        <div class="flex items-center justify-center">
                            <span class="text-5xl md:text-6xl font-bold text-blue-600">R$ {{ $price_formatted }}</span>
                            <span class="text-gray-600 text-xl ml-2">/{{ $interval_label }}</span>
                        </div>
                    </div>

                    <ul class="text-left mb-8 space-y-3">
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Ordens de serviço ilimitadas</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Clientes e veículos ilimitados</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Gestão financeira completa</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Suporte via WhatsApp</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Atualizações gratuitas</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Sem taxas de setup</span>
                        </li>
                    </ul>

                    <a href="{{ route('filament.app.auth.register') }}" class="block w-full bg-blue-600 text-white px-8 py-4 rounded-lg text-lg font-bold hover:bg-blue-700 transition-all transform hover:scale-105 shadow-lg">
                        Começar Teste Grátis
                    </a>

                    <p class="text-sm text-gray-500 mt-4">
                        7 dias grátis • Cancele quando quiser
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Final - Registro -->
    <section id="contato" class="py-16 bg-gradient-to-br from-blue-600 to-blue-900 text-white">
        <div class="container mx-auto px-4">
            <div class="max-w-2xl mx-auto text-center">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">
                    Comece Hoje Mesmo - Grátis por 7 Dias
                </h2>
                <p class="text-xl mb-8 text-blue-100">
                    Crie sua conta agora e comece a transformar sua oficina
                </p>

                <div class="bg-white/10 backdrop-blur-sm rounded-lg p-8 shadow-2xl border border-white/20">
                    <div class="mb-6">
                        <ul class="space-y-3 text-left max-w-md mx-auto mb-8">
                            <li class="flex items-center text-white">
                                <svg class="w-6 h-6 text-green-400 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span><strong>Ativação imediata</strong> - Comece a usar agora mesmo</span>
                            </li>
                            <li class="flex items-center text-white">
                                <svg class="w-6 h-6 text-green-400 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span><strong>Sem cartão de crédito</strong> - Teste grátis por 7 dias</span>
                            </li>
                            <li class="flex items-center text-white">
                                <svg class="w-6 h-6 text-green-400 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span><strong>Suporte completo</strong> - Nossa equipe te ajuda no setup</span>
                            </li>
                        </ul>
                    </div>

                    <a
                        href="{{ route('filament.app.auth.register') }}"
                        class="block w-full bg-gradient-to-r from-green-500 to-green-600 text-white px-10 py-6 rounded-xl text-xl md:text-2xl font-black hover:from-green-600 hover:to-green-700 transition-all transform hover:scale-105 shadow-2xl mb-4 uppercase"
                    >
                        Criar Minha Conta Grátis Agora
                    </a>

                    <p class="text-sm text-blue-100">
                        Já tem uma conta? <a href="{{ route('filament.app.auth.login') }}" class="text-yellow-300 hover:text-yellow-200 font-bold underline">Faça login aqui</a>
                    </p>
                </div>

                <p class="text-white/90 text-sm font-semibold mt-6">
                    Sem burocracia. Sem complicação. Comece em menos de 2 minutos.
                </p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8">
        <div class="container mx-auto px-4 text-center">
            <p class="text-gray-400">
                © {{ date('Y') }} - Todos os direitos reservados
            </p>
            <p class="text-sm text-gray-500 mt-2">
                Sistema desenvolvido para oficinas mecânicas
            </p>
        </div>
    </footer>

    <!-- Pixel de Conversão (placeholder) -->
    <script>
        console.log('Landing page carregada');

        // Tracking de clique no CTA
        document.querySelectorAll('a[href*="register"]').forEach(function(link) {
            link.addEventListener('click', function() {
                // fbq('track', 'InitiateCheckout');
                // gtag('event', 'begin_checkout');
                console.log('CTA de registro clicado');
            });
        });
    </script>
</body>
</html>
