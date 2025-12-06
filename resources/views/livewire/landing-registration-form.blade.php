<section id="cadastro" class="py-20 bg-slate-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
            <div class="grid md:grid-cols-2">
                <div class="p-10 bg-gradient-to-br {{ $gradient }} text-white flex flex-col justify-center">
                    <h3 class="text-2xl font-bold mb-4">{{ $title }}</h3>
                    <p class="mb-6 opacity-90">{{ $subtitle }}</p>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-center gap-2"><i class="fa-solid fa-check"></i> 7 dias grátis</li>
                        <li class="flex items-center gap-2"><i class="fa-solid fa-check"></i> Suporte 24/7</li>
                        <li class="flex items-center gap-2"><i class="fa-solid fa-check"></i> Cancelamento fácil</li>
                    </ul>
                </div>
                <div class="p-10">
                    @if($showSuccessMessage)
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">Obrigado! Em breve nossa equipe entrará em contato.</span>
                        </div>
                    @endif

                    @if($showErrorMessage)
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ $errorMessage }}</span>
                        </div>
                    @endif

                    <form wire:submit="submit" class="space-y-4">
                        <div class="space-y-1">
                            <label for="name" class="block text-sm font-medium text-slate-700 ml-1">Seu Nome</label>
                            <input
                                type="text"
                                wire:model="name"
                                id="name"
                                class="w-full px-4 py-2.5 rounded-xl border-2 border-slate-200 text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-{{ $focusColor }}-500/50 focus:border-{{ $focusColor }}-500 transition-all duration-300 @error('name') border-red-500 focus:ring-red-500/50 focus:border-red-500 @enderror"
                            >
                            @error('name')
                                <span class="text-xs text-red-600 ml-1 flex items-center gap-1 mt-1">
                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <label for="email" class="block text-sm font-medium text-slate-700 ml-1">E-mail</label>
                            <input
                                type="email"
                                wire:model="email"
                                id="email"
                                class="w-full px-4 py-2.5 rounded-xl border-2 border-slate-200 text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-{{ $focusColor }}-500/50 focus:border-{{ $focusColor }}-500 transition-all duration-300 @error('email') border-red-500 focus:ring-red-500/50 focus:border-red-500 @enderror"
                            >
                            @error('email')
                                <span class="text-xs text-red-600 ml-1 flex items-center gap-1 mt-1">
                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <label for="phone" class="block text-sm font-medium text-slate-700 ml-1">WhatsApp</label>
                            <input
                                type="tel"
                                wire:model="phone"
                                id="phone"
                                class="w-full px-4 py-2.5 rounded-xl border-2 border-slate-200 text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-{{ $focusColor }}-500/50 focus:border-{{ $focusColor }}-500 transition-all duration-300 @error('phone') border-red-500 focus:ring-red-500/50 focus:border-red-500 @enderror"
                            >
                            @error('phone')
                                <span class="text-xs text-red-600 ml-1 flex items-center gap-1 mt-1">
                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <button
                            type="submit"
                            class="w-full bg-gradient-to-r from-{{ $buttonColor }}-600 to-{{ $buttonColor }}-500 hover:from-{{ $buttonColor }}-500 hover:to-{{ $buttonColor }}-400 text-white font-bold px-6 py-3 rounded-xl shadow-lg shadow-{{ $buttonColor }}-500/20 hover:shadow-{{ $buttonColor }}-500/40 transform hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center gap-2 mt-2 disabled:opacity-75 disabled:cursor-wait"
                            wire:loading.attr="disabled"
                            wire:loading.class="opacity-75 cursor-wait"
                        >
                            <span wire:loading.remove>{{ $buttonText }}</span>
                            <span wire:loading class="flex items-center gap-2">
                                <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Enviando...
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
