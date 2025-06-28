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
        $blogs = Blog::where('status', 1)->with('category')->paginate(9);
        return view('front.blogs', compact('blogs'));
    }

    public function blogDetail($slug)
    {
        $blog = Blog::where('slug', $slug)
            ->with(['category.blogs', 'tags', 'comments'])
            ->firstOrFail();

        $recentBlogs = Blog::where('status', 1)
            ->where('id', '!=', $blog->id)
            ->latest()
            ->take(5)
            ->get();

        $categories = BlogCategory::withCount('blogs')
            ->where('status', 1)
            ->get();

        return view('front.blog-detail', compact('blog', 'recentBlogs', 'categories'));
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
        $page = CompanyPage::where('slug', $slug)
            ->where('status', 1)
            ->where('is_active', 1)
            ->firstOrFail();

        // SEO data
        $seoData = [
            'meta_title' => $page->meta_title ?? $page->title,
            'meta_description' => $page->meta_description,
            'meta_keywords' => $page->meta_keywords,
        ];

        // Timeline events data
        $timelineEvents = [
            [
                'year' => '2009',
                'title' => 'Laid the Foundation for Growth',
                'description' => 'Launched first <b>PVC unit in Uluberia, Kolkata</b> —our beginning in piping solutions.'
            ],
            [
                'year' => '2015',
                'title' => 'Global Collaboration for Excellence',
                'description' => 'Strategic partnership with <b>Sekisui Chemical Co., Japan,</b> enhancing product innovation and excellence.'
            ],
            [
                'year' => '2016',
                'title' => 'Recognized for National Impact',
                'description' => 'Awarded <b>"Best in Water Resources" by CBIP,</b> affirming infrastructure excellence and trust.'
            ],
            [
                'year' => '2017',
                'title' => 'Expanding Horizons in the Northeast',
                'description' => '<b>Guwahati facility</b> started; over <b>10,000 youth trained</b> under NSDC plumbing initiative.'
            ],
            [
                'year' => '2020',
                'title' => 'Ventured into Premium Bath Fittings',
                'description' => 'Launched <b>Skipper CP Bath Fittings,</b> bringing precision and elegance to everyday hygiene solutions.'
            ],
            [
                'year' => '2021',
                'title' => 'Strengthening Core Product Lines',
                'description' => 'Relaunched advanced HDPE pipes for stronger, safer industrial and agricultural performance.'
            ],
            [
                'year' => '2025',
                'title' => 'Building a Community of Plumbers',
                'description' => 'Initiated the <b>Skipper Saathi Program,</b> a nationwide platform to connect, support, and upskill plumbers.'
            ]
        ];

        // Statistics data
        $statistics = [
            [
                'value' => 5,
                'label' => 'Manufacturing Units'
            ],
            [
                'value' => 100,
                'label' => 'Warehouse Hubs'
            ],
            [
                'value' => 25000,
                'label' => 'Dealers & Distributors'
            ],
            [
                'value' => 100000,
                'label' => 'Plumber Partners'
            ]
        ];

        return view('front.company-page', compact('page', 'seoData', 'timelineEvents', 'statistics'));
    }

    public function showProduct(Product $product)
    {
        // Check if product is active
        if ($product->status != '1') {
            abort(404);
        }

        return view('front.product-detail', compact('product'));
    }

    public function storeComment(Request $request, Blog $blog)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'content' => 'required|string'
        ]);

        $blog->comments()->create([
            'name' => $request->name,
            'email' => $request->email,
            'content' => $request->content
        ]);

        return back()->with('success', 'Comment posted successfully!');
    }
}
