<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Section::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%")
                    ->orWhere('short_description', 'like', "%{$search}%");
            });
        }

        $sections = $query->latest()->paginate(10);
        return view('admin.sections.index', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sections.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:sections,slug',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'short_description' => 'required|string|max:500',
            'long_description' => 'required|string',
            'status' => 'required|boolean',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = Str::slug($request->title) . '-' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('sections', $filename, 'public');
            $validated['image'] = $path;
        }

        // Use user-provided slug or auto-generate if empty
        $validated['slug'] = $request->filled('slug') ? Str::slug($request->slug) : Str::slug($request->title);

        Section::create($validated);

        return redirect()->route('admin.sections.index')
            ->with('success', 'Section created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        return view('admin.sections.edit', compact('section'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Section $section)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:sections,slug,' . $section->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'short_description' => 'required|string|max:500',
            'long_description' => 'required|string',
            'status' => 'required|boolean',
        ]);

        if ($request->has('remove_image') && $request->remove_image) {
            if ($section->image) {
                Storage::disk('public')->delete($section->image);
            }
            $validated['image'] = null;
        } elseif ($request->hasFile('image')) {
            if ($section->image) {
                Storage::disk('public')->delete($section->image);
            }
            $file = $request->file('image');
            $filename = Str::slug($request->title) . '-' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('sections', $filename, 'public');
            $validated['image'] = $path;
        }

        // Use user-provided slug or auto-generate if empty
        $validated['slug'] = $request->filled('slug') ? Str::slug($request->slug) : Str::slug($request->title);

        $section->update($validated);

        return redirect()->route('admin.sections.index')
            ->with('success', 'Section updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section $section)
    {
        if ($section->image) {
            Storage::disk('public')->delete($section->image);
        }

        $section->delete();

        return redirect()->route('admin.sections.index')
            ->with('success', 'Section deleted successfully.');
    }
}