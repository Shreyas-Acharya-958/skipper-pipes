<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Models\MenuSeoMetadata;

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
        $menus = Menu::orderBy('title')->get();
        $seoMetadata = MenuSeoMetadata::all()->keyBy('menu_id');
        return view('admin.menus.seo', compact('menus', 'seoMetadata'));
    }

    // Add or update SEO metadata for a menu
    public function seoStore(Request $request)
    {

        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string|max:255',
        ]);

        $first = MenuSeoMetadata::where('menu_id', $request->menu_id)->first();
        if ($first) {
            $first->update([
                'meta_title' => $request->meta_title ?? '',
                'meta_description' => $request->meta_description ?? '',
                'meta_keywords' => $request->meta_keywords ?? '',
            ]);
        } else {
            MenuSeoMetadata::create([
                'menu_id' => $request->menu_id,
                'meta_title' => $request->meta_title ?? '',
                'meta_description' => $request->meta_description ?? '',
                'meta_keywords' => $request->meta_keywords ?? '',
            ]);
        }



        return response()->json(['message' => 'SEO metadata saved successfully']);
    }
}