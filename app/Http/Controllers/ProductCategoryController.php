<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = ProductCategory::query();

        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                    ->orWhere('slug', 'like', "%{$searchTerm}%")
                    ->orWhere('description', 'like', "%{$searchTerm}%");
            });
        }

        $categories = $query->latest()->paginate(10);
        return view('admin.product_categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:product_categories',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|boolean'
        ]);

        $data = $request->except(['image', 'icon']);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product-categories', 'public');
            $data['image'] = $imagePath;
        }

        if ($request->hasFile('icon')) {
            $iconPath = $request->file('icon')->store('product-categories/icons', 'public');
            $data['icon'] = $iconPath;
        }

        ProductCategory::create($data);

        return redirect()
            ->route('admin.product_categories.index')
            ->with('success', 'Product category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductCategory $productCategory)
    {
        return view('admin.product_categories.show', ['category' => $productCategory]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductCategory $productCategory)
    {
        return view('admin.product_categories.edit', ['category' => $productCategory]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductCategory $productCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:product_categories,slug,' . $productCategory->id,
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|boolean'
        ]);

        $data = $request->except(['image', 'icon']);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($productCategory->image) {
                Storage::disk('public')->delete($productCategory->image);
            }

            $imagePath = $request->file('image')->store('product-categories', 'public');
            $data['image'] = $imagePath;
        }

        if ($request->hasFile('icon')) {
            // Delete old icon if exists
            if ($productCategory->icon) {
                Storage::disk('public')->delete($productCategory->icon);
            }

            $iconPath = $request->file('icon')->store('product-categories/icons', 'public');
            $data['icon'] = $iconPath;
        }

        $productCategory->update($data);

        return redirect()
            ->route('admin.product_categories.index')
            ->with('success', 'Product category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductCategory $productCategory)
    {
        // Delete the image if exists
        if ($productCategory->image) {
            Storage::disk('public')->delete($productCategory->image);
        }

        // Delete the icon if exists
        if ($productCategory->icon) {
            Storage::disk('public')->delete($productCategory->icon);
        }

        $productCategory->delete();

        return redirect()
            ->route('admin.product_categories.index')
            ->with('success', 'Product category deleted successfully.');
    }
}
