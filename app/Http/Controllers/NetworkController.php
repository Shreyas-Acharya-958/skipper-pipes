<?php

namespace App\Http\Controllers;

use App\Models\Network;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\MainNetwork;

class NetworkController extends Controller
{
    public function index(Request $request)
    {
        $networks = Network::orderBy('sequence', 'asc')->get();
        $mainNetwork = \App\Models\MainNetwork::first();
        $activeTab = $request->input('active_tab', '#main-network');
        return view('admin.networks.index', compact('networks', 'mainNetwork', 'activeTab'));
    }

    public function store(Request $request)
    {
        // Handle deleted sections
        if ($request->deleted_sections) {
            foreach ($request->deleted_sections as $id) {
                $section = Network::find($id);
                if ($section) {
                    if ($section->image) {
                        Storage::disk('public')->delete($section->image);
                    }
                    $section->delete();
                }
            }
        }

        // Handle sections data
        foreach ($request->sections as $index => $data) {
            if (isset($data['id']) && $data['id']) {
                $section = Network::find($data['id']);
            } else {
                $section = new Network();
            }

            if (isset($data['image_file']) && $data['image_file']) {
                if ($section->image) {
                    Storage::disk('public')->delete($section->image);
                }
                $section->image = $data['image_file']->store('networks', 'public');
            }

            if (isset($data['remove_image']) && $data['remove_image'] && $section->image) {
                Storage::disk('public')->delete($section->image);
                $section->image = null;
            }

            $section->title = $data['title'];
            $section->description = $data['description'];
            $section->sequence = $index + 1;
            $section->save();
        }

        $activeTab = $request->input('active_tab', '#networks');
        return redirect()->route('admin.networks.index', ['active_tab' => $activeTab])->with('success', 'Network section updated successfully');
    }

    public function destroy($id)
    {
        $section = Network::findOrFail($id);
        if ($section->image) {
            Storage::disk('public')->delete($section->image);
        }
        $section->delete();
        return redirect()->back()->with('success', 'Network item deleted successfully');
    }

    public function showMainNetwork()
    {
        $mainNetwork = MainNetwork::first();
        return view('admin.networks.main', compact('mainNetwork'));
    }

    public function saveMainNetwork(Request $request)
    {

        $mainNetwork = MainNetwork::first() ?? new MainNetwork();

        if ($request->hasFile('image')) {
            if ($mainNetwork->image) {
                Storage::disk('public')->delete($mainNetwork->image);
            }
            $mainNetwork->image = $request->file('image')->store('main_networks', 'public');
        }

        if ($request->has('remove_image') && $request->remove_image && $mainNetwork->image) {
            Storage::disk('public')->delete($mainNetwork->image);
            $mainNetwork->image = null;
        }

        $mainNetwork->title = $request->title;
        $mainNetwork->description = $request->description;
        $mainNetwork->overview = $request->overview;
        $mainNetwork->save();

        $activeTab = $request->input('active_tab', '#main-network');
        return redirect()->route('admin.networks.index', ['active_tab' => $activeTab])->with('success', 'Main Network section updated successfully');
    }
}