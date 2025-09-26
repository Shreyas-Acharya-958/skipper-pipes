<?php

namespace App\Http\Controllers;

use App\Models\JalRakshakMenu;
use App\Models\JalRakshakBanner;
use App\Models\JalRakshakInitiative;
use App\Models\JalRakshakActivity;
use App\Models\JalRakshakGallery;
use App\Models\JalRakshakPhotoCategory;
use App\Models\JalRakshakVideo;
use App\Models\JalRakshakConservation;
use App\Models\JalRakshakInvolvement;
use App\Models\JalRakshakSeo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class JalRakshakController extends Controller
{
    public function index()
    {
        $menus = JalRakshakMenu::orderBy('sequence', 'asc')->get();
        $banners = JalRakshakBanner::first();
        $initiative = JalRakshakInitiative::first();
        $activities = JalRakshakActivity::orderBy('sequence', 'asc')->get();
        $gallery = JalRakshakGallery::with('category')->orderBy('sequence', 'asc')->get();
        $categories = JalRakshakPhotoCategory::orderBy('name', 'asc')->get();
        $videos = JalRakshakVideo::orderBy('sequence', 'asc')->get();
        $conservations = JalRakshakConservation::orderBy('sequence', 'asc')->get();
        $involvement = JalRakshakInvolvement::first();
        $seo = JalRakshakSeo::first();

        return view('admin.jal_rakshak.index', compact(
            'menus',
            'banners',
            'initiative',
            'activities',
            'gallery',
            'categories',
            'videos',
            'conservations',
            'involvement',
            'seo'
        ));
    }

    public function saveMenus(Request $request)
    {
        // Delete existing menus
        JalRakshakMenu::truncate();

        // Save new menus
        if ($request->has('menus')) {
            foreach ($request->menus as $index => $menuData) {
                if (!empty($menuData['title']) && !empty($menuData['url'])) {
                    JalRakshakMenu::create([
                        'title' => $menuData['title'],
                        'url' => $menuData['url'],
                        'sequence' => $index
                    ]);
                }
            }
        }

        return redirect()->back()->with('success', 'Menus updated successfully');
    }

    public function saveBanners(Request $request)
    {
        $banner = JalRakshakBanner::first() ?? new JalRakshakBanner();

        // Handle multiple image uploads
        if ($request->hasFile('images')) {
            $images = [];
            $imageFiles = $request->file('images');

            if (!is_array($imageFiles)) {
                $imageFiles = [$imageFiles];
            }

            foreach ($imageFiles as $image) {
                $images[] = $image->store('jal-rakshak/banners', 'public');
            }

            // Delete old images if they exist
            if (!empty($banner->images)) {
                foreach ((array)$banner->images as $oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
            }

            $banner->images = $images;
        }

        // Handle mobile image upload
        if ($request->hasFile('mobile_image')) {
            // Delete old mobile image if it exists
            if ($banner->mobile_image) {
                Storage::disk('public')->delete($banner->mobile_image);
            }
            $banner->mobile_image = $request->file('mobile_image')->store('jal-rakshak/banners', 'public');
        }

        // Handle mobile image removal
        if ($request->remove_mobile_image && $banner->mobile_image) {
            Storage::disk('public')->delete($banner->mobile_image);
            $banner->mobile_image = null;
        }

        // Handle image deletions
        if ($request->has('deleted_images')) {
            foreach ($request->deleted_images as $deletedImage) {
                if ($deletedImage) {
                    Storage::disk('public')->delete($deletedImage);
                }
            }
            $currentImages = $banner->images ?? [];
            $banner->images = array_diff($currentImages, $request->deleted_images);
        }

        $banner->title = $request->title;
        $banner->save();

        return redirect()->back()->with('success', 'Banner images updated successfully');
    }

    public function saveInitiative(Request $request)
    {
        $initiative = JalRakshakInitiative::first() ?? new JalRakshakInitiative();

        if ($request->hasFile('image')) {
            if ($initiative->image) {
                Storage::disk('public')->delete($initiative->image);
            }
            $initiative->image = $request->file('image')->store('jal-rakshak/initiatives', 'public');
        }

        if ($request->remove_image && $initiative->image) {
            Storage::disk('public')->delete($initiative->image);
            $initiative->image = null;
        }

        $initiative->title = $request->title;
        $initiative->description = $request->description;
        $initiative->save();

        return redirect()->back()->with('success', 'Initiative updated successfully');
    }

    public function saveActivities(Request $request)
    {
        // Get existing activities
        $existingActivities = JalRakshakActivity::all()->keyBy('id');

        // Save new activities
        if ($request->has('activities')) {
            foreach ($request->activities as $index => $activityData) {
                if (!empty($activityData['title'])) {
                    $activity = null;

                    // If this is an existing activity (has ID), update it
                    if (isset($activityData['id']) && $activityData['id']) {
                        $activity = $existingActivities->get($activityData['id']);
                        if ($activity) {
                            $activity->title = $activityData['title'];
                            $activity->description = $activityData['description'] ?? '';
                            $activity->sequence = $index;
                        }
                    }

                    // If no existing activity or ID not found, create new one
                    if (!$activity) {
                        $activity = new JalRakshakActivity();
                        $activity->title = $activityData['title'];
                        $activity->description = $activityData['description'] ?? '';
                        $activity->sequence = $index;
                    }

                    // Handle image upload
                    if (isset($activityData['image_file']) && $activityData['image_file']) {
                        // Delete old image if exists
                        if ($activity->image) {
                            Storage::disk('public')->delete($activity->image);
                        }
                        $activity->image = $activityData['image_file']->store('jal-rakshak/activities', 'public');
                    }

                    $activity->save();
                }
            }
        }

        return redirect()->back()->with('success', 'Activities updated successfully');
    }

    public function saveGallery(Request $request)
    {
        // Get existing gallery items
        $existingGallery = JalRakshakGallery::all()->keyBy('id');

        // Save new gallery items
        if ($request->has('gallery')) {
            foreach ($request->gallery as $index => $galleryData) {
                if (!empty($galleryData['image_file']) || !empty($galleryData['category_id'])) {
                    $galleryItem = null;

                    // If this is an existing gallery item (has ID), update it
                    if (isset($galleryData['id']) && $galleryData['id']) {
                        $galleryItem = $existingGallery->get($galleryData['id']);
                        if ($galleryItem) {
                            $galleryItem->sequence = $index;
                        }
                    }

                    // If no existing gallery item or ID not found, create new one
                    if (!$galleryItem) {
                        $galleryItem = new JalRakshakGallery();
                        $galleryItem->sequence = $index;
                    }

                    // Handle category assignment
                    if (isset($galleryData['category_id']) && !empty($galleryData['category_id'])) {
                        $galleryItem->category_id = $galleryData['category_id'];
                    } else {
                        $galleryItem->category_id = null;
                    }

                    // Handle image upload
                    if (isset($galleryData['image_file']) && $galleryData['image_file']) {
                        // Delete old image if exists
                        if ($galleryItem->image) {
                            Storage::disk('public')->delete($galleryItem->image);
                        }
                        $galleryItem->image = $galleryData['image_file']->store('jal-rakshak/gallery', 'public');
                    }

                    $galleryItem->save();
                }
            }
        }

        return redirect()->back()->with('success', 'Gallery updated successfully');
    }

    public function saveVideos(Request $request)
    {
        // Delete existing videos
        JalRakshakVideo::truncate();

        // Save new videos
        if ($request->has('videos')) {
            foreach ($request->videos as $index => $videoData) {
                if (!empty($videoData['video_file'])) {
                    $videoFile = $videoData['video_file'];
                    $fileName = time() . '_' . $videoFile->getClientOriginalName();
                    $videoPath = $videoFile->storeAs('jal-rakshak/videos', $fileName, 'public');

                    JalRakshakVideo::create([
                        'video_url' => null, // Set to null since we're using video_file now
                        'video_file' => $videoPath,
                        'title' => $videoData['title'] ?? '',
                        'sequence' => $index
                    ]);
                }
            }
        }

        return redirect()->back()->with('success', 'Videos updated successfully');
    }

    public function saveConservations(Request $request)
    {
        // Get existing conservations
        $existingConservations = JalRakshakConservation::all()->keyBy('id');

        // Save new conservations
        if ($request->has('conservations')) {
            foreach ($request->conservations as $index => $conservationData) {
                if (!empty($conservationData['title'])) {
                    $conservation = null;

                    // If this is an existing conservation (has ID), update it
                    if (isset($conservationData['id']) && $conservationData['id']) {
                        $conservation = $existingConservations->get($conservationData['id']);
                        if ($conservation) {
                            $conservation->title = $conservationData['title'];
                            $conservation->description = $conservationData['description'] ?? '';
                            $conservation->sequence = $index;
                        }
                    }

                    // If no existing conservation or ID not found, create new one
                    if (!$conservation) {
                        $conservation = new JalRakshakConservation();
                        $conservation->title = $conservationData['title'];
                        $conservation->description = $conservationData['description'] ?? '';
                        $conservation->sequence = $index;
                    }

                    // Handle image upload
                    if (isset($conservationData['image_file']) && $conservationData['image_file']) {
                        // Delete old image if exists
                        if ($conservation->image) {
                            Storage::disk('public')->delete($conservation->image);
                        }
                        $conservation->image = $conservationData['image_file']->store('jal-rakshak/conservations', 'public');
                    }

                    $conservation->save();
                }
            }
        }

        return redirect()->back()->with('success', 'Water conservation content updated successfully');
    }

    public function saveInvolvement(Request $request)
    {
        $involvement = JalRakshakInvolvement::first() ?? new JalRakshakInvolvement();

        if ($request->hasFile('image')) {
            if ($involvement->image) {
                Storage::disk('public')->delete($involvement->image);
            }
            $involvement->image = $request->file('image')->store('jal-rakshak/involvements', 'public');
        }

        if ($request->remove_image && $involvement->image) {
            Storage::disk('public')->delete($involvement->image);
            $involvement->image = null;
        }

        $involvement->head_title = $request->head_title;
        $involvement->form_title = $request->form_title;
        $involvement->description = $request->description;
        $involvement->save();

        return redirect()->back()->with('success', 'Get involved section updated successfully');
    }

    public function saveSeo(Request $request)
    {
        $seo = JalRakshakSeo::first() ?? new JalRakshakSeo();

        $seo->meta_title = $request->meta_title;
        $seo->meta_description = $request->meta_description;
        $seo->meta_keywords = $request->meta_keywords;
        $seo->save();

        return redirect()->back()->with('success', 'SEO settings updated successfully');
    }

    public function saveCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        if ($request->id) {
            // Update existing category
            $category = JalRakshakPhotoCategory::findOrFail($request->id);
            $category->name = $request->name;
            $category->description = $request->description;
            $category->save();
        } else {
            // Create new category
            JalRakshakPhotoCategory::create([
                'name' => $request->name,
                'description' => $request->description
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Category saved successfully']);
    }

    public function deleteCategory(Request $request)
    {
        $category = JalRakshakPhotoCategory::findOrFail($request->id);

        // Check if category has associated galleries
        if ($category->galleries()->count() > 0) {
            return response()->json(['success' => false, 'message' => 'Cannot delete category with associated galleries']);
        }

        $category->delete();

        return response()->json(['success' => true, 'message' => 'Category deleted successfully']);
    }
}