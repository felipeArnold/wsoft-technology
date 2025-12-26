<x-site-layout
    :title="'Quem Somos | WSoft Tecnologia'"
    :description="'Conheça a WSoft Tecnologia, empresa especializada em sistemas de gestão para pequenas empresas. Simplicidade e eficiência para o seu negócio.'"
    :keywords="'quem somos, wsoft tecnologia, sistema de gestão, sobre nós, empresa de software'"
    :canonical="route('site.quem-somos')"
>

    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 lg:pt-40 lg:pb-28 overflow-hidden">
        <!-- Background Gradient -->
        <div class="absolute inset-0 bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900">
            <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20 brightness-100 contrast-150 mix-blend-overlay"></div>
            <!-- Animated Blobs -->
            <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 rounded-full bg-blue-500/30 blur-3xl animate-pulse"></div>
            <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 rounded-full bg-indigo-500/20 blur-3xl animate-pulse" style="animation-delay: 2s;"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-500/10 border border-blue-400/20 backdrop-blur-sm text-blue-300 text-sm font-semibold mb-8 animate-fade-in-up">
                <span class="w-1.5 h-1.5 rounded-full bg-blue-400"></span>
                Nossa História e Propósito
            </div>
            
            <h1 class="text-4xl md:text-6xl font-extrabold text-white tracking-tight mb-6 animate-fade-in-up" style="animation-delay: 100ms;">
                Simplificando a Gestão de <br class="hidden md:block" />
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-200 via-white to-blue-200">Pequenos Negócios</span>
            </h1>
            
            <p class="mt-6 text-lg md:text-xl text-slate-300 max-w-3xl mx-auto leading-relaxed animate-fade-in-up" style="animation-delay: 200ms;">
                A WSoft Tecnologia nasceu com uma missão clara: ajudar empreendedores a organizarem suas empresas de forma simples, rápida e acessível.
            </p>
        </div>
    </section>

    <!-- Story Section -->
    <section class="py-20 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="relative group">
                    <div class="absolute -inset-4 bg-gradient-to-r from-blue-100 to-indigo-100 rounded-2xl transform rotate-3 transition-transform group-hover:rotate-2"></div>
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-100">
                        <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Equipe WSoft trabalhando" class="w-full h-auto transform transition duration-700 group-hover:scale-105">
                        
                        <!-- Floating Badge -->
                        <div class="absolute bottom-6 left-6 right-6 bg-white/95 backdrop-blur-sm p-6 rounded-xl shadow-lg border border-slate-200/50">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full bg-blue-600 flex items-center justify-center shrink-0">
                                    <i class="fa-solid fa-code text-white text-xl"></i>
                                </div>
                                <div>
                                    <p class="font-bold text-slate-900">Tecnologia com Propósito</p>
                                    <p class="text-sm text-slate-600">Desenvolvido por quem entende de pequenos negócios.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-6">Mais do que software, somos parceiros do seu crescimento</h2>
                    <div class="space-y-6 text-lg text-slate-600 leading-relaxed">
                        <p>
                            Sabemos que gerenciar uma pequena empresa no Brasil é um desafio diário. A burocracia, a falta de tempo e a complexidade de sistemas tradicionais sempre foram barreiras para quem quer crescer.
                        </p>
                        <p>
                            Foi por isso que criamos a WSoft. Não queríamos ser apenas mais um sistema cheio de botões que ninguém usa. Nosso foco é a <strong class="text-blue-700">usabilidade</strong>. Desenvolvemos
                            ferramentas que resolvem problemas reais: fluxo de caixa, inadimplência, organização de estoque e emissão de notas.
                        </p>
                        <p>
                            Hoje, atendemos centenas de oficinas, prestadores de serviço e comércios que, com a nossa ajuda, transformaram a bagunça em processos organizados e lucrativos.
                        </p>
                    </div>

                    <div class="mt-10 grid grid-cols-2 gap-6">
                        <div class="p-4 bg-slate-50 rounded-xl border border-slate-100">
                            <p class="text-3xl font-bold text-blue-600 mb-1">+500</p>
                            <p class="text-sm text-slate-600 font-medium">Empresas Atendidas</p>
                        </div>
                        <div class="p-4 bg-slate-50 rounded-xl border border-slate-100">
                            <p class="text-3xl font-bold text-blue-600 mb-1">98%</p>
                            <p class="text-sm text-slate-600 font-medium">Satisfação dos Clientes</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="py-24 bg-slate-50 relative overflow-hidden">
        <!-- Background Decorations -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full max-w-7xl pointer-events-none">
            <div class="absolute top-20 right-0 w-64 h-64 bg-blue-100 rounded-full blur-3xl opacity-60"></div>
            <div class="absolute bottom-20 left-0 w-64 h-64 bg-indigo-100 rounded-full blur-3xl opacity-60"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-blue-600 font-semibold tracking-wider uppercase text-sm">Nossos Pilares</span>
                <h2 class="mt-3 text-3xl md:text-4xl font-bold text-slate-900">O que nos move todos os dias</h2>
                <p class="mt-4 text-lg text-slate-600">Nossos valores são a base de cada linha de código que escrevemos e de cada atendimento que realizamos.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Value 1 -->
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="w-14 h-14 bg-blue-50 rounded-xl flex items-center justify-center mb-6 text-blue-600">
                        <i class="fa-regular fa-lightbulb text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Simplicidade Radical</h3>
                    <p class="text-slate-600 leading-relaxed">
                        Acreditamos que o complexo é inimigo da execução. Criamos interfaces limpas e processos intuitivos para que qualquer pessoa possa usar nosso sistema sem treinamento avançado.
                    </p>
                </div>

                <!-- Value 2 -->
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="w-14 h-14 bg-blue-50 rounded-xl flex items-center justify-center mb-6 text-blue-600">
                        <i class="fa-regular fa-handshake text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Parceria Real</h3>
                    <p class="text-slate-600 leading-relaxed">
                        Não vendemos apenas uma licença de software. Oferecemos suporte humanizado, ouvimos feedbacks e evoluímos a plataforma com base no que nossos clientes realmente precisam.
                    </p>
                </div>

                <!-- Value 3 -->
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="w-14 h-14 bg-blue-50 rounded-xl flex items-center justify-center mb-6 text-blue-600">
                        <i class="fa-solid fa-rocket text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Foco em Resultado</h3>
                    <p class="text-slate-600 leading-relaxed">
                        Nosso sucesso é medido pelo sucesso dos nossos clientes. Se o nosso sistema ajuda você a economizar tempo e ganhar mais dinheiro, cumprimos nossa missão.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Team CTA -->
    <section class="py-24 bg-gradient-to-br from-blue-900 to-slate-900 relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-10 mix-blend-overlay"></div>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h2 class="text-3xl md:text-5xl font-bold text-white mb-8">Faça parte dessa história de sucesso</h2>
            <p class="text-xl text-blue-100 mb-12 leading-relaxed">
                Junte-se a centenas de empresas que já transformaram sua gestão com a WSoft. Experimente sem compromisso e veja a diferença na prática.
            </p>
            
            <div class="flex flex-col sm:flex-row items-center justify-center gap-6">
                <a href="/app/register" class="w-full sm:w-auto px-8 py-4 bg-green-500 hover:bg-green-600 text-white font-bold rounded-xl shadow-lg shadow-green-500/25 transition-all transform hover:-translate-y-1 flex items-center justify-center gap-2">
                    Começar Teste Grátis
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
                <a href="https://wa.me/5548999999999" target="_blank" class="w-full sm:w-auto px-8 py-4 bg-white/10 hover:bg-white/20 text-white font-semibold rounded-xl backdrop-blur-sm transition-all flex items-center justify-center gap-2">
                    <i class="fa-brands fa-whatsapp text-xl"></i>
                    Falar com Consultor
                </a>
            </div>
            
            <p class="mt-8 text-sm text-blue-300/60">
                Sem necessidade de cartão de crédito para testar.
            </p>
        </div>
    </section>

</x-site-layout>
