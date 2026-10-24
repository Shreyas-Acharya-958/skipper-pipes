<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use App\Models\ProductionOverviewSection;
use App\Models\ProductionApplicationSection;
use App\Models\ProductionFeaturesSection;
use App\Models\ProductionFaqSection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Support\SiteCache;

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
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'hero_image' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'icon' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'brochure' => 'nullable|mimes:pdf,doc,docx|max:10240',
            'technical_brochure' => 'nullable|mimes:pdf,doc,docx|max:10240',
            'status' => 'required|boolean'
        ]);

        $data = $request->except(['image', 'hero_image', 'icon', 'brochure', 'technical_brochure']);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product-categories', 'public');
            $data['image'] = $imagePath;
        }

        if ($request->hasFile('hero_image')) {
            $data['hero_image'] = $request->file('hero_image')->store('product-categories/hero', 'public');
        }

        if ($request->hasFile('icon')) {
            $iconPath = $request->file('icon')->store('product-categories/icons', 'public');
            $data['icon'] = $iconPath;
        }

        foreach (['brochure', 'technical_brochure'] as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = Str::slug($request->name) . '-' . $field . '-' . time() . '.' . $file->getClientOriginalExtension();
                $data[$field] = $file->storeAs('product-categories/brochures', $filename, 'public');
            }
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
            'image' => 'nullable|mimes:webp,jpeg,png,jpg,gif,svg|max:2048',
            'hero_image' => 'nullable|mimes:webp,jpeg,png,jpg,gif,svg|max:2048',
            'icon' => 'nullable|mimes:webp,jpeg,png,jpg,gif,svg|max:2048',
            'brochure' => 'nullable|mimes:pdf,doc,docx|max:10240',
            'technical_brochure' => 'nullable|mimes:pdf,doc,docx|max:10240',
            'status' => 'required|boolean'
        ]);

        $data = $request->except(['image', 'hero_image', 'icon', 'brochure', 'technical_brochure']);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($productCategory->image) {
                Storage::disk('public')->delete($productCategory->image);
            }

            $imagePath = $request->file('image')->store('product-categories', 'public');
            $data['image'] = $imagePath;
        }

        if ($request->hasFile('hero_image')) {
            if ($productCategory->hero_image) {
                Storage::disk('public')->delete($productCategory->hero_image);
            }

            $data['hero_image'] = $request->file('hero_image')->store('product-categories/hero', 'public');
        }

        if ($request->hasFile('icon')) {
            // Delete old icon if exists
            if ($productCategory->icon) {
                Storage::disk('public')->delete($productCategory->icon);
            }

            $iconPath = $request->file('icon')->store('product-categories/icons', 'public');
            $data['icon'] = $iconPath;
        }

        foreach (['brochure', 'technical_brochure'] as $field) {
            if ($request->has('remove_' . $field) && $request->input('remove_' . $field) === '1') {
                if ($productCategory->$field) {
                    Storage::disk('public')->delete($productCategory->$field);
                    $data[$field] = null;
                }
            } elseif ($request->hasFile($field)) {
                if ($productCategory->$field) {
                    Storage::disk('public')->delete($productCategory->$field);
                }
                $file = $request->file($field);
                $filename = Str::slug($request->name) . '-' . $field . '-' . time() . '.' . $file->getClientOriginalExtension();
                $data[$field] = $file->storeAs('product-categories/brochures', $filename, 'public');
            }
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

        if ($productCategory->hero_image) {
            Storage::disk('public')->delete($productCategory->hero_image);
        }

        // Delete the icon if exists
        if ($productCategory->icon) {
            Storage::disk('public')->delete($productCategory->icon);
        }

        foreach (['brochure', 'technical_brochure'] as $field) {
            if ($productCategory->$field) {
                Storage::disk('public')->delete($productCategory->$field);
            }
        }

        $productCategory->delete();

        return redirect()
            ->route('admin.product_categories.index')
            ->with('success', 'Product category deleted successfully.');
    }

    public function sections(ProductCategory $productCategory)
    {
        $overview = $productCategory->productionOverviewSection;
        $applications = $productCategory->productionApplicationSections;
        $features = $productCategory->productionFeaturesSections;
        $faqs = $productCategory->productionFaqSections;

        return view('admin.product_categories.sections', compact('productCategory', 'overview', 'applications', 'features', 'faqs'));
    }

    public function saveOverview(Request $request, ProductCategory $productCategory)
    {
        $request->validate([
            'overview_description' => 'nullable|string',
            'guide_content' => 'nullable|string',
            'overview_images.*' => 'nullable|image|max:5120',
        ]);

        $overview = $productCategory->productionOverviewSection ?? new ProductionOverviewSection();
        $overview->product_category_id = $productCategory->id;
        $overview->overview_description = $request->overview_description;

        $images = array_values($request->input('existing_images', []));
        foreach ($request->file('overview_images', []) as $file) {
            if (count($images) >= 5) {
                break;
            }
            $images[] = $file->store('product-categories/overview', 'public');
        }

        $overview->overview_image = json_encode($images);
        $overview->save();
        $productCategory->update(['guide_content' => $request->guide_content]);

        return redirect()->back()->withFragment('#overview')->with('success', 'Overview section updated successfully.');
    }

    public function saveSeo(Request $request, ProductCategory $productCategory)
    {
        $validated = $request->validate([
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'canonical_url' => 'nullable|string|max:255',
            'robots' => 'nullable|string|max:255',
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string',
            'og_type' => 'nullable|string|max:255',
            'twitter_title' => 'nullable|string|max:255',
            'twitter_description' => 'nullable|string',
            'twitter_card' => 'nullable|string|max:255',
        ]);

        $productCategory->update($validated);

        return redirect()->back()->withFragment('#seo')->with('success', 'Category SEO settings updated successfully.');
    }

    public function saveApplications(Request $request, ProductCategory $productCategory)
    {
        $request->validate([
            'applications.*.title' => 'required|string',
            'applications.*.description' => 'required|string',
            'applications.*.image' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'applications.*.icon' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ]);

        $existingIds = collect($request->applications ?? [])->pluck('id')->filter();
        $productCategory->productionApplicationSections()->whereNotIn('id', $existingIds)->delete();

        foreach ($request->applications ?? [] as $index => $applicationData) {
            $application = isset($applicationData['id'])
                ? $productCategory->productionApplicationSections()->find($applicationData['id'])
                : null;
            $application = $application ?? new ProductionApplicationSection();
            $application->product_category_id = $productCategory->id;
            $application->title = $applicationData['title'];
            $application->description = $applicationData['description'];
            $application->sequence = $index;
            foreach (['image', 'icon'] as $field) {
                if (!empty($applicationData[$field])) {
                    if ($application->$field) {
                        Storage::disk('public')->delete($application->$field);
                    }
                    $application->$field = $applicationData[$field]->store('product-categories/applications', 'public');
                }
            }
            $application->save();
        }

        SiteCache::invalidate();

        return redirect()->back()->withFragment('#applications')->with('success', 'Applications section updated successfully.');
    }

    public function saveFeatures(Request $request, ProductCategory $productCategory)
    {
        $request->validate([
            'features.*.title' => 'nullable|string',
            'features.*.description' => 'nullable|string',
            'features.*.image' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'features.*.icon' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ]);

        $existingIds = collect($request->features ?? [])->pluck('id')->filter();
        $productCategory->productionFeaturesSections()->whereNotIn('id', $existingIds)->delete();

        foreach ($request->features ?? [] as $index => $featureData) {
            $feature = isset($featureData['id'])
                ? $productCategory->productionFeaturesSections()->find($featureData['id'])
                : null;
            $feature = $feature ?? new ProductionFeaturesSection();
            $feature->product_category_id = $productCategory->id;
            $feature->title = $featureData['title'] ?? null;
            $feature->description = $featureData['description'] ?? null;
            $feature->sequence = $index;
            foreach (['image', 'icon'] as $field) {
                if (!empty($featureData[$field])) {
                    if ($feature->$field) {
                        Storage::disk('public')->delete($feature->$field);
                    }
                    $feature->$field = $featureData[$field]->store('product-categories/features', 'public');
                }
            }
            $feature->save();
        }

        SiteCache::invalidate();

        return redirect()->back()->withFragment('#features')->with('success', 'Features section updated successfully.');
    }

    public function saveFaq(Request $request, ProductCategory $productCategory)
    {
        $request->validate([
            'faqs.*.title' => 'required|string',
            'faqs.*.description' => 'required|string',
        ]);

        $existingIds = collect($request->faqs ?? [])->pluck('id')->filter();
        $productCategory->productionFaqSections()->whereNotIn('id', $existingIds)->delete();

        foreach ($request->faqs ?? [] as $index => $faqData) {
            $faq = isset($faqData['id'])
                ? $productCategory->productionFaqSections()->find($faqData['id'])
                : null;
            $faq = $faq ?? new ProductionFaqSection();
            $faq->product_category_id = $productCategory->id;
            $faq->title = $faqData['title'];
            $faq->description = $faqData['description'];
            $faq->sequence = $index;
            $faq->save();
        }

        SiteCache::invalidate();

        return redirect()->back()->withFragment('#faq')->with('success', 'FAQ section updated successfully.');
    }
}
