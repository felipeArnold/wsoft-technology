<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
    <channel>
        <title>Blog WSoft Tecnologia</title>
        <link>{{ route('blog.index') }}</link>
        <description>Dicas e conteúdos sobre gestão empresarial, controle financeiro e muito mais.</description>
        <language>pt-BR</language>
        <lastBuildDate>{{ now()->toRssString() }}</lastBuildDate>
        <atom:link href="{{ url('/feed') }}" rel="self" type="application/rss+xml" />

        @foreach($posts as $post)
        <item>
            <title><![CDATA[{{ $post->title }}]]></title>
            <link>{{ route('blog.show', $post->slug) }}</link>
            <guid isPermaLink="true">{{ route('blog.show', $post->slug) }}</guid>
            <description><![CDATA[{{ $post->excerpt }}]]></description>
            <pubDate>{{ $post->published_at->toRssString() }}</pubDate>
            @if($post->author)
            <author>{{ $post->author->email ?? 'contato@wsoft.com.br' }} ({{ $post->author->name }})</author>
            @endif
            @if($post->category)
            <category>{{ $post->category->name }}</category>
            @endif
        </item>
        @endforeach
    </channel>
</rss>
