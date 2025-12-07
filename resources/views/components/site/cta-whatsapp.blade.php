@props([
    'title' => 'Entre em Contato pelo WhatsApp',
    'subtitle' => 'Fale com nosso time de especialistas',
    'buttonText' => 'Chamar no WhatsApp',
    'phoneNumber' => '5551999350578',
    'gradient' => 'from-green-900 to-green-700',
    'bgClass' => 'bg-slate-50'
])

<section id="contato" class="py-20 {{ $bgClass }}">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
            <div class="grid md:grid-cols-2">
                <div class="p-10 bg-gradient-to-br {{ $gradient }} text-white flex flex-col justify-center">
                    <div class="mb-6">
                        <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mb-4">
                            <i class="fa-brands fa-whatsapp text-4xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-4">{{ $title }}</h3>
                        <p class="mb-6 opacity-90">{{ $subtitle }}</p>
                    </div>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-center gap-2">
                            <i class="fa-solid fa-check"></i> 
                            <span>Resposta rápida e personalizada</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fa-solid fa-check"></i> 
                            <span>Tire todas as suas dúvidas</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fa-solid fa-check"></i> 
                            <span>Atendimento humanizado</span>
                        </li>
                    </ul>
                </div>
                <div class="p-10 flex flex-col justify-center items-center text-center">
                    <div class="mb-6">
                        <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mb-4 mx-auto">
                            <i class="fa-brands fa-whatsapp text-green-600 text-4xl"></i>
                        </div>
                        <h4 class="text-xl font-bold text-slate-900 mb-2">Fale Conosco Agora</h4>
                        <p class="text-slate-600 mb-6">Clique no botão abaixo e inicie uma conversa pelo WhatsApp</p>
                    </div>
                    
                    <a 
                        href="https://wa.me/{{ $phoneNumber }}" 
                        target="_blank"
                        rel="noopener noreferrer"
                        class="w-full bg-gradient-to-r from-green-600 to-green-500 hover:from-green-500 hover:to-green-400 text-white font-bold px-8 py-4 rounded-xl shadow-lg shadow-green-500/20 hover:shadow-green-500/40 transform hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center gap-3"
                    >
                        <i class="fa-brands fa-whatsapp text-2xl"></i>
                        <span>{{ $buttonText }}</span>
                    </a>
                    
                    <p class="text-sm text-slate-500 mt-4">
                        Estamos prontos para atendê-lo!
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
