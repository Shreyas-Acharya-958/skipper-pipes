<?php

namespace App\Http\Controllers;

use App\Models\CompanyPage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CompanyPageController extends Controller
{
    public function index()
    {
        $pages = CompanyPage::latest()->paginate(10);
        return view('admin.company_pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.company_pages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:company_pages',
            'short_description' => 'required|string',
            'long_description' => 'required|string',
            'section_1' => 'nullable|string',
            'section_2' => 'nullable|string',
            'section_3' => 'nullable|string',
            'section_4' => 'nullable|string',
            'section_5' => 'nullable|string',
            'section_6' => 'nullable|string',
            'section_7' => 'nullable|string',
            'section_8' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'page_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|boolean',
            'is_active' => 'required|boolean',
        ]);

        $data = $request->all();
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        // Handle image upload
        if ($request->hasFile('page_image')) {
            $file = $request->file('page_image');
            $filename = Str::slug($request->title) . '-page-' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('company_pages', $filename, 'public');
            $data['page_image'] = $path;
        }

        CompanyPage::create($data);

        return redirect()->route('admin.company_pages.index')
            ->with('success', 'Company page created successfully.');
    }

    public function show(CompanyPage $company_page)
    {
        return view('admin.company_pages.show', ['page' => $company_page]);
    }

    public function edit(CompanyPage $company_page)
    {
        return view('admin.company_pages.edit', compact('company_page'));
    }

    public function update(Request $request, CompanyPage $company_page)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:company_pages,slug,' . $company_page->id,
            'short_description' => 'required|string',
            'long_description' => 'required|string',
            'section_1' => 'nullable|string',
            'section_2' => 'nullable|string',
            'section_3' => 'nullable|string',
            'section_4' => 'nullable|string',
            'section_5' => 'nullable|string',
            'section_6' => 'nullable|string',
            'section_7' => 'nullable|string',
            'section_8' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'page_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|boolean',
            'is_active' => 'required|boolean',
            'remove_image' => 'nullable|boolean'
        ]);

        $data = $request->all();
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        // Handle image removal
        if ($request->boolean('remove_image')) {
            if ($company_page->page_image) {
                Storage::disk('public')->delete($company_page->page_image);
            }
            $data['page_image'] = null;
        }
        // Handle image upload
        elseif ($request->hasFile('page_image')) {
            // Delete old image
            if ($company_page->page_image) {
                Storage::disk('public')->delete($company_page->page_image);
            }

            $file = $request->file('page_image');
            $filename = Str::slug($request->title) . '-page-' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('company_pages', $filename, 'public');
            $data['page_image'] = $path;
        }

        $company_page->update($data);
        return redirect(url('admin/company-pages'))->with('success', 'Company page updated successfully.');
    }

    public function destroy(CompanyPage $company_page)
    {
        // Delete image if exists
        if ($company_page->page_image) {
            Storage::disk('public')->delete($company_page->page_image);
        }

        $company_page->delete();

        return redirect()->route('admin.company_pages.index')
            ->with('success', 'Company page deleted successfully.');
    }
}