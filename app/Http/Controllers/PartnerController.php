<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\PartnerSectionOne;
use App\Models\PartnerSectionTwo;
use App\Models\PartnerPipesOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PartnerController extends Controller
{
    public function index(Request $request)
    {
        $query = Partner::query();
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('partner_type', 'like', "%{$search}%");
        }
        $partners = $query->paginate(10);
        return view('admin.partners.index', compact('partners'));
    }

    public function create()
    {
        return view('admin.partners.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:partners,slug',
            'short_description' => 'nullable|string',
            'long_description' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'status' => 'required|in:0,1',
            'partner_type' => 'required|string|max:255',
            'page_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('page_image')) {
            $file = $request->file('page_image');
            $filename = Str::slug($request->title) . '-' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('partners', $filename, 'public');
            $validated['page_image'] = $path;
        }

        Partner::create($validated);

        return redirect()->route('admin.partners.index')->with('success', 'Partner created successfully.');
    }

    public function show(Partner $partner)
    {
        return view('admin.partners.show', compact('partner'));
    }

    public function edit(Partner $partner)
    {
        return view('admin.partners.edit', compact('partner'));
    }

    public function update(Request $request, Partner $partner)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:partners,slug,' . $partner->id,
            'short_description' => 'nullable|string',
            'long_description' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'status' => 'required|in:0,1',
            'partner_type' => 'required|string|max:255',
            'page_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('page_image')) {
            if ($partner->page_image) {
                Storage::disk('public')->delete($partner->page_image);
            }
            $file = $request->file('page_image');
            $filename = Str::slug($request->title) . '-' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('partners', $filename, 'public');
            $validated['page_image'] = $path;
        }

        $partner->update($validated);

        return redirect()->route('admin.partners.index')->with('success', 'Partner updated successfully.');
    }

    public function destroy(Partner $partner)
    {
        if ($partner->page_image) {
            Storage::disk('public')->delete($partner->page_image);
        }

        $partner->delete();

        return redirect()->route('admin.partners.index')->with('success', 'Partner deleted successfully.');
    }

    public function sections(Partner $partner)
    {
        return view('admin.partners.sections', compact('partner'));
    }

    public function saveSectionOne(Request $request, Partner $partner)
    {
        $request->validate([
            'description' => 'required|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('partner-sections', 'public');
                $images[] = $path;
            }
        }

        $partner->sectionOne()->updateOrCreate(
            ['partner_id' => $partner->id],
            [
                'description' => $request->description,
                'image' => !empty($images) ? implode(',', $images) : ($partner->sectionOne->image ?? null)
            ]
        );

        return redirect()->route('admin.partners.sections', $partner)->with('success', 'Section One updated successfully.')
            ->with('active_tab', 'section-one');
    }

    public function deleteImage(Request $request, Partner $partner)
    {
        $image = $request->image;
        if ($partner->sectionOne && $partner->sectionOne->image) {
            $images = explode(',', $partner->sectionOne->image);
            if (($key = array_search($image, $images)) !== false) {
                Storage::disk('public')->delete($image);
                unset($images[$key]);
                $partner->sectionOne->update([
                    'image' => implode(',', $images)
                ]);
                return response()->json(['success' => true]);
            }
        }
        return response()->json(['success' => false]);
    }

    public function saveSectionTwo(Request $request, Partner $partner)
    {
        $request->validate([
            'titles.*' => 'required|string|max:255',
            'descriptions.*' => 'required|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'existing_images.*' => 'nullable|string'
        ]);

        $titles = $request->titles;
        $descriptions = $request->descriptions;
        $images = [];

        // Process each item
        foreach ($titles as $key => $title) {
            // Handle image for this item
            if ($request->hasFile('images') && isset($request->file('images')[$key])) {
                // If there's a new image uploaded
                $file = $request->file('images')[$key];
                if ($file) {
                    // Delete old image if exists
                    if (isset($request->existing_images[$key]) && !empty($request->existing_images[$key])) {
                        Storage::disk('public')->delete($request->existing_images[$key]);
                    }
                    // Store new image
                    $path = $file->store('partner-sections', 'public');
                    $images[$key] = $path;
                }
            } elseif (isset($request->existing_images[$key]) && !empty($request->existing_images[$key])) {
                // Keep existing image if no new image was uploaded
                $images[$key] = $request->existing_images[$key];
            } else {
                // No image for this item
                $images[$key] = null;
            }
        }

        $partner->sectionTwo()->updateOrCreate(
            ['partner_id' => $partner->id],
            [
                'title' => json_encode($titles),
                'description' => json_encode($descriptions),
                'image' => json_encode($images)
            ]
        );

        return redirect()->route('admin.partners.sections', $partner)
            ->with('success', 'Section Two updated successfully.')
            ->with('active_tab', 'section-two');
    }

    public function savePipesOffers(Request $request, Partner $partner)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('partner-pipes-offers', 'public');
                $partner->pipesOffers()->create([
                    'image' => $path
                ]);
            }
        }

        return redirect()->route('admin.partners.sections', $partner)->with('success', 'Pipes offer images uploaded successfully.')
            ->with('active_tab', 'pipes-offers');
    }

    public function deletePipesOffer(Partner $partner, PartnerPipesOffer $offer)
    {
        Storage::disk('public')->delete($offer->image);
        $offer->delete();
        return redirect()->route('admin.partners.sections', $partner)->with('success', 'Pipes offer image deleted successfully.')
            ->with('active_tab', 'pipes-offers');
    }
}
