<?php

namespace App\Http\Controllers;

use App\Models\Footer;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function edit()
    {
        $footer = Footer::first() ?? new Footer();
        return view('admin.footer.edit', compact('footer'));
    }

    public function update(Request $request)
    {

        $data = $request->validate([
            'section1' => 'nullable|string',
            'section2' => 'nullable|string',
            'section3' => 'nullable|string',
            'section4' => 'nullable|string',
        ]);
        $footer = Footer::first() ?? new Footer();
        $footer->fill($data);
        $footer->save();

        return redirect()->back()->with('success', 'Footer updated successfully!');
    }
}
