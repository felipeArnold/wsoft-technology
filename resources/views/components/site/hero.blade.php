@props([
    'badge' => null,
    'badgeIcon' => true,
    'title',
    'highlight',
    'description',
    'primaryButtonText' => 'Testar por 7 Dias',
    'primaryButtonUrl' => '/app/register',
    'secondaryButtonText' => 'Como Funciona',
    'secondaryButtonUrl' => '#como-funciona',
    'secondaryButtonIcon' => 'fa-solid fa-play',
    'stats' => [],
    'idealFor' => [],
    'idealForTitle' => 'Ideal para:',
    'image' => null,
    'gradient' => 'from-blue-950 via-blue-900 to-blue-800',
    'highlightGradient' => 'from-emerald-200 to-white'
])

<section id="hero" class="pt-32 pb-24 bg-gradient-to-b {{ $gradient }} text-white overflow-hidden relative">
    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 30px 30px;"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-16 items-center relative z-10">
        <div>
            @if($badge)
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-800/50 border border-blue-700 text-blue-200 text-xs font-semibold uppercase tracking-wider mb-6">
                    @if($badgeIcon)
                        <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                    @endif
                    {{ $badge }}
                </div>
            @endif

            <h1 class="text-4xl md:text-6xl font-extrabold leading-tight tracking-tight">
                <span class="text-transparent bg-clip-text bg-gradient-to-r {{ $highlightGradient }}">{{ $highlight }}</span> {{ $title }}
            </h1>

            <p class="mt-6 text-lg md:text-xl text-emerald-100 leading-relaxed max-w-lg">
                {{ $description }}
            </p>

            <div class="mt-10 flex flex-col sm:flex-row gap-4">
                <a href="{{ $primaryButtonUrl }}" class="inline-flex justify-center items-center rounded-xl bg-white text-emerald-700 font-bold px-8 py-4 shadow-lg shadow-white/30 hover:bg-emerald-50 hover:-translate-y-1 transition transform duration-200">
                    {{ $primaryButtonText }}
                    <i class="fa-solid fa-arrow-right ml-2"></i>
                </a>
                @if($secondaryButtonText)
                    <a href="{{ $secondaryButtonUrl }}" class="inline-flex justify-center items-center rounded-xl border border-white/30 text-white font-semibold px-8 py-4 hover:bg-white/10 transition backdrop-blur-sm">
                        <i class="{{ $secondaryButtonIcon }} mr-2"></i>
                        {{ $secondaryButtonText }}
                    </a>
                @endif
            </div>

            @if(count($stats) > 0)
                <div class="mt-16 grid grid-cols-3 gap-8">
                    @foreach($stats as $stat)
                        <div>
                            <div class="text-3xl font-bold text-emerald-300">{{ $stat['value'] }}</div>
                            <div class="text-sm text-blue-200 mt-1">{{ $stat['label'] }}</div>
                        </div>
                    @endforeach
                </div>
            @endif

            @if(count($idealFor) > 0)
                <div class="mt-10 pt-8 border-t border-white/10">
                    <p class="text-sm text-emerald-200 mb-4">{{ $idealForTitle }}</p>
                    <div class="flex flex-wrap gap-3 text-sm font-medium text-white">
                        @foreach($idealFor as $item)
                            <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">{{ $item }}</span>
                        @endforeach
                    </div>
                </div>
            @endif

            @isset($extra)
                {{ $extra }}
            @endisset
        </div>

        @if($image)
            <div class="relative">
                <div class="absolute inset-0 bg-gradient-to-tr from-emerald-400/20 to-blue-400/20 rounded-3xl blur-3xl"></div>
                <img src="{{ $image }}" alt="{{ $highlight }} {{ $title }}" class="relative rounded-2xl shadow-2xl border border-white/10">
            </div>
        @else
            {{ $slot }}
        @endif
    </div>
</section>
