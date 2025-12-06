@props([
    'title' => 'Dúvidas Frequentes',
    'subtitle' => 'FAQ',
    'subtitleColor' => 'text-emerald-600',
    'questions' => []
])

<section id="faq" class="py-20 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <p class="text-sm font-semibold {{ $subtitleColor }} uppercase tracking-[0.3em]">{{ $subtitle }}</p>
            <h2 class="mt-4 text-3xl font-bold">{{ $title }}</h2>
        </div>
        <div class="space-y-4">
            @foreach($questions as $faq)
                <details class="group rounded-2xl border border-slate-100 bg-slate-50 p-6 hover:bg-slate-100/50 transition-colors">
                    <summary class="flex justify-between items-center cursor-pointer font-semibold text-lg">
                        {{ $faq['question'] }}
                        <span class="text-2xl text-slate-400 group-open:hidden ml-4 flex-shrink-0">+</span>
                        <span class="text-2xl text-slate-400 hidden group-open:inline ml-4 flex-shrink-0">−</span>
                    </summary>
                    <div class="mt-4 text-slate-600 leading-relaxed">
                        {!! $faq['answer'] !!}
                    </div>
                </details>
            @endforeach
        </div>
    </div>
</section>
