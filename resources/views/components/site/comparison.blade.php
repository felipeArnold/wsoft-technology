@props([
    'title',
    'subtitle',
    'description',
    'painTitle' => 'Planilha / Manual',
    'painItems' => [],
    'gainTitle' => 'Sistema WSoft',
    'gainItems' => [],
    'gainCardBg' => 'bg-emerald-900',
    'gainCardBorder' => 'border-emerald-800',
    'gainTitleColor' => 'text-emerald-400',
    'gainCheckColor' => 'text-emerald-400',
    'gainBadgeBg' => 'bg-emerald-500',
    'gainBadgeText' => 'RECOMENDADO'
])

<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="{{ str_replace('text-', 'text-', $gainTitleColor) }} font-bold tracking-wider uppercase text-sm" style="filter: brightness(0.8);">{{ $subtitle }}</span>
            <h2 class="mt-2 text-3xl md:text-4xl font-extrabold text-slate-900">{!! $title !!}</h2>
            <p class="mt-4 text-lg text-slate-600">
                {!! $description !!}
            </p>
        </div>

        <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
            <!-- Pain (Planilha/Manual) -->
            <div class="bg-white p-8 rounded-3xl border border-slate-200 shadow-sm relative overflow-hidden group hover:shadow-lg transition">
                <div class="absolute top-0 right-0 bg-red-100 text-red-600 text-xs font-bold px-3 py-1 rounded-bl-xl">MANUAL</div>
                <h3 class="text-xl font-bold text-slate-700 mb-6 flex items-center gap-2">
                    <i class="fa-solid fa-file-excel text-red-500"></i> {{ $painTitle }}
                </h3>
                <ul class="space-y-4">
                    @foreach($painItems as $item)
                    <li class="flex items-start gap-3 text-slate-600">
                        <i class="fa-solid fa-xmark text-red-500 mt-1"></i>
                        <span>{!! $item !!}</span>
                    </li>
                    @endforeach
                </ul>
            </div>

            <!-- Gain (Sistema WSoft) -->
            <div class="{{ $gainCardBg }} p-8 rounded-3xl border {{ $gainCardBorder }} shadow-xl relative overflow-hidden group hover:-translate-y-1 transition duration-300">
                <div class="absolute top-0 right-0 {{ $gainBadgeBg }} text-white text-xs font-bold px-3 py-1 rounded-bl-xl uppercase">{{ $gainBadgeText }}</div>
                <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-2">
                    <i class="fa-solid fa-rocket {{ $gainTitleColor }}"></i> {{ $gainTitle }}
                </h3>
                <ul class="space-y-4">
                    @foreach($gainItems as $item)
                    <li class="flex items-start gap-3 text-white/90">
                        <i class="fa-solid fa-check {{ $gainCheckColor }} mt-1"></i>
                        <span>{!! $item !!}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>
