<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Blog::query();
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', "%{$search}%");
        }
        $blogs = $query->with(['category', 'tags'])->paginate(10);
        return view('admin.blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = BlogCategory::all();
        $tags = BlogTag::where('status', true)->get();
        return view('admin.blogs.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'cat_id' => 'required|integer',
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blogs,slug',
            'short_description' => 'required|string',
            'long_description' => 'required|string',
            'status' => 'required|boolean',
            'published_at' => 'nullable|date',
            'page_image' => 'nullable|image',
            'image_1' => 'nullable|image',
            'image_2' => 'nullable|image',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:blog_tags,id'
        ]);

        // Handle file uploads
        foreach (['page_image', 'image_1', 'image_2'] as $field) {
            if ($request->hasFile($field)) {
                $validated[$field] = $request->file($field)->store('blogs', 'public');
            }
        }

        $blog = Blog::create($validated);

        // Sync tags
        if ($request->has('tags')) {
            $blog->tags()->sync($request->input('tags'));
        }

        return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        $blog->load(['category', 'tags']);
        return view('admin.blogs.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        $categories = BlogCategory::all();
        $tags = BlogTag::where('status', true)->get();
        return view('admin.blogs.edit', compact('blog', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'cat_id' => 'required|integer',
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blogs,slug,' . $blog->id,
            'short_description' => 'required|string',
            'long_description' => 'required|string',
            'status' => 'required|boolean',
            'published_at' => 'nullable|date',
            'page_image' => 'nullable|image',
            'image_1' => 'nullable|image',
            'image_2' => 'nullable|image',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:blog_tags,id'
        ]);

        // Handle file uploads and removals
        foreach (['page_image', 'image_1', 'image_2'] as $field) {
            if ($request->has('remove_' . $field)) {
                if ($blog->$field) {
                    Storage::disk('public')->delete($blog->$field);
                    $validated[$field] = null;
                }
            } elseif ($request->hasFile($field)) {
                if ($blog->$field) {
                    Storage::disk('public')->delete($blog->$field);
                }
                $validated[$field] = $request->file($field)->store('blogs', 'public');
            } else {
                unset($validated[$field]);
            }
        }

        $blog->update($validated);

        // Sync tags
        $blog->tags()->sync($request->input('tags', []));

        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        // Delete associated images
        foreach (['page_image', 'image_1', 'image_2'] as $field) {
            if ($blog->$field) {
                Storage::disk('public')->delete($blog->$field);
            }
        }

        // Delete blog and its relationships
        $blog->tags()->detach();
        $blog->delete();

        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully.');
    }
}
