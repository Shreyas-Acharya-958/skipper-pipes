<?php

namespace App\Http\Controllers;

use App\Models\ContactUsSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ContactUsSectionController extends Controller
{
    public function edit()
    {
        $contactUsSection = ContactUsSection::first() ?? new ContactUsSection();
        return view('admin.contact-us-sections.edit', compact('contactUsSection'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'section1' => 'nullable|string',
            'section2' => 'nullable|string',
            'section3' => 'nullable|string',
            'section4' => 'nullable|string',
        ]);

        $contactUsSection = ContactUsSection::first() ?? new ContactUsSection();
        $contactUsSection->fill($data);
        $contactUsSection->save();

        return redirect()->back()->with('success', 'Contact Us Sections updated successfully!');
    }

    public function uploadImage(Request $request)
    {
        // Check if file exists
        if (!$request->hasFile('file')) {
            return response()->json([
                'error' => 'No file uploaded'
            ], 400);
        }

        $file = $request->file('file');

        // Validate file
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,webp'
        ]);

        try {
            // Generate unique filename
            $filename = 'tinymce_' . time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();

            // Store in public disk under tinymce folder
            $path = $file->storeAs('tinymce', $filename, 'public');

            if (!$path) {
                throw new \Exception('Failed to store file');
            }

            // Return the URL for TinyMCE
            return response()->json([
                'location' => asset('storage/' . $path)
            ]);
        } catch (\Exception $e) {
            Log::error('TinyMCE upload error: ' . $e->getMessage());
            return response()->json([
                'error' => 'Upload failed: ' . $e->getMessage()
            ], 500);
        }
    }
}