<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContentManagementController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'blogs' => \App\Models\Blog::count(),
            'blog_categories' => \App\Models\BlogCategory::count(),
            'products' => \App\Models\Product::count(),
            'product_categories' => \App\Models\ProductCategory::count(),
        ];
        return view('content-management.dashboard', compact('stats'));
    }
}
