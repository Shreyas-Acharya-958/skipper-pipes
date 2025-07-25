<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CertificationSectionOne;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\CertificationHeadSection;

class CertificationController extends Controller
{
    //
    public function sections()
    {
        $certifications = CertificationSectionOne::where('company_id', 1)->get();
        $certificationHead = CertificationHeadSection::first();
        return view('admin.company_pages.section.certifications', compact('certifications', 'certificationHead'));
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

            // Handle PDF file upload
            if ($request->hasFile('pdf_file')) {
                if ($certification->link) {
                    Storage::disk('public')->delete($certification->link);
                }
                $file = $request->file('pdf_file');
                $filename = 'certification-pdf-' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('certifications/pdfs', $filename, 'public');
                $certification->link = $path;
            } elseif ($request->remove_pdf == '1' && $certification->link) {
                Storage::disk('public')->delete($certification->link);
                $certification->link = null;
            }

            $certification->title = $request->title;
            $certification->short_description = $request->short_description;
            $certification->long_description = $request->long_description;
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

    public function saveHeadSection(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);
        $section = CertificationHeadSection::first() ?? new CertificationHeadSection();
        $section->title = $request->title;
        $section->description = $request->description;
        $section->save();
        return redirect()->route('admin.certifications.sections')->with('success', 'Certification Head updated successfully.');
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
                if ($certification->link) {
                    Storage::disk('public')->delete($certification->link);
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