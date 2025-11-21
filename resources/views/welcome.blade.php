<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="WSoft Tecnologia - Sistema de gestão para pequenas empresas com controle financeiro, ordens de serviço, cadastro de clientes e fluxo de caixa em uma única plataforma.">
    <title>WSoft Tecnologia | Sistema de Gestão para Pequenas Empresas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/png" href="{{ asset('images/icon.webp') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <meta name="google-site-verification" content="kHvaTl5DHIzqDIdHK0WctKwaxOcLvpCKu9FZWGD6Yg8" />
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-MN5442GH2J"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-MN5442GH2J');
    </script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'AW-11559494036');
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
                    <a href="/app/login" class="hover:text-blue-600 transition">Login</a>
                    <a href="/app/register" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Cadastrar</a>
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
                    <a href="#faq" class="py-2 border-b border-slate-100">FAQ</a>
                    <a href="/app/login" class="py-2 border-b border-slate-100">Login</a>
                    <a href="/app/register" class="py-2 text-blue-600">Cadastrar</a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Hero -->
    <section id="hero" class="pt-32 pb-20 bg-gradient-to-b from-blue-950 to-blue-700 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-12 items-center">
            <div>
                <p class="text-sm uppercase tracking-[0.2em] text-blue-200 mb-4">Software de gestão empresarial completo</p>
                <h1 class="text-4xl md:text-5xl font-extrabold leading-tight">
                    Sistema de gestão para pequenas empresas com foco em organização empresarial real
                </h1>
                <p class="mt-6 text-lg text-blue-100">
                    O WSoft é um sistema financeiro online que combina sistema de ordem de serviço, controle financeiro, controle de inadimplência e sistema de fluxo de caixa em um ERP simples e intuitivo. Ideal para quem precisa crescer rápido sem complicação.
                </p>
                <div class="mt-8 flex flex-col sm:flex-row gap-4">
                    <a href="/app/register" class="inline-flex justify-center items-center rounded-lg bg-white text-blue-700 font-semibold px-8 py-4 shadow-sm hover:shadow-lg transition">
                        Testar grátis por 7 dias
                    </a>
                    <a href="#demo" class="inline-flex justify-center items-center rounded-lg border border-white/60 text-white font-semibold px-8 py-4 hover:bg-white/10 transition">
                        Acessar demonstração
                    </a>
                </div>
                <div class="mt-8 flex flex-wrap gap-4 text-sm text-blue-200">
                    <span class="inline-flex items-center gap-2"><i class="fa-solid fa-circle-check text-green-200"></i> Controle de clientes e fornecedores</span>
                    <span class="inline-flex items-center gap-2"><i class="fa-solid fa-circle-check text-green-200"></i> Contas a pagar e receber</span>
                    <span class="inline-flex items-center gap-2"><i class="fa-solid fa-circle-check text-green-200"></i> Movimentação de fluxo de caixa</span>
                    <span class="inline-flex items-center gap-2"><i class="fa-solid fa-circle-check text-green-200"></i> Sistema de ordem de serviço (OS)</span>
                </div>
            </div>
            <div class="bg-white/10 border border-white/20 rounded-3xl p-8 backdrop-blur shadow-2xl">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm uppercase text-blue-200">Dash Financeiro</p>
                        <h3 class="text-3xl font-bold mt-1">R$ 124.890</h3>
                        <p class="text-xs text-blue-100">Receitas 30 dias</p>
                    </div>
                    <span class="text-xs px-3 py-1 rounded-full bg-white/20">Sistema para microempresa</span>
                </div>
                <div class="mt-8 space-y-4 text-sm">
                    <div class="flex justify-between border-b border-white/10 pb-4">
                        <span>Fluxo de caixa</span>
                        <span class="font-semibold">+21%</span>
                    </div>
                    <div class="flex justify-between border-b border-white/10 pb-4">
                        <span>Ordens de serviço abertas</span>
                        <span class="font-semibold">42</span>
                    </div>
                    <div class="flex justify-between border-b border-white/10 pb-4">
                        <span>Controle de inadimplência</span>
                        <span class="font-semibold text-rose-100">-35%</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Cadastro de clientes e fornecedores atualizados</span>
                        <span class="font-semibold">2.347</span>
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
                <h2 class="mt-4 text-3xl md:text-4xl font-bold">Controle total com linguagem simples e persuasiva</h2>
                <p class="mt-4 text-slate-600">Tudo que um pequeno empreendedor precisa para dar o próximo passo com segurança.</p>
            </div>
            <div class="mt-12 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                    <h3 class="text-xl font-semibold">Gestão financeira completa</h3>
                    <p class="mt-3 text-slate-600">Centralize controle financeiro, relatórios e indicadores em um painel único conectado ao sistema de fluxo de caixa.</p>
                </article>
                <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                    <h3 class="text-xl font-semibold">Cadastro de clientes, fornecedores e produtos</h3>
                    <p class="mt-3 text-slate-600">Atualize o cadastro de clientes e fornecedores com tags, anotações e controle de produtos sem planilhas.</p>
                </article>
                <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                    <h3 class="text-xl font-semibold">Contas a pagar e receber</h3>
                    <p class="mt-3 text-slate-600">Automatize cobranças e acompanhe prazos com alertas inteligentes para manter o caixa previsível.</p>
                </article>
                <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                    <h3 class="text-xl font-semibold">Sistema de ordem de serviço</h3>
                    <p class="mt-3 text-slate-600">Crie, aprove e monitore cada OS com fotos, checklist e notificações para equipes internas.</p>
                </article>
                <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                    <h3 class="text-xl font-semibold">Redução de inadimplência</h3>
                    <p class="mt-3 text-slate-600">Configure régua automática para controle de inadimplência com lembretes por e-mail e WhatsApp.</p>
                </article>
                <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                    <h3 class="text-xl font-semibold">Fluxo de caixa simples</h3>
                    <p class="mt-3 text-slate-600">Visualize previsões, metas e simulações em um painel de sistema financeiro online acessível.</p>
                </article>
            </div>
        </div>
    </section>

    <!-- Por que WSoft -->
    <section id="porque" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-12 items-center">
            <div>
                <p class="text-sm font-semibold text-blue-600 uppercase tracking-[0.3em]">Por que o WSoft Tecnologia?</p>
                <h2 class="mt-4 text-3xl font-bold">Um ERP simples, rápido e pensado para o dia a dia</h2>
                <p class="mt-4 text-slate-600">
                    O WSoft nasceu para ser um ERP simples, intuitivo e pronto para acelerar oficinas, mecânicas, lojas de serviços e qualquer sistema para microempresa que precise profissionalizar a operação.
                </p>
                <p class="mt-4 text-slate-600">
                    Com processos guiados e dashboards objetivos, você garante organização empresarial, previsibilidade e mais tempo para vender.
                </p>
                <ul class="mt-6 space-y-3 text-slate-800">
                    <li class="flex items-start gap-3"><i class="fa-solid fa-circle-check text-green-500 mt-1"></i> Implantação em dias, não em meses.</li>
                    <li class="flex items-start gap-3"><i class="fa-solid fa-circle-check text-green-500 mt-1"></i> Suporte humano especializado em pequenos negócios.</li>
                    <li class="flex items-start gap-3"><i class="fa-solid fa-circle-check text-green-500 mt-1"></i> Treinamentos rápidos para equipes administrativas e técnicas.</li>
                </ul>
            </div>
            <div class="rounded-3xl bg-gradient-to-br from-blue-100 via-white to-emerald-100 p-8 shadow-xl border border-slate-100">
                <div class="grid grid-cols-2 gap-6 text-center">
                    <div>
                        <p class="text-4xl font-bold text-blue-700">97%</p>
                        <p class="text-xs uppercase tracking-widest text-slate-500 mt-2">Clientes recomendam</p>
                    </div>
                    <div>
                        <p class="text-4xl font-bold text-blue-700">3x</p>
                        <p class="text-xs uppercase tracking-widest text-slate-500 mt-2">Mais produtividade</p>
                    </div>
                    <div>
                        <p class="text-4xl font-bold text-blue-700">15 min</p>
                        <p class="text-xs uppercase tracking-widest text-slate-500 mt-2">OS emitida</p>
                    </div>
                    <div>
                        <p class="text-4xl font-bold text-blue-700">R$ 0</p>
                        <p class="text-xs uppercase tracking-widest text-slate-500 mt-2">Custos ocultos</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Demonstração -->
    <section id="demo" class="py-20 bg-slate-900 text-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-sm uppercase tracking-[0.3em] text-blue-300">Demonstração ao vivo</p>
            <h2 class="mt-4 text-3xl font-bold">Veja o sistema em ação antes de decidir</h2>
            <p class="mt-4 text-blue-100 max-w-3xl mx-auto">
                Mostre para seu time como o software de gestão empresarial simplifica OS, financeiro e relacionamento com clientes em poucos cliques.
            </p>
            <div class="mt-10 rounded-3xl border border-white/20 bg-gradient-to-r from-blue-800 to-blue-600 p-10 shadow-2xl">
                <div class="aspect-video rounded-2xl border border-white/30 bg-white/5 flex items-center justify-center text-blue-100 text-lg">
                    Espaço reservado para print, mockup ou vídeo do sistema.
                </div>
            </div>
        </div>
    </section>

    <!-- Funcionalidades detalhadas -->
    <section id="funcionalidades" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto">
                <p class="text-sm font-semibold text-blue-600 uppercase tracking-[0.3em]">Funcionalidades detalhadas</p>
                <h2 class="mt-4 text-3xl font-bold">Tudo o que você precisa para crescer</h2>
            </div>
            <div class="mt-12 grid gap-6 md:grid-cols-2 lg:grid-cols-4">
                <article class="rounded-2xl border border-slate-100 p-6 shadow-sm">
                    <h3 class="text-xl font-semibold">Clientes</h3>
                    <p class="mt-3 text-slate-600">Controle de clientes com histórico, anotações, contratos e anexos em um só painel.</p>
                </article>
                <article class="rounded-2xl border border-slate-100 p-6 shadow-sm">
                    <h3 class="text-xl font-semibold">Fornecedores</h3>
                    <p class="mt-3 text-slate-600">Gestão completa de fornecedores, condições comerciais e documentos fiscais.</p>
                </article>
                <article class="rounded-2xl border border-slate-100 p-6 shadow-sm">
                    <h3 class="text-xl font-semibold">Produtos</h3>
                    <p class="mt-3 text-slate-600">Controle de produtos com lote, estoque mínimo e preços sempre atualizados.</p>
                </article>
                <article class="rounded-2xl border border-slate-100 p-6 shadow-sm">
                    <h3 class="text-xl font-semibold">Contas a pagar e receber</h3>
                    <p class="mt-3 text-slate-600">Fluxos automatizados, conciliações e alertas inteligentes contra atrasos.</p>
                </article>
                <article class="rounded-2xl border border-slate-100 p-6 shadow-sm">
                    <h3 class="text-xl font-semibold">Financeiro completo</h3>
                    <p class="mt-3 text-slate-600">Simule cenários, controle metas e gerencie o caixa diário com um clique.</p>
                </article>
                <article class="rounded-2xl border border-slate-100 p-6 shadow-sm">
                    <h3 class="text-xl font-semibold">Dashboard</h3>
                    <p class="mt-3 text-slate-600">Indicadores visuais sobre faturamento, inadimplência e performance comercial.</p>
                </article>
                <article class="rounded-2xl border border-slate-100 p-6 shadow-sm">
                    <h3 class="text-xl font-semibold">OS</h3>
                    <p class="mt-3 text-slate-600">Workflow completo para abertura, execução, aprovação e faturamento de OS.</p>
                </article>
                <article class="rounded-2xl border border-slate-100 p-6 shadow-sm">
                    <h3 class="text-xl font-semibold">Inadimplência</h3>
                    <p class="mt-3 text-slate-600">Segmentação de devedores, régua automática e exportação de relatórios.</p>
                </article>
            </div>
        </div>
    </section>

    <!-- Prova social -->
    <section class="py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto">
                <p class="text-sm font-semibold text-blue-600 uppercase tracking-[0.3em]">Prova social</p>
                <h2 class="mt-4 text-3xl font-bold">Histórias reais de pequenos empreendedores</h2>
                <p class="mt-4 text-slate-600">Edite os depoimentos abaixo com clientes atuais.</p>
            </div>
            <div class="mt-12 grid gap-6 md:grid-cols-3">
                <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                    <p class="text-sm text-slate-600 italic">“Resultado do cliente 01. Troque este texto por depoimentos reais.”</p>
                    <div class="mt-4 font-semibold">Nome do Cliente</div>
                    <div class="text-sm text-slate-500">Empresa / Cidade</div>
                </article>
                <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                    <p class="text-sm text-slate-600 italic">“Resultado do cliente 02. Troque este texto por depoimentos reais.”</p>
                    <div class="mt-4 font-semibold">Nome do Cliente</div>
                    <div class="text-sm text-slate-500">Empresa / Cidade</div>
                </article>
                <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                    <p class="text-sm text-slate-600 italic">“Resultado do cliente 03. Troque este texto por depoimentos reais.”</p>
                    <div class="mt-4 font-semibold">Nome do Cliente</div>
                    <div class="text-sm text-slate-500">Empresa / Cidade</div>
                </article>
            </div>
        </div>
    </section>

    <!-- Oferta -->
    <section id="oferta" class="py-20 bg-gradient-to-br from-emerald-500 to-blue-600 text-white">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-sm uppercase tracking-[0.3em] text-white/80">Oferta exclusiva</p>
            <h2 class="mt-4 text-3xl font-bold">Sistema sem mensalidade com teste gratuito</h2>
            <p class="mt-4 text-lg text-white/90">
                Assuma o controle do seu negócio com um modelo híbrido: comece com 7 dias de teste, migre para o plano completo e mantenha o WSoft como seu sistema sem mensalidade fixa por licença vitalícia.
            </p>
            <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="/app/register" class="inline-flex justify-center items-center rounded-lg bg-white text-blue-700 font-semibold px-10 py-4 shadow-lg hover:-translate-y-0.5 transition">
                    Testar grátis por 7 dias
                </a>
                <a href="#contato" class="inline-flex justify-center items-center rounded-lg border border-white/60 text-white font-semibold px-10 py-4 hover:bg-white/10 transition">
                    Quero organizar minha empresa
                </a>
            </div>
            <p class="mt-6 text-sm text-white/80">Sem taxa de implantação, suporte humano ilimitado.</p>
        </div>
    </section>

    <!-- FAQ -->
    <section id="faq" class="py-20 bg-white">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto">
                <p class="text-sm font-semibold text-blue-600 uppercase tracking-[0.3em]">FAQ</p>
                <h2 class="mt-4 text-3xl font-bold">Perguntas frequentes sobre gestão, financeiro e fluxo de caixa</h2>
            </div>
            <div class="mt-12 space-y-4">
                <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                    <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                        Como o WSoft ajuda no controle financeiro diário?
                        <span class="text-sm text-slate-500 group-open:hidden">+</span>
                        <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                    </summary>
                    <p class="mt-3 text-slate-600">O painel unifica entradas, saídas, projeções e limites para que você acompanhe o sistema de fluxo de caixa em tempo real.</p>
                </details>
                <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                    <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                        Posso controlar ordens de serviço e estoque?
                        <span class="text-sm text-slate-500 group-open:hidden">+</span>
                        <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                    </summary>
                    <p class="mt-3 text-slate-600">Sim, o sistema de ordem de serviço integra peças, mão de obra e controle de produtos para evitar erros e retrabalhos.</p>
                </details>
                <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                    <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                        Há recursos de contas a pagar e receber automáticos?
                        <span class="text-sm text-slate-500 group-open:hidden">+</span>
                        <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                    </summary>
                    <p class="mt-3 text-slate-600">Alertas, conciliações e integrações bancárias reduzem esquecimentos e mantêm o financeiro organizado.</p>
                </details>
                <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                    <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                        O que muda para quem precisa de controle de inadimplência?
                        <span class="text-sm text-slate-500 group-open:hidden">+</span>
                        <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                    </summary>
                    <p class="mt-3 text-slate-600">Você segmenta devedores, dispara lembretes e acompanha negociações diretamente do painel.</p>
                </details>
                <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6">
                    <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                        Preciso de equipe grande para usar o sistema?
                        <span class="text-sm text-slate-500 group-open:hidden">+</span>
                        <span class="text-sm text-slate-500 hidden group-open:inline">−</span>
                    </summary>
                    <p class="mt-3 text-slate-600">Não. O layout foi desenhado para pequenas empresas que querem profissionalizar processos sem burocracia.</p>
                </details>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contato" class="bg-slate-900 text-slate-100 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid md:grid-cols-4 gap-10">
            <div>
                <h3 class="text-lg font-semibold">WSoft Tecnologia</h3>
                <p class="mt-3 text-sm text-slate-400">Sistema de gestão para pequenas empresas que une organização empresarial e crescimento previsível.</p>
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
                    <li>Rolante/RS</li>
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

