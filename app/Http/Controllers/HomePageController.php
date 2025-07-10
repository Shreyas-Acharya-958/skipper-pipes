<?php

namespace App\Http\Controllers;

use App\Models\HomeSectionOne;
use App\Models\HomeSectionOneFeature;
use App\Models\HomeSectionTwo;
use App\Models\HomeSectionThree;
use App\Models\HomeSectionFour;
use App\Models\HomeSectionFourReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HomePageController extends Controller
{
    public function index()
    {
        $sectionOne = HomeSectionOne::with('features')->first();
        $sectionTwo = HomeSectionTwo::first();
        $sectionThree = HomeSectionThree::first();
        $sectionFour = HomeSectionFour::first();

        return view('admin.home-page.index', compact('sectionOne', 'sectionTwo', 'sectionThree', 'sectionFour'));
    }

    public function saveSection1(Request $request)
    {
        try {
            DB::beginTransaction();

            $section = HomeSectionOne::firstOrNew();
            $section->fill($request->only(['title', 'description']));

            // Handle media upload based on type
            if ($request->input('media_type') === 'video') {
                // Remove existing image if switching to video
                if ($section->image) {
                    Storage::disk('public')->delete($section->image);
                    $section->image = null;
                }

                if ($request->hasFile('video')) {
                    // Remove existing video if any
                    if ($section->video) {
                        Storage::disk('public')->delete($section->video);
                    }
                    $section->video = $request->file('video')->store('home/section1', 'public');
                }
            } else {
                // Remove existing video if switching to image
                if ($section->video) {
                    Storage::disk('public')->delete($section->video);
                    $section->video = null;
                }

                if ($request->hasFile('image')) {
                    // Remove existing image if any
                    if ($section->image) {
                        Storage::disk('public')->delete($section->image);
                    }
                    $section->image = $request->file('image')->store('home/section1', 'public');
                }
            }

            $section->save();

            // Handle features
            if ($request->has('features')) {
                foreach ($request->features as $feature) {
                    $featureModel = HomeSectionOneFeature::firstOrNew([
                        'id' => $feature['id'],
                        'section_one_id' => $section->id
                    ]);

                    $featureModel->title = $feature['title'];
                    $featureModel->sequence = $feature['id'] - 1; // Use ID as sequence

                    if (isset($feature['icon']) && $feature['icon']) {
                        // Remove old icon if exists
                        if ($featureModel->icon) {
                            Storage::disk('public')->delete($featureModel->icon);
                        }
                        $featureModel->icon = $feature['icon']->store('home/section1/features', 'public');
                    }

                    $featureModel->save();
                }
            }

            DB::commit();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function saveSection2(Request $request)
    {
        try {
            $section = HomeSectionTwo::firstOrNew();
            $section->fill($request->only(['title', 'description', 'image_title', 'image_button', 'link']));

            if ($request->hasFile('image')) {
                $section->image = $request->file('image')->store('home/section2', 'public');
            }

            $section->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function saveSection3(Request $request)
    {
        try {
            $section = HomeSectionThree::firstOrNew();
            $section->fill($request->only(['title', 'image', 'video_link']));
            $section->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function saveSection4(Request $request)
    {
        try {
            DB::beginTransaction();

            $section = HomeSectionFour::firstOrNew();
            $section->fill($request->only(['title', 'description']));

            if ($request->hasFile('image')) {
                $section->image = $request->file('image')->store('home/section4', 'public');
            }

            $section->save();

            // Handle reviews
            if ($request->has('reviews')) {
                foreach ($request->reviews as $index => $review) {
                    if (!empty($review['person_name'])) {
                        // Find existing review or create new one
                        $reviewModel = HomeSectionFourReview::firstOrNew([
                            'id' => $review['id'] ?? null,
                            'section_four_id' => $section->id
                        ]);

                        $reviewModel->person_name = $review['person_name'];
                        $reviewModel->person_role = $review['person_role'];
                        $reviewModel->star = $review['star'];
                        $reviewModel->sequence = $index;
                        $reviewModel->status = $review['status'] ?? 0;
                        $reviewModel->description = $review['description'] ?? null;

                        // Only update image if a new one is uploaded
                        if (isset($review['person_image']) && $review['person_image']) {
                            $reviewModel->person_image = $review['person_image']->store('home/section4/reviews', 'public');
                        }

                        $section->reviews()->save($reviewModel);
                    }
                }

                // Delete reviews that are no longer in the request
                $existingIds = collect($request->reviews)->pluck('id')->filter()->toArray();
                $section->reviews()
                    ->whereNotIn('id', $existingIds)
                    ->delete();
            }

            DB::commit();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
