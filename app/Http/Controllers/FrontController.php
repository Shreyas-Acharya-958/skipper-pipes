<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Product;
use App\Models\CompanyPage;
use App\Models\Banner;
use App\Models\BlogCategory;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        // Get all active categories with their products
        $categories = ProductCategory::with(['products' => function ($query) {
            $query->where('status', '1');
        }])
            ->where('status', '1')
            ->get();

        // Get banners
        $banners = Banner::where('status', '1')
            ->orderBy('sequence')
            ->get();

        // Get recent blogs
        $blogs = Blog::where('status', '1')
            ->with('category')
            ->latest('published_at')
            ->take(3)
            ->get();

        // dd($categories->toArray());
        return view('front.index', compact('categories', 'banners', 'blogs'));
    }

    public function blogs()
    {
        $blogs = Blog::where('status', 1)->with('categories')->paginate(9);
        return view('front.blogs', compact('blogs'));
    }

    public function blogDetail($slug)
    {
        $blog = Blog::where('slug', $slug)
            ->with(['categories', 'tags', 'comments'])
            ->firstOrFail();

        $recentBlogs = Blog::where('status', 1)
            ->where('id', '!=', $blog->id)
            ->latest()
            ->take(5)
            ->get();

        return view('front.blog-detail', compact('blog', 'recentBlogs'));
    }

    public function products()
    {
        $products = Product::where('status', 1)->paginate(9);
        return view('front.products', compact('products'));
    }

    public function productDetail($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('front.product-detail', compact('product'));
    }

    public function companyPage($slug)
    {
        $page = CompanyPage::where('slug', $slug)->firstOrFail();
        return view('front.company-page', compact('page'));
    }

    public function showProduct(Product $product)
    {
        // Check if product is active
        if ($product->status != '1') {
            abort(404);
        }

        return view('front.product-detail', compact('product'));
    }
}
