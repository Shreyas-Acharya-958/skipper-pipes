<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ManufacturingSectionOne;
use App\Models\ManufacturingSectionTwo;
use App\Models\ManufacturingSectionThree;
use App\Models\ManufacturingSectionFour;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ManufacturingController extends Controller
{
    //
    public function sections()
    {
        $sectionOnes = ManufacturingSectionOne::where('company_id', 1)->get();
        $sectionTwo = ManufacturingSectionTwo::where('company_id', 1)->first();
        $sectionThrees = ManufacturingSectionThree::where('company_id', 1)->get();
        $sectionFour = ManufacturingSectionFour::where('company_id', 1)->first();

        return view('admin.company_pages.section.manufacturing', compact('sectionOnes', 'sectionTwo', 'sectionThrees', 'sectionFour'));
    }

    public function saveSectionOne(Request $request)
    {
        try {
            DB::beginTransaction();

            if ($request->has('sections')) {
                foreach ($request->sections as $index => $sectionData) {
                    $section = isset($sectionData['id'])
                        ? ManufacturingSectionOne::find($sectionData['id'])
                        : new ManufacturingSectionOne(['company_id' => 1]);

                    if (isset($sectionData['image']) && $sectionData['image'] instanceof \Illuminate\Http\UploadedFile) {
                        if ($section->image) {
                            Storage::disk('public')->delete($section->image);
                        }
                        $file = $sectionData['image'];
                        $filename = 'manufacturing-section1-' . time() . '-' . $index . '.' . $file->getClientOriginalExtension();
                        $path = $file->storeAs('manufacturing/section1', $filename, 'public');
                        $section->image = $path;
                    }

                    $section->title = $sectionData['title'];
                    $section->description = $sectionData['description'];
                    $section->save();
                }
            }

            // Handle deletions
            if ($request->has('deleted_sections')) {
                ManufacturingSectionOne::whereIn('id', $request->deleted_sections)->delete();
            }

            DB::commit();
            return redirect()->route('admin.manufacturing.sections', ['tab' => 'section1'])->with('success', 'Manufacturing Units updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.manufacturing.sections', ['tab' => 'section1'])->with('error', 'Failed to update Manufacturing Units: ' . $e->getMessage());
        }
    }

    public function saveSectionTwo(Request $request)
    {
        try {
            DB::beginTransaction();

            $section = ManufacturingSectionTwo::where('company_id', 1)->first() ?? new ManufacturingSectionTwo(['company_id' => 1]);

            if ($request->hasFile('image')) {
                if ($section->image) {
                    Storage::disk('public')->delete($section->image);
                }
                $file = $request->file('image');
                $filename = 'manufacturing-section2-' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('manufacturing/section2', $filename, 'public');
                $section->image = $path;
            }

            $section->description = $request->description;
            $section->save();

            DB::commit();
            return redirect()->route('admin.manufacturing.sections', ['tab' => 'section2'])->with('success', 'Technology & Machinery updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.manufacturing.sections', ['tab' => 'section2'])->with('error', 'Failed to update Technology & Machinery: ' . $e->getMessage());
        }
    }

    public function saveSectionThree(Request $request)
    {
        try {
            DB::beginTransaction();

            if ($request->has('sections')) {
                foreach ($request->sections as $index => $sectionData) {
                    $section = isset($sectionData['id'])
                        ? ManufacturingSectionThree::find($sectionData['id'])
                        : new ManufacturingSectionThree(['company_id' => 1]);

                    if (isset($sectionData['icon_file'])) {
                        if ($section->icon) {
                            Storage::disk('public')->delete($section->icon);
                        }
                        $file = $sectionData['icon_file'];
                        $filename = 'manufacturing-section3-icon-' . time() . '-' . $index . '.' . $file->getClientOriginalExtension();
                        $path = $file->storeAs('manufacturing/section3/icons', $filename, 'public');
                        $section->icon = $path;
                    }

                    if (isset($sectionData['remove_icon']) && $sectionData['remove_icon']) {
                        Storage::disk('public')->delete($section->icon);
                        $section->icon = null;
                    }

                    $section->title = $sectionData['title'];
                    $section->description = $sectionData['description'];
                    $section->save();
                }
            }

            // Handle deletions
            if ($request->has('deleted_sections')) {
                $deletedSections = ManufacturingSectionThree::whereIn('id', explode(',', $request->deleted_sections))->get();
                foreach ($deletedSections as $section) {
                    if ($section->icon) {
                        Storage::disk('public')->delete($section->icon);
                    }
                    $section->delete();
                }
            }

            DB::commit();
            return redirect()->route('admin.manufacturing.sections', ['tab' => 'section3'])->with('success', 'Section Three updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.manufacturing.sections', ['tab' => 'section3'])->with('error', 'Failed to update Section Three: ' . $e->getMessage());
        }
    }

    public function saveSectionFour(Request $request)
    {
        try {
            DB::beginTransaction();

            $section = ManufacturingSectionFour::where('company_id', 1)->first() ?? new ManufacturingSectionFour(['company_id' => 1]);

            if ($request->hasFile('image')) {
                if ($section->image) {
                    Storage::disk('public')->delete($section->image);
                }
                $file = $request->file('image');
                $filename = 'manufacturing-section4-' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('manufacturing/section4', $filename, 'public');
                $section->image = $path;
            }

            $section->description = $request->description;
            $section->save();

            DB::commit();
            return redirect()->route('admin.manufacturing.sections', ['tab' => 'section4'])->with('success', 'Sustainability Practices updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.manufacturing.sections', ['tab' => 'section4'])->with('error', 'Failed to update Sustainability Practices: ' . $e->getMessage());
        }
    }
}
