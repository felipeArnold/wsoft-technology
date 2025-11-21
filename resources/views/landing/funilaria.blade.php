<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistema para funilaria com controle de OS, orçamentos, gestão financeira e cadastro de clientes. Software completo para funilarias e oficinas de pintura.">
    <meta property="og:title" content="WSoft Tecnologia | Sistema para Funilaria e Pintura">
    <meta property="og:description" content="Software para funilaria que organiza OS, controla orçamentos e aumenta seus lucros.">
    <title>WSoft Tecnologia | Sistema para Funilaria e Pintura Automotiva</title>
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
                <p class="text-sm uppercase tracking-[0.2em] text-blue-200 mb-4">Software para funilaria e pintura</p>
                <h1 class="text-4xl md:text-5xl font-extrabold leading-tight">
                    Sistema para Funilaria Completo e Profissional
                </h1>
                <p class="mt-6 text-lg text-blue-100">
                    O melhor software para funilaria do mercado. Gerencie orçamentos detalhados, ordens de serviço com fotos, controle financeiro e cadastro de clientes em um único sistema. Ideal para funilarias e oficinas de pintura que querem crescer com organização.
                </p>
                <div class="mt-8 flex flex-wrap gap-4 text-sm text-blue-200">
                    <span class="inline-flex items-center gap-2"><i class="fa-solid fa-circle-check text-green-200"></i> Orçamentos detalhados com fotos</span>
                    <span class="inline-flex items-center gap-2"><i class="fa-solid fa-circle-check text-green-200"></i> Controle de OS por etapas</span>
                    <span class="inline-flex items-center gap-2"><i class="fa-solid fa-circle-check text-green-200"></i> Gestão financeira completa</span>
                    <span class="inline-flex items-center gap-2"><i class="fa-solid fa-circle-check text-green-200"></i> Histórico de veículos e clientes</span>
                </div>
            </div>
            <livewire:landing-register-form />
        </div>
    </section>

    <!-- Benefícios principais -->
    <section id="beneficios" class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto">
                <p class="text-sm font-semibold text-blue-600 uppercase tracking-[0.3em]">Benefícios para sua funilaria</p>
                <h2 class="mt-4 text-3xl md:text-4xl font-bold">Por que escolher nosso sistema para funilaria?</h2>
                <p class="mt-4 text-slate-600">Tudo que sua funilaria precisa para organizar processos, criar orçamentos profissionais e fidelizar clientes.</p>
            </div>
            <div class="mt-12 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                    <h3 class="text-xl font-semibold">Orçamentos com fotos</h3>
                    <p class="mt-3 text-slate-600">Crie orçamentos detalhados com fotos do veículo, descrição dos danos e valores discriminados por serviço.</p>
                </article>
                <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                    <h3 class="text-xl font-semibold">OS por etapas</h3>
                    <p class="mt-3 text-slate-600">Acompanhe cada fase do serviço: desmontagem, funilaria, preparação, pintura e montagem.</p>
                </article>
                <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                    <h3 class="text-xl font-semibold">Gestão de clientes</h3>
                    <p class="mt-3 text-slate-600">CRM completo para funilarias com histórico de serviços, veículos atendidos e comunicação integrada.</p>
                </article>
                <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                    <h3 class="text-xl font-semibold">Controle financeiro</h3>
                    <p class="mt-3 text-slate-600">Contas a pagar e receber, fluxo de caixa e relatórios financeiros para sua funilaria.</p>
                </article>
                <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                    <h3 class="text-xl font-semibold">Controle de materiais</h3>
                    <p class="mt-3 text-slate-600">Gerencie tintas, massas, lixas e outros materiais com controle de estoque e custos por OS.</p>
                </article>
                <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                    <h3 class="text-xl font-semibold">Fotos antes e depois</h3>
                    <p class="mt-3 text-slate-600">Documente cada serviço com fotos do estado inicial e final do veículo para transparência total.</p>
                </article>
                <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                    <h3 class="text-xl font-semibold">Relatórios gerenciais</h3>
                    <p class="mt-3 text-slate-600">Dashboard com indicadores de faturamento, tempo médio de serviço e performance da equipe.</p>
                </article>
            </div>
        </div>
    </section>

    <!-- Por que WSoft -->
    <section id="porque" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-12 items-center">
            <div>
                <p class="text-sm font-semibold text-blue-600 uppercase tracking-[0.3em]">Por que o WSoft Tecnologia?</p>
                <h2 class="mt-4 text-3xl font-bold">Software para funilaria pensado por quem entende do ramo</h2>
                <p class="mt-4 text-slate-600">
                    O WSoft foi desenvolvido especificamente para as necessidades de funilarias e oficinas de pintura. Diferente de sistemas genéricos, nosso software entende a rotina de uma funilaria: orçamentos detalhados com fotos, acompanhamento por etapas e controle de materiais.
                </p>
                <p class="mt-4 text-slate-600">
                    Com o WSoft, você transforma sua funilaria em um negócio organizado, profissional e lucrativo. Impressione seus clientes com orçamentos profissionais e acompanhamento transparente.
                </p>
                <ul class="mt-6 space-y-3 text-slate-800">
                    <li class="flex items-start gap-3"><i class="fa-solid fa-circle-check text-green-500 mt-1"></i> Interface simples que qualquer colaborador aprende rápido.</li>
                    <li class="flex items-start gap-3"><i class="fa-solid fa-circle-check text-green-500 mt-1"></i> Suporte especializado no setor automotivo.</li>
                    <li class="flex items-start gap-3"><i class="fa-solid fa-circle-check text-green-500 mt-1"></i> Implantação em dias com treinamento incluído.</li>
                </ul>
            </div>
            <div class="rounded-3xl bg-gradient-to-br from-blue-100 via-white to-emerald-100 p-8 shadow-xl border border-slate-100">
                <div class="grid grid-cols-2 gap-6 text-center">
                    <div>
                        <p class="text-4xl font-bold text-blue-700">+60%</p>
                        <p class="text-xs uppercase tracking-widest text-slate-500 mt-2">Orçamentos aprovados</p>
                    </div>
                    <div>
                        <p class="text-4xl font-bold text-blue-700">2x</p>
                        <p class="text-xs uppercase tracking-widest text-slate-500 mt-2">Mais serviços por mês</p>
                    </div>
                    <div>
                        <p class="text-4xl font-bold text-blue-700">10 min</p>
                        <p class="text-xs uppercase tracking-widest text-slate-500 mt-2">Para criar orçamento</p>
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
