<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ImageAltText;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ImageAltTextController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = ImageAltText::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('file_name', 'like', "%{$search}%")
                    ->orWhere('image_path', 'like', "%{$search}%")
                    ->orWhere('alt_text', 'like', "%{$search}%")
                    ->orWhere('directory', 'like', "%{$search}%");
            });
        }

        // Filter by directory
        if ($request->filled('directory')) {
            $query->where('directory', $request->input('directory'));
        }

        // Filter by has alt text
        if ($request->filled('has_alt_text')) {
            if ($request->input('has_alt_text') == 'yes') {
                $query->whereNotNull('alt_text')->where('alt_text', '!=', '');
            } else {
                $query->where(function ($q) {
                    $q->whereNull('alt_text')->orWhere('alt_text', '');
                });
            }
        }

        $images = $query->orderBy('directory')
            ->orderBy('file_name')
            ->paginate(50);

        // Get unique directories for filter
        $directories = ImageAltText::select('directory')
            ->whereNotNull('directory')
            ->distinct()
            ->orderBy('directory')
            ->pluck('directory');

        return view('admin.image-alt-texts.index', compact('images', 'directories'));
    }

    /**
     * Update alt text for multiple images
     */
    public function updateBatch(Request $request)
    {
        $request->validate([
            'images' => 'required|array',
            'images.*.id' => 'required|exists:image_alt_texts,id',
            'images.*.alt_text' => 'nullable|string|max:500',
        ]);

        $updated = 0;
        foreach ($request->input('images', []) as $imageData) {
            $image = ImageAltText::find($imageData['id']);
            if ($image) {
                $image->alt_text = $imageData['alt_text'] ?? null;
                $image->save();
                $updated++;
            }
        }

        return redirect()->back()
            ->with('success', "Successfully updated alt text for {$updated} image(s).");
    }

    /**
     * Update alt text for a single image
     */
    public function update(Request $request, ImageAltText $imageAltText)
    {
        $request->validate([
            'alt_text' => 'nullable|string|max:500',
        ]);

        $imageAltText->alt_text = $request->input('alt_text');
        $imageAltText->save();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Alt text updated successfully.',
            ]);
        }

        return redirect()->back()
            ->with('success', 'Alt text updated successfully.');
    }

    /**
     * Scan images from directories
     */
    public function scan()
    {
        Artisan::call('images:scan');

        return redirect()->back()
            ->with('success', 'Image scan completed. Check the output for details.');
    }

    /**
     * Get image details for AJAX
     */
    public function show(ImageAltText $imageAltText)
    {
        return response()->json([
            'id' => $imageAltText->id,
            'image_path' => $imageAltText->image_path,
            'file_name' => $imageAltText->file_name,
            'directory' => $imageAltText->directory,
            'alt_text' => $imageAltText->alt_text,
            'file_size' => $imageAltText->file_size,
            'url' => asset($imageAltText->image_path),
        ]);
    }
}
