<?php

namespace App\Http\Controllers;

use App\Models\CompanyPage;
use Illuminate\Http\Request;

class CompanyPageController extends Controller
{
    public function index()
    {
        $pages = CompanyPage::all();
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
            'slug' => 'required|string|unique:company_pages',
            'short_description' => 'required|string',
            'long_description' => 'required|string',
            'status' => 'required|boolean',
            'is_active' => 'required|boolean'
        ]);

        CompanyPage::create($request->all());

        return redirect()->route('admin.company_pages.index')->with('success', 'Company page created successfully.');
    }

    public function show(CompanyPage $page)
    {
        return view('admin.company_pages.show', compact('page'));
    }

    public function edit(CompanyPage $page)
    {
        return view('admin.company_pages.edit', compact('page'));
    }

    public function update(Request $request, CompanyPage $page)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:company_pages,slug,' . $page->id,
            'short_description' => 'required|string',
            'long_description' => 'required|string',
            'status' => 'required|boolean',
            'is_active' => 'required|boolean'
        ]);

        $page->update($request->all());

        return redirect()->route('admin.company_pages.index')->with('success', 'Company page updated successfully.');
    }

    public function destroy(CompanyPage $page)
    {
        $page->delete();

        return redirect()->route('admin.company_pages.index')->with('success', 'Company page deleted successfully.');
    }
}
