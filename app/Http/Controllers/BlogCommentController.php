<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogComment;
use Illuminate\Http\Request;

class BlogCommentController extends Controller
{
    public function index()
    {
        $comments = BlogComment::with('blog')->latest()->paginate(10);
        return view('admin.blog_comments.index', compact('comments'));
    }

    public function create()
    {
        $blogs = Blog::where('status', 1)->get();
        return view('admin.blog_comments.create', compact('blogs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'blog_id' => 'required|exists:blogs,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'description' => 'required|string',
            'status' => 'required|boolean',
            'is_active' => 'required|boolean',
        ]);

        BlogComment::create($request->all());

        return redirect()->route('admin.blog_comments.index')
            ->with('success', 'Blog comment created successfully.');
    }

    public function show(BlogComment $blog_comment)
    {
        return view('admin.blog_comments.show', compact('blog_comment'));
    }

    public function edit(BlogComment $blog_comment)
    {
        $blogs = Blog::where('status', 1)->get();
        return view('admin.blog_comments.edit', compact('blog_comment', 'blogs'));
    }

    public function update(Request $request, BlogComment $blog_comment)
    {
        $request->validate([
            'blog_id' => 'required|exists:blogs,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'description' => 'required|string',
            'status' => 'required|boolean',
            'is_active' => 'required|boolean',
        ]);

        $blog_comment->update($request->all());

        return redirect()->route('admin.blog_comments.index')
            ->with('success', 'Blog comment updated successfully.');
    }

    public function destroy(BlogComment $blog_comment)
    {
        $blog_comment->delete();

        return redirect()->route('admin.blog_comments.index')
            ->with('success', 'Blog comment deleted successfully.');
    }
}
