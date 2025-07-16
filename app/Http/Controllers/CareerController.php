<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\CareerWhySkipper;
use App\Models\CareerLifeAtSkipper;
use App\Models\CareerSkipperPipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CareerController extends Controller
{
    public function index()
    {
        $mainSection = Career::first();
        $whySkipper = CareerWhySkipper::first();
        $lifeAtSkippers = CareerLifeAtSkipper::orderBy('sequence', 'asc')->get();
        $skipperPipes = CareerSkipperPipe::orderBy('sequence', 'asc')->get();

        return view('admin.careers.index', compact(
            'mainSection',
            'whySkipper',
            'lifeAtSkippers',
            'skipperPipes'
        ));
    }

    public function saveMain(Request $request)
    {
        $section = Career::first() ?? new Career();

        // Handle multiple image uploads
        if ($request->hasFile('images')) {
            $images = [];
            $imageFiles = $request->file('images');

            // Ensure $imageFiles is an array
            if (!is_array($imageFiles)) {
                $imageFiles = [$imageFiles];
            }

            foreach ($imageFiles as $image) {
                $images[] = $image->store('careers', 'public');
            }

            // Delete old images if they exist
            if (!empty($section->images)) {
                foreach ((array)$section->images as $oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
            }

            $section->images = $images;
        }

        // Handle image deletions
        if ($request->has('deleted_images')) {
            $remainingImages = [];
            $currentImages = (array)($section->images ?? []);

            foreach ($currentImages as $image) {
                if (!in_array($image, $request->deleted_images)) {
                    $remainingImages[] = $image;
                } else {
                    Storage::disk('public')->delete($image);
                }
            }

            $section->images = $remainingImages;
        }

        $section->title = $request->title;
        $section->description = $request->description;
        $section->save();

        return redirect()->back()->with('success', 'Main section updated successfully');
    }

    public function saveWhySkipper(Request $request)
    {
        $section = CareerWhySkipper::first() ?? new CareerWhySkipper();

        // Handle multiple image uploads
        if ($request->hasFile('images')) {
            $images = [];
            $imageFiles = $request->file('images');

            // Ensure $imageFiles is an array
            if (!is_array($imageFiles)) {
                $imageFiles = [$imageFiles];
            }

            foreach ($imageFiles as $image) {
                $images[] = $image->store('careers', 'public');
            }

            // Delete old images if they exist
            if (!empty($section->images)) {
                foreach ((array)$section->images as $oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
            }

            $section->images = $images;
        }

        // Handle image deletions
        if ($request->has('deleted_images')) {
            $remainingImages = [];
            $currentImages = (array)($section->images ?? []);

            foreach ($currentImages as $image) {
                if (!in_array($image, $request->deleted_images)) {
                    $remainingImages[] = $image;
                } else {
                    Storage::disk('public')->delete($image);
                }
            }

            $section->images = $remainingImages;
        }

        $section->title = $request->title ?? '';
        $section->description = $request->description;
        $section->save();

        return redirect()->back()->with('success', 'Why Skipper section updated successfully');
    }

    public function saveLifeAtSkipper(Request $request)
    {
        // Handle deleted sections
        if ($request->deleted_sections) {
            foreach ($request->deleted_sections as $id) {
                $section = CareerLifeAtSkipper::find($id);
                if ($section) {
                    if ($section->image) {
                        Storage::disk('public')->delete($section->image);
                    }
                    $section->delete();
                }
            }
        }

        // Handle sections data
        foreach ($request->sections as $index => $data) {
            if (isset($data['id']) && $data['id']) {
                $section = CareerLifeAtSkipper::find($data['id']);
            } else {
                $section = new CareerLifeAtSkipper();
            }

            if (isset($data['image_file']) && $data['image_file']) {
                if ($section->image) {
                    Storage::disk('public')->delete($section->image);
                }
                $section->image = $data['image_file']->store('careers', 'public');
            }

            if (isset($data['remove_image']) && $data['remove_image'] && $section->image) {
                Storage::disk('public')->delete($section->image);
                $section->image = null;
            }

            $section->title = $data['title'];
            $section->description = $data['description'];
            $section->sequence = $index + 1;
            $section->save();
        }

        return redirect()->back()->with('success', 'Life at Skipper section updated successfully');
    }

    public function saveSkipperPipes(Request $request)
    {
        // Handle deleted sections
        if ($request->deleted_sections) {
            foreach ($request->deleted_sections as $id) {
                $section = CareerSkipperPipe::find($id);
                if ($section) {
                    if ($section->image) {
                        Storage::disk('public')->delete($section->image);
                    }
                    $section->delete();
                }
            }
        }

        // Handle sections data
        foreach ($request->sections as $index => $data) {
            if (isset($data['id']) && $data['id']) {
                $section = CareerSkipperPipe::find($data['id']);
            } else {
                $section = new CareerSkipperPipe();
            }

            if (isset($data['image_file']) && $data['image_file']) {
                if ($section->image) {
                    Storage::disk('public')->delete($section->image);
                }
                $section->image = $data['image_file']->store('careers', 'public');
            }

            if (isset($data['remove_image']) && $data['remove_image'] && $section->image) {
                Storage::disk('public')->delete($section->image);
                $section->image = null;
            }

            $section->title = $data['title'];
            $section->description = $data['description'];
            $section->sequence = $index + 1;
            $section->save();
        }

        return redirect()->back()->with('success', 'Skipper Pipes section updated successfully');
    }
}