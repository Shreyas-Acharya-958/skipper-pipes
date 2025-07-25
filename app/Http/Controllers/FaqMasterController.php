<?php

namespace App\Http\Controllers;

use App\Models\FaqMaster;
use App\Models\FaqList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FaqMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = FaqMaster::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', "%{$search}%");
        }

        $faqMasters = $query->withCount('faqLists')->paginate(10);
        return view('admin.faq_masters.index', compact('faqMasters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.faq_masters.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        FaqMaster::create($validated);

        return redirect()->route('admin.faq_masters.index')
            ->with('success', 'FAQ Master created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FaqMaster $faqMaster)
    {
        return view('admin.faq_masters.edit', compact('faqMaster'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FaqMaster $faqMaster)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $faqMaster->update($validated);

        return redirect()->route('admin.faq_masters.index')
            ->with('success', 'FAQ Master updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FaqMaster $faqMaster)
    {
        $faqMaster->delete();

        return redirect()->route('admin.faq_masters.index')
            ->with('success', 'FAQ Master deleted successfully.');
    }

    /**
     * Get FAQs for a specific FAQ Master
     */
    public function getFaqs(FaqMaster $faqMaster)
    {
        $faqs = $faqMaster->faqLists()
            ->orderBy('sequence')
            ->get();

        return response()->json($faqs);
    }

    /**
     * Store a new FAQ
     */
    public function storeFaq(Request $request, FaqMaster $faqMaster)
    {
        $validator = Validator::make($request->all(), [
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'sequence' => 'required|integer|min:0',
            'status' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $faq = $faqMaster->faqLists()->create($validator->validated());

        return response()->json($faq, 201);
    }

    /**
     * Update an existing FAQ
     */
    public function updateFaq(Request $request, FaqMaster $faqMaster, FaqList $faq)
    {
        $validator = Validator::make($request->all(), [
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'sequence' => 'required|integer|min:0',
            'status' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $faq->update($validator->validated());

        return response()->json($faq);
    }

    /**
     * Delete an FAQ
     */
    public function deleteFaq(FaqMaster $faqMaster, FaqList $faq)
    {
        $faq->delete();
        return response()->json(['message' => 'FAQ deleted successfully']);
    }


    public function show()
    {
        $faqSectionOne = \App\Models\FaqSectionOne::first();
        $faqSectionTwo = \App\Models\FaqSectionTwo::first();
        return view('admin.faq_masters.section', compact('faqSectionOne', 'faqSectionTwo'));
    }
    public function saveSectionOne(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);
        $section = \App\Models\FaqSectionOne::first() ?? new \App\Models\FaqSectionOne();
        $section->fill($validated);
        $section->save();
        return redirect()->back()->with('success', 'FAQ Head Section saved successfully.');
    }

    public function saveSectionTwo(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        $section = \App\Models\FaqSectionTwo::first() ?? new \App\Models\FaqSectionTwo();
        if ($request->hasFile('image')) {
            if ($section->image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($section->image);
            }
            $file = $request->file('image');
            $filename = 'faq-section2-' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('faq/section2', $filename, 'public');
            $section->image = $path;
        }
        $section->title = $validated['title'] ?? $section->title;
        $section->description = $validated['description'] ?? $section->description;
        $section->save();
        return redirect()->back()->with('success', 'FAQ Main Section saved successfully.');
    }
}
