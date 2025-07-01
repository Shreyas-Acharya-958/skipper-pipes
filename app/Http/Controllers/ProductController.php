<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\UploadedFile;
use App\Models\ProductionOverviewSection;
use App\Models\ProductionApplicationSection;
use App\Models\ProductionFeaturesSection;
use App\Models\ProductionFaqSection;

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
        $products = $query->with('productCategory')->paginate(10); // 10 per page, change as needed
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ProductCategory::where('status', true)->get();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_category_id' => 'required|exists:product_categories,id',
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
        $product->load('productCategory');
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = ProductCategory::where('status', true)->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'product_category_id' => 'required|exists:product_categories,id',
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

    public function sections(Product $product)
    {
        $overview = $product->productionOverviewSection;
        $applications = $product->productionApplicationSections;
        $features = $product->productionFeaturesSections;
        $faqs = $product->productionFaqSections;

        return view('admin.products.sections', compact('product', 'overview', 'applications', 'features', 'faqs'));
    }

    public function saveOverview(Request $request, Product $product)
    {
        try {
            DB::beginTransaction();

            $overview = $product->productionOverviewSection ?? new ProductionOverviewSection();
            $overview->product_id = $product->id;
            $overview->overview_description = $request->overview_description;

            // Handle images
            $images = [];

            // Keep existing images that weren't removed
            if ($request->has('existing_images')) {
                $images = array_values($request->existing_images);
            }

            // Handle base64 images
            if ($request->has('overview_images')) {
                foreach ($request->overview_images as $imageData) {
                    if (count($images) >= 5) break; // Maximum 5 images

                    // Check if it's a base64 image
                    if (strpos($imageData, ';base64,') !== false) {
                        // Extract the actual base64 string
                        list(, $imageData) = explode(';base64,', $imageData);

                        // Decode base64 data
                        $imageData = base64_decode($imageData);

                        // Generate unique filename
                        $filename = 'overview_' . time() . '_' . uniqid() . '.png';

                        // Store the file
                        Storage::disk('public')->put('products/overview/' . $filename, $imageData);

                        // Save the path
                        $images[] = 'products/overview/' . $filename;
                    }
                }
            }

            $overview->overview_image = json_encode($images);
            $overview->save();

            DB::commit();
            return redirect()->back()->with('success', 'Overview section updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to update overview section: ' . $e->getMessage());
        }
    }

    public function saveApplications(Request $request, Product $product)
    {
        $request->validate([
            'applications.*.icon' => 'required|string',
            'applications.*.title' => 'required|string',
            'applications.*.description' => 'required|string',
            'applications.*.image_base64' => 'nullable|string',
        ]);

        // Start transaction
        DB::beginTransaction();
        try {
            // Delete existing applications not in the request
            if ($request->has('applications')) {
                $existingIds = collect($request->applications)->pluck('id')->filter();
                $product->productionApplicationSections()
                    ->whereNotIn('id', $existingIds)
                    ->delete();
            } else {
                $product->productionApplicationSections()->delete();
            }

            // Create or update applications
            if ($request->has('applications')) {
                foreach ($request->applications as $index => $appData) {
                    $application = null;

                    if (isset($appData['id'])) {
                        $application = ProductionApplicationSection::find($appData['id']);
                    }

                    if (!$application) {
                        $application = new ProductionApplicationSection();
                        $application->product_id = $product->id;
                    }

                    $application->icon = $appData['icon'];
                    $application->title = $appData['title'];
                    $application->description = $appData['description'];
                    $application->sequence = $index;

                    // Handle base64 image
                    if (!empty($appData['image_base64'])) {
                        // Delete old image if exists
                        if ($application->image) {
                            Storage::disk('public')->delete($application->image);
                        }

                        // Extract the actual base64 string
                        if (strpos($appData['image_base64'], ';base64,') !== false) {
                            list(, $imageData) = explode(';base64,', $appData['image_base64']);

                            // Decode base64 data
                            $imageData = base64_decode($imageData);

                            // Generate unique filename
                            $filename = 'application_' . time() . '_' . uniqid() . '.png';

                            // Store the file
                            Storage::disk('public')->put('products/applications/' . $filename, $imageData);

                            // Save the path
                            $application->image = 'products/applications/' . $filename;
                        }
                    }

                    $application->save();
                }
            }

            DB::commit();
            return redirect()->back()->with('success', 'Applications section updated successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Failed to update applications section: ' . $e->getMessage());
        }
    }

    public function saveFeatures(Request $request, Product $product)
    {
        try {
            DB::beginTransaction();

            // Delete existing features not in the request
            if ($request->has('features')) {
                $existingIds = collect($request->features)->pluck('id')->filter();
                $product->productionFeaturesSections()
                    ->whereNotIn('id', $existingIds)
                    ->delete();
            } else {
                $product->productionFeaturesSections()->delete();
            }

            // Create or update features
            if ($request->has('features')) {
                foreach ($request->features as $index => $featureData) {
                    if (isset($featureData['id'])) {
                        $feature = ProductionFeaturesSection::find($featureData['id']);
                    } else {
                        $feature = new ProductionFeaturesSection();
                        $feature->product_id = $product->id;
                    }

                    $feature->title = $featureData['title'];
                    $feature->icon = $featureData['icon'];
                    $feature->description = $featureData['description'];
                    $feature->sequence = $index;

                    // Handle base64 image
                    if (!empty($featureData['image_base64'])) {
                        // Get file data
                        $imageData = $featureData['image_base64'];

                        // Extract the actual base64 string (remove data:image/png;base64, etc.)
                        if (strpos($imageData, ';base64,') !== false) {
                            list(, $imageData) = explode(';base64,', $imageData);
                        }

                        // Decode base64 data
                        $imageData = base64_decode($imageData);

                        // Generate unique filename
                        $filename = 'feature_' . time() . '_' . uniqid() . '.png';

                        // Store the file
                        Storage::disk('public')->put('products/features/' . $filename, $imageData);

                        // Save the path
                        $feature->image = 'products/features/' . $filename;
                    }

                    $feature->save();
                }
            }

            DB::commit();
            return redirect()->back()->with('success', 'Features section updated successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Failed to update features section: ' . $e->getMessage());
        }
    }

    public function saveFaq(Request $request, Product $product)
    {
        $request->validate([
            'faqs.*.title' => 'required|string',
            'faqs.*.description' => 'required|string',
        ]);

        // Start transaction
        DB::beginTransaction();
        try {
            // Delete existing FAQs not in the request
            if ($request->has('faqs')) {
                $existingIds = collect($request->faqs)->pluck('id')->filter();
                $product->productionFaqSections()
                    ->whereNotIn('id', $existingIds)
                    ->delete();
            } else {
                $product->productionFaqSections()->delete();
            }

            // Create or update FAQs
            if ($request->has('faqs')) {
                foreach ($request->faqs as $index => $faqData) {
                    if (isset($faqData['id'])) {
                        $faq = ProductionFaqSection::find($faqData['id']);
                        $faq->update([
                            'title' => $faqData['title'],
                            'description' => $faqData['description'],
                            'sequence' => $index,
                        ]);
                    } else {
                        $product->productionFaqSections()->create([
                            'title' => $faqData['title'],
                            'description' => $faqData['description'],
                            'sequence' => $index,
                        ]);
                    }
                }
            }

            DB::commit();
            return redirect()->back()->with('success', 'FAQ section updated successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Failed to update FAQ section.');
        }
    }
}