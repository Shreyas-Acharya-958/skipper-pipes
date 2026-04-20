<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Models\MenuSeoMetadata;
use Illuminate\Support\Facades\Log;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::tree();
        return view('admin.menus.index', compact('menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'link' => 'nullable|string|max:255',
            'parent_id' => 'nullable|exists:menus,id',
            'sequence' => 'nullable|integer|min:0',
            'status' => 'required|boolean',
            'is_active' => 'required|boolean',
        ]);

        $data = $request->all();
        $data['link'] = $request->input('link') ?: '#';

        Menu::create($data);

        return redirect()->route('admin.menus.index')
            ->with('success', 'Menu created successfully.');
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'link' => 'nullable|string|max:255',
            'parent_id' => 'nullable|exists:menus,id',
            'sequence' => 'nullable|integer|min:0',
            'status' => 'required|boolean',
            'is_active' => 'required|boolean',
        ]);

        $data = $request->all();
        $data['link'] = $request->input('link') ?: '#';

        $menu->update($data);

        return redirect()->route('admin.menus.index')
            ->with('success', 'Menu updated successfully.');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();

        return redirect()->route('admin.menus.index')
            ->with('success', 'Menu deleted successfully.');
    }

    public function updateOrder(Request $request)
    {
        $items = collect($request->input('items', []))
            ->filter(function ($item) {
                return isset($item['id']);
            })
            ->values()
            ->all();

        $request->merge(['items' => $items]);

        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:menus,id',
            'items.*.parent_id' => 'nullable|exists:menus,id',
            'items.*.sequence' => 'required|integer|min:0'
        ]);

        foreach ($request->items as $item) {
            Menu::where('id', $item['id'])->update([
                'parent_id' => $item['parent_id'],
                'sequence' => $item['sequence']
            ]);
        }

        return response()->json(['message' => 'Menu order updated successfully']);
    }

    // Show all menu links with SEO metadata and edit option
    public function seoIndex()
    {
        $menus = Menu::with('seoMetadata')->orderBy('title')->get();

        return view('admin.menus.seo', compact('menus'));
    }

    // Add or update SEO metadata for a menu
    public function seoStore(Request $request)
    {
        try {
            $request->validate([
                'menu_id' => 'required|exists:menus,id',
                'meta_title' => 'nullable|string|max:255',
                'meta_description' => 'nullable|string',
                'meta_keywords' => 'nullable|string|max:255',
            ]);
            $data = [
                'meta_title' => $request->meta_title ?? '',
                'meta_description' => $request->meta_description ?? '',
                'meta_keywords' => $request->meta_keywords ?? '',
                'canonical_url' => $request->canonical_url ?? '',
                'robots' => $request->robots ?? '',

                // OPEN GRAPH
                'og_title' => $request->og_title ?? '',
                'og_description' => $request->og_description ?? '',
                'og_type' => $request->og_type ?? 'website',

                // TWITTER
                'twitter_title' => $request->twitter_title ?? '',
                'twitter_description' => $request->twitter_description ?? '',
                'twitter_card' => $request->twitter_card ?? 'summary_large_image',

                // CUSTOM SCHEMA (override)
                'custom_schema_json' => $request->custom_schema_json ?? null,
            ];

            if ($request->hasFile('og_image')) {
                $data['og_image'] = $request->file('og_image')->store('seo', 'public');
            }

            if ($request->hasFile('twitter_image')) {
                $data['twitter_image'] = $request->file('twitter_image')->store('seo', 'public');
            }
            $generatedSchema = [
                [
                    "@context" => "https://schema.org",
                    "@type" => "WebPage",
                    "name" => $data['meta_title'],
                    "description" => $data['meta_description'],
                    "url" => url()->current(),
                ]
            ];

            $data['schema_json'] = $request->custom_schema_json
                ? $request->custom_schema_json
                : json_encode($generatedSchema, JSON_UNESCAPED_SLASHES);

            MenuSeoMetadata::updateOrCreate(
                ['menu_id' => $request->menu_id],
                $data
            );
            // $first = MenuSeoMetadata::where('menu_id', $request->menu_id)->first();
            // if ($first) {
            //     $first->update($data);
            // } else {
            //     MenuSeoMetadata::create([
            //         'menu_id' => $request->menu_id,
            //     ] + $data);
            // }
            return response()->json(['message' => 'SEO metadata saved successfully']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'error' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('SEO metadata save error: ' . $e->getMessage());
            return response()->json([
                'error' => 'An error occurred while saving SEO metadata. Please try again.'
            ], 500);
        }
    }
}