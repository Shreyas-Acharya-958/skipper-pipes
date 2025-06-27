<?php

namespace App\Http\Controllers;

use App\Models\BlogComment;
use Illuminate\Http\Request;

class BlogCommentController extends Controller
{
    public function index()
    {
        $comments = BlogComment::all();
        return view('admin.blog_comments.index', compact('comments'));
    }

    public function create()
    {
        return view('admin.blog_comments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'blog_id' => 'required|integer|exists:blogs,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'description' => 'required|string',
            'status' => 'required|boolean'
        ]);

        BlogComment::create($request->all());

        return redirect()->route('admin.blog_comments.index')->with('success', 'Blog comment created successfully.');
    }

    public function show(BlogComment $comment)
    {
        return view('admin.blog_comments.show', compact('comment'));
    }

    public function edit(BlogComment $comment)
    {
        return view('admin.blog_comments.edit', compact('comment'));
    }

    public function update(Request $request, BlogComment $comment)
    {
        $request->validate([
            'blog_id' => 'required|integer|exists:blogs,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'description' => 'required|string',
            'status' => 'required|boolean'
        ]);

        $comment->update($request->all());

        return redirect()->route('admin.blog_comments.index')->with('success', 'Blog comment updated successfully.');
    }

    public function destroy(BlogComment $comment)
    {
        $comment->delete();

        return redirect()->route('admin.blog_comments.index')->with('success', 'Blog comment deleted successfully.');
    }
}
