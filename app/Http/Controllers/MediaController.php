<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Media::query();
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', "%{$search}%");
        }
        $media = $query->latest()->paginate(10);
        return view('admin.media.index', compact('media'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.media.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'file_type' => 'required|in:video,youtube_link,image,pdf',
            'media_type' => 'required|in:Company,Events,Awards',
        ];
        if ($request->file_type === 'youtube_link') {
            $rules['file'] = 'required|string|url';
        } else {
            $rules['file'] = 'nullable|file|max:10240';
        }
        $validated = $request->validate($rules);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = Str::slug($request->title) . '-media-' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('media', $filename, 'public');
            $validated['file'] = $path;
        } elseif ($request->file_type === 'youtube_link') {
            $validated['file'] = $request->input('file'); // store the link as string
        }

        Media::create($validated);

        return redirect()->route('admin.media.index')
            ->with('success', 'Media created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Media $media)
    {
        return view('admin.media.show', compact('media'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Media $media)
    {
        return view('admin.media.edit', compact('media'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Media $media)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'file_type' => 'required|in:video,youtube_link,image,pdf',
            'media_type' => 'required|in:Company,Events,Awards',
        ];
        if ($request->file_type === 'youtube_link') {
            $rules['file'] = 'required|string|url';
        } else {
            $rules['file'] = 'nullable|file|max:10240';
        }
        $validated = $request->validate($rules);

        if ($request->has('remove_file') && $request->remove_file) {
            if ($media->file && $media->file_type !== 'youtube_link') {
                Storage::disk('public')->delete($media->file);
            }
            $validated['file'] = null;
        } elseif ($request->hasFile('file')) {
            if ($media->file && $media->file_type !== 'youtube_link') {
                Storage::disk('public')->delete($media->file);
            }
            $file = $request->file('file');
            $filename = Str::slug($request->title) . '-media-' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('media', $filename, 'public');
            $validated['file'] = $path;
        } elseif ($request->file_type === 'youtube_link') {
            $validated['file'] = $request->input('file');
        }

        $media->update($validated);

        return redirect()->route('admin.media.index')
            ->with('success', 'Media updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Media $media)
    {
        if ($media->file && $media->file_type !== 'youtube_link') {
            Storage::disk('public')->delete($media->file);
        }
        $media->delete();
        return redirect()->route('admin.media.index')
            ->with('success', 'Media deleted successfully.');
    }
}
