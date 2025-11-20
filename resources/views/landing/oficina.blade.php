<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistema de gestão para oficinas mecânicas com OS digital, controle financeiro, fluxo de caixa e cadastro de clientes e fornecedores.">
    <meta property="og:title" content="WSoft Tecnologia | Sistema de Gestão Empresarial para Oficinas">
    <meta property="og:description" content="Sistema financeiro online que organiza oficinas, elimina inadimplência e aumenta os lucros.">
    <title>WSoft Tecnologia | Sistema de Gestão para Oficinas Mecânicas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <meta name="google-site-verification" content="kHvaTl5DHIzqDIdHK0WctKwaxOcLvpCKu9FZWGD6Yg8" />

    <script async src="https://www.googletagmanager.com/gtag/js?id=G-MN5442GH2J"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-MN5442GH2J');
    </script>
</head>
<body class="bg-slate-50 text-slate-900 font-sans">
    <header class="fixed inset-x-0 top-0 z-50 bg-white/90 backdrop-blur border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <a href="#hero" class="flex items-center space-x-3 text-blue-900 font-semibold">
                    <img src="{{ asset('images/logo-azul.webp') }}" alt="WSoft Tecnologia | Sistema de Gestão para Pequenas Empresas" class="h-16 w-auto">
                </a>
                <nav class="hidden md:flex items-center space-x-6 text-sm font-medium">
                    <a href="#beneficios" class="hover:text-blue-600 transition">Benefícios</a>
                    <a href="#porque" class="hover:text-blue-600 transition">Por que WSoft</a>
                    <a href="#demo" class="hover:text-blue-600 transition">Demonstração</a>
                    <a href="#funcionalidades" class="hover:text-blue-600 transition">Funcionalidades</a>
                    <a href="#oferta" class="hover:text-blue-600 transition">Oferta</a>
                    <a href="#faq" class="hover:text-blue-600 transition">FAQ</a>
                </nav>
                <button id="menu-button" class="md:hidden text-2xl text-slate-700" aria-label="Abrir menu">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
            <div id="mobile-nav" class="md:hidden hidden pb-4">
                <nav class="flex flex-col space-y-2 text-sm font-semibold text-slate-700">
                    <a href="#beneficios" class="py-2 border-b border-slate-100">Benefícios</a>
                    <a href="#porque" class="py-2 border-b border-slate-100">Por que WSoft</a>
                    <a href="#demo" class="py-2 border-b border-slate-100">Demonstração</a>
                    <a href="#funcionalidades" class="py-2 border-b border-slate-100">Funcionalidades</a>
                    <a href="#oferta" class="py-2 border-b border-slate-100">Oferta</a>
                    <a href="#faq" class="py-2">FAQ</a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Hero -->
    <section id="hero" class="pt-32 pb-20 bg-gradient-to-b from-blue-950 to-blue-700 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-12 items-center">
            <div>
                <p class="text-sm uppercase tracking-[0.2em] text-blue-200 mb-4">Oficinas mecânicas · Auto centers · Funilarias</p>
                <h1 class="text-4xl md:text-5xl font-extrabold leading-tight">
                    Pare de Perder Dinheiro com Desorganização
                </h1>
                <p class="mt-6 text-lg text-blue-100">
                    Sistema de Gestão Empresarial que organiza seu financeiro, elimina inadimplência e aumenta seus lucros com um ERP simples voltado para oficinas. Tenha sistema de ordem de serviço, sistema de fluxo de caixa, controle de clientes e controle de produtos no mesmo painel, ideal como sistema para microempresa automotiva.
                </p>
                <div class="mt-8 flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('filament.app.auth.register') }}" class="inline-flex justify-center items-center rounded-lg bg-white text-blue-700 font-semibold px-8 py-4 shadow-sm hover:shadow-lg transition">
                        Testar grátis por 7 dias
                    </a>
                    <a href="#demo" class="inline-flex justify-center items-center rounded-lg border border-white/60 text-white font-semibold px-8 py-4 hover:bg-white/10 transition">
                        Acessar demonstração
                    </a>
                </div>
                <div class="mt-8 flex flex-wrap gap-4 text-sm text-blue-200">
                    <span class="inline-flex items-center gap-2"><i class="fa-solid fa-circle-check text-green-200"></i> Sem cartão de crédito</span>
                    <span class="inline-flex items-center gap-2"><i class="fa-solid fa-circle-check text-green-200"></i> Pensado para oficinas e auto centers</span>
                    <span class="inline-flex items-center gap-2"><i class="fa-solid fa-circle-check text-green-200"></i> Contas a pagar e receber</span>
                </div>
            </div>
            <div class="bg-white/10 border border-white/20 rounded-3xl p-8 backdrop-blur shadow-2xl">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm uppercase text-blue-200">Dashboard financeiro</p>
                        <h3 class="text-3xl font-bold mt-1">R$ 87.420</h3>
                        <p class="text-xs text-blue-100">Receitas confirmadas 30 dias</p>
                    </div>
                    <span class="text-xs px-3 py-1 rounded-full bg-white/20">ERP simples</span>
                </div>
                <div class="mt-8 space-y-4 text-sm">
                    <div class="flex justify-between border-b border-white/10 pb-4">
                        <span>Sistema de fluxo de caixa</span>
                        <span class="font-semibold">Atualizado em tempo real</span>
                    </div>
                    <div class="flex justify-between border-b border-white/10 pb-4">
                        <span>Ordens de serviço ativas</span>
                        <span class="font-semibold">42 OS</span>
                    </div>
                    <div class="flex justify-between border-b border-white/10 pb-4">
                        <span>Controle de inadimplência</span>
                        <span class="font-semibold text-rose-100">-32%</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Cadastro de clientes e fornecedores</span>
                        <span class="font-semibold">4.103 registros</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefícios principais -->
    <section id="beneficios" class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto">
                <p class="text-sm font-semibold text-blue-600 uppercase tracking-[0.3em]">Benefícios principais</p>
                <h2 class="mt-4 text-3xl md:text-4xl font-bold">Sistema de gestão para pequenas empresas do setor automotivo</h2>
                <p class="mt-4 text-slate-600">Mais velocidade para qualificar leads, organizar OS mecânicas e fechar serviços com transparência e organização empresarial.</p>
            </div>
            <div class="mt-12 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                    <h3 class="text-xl font-semibold">Feito para mecânicas e oficinas</h3>
                    <p class="mt-3 text-slate-600">Fluxos, cadastros e indicadores pensados para funilarias, auto centers e oficinas independentes.</p>
                </article>
                <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                    <h3 class="text-xl font-semibold">Controle de clientes</h3>
                    <p class="mt-3 text-slate-600">CRM completo com histórico, alertas, etiquetas e follow-ups para fidelizar sua carteira.</p>
                </article>
                <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                    <h3 class="text-xl font-semibold">Sistema de ordem de serviço</h3>
                    <p class="mt-3 text-slate-600">Organize cada OS com fotos, peças e assinatura digital integrada.</p>
                </article>
                <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                    <h3 class="text-xl font-semibold">Controle financeiro</h3>
                    <p class="mt-3 text-slate-600">Automatize contas a pagar e receber e tenha fluxo de caixa previsível.</p>
                </article>
                <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                    <h3 class="text-xl font-semibold">Controle de inadimplência</h3>
                    <p class="mt-3 text-slate-600">Régua inteligente com alertas, renegociação e relatórios.</p>
                </article>
                <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                    <h3 class="text-xl font-semibold">Cadastro completo</h3>
                    <p class="mt-3 text-slate-600">Clientes, fornecedores, produtos e veículos com histórico detalhado.</p>
                </article>
                <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                    <h3 class="text-xl font-semibold">Controle de produtos</h3>
                    <p class="mt-3 text-slate-600">Estoque com SKU, alertas, previsão de compras e integração com as OS.</p>
                </article>
            </div>
        </div>
    </section>

    <!-- Por que WSoft -->
    <section id="porque" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-12 items-center">
            <div>
                <p class="text-sm font-semibold text-blue-600 uppercase tracking-[0.3em]">Por que o WSoft Tecnologia?</p>
                <h2 class="mt-4 text-3xl font-bold">ERP simples feito sob medida para mecânicas</h2>
                <p class="mt-4 text-slate-600">
                    Enquanto outras plataformas complicam a rotina, o WSoft entrega um software de gestão empresarial direto ao ponto. Ideal para oficinas, auto centers e funilarias que precisam de organização empresarial sem burocracia.
                </p>
                <p class="mt-4 text-slate-600">
                    Você acompanha cada ordem de serviço, calcula margens, controla contas a pagar e receber e mantém todo o financeiro alinhado do orçamento ao faturamento.
                </p>
                <ul class="mt-6 space-y-3 text-slate-800">
                    <li class="flex items-start gap-3"><i class="fa-solid fa-circle-check text-green-500 mt-1"></i> Integração simples com formulários e WhatsApp.</li>
                    <li class="flex items-start gap-3"><i class="fa-solid fa-circle-check text-green-500 mt-1"></i> Onboarding em dias, sem custo adicional.</li>
                    <li class="flex items-start gap-3"><i class="fa-solid fa-circle-check text-green-500 mt-1"></i> Suporte humano que entende o universo automotivo.</li>
                </ul>
            </div>
            <div class="rounded-3xl bg-gradient-to-br from-blue-100 via-white to-emerald-100 p-8 shadow-xl border border-slate-100">
                <div class="grid grid-cols-2 gap-6 text-center">
                    <div>
                        <p class="text-4xl font-bold text-blue-700">+42%</p>
                        <p class="text-xs uppercase tracking-widest text-slate-500 mt-2">Leads convertidos</p>
                    </div>
                    <div>
                        <p class="text-4xl font-bold text-blue-700">3x</p>
                        <p class="text-xs uppercase tracking-widest text-slate-500 mt-2">Mais OS por mês</p>
                    </div>
                    <div>
                        <p class="text-4xl font-bold text-blue-700">6 min</p>
                        <p class="text-xs uppercase tracking-widest text-slate-500 mt-2">Resposta média</p>
                    </div>
                    <div>
                        <p class="text-4xl font-bold text-blue-700">R$ 0</p>
                        <p class="text-xs uppercase tracking-widest text-slate-500 mt-2">Custos escondidos</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Demonstração -->
    <section id="demo" class="py-20 bg-slate-900 text-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-sm uppercase tracking-[0.3em] text-blue-300">Demonstração em 5 minutos</p>
            <h2 class="mt-4 text-3xl font-bold">Veja como sua oficina fica organizada com o WSoft</h2>
            <p class="mt-4 text-blue-100 max-w-3xl mx-auto">
                Mostre como planejamento de oficina, estoque, sistema financeiro online e fluxo de caixa ficam 100% integrados na prática.
            </p>
            <div class="mt-10 rounded-3xl border border-white/20 bg-gradient-to-r from-blue-800 to-blue-600 p-10 shadow-2xl">
                <div class="aspect-video rounded-2xl border border-white/30 bg-white/5 flex items-center justify-center text-blue-100 text-lg">
                    Espaço reservado para imagem, vídeo ou tour guiado do sistema.
                </div>
            </div>
        </div>
    </section>

    <!-- Funcionalidades detalhadas -->
    <section id="funcionalidades" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto">
                <p class="text-sm font-semibold text-blue-600 uppercase tracking-[0.3em]">Funcionalidades detalhadas</p>
                <h2 class="mt-4 text-3xl font-bold">Ferramentas essenciais para oficinas conectadas</h2>
            </div>
            <div class="mt-12 grid gap-6 md:grid-cols-2 lg:grid-cols-4">
                <article class="rounded-2xl border border-slate-100 p-6 shadow-sm">
                    <h3 class="text-xl font-semibold">Clientes</h3>
                    <p class="mt-3 text-slate-600">Histórico completo, anexos, veículos e contratos.</p>
                </article>
                <article class="rounded-2xl border border-slate-100 p-6 shadow-sm">
                    <h3 class="text-xl font-semibold">Fornecedores</h3>
                    <p class="mt-3 text-slate-600">Tabela de preços, condições comerciais e notas.</p>
                </article>
                <article class="rounded-2xl border border-slate-100 p-6 shadow-sm">
                    <h3 class="text-xl font-semibold">Produtos</h3>
                    <p class="mt-3 text-slate-600">Lotes, estoque mínimo e kits de serviços.</p>
                </article>
                <article class="rounded-2xl border border-slate-100 p-6 shadow-sm">
                    <h3 class="text-xl font-semibold">Contas a pagar e receber</h3>
                    <p class="mt-3 text-slate-600">Automatização, conciliação e projeções.</p>
                </article>
                <article class="rounded-2xl border border-slate-100 p-6 shadow-sm">
                    <h3 class="text-xl font-semibold">Financeiro completo</h3>
                    <p class="mt-3 text-slate-600">Fluxo de caixa, metas e dashboards diários.</p>
                </article>
                <article class="rounded-2xl border border-slate-100 p-6 shadow-sm">
                    <h3 class="text-xl font-semibold">Dashboard</h3>
                    <p class="mt-3 text-slate-600">KPIs de marketing, OS e tickets médios.</p>
                </article>
                <article class="rounded-2xl border border-slate-100 p-6 shadow-sm">
                    <h3 class="text-xl font-semibold">OS</h3>
                    <p class="mt-3 text-slate-600">Fluxo completo do orçamento ao faturamento.</p>
                </article>
                <article class="rounded-2xl border border-slate-100 p-6 shadow-sm">
                    <h3 class="text-xl font-semibold">Inadimplência</h3>
                    <p class="mt-3 text-slate-600">Segmentação, régua de cobrança e exportação.</p>
                </article>
            </div>
        </div>
    </section>

    <!-- Prova social -->
    <section class="py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto">
                <p class="text-sm font-semibold text-blue-600 uppercase tracking-[0.3em]">Prova social</p>
                <h2 class="mt-4 text-3xl font-bold">Depoimentos reais de oficinas e auto centers</h2>
                <p class="mt-4 text-slate-600">Atualize os cards com histórias de clientes para reforçar confiança e autoridade.</p>
            </div>
            <div class="mt-12 grid gap-6 md:grid-cols-3">
                <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                    <p class="text-sm text-slate-600 italic">“Texto editável para depoimento de oficina 01.”</p>
                    <div class="mt-4 font-semibold">Nome do Cliente</div>
                    <div class="text-sm text-slate-500">Cidade / Estado</div>
                </article>
                <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                    <p class="text-sm text-slate-600 italic">“Texto editável para depoimento de oficina 02.”</p>
                    <div class="mt-4 font-semibold">Nome do Cliente</div>
                    <div class="text-sm text-slate-500">Cidade / Estado</div>
                </article>
                <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                    <p class="text-sm text-slate-600 italic">“Texto editável para depoimento de oficina 03.”</p>
                    <div class="mt-4 font-semibold">Nome do Cliente</div>
                    <div class="text-sm text-slate-500">Cidade / Estado</div>
                </article>
            </div>
        </div>
    </section>

    <!-- Oferta -->
    <section id="oferta" class="py-20 bg-gradient-to-br from-emerald-500 to-blue-600 text-white">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-sm uppercase tracking-[0.3em] text-white/80">Oferta exclusiva para oficinas mecânicas</p>
            <h2 class="mt-4 text-3xl font-bold">Sistema sem mensalidade fixa, com teste grátis e suporte dedicado</h2>
            <p class="mt-4 text-lg text-white/90">
                Comece com 7 dias de teste, valide seu processo e mantenha o WSoft como plataforma oficial da oficina. Relatórios mostram custos, margem de lucro e saúde financeira real.
            </p>
            <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('filament.app.auth.register') }}" class="inline-flex justify-center items-center rounded-lg bg-white text-blue-700 font-semibold px-10 py-4 shadow-lg hover:-translate-y-0.5 transition">
                    Testar grátis por 7 dias
                </a>
                <a href="#contato" class="inline-flex justify-center items-center rounded-lg border border-white/60 text-white font-semibold px-10 py-4 hover:bg-white/10 transition">
                    Quero organizar minha empresa
                </a>
            </div>
            <p class="mt-6 text-sm text-white/80">Bônus: setup gratuito + treinamento para equipe comercial.</p>
        </div>
    </section>

    <!-- FAQ -->
    <section id="faq" class="py-20 bg-white">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto">
                <p class="text-sm font-semibold text-blue-600 uppercase tracking-[0.3em]">FAQ</p>
                <h2 class="mt-4 text-3xl font-bold">Principais dúvidas sobre gestão e financeiro de oficinas</h2>
            </div>
            <div class="mt-12 space-y-4">
                <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                    <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                        Como o sistema ajuda a fechar mais ordens de serviço?
                        <span class="text-sm text-slate-500 group-open:hidden">+</span>
                        <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                    </summary>
                    <p class="mt-3 text-slate-600">Leads entram, viram orçamentos, são aprovados e se transformam em OS com acompanhamento completo, alertas e dashboards.</p>
                </details>
                <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                    <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                        O controle financeiro é completo?
                        <span class="text-sm text-slate-500 group-open:hidden">+</span>
                        <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                    </summary>
                    <p class="mt-3 text-slate-600">Sim. Tenha fluxo de caixa diário, contas a pagar e receber, além de relatórios por centro de custo.</p>
                </details>
                <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                    <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                        Posso usar em vários dispositivos?
                        <span class="text-sm text-slate-500 group-open:hidden">+</span>
                        <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                    </summary>
                    <p class="mt-3 text-slate-600">O sistema é 100% online e funciona em desktop, tablet ou smartphone.</p>
                </details>
                <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                    <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                        Existe suporte durante o teste gratuito?
                        <span class="text-sm text-slate-500 group-open:hidden">+</span>
                        <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                    </summary>
                    <p class="mt-3 text-slate-600">Sim, você recebe suporte humano e treinamento rápido para ativar a operação.</p>
                </details>
                <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                    <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                        Quanto tempo levo para começar?
                        <span class="text-sm text-slate-500 group-open:hidden">+</span>
                        <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                    </summary>
                    <p class="mt-3 text-slate-600">Ative em até 24h. Nosso time importa dados e organiza cadastros para você focar nas vendas.</p>
                </details>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contato" class="bg-slate-900 text-slate-100 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid md:grid-cols-4 gap-10">
            <div>
                <h3 class="text-lg font-semibold">WSoft Tecnologia</h3>
                <p class="mt-3 text-sm text-slate-400">Sistema para oficinas mecânicas focado em organização e crescimento.</p>
            </div>
            <div>
                <h4 class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Produto</h4>
                <ul class="mt-4 space-y-2 text-sm text-slate-300">
                    <li><a href="#beneficios" class="hover:text-white">Benefícios</a></li>
                    <li><a href="#demo" class="hover:text-white">Demonstração</a></li>
                    <li><a href="#faq" class="hover:text-white">FAQ</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Contato</h4>
                <ul class="mt-4 space-y-2 text-sm text-slate-300">
                    <li>contato@wsoft.com.br</li>
                    <li>(11) 99999-9999</li>
                    <li>São Paulo - SP</li>
                </ul>
            </div>
            <div>
                <h4 class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Redes</h4>
                <div class="mt-4 flex gap-3 text-lg">
                    <a href="#" class="hover:text-white"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" class="hover:text-white"><i class="fa-brands fa-linkedin"></i></a>
                    <a href="#" class="hover:text-white"><i class="fa-brands fa-facebook"></i></a>
                </div>
            </div>
        </div>
        <p class="mt-10 text-center text-xs text-slate-500">&copy; {{ now()->year }} WSoft Tecnologia. Todos os direitos reservados.</p>
    </footer>

    <script>
        const button = document.getElementById('menu-button');
        const mobileNav = document.getElementById('mobile-nav');
        if (button) {
            button.addEventListener('click', () => {
                mobileNav.classList.toggle('hidden');
            });
        }
    </script>
</body>
</html>

