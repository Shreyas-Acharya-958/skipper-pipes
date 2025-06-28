<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::query();
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', "%{$search}%");
        }
        $products = $query->paginate(10); // 10 per page, change as needed
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug',
            'product_overview' => 'required|string',
            'features_benefits' => 'required|string',
            'technical' => 'required|string',
            'application' => 'required|string',
            'faq' => 'required|string',
            'status' => 'required|boolean',
            'page_image' => 'nullable|image',
            'product_overview_image' => 'nullable|image',
            'brochure' => 'nullable|mimes:pdf,doc,docx',
        ]);

        // Handle file uploads with custom names
        foreach (['page_image', 'product_overview_image'] as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = Str::slug($request->title) . '-' . $field . '-' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('products', $filename, 'public');
                $validated[$field] = $path;
            }
        }

        if ($request->hasFile('brochure')) {
            $file = $request->file('brochure');
            $filename = Str::slug($request->title) . '-brochure-' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('products/brochures', $filename, 'public');
            $validated['brochure'] = $path;
        }

        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug,' . $product->id,
            'product_overview' => 'required|string',
            'features_benefits' => 'required|string',
            'technical' => 'required|string',
            'application' => 'required|string',
            'faq' => 'required|string',
            'status' => 'required|boolean',
            'page_image' => 'nullable|image',
            'product_overview_image' => 'nullable|image',
            'brochure' => 'nullable|mimes:pdf,doc,docx',
        ]);

        // Handle file uploads and removals with custom names
        foreach (['page_image', 'product_overview_image'] as $field) {
            if ($request->has('remove_' . $field) && $request->input('remove_' . $field) === '1') {
                if ($product->$field) {
                    Storage::disk('public')->delete($product->$field);
                    $validated[$field] = null;
                }
            } elseif ($request->hasFile($field)) {
                if ($product->$field) {
                    Storage::disk('public')->delete($product->$field);
                }
                $file = $request->file($field);
                $filename = Str::slug($request->title) . '-' . $field . '-' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('products', $filename, 'public');
                $validated[$field] = $path;
            } else {
                unset($validated[$field]);
            }
        }

        // Handle brochure
        if ($request->has('remove_brochure') && $request->input('remove_brochure') === '1') {
            if ($product->brochure) {
                Storage::disk('public')->delete($product->brochure);
                $validated['brochure'] = null;
            }
        } elseif ($request->hasFile('brochure')) {
            if ($product->brochure) {
                Storage::disk('public')->delete($product->brochure);
            }
            $file = $request->file('brochure');
            $filename = Str::slug($request->title) . '-brochure-' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('products/brochures', $filename, 'public');
            $validated['brochure'] = $path;
        } else {
            unset($validated['brochure']);
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Delete associated files
        if ($product->page_image) {
            Storage::disk('public')->delete($product->page_image);
        }
        if ($product->product_overview_image) {
            Storage::disk('public')->delete($product->product_overview_image);
        }
        if ($product->brochure) {
            Storage::disk('public')->delete($product->brochure);
        }

        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}
