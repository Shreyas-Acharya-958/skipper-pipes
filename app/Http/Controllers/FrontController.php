<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Product;

use App\Models\Banner;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Models\CertificationSectionOne;
use App\Models\Company;
use App\Models\CsrSectionOne;
use App\Models\CsrSectionThree;
use App\Models\CsrSectionTwo;
use App\Models\ProductCategory;
use App\Models\HomeSectionOne;
use App\Models\HomeSectionTwo;
use App\Models\HomeSectionThree;
use App\Models\HomeSectionFour;
use App\Models\LeadershipSectionFour;
use App\Models\LeadershipSectionOne;
use App\Models\LeadershipSectionThree;
use App\Models\LeadershipSectionTwo;
use App\Models\ManufacturingSectionFour;
use App\Models\ManufacturingSectionOne;
use App\Models\ManufacturingSectionThree;
use App\Models\ManufacturingSectionTwo;
use App\Models\OverviewSectionFive;
use App\Models\OverviewSectionFour;
use App\Models\OverviewSectionOne;
use App\Models\OverviewSectionThree;
use App\Models\OverviewSectionTwo;
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

        // Get featured categories for the static section
        $featuredCategories = ProductCategory::where('status', '1')
            ->take(6)
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

        // Get home page sections
        $sectionOne = HomeSectionOne::with('features')->first();
        $sectionTwo = HomeSectionTwo::first();
        $sectionThree = HomeSectionThree::first();
        $sectionFour = HomeSectionFour::with(['reviews' => function ($query) {
            $query->where('status', 1)->orderBy('sequence');
        }])->first();

        // dd($categories->toArray());
        return view('front.index', compact(
            'categories',
            'banners',
            'blogs',
            'featuredCategories',
            'sectionOne',
            'sectionTwo',
            'sectionThree',
            'sectionFour'
        ));
    }

    public function blogs()
    {
        $blogs = Blog::where('status', 1)->with('category')->paginate(9);
        if (isset($queryParams['tag'])) {
            $blog_id = BlogTag::where('name', $queryParams['tag'])->pluck('blog_id');
            $blogs = Blog::where('status', 1)->whereIn('id', $blog_id)->with('category')->paginate(9);
        }
        if (isset($queryParams['category'])) {
            $blogs = Blog::where('status', 1)->where('cat_id', $queryParams['category'])->with('category')->paginate(9);
        }

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
        $product = Product::where('slug', $slug)->with('productCategory')->firstOrFail();
        return view('front.product-detail', compact('product'));
    }

    public function companyPage($slug)
    {

        $page = Company::where('slug', $slug)
            ->where('status', 1)
            ->where('is_active', 1)
            ->firstOrFail();

        // SEO data
        $seoData = [
            'meta_title' => $page->meta_title ?? $page->title,
            'meta_description' => $page->meta_description,
            'meta_keywords' => $page->meta_keywords,
        ];

        $data = [];

        if ($slug == 'overview') {
            $data['overview_section_ones'] = OverviewSectionOne::get();
            $data['overview_section_twos'] = OverviewSectionTwo::get();
            $data['overview_section_threes'] = OverviewSectionThree::get();
            $data['overview_section_fours'] = OverviewSectionFour::get();
            $data['overview_section_fives'] = OverviewSectionFive::get();
        }
        if ($slug == 'leadership') {
            $data['leadership_section_ones'] = LeadershipSectionOne::get();
            $data['leadership_section_twos'] = LeadershipSectionTwo::get();
            $data['leadership_section_threes'] = LeadershipSectionThree::get();
            $data['leadership_section_fours'] = LeadershipSectionFour::get();
        }
        if ($slug == 'manufacturing') {
            $data['manufacturing_section_ones'] = ManufacturingSectionOne::get();
            $data['manufacturing_section_twos'] = ManufacturingSectionTwo::get();
            $data['manufacturing_section_threes'] = ManufacturingSectionThree::get();
            $data['manufacturing_section_fours'] = ManufacturingSectionFour::get();
        }
        if ($slug == 'csr') {
            $data['csr_section_ones'] = CsrSectionOne::get();
            $data['csr_section_twos'] = CsrSectionTwo::get();
            $data['csr_section_threes'] = CsrSectionThree::get();
        }
        if ($slug == 'certifications') {
            $data['certifications_section_ones'] = CertificationSectionOne::get();
        }
        //leadership

        return view('front.company-page', compact('page', 'seoData', 'data', 'slug'));
    }

    public function showProduct(Product $product)
    {

        // Check if product is active
        if ($product->status != '1') {
            dd('test');
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