<div class="{{ $dismissed ? 'hidden' : 'bg-gradient-to-br from-primary-50 to-white dark:from-gray-800 dark:to-gray-900 rounded-xl shadow-lg border border-primary-100 dark:border-gray-700 p-6 mb-6' }}">
    {{-- Header --}}
    <div class="flex items-start justify-between mb-6">
        <div class="flex-1">
            <div class="flex items-center gap-3">
                <div class="flex-shrink-0 w-12 h-12 bg-primary-600 rounded-xl flex items-center justify-center shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                        Bem-vindo ao Sistema{{ $userName ? ', ' . $userName : '' }}!
                    </h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-0.5">
                        Complete estes passos para começar a usar todas as funcionalidades
                    </p>
                </div>
            </div>
        </div>
        <div class="flex items-center gap-2">
            {{-- Botão de Compartilhar --}}
            <button
                x-data="{
                    copied: @entangle('linkCopied'),
                    copyLink() {
                        const url = window.location.origin;
                        navigator.clipboard.writeText(url).then(() => {
                            $wire.notifyLinkCopied();
                            setTimeout(() => { this.copied = false; }, 3000);
                        });
                    }
                }"
                @click="copyLink()"
                class="flex-shrink-0 flex items-center gap-2 px-3 py-2 text-sm font-medium rounded-lg transition"
                :class="copied ? 'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400' : 'bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-400 hover:bg-primary-200 dark:hover:bg-primary-900/50'"
                :title="copied ? 'Link copiado!' : 'Compartilhar sistema'"
            >
                <svg x-show="!copied" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
                </svg>
                <svg x-show="copied" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" x-cloak>
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                </svg>
                <span x-text="copied ? 'Copiado!' : 'Compartilhar'"></span>
            </button>

            {{-- Botão de Dispensar --}}
            <button
                wire:click="dismiss"
                class="flex-shrink-0 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition p-1 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700"
                title="Dispensar"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- Progress Bar --}}
    <div class="mb-6 bg-white dark:bg-gray-800 rounded-lg p-4 shadow-sm border border-gray-100 dark:border-gray-700">
        <div class="flex items-center justify-between text-sm mb-3">
            <span class="font-semibold text-gray-700 dark:text-gray-300 flex items-center gap-2">
                <svg class="w-4 h-4 text-primary-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm9.707 5.707a1 1 0 00-1.414-1.414L9 12.586l-1.293-1.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                Progresso: {{ $progress['completed'] ?? 0 }}/{{ $progress['total'] ?? 0 }} concluídos
            </span>
            <span class="text-lg font-bold text-primary-600 dark:text-primary-400">
                {{ number_format($progress['percentage'] ?? 0, 0) }}%
            </span>
        </div>
        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3 overflow-hidden shadow-inner">
            <div
                class="bg-gradient-to-r from-primary-500 to-primary-600 h-3 rounded-full transition-all duration-700 ease-out shadow-lg"
                style="width: {{ $progress['percentage'] ?? 0 }}%"
            ></div>
        </div>
    </div>

    {{-- Steps Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
        @foreach(($progress['steps'] ?? []) as $step)
        <div class="group relative bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-md transition-all duration-200 border-2 {{ $step['completed'] ? 'border-green-500 dark:border-green-600' : 'border-gray-200 dark:border-gray-700 hover:border-primary-300 dark:hover:border-primary-600' }} overflow-hidden">
            {{-- Status Badge --}}
            <div class="absolute top-3 right-3 z-10">
                @if($step['completed'])
                    <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center shadow-lg ring-4 ring-green-100 dark:ring-green-900/50">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                @else
                    <div class="w-8 h-8 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center border-2 border-gray-300 dark:border-gray-600 font-semibold text-sm text-gray-600 dark:text-gray-400">
                        {{ $step['order'] }}
                    </div>
                @endif
            </div>

            {{-- Card Content --}}
            <div class="p-5">
                <div class="mb-4">
                    <h4 class="text-base font-bold text-gray-900 dark:text-white mb-2 pr-10 {{ $step['completed'] ? 'line-through opacity-60' : '' }}">
                        {{ $step['title'] }}
                    </h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed {{ $step['completed'] ? 'line-through opacity-50' : '' }}">
                        {{ $step['description'] }}
                    </p>
                </div>

                @if($step['completed'] && $step['completed_at'])
                    <div class="flex items-center gap-2 text-xs text-green-600 dark:text-green-400 bg-green-50 dark:bg-green-900/20 rounded-lg p-2.5 mt-3">
                        <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                        </svg>
                        <span class="font-medium">
                            Concluído em {{ $step['completed_at']->format('d/m/Y H:i') }}
                        </span>
                    </div>
                @else
                    @if($step['action_url'])
                    <a
                        href="{{ $step['action_url'] }}"
                        class="mt-3 w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold text-primary-700 dark:text-primary-400 bg-primary-50 dark:bg-primary-900/20 border-2 border-primary-200 dark:border-primary-700 rounded-lg hover:bg-primary-100 dark:hover:bg-primary-900/40 hover:border-primary-300 dark:hover:border-primary-600 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 group-hover:shadow-md"
                    >
                        <span>{{ $step['button_label'] ?? 'Iniciar' }}</span>
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>
                    @endif
                @endif
            </div>
        </div>
        @endforeach
    </div>

    {{-- Completion Message --}}
    @if($progress['is_completed'] ?? false)
    <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/30 dark:to-emerald-900/30 rounded-xl p-6 border-2 border-green-200 dark:border-green-800 shadow-lg">
        <div class="flex items-start gap-4">
            <div class="flex-shrink-0 w-12 h-12 bg-green-500 rounded-full flex items-center justify-center shadow-lg">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <div class="flex-1">
                <h4 class="text-lg font-bold text-green-900 dark:text-green-100 mb-1">
                    Parabéns! Você completou o onboarding!
                </h4>
                <p class="text-green-800 dark:text-green-200">
                    Sua oficina já está organizada e seu caixa atualizado. Agora você pode aproveitar todas as funcionalidades do sistema.
                </p>
            </div>
        </div>
    </div>
    @endif
</div>
