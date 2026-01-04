@props(['currentPost', 'limit' => 3])

@php
use App\Models\Blog\BlogPost;

// Buscar posts relacionados pela mesma categoria ou tags
$relatedPosts = BlogPost::query()
    ->published()
    ->where('id', '!=', $currentPost->id)
    ->when($currentPost->category_id, function ($query) use ($currentPost) {
        $query->where('category_id', $currentPost->category_id);
    })
    ->inRandomOrder()
    ->limit($limit)
    ->get();

// Se não encontrar posts da mesma categoria, buscar posts recentes
if ($relatedPosts->count() < $limit) {
    $existingIds = $relatedPosts->pluck('id')->push($currentPost->id)->toArray();

    $additionalPosts = BlogPost::query()
        ->published()
        ->whereNotIn('id', $existingIds)
        ->latest('published_at')
        ->limit($limit - $relatedPosts->count())
        ->get();

    $relatedPosts = $relatedPosts->merge($additionalPosts);
}
@endphp

@if($relatedPosts->count() > 0)
<section class="mt-12 pt-8 border-t border-slate-200">
    <h2 class="text-2xl font-bold text-slate-900 mb-6">Artigos Relacionados</h2>

    <div class="grid md:grid-cols-{{ min($relatedPosts->count(), 3) }} gap-6">
        @foreach($relatedPosts as $post)
        <article class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow overflow-hidden border border-slate-100">
            @if($post->featured_image)
            <a href="{{ route('blog.show', $post->slug) }}" class="block">
                <img
                    src="{{ $post->featured_image }}"
                    alt="{{ $post->title }}"
                    class="w-full h-48 object-cover"
                    loading="lazy"
                >
            </a>
            @endif

            <div class="p-5">
                @if($post->category)
                <span class="inline-block px-3 py-1 text-xs font-semibold text-blue-600 bg-blue-50 rounded-full mb-3">
                    {{ $post->category->name }}
                </span>
                @endif

                <h3 class="text-lg font-bold text-slate-900 mb-2 line-clamp-2">
                    <a href="{{ route('blog.show', $post->slug) }}" class="hover:text-blue-600 transition">
                        {{ $post->title }}
                    </a>
                </h3>

                @if($post->excerpt)
                <p class="text-sm text-slate-600 mb-4 line-clamp-3">
                    {{ $post->excerpt }}
                </p>
                @endif

                <div class="flex items-center justify-between text-xs text-slate-500">
                    <time datetime="{{ $post->published_at?->toIso8601String() }}">
                        {{ $post->published_at?->format('d/m/Y') }}
                    </time>

                    <a href="{{ route('blog.show', $post->slug) }}"
                       class="text-blue-600 hover:text-blue-700 font-semibold">
                        Ler mais →
                    </a>
                </div>
            </div>
        </article>
        @endforeach
    </div>

    <!-- Schema.org - ItemList para posts relacionados -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "ItemList",
        "itemListElement": [
            @foreach($relatedPosts as $index => $post)
            {
                "@type": "ListItem",
                "position": {{ $index + 1 }},
                "url": "{{ route('blog.show', $post->slug) }}",
                "name": {{ json_encode($post->title) }}
            }{{ !$loop->last ? ',' : '' }}
            @endforeach
        ]
    }
    </script>
</section>
@endif
