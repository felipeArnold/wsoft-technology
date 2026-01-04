@props(['items'])

@php
    $breadcrumbSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => []
    ];

    foreach ($items as $index => $item) {
        $breadcrumbSchema['itemListElement'][] = [
            '@type' => 'ListItem',
            'position' => $index + 1,
            'name' => $item['label'],
            'item' => $item['url'] ?? null
        ];
    }
@endphp

<!-- Breadcrumbs Schema.org -->
<script type="application/ld+json">
{!! json_encode($breadcrumbSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>

<!-- Breadcrumbs Visual -->
<nav aria-label="Breadcrumb" class="mb-6">
    <ol class="flex items-center space-x-2 text-sm text-slate-600" itemscope itemtype="https://schema.org/BreadcrumbList">
        @foreach ($items as $index => $item)
            <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="flex items-center">
                @if (isset($item['url']) && !$loop->last)
                    <a href="{{ $item['url'] }}"
                       itemprop="item"
                       class="hover:text-blue-600 transition">
                        <span itemprop="name">{{ $item['label'] }}</span>
                    </a>
                    <meta itemprop="position" content="{{ $index + 1 }}" />
                    <svg class="w-4 h-4 mx-2 text-slate-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                @else
                    <span itemprop="name" class="font-semibold text-slate-900">{{ $item['label'] }}</span>
                    <meta itemprop="position" content="{{ $index + 1 }}" />
                @endif
            </li>
        @endforeach
    </ol>
</nav>
