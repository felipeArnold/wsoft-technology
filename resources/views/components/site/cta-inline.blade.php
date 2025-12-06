@props([
    'title',
    'description',
    'buttonText' => 'Começar Agora',
    'buttonUrl' => '/app/register',
    'gradient' => 'from-emerald-500 to-blue-500',
    'icon' => null
])

<div class="bg-gradient-to-r {{ $gradient }} px-8 py-12 rounded-3xl overflow-hidden relative">
    <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGRlZnM+PHBhdHRlcm4gaWQ9ImdyaWQiIHdpZHRoPSI2MCIgaGVpZ2h0PSI2MCIgcGF0dGVyblVuaXRzPSJ1c2VyU3BhY2VPblVzZSI+PHBhdGggZD0iTSAxMCAwIEwgMCAwIDAgMTAiIGZpbGw9Im5vbmUiIHN0cm9rZT0id2hpdGUiIHN0cm9rZS1vcGFjaXR5PSIwLjA1IiBzdHJva2Utd2lkdGg9IjEiLz48L3BhdHRlcm4+PC9kZWZzPjxyZWN0IHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIGZpbGw9InVybCgjZ3JpZCkiLz48L3N2Zz4=')] opacity-30"></div>

    <div class="relative z-10 max-w-4xl mx-auto">
        <div class="flex flex-col md:flex-row items-center gap-6">
            @if($icon)
                <div class="flex-shrink-0">
                    <div class="w-20 h-20 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center">
                        <i class="{{ $icon }} text-white text-3xl"></i>
                    </div>
                </div>
            @endif

            <div class="flex-1 text-center md:text-left">
                <h3 class="text-2xl md:text-3xl font-bold text-white mb-3">{!! $title !!}</h3>
                <p class="text-base md:text-lg text-white/90 leading-relaxed">{!! $description !!}</p>
            </div>

            <div class="flex-shrink-0">
                <a href="{{ $buttonUrl }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-white text-slate-900 font-bold px-6 md:px-8 py-4 shadow-xl hover:shadow-2xl hover:scale-105 transition-all duration-200">
                    {{ $buttonText }}
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>
