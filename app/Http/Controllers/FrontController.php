<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Product;

use App\Models\Banner;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use App\Models\BlogTag;
use App\Models\Career;
use App\Models\CareerApplication;
use App\Models\CareerLifeAtSkipper;
use App\Models\CareerSkipperPipe;
use App\Models\CareerWhySkipper;
use App\Models\CertificationHeadSection;
use App\Models\CertificationSectionOne;
use App\Models\Company;
use App\Models\Contact;
use App\Models\CsrSectionOne;
use App\Models\CsrSectionThree;
use App\Models\CsrSectionTwo;
use App\Models\FaqList;
use App\Models\FaqMaster;
use App\Models\FaqSectionOne;
use App\Models\FaqSectionTwo;
use App\Models\ProductCategory;
use App\Models\HomeSectionOne;
use App\Models\HomeSectionTwo;
use App\Models\HomeSectionThree;
use App\Models\HomeSectionFour;
use App\Models\LeadershipSectionFour;
use App\Models\LeadershipSectionOne;
use App\Models\LeadershipSectionThree;
use App\Models\LeadershipSectionTwo;
use App\Models\MainNetwork;
use App\Models\ManufacturingSectionFour;
use App\Models\ManufacturingSectionOne;
use App\Models\ManufacturingSectionOnesHead;
use App\Models\ManufacturingSectionThree;
use App\Models\ManufacturingSectionTwo;
use App\Models\OverviewSectionFive;
use App\Models\OverviewSectionFour;
use App\Models\OverviewSectionOne;
use App\Models\OverviewSectionThree;
use App\Models\OverviewSectionTwo;
use Illuminate\Http\Request;
use App\Models\Partner;
use App\Models\PartnerEnquiry;
use App\Models\PartnerSectionOne;
use App\Models\PartnerSectionTwo;
use App\Models\PartnerPipesOffer;
use App\Models\Media;
use App\Models\MediaSectionOne;
use App\Models\MediaSectionTwo;
use App\Models\Network;
use App\Models\News;
use App\Models\Section;
use App\Models\WhySkipperPipe;
use App\Models\WhySkipperPipeSectionFive;
use App\Models\WhySkipperPipeSectionFour;
use App\Models\WhySkipperPipeSectionThree;
use App\Models\WhySkipperPipeSectionTwo;

class FrontController extends Controller
{
    /**
     * Get SEO data for the current URL from menu_seo_metadata table.
     * Fallback to default values if not found.
     */
    private function getSeoDataForCurrentUrl()
    {
        $path = '/' . ltrim(request()->path(), '/');
        // Try to find a menu with this link or slug
        $menu = \App\Models\Menu::where('link', $path)
            ->orWhere('slug', trim($path, '/'))
            ->first();
        if ($menu) {
            $seo = \App\Models\MenuSeoMetadata::where('menu_id', $menu->id)->first();
            if ($seo) {
                return [
                    'meta_title' => $seo->meta_title,
                    'meta_description' => $seo->meta_description,
                    'meta_keywords' => $seo->meta_keywords,
                    'meta_author' => 'Skipper Pipes',
                ];
            }
        }
        // Fallback default
        return [
            'meta_title' => 'Skipper Pipes',
            'meta_description' => 'Discover high-quality pipes and fittings from Skipper Pipes.',
            'meta_keywords' => 'pipes, plumbing, fittings, skipper pipes, manufacturing',
            'meta_author' => 'Skipper Pipes',
        ];
    }

    public function index()
    {
        $seoData = $this->getSeoDataForCurrentUrl();

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
        // dd($sectionFour->toArray());
        // dd($categories->toArray());
        return view('front.index', compact(
            'categories',
            'banners',
            'blogs',
            'featuredCategories',
            'sectionOne',
            'sectionTwo',
            'sectionThree',
            'sectionFour',
            'seoData'
        ));
    }

    public function blogs()
    {
        $seoData = $this->getSeoDataForCurrentUrl();

        $blogs = Blog::where('status', 1)->with('category')->paginate(9);
        if (isset($queryParams['tag'])) {
            $blog_id = BlogTag::where('name', $queryParams['tag'])->pluck('blog_id');
            $blogs = Blog::where('status', 1)->whereIn('id', $blog_id)->with('category')->paginate(9);
        }
        if (isset($queryParams['category'])) {
            $blogs = Blog::where('status', 1)->where('cat_id', $queryParams['category'])->with('category')->paginate(9);
        }

        return view('front.blogs', compact('blogs', 'seoData'));
    }

    public function blogDetail($slug)
    {
        $blog = Blog::where('slug', $slug)
            ->with(['category.blogs', 'tags', 'comments' => function ($query) {
                $query->where('status', 1);
            }])
            ->where('status', 1)
            ->firstOrFail();

        // SEO data
        $seoData = [
            'meta_title' => $blog->meta_title ?? $blog->title . ' | Skipper Pipes Blog',
            'meta_description' => $blog->meta_description ?? substr(strip_tags($blog->content), 0, 160),
            'meta_keywords' => $blog->meta_keywords ?? implode(', ', $blog->tags->pluck('name')->toArray()),
            'meta_author' => $blog->author ?? 'Skipper Pipes'
        ];

        $recentBlogs = Blog::where('status', 1)
            ->where('id', '!=', $blog->id)
            ->latest()
            ->take(5)
            ->get();


        $categories = BlogCategory::withCount('blogs')
            ->where('status', 1)
            ->get();

        return view('front.blog-detail', compact('blog', 'recentBlogs', 'categories', 'seoData'));
    }

    public function products()
    {
        $seoData = $this->getSeoDataForCurrentUrl();
        $products = Product::where('status', 1)->paginate(9);
        return view('front.products', compact('products', 'seoData'));
    }

    public function productDetail($slug)
    {
        $seoData = $this->getSeoDataForCurrentUrl();
        $product = Product::where('slug', $slug)->with('productCategory')->firstOrFail();

        // SEO data
        $seoData = [
            'meta_title' => $product->meta_title ?? $product->name . ' | Skipper Pipes Products',
            'meta_description' => $product->meta_description ?? substr(strip_tags($product->description), 0, 160),
            'meta_keywords' => $product->meta_keywords ?? $product->name . ', ' . $product->productCategory->name . ', skipper pipes',
            'meta_author' => 'Skipper Pipes'
        ];

        return view('front.product-detail', compact('product', 'seoData'));
    }

    public function companyPage($slug)
    {
        $seoData = $this->getSeoDataForCurrentUrl();

        $page = Company::where('slug', $slug)
            ->where('status', 1)
            ->where('is_active', 1)
            ->firstOrFail();



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

            $data['manufacturing_section_ones_head'] = ManufacturingSectionOnesHead::first();
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
            $data['certifications_section_head'] = CertificationHeadSection::first();
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

    public function storeBlogComment(Request $request, Blog $blog)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'content' => 'required|string'
        ]);

        $blog->comments()->create([
            'name' => $request->name,
            'email' => $request->email,
            'description' => $request->content,
            'status' => 0,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Thank you! Your comment has been submitted successfully and is pending approval.'
        ]);
    }

    public function partner($slug)
    {
        $seoData = $this->getSeoDataForCurrentUrl();

        // First get the partner ID
        $partner = Partner::where('slug', $slug)
            ->where('status', 1)
            ->first();

        // Now get the related data using the partner_id
        $sectionOne = PartnerSectionOne::where('partner_id', $partner->id)->first();
        $sectionTwo = PartnerSectionTwo::where('partner_id', $partner->id)->first();
        $pipesOffers = PartnerPipesOffer::where('partner_id', $partner->id)->get();

        // Attach the relations manually
        $partner->setRelation('sectionOne', $sectionOne);
        $partner->setRelation('sectionTwo', $sectionTwo);
        $partner->setRelation('pipesOffers', $pipesOffers);

        // Update SEO data with partner specific info
        $seoData['meta_title'] = $partner->meta_title ?? $partner->title . ' | Skipper Pipes';
        $seoData['meta_description'] = $partner->meta_description ?? substr(strip_tags($partner->description), 0, 160);
        $seoData['meta_keywords'] = $partner->meta_keywords ?? $partner->title . ', partner, skipper pipes';

        return view('front.partner', compact('seoData', 'partner'));
    }

    public function storePartnerEnquiry(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:20',
            'firm_name' => 'nullable|string|max:255',
            'gst' => 'nullable|string|max:50',
            'pincode' => 'required|string|max:10',
            'occupation' => 'required|string|max:255',
            'experience' => 'nullable|string|max:50',
            'dealership_type' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'partner_id' => 'nullable|integer' // ✅ Not just a number
        ]);


        PartnerEnquiry::create($request->all()); // Adjust model if needed

        return response()->json([
            'success' => true,
            'message' => 'Thank you! We will contact you shortly.'
        ]);
    }




    public function faqs()
    {
        $seoData = $this->getSeoDataForCurrentUrl();
        //faq_masters,faq_lists

        $faq_masters = FaqMaster::where('status', 1)->get();
        $faq_lists = FaqList::where('status', 1)->get();
        $faqSectionOne = FaqSectionOne::first();
        $faqSectionTwo = FaqSectionTwo::first();


        return view('front.resources.faqs', compact('faq_masters', 'faq_lists', 'seoData', 'faqSectionOne', 'faqSectionTwo'));
    }

    public function news()
    {
        $seoData = $this->getSeoDataForCurrentUrl();
        $news = News::all();
        return view('front.resources.news', compact('news', 'seoData'));
    }

    public function media()
    {
        $seoData = $this->getSeoDataForCurrentUrl();
        $media = Media::all()->groupBy('media_type');
        $mediaSectionOne = MediaSectionOne::first();
        $mediaSectionTwo = MediaSectionTwo::first();

        return view('front.resources.media', compact('media', 'seoData', 'mediaSectionOne', 'mediaSectionTwo'));
    }

    public function whySkipperPipes()
    {
        $seoData = $this->getSeoDataForCurrentUrl();

        $whySkipperPipes = WhySkipperPipe::first();


        $why_skipper_pipe_section_fives = WhySkipperPipeSectionFive::first();
        $why_skipper_pipe_section_fours = WhySkipperPipeSectionFour::get();
        $whySkipperPipesSectionThrees = WhySkipperPipeSectionThree::first();
        $why_skipper_pipe_section_twos = WhySkipperPipeSectionTwo::get();

        return view('front.why-skipper-pipes', compact('whySkipperPipes', 'why_skipper_pipe_section_fives', 'why_skipper_pipe_section_fours', 'whySkipperPipesSectionThrees', 'why_skipper_pipe_section_twos', 'seoData'));
    }

    public function contact()
    {
        $seoData = $this->getSeoDataForCurrentUrl();
        return view('front.contact', compact('seoData'));
    }

    public function storeContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'required|string'

        ]);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
            'subject' => $request->subject ?? '',
            'status' => 1,
        ];

        Contact::create($data);

        // Return JSON response for AJAX
        return response()->json([
            'success' => true,
            'message' => 'Thank you! We will contact you shortly.'
        ]);
    }
    public function careers()
    {
        $seoData = $this->getSeoDataForCurrentUrl();
        /*  careers
  	career_life_at_skippers
		career_skipper_pipes
			career_why_skippers*/
        $careers = Career::first();
        $career_life_at_skippers = CareerLifeAtSkipper::get();
        $career_skipper_pipes = CareerSkipperPipe::get();
        $career_why_skippers = CareerWhySkipper::first();

        return view('front.resources.careers', compact('career_life_at_skippers', 'career_skipper_pipes', 'career_why_skippers', 'careers', 'seoData'));
    }


    public function storeCareerApplication(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'subject' => 'nullable|string|max:255',
            'phone' => 'required|string|max:20',
            'dob' => 'nullable|date',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'address' => 'nullable|string'
        ]);

        // Store resume file
        $path = $request->file('resume')->store('resumes', 'public');

        $validated['resume_path'] = $path;

        CareerApplication::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Thank you! Your application has been submitted.'
        ]);
    }

    public function network()
    {
        $seoData = $this->getSeoDataForCurrentUrl();
        $mainNetwork = MainNetwork::first();
        $networks = Network::orderBy('sequence', 'asc')->get();
        return view('front.resources.network', compact('mainNetwork', 'networks', 'seoData'));
    }

    public function section($slug = null)
    {
        $seoData = $this->getSeoDataForCurrentUrl();
        // If no slug, you can show a default page or redirect
        if (!$slug) {
            return redirect()->route('home'); // or any default
        }

        // Example: Fetch from a 'company_pages' table
        $page = Section::where('slug', $slug)->first();

        if (!$page) {
            abort(404); // Or show a custom 404 page
        }

        // Pass the page data to a generic section view
        return view('front.section', compact('page', 'seoData'));
    }
}