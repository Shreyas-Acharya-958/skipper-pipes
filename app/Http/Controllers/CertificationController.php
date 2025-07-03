<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CertificationSectionOne;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class CertificationController extends Controller
{
    //
    public function sections()
    {
        $certifications = CertificationSectionOne::where('company_id', 1)->get();

        return view('admin.company_pages.section.certifications', compact('certifications'));
    }

    public function saveSectionOne(Request $request)
    {
        try {
            DB::beginTransaction();

            $certification = $request->certification_id
                ? CertificationSectionOne::find($request->certification_id)
                : new CertificationSectionOne(['company_id' => 1]);

            if ($request->hasFile('image')) {
                if ($certification->image) {
                    Storage::disk('public')->delete($certification->image);
                }
                $file = $request->file('image');
                $filename = 'certification-' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('certifications', $filename, 'public');
                $certification->image = $path;
            } elseif ($request->remove_image == '1' && $certification->image) {
                Storage::disk('public')->delete($certification->image);
                $certification->image = null;
            }

            $certification->title = $request->title;
            $certification->short_description = $request->short_description;
            $certification->long_description = $request->long_description;
            $certification->link = $request->link;
            $certification->save();

            DB::commit();
            return redirect()->route('admin.certifications.sections')
                ->with('success', 'Certification ' . ($request->certification_id ? 'updated' : 'added') . ' successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.certifications.sections')
                ->with('error', 'Failed to save certification: ' . $e->getMessage());
        }
    }

    public function delete(Request $request)
    {
        try {
            DB::beginTransaction();

            $certification = CertificationSectionOne::find($request->certification_id);
            if ($certification) {
                if ($certification->image) {
                    Storage::disk('public')->delete($certification->image);
                }
                $certification->delete();
            }

            DB::commit();
            return redirect()->route('admin.certifications.sections')
                ->with('success', 'Certification deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.certifications.sections')
                ->with('error', 'Failed to delete certification: ' . $e->getMessage());
        }
    }
}
