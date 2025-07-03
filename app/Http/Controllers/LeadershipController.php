<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeadershipSectionOne;
use App\Models\LeadershipSectionTwo;
use App\Models\LeadershipSectionThree;
use App\Models\LeadershipSectionFour;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class LeadershipController extends Controller
{
    public function sections()
    {
        $sectionOne = LeadershipSectionOne::where('company_id', 1)->first();
        $sectionTwos = LeadershipSectionTwo::where('company_id', 1)->get();
        $sectionThrees = LeadershipSectionThree::where('company_id', 1)->get();
        $sectionFours = LeadershipSectionFour::where('company_id', 1)->get();

        return view('admin.company_pages.section.leadership', compact('sectionOne', 'sectionTwos', 'sectionThrees', 'sectionFours'));
    }

    public function saveSectionOne(Request $request)
    {
        try {
            DB::beginTransaction();

            $section = LeadershipSectionOne::where('company_id', 1)->first() ?? new LeadershipSectionOne(['company_id' => 1]);

            if ($request->hasFile('image')) {
                if ($section->image) {
                    Storage::disk('public')->delete($section->image);
                }
                $file = $request->file('image');
                $filename = 'leadership-section1-' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('leadership/section1', $filename, 'public');
                $section->image = $path;
            }

            if ($request->boolean('remove_image')) {
                Storage::disk('public')->delete($section->image);
                $section->image = null;
            }

            $section->description = $request->description;
            $section->save();

            DB::commit();
            return redirect()->route('admin.leadership.sections', ['tab' => 'section1'])->with('success', 'Section One updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.leadership.sections', ['tab' => 'section1'])->with('error', 'Failed to update Section One: ' . $e->getMessage());
        }
    }

    public function saveSectionTwo(Request $request)
    {
        try {
            DB::beginTransaction();

            if ($request->has('sections')) {
                foreach ($request->sections as $index => $sectionData) {
                    $section = isset($sectionData['id'])
                        ? LeadershipSectionTwo::find($sectionData['id'])
                        : new LeadershipSectionTwo(['company_id' => 1]);

                    $section->icon = $sectionData['icon'];
                    $section->title = $sectionData['title'];
                    $section->description = $sectionData['description'];
                    $section->save();
                }
            }

            // Handle deletions
            if ($request->has('deleted_sections')) {
                LeadershipSectionTwo::whereIn('id', explode(',', $request->deleted_sections))->delete();
            }

            DB::commit();
            return redirect()->route('admin.leadership.sections', ['tab' => 'section2'])->with('success', 'Section Two updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.leadership.sections', ['tab' => 'section2'])->with('error', 'Failed to update Section Two: ' . $e->getMessage());
        }
    }

    public function saveSectionThree(Request $request)
    {
        try {
            DB::beginTransaction();

            if ($request->has('sections')) {
                foreach ($request->sections as $index => $sectionData) {
                    $section = isset($sectionData['id'])
                        ? LeadershipSectionThree::find($sectionData['id'])
                        : new LeadershipSectionThree(['company_id' => 1]);

                    if (isset($sectionData['image_file'])) {
                        if ($section->image) {
                            Storage::disk('public')->delete($section->image);
                        }
                        $file = $sectionData['image_file'];
                        $filename = 'leadership-section3-' . time() . '-' . $index . '.' . $file->getClientOriginalExtension();
                        $path = $file->storeAs('leadership/section3', $filename, 'public');
                        $section->image = $path;
                    }

                    if (isset($sectionData['remove_image']) && $sectionData['remove_image']) {
                        Storage::disk('public')->delete($section->image);
                        $section->image = null;
                    }

                    $section->name = $sectionData['name'];
                    $section->role = $sectionData['role'];
                    $section->description = $sectionData['description'];
                    $section->save();
                }
            }

            // Handle deletions
            if ($request->has('deleted_sections')) {
                $deletedSections = LeadershipSectionThree::whereIn('id', explode(',', $request->deleted_sections))->get();
                foreach ($deletedSections as $section) {
                    if ($section->image) {
                        Storage::disk('public')->delete($section->image);
                    }
                    $section->delete();
                }
            }

            DB::commit();
            return redirect()->route('admin.leadership.sections', ['tab' => 'section3'])->with('success', 'Section Three updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.leadership.sections', ['tab' => 'section3'])->with('error', 'Failed to update Section Three: ' . $e->getMessage());
        }
    }

    public function saveSectionFour(Request $request)
    {
        try {
            DB::beginTransaction();

            if ($request->has('sections')) {
                foreach ($request->sections as $index => $sectionData) {
                    $section = isset($sectionData['id'])
                        ? LeadershipSectionFour::find($sectionData['id'])
                        : new LeadershipSectionFour(['company_id' => 1]);

                    if (isset($sectionData['image_file'])) {
                        if ($section->image) {
                            Storage::disk('public')->delete($section->image);
                        }
                        $file = $sectionData['image_file'];
                        $filename = 'leadership-section4-' . time() . '-' . $index . '.' . $file->getClientOriginalExtension();
                        $path = $file->storeAs('leadership/section4', $filename, 'public');
                        $section->image = $path;
                    }

                    if (isset($sectionData['remove_image']) && $sectionData['remove_image']) {
                        Storage::disk('public')->delete($section->image);
                        $section->image = null;
                    }

                    $section->name = $sectionData['name'];
                    $section->role = $sectionData['role'];
                    $section->description = $sectionData['description'];
                    $section->save();
                }
            }

            // Handle deletions
            if ($request->has('deleted_sections')) {
                $deletedSections = LeadershipSectionFour::whereIn('id', explode(',', $request->deleted_sections))->get();
                foreach ($deletedSections as $section) {
                    if ($section->image) {
                        Storage::disk('public')->delete($section->image);
                    }
                    $section->delete();
                }
            }

            DB::commit();
            return redirect()->route('admin.leadership.sections', ['tab' => 'section4'])->with('success', 'Section Four updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.leadership.sections', ['tab' => 'section4'])->with('error', 'Failed to update Section Four: ' . $e->getMessage());
        }
    }
}
