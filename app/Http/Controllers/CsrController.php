<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CsrSectionOne;
use App\Models\CsrSectionTwo;
use App\Models\CsrSectionThree;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class CsrController extends Controller
{
    public function sections()
    {
        $sectionOne = CsrSectionOne::where('company_id', 1)->first();
        $sectionTwos = CsrSectionTwo::where('company_id', 1)->get();
        $sectionThrees = CsrSectionThree::where('company_id', 1)->get();

        return view('admin.company_pages.section.csr', compact('sectionOne', 'sectionTwos', 'sectionThrees'));
    }

    public function saveSectionOne(Request $request)
    {
        try {
            DB::beginTransaction();

            $section = CsrSectionOne::where('company_id', 1)->first() ?? new CsrSectionOne(['company_id' => 1]);

            if ($request->hasFile('image')) {
                if ($section->image) {
                    Storage::disk('public')->delete($section->image);
                }
                $file = $request->file('image');
                $filename = 'csr-section1-' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('csr/section1', $filename, 'public');
                $section->image = $path;
            }

            $section->description = $request->description;
            $section->save();

            DB::commit();
            return redirect()->route('admin.csr.sections', ['tab' => 'section1'])->with('success', 'CSR Philosophy updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.csr.sections', ['tab' => 'section1'])->with('error', 'Failed to update CSR Philosophy: ' . $e->getMessage());
        }
    }

    public function saveSectionTwo(Request $request)
    {
        try {
            DB::beginTransaction();

            if ($request->has('sections')) {
                foreach ($request->sections as $index => $sectionData) {
                    $section = isset($sectionData['id'])
                        ? CsrSectionTwo::find($sectionData['id'])
                        : new CsrSectionTwo(['company_id' => 1]);

                    $section->icon = $sectionData['icon'];
                    $section->title = $sectionData['title'];
                    $section->description = $sectionData['description'];
                    $section->save();
                }
            }

            // Handle deletions
            if ($request->has('deleted_sections')) {
                CsrSectionTwo::whereIn('id', $request->deleted_sections)->delete();
            }

            DB::commit();
            return redirect()->route('admin.csr.sections', ['tab' => 'section2'])->with('success', 'Key Focus Areas updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.csr.sections', ['tab' => 'section2'])->with('error', 'Failed to update Key Focus Areas: ' . $e->getMessage());
        }
    }

    public function saveSectionThree(Request $request)
    {
        try {
            DB::beginTransaction();

            $initiative = $request->initiative_id
                ? CsrSectionThree::find($request->initiative_id)
                : new CsrSectionThree(['company_id' => 1]);

            if ($request->hasFile('image')) {
                if ($initiative->image) {
                    Storage::disk('public')->delete($initiative->image);
                }
                $file = $request->file('image');
                $filename = 'csr-initiative-' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('csr/initiatives', $filename, 'public');
                $initiative->image = $path;
            } elseif ($request->remove_image == '1' && $initiative->image) {
                Storage::disk('public')->delete($initiative->image);
                $initiative->image = null;
            }

            $initiative->title = $request->title;
            $initiative->description = $request->description;
            $initiative->save();

            DB::commit();
            return redirect()->route('admin.csr.sections', ['tab' => 'section3'])
                ->with('success', 'Initiative ' . ($request->initiative_id ? 'updated' : 'added') . ' successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.csr.sections', ['tab' => 'section3'])
                ->with('error', 'Failed to save initiative: ' . $e->getMessage());
        }
    }

    public function deleteSectionThree(Request $request)
    {
        try {
            DB::beginTransaction();

            $initiative = CsrSectionThree::find($request->initiative_id);
            if ($initiative) {
                if ($initiative->image) {
                    Storage::disk('public')->delete($initiative->image);
                }
                $initiative->delete();
            }

            DB::commit();
            return redirect()->route('admin.csr.sections', ['tab' => 'section3'])
                ->with('success', 'Initiative deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.csr.sections', ['tab' => 'section3'])
                ->with('error', 'Failed to delete initiative: ' . $e->getMessage());
        }
    }
}
