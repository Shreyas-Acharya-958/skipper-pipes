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

            if ($request->hasFile('image')) {
                $section->image = $request->file('image')->store('home/section1', 'public');
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
                // Delete old reviews
                $section->reviews()->delete();

                foreach ($request->reviews as $index => $review) {
                    if (!empty($review['person_name'])) {
                        $reviewModel = new HomeSectionFourReview([
                            'person_name' => $review['person_name'],
                            'person_role' => $review['person_role'],
                            'star' => $review['star'],
                            'sequence' => $index,
                            'status' => $review['status'] ?? 0
                        ]);

                        if (isset($review['person_image']) && $review['person_image']) {
                            $reviewModel->person_image = $review['person_image']->store('home/section4/reviews', 'public');
                        }

                        $section->reviews()->save($reviewModel);
                    }
                }
            }

            DB::commit();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
