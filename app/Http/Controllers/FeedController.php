<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Blog\BlogPost;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

final class FeedController extends Controller
{
    public function index(): Response
    {
        // Cache the feed for 60 minutes
        $content = Cache::remember('rss_feed', 60 * 60, function () {
            $posts = BlogPost::query()
                ->published()
                ->with(['author', 'category'])
                ->orderBy('published_at', 'desc')
                ->limit(20)
                ->get();

            return view('seo.feed', compact('posts'))->render();
        });

        return response($content, 200, [
            'Content-Type' => 'application/xml',
        ]);
    }
}
