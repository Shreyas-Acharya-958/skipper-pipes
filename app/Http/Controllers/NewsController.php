<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = News::query();

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('title', 'like', "%{$search}%");
        }

        $news = $query->orderBy('sequence')
            ->paginate(10)
            ->withQueryString();

        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'press_release' => 'required|date',
            'sequence' => 'required|integer|min:0',
            'status' => 'required|boolean',
            'file' => 'required|file|mimes:pdf|max:10240', // Max 10MB
        ]);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('news', 'public');
            $validated['file'] = $path;
        }

        News::create($validated);

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'News created successfully.');
    }

    public function show(News $news)
    {
        return view('admin.news.form', compact('news'));
    }

    public function edit(News $news)
    {
        return view('admin.news.form', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'press_release' => 'required|date',
            'sequence' => 'required|integer|min:0',
            'status' => 'required|boolean',
            'file' => 'nullable|file|mimes:pdf|max:10240', // Max 10MB
        ]);

        if ($request->hasFile('file')) {
            // Delete old file if exists
            if ($news->file) {
                Storage::disk('public')->delete($news->file);
            }
            $path = $request->file('file')->store('news', 'public');
            $validated['file'] = $path;
        } elseif ($request->input('remove_file') == 1 && $news->file) {
            Storage::disk('public')->delete($news->file);
            $validated['file'] = null;
        }

        $news->update($validated);

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'News updated successfully.');
    }

    public function destroy(News $news)
    {
        if ($news->file) {
            Storage::disk('public')->delete($news->file);
        }

        $news->delete();

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'News deleted successfully.');
    }

    public function updateSequence(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:news,id',
            'items.*.sequence' => 'required|integer|min:0'
        ]);

        foreach ($request->items as $item) {
            News::where('id', $item['id'])->update(['sequence' => $item['sequence']]);
        }

        return response()->json(['success' => true]);
    }
}
