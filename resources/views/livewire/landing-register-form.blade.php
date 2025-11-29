<div class="bg-white/10 border border-white/20 rounded-3xl p-8 backdrop-blur-xl shadow-2xl relative overflow-hidden group">
    <!-- Decorative elements -->
    <div class="absolute -top-20 -right-20 w-40 h-40 bg-blue-500/30 rounded-full blur-3xl group-hover:bg-blue-500/40 transition-colors duration-500"></div>
    <div class="absolute -bottom-20 -left-20 w-40 h-40 bg-purple-500/30 rounded-full blur-3xl group-hover:bg-purple-500/40 transition-colors duration-500"></div>

    <div class="relative z-10">
        <div class="text-center mb-8">
            <h3 class="text-3xl font-bold text-white tracking-tight">Garanta sua Vaga</h3>
            <p class="text-blue-100 mt-2 font-light">Preencha para liberar seu acesso imediato.</p>
        </div>

        <form wire:submit="register" class="space-y-5">
            <div class="space-y-1">
                <label for="name" class="block text-sm font-medium text-blue-100 ml-1">Nome completo</label>
                <input
                    type="text"
                    id="name"
                    wire:model="name"
                    class="w-full px-5 py-3.5 rounded-xl bg-white/5 border border-white/10 text-white placeholder-blue-200/50 focus:outline-none focus:ring-2 focus:ring-blue-400/50 focus:border-blue-400/50 focus:bg-white/10 transition-all duration-300 backdrop-blur-sm"
                    placeholder="Seu nome"
                >
                @error('name')
                    <span class="text-xs text-rose-300 ml-1 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="space-y-1">
                <label for="email" class="block text-sm font-medium text-blue-100 ml-1">E-mail</label>
                <input
                    type="email"
                    id="email"
                    wire:model="email"
                    class="w-full px-5 py-3.5 rounded-xl bg-white/5 border border-white/10 text-white placeholder-blue-200/50 focus:outline-none focus:ring-2 focus:ring-blue-400/50 focus:border-blue-400/50 focus:bg-white/10 transition-all duration-300 backdrop-blur-sm"
                    placeholder="seu@email.com"
                >
                @error('email')
                    <span class="text-xs text-rose-300 ml-1 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="space-y-1">
                <label for="password" class="block text-sm font-medium text-blue-100 ml-1">Senha</label>
                <input
                    type="password"
                    id="password"
                    wire:model="password"
                    class="w-full px-5 py-3.5 rounded-xl bg-white/5 border border-white/10 text-white placeholder-blue-200/50 focus:outline-none focus:ring-2 focus:ring-blue-400/50 focus:border-blue-400/50 focus:bg-white/10 transition-all duration-300 backdrop-blur-sm"
                    placeholder="Mínimo 8 caracteres"
                >
                @error('password')
                    <span class="text-xs text-rose-300 ml-1 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="space-y-1">
                <label for="password_confirmation" class="block text-sm font-medium text-blue-100 ml-1">Confirmar senha</label>
                <input
                    type="password"
                    id="password_confirmation"
                    wire:model="password_confirmation"
                    class="w-full px-5 py-3.5 rounded-xl bg-white/5 border border-white/10 text-white placeholder-blue-200/50 focus:outline-none focus:ring-2 focus:ring-blue-400/50 focus:border-blue-400/50 focus:bg-white/10 transition-all duration-300 backdrop-blur-sm"
                    placeholder="Repita a senha"
                >
            </div>

            <button
                type="submit"
                class="w-full bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-500 hover:to-blue-400 text-white font-bold px-6 py-4 rounded-xl shadow-lg shadow-blue-500/20 hover:shadow-blue-500/40 transform hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center gap-2 mt-2"
                wire:loading.attr="disabled"
                wire:loading.class="opacity-75 cursor-wait"
            >
                <span wire:loading.remove>Ativar Meu Desconto Agora</span>
                <span wire:loading class="flex items-center gap-2">
                    <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Criando...
                </span>
            </button>
        </form>

        <p class="text-sm text-blue-200 text-center mt-6">
            Já tem uma conta? <a href="{{ route('filament.app.auth.login') }}" class="text-white font-medium hover:text-blue-200 transition-colors underline decoration-blue-400/50 hover:decoration-blue-200">Fazer login</a>
        </p>
    </div>
</div>
