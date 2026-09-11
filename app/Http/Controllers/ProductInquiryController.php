<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductInquiry;

class ProductInquiryController extends Controller
{
    public function index(Request $request)
    {
        $query = ProductInquiry::query();
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', "%{$search}%");
        }
        $inquiries = $query->paginate(10); // 10 per page, change as needed
        return view('admin.inquiries.index', compact('inquiries'));
    }
    public function destroy(ProductInquiry $inquiry)
    {
        $inquiry->delete();

        return redirect()
            ->route('admin.products_inquiries.index')
            ->with('success', 'Inquiry deleted successfully.');
    }
}
