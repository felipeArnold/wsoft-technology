<div class="space-y-2">
    @foreach ($variables as $variable => $label)
        <div class="flex items-center gap-2 mb-2" style=" border: 1px solid #ddd;padding: 6px;border-radius: 10px; margin-bottom: 4px;">
            <div class="w-full text-sm text-gray-600 dark:text-gray-300" style="width: 100%">{{ $label }}</div>
            <input type="hidden" readonly value="{{ $variable }}" class="w-2/3 fi-input block rounded-md border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-800 px-2 py-1 text-sm" />
            <button
                type="button"
                x-data="{ value: '{{ $variable }}', copied: false }"
                @click="navigator.clipboard.writeText(value); copied = true; setTimeout(() => copied = false, 1200)"
                class="fi-btn fi-btn-size-sm fi-btn-action text-xs"
                :class="copied ? 'bg-green-600 hover:bg-green-700 focus:ring-green-500' : 'bg-blue-600 hover:bg-blue-700 focus:ring-blue-500'"
            >
                <span x-show="!copied">Copiar</span>
                <span x-show="copied">Copiado</span>
            </button>
        </div>
    @endforeach
</div>



