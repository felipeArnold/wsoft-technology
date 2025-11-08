<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistema profissional de gestão para oficinas mecânicas com ordens de serviço numeradas, controle de estoque SKU, financeiro com parcelamento, dashboard em tempo real e assinatura digital integrada.">
    <title>Sistema de Gestão Profissional para Oficinas Mecânicas | WSoft Technology</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');

        * {
            font-family: 'Inter', sans-serif;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
        }

        .gradient-text {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(30, 58, 138, 0.2);
        }

        .btn-primary {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 30px rgba(30, 58, 138, 0.3);
        }

        .pulse-animation {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: .7; }
        }

        .fade-in {
            animation: fadeIn 0.8s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header/Navbar -->
    <nav class="bg-white shadow-sm fixed w-full top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <i class="fas fa-tools text-3xl text-blue-600 mr-3"></i>
                    <span class="text-2xl font-bold gradient-text">WSoft Technology</span>
                </div>
                <div class="hidden md:flex items-center space-x-4">
                    <a href="#funcionalidades" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Funcionalidades</a>
                    <a href="#planos" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Planos</a>
                    <a href="#contato" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Contato</a>
                    <a href="/admin/login" class="text-blue-600 hover:text-blue-700 px-4 py-2 rounded-md text-sm font-medium border border-blue-600 hover:bg-blue-50">
                        Entrar
                    </a>
                    <a href="/admin/register" class="btn-primary text-white px-6 py-2 rounded-md text-sm font-medium">
                        Cadastrar
                    </a>
                </div>
                <div class="md:hidden">
                    <button id="mobile-menu-button" class="text-gray-700 hover:text-blue-600">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-200">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="#funcionalidades" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50">Funcionalidades</a>
                <a href="#planos" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50">Planos</a>
                <a href="#contato" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50">Contato</a>
                <a href="/login" class="block px-3 py-2 rounded-md text-base font-medium text-blue-600 hover:bg-blue-50">Entrar</a>
                <a href="/register" class="block px-3 py-2 rounded-md text-base font-medium text-white bg-blue-600 hover:bg-blue-700">Cadastrar</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="gradient-bg pt-24 pb-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="text-white fade-in">
                    <h1 class="text-5xl md:text-6xl font-bold mb-6 leading-tight">
                        Sistema de Gestão Profissional para Oficinas Mecânicas
                    </h1>
                    <p class="text-xl mb-8 text-blue-100">
                        Sistema completo com ordens de serviço numeradas, controle de estoque com SKU, financeiro com parcelamento, dashboard em tempo real e assinatura digital integrada.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="/register" class="bg-white text-blue-600 px-8 py-4 rounded-lg text-lg font-semibold hover:bg-gray-100 transition text-center">
                            <i class="fas fa-rocket mr-2"></i>Começar Teste Grátis
                        </a>
                        <a href="#funcionalidades" class="border-2 border-white text-white px-8 py-4 rounded-lg text-lg font-semibold hover:bg-white hover:text-blue-600 transition text-center">
                            <i class="fas fa-play-circle mr-2"></i>Ver Como Funciona
                        </a>
                    </div>
                    <div class="mt-8 flex items-center space-x-6 text-sm">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-300 mr-2"></i>
                            <span>7 dias grátis</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-300 mr-2"></i>
                            <span>Sem cartão de crédito</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-300 mr-2"></i>
                            <span>Cancele quando quiser</span>
                        </div>
                    </div>
                </div>
                <div class="hidden md:block fade-in">
                    <div class="bg-white rounded-2xl shadow-2xl p-8 transform hover:scale-105 transition duration-300">
                        <div class="mb-4 pb-4 border-b border-gray-200">
                            <h3 class="text-lg font-bold text-gray-800 flex items-center">
                                <i class="fas fa-clipboard-check text-blue-600 mr-2"></i>
                                Ordens de Serviço - Hoje
                            </h3>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between p-4 bg-yellow-50 rounded-lg border-l-4 border-yellow-500">
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-wrench text-2xl text-yellow-600"></i>
                                    <div>
                                        <h4 class="font-semibold text-gray-800">OS #00234</h4>
                                        <p class="text-sm text-gray-600">Troca de óleo - João Silva</p>
                                    </div>
                                </div>
                                <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-semibold rounded-full">Em Andamento</span>
                            </div>
                            <div class="flex items-center justify-between p-4 bg-green-50 rounded-lg border-l-4 border-green-500">
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-check-circle text-2xl text-green-600"></i>
                                    <div>
                                        <h4 class="font-semibold text-gray-800">OS #00233</h4>
                                        <p class="text-sm text-gray-600">Revisão 10.000km - Maria Costa</p>
                                    </div>
                                </div>
                                <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">Concluída</span>
                            </div>
                            <div class="flex items-center justify-between p-4 bg-red-50 rounded-lg border-l-4 border-red-500">
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-exclamation-triangle text-2xl text-red-600"></i>
                                    <div>
                                        <h4 class="font-semibold text-gray-800">OS #00232</h4>
                                        <p class="text-sm text-gray-600">Freios e pastilhas - Pedro Santos</p>
                                    </div>
                                </div>
                                <span class="px-3 py-1 bg-red-100 text-red-800 text-xs font-semibold rounded-full">Urgente</span>
                            </div>
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border-l-4 border-gray-400">
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-file-alt text-2xl text-gray-500"></i>
                                    <div>
                                        <h4 class="font-semibold text-gray-800">OS #00231</h4>
                                        <p class="text-sm text-gray-600">Diagnóstico - Ana Oliveira</p>
                                    </div>
                                </div>
                                <span class="px-3 py-1 bg-gray-100 text-gray-800 text-xs font-semibold rounded-full">Rascunho</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Funcionalidades -->
    <section id="funcionalidades" class="py-20 px-4 sm:px-6 lg:px-8 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    Funcionalidades Completas e Profissionais
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Sistema robusto desenvolvido com as melhores práticas de gestão para oficinas mecânicas e prestadores de serviços automotivos
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Ordens de Serviço -->
                <div class="card-hover bg-white p-8 rounded-xl shadow-lg border border-gray-100">
                    <div class="w-16 h-16 gradient-bg rounded-lg flex items-center justify-center mb-6">
                        <i class="fas fa-clipboard-list text-3xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Ordens de Serviço</h3>
                    <p class="text-gray-600 mb-4">
                        Sistema completo de OS com numeração automática, controle de status e prioridade, valores detalhados e relatórios técnicos.
                    </p>
                    <ul class="space-y-2">
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-blue-600 mr-2"></i>
                            Numeração automática
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-blue-600 mr-2"></i>
                            4 status (Rascunho, Andamento, Concluída, Cancelada)
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-blue-600 mr-2"></i>
                            Prioridade e prazos
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-blue-600 mr-2"></i>
                            Cálculo de mão de obra e peças
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-blue-600 mr-2"></i>
                            Anexos e relatório técnico
                        </li>
                    </ul>
                </div>

                <!-- Gestão de Estoque -->
                <div class="card-hover bg-white p-8 rounded-xl shadow-lg border border-gray-100">
                    <div class="w-16 h-16 gradient-bg rounded-lg flex items-center justify-center mb-6">
                        <i class="fas fa-boxes text-3xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Controle de Estoque</h3>
                    <p class="text-gray-600 mb-4">
                        Gerencie produtos com SKU, preços de venda e custo, controle de estoque com alertas personalizados e margem de lucro.
                    </p>
                    <ul class="space-y-2">
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-blue-600 mr-2"></i>
                            Cadastro com SKU único
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-blue-600 mr-2"></i>
                            Preço de custo e venda
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-blue-600 mr-2"></i>
                            Cálculo de margem de lucro
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-blue-600 mr-2"></i>
                            Alertas de estoque mínimo
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-blue-600 mr-2"></i>
                            Busca rápida por nome/SKU
                        </li>
                    </ul>
                </div>

                <!-- Gestão Financeira -->
                <div class="card-hover bg-white p-8 rounded-xl shadow-lg border border-gray-100">
                    <div class="w-16 h-16 gradient-bg rounded-lg flex items-center justify-center mb-6">
                        <i class="fas fa-dollar-sign text-3xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Controle Financeiro</h3>
                    <p class="text-gray-600 mb-4">
                        Sistema completo com contas a pagar e receber, parcelamento, controle de inadimplência, descontos, juros e multas automáticas.
                    </p>
                    <ul class="space-y-2">
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-blue-600 mr-2"></i>
                            Contas a pagar e receber
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-blue-600 mr-2"></i>
                            Parcelamento inteligente
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-blue-600 mr-2"></i>
                            Descontos, juros e multas
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-blue-600 mr-2"></i>
                            Controle de inadimplência
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-blue-600 mr-2"></i>
                            Pix, Cartão e Dinheiro
                        </li>
                    </ul>
                </div>

                <!-- Cadastro de Clientes -->
                <div class="card-hover bg-white p-8 rounded-xl shadow-lg border border-gray-100">
                    <div class="w-16 h-16 gradient-bg rounded-lg flex items-center justify-center mb-6">
                        <i class="fas fa-users text-3xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Gestão de Clientes</h3>
                    <p class="text-gray-600 mb-4">
                        Cadastro completo de clientes e fornecedores com busca rápida, histórico de ordens de serviço e relacionamento integrado.
                    </p>
                    <ul class="space-y-2">
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-blue-600 mr-2"></i>
                            Cadastro completo de dados
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-blue-600 mr-2"></i>
                            Busca por nome, CPF/CNPJ
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-blue-600 mr-2"></i>
                            Histórico de OS integrado
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-blue-600 mr-2"></i>
                            Gerenciamento de fornecedores
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-blue-600 mr-2"></i>
                            Apelidos para busca rápida
                        </li>
                    </ul>
                </div>

                <!-- Relatórios -->
                <div class="card-hover bg-white p-8 rounded-xl shadow-lg border border-gray-100">
                    <div class="w-16 h-16 gradient-bg rounded-lg flex items-center justify-center mb-6">
                        <i class="fas fa-chart-line text-3xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Relatórios e Dashboards</h3>
                    <p class="text-gray-600 mb-4">
                        Dashboard financeiro completo com visão geral, fluxo de caixa mensal, contas vencidas e análise por método de pagamento.
                    </p>
                    <ul class="space-y-2">
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-blue-600 mr-2"></i>
                            Dashboard financeiro
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-blue-600 mr-2"></i>
                            Fluxo de caixa mensal
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-blue-600 mr-2"></i>
                            Controle de contas vencidas
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-blue-600 mr-2"></i>
                            Análise por método de pagamento
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-blue-600 mr-2"></i>
                            Extratos financeiros
                        </li>
                    </ul>
                </div>

                <!-- Assinatura Digital -->
                <div class="card-hover bg-white p-8 rounded-xl shadow-lg border border-gray-100">
                    <div class="w-16 h-16 gradient-bg rounded-lg flex items-center justify-center mb-6">
                        <i class="fas fa-file-signature text-3xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Assinatura Digital</h3>
                    <p class="text-gray-600 mb-4">
                        Sistema integrado de assinatura digital de documentos para agilizar aprovações e contratos com seus clientes.
                    </p>
                    <ul class="space-y-2">
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-blue-600 mr-2"></i>
                            Envelopes digitais
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-blue-600 mr-2"></i>
                            Assinatura de contratos
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-blue-600 mr-2"></i>
                            Validade jurídica
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-blue-600 mr-2"></i>
                            Rastreamento de status
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-blue-600 mr-2"></i>
                            Integração com OS
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefícios -->
    <section class="py-20 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-blue-50 to-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    Por que escolher nosso sistema?
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Desenvolvido por especialistas para atender as necessidades específicas de mecânicas e oficinas
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="w-20 h-20 gradient-bg rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-building text-3xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Multi-Filial</h3>
                    <p class="text-gray-600">Gerencie múltiplas oficinas em uma conta</p>
                </div>

                <div class="text-center">
                    <div class="w-20 h-20 gradient-bg rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-search text-3xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Busca Inteligente</h3>
                    <p class="text-gray-600">Encontre clientes, produtos e OS rapidamente</p>
                </div>

                <div class="text-center">
                    <div class="w-20 h-20 gradient-bg rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-shield-alt text-3xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Seguro</h3>
                    <p class="text-gray-600">Dados isolados por tenant, com backup diário</p>
                </div>

                <div class="text-center">
                    <div class="w-20 h-20 gradient-bg rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-mobile-alt text-3xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Responsivo</h3>
                    <p class="text-gray-600">Funciona perfeitamente em todos os dispositivos</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Planos -->
    <section id="planos" class="py-20 px-4 sm:px-6 lg:px-8 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    Planos que cabem no seu bolso
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Escolha o plano ideal para o tamanho da sua oficina
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                <!-- Plano Básico -->
                <div class="bg-white rounded-2xl shadow-lg border-2 border-gray-200 p-8 hover:border-blue-500 transition">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Básico</h3>
                    <div class="mb-6">
                        <span class="text-4xl font-bold text-gray-900">R$ 49</span>
                        <span class="text-gray-600">/mês</span>
                    </div>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-start">
                            <i class="fas fa-check text-blue-600 mr-3 mt-1"></i>
                            <span class="text-gray-700">Até 100 ordens/mês</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-blue-600 mr-3 mt-1"></i>
                            <span class="text-gray-700">1 usuário</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-blue-600 mr-3 mt-1"></i>
                            <span class="text-gray-700">Gestão de clientes</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-blue-600 mr-3 mt-1"></i>
                            <span class="text-gray-700">Controle financeiro básico</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-blue-600 mr-3 mt-1"></i>
                            <span class="text-gray-700">Suporte por email</span>
                        </li>
                    </ul>
                    <a href="/register" class="block w-full text-center bg-gray-100 text-gray-900 px-6 py-3 rounded-lg font-semibold hover:bg-gray-200 transition">
                        Começar Teste Grátis
                    </a>
                </div>

                <!-- Plano Profissional -->
                <div class="bg-white rounded-2xl shadow-2xl border-4 border-blue-600 p-8 transform scale-105 relative">
                    <div class="absolute top-0 right-0 bg-blue-600 text-white px-4 py-1 rounded-bl-lg rounded-tr-lg text-sm font-semibold">
                        POPULAR
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Profissional</h3>
                    <div class="mb-6">
                        <span class="text-4xl font-bold gradient-text">R$ 99</span>
                        <span class="text-gray-600">/mês</span>
                    </div>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-start">
                            <i class="fas fa-check text-blue-600 mr-3 mt-1"></i>
                            <span class="text-gray-700">Ordens ilimitadas</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-blue-600 mr-3 mt-1"></i>
                            <span class="text-gray-700">Até 5 usuários</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-blue-600 mr-3 mt-1"></i>
                            <span class="text-gray-700">Controle de estoque completo</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-blue-600 mr-3 mt-1"></i>
                            <span class="text-gray-700">Relatórios avançados</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-blue-600 mr-3 mt-1"></i>
                            <span class="text-gray-700">Agenda online</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-blue-600 mr-3 mt-1"></i>
                            <span class="text-gray-700">Suporte prioritário</span>
                        </li>
                    </ul>
                    <a href="/register" class="block w-full text-center btn-primary text-white px-6 py-3 rounded-lg font-semibold">
                        Começar Teste Grátis
                    </a>
                </div>

                <!-- Plano Empresarial -->
                <div class="bg-white rounded-2xl shadow-lg border-2 border-gray-200 p-8 hover:border-blue-500 transition">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Empresarial</h3>
                    <div class="mb-6">
                        <span class="text-4xl font-bold text-gray-900">R$ 199</span>
                        <span class="text-gray-600">/mês</span>
                    </div>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-start">
                            <i class="fas fa-check text-blue-600 mr-3 mt-1"></i>
                            <span class="text-gray-700">Tudo do Profissional</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-blue-600 mr-3 mt-1"></i>
                            <span class="text-gray-700">Usuários ilimitados</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-blue-600 mr-3 mt-1"></i>
                            <span class="text-gray-700">Múltiplas filiais</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-blue-600 mr-3 mt-1"></i>
                            <span class="text-gray-700">API de integração</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-blue-600 mr-3 mt-1"></i>
                            <span class="text-gray-700">Treinamento personalizado</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-blue-600 mr-3 mt-1"></i>
                            <span class="text-gray-700">Suporte 24/7</span>
                        </li>
                    </ul>
                    <a href="/register" class="block w-full text-center bg-gray-100 text-gray-900 px-6 py-3 rounded-lg font-semibold hover:bg-gray-200 transition">
                        Começar Teste Grátis
                    </a>
                </div>
            </div>

            <div class="text-center mt-12">
                <p class="text-gray-600">
                    <i class="fas fa-shield-alt text-blue-600 mr-2"></i>
                    7 dias de teste grátis em todos os planos. Sem compromisso.
                </p>
            </div>
        </div>
    </section>

    <!-- CTA Final -->
    <section class="gradient-bg py-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center text-white">
            <h2 class="text-4xl md:text-5xl font-bold mb-6">
                Pronto para transformar sua oficina?
            </h2>
            <p class="text-xl mb-8 text-blue-100">
                Comece seu teste grátis hoje e veja como nosso sistema pode aumentar sua produtividade
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/register" class="bg-white text-blue-600 px-10 py-4 rounded-lg text-lg font-semibold hover:bg-gray-100 transition inline-block">
                    <i class="fas fa-rocket mr-2"></i>Começar Teste Grátis Agora
                </a>
            </div>
            <p class="mt-6 text-sm text-blue-100">
                Sem cartão de crédito necessário
            </p>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contato" class="bg-gray-900 text-white py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center mb-4">
                        <i class="fas fa-tools text-2xl text-blue-400 mr-2"></i>
                        <span class="text-xl font-bold">WSoft Technology</span>
                    </div>
                    <p class="text-gray-400">
                        Sistema completo de gestão para mecânicas e oficinas.
                    </p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Produto</h3>
                    <ul class="space-y-2">
                        <li><a href="#funcionalidades" class="text-gray-400 hover:text-white">Funcionalidades</a></li>
                        <li><a href="#planos" class="text-gray-400 hover:text-white">Planos</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Demonstração</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Empresa</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">Sobre Nós</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Blog</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Contato</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Contato</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-2"></i>
                            contato@wsoft.com.br
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone mr-2"></i>
                            (11) 9999-9999
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            São Paulo, SP
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2024 WSoft Technology. Todos os direitos reservados.</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                    // Close mobile menu if open
                    document.getElementById('mobile-menu').classList.add('hidden');
                }
            });
        });
    </script>
</body>
</html>
