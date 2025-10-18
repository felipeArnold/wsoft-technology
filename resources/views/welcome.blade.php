<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="GestãoPro - Sistema completo de gestão empresarial para pequenos e médios negócios. Gerencie clientes, fornecedores, ordens de serviço e finanças.">
    <meta name="keywords" content="gestão empresarial, ERP, sistema de gestão, ordens de serviço, controle financeiro, gestão de clientes">
    <meta property="og:title" content="GestãoPro - Sistema de Gestão Empresarial Simplificado">
    <meta property="og:description" content="Sistema completo de gestão para pequenos e médios negócios. R$ 29,90/mês com teste grátis.">
    <meta property="og:type" content="website">
    <title>GestãoPro - Sistema de Gestão Empresarial Simplificado</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');

        * {
            font-family: 'Inter', sans-serif;
        }

        :root {
            --primary: 222 47% 40%;
            --primary-hover: 222 47% 35%;
            --primary-foreground: 210 40% 98%;
            --background: 0 0% 100%;
            --foreground: 222 47% 11%;
            --muted: 210 40% 96%;
            --muted-foreground: 215 16% 47%;
            --border: 214 32% 91%;
            --accent: 210 40% 96%;
            --card: 0 0% 100%;
            --hero-gradient-from: 222 47% 40%;
            --hero-gradient-to: 215 89% 55%;
        }

        .bg-hero-gradient {
            background: linear-gradient(135deg, hsl(var(--hero-gradient-from)), hsl(var(--hero-gradient-to)));
        }

        .bg-gradient-to-br {
            background-image: linear-gradient(to bottom right, var(--tw-gradient-stops));
        }

        .accordion-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }

        .accordion-content.active {
            max-height: 500px;
        }
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            DEFAULT: 'hsl(222 47% 40%)',
                            hover: 'hsl(222 47% 35%)',
                            foreground: 'hsl(210 40% 98%)',
                        },
                        background: 'hsl(0 0% 100%)',
                        foreground: 'hsl(222 47% 11%)',
                        muted: {
                            DEFAULT: 'hsl(210 40% 96%)',
                            foreground: 'hsl(215 16% 47%)',
                        },
                        border: 'hsl(214 32% 91%)',
                        accent: 'hsl(210 40% 96%)',
                        card: 'hsl(0 0% 100%)',
                    }
                }
            }
        }
    </script>
</head>
<body class="antialiased">
<!-- Hero Section -->
<section class="relative overflow-hidden bg-gradient-to-br from-white via-gray-50 to-white">
    <div class="container mx-auto px-4 py-20 md:py-32">
        <div class="grid gap-12 lg:grid-cols-2 lg:gap-16 items-center">
            <!-- Left Column - Content -->
            <div class="space-y-8 text-center lg:text-left">
                <div class="inline-block rounded-full bg-blue-50 px-4 py-2 text-sm font-medium text-blue-700">
                    ✨ Simplifique sua gestão empresarial
                </div>

                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold tracking-tight text-gray-900">
                    Gerencie seu negócio
                    <span class="bg-gradient-to-r from-blue-700 to-blue-500 bg-clip-text text-transparent">
              de forma simples
            </span>
                </h1>

                <p class="text-lg md:text-xl text-gray-600 max-w-2xl mx-auto lg:mx-0">
                    Controle clientes, fornecedores, ordens de serviço e finanças em uma única plataforma.
                    Economize tempo e tenha o controle total do seu negócio.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                    <a href="#" class="inline-flex items-center justify-center rounded-md bg-blue-700 px-8 py-3 text-base font-medium text-white shadow-lg hover:bg-blue-800 transition-colors">
                        Teste grátis por 7 dias
                    </a>
                    <a href="#" class="inline-flex items-center justify-center rounded-md border border-gray-300 bg-white px-8 py-3 text-base font-medium text-gray-900 hover:bg-gray-50 transition-colors">
                        Ver demonstração
                    </a>
                </div>

                <div class="pt-4 border-t border-gray-200">
                    <p class="text-sm text-gray-600">
                        Plano único por
                        <span class="text-2xl font-bold text-blue-700">R$ 29,90/mês</span>
                    </p>
                    <p class="text-xs text-gray-500 mt-1">
                        Sem taxas escondidas • Cancele quando quiser
                    </p>
                </div>
            </div>

            <!-- Right Column - Image -->
            <div class="relative">
                <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-gray-200">
                    <img
                        src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&h=600&fit=crop"
                        alt="Dashboard de gestão empresarial"
                        class="w-full h-auto"
                    />
                </div>
                <div class="absolute -top-4 -right-4 w-72 h-72 bg-blue-100 rounded-full blur-3xl -z-10 opacity-50"></div>
                <div class="absolute -bottom-4 -left-4 w-72 h-72 bg-purple-100 rounded-full blur-3xl -z-10 opacity-50"></div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section id="funcionalidades" class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold mb-4 text-gray-900">
                Tudo que você precisa para
                <span class="bg-gradient-to-r from-blue-700 to-blue-500 bg-clip-text text-transparent">
            gerir seu negócio
          </span>
            </h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Funcionalidades completas para simplificar sua rotina empresarial
            </p>
        </div>

        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            <!-- Feature 1 -->
            <div class="bg-white rounded-lg border border-gray-200 p-6 hover:border-blue-300 hover:shadow-lg transition-all duration-200">
                <div class="rounded-lg bg-blue-50 w-12 h-12 flex items-center justify-center mb-4">
                    <svg class="h-6 w-6 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2 text-gray-900">Gestão de Clientes e Fornecedores</h3>
                <p class="text-gray-600">Centralize todas as informações de seus clientes e fornecedores em um só lugar.</p>
            </div>

            <!-- Feature 2 -->
            <div class="bg-white rounded-lg border border-gray-200 p-6 hover:border-blue-300 hover:shadow-lg transition-all duration-200">
                <div class="rounded-lg bg-blue-50 w-12 h-12 flex items-center justify-center mb-4">
                    <svg class="h-6 w-6 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2 text-gray-900">Ordens de Serviço</h3>
                <p class="text-gray-600">Crie, acompanhe e gerencie ordens de serviço de forma rápida e organizada.</p>
            </div>

            <!-- Feature 3 -->
            <div class="bg-white rounded-lg border border-gray-200 p-6 hover:border-blue-300 hover:shadow-lg transition-all duration-200">
                <div class="rounded-lg bg-blue-50 w-12 h-12 flex items-center justify-center mb-4">
                    <svg class="h-6 w-6 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2 text-gray-900">Contas a Pagar e Receber</h3>
                <p class="text-gray-600">Controle seu fluxo de caixa com gestão completa de contas a pagar e receber.</p>
            </div>

            <!-- Feature 4 -->
            <div class="bg-white rounded-lg border border-gray-200 p-6 hover:border-blue-300 hover:shadow-lg transition-all duration-200">
                <div class="rounded-lg bg-blue-50 w-12 h-12 flex items-center justify-center mb-4">
                    <svg class="h-6 w-6 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2 text-gray-900">Controle de Inadimplência</h3>
                <p class="text-gray-600">Monitore pagamentos em atraso e mantenha seu financeiro sempre saudável.</p>
            </div>

            <!-- Feature 5 -->
            <div class="bg-white rounded-lg border border-gray-200 p-6 hover:border-blue-300 hover:shadow-lg transition-all duration-200">
                <div class="rounded-lg bg-blue-50 w-12 h-12 flex items-center justify-center mb-4">
                    <svg class="h-6 w-6 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2 text-gray-900">Dashboard Financeiro</h3>
                <p class="text-gray-600">Visualize seus indicadores financeiros em tempo real com gráficos intuitivos.</p>
            </div>

            <!-- Feature 6 -->
            <div class="bg-white rounded-lg border border-gray-200 p-6 hover:border-blue-300 hover:shadow-lg transition-all duration-200">
                <div class="rounded-lg bg-blue-50 w-12 h-12 flex items-center justify-center mb-4">
                    <svg class="h-6 w-6 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2 text-gray-900">Segurança e Backup</h3>
                <p class="text-gray-600">Seus dados protegidos com criptografia e backup automático na nuvem.</p>
            </div>
        </div>
    </div>
</section>

<!-- Benefits Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold mb-4 text-gray-900">
                Por que escolher nosso sistema?
            </h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Transforme a gestão do seu negócio com eficiência e simplicidade
            </p>
        </div>

        <div class="grid gap-8 md:grid-cols-3 max-w-5xl mx-auto">
            <!-- Benefit 1 -->
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-50 mb-4">
                    <svg class="h-8 w-8 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2 text-gray-900">Economize Tempo</h3>
                <p class="text-gray-600">Automatize tarefas repetitivas e foque no que realmente importa: fazer seu negócio crescer.</p>
            </div>

            <!-- Benefit 2 -->
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-50 mb-4">
                    <svg class="h-8 w-8 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2 text-gray-900">Organização Total</h3>
                <p class="text-gray-600">Centralize todas as informações do seu negócio em uma única plataforma intuitiva.</p>
            </div>

            <!-- Benefit 3 -->
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-50 mb-4">
                    <svg class="h-8 w-8 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2 text-gray-900">Controle Financeiro</h3>
                <p class="text-gray-600">Tenha visibilidade completa da saúde financeira da sua empresa em tempo real.</p>
            </div>
        </div>
    </div>
</section>

<!-- Pricing Section -->
<section id="precos" class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold mb-4 text-gray-900">
                Plano simples, preço justo
            </h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Sem complicação, sem taxas escondidas. Um único plano com tudo que você precisa.
            </p>
        </div>

        <div class="max-w-lg mx-auto">
            <div class="bg-white rounded-lg border-2 border-blue-700 relative overflow-hidden shadow-lg">
                <div class="absolute top-0 right-0 bg-blue-700 text-white px-4 py-1 text-sm font-medium">
                    Mais Popular
                </div>

                <div class="text-center pb-8 pt-12 px-6">
                    <h3 class="text-2xl font-bold mb-4 text-gray-900">Plano Completo</h3>
                    <div class="space-y-2">
                        <div class="flex items-baseline justify-center gap-2">
                            <span class="text-5xl font-bold text-blue-700">R$ 29,90</span>
                            <span class="text-gray-600">/mês</span>
                        </div>
                        <p class="text-sm text-gray-500">
                            Teste grátis por 7 dias • Cancele quando quiser
                        </p>
                    </div>
                </div>

                <div class="px-6 pb-6 space-y-6">
                    <div class="space-y-3">
                        <div class="flex items-start gap-3">
                            <div class="rounded-full bg-blue-50 p-1 mt-0.5">
                                <svg class="h-4 w-4 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <span class="text-sm text-gray-700">Gestão ilimitada de clientes e fornecedores</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="rounded-full bg-blue-50 p-1 mt-0.5">
                                <svg class="h-4 w-4 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <span class="text-sm text-gray-700">Ordens de serviço sem limite</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="rounded-full bg-blue-50 p-1 mt-0.5">
                                <svg class="h-4 w-4 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <span class="text-sm text-gray-700">Controle completo de contas a pagar e receber</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="rounded-full bg-blue-50 p-1 mt-0.5">
                                <svg class="h-4 w-4 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <span class="text-sm text-gray-700">Dashboard financeiro em tempo real</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="rounded-full bg-blue-50 p-1 mt-0.5">
                                <svg class="h-4 w-4 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <span class="text-sm text-gray-700">Controle de inadimplência</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="rounded-full bg-blue-50 p-1 mt-0.5">
                                <svg class="h-4 w-4 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <span class="text-sm text-gray-700">Suporte por e-mail e chat</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="rounded-full bg-blue-50 p-1 mt-0.5">
                                <svg class="h-4 w-4 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <span class="text-sm text-gray-700">Backup automático diário</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="rounded-full bg-blue-50 p-1 mt-0.5">
                                <svg class="h-4 w-4 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <span class="text-sm text-gray-700">Atualizações constantes</span>
                        </div>
                    </div>

                    <a href="#" class="block w-full rounded-md bg-blue-700 px-8 py-3 text-base font-medium text-white text-center shadow-lg hover:bg-blue-800 transition-colors">
                        Começar teste grátis
                    </a>

                    <p class="text-xs text-center text-gray-500">
                        Não é necessário cartão de crédito para o teste
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section id="depoimentos" class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold mb-4 text-gray-900">
                O que nossos clientes dizem
            </h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Empresas que já transformaram sua gestão com nossa plataforma
            </p>
        </div>

        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3 max-w-6xl mx-auto">
            <!-- Testimonial 1 -->
            <div class="bg-white rounded-lg border border-gray-200 p-6 space-y-4">
                <div class="flex gap-1">
                    <svg class="h-4 w-4 fill-blue-700 text-blue-700" viewBox="0 0 24 24">
                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                    </svg>
                    <svg class="h-4 w-4 fill-blue-700 text-blue-700" viewBox="0 0 24 24">
                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                    </svg>
                    <svg class="h-4 w-4 fill-blue-700 text-blue-700" viewBox="0 0 24 24">
                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                    </svg>
                    <svg class="h-4 w-4 fill-blue-700 text-blue-700" viewBox="0 0 24 24">
                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                    </svg>
                    <svg class="h-4 w-4 fill-blue-700 text-blue-700" viewBox="0 0 24 24">
                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                    </svg>
                </div>

                <p class="text-gray-600 italic">
                    "O sistema revolucionou a forma como gerencio meu negócio. Agora tenho controle total sobre minhas ordens de serviço e finanças. Recomendo!"
                </p>

                <div class="flex items-center gap-3 pt-4 border-t border-gray-200">
                    <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-700 font-semibold">
                        MS
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900">Maria Silva</p>
                        <p class="text-sm text-gray-500">Proprietária - Serviços de Limpeza</p>
                    </div>
                </div>
            </div>

            <!-- Testimonial 2 -->
            <div class="bg-white rounded-lg border border-gray-200 p-6 space-y-4">
                <div class="flex gap-1">
                    <svg class="h-4 w-4 fill-blue-700 text-blue-700" viewBox="0 0 24 24">
                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                    </svg>
                    <svg class="h-4 w-4 fill-blue-700 text-blue-700" viewBox="0 0 24 24">
                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                    </svg>
                    <svg class="h-4 w-4 fill-blue-700 text-blue-700" viewBox="0 0 24 24">
                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                    </svg>
                    <svg class="h-4 w-4 fill-blue-700 text-blue-700" viewBox="0 0 24 24">
                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                    </svg>
                    <svg class="h-4 w-4 fill-blue-700 text-blue-700" viewBox="0 0 24 24">
                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                    </svg>
                </div>

                <p class="text-gray-600 italic">
                    "Antes eu perdia muito tempo com planilhas. Agora tudo está organizado e consigo acompanhar os pagamentos em tempo real. Excelente custo-benefício!"
                </p>

                <div class="flex items-center gap-3 pt-4 border-t border-gray-200">
                    <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-700 font-semibold">
                        JS
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900">João Santos</p>
                        <p class="text-sm text-gray-500">Gestor - Manutenção Predial</p>
                    </div>
                </div>
            </div>

            <!-- Testimonial 3 -->
            <div class="bg-white rounded-lg border border-gray-200 p-6 space-y-4">
                <div class="flex gap-1">
                    <svg class="h-4 w-4 fill-blue-700 text-blue-700" viewBox="0 0 24 24">
                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                    </svg>
                    <svg class="h-4 w-4 fill-blue-700 text-blue-700" viewBox="0 0 24 24">
                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                    </svg>
                    <svg class="h-4 w-4 fill-blue-700 text-blue-700" viewBox="0 0 24 24">
                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                    </svg>
                    <svg class="h-4 w-4 fill-blue-700 text-blue-700" viewBox="0 0 24 24">
                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                    </svg>
                    <svg class="h-4 w-4 fill-blue-700 text-blue-700" viewBox="0 0 24 24">
                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                    </svg>
                </div>

                <p class="text-gray-600 italic">
                    "Interface simples e funcionalidades completas. Consegui implementar em menos de uma semana e minha equipe adorou. O suporte é rápido e eficiente."
                </p>

                <div class="flex items-center gap-3 pt-4 border-t border-gray-200">
                    <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-700 font-semibold">
                        AC
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900">Ana Costa</p>
                        <p class="text-sm text-gray-500">Diretora - Consultoria Empresarial</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section id="faq" class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold mb-4 text-gray-900">
                Perguntas Frequentes
            </h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Tire suas dúvidas sobre nosso sistema
            </p>
        </div>

        <div class="max-w-3xl mx-auto space-y-4">
            <!-- FAQ Item 1 -->
            <div class="bg-white border border-gray-200 rounded-lg">
                <button onclick="toggleAccordion(this)" class="w-full px-6 py-4 text-left font-semibold text-gray-900 flex justify-between items-center hover:bg-gray-50 transition-colors">
                    <span>Como funciona o teste grátis?</span>
                    <svg class="h-5 w-5 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="accordion-content px-6 pb-0">
                    <div class="pb-4 text-gray-600">
                        Você tem 7 dias completos para testar todas as funcionalidades do sistema sem compromisso. Não é necessário fornecer cartão de crédito. Após o período, você decide se quer continuar.
                    </div>
                </div>
            </div>

            <!-- FAQ Item 2 -->
            <div class="bg-white border border-gray-200 rounded-lg">
                <button onclick="toggleAccordion(this)" class="w-full px-6 py-4 text-left font-semibold text-gray-900 flex justify-between items-center hover:bg-gray-50 transition-colors">
                    <span>Posso cancelar a qualquer momento?</span>
                    <svg class="h-5 w-5 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="accordion-content px-6 pb-0">
                    <div class="pb-4 text-gray-600">
                        Sim! Não há fidelidade ou multa por cancelamento. Você pode cancelar sua assinatura a qualquer momento diretamente no painel de configurações, e terá acesso até o final do período pago.
                    </div>
                </div>
            </div>

            <!-- FAQ Item 3 -->
            <div class="bg-white border border-gray-200 rounded-lg">
                <button onclick="toggleAccordion(this)" class="w-full px-6 py-4 text-left font-semibold text-gray-900 flex justify-between items-center hover:bg-gray-50 transition-colors">
                    <span>Como funciona o suporte?</span>
                    <svg class="h-5 w-5 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="accordion-content px-6 pb-0">
                    <div class="pb-4 text-gray-600">
                        Oferecemos suporte por e-mail e chat durante horário comercial (9h às 18h, dias úteis). Nossa equipe responde em até 24 horas. Também temos uma base de conhecimento completa com tutoriais e guias.
                    </div>
                </div>
            </div>

            <!-- FAQ Item 4 -->
            <div class="bg-white border border-gray-200 rounded-lg">
                <button onclick="toggleAccordion(this)" class="w-full px-6 py-4 text-left font-semibold text-gray-900 flex justify-between items-center hover:bg-gray-50 transition-colors">
                    <span>Meus dados estão seguros?</span>
                    <svg class="h-5 w-5 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="accordion-content px-6 pb-0">
                    <div class="pb-4 text-gray-600">
                        Sim! Utilizamos criptografia de ponta a ponta e fazemos backup automático diário de todos os dados. Seus dados ficam armazenados em servidores seguros com certificação de segurança internacional.
                    </div>
                </div>
            </div>

            <!-- FAQ Item 5 -->
            <div class="bg-white border border-gray-200 rounded-lg">
                <button onclick="toggleAccordion(this)" class="w-full px-6 py-4 text-left font-semibold text-gray-900 flex justify-between items-center hover:bg-gray-50 transition-colors">
                    <span>Preciso instalar algum software?</span>
                    <svg class="h-5 w-5 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="accordion-content px-6 pb-0">
                    <div class="pb-4 text-gray-600">
                        Não! O sistema é 100% online (cloud). Você acessa através do navegador de qualquer computador, tablet ou smartphone com internet. Não precisa instalar nada.
                    </div>
                </div>
            </div>

            <!-- FAQ Item 6 -->
            <div class="bg-white border border-gray-200 rounded-lg">
                <button onclick="toggleAccordion(this)" class="w-full px-6 py-4 text-left font-semibold text-gray-900 flex justify-between items-center hover:bg-gray-50 transition-colors">
                    <span>Quantos usuários podem usar o sistema?</span>
                    <svg class="h-5 w-5 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="accordion-content px-6 pb-0">
                    <div class="pb-4 text-gray-600">
                        Com o plano único de R$ 29,90/mês, você pode cadastrar quantos usuários precisar, sem custo adicional. Ideal para equipes de qualquer tamanho.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-gray-900 text-white py-12">
    <div class="container mx-auto px-4">
        <div class="grid gap-8 md:grid-cols-4">
            <!-- Logo and Description -->
            <div class="md:col-span-2 space-y-4">
                <h3 class="text-2xl font-bold">GestãoPro</h3>
                <p class="text-gray-400 max-w-md">
                    Sistema completo de gestão empresarial para pequenos e médios negócios.
                    Simples, eficiente e acessível.
                </p>
                <a href="#" class="inline-block rounded-md bg-blue-700 px-8 py-3 text-base font-medium text-white shadow-lg hover:bg-blue-800 transition-colors">
                    Começar agora
                </a>
            </div>

            <!-- Product Links -->
            <div>
                <h4 class="font-semibold mb-4">Produto</h4>
                <ul class="space-y-2 text-gray-400">
                    <li><a href="#funcionalidades" class="hover:text-white transition-colors">Funcionalidades</a></li>
                    <li><a href="#precos" class="hover:text-white transition-colors">Preços</a></li>
                    <li><a href="#depoimentos" class="hover:text-white transition-colors">Depoimentos</a></li>
                    <li><a href="#faq" class="hover:text-white transition-colors">FAQ</a></li>
                </ul>
            </div>

            <!-- Legal Links -->
            <div>
                <h4 class="font-semibold mb-4">Legal</h4>
                <ul class="space-y-2 text-gray-400">
                    <li><a href="#" class="hover:text-white transition-colors">Política de Privacidade</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Termos de Uso</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Contato</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Suporte</a></li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-700 mt-12 pt-8 text-center text-gray-500 text-sm">
            <p>&copy; <script>document.write(new Date().getFullYear())</script> GestãoPro. Todos os direitos reservados.</p>
        </div>
    </div>
</footer>

<script>
    function toggleAccordion(button) {
        const content = button.nextElementSibling;
        const icon = button.querySelector('svg');
        const allContents = document.querySelectorAll('.accordion-content');
        const allIcons = document.querySelectorAll('.accordion-content').length;

        // Close all other accordions
        allContents.forEach((item) => {
            if (item !== content) {
                item.classList.remove('active');
                item.previousElementSibling.querySelector('svg').style.transform = 'rotate(0deg)';
            }
        });

        // Toggle current accordion
        content.classList.toggle('active');
        if (content.classList.contains('active')) {
            icon.style.transform = 'rotate(180deg)';
        } else {
            icon.style.transform = 'rotate(0deg)';
        }
    }
</script>
</body>
</html>
