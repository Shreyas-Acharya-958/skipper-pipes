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
        $baseValidated = $request->validate([
            'title' => 'required|string|max:255',
            'press_release' => 'required|date',
            'sequence' => 'required|integer|min:0',
            'status' => 'required|boolean',
            'content_type' => 'required|in:pdf,image,link',
        ]);

        $data = $baseValidated;

        if ($request->input('content_type') === 'link') {
            $request->validate([
                'file_link' => 'required|url|max:2048',
            ]);
            $data['file'] = $request->input('file_link');
        } elseif ($request->input('content_type') === 'pdf') {
            $request->validate([
                'file' => 'required|file|mimes:pdf|max:10240',
            ]);
            $path = $request->file('file')->store('news', 'public');
            $data['file'] = $path;
        } else { // image
            $request->validate([
                'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10240',
            ]);
            $path = $request->file('file')->store('news', 'public');
            $data['file'] = $path;
        }

        News::create($data);

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'News created successfully.');
    }



    public function edit(News $news)
    {
        return view('admin.news.form', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $baseValidated = $request->validate([
            'title' => 'required|string|max:255',
            'press_release' => 'required|date',
            'sequence' => 'required|integer|min:0',
            'status' => 'required|boolean',
            'content_type' => 'required|in:pdf,image,link',
        ]);

        $data = $baseValidated;

        if ($request->input('content_type') === 'link') {
            $request->validate([
                'file_link' => 'required|url|max:2048',
            ]);
            // Delete old stored file if it was a storage path
            if ($news->file && !preg_match('/^https?:\/\//i', $news->file)) {
                Storage::disk('public')->delete($news->file);
            }
            $data['file'] = $request->input('file_link');
        } elseif ($request->input('content_type') === 'pdf') {
            $request->validate([
                'file' => 'nullable|file|mimes:pdf|max:10240',
            ]);
            if ($request->hasFile('file')) {
                if ($news->file && !preg_match('/^https?:\/\//i', $news->file)) {
                    Storage::disk('public')->delete($news->file);
                }
                $path = $request->file('file')->store('news', 'public');
                $data['file'] = $path;
            } elseif ($request->input('remove_file') == 1) {
                if ($news->file && !preg_match('/^https?:\/\//i', $news->file)) {
                    Storage::disk('public')->delete($news->file);
                }
                $data['file'] = null;
            }
        } else { // image
            $request->validate([
                'file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10240',
            ]);
            if ($request->hasFile('file')) {
                if ($news->file && !preg_match('/^https?:\/\//i', $news->file)) {
                    Storage::disk('public')->delete($news->file);
                }
                $path = $request->file('file')->store('news', 'public');
                $data['file'] = $path;
            } elseif ($request->input('remove_file') == 1) {
                if ($news->file && !preg_match('/^https?:\/\//i', $news->file)) {
                    Storage::disk('public')->delete($news->file);
                }
                $data['file'] = null;
            }
        }

        $news->update($data);

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

    public function show()
    {
        $newsSectionOne = \App\Models\NewsSectionOne::first();
        $newsSectionTwo = \App\Models\NewsSectionTwo::first();
        return view('admin.news.section', compact('newsSectionOne', 'newsSectionTwo'));
    }
    public function saveSectionOne(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $section = \App\Models\NewsSectionOne::first() ?? new \App\Models\NewsSectionOne();
        $section->fill($validated);
        $section->save();

        return redirect()->back()->with('success', 'News Section One saved successfully.');
    }

    public function saveSectionTwo(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $section = \App\Models\NewsSectionTwo::first() ?? new \App\Models\NewsSectionTwo();

        if ($request->hasFile('image')) {
            // Delete existing image
            if ($section->image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($section->image);
            }

            // Upload new image
            $file = $request->file('image');
            $filename = 'news-section2-' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('news/section2', $filename, 'public');
            $section->image = $path;
        }

        // Update other fields
        $section->title = $validated['title'] ?? $section->title;
        $section->description = $validated['description'] ?? $section->description;
        $section->save();

        return redirect()->back()->with('success', 'News Section Two saved successfully.');
    }
}