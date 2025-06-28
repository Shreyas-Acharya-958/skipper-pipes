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
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|boolean',
            'is_active' => 'required|boolean',
        ]);

        $data = $request->all();
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $path = $image->storeAs('public/company_pages', $filename);
            $data['image'] = str_replace('public/', '', $path);
        }

        CompanyPage::create($data);

        return redirect()->route('admin.company_pages.index')
            ->with('success', 'Company page created successfully.');
    }

    public function show(CompanyPage $company_page)
    {
        return view('admin.company_pages.show', compact('company_page'));
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
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|boolean',
            'is_active' => 'required|boolean',
        ]);

        $data = $request->all();
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($company_page->image) {
                Storage::delete('public/' . $company_page->image);
            }

            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $path = $image->storeAs('public/company_pages', $filename);
            $data['image'] = str_replace('public/', '', $path);
        }

        $company_page->update($data);

        return redirect()->route('admin.company_pages.index')
            ->with('success', 'Company page updated successfully.');
    }

    public function destroy(CompanyPage $company_page)
    {
        // Delete image if exists
        if ($company_page->image) {
            Storage::delete('public/' . $company_page->image);
        }

        $company_page->delete();

        return redirect()->route('admin.company_pages.index')
            ->with('success', 'Company page deleted successfully.');
    }
}
