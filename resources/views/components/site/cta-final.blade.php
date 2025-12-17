@props([
    'title',
    'description',
    'footer' => 'Junte-se a centenas de empresas que usam WSoft',
    'gradient' => 'bg-gradient-to-br from-slate-800 to-slate-900',
    'textColor' => 'text-slate-300',
    'highlightColor' => 'text-orange-400',
    'buttonColor' => 'bg-orange-500 shadow-orange-500/30 hover:bg-orange-600',
    'registerUrl' => '/app/register',
    'priceUrl' => '/#precos'
])

<section {{ $attributes->merge(['class' => 'py-20 ' . $gradient . ' text-white']) }}>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold">{!! $title !!}</h2>
        <p class="mt-4 text-lg {{ $textColor }} max-w-2xl mx-auto">
            {!! $description !!}
        </p>
        <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ $registerUrl }}" class="inline-flex justify-center items-center rounded-xl {{ $buttonColor }} text-white font-bold px-10 py-4 shadow-lg hover:-translate-y-1 transition transform duration-200">
                Começar Agora
                <i class="fa-solid fa-arrow-right ml-2"></i>
            </a>
            @if($priceUrl)
            <a href="{{ $priceUrl }}" class="inline-flex justify-center items-center rounded-xl border border-white/60 text-white font-semibold px-10 py-4 hover:bg-white/10 transition backdrop-blur-sm">
                Ver Planos e Preços
            </a>
            @endif
        </div>
        <p class="mt-6 text-sm {{ $textColor }} opacity-80">{{ $footer }}</p>
    </div>
</section>
