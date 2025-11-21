<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    public function index()
    {
        $categories = BlogCategory::latest()->orderBy('id', 'desc')->paginate(100);
        return view('admin.blog_categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.blog_categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        BlogCategory::create($validated);

        return redirect()->route('admin.blog_categories.index')
            ->with('success', 'Blog category created successfully.');
    }

    public function show(BlogCategory $blog_category)
    {
        return view('admin.blog_categories.show', compact('blog_category'));
    }

    public function edit(BlogCategory $blog_category)
    {
        return view('admin.blog_categories.edit', compact('blog_category'));
    }

    public function update(Request $request, BlogCategory $blog_category)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        $blog_category->update($validated);

        return redirect()->route('admin.blog_categories.index')
            ->with('success', 'Blog category updated successfully.');
    }

    public function destroy(BlogCategory $blog_category)
    {
        $blog_category->delete();

        return redirect()->route('admin.blog_categories.index')
            ->with('success', 'Blog category deleted successfully.');
    }
}
