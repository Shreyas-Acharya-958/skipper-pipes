<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
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

            // Generate thumbnail for PDF files
            if ($request->file_type === 'pdf') {
                $thumbnailPath = $this->generatePdfThumbnail($filename);
                if ($thumbnailPath) {
                    $validated['thumbnail'] = $thumbnailPath;
                }
            }
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
            if ($media->thumbnail) {
                Storage::disk('public')->delete($media->thumbnail);
            }
            $validated['file'] = null;
            $validated['thumbnail'] = null;
        } elseif ($request->hasFile('file')) {
            if ($media->file && $media->file_type !== 'youtube_link') {
                Storage::disk('public')->delete($media->file);
            }
            if ($media->thumbnail) {
                Storage::disk('public')->delete($media->thumbnail);
            }
            $file = $request->file('file');
            $filename = Str::slug($request->title) . '-media-' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('media', $filename, 'public');
            $validated['file'] = $path;

            // Generate thumbnail for PDF files
            if ($request->file_type === 'pdf') {
                $thumbnailPath = $this->generatePdfThumbnail($filename);
                if ($thumbnailPath) {
                    $validated['thumbnail'] = $thumbnailPath;
                }
            }
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
        if ($media->thumbnail) {
            Storage::disk('public')->delete($media->thumbnail);
        }
        $media->delete();
        return redirect()->route('admin.media.index')
            ->with('success', 'Media deleted successfully.');
    }

    /**
     * Generate thumbnail for PDF file
     */
    private function generatePdfThumbnail($filename)
    {
        try {
            // Ensure thumbnail directory exists
            Storage::disk('public')->makeDirectory('thumbnails');

            $thumbnailFilename = 'thumbnails/' . pathinfo($filename, PATHINFO_FILENAME) . '-thumb.png';

            // Create a simple PDF icon thumbnail
            $this->createPdfIcon($thumbnailFilename);

            return $thumbnailFilename;
        } catch (\Exception $e) {
            Log::error('PDF thumbnail generation failed: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Create a simple PDF icon thumbnail
     */
    private function createPdfIcon($thumbnailFilename)
    {
        // Create a simple 300x400 PNG image with PDF styling
        $width = 300;
        $height = 400;

        // Create image
        $image = imagecreatetruecolor($width, $height);

        // Define colors
        $white = imagecolorallocate($image, 255, 255, 255);
        $red = imagecolorallocate($image, 220, 53, 69);
        $darkGray = imagecolorallocate($image, 52, 58, 64);
        $lightGray = imagecolorallocate($image, 108, 117, 125);

        // Fill background
        imagefill($image, 0, 0, $white);

        // Draw PDF document shape
        $margin = 20;
        $docWidth = $width - (2 * $margin);
        $docHeight = $height - (2 * $margin);

        // Main document rectangle
        imagefilledrectangle($image, $margin, $margin, $margin + $docWidth, $margin + $docHeight, $white);
        imagerectangle($image, $margin, $margin, $margin + $docWidth, $margin + $docHeight, $darkGray);

        // PDF label background
        $labelHeight = 40;
        imagefilledrectangle($image, $margin, $margin + $docHeight - $labelHeight, $margin + $docWidth, $margin + $docHeight, $red);

        // PDF text
        $fontSize = 5;
        $text = 'PDF';
        $textColor = $white;

        // Calculate text position to center it
        $textWidth = imagefontwidth($fontSize) * strlen($text);
        $textHeight = imagefontheight($fontSize);
        $textX = $margin + ($docWidth - $textWidth) / 2;
        $textY = $margin + $docHeight - $labelHeight + ($labelHeight - $textHeight) / 2;

        imagestring($image, $fontSize, $textX, $textY, $text, $textColor);

        // Draw some lines to represent text
        $lineY = $margin + 60;
        for ($i = 0; $i < 8; $i++) {
            $lineLength = rand(60, $docWidth - 40);
            imageline($image, $margin + 20, $lineY, $margin + 20 + $lineLength, $lineY, $lightGray);
            $lineY += 25;
        }

        // Save the image
        $thumbnailPath = storage_path('app/public/' . $thumbnailFilename);
        imagepng($image, $thumbnailPath);
        imagedestroy($image);

        return $thumbnailFilename;
    }
}
