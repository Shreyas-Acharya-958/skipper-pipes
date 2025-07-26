<?php

namespace App\Http\Controllers;

use App\Models\ContactUsSection;
use Illuminate\Http\Request;

class ContactUsSectionController extends Controller
{
    public function edit()
    {
        $contactUsSection = ContactUsSection::first() ?? new ContactUsSection();
        return view('admin.contact-us-sections.edit', compact('contactUsSection'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'section1' => 'nullable|string',
            'section2' => 'nullable|string',
            'section3' => 'nullable|string',
            'section4' => 'nullable|string',
        ]);

        $contactUsSection = ContactUsSection::first() ?? new ContactUsSection();
        $contactUsSection->fill($data);
        $contactUsSection->save();

        return redirect()->back()->with('success', 'Contact Us Sections updated successfully!');
    }
}
