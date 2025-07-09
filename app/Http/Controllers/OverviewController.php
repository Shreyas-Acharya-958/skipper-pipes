<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OverviewSectionOne;
use App\Models\OverviewSectionTwo;
use App\Models\OverviewSectionThree;
use App\Models\OverviewSectionFour;
use App\Models\OverviewSectionFive;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class OverviewController extends Controller
{
    public function sections()
    {

        $sectionOne = OverviewSectionOne::where('company_id', 1)->first();
        $sectionTwos = OverviewSectionTwo::where('company_id', 1)->get();
        $sectionThrees = OverviewSectionThree::where('company_id', 1)->get();
        $sectionFours = OverviewSectionFour::where('company_id', 1)->get();
        $sectionFive = OverviewSectionFive::where('company_id', 1)->first();

        return view('admin.company_pages.section.overview', compact('sectionOne', 'sectionTwos', 'sectionThrees', 'sectionFours', 'sectionFive'));
    }

    public function saveSectionOne(Request $request)
    {
        try {
            DB::beginTransaction();

            $section = OverviewSectionOne::where('company_id', 1)->first() ?? new OverviewSectionOne(['company_id' => 1]);

            if ($request->hasFile('image')) {
                if ($section->image) {
                    Storage::disk('public')->delete($section->image);
                }
                $file = $request->file('image');
                $filename = 'overview-section1-' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('overview/section1', $filename, 'public');
                $section->image = $path;
            }

            $section->description = $request->description;
            $section->save();

            DB::commit();
            return redirect()->route('admin.overview.sections', ['tab' => 'section1'])->with('success', 'Section One updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.overview.sections', ['tab' => 'section1'])->with('error', 'Failed to update Section One: ' . $e->getMessage());
        }
    }

    public function saveSectionTwo(Request $request)
    {
        try {
            DB::beginTransaction();

            if ($request->has('sections')) {
                foreach ($request->sections as $index => $sectionData) {
                    $section = isset($sectionData['id'])
                        ? OverviewSectionTwo::find($sectionData['id'])
                        : new OverviewSectionTwo(['company_id' => 1]);

                    if (isset($sectionData['image_file'])) {
                        if ($section->image) {
                            Storage::disk('public')->delete($section->image);
                        }
                        $file = $sectionData['image_file'];
                        $filename = 'overview-section2-' . time() . '-' . $index . '.' . $file->getClientOriginalExtension();
                        $path = $file->storeAs('overview/section2', $filename, 'public');
                        $section->image = $path;
                    }

                    $section->title = $sectionData['title'];
                    $section->description = $sectionData['description'];
                    $section->save();
                }
            }

            // Handle deletions
            if ($request->has('deleted_sections')) {
                OverviewSectionTwo::whereIn('id', $request->deleted_sections)->delete();
            }

            DB::commit();
            return redirect()->route('admin.overview.sections', ['tab' => 'section2'])->with('success', 'Section Two updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.overview.sections', ['tab' => 'section2'])->with('error', 'Failed to update Section Two: ' . $e->getMessage());
        }
    }

    public function saveSectionThree(Request $request)
    {
        try {
            DB::beginTransaction();

            if ($request->has('sections')) {
                foreach ($request->sections as $index => $sectionData) {
                    $section = isset($sectionData['id'])
                        ? OverviewSectionThree::find($sectionData['id'])
                        : new OverviewSectionThree(['company_id' => 1]);

                    if (isset($sectionData['icon_file'])) {
                        if ($section->icon) {
                            Storage::disk('public')->delete($section->icon);
                        }
                        $file = $sectionData['icon_file'];
                        $filename = 'overview-section3-icon-' . time() . '-' . $index . '.' . $file->getClientOriginalExtension();
                        $path = $file->storeAs('overview/section3/icons', $filename, 'public');
                        $section->icon = $path;
                    }

                    if (isset($sectionData['remove_icon']) && $sectionData['remove_icon']) {
                        Storage::disk('public')->delete($section->icon);
                        $section->icon = null;
                    }

                    $section->type = $sectionData['type'];
                    $section->title = $sectionData['title'];
                    $section->description = $sectionData['description'];
                    $section->save();
                }
            }

            // Handle deletions
            if ($request->has('deleted_sections')) {
                $deletedSections = OverviewSectionThree::whereIn('id', explode(',', $request->deleted_sections))->get();
                foreach ($deletedSections as $section) {
                    if ($section->icon) {
                        Storage::disk('public')->delete($section->icon);
                    }
                    $section->delete();
                }
            }

            DB::commit();
            return redirect()->route('admin.overview.sections', ['tab' => 'section3'])->with('success', 'Section Three updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.overview.sections', ['tab' => 'section3'])->with('error', 'Failed to update Section Three: ' . $e->getMessage());
        }
    }

    public function saveSectionFour(Request $request)
    {
        try {
            DB::beginTransaction();

            if ($request->has('sections')) {
                foreach ($request->sections as $index => $sectionData) {
                    $section = isset($sectionData['id'])
                        ? OverviewSectionFour::find($sectionData['id'])
                        : new OverviewSectionFour(['company_id' => 1]);

                    if (isset($sectionData['image_file'])) {
                        if ($section->image) {
                            Storage::disk('public')->delete($section->image);
                        }
                        $file = $sectionData['image_file'];
                        $filename = 'overview-section4-' . time() . '-' . $index . '.' . $file->getClientOriginalExtension();
                        $path = $file->storeAs('overview/section4', $filename, 'public');
                        $section->image = $path;
                    }

                    $section->year = $sectionData['year'];
                    $section->title = $sectionData['title'];
                    $section->description = $sectionData['description'];
                    $section->save();
                }
            }

            // Handle deletions
            if ($request->has('deleted_sections')) {
                OverviewSectionFour::whereIn('id', $request->deleted_sections)->delete();
            }

            DB::commit();
            return redirect()->route('admin.overview.sections', ['tab' => 'section4'])->with('success', 'Section Four updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.overview.sections', ['tab' => 'section4'])->with('error', 'Failed to update Section Four: ' . $e->getMessage());
        }
    }

    public function saveSectionFive(Request $request)
    {
        try {
            DB::beginTransaction();

            $section = OverviewSectionFive::where('company_id', 1)->first() ?? new OverviewSectionFive(['company_id' => 1]);

            if ($request->hasFile('image')) {
                if ($section->image) {
                    Storage::disk('public')->delete($section->image);
                }
                $file = $request->file('image');
                $filename = 'overview-section5-' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('overview/section5', $filename, 'public');
                $section->image = $path;
            }

            $section->description = $request->description;
            $section->save();

            DB::commit();
            return redirect()->route('admin.overview.sections', ['tab' => 'section5'])->with('success', 'Section Five updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.overview.sections', ['tab' => 'section5'])->with('error', 'Failed to update Section Five: ' . $e->getMessage());
        }
    }
}
