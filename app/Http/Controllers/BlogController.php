<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogCategory;
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
        $blogs = $query->paginate(10); // 10 per page, change as needed
        return view('admin.blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = BlogCategory::all();
        return view('admin.blogs.create', compact('categories'));
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
        ]);

        // Handle file uploads
        foreach (['page_image', 'image_1', 'image_2'] as $field) {
            if ($request->hasFile($field)) {
                $validated[$field] = $request->file($field)->store('blogs', 'public');
            }
        }

        Blog::create($validated);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return view('admin.blogs.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        $categories = BlogCategory::all();
        return view('admin.blogs.edit', compact('blog', 'categories'));
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

        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully.');
    }
}