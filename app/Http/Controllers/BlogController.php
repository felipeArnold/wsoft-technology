<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Blog\BlogCategory;
use App\Models\Blog\BlogPost;
use Illuminate\Http\Request;
use Illuminate\View\View;

final class BlogController extends Controller
{
    public function index(Request $request): View
    {
        $query = BlogPost::query()
            ->published()
            ->with(['category', 'author'])
            ->orderBy('published_at', 'desc');

        if ($request->filled('categoria')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->get('categoria'));
            });
        }

        if ($request->filled('busca')) {
            $search = $request->get('busca');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $posts = $query->paginate(9);
        $categories = BlogCategory::where('is_active', true)
            ->withCount(['posts' => function ($q) {
                $q->published();
            }])
            ->orderBy('name')
            ->get();

        $featuredPosts = BlogPost::query()
            ->published()
            ->featured()
            ->with(['category'])
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        return view('blog.index', compact('posts', 'categories', 'featuredPosts'));
    }

    public function show(string $slug): View
    {
        $post = BlogPost::query()
            ->published()
            ->where('slug', $slug)
            ->with(['category', 'author'])
            ->firstOrFail();

        $post->incrementViewCount();

        $relatedPosts = BlogPost::query()
            ->published()
            ->where('id', '!=', $post->id)
            ->when($post->category_id, function ($q) use ($post) {
                $q->where('category_id', $post->category_id);
            })
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        return view('blog.show', compact('post', 'relatedPosts'));
    }

    public function category(string $slug): View
    {
        $category = BlogCategory::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $posts = BlogPost::query()
            ->published()
            ->where('category_id', $category->id)
            ->with(['author'])
            ->orderBy('published_at', 'desc')
            ->paginate(9);

        $categories = BlogCategory::where('is_active', true)
            ->withCount(['posts' => function ($q) {
                $q->published();
            }])
            ->orderBy('name')
            ->get();

        return view('blog.category', compact('category', 'posts', 'categories'));
    }
}
