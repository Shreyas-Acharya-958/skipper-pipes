<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    public function index()
    {
        $categories = BlogCategory::all();
        return view('admin.blog_categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.blog_categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|boolean'
        ]);

        BlogCategory::create($request->all());

        return redirect()->route('admin.blog_categories.index')->with('success', 'Blog category created successfully.');
    }

    public function show(BlogCategory $category)
    {
        return view('admin.blog_categories.show', compact('category'));
    }

    public function edit(BlogCategory $category)
    {
        return view('admin.blog_categories.edit', compact('category'));
    }

    public function update(Request $request, BlogCategory $category)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|boolean'
        ]);

        $category->update($request->all());

        return redirect()->route('admin.blog_categories.index')->with('success', 'Blog category updated successfully.');
    }

    public function destroy(BlogCategory $category)
    {
        $category->delete();

        return redirect()->route('admin.blog_categories.index')->with('success', 'Blog category deleted successfully.');
    }
}
