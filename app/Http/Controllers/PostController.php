<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    public function home()
    {
        $posts = Post::where('is_published', true)->latest()->take(3)->get();
        return Inertia::render('Welcome', ['posts' => $posts]);
    }

    public function portfolio()
    {
        $posts = Post::where('is_published', true)->latest()->get();
        return Inertia::render('Portfolio', ['posts' => $posts]);
    }

    public function show($locale, $slug)
    {
        // We find the post where slug->en or slug->id matches.
        // Since slug is a JSON column, we use JSON where.
        $post = Post::where('is_published', true)
            ->where(function ($query) use ($slug) {
                $query->where('slug->en', $slug)
                      ->orWhere('slug->id', $slug);
            })->firstOrFail();

        return Inertia::render('Portfolio/Show', ['post' => $post]);
    }

    /* ── Admin CRUD ─────────────────────────────── */

    public function index()
    {
        return Inertia::render('Posts/Index', [
            'posts' => Post::latest()->get(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Posts/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'           => 'required|array',
            'title.en'        => 'required|string|max:255',
            'slug'            => 'required|array',
            'slug.en'         => 'required|string|max:255',
            'content'         => 'required|array',
            'content.en'      => 'required|string',
            'excerpt'         => 'nullable|array',
            'seo_title'       => 'nullable|array',
            'seo_description' => 'nullable|array',
            'seo_keywords'    => 'nullable|array',
            'featured_image'  => 'nullable|image|max:2048',
            'gallery'         => 'nullable|array',
            'gallery.*'       => 'image|max:2048',
            'is_published'    => 'boolean',
        ]);

        $data = $request->only([
            'title', 'slug', 'content', 'excerpt',
            'seo_title', 'seo_description', 'seo_keywords',
            'is_published',
        ]);

        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('posts', 'public');
            $data['featured_image'] = '/storage/' . $path;
        }

        if ($request->hasFile('gallery')) {
            $galleryPaths = [];
            foreach ($request->file('gallery') as $file) {
                $path = $file->store('posts/gallery', 'public');
                $galleryPaths[] = '/storage/' . $path;
            }
            $data['gallery'] = $galleryPaths;
        }

        Post::create($data);

        return redirect()->route('posts.index')
            ->with('success', 'Post created successfully.');
    }

    public function edit(Post $post)
    {
        return Inertia::render('Posts/Edit', ['post' => $post]);
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title'           => 'required|array',
            'title.en'        => 'required|string|max:255',
            'slug'            => 'required|array',
            'slug.en'         => 'required|string|max:255',
            'content'         => 'required|array',
            'content.en'      => 'required|string',
            'excerpt'         => 'nullable|array',
            'seo_title'       => 'nullable|array',
            'seo_description' => 'nullable|array',
            'seo_keywords'    => 'nullable|array',
            'featured_image'  => 'nullable',
            'gallery'         => 'nullable|array',
            'is_published'    => 'boolean',
        ]);

        $data = $request->only([
            'title', 'slug', 'content', 'excerpt',
            'seo_title', 'seo_description', 'seo_keywords',
            'is_published',
        ]);

        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('posts', 'public');
            $data['featured_image'] = '/storage/' . $path;
        }

        // Check if there are new gallery files uploaded
        if ($request->hasFile('gallery')) {
            $galleryPaths = $post->gallery ?? [];
            foreach ($request->file('gallery') as $file) {
                if (is_file($file)) {
                    $path = $file->store('posts/gallery', 'public');
                    $galleryPaths[] = '/storage/' . $path;
                }
            }
            $data['gallery'] = $galleryPaths;
        } else {
            // Keep existing gallery if no new files, but handle removals
            // Note: If you want to support removing files, you would pass an array of existing URLs to keep.
            // Assuming $request->input('existing_gallery') contains URLs to keep.
            if ($request->has('existing_gallery')) {
                $data['gallery'] = $request->input('existing_gallery');
            }
        }

        $post->update($data);

        return redirect()->route('posts.index')
            ->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')
            ->with('success', 'Post deleted.');
    }
}
