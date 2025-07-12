<?php

namespace App\Http\Controllers;

use App\Models\WhySkipperPipe;
use App\Models\WhySkipperPipeSectionOne;
use App\Models\WhySkipperPipeSectionTwo;
use App\Models\WhySkipperPipeSectionThree;
use App\Models\WhySkipperPipeSectionFour;
use App\Models\WhySkipperPipeSectionFive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WhySkipperPipeController extends Controller
{
    public function index()
    {
        $mainSection = WhySkipperPipe::first();
        $sectionThrees = WhySkipperPipeSectionThree::all();
        $sectionFours = WhySkipperPipeSectionFour::orderBy('created_at', 'asc')->get();
        $sectionFives = WhySkipperPipeSectionFive::orderBy('sequence', 'asc')->get();
        $builtForConditions = WhySkipperPipeSectionTwo::orderBy('sequence', 'asc')->get();

        return view('admin.why_skipper_pipes.index', compact(
            'mainSection',
            'sectionThrees',
            'sectionFours',
            'sectionFives',
            'builtForConditions'
        ));
    }

    public function saveMain(Request $request)
    {
        $section = WhySkipperPipe::first() ?? new WhySkipperPipe();

        if ($request->hasFile('image')) {
            if ($section->image) {
                Storage::disk('public')->delete($section->image);
            }
            $section->image = $request->file('image')->store('why-skipper-pipes', 'public');
        }

        if ($request->remove_image && $section->image) {
            Storage::disk('public')->delete($section->image);
            $section->image = null;
        }

        $section->title = $request->title;
        $section->description = $request->description;
        $section->save();

        return redirect()->back()->with('success', 'Main section updated successfully');
    }

    public function saveSection3(Request $request)
    {
        // Handle deleted sections
        if ($request->deleted_sections) {
            foreach ($request->deleted_sections as $id) {
                $section = WhySkipperPipeSectionThree::find($id);
                if ($section) {
                    if ($section->image) {
                        Storage::disk('public')->delete($section->image);
                    }
                    $section->delete();
                }
            }
        }

        // Handle sections data
        foreach ($request->sections as $data) {
            if (isset($data['id']) && $data['id']) {
                $section = WhySkipperPipeSectionThree::find($data['id']);
            } else {
                $section = new WhySkipperPipeSectionThree();
            }

            if (isset($data['image_file']) && $data['image_file']) {
                if ($section->image) {
                    Storage::disk('public')->delete($section->image);
                }
                $section->image = $data['image_file']->store('why-skipper-pipes', 'public');
            }

            if (isset($data['remove_image']) && $data['remove_image'] && $section->image) {
                Storage::disk('public')->delete($section->image);
                $section->image = null;
            }

            $section->title = $data['title'];
            $section->description = $data['description'];
            $section->save();
        }

        return redirect()->back()->with('success', 'Why Skipper Pipes section updated successfully');
    }

    public function saveSection4(Request $request)
    {
        // Handle deleted sections
        if ($request->deleted_sections) {
            foreach ($request->deleted_sections as $id) {
                $section = WhySkipperPipeSectionFour::find($id);
                if ($section) {
                    if ($section->image) {
                        Storage::disk('public')->delete($section->image);
                    }
                    $section->delete();
                }
            }
        }

        // Handle sections data
        foreach ($request->sections as $data) {
            if (isset($data['id']) && $data['id']) {
                $section = WhySkipperPipeSectionFour::find($data['id']);
            } else {
                $section = new WhySkipperPipeSectionFour();
            }

            if (isset($data['image_file']) && $data['image_file']) {
                if ($section->image) {
                    Storage::disk('public')->delete($section->image);
                }
                $section->image = $data['image_file']->store('why-skipper-pipes', 'public');
            }

            if (isset($data['remove_image']) && $data['remove_image'] && $section->image) {
                Storage::disk('public')->delete($section->image);
                $section->image = null;
            }

            $section->title = $data['title'];
            $section->description = $data['description'];
            $section->save();
        }

        return redirect()->back()->with('success', 'Infrastructure section updated successfully');
    }

    public function saveSection5(Request $request)
    {
        // Handle deleted sections
        if ($request->deleted_sections) {
            foreach ($request->deleted_sections as $id) {
                $section = WhySkipperPipeSectionFive::find($id);
                if ($section) {
                    if ($section->image) {
                        Storage::disk('public')->delete($section->image);
                    }
                    $section->delete();
                }
            }
        }

        // Handle sections data
        foreach ($request->sections as $index => $data) {
            if (isset($data['id']) && $data['id']) {
                $section = WhySkipperPipeSectionFive::find($data['id']);
            } else {
                $section = new WhySkipperPipeSectionFive();
            }

            if (isset($data['image_file']) && $data['image_file']) {
                if ($section->image) {
                    Storage::disk('public')->delete($section->image);
                }
                $section->image = $data['image_file']->store('why-skipper-pipes', 'public');
            }

            if (isset($data['remove_image']) && $data['remove_image'] && $section->image) {
                Storage::disk('public')->delete($section->image);
                $section->image = null;
            }

            $section->title = $data['title'];
            $section->description = $data['description'];
            $section->sequence = $index + 1;
            $section->save();
        }

        return redirect()->back()->with('success', 'Quality section updated successfully');
    }

    public function saveBuiltForCondition(Request $request)
    {
        // Handle deleted sections
        if ($request->deleted_sections) {
            foreach ($request->deleted_sections as $id) {
                $section = WhySkipperPipeSectionTwo::find($id);
                if ($section) {
                    if ($section->image) {
                        Storage::disk('public')->delete($section->image);
                    }
                    $section->delete();
                }
            }
        }

        // Handle sections data
        foreach ($request->sections as $index => $data) {
            if (isset($data['id']) && $data['id']) {
                $section = WhySkipperPipeSectionTwo::find($data['id']);
            } else {
                $section = new WhySkipperPipeSectionTwo();
            }

            if (isset($data['image_file']) && $data['image_file']) {
                if ($section->image) {
                    Storage::disk('public')->delete($section->image);
                }
                $section->image = $data['image_file']->store('why-skipper-pipes', 'public');
            }

            if (isset($data['remove_image']) && $data['remove_image'] && $section->image) {
                Storage::disk('public')->delete($section->image);
                $section->image = null;
            }

            $section->title = $data['title'];
            $section->description = $data['description'];
            $section->sequence = $index + 1;
            $section->save();
        }

        return redirect()->back()->with('success', 'Built for Condition section updated successfully');
    }
}
