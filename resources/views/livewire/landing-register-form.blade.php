<div class="bg-white/10 border border-white/20 rounded-3xl p-8 backdrop-blur shadow-2xl">
    <div class="text-center mb-6">
        <h3 class="text-2xl font-bold">Comece agora</h3>
        <p class="text-sm text-blue-100 mt-2">Teste grátis por 7 dias, sem cartão de crédito</p>
    </div>

    <form wire:submit="register" class="space-y-4">
        <div>
            <label for="name" class="block text-sm font-medium text-blue-100 mb-1">Nome completo</label>
            <input
                type="text"
                id="name"
                wire:model="name"
                class="w-full px-4 py-3 rounded-lg bg-white/10 border border-white/20 text-white placeholder-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"
                placeholder="Seu nome"
            >
            @error('name')
                <span class="text-xs text-rose-300 mt-1">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-blue-100 mb-1">E-mail</label>
            <input
                type="email"
                id="email"
                wire:model="email"
                class="w-full px-4 py-3 rounded-lg bg-white/10 border border-white/20 text-white placeholder-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"
                placeholder="seu@email.com"
            >
            @error('email')
                <span class="text-xs text-rose-300 mt-1">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-blue-100 mb-1">Senha</label>
            <input
                type="password"
                id="password"
                wire:model="password"
                class="w-full px-4 py-3 rounded-lg bg-white/10 border border-white/20 text-white placeholder-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"
                placeholder="Mínimo 8 caracteres"
            >
            @error('password')
                <span class="text-xs text-rose-300 mt-1">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-blue-100 mb-1">Confirmar senha</label>
            <input
                type="password"
                id="password_confirmation"
                wire:model="password_confirmation"
                class="w-full px-4 py-3 rounded-lg bg-white/10 border border-white/20 text-white placeholder-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"
                placeholder="Repita a senha"
            >
        </div>

        <button
            type="submit"
            class="w-full bg-white text-blue-700 font-semibold px-6 py-4 rounded-lg shadow-sm hover:shadow-lg transition flex items-center justify-center gap-2"
            wire:loading.attr="disabled"
            wire:loading.class="opacity-75 cursor-wait"
        >
            <span wire:loading.remove>Criar conta grátis</span>
            <span wire:loading class="flex items-center gap-2">
                <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Criando...
            </span>
        </button>
    </form>

    <p class="text-xs text-blue-200 text-center mt-4">
        Já tem uma conta? <a href="{{ route('filament.app.auth.login') }}" class="underline hover:text-white">Fazer login</a>
    </p>
</div>
