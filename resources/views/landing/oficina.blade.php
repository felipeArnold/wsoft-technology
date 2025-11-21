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
    <link rel="icon" type="image/png" href="{{ asset('images/icon.webp') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <meta name="google-site-verification" content="kHvaTl5DHIzqDIdHK0WctKwaxOcLvpCKu9FZWGD6Yg8" />
    @livewireStyles

    <script async src="https://www.googletagmanager.com/gtag/js?id=G-MN5442GH2J"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-MN5442GH2J');
    </script>

    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-11559494036"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'AW-11559494036');
    </script>
</head>
<body class="bg-slate-50 text-slate-900 font-sans">

    <!-- Hero -->
    <section id="hero" class="pt-32 pb-20 bg-gradient-to-b from-blue-950 to-blue-700 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-12 items-center">
            <div>
                <p class="text-sm uppercase tracking-[0.2em] text-blue-200 mb-4">Oficinas mecânicas · Auto centers · Funilarias</p>
                <h1 class="text-4xl md:text-5xl font-extrabold leading-tight">
                    O Sistema de Gestão Completo Para Pequenas Empresas
                </h1>
                <p class="mt-6 text-lg text-blue-100">
                    Sistema de Gestão Empresarial que organiza seu financeiro, elimina inadimplência e aumenta seus lucros com um ERP simples voltado para oficinas. Tenha sistema de ordem de serviço, sistema de fluxo de caixa, controle de clientes e controle de produtos no mesmo painel, ideal como sistema para microempresa automotiva.
                </p>
                <div class="mt-8 flex flex-wrap gap-4 text-sm text-blue-200">
                    <span class="inline-flex items-center gap-2"><i class="fa-solid fa-circle-check text-green-200"></i> Controle de clientes e fornecedores</span>
                    <span class="inline-flex items-center gap-2"><i class="fa-solid fa-circle-check text-green-200"></i> Contas a pagar e receber</span>
                    <span class="inline-flex items-center gap-2"><i class="fa-solid fa-circle-check text-green-200"></i> Movimentação de fluxo de caixa</span>
                    <span class="inline-flex items-center gap-2"><i class="fa-solid fa-circle-check text-green-200"></i> Sistema de ordem de serviço (OS)</span>
                </div>
            </div>
            <livewire:landing-register-form />
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

    <script>
        const button = document.getElementById('menu-button');
        const mobileNav = document.getElementById('mobile-nav');
        if (button) {
            button.addEventListener('click', () => {
                mobileNav.classList.toggle('hidden');
            });
        }
    </script>
    @livewireScripts
</body>
</html>

