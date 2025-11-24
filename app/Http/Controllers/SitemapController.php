<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Blog\BlogCategory;
use App\Models\Blog\BlogPost;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

final class SitemapController extends Controller
{
    public function index(): Response
    {
        // Cache the sitemap for 60 minutes to avoid database load on every request
        $content = Cache::remember('sitemap', 60 * 60, function () {
            $posts = BlogPost::query()
                ->published()
                ->orderBy('updated_at', 'desc')
                ->get();

            $categories = BlogCategory::where('is_active', true)->get();

            return view('seo.sitemap', compact('posts', 'categories'))->render();
        });

        return response($content, 200, [
            'Content-Type' => 'text/xml',
        ]);
    }
}
