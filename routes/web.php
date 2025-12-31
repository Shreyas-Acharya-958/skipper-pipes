<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\BlogCommentController;
use App\Http\Controllers\CompanyPageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CsrController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OverviewController;
use App\Http\Controllers\LeadershipController;
use App\Http\Controllers\ManufacturingController;
use App\Http\Controllers\CertificationController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\WhySkipperPipeController;
use App\Http\Controllers\JalRakshakController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\FaqMasterController;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\ContactUsSectionController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\SectionController;


// 301 Redirects
Route::permanentRedirect('/plumbing-is-an-import', '/blogs/a-useful-guide-on-plumbing-pipe-size-calculation');
Route::permanentRedirect('/4-uses-of-pvc-pipes/', '/blogs/6-top-benefits-of-pvc-pipes-every-plumber-should-know');
Route::permanentRedirect('/4-uses-of-pvc-pipes-keywords-pvc-pipe-suppliers-agriculture-pipes-and-fittings-500words/', '/blogs/6-top-benefits-of-pvc-pipes-every-plumber-should-know');
Route::permanentRedirect('/5-ways-skipper-cpvc-pipes-have-an-edge-over-other-industry-players/', '/blogs/what-makes-skipper-pipes-the-best-cpvc-pipes-in-india');
Route::permanentRedirect('/6-top-benefits-of-pvc-pipes-every-plumber-should-know/', '/blogs/6-top-benefits-of-pvc-pipes-every-plumber-should-know');
Route::permanentRedirect('/awards-certificates/', '/company/certifications');
Route::permanentRedirect('/benefits-of-using-pvc-over-other-materials/', '/blogs/pvc-pipe-vs-other-materials-pros-and-cons-simplified');
Route::permanentRedirect('/benefits-of-using-pvc-pipes/', '/blogs/the-future-of-plumbing-why-cpvc-pipes-are-becoming-the-industry-standard');
Route::permanentRedirect('/best-plumbing-pipe-in-india/', '/blogs/a-useful-guide-on-plumbing-pipe-size-calculation');
Route::permanentRedirect('/durastream-technology-the-tech-behind-robustness-of-cpvc-pipes/', '/blogs/the-future-of-plumbing-why-cpvc-pipes-are-becoming-the-industry-standard');
Route::permanentRedirect('/exploring-the-various-types-of-plumbing-fittings/', '/blogs/innovation-in-plumbing-the-future-of-pipe-systems');
Route::permanentRedirect('/exploring-the-various-types-of-plumbing-pipes-and-fittings/', '/blogs/innovation-in-plumbing-the-future-of-pipe-systems');
Route::permanentRedirect('/factors-that-make-cpvc-pipes-ideal-for-residential-plumbing/', '/blogs/the-future-of-plumbing-why-cpvc-pipes-are-becoming-the-industry-standard');
Route::permanentRedirect('/factors-to-consider-when-choosing-bathroom-fittings/', '/blogs/the-future-of-plumbing-why-cpvc-pipes-are-becoming-the-industry-standard');
Route::permanentRedirect('/facts-about-upvc-pipes-that-you-should-know/', '/blogs/what-are-the-main-advantages-of-using-upvc-pipes-in-2024');
Route::permanentRedirect('/facts-about-upvc-pipes-that-you-should-know//1000', '/blogs/what-are-the-main-advantages-of-using-upvc-pipes-in-2024');
Route::permanentRedirect('/facts-about-upvc-pipes-that-you-should-know/1000', '/blogs/what-are-the-main-advantages-of-using-upvc-pipes-in-2024');
Route::permanentRedirect('/features-and-benefits-of-hdpe-pipes/', '/blogs/why-are-hdpe-pipes-so-versatile-know-the-features-benefits');
Route::permanentRedirect('/heres-what-you-need-to-know-before-choosing-a-plumbing-contractor/', '/blogs/innovation-in-plumbing-the-future-of-pipe-systems');
Route::permanentRedirect('/home-buyers-guide-to-complete-residential-plumbing-solutions/', '/blogs/innovation-in-plumbing-the-future-of-pipe-systems');
Route::permanentRedirect('/how-is-skipper-pipes-helping-housing-complexes-in-water-transportation/', '/blogs/flagbearers-of-safe-water-skipper-pipes-leading-the-way');
Route::permanentRedirect('/how-to-choose-the-right-pipe-for-plumbing-applications/', '/blogs/innovation-in-plumbing-the-future-of-pipe-systems');
Route::permanentRedirect('/how-to-choose-the-right-pipe-for-plumbing-applications//1000', '/blogs/innovation-in-plumbing-the-future-of-pipe-systems');
Route::permanentRedirect('/how-to-choose-the-right-plumbing-pipes/', '/blogs/innovation-in-plumbing-the-future-of-pipe-systems');
Route::permanentRedirect('/how-to-perform-easy-diy-plumbing-pipe-fixes-at-home/', '/blogs/how-to-perform-easy-diy-plumbing-pipe-fixes-at-home');
Route::permanentRedirect('/innovation-in-piping-the-rise-of-smart-plumbing-systems/', '/blogs/innovation-in-plumbing-the-future-of-pipe-systems');
Route::permanentRedirect('/know-the-differences-between-piping-systems/', '/blogs/innovation-in-plumbing-the-future-of-pipe-systems');
Route::permanentRedirect('/know-the-differences-between-piping-systems//1000', '/blogs/innovation-in-plumbing-the-future-of-pipe-systems');
Route::permanentRedirect('/know-the-differences-between-piping-systems/1000', '/blogs/innovation-in-plumbing-the-future-of-pipe-systems');
Route::permanentRedirect('/main-advantages-of-using-upvc-pipes-in-2024/', '/blogs/what-are-the-main-advantages-of-using-upvc-pipes-in-2024');
Route::permanentRedirect('/pvc-pipes-manufacturer-in-india/', '/blogs/6-top-benefits-of-pvc-pipes-every-plumber-should-know');
Route::permanentRedirect('/pvc-pipes-vs-other-materials-pros-and-cons-simplified/', '/blogs/6-top-benefits-of-pvc-pipes-every-plumber-should-know');
Route::permanentRedirect('/the-various-uses-of-cpvc-pipes-in-construction-plumbing-industry/', '/blogs/innovation-in-plumbing-the-future-of-pipe-systems');
Route::permanentRedirect('/top-6-advantage-and-applications-of-cpvc-pipes/', '/blogs/what-makes-skipper-pipes-the-best-cpvc-pipes-in-india');
Route::permanentRedirect('/top-7-advantages-of-using-skipper-upvc-pipes-over-metal-pipes/', '/blogs/what-are-the-main-advantages-of-using-upvc-pipes-in-2024');
Route::permanentRedirect('/top-benefits-and-applications-of-swr-pipes-and-fittings/', '/blogs/the-top-benefits-and-applications-of-swr-pipes-and-fittings');

// ----------------------------------------------------------------------

Route::get('/', function () {
    return view('welcome');
});



// Admin authentication routes (no middleware)

Route::get('admin/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::prefix('admin')->name('admin.')->group(function () {

    Route::post('login', [AuthController::class, 'login'])->name('login.post');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});


// Admin routes (with auth middleware - all roles can access, but middleware will control specific routes)
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::redirect('/', '/admin/dashboard'); // Redirect /admin to /admin/dashboard
    Route::post('/admin/dashboard/delete-inquiry', [\App\Http\Controllers\DashboardController::class, 'deleteInquiry'])->name('dashboard.delete-inquiry');

    // Dashboard export routes
    Route::get('/dashboard/export/career-applications', [\App\Http\Controllers\DashboardController::class, 'exportCareerApplications'])->name('dashboard.export.career');
    Route::get('/dashboard/export/contacts', [\App\Http\Controllers\DashboardController::class, 'exportContacts'])->name('dashboard.export.contacts');
    Route::get('/dashboard/export/dealer-enquiries', [\App\Http\Controllers\DashboardController::class, 'exportDealerEnquiries'])->name('dashboard.export.dealer');
    Route::get('/dashboard/export/distributor-enquiries', [\App\Http\Controllers\DashboardController::class, 'exportDistributorEnquiries'])->name('dashboard.export.distributor');
    Route::get('/dashboard/export/blog-comments', [\App\Http\Controllers\DashboardController::class, 'exportBlogComments'])->name('dashboard.export.blog-comments');
    Route::get('/dashboard/export/jal-rakshak-submissions', [\App\Http\Controllers\DashboardController::class, 'exportJalRakshakSubmissions'])->name('dashboard.export.jal-rakshak');
    Route::get('/dashboard/export/private-project-enquiries', [\App\Http\Controllers\DashboardController::class, 'exportPrivateProjectEnquiries'])->name('dashboard.export.private-project');

    // User Management routes
    Route::resource('users', UserController::class);

    // Partner routes
    Route::resource('partners', PartnerController::class)->names('partners');
    Route::get('partners-section/{partner}', [PartnerController::class, 'sections'])->name('partners.sections');
    Route::post('partners-section/{partner}/section-one', [PartnerController::class, 'saveSectionOne'])->name('partners.sections.one.save');
    Route::post('partners-section/{partner}/section-one/delete-image', [PartnerController::class, 'deleteImage'])->name('partners.sections.one.delete-image');
    Route::post('partners-section/{partner}/section-two', [PartnerController::class, 'saveSectionTwo'])->name('partners.sections.two.save');
    Route::post('partners-section/{partner}/pipes-offers', [PartnerController::class, 'savePipesOffers'])->name('partners.sections.pipes-offers.save');
    Route::delete('partners-section/{partner}/pipes-offers/{offer}', [PartnerController::class, 'deletePipesOffer'])->name('partners.sections.pipes-offers.delete');

    // Blog routes
    Route::resource('blogs', BlogController::class)->names('blogs');
    Route::get('blogs/sequence/list', [BlogController::class, 'sequenceList'])->name('blogs.sequence.list');
    Route::post('blogs/update-sequence', [BlogController::class, 'updateSequence'])->name('blogs.update-sequence');

    Route::post('/blogs/section1/save', [BlogController::class, 'saveSectionOne'])->name('blog.section1.save');
    Route::post('/blogs/section2/save', [BlogController::class, 'saveSectionTwo'])->name('blog.section2.save');

    // Company routes
    Route::resource('company', CompanyController::class)->names('company');

    // Product routes
    Route::resource('products', ProductController::class)->names('products');
    Route::get('products-section/{product}', [ProductController::class, 'sections'])->name('products.sections');
    Route::post('products-section/{product}/overview', [ProductController::class, 'saveOverview'])->name('products.sections.overview.save');
    Route::post('products-section/{product}/applications', [ProductController::class, 'saveApplications'])->name('products.sections.applications.save');
    Route::post('products-section/{product}/features', [ProductController::class, 'saveFeatures'])->name('products.sections.features.save');
    Route::post('products-section/{product}/faq', [ProductController::class, 'saveFaq'])->name('products.sections.faq.save');

    // Product Category routes
    Route::resource('product-categories', ProductCategoryController::class)->names('product_categories');

    // Blog Category routes
    Route::resource('blog-categories', BlogCategoryController::class)->names('blog_categories');

    // Blog Comment routes
    Route::resource('blog-comments', BlogCommentController::class)->names('blog_comments');
    Route::post('blog-comments/{blogComment}/approve', [BlogCommentController::class, 'approve'])->name('blog_comments.approve');

    // Company Page routes
    // Route::resource('company-pages', CompanyPageController::class)->names('company_pages');

    Route::post('company-pages/{id}/update', [CompanyPageController::class, 'update'])->name('company_pages.update');
    Route::get('company-pages', [CompanyPageController::class, 'index'])->name('company_pages.index');
    Route::get('company-pages/{company_page}', [CompanyPageController::class, 'show'])->name('company_pages.show');
    Route::post('company-pages', [CompanyPageController::class, 'store'])->name('company_pages.store');
    Route::delete('company-pages/{company_page}', [CompanyPageController::class, 'destroy'])->name('company_pages.destroy');
    Route::get('company-pages/{company_page}/edit', [CompanyPageController::class, 'edit'])->name('company_pages.edit');

    // Contact routes
    Route::resource('contacts', ContactController::class)->names('contacts');

    // Menu Management Routes
    Route::resource('menus', MenuController::class);
    Route::post('menus/update-order', [MenuController::class, 'updateOrder'])->name('menus.update-order');

    // Banner routes
    Route::resource('banners', BannerController::class);

    // Media routes
    Route::resource('media', MediaController::class)->parameters(['media' => 'media']);
    Route::get('media/sequence/list', [MediaController::class, 'sequenceList'])->name('media.sequence.list');
    Route::post('media/update-sequence', [MediaController::class, 'updateSequence'])->name('media.update-sequence');
    Route::post('/media/section1/save', [MediaController::class, 'saveSectionOne'])->name('media.section1.save');
    Route::post('/media/section2/save', [MediaController::class, 'saveSectionTwo'])->name('media.section2.save');

    // Image Alt Text Management routes
    Route::get('image-alt-texts', [\App\Http\Controllers\Admin\ImageAltTextController::class, 'index'])->name('image-alt-texts.index');
    Route::put('image-alt-texts/update-batch', [\App\Http\Controllers\Admin\ImageAltTextController::class, 'updateBatch'])->name('image-alt-texts.update-batch');
    Route::put('image-alt-texts/{imageAltText}', [\App\Http\Controllers\Admin\ImageAltTextController::class, 'update'])->name('image-alt-texts.update');
    Route::post('image-alt-texts/scan', [\App\Http\Controllers\Admin\ImageAltTextController::class, 'scan'])->name('image-alt-texts.scan');
    Route::get('image-alt-texts/{imageAltText}', [\App\Http\Controllers\Admin\ImageAltTextController::class, 'show'])->name('image-alt-texts.show');



    // Home Page Management
    Route::get('home-page', [HomePageController::class, 'index'])->name('home-page.index');
    Route::post('home-page/section1', [HomePageController::class, 'saveSection1'])->name('home-page.section1.save');
    Route::post('home-page/section2', [HomePageController::class, 'saveSection2'])->name('home-page.section2.save');
    Route::post('home-page/section3', [HomePageController::class, 'saveSection3'])->name('home-page.section3.save');
    Route::post('home-page/section4', [HomePageController::class, 'saveSection4'])->name('home-page.section4.save');
    Route::post('home-page/add-review', [HomePageController::class, 'addReview'])->name('home-page.add-review');

    // Overview Page Management
    Route::get('/company-pages/overview/sections', [OverviewController::class, 'sections'])->name('overview.sections');
    Route::post('/company-pages/overview/section1/save', [OverviewController::class, 'saveSectionOne'])->name('overview.section1.save');
    Route::post('/company-pages/overview/section2/save', [OverviewController::class, 'saveSectionTwo'])->name('overview.section2.save');
    Route::post('/company-pages/overview/section3/save', [OverviewController::class, 'saveSectionThree'])->name('overview.section3.save');
    Route::post('/company-pages/overview/section4/save', [OverviewController::class, 'saveSectionFour'])->name('overview.section4.save');
    Route::post('/company-pages/overview/section5/save', [OverviewController::class, 'saveSectionFive'])->name('overview.section5.save');
    Route::post('/admin/overview/left-image', [App\Http\Controllers\OverviewController::class, 'saveLeftImage'])->name('overview.left_image.save');

    // Leadership Page Management
    Route::get('/company-pages/leadership/sections', [LeadershipController::class, 'sections'])->name('leadership.sections');
    Route::post('/company-pages/leadership/section1/save', [LeadershipController::class, 'saveSectionOne'])->name('leadership.section1.save');
    Route::post('/company-pages/leadership/section2/save', [LeadershipController::class, 'saveSectionTwo'])->name('leadership.section2.save');
    Route::post('/company-pages/leadership/section3/save', [LeadershipController::class, 'saveSectionThree'])->name('leadership.section3.save');
    Route::post('/company-pages/leadership/section4/save', [LeadershipController::class, 'saveSectionFour'])->name('leadership.section4.save');

    Route::get('/company-pages/csr/sections', [CsrController::class, 'sections'])->name('csr.sections');
    Route::post('/company-pages/csr/section1/save', [CsrController::class, 'saveSectionOne'])->name('csr.section1.save');
    Route::post('/company-pages/csr/section2/save', [CsrController::class, 'saveSectionTwo'])->name('csr.section2.save');
    Route::post('/company-pages/csr/section3/save', [CsrController::class, 'saveSectionThree'])->name('csr.section3.save');
    Route::delete('/company-pages/csr/section3/delete', [CsrController::class, 'deleteSectionThree'])->name('csr.section3.delete');

    // manufacturing
    Route::get('/company-pages/manufacturing/sections', [ManufacturingController::class, 'sections'])->name('manufacturing.sections');
    Route::post('/company-pages/manufacturing/section1/save', [ManufacturingController::class, 'saveSectionOne'])->name('manufacturing.section1.save');
    Route::post('/company-pages/manufacturing/section2/save', [ManufacturingController::class, 'saveSectionTwo'])->name('manufacturing.section2.save');
    Route::post('/company-pages/manufacturing/section3/save', [ManufacturingController::class, 'saveSectionThree'])->name('manufacturing.section3.save');
    Route::post('/company-pages/manufacturing/section4/save', [ManufacturingController::class, 'saveSectionFour'])->name('manufacturing.section4.save');
    Route::post('/company-pages/manufacturing/head/save', [ManufacturingController::class, 'saveHeadSection'])->name('manufacturing.head.save');

    //Certifications
    Route::get('/company-pages/certifications/sections', [CertificationController::class, 'sections'])->name('certifications.sections');
    Route::post('/company-pages/certifications/section1/save', [CertificationController::class, 'saveSectionOne'])->name('certifications.section1.save');
    Route::delete('/company-pages/certifications/section1/delete', [CertificationController::class, 'delete'])->name('certifications.section1.delete');
    Route::post('/company-pages/certifications/head/save', [CertificationController::class, 'saveHeadSection'])->name('certifications.head.save');

    //
    Route::get('why-skipper-pipes', [WhySkipperPipeController::class, 'index'])->name('why-skipper-pipes.index');
    Route::post('why-skipper-pipes/main/save', [WhySkipperPipeController::class, 'saveMain'])->name('why-skipper-pipes.main.save');
    Route::post('why-skipper-pipes/section3/save', [WhySkipperPipeController::class, 'saveSection3'])->name('why-skipper-pipes.section3.save');
    Route::post('why-skipper-pipes/section4/save', [WhySkipperPipeController::class, 'saveSection4'])->name('why-skipper-pipes.section4.save');
    Route::post('why-skipper-pipes/section5/save', [WhySkipperPipeController::class, 'saveSection5'])->name('why-skipper-pipes.section5.save');
    Route::post('why-skipper-pipes/built-for-condition/save', [WhySkipperPipeController::class, 'saveBuiltForCondition'])->name('why-skipper-pipes.built-for-condition.save');

    // Jal Rakshak Routes
    Route::get('jal-rakshak', [JalRakshakController::class, 'index'])->name('jal-rakshak.index');
    Route::post('jal-rakshak/menus/save', [JalRakshakController::class, 'saveMenus'])->name('jal-rakshak.menus.save');
    Route::post('jal-rakshak/banners/save', [JalRakshakController::class, 'saveBanners'])->name('jal-rakshak.banners.save');
    Route::post('jal-rakshak/initiative/save', [JalRakshakController::class, 'saveInitiative'])->name('jal-rakshak.initiative.save');
    Route::post('jal-rakshak/activities/save', [JalRakshakController::class, 'saveActivities'])->name('jal-rakshak.activities.save');
    Route::post('jal-rakshak/gallery/save', [JalRakshakController::class, 'saveGallery'])->name('jal-rakshak.gallery.save');
    Route::post('jal-rakshak/categories/save', [JalRakshakController::class, 'saveCategory'])->name('jal-rakshak.categories.save');
    Route::post('jal-rakshak/categories/delete', [JalRakshakController::class, 'deleteCategory'])->name('jal-rakshak.categories.delete');
    Route::post('jal-rakshak/videos/save', [JalRakshakController::class, 'saveVideos'])->name('jal-rakshak.videos.save');
    Route::post('jal-rakshak/videos/upload-chunk', [JalRakshakController::class, 'uploadVideoChunk'])->name('jal-rakshak.videos.upload-chunk');
    Route::delete('jal-rakshak/videos/delete/{id}', [JalRakshakController::class, 'deleteVideo'])->name('jal-rakshak.videos.delete');
    Route::post('jal-rakshak/conservations/save', [JalRakshakController::class, 'saveConservations'])->name('jal-rakshak.conservations.save');
    Route::post('jal-rakshak/involvement/save', [JalRakshakController::class, 'saveInvolvement'])->name('jal-rakshak.involvement.save');
    Route::post('jal-rakshak/seo/save', [JalRakshakController::class, 'saveSeo'])->name('jal-rakshak.seo.save');

    // Career Routes
    Route::get('careers', [CareerController::class, 'index'])->name('careers.index');
    Route::post('careers/main/save', [CareerController::class, 'saveMain'])->name('careers.main.save');
    Route::post('careers/why-skipper/save', [CareerController::class, 'saveWhySkipper'])->name('careers.why-skipper.save');
    Route::post('careers/life-at-skipper/save', [CareerController::class, 'saveLifeAtSkipper'])->name('careers.life-at-skipper.save');
    Route::post('careers/skipper-pipes/save', [CareerController::class, 'saveSkipperPipes'])->name('careers.skipper-pipes.save');

    //Faq
    Route::resource('faq-masters', FaqMasterController::class)->names('faq_masters');


    Route::get('faq-masters/{faqMaster}/faqs', [FaqMasterController::class, 'getFaqs']);
    Route::post('faq-masters/{faqMaster}/faqs', [FaqMasterController::class, 'storeFaq']);
    Route::put('faq-masters/{faqMaster}/faqs/{faq}', [FaqMasterController::class, 'updateFaq']);
    Route::delete('faq-masters/{faqMaster}/faqs/{faq}', [FaqMasterController::class, 'deleteFaq']);


    Route::post('/faq-masters/section1/save', [FaqMasterController::class, 'saveSectionOne'])->name('faq.section1.save');
    Route::post('/faq-masters/section2/save', [FaqMasterController::class, 'saveSectionTwo'])->name('faq.section2.save');



    // Sections Routes
    Route::resource('sections', SectionController::class);

    // News Routes
    Route::resource('news', NewsController::class);
    Route::post('/news/section1/save', [NewsController::class, 'saveSectionOne'])->name('news.section1.save');
    Route::post('/news/section2/save', [NewsController::class, 'saveSectionTwo'])->name('news.section2.save');
    Route::post('news/update-sequence', [NewsController::class, 'updateSequence'])->name('news.update-sequence');

    // Network Routes
    Route::get('networks', [\App\Http\Controllers\NetworkController::class, 'index'])->name('networks.index');
    Route::post('networks/store', [\App\Http\Controllers\NetworkController::class, 'store'])->name('networks.store');
    // Main Network Routes
    Route::get('networks/main', [\App\Http\Controllers\NetworkController::class, 'showMainNetwork'])->name('networks.main');
    Route::post('networks/main/save', [\App\Http\Controllers\NetworkController::class, 'saveMainNetwork'])->name('networks.main.save');


    // Network Routes
    // Menu SEO Metadata
    Route::get('seo', [MenuController::class, 'seoIndex'])->name('seo.index');
    Route::post('seo', [MenuController::class, 'seoStore'])->name('seo.store');

    Route::get('footer/edit', [FooterController::class, 'edit'])->name('footer.edit');
    Route::post('footer/update', [FooterController::class, 'update'])->name('footer.update');

    // Contact Us Sections Routes
    Route::get('contact-us-sections/edit', [ContactUsSectionController::class, 'edit'])->name('contact-us-sections.edit');
    Route::post('contact-us-sections/update', [ContactUsSectionController::class, 'update'])->name('contact-us-sections.update');

    // Image Upload Route for TinyMCE
    Route::post('upload/image', [ContactUsSectionController::class, 'uploadImage'])->name('upload.image');

    // Routes that require Admin role only
    Route::middleware('role:admin')->group(function () {
        // User Management routes
        Route::resource('users', UserController::class);

        // Partner routes
        Route::resource('partners', PartnerController::class)->names('partners');
        Route::get('partners-section/{partner}', [PartnerController::class, 'sections'])->name('partners.sections');
        Route::post('partners-section/{partner}/section-one', [PartnerController::class, 'saveSectionOne'])->name('partners.sections.one.save');
        Route::post('partners-section/{partner}/section-one/delete-image', [PartnerController::class, 'deleteImage'])->name('partners.sections.one.delete-image');
        Route::post('partners-section/{partner}/section-two', [PartnerController::class, 'saveSectionTwo'])->name('partners.sections.two.save');
        Route::post('partners-section/{partner}/pipes-offers', [PartnerController::class, 'savePipesOffers'])->name('partners.sections.pipes-offers.save');
        Route::delete('partners-section/{partner}/pipes-offers/{offer}', [PartnerController::class, 'deletePipesOffer'])->name('partners.sections.pipes-offers.delete');

        // Company routes
        Route::resource('company', CompanyController::class)->names('company');

        // Contact routes
        Route::resource('contacts', ContactController::class)->names('contacts');

        // Menu Management Routes
        Route::resource('menus', MenuController::class);
        Route::post('menus/update-order', [MenuController::class, 'updateOrder'])->name('menus.update-order');

        // Banner routes
        Route::resource('banners', BannerController::class);

        // Media routes
        Route::resource('media', MediaController::class)->parameters(['media' => 'media']);
        Route::get('media/sequence/list', [MediaController::class, 'sequenceList'])->name('media.sequence.list');
        Route::post('media/update-sequence', [MediaController::class, 'updateSequence'])->name('media.update-sequence');
        Route::post('/media/section1/save', [MediaController::class, 'saveSectionOne'])->name('media.section1.save');
        Route::post('/media/section2/save', [MediaController::class, 'saveSectionTwo'])->name('media.section2.save');

        // Home Page Management
        Route::get('home-page', [HomePageController::class, 'index'])->name('home-page.index');
        Route::post('home-page/section1', [HomePageController::class, 'saveSection1'])->name('home-page.section1.save');
        Route::post('home-page/section2', [HomePageController::class, 'saveSection2'])->name('home-page.section2.save');
        Route::post('home-page/section3', [HomePageController::class, 'saveSection3'])->name('home-page.section3.save');
        Route::post('home-page/section4', [HomePageController::class, 'saveSection4'])->name('home-page.section4.save');
        Route::post('home-page/add-review', [HomePageController::class, 'addReview'])->name('home-page.add-review');

        // Overview Page Management
        Route::get('/company-pages/overview/sections', [OverviewController::class, 'sections'])->name('overview.sections');
        Route::post('/company-pages/overview/section1/save', [OverviewController::class, 'saveSectionOne'])->name('overview.section1.save');
        Route::post('/company-pages/overview/section2/save', [OverviewController::class, 'saveSectionTwo'])->name('overview.section2.save');
        Route::post('/company-pages/overview/section3/save', [OverviewController::class, 'saveSectionThree'])->name('overview.section3.save');
        Route::post('/company-pages/overview/section4/save', [OverviewController::class, 'saveSectionFour'])->name('overview.section4.save');
        Route::post('/company-pages/overview/section5/save', [OverviewController::class, 'saveSectionFive'])->name('overview.section5.save');
        Route::post('/admin/overview/left-image', [App\Http\Controllers\OverviewController::class, 'saveLeftImage'])->name('overview.left_image.save');

        // Leadership Page Management
        Route::get('/company-pages/leadership/sections', [LeadershipController::class, 'sections'])->name('leadership.sections');
        Route::post('/company-pages/leadership/section1/save', [LeadershipController::class, 'saveSectionOne'])->name('leadership.section1.save');
        Route::post('/company-pages/leadership/section2/save', [LeadershipController::class, 'saveSectionTwo'])->name('leadership.section2.save');
        Route::post('/company-pages/leadership/section3/save', [LeadershipController::class, 'saveSectionThree'])->name('leadership.section3.save');
        Route::post('/company-pages/leadership/section4/save', [LeadershipController::class, 'saveSectionFour'])->name('leadership.section4.save');

        Route::get('/company-pages/csr/sections', [CsrController::class, 'sections'])->name('csr.sections');
        Route::post('/company-pages/csr/section1/save', [CsrController::class, 'saveSectionOne'])->name('csr.section1.save');
        Route::post('/company-pages/csr/section2/save', [CsrController::class, 'saveSectionTwo'])->name('csr.section2.save');
        Route::post('/company-pages/csr/section3/save', [CsrController::class, 'saveSectionThree'])->name('csr.section3.save');
        Route::delete('/company-pages/csr/section3/delete', [CsrController::class, 'deleteSectionThree'])->name('csr.section3.delete');

        // manufacturing
        Route::get('/company-pages/manufacturing/sections', [ManufacturingController::class, 'sections'])->name('manufacturing.sections');
        Route::post('/company-pages/manufacturing/section1/save', [ManufacturingController::class, 'saveSectionOne'])->name('manufacturing.section1.save');
        Route::post('/company-pages/manufacturing/section2/save', [ManufacturingController::class, 'saveSectionTwo'])->name('manufacturing.section2.save');
        Route::post('/company-pages/manufacturing/section3/save', [ManufacturingController::class, 'saveSectionThree'])->name('manufacturing.section3.save');
        Route::post('/company-pages/manufacturing/section4/save', [ManufacturingController::class, 'saveSectionFour'])->name('manufacturing.section4.save');
        Route::post('/company-pages/manufacturing/head/save', [ManufacturingController::class, 'saveHeadSection'])->name('manufacturing.head.save');

        //Certifications
        Route::get('/company-pages/certifications/sections', [CertificationController::class, 'sections'])->name('certifications.sections');
        Route::post('/company-pages/certifications/section1/save', [CertificationController::class, 'saveSectionOne'])->name('certifications.section1.save');
        Route::delete('/company-pages/certifications/section1/delete', [CertificationController::class, 'delete'])->name('certifications.section1.delete');
        Route::post('/company-pages/certifications/head/save', [CertificationController::class, 'saveHeadSection'])->name('certifications.head.save');

        //
        Route::get('why-skipper-pipes', [WhySkipperPipeController::class, 'index'])->name('why-skipper-pipes.index');
        Route::post('why-skipper-pipes/main/save', [WhySkipperPipeController::class, 'saveMain'])->name('why-skipper-pipes.main.save');
        Route::post('why-skipper-pipes/section3/save', [WhySkipperPipeController::class, 'saveSection3'])->name('why-skipper-pipes.section3.save');
        Route::post('why-skipper-pipes/section4/save', [WhySkipperPipeController::class, 'saveSection4'])->name('why-skipper-pipes.section4.save');
        Route::post('why-skipper-pipes/section5/save', [WhySkipperPipeController::class, 'saveSection5'])->name('why-skipper-pipes.section5.save');
        Route::post('why-skipper-pipes/built-for-condition/save', [WhySkipperPipeController::class, 'saveBuiltForCondition'])->name('why-skipper-pipes.built-for-condition.save');

        // Jal Rakshak Routes
        Route::get('jal-rakshak', [JalRakshakController::class, 'index'])->name('jal-rakshak.index');
        Route::post('jal-rakshak/menus/save', [JalRakshakController::class, 'saveMenus'])->name('jal-rakshak.menus.save');
        Route::post('jal-rakshak/banners/save', [JalRakshakController::class, 'saveBanners'])->name('jal-rakshak.banners.save');
        Route::post('jal-rakshak/initiative/save', [JalRakshakController::class, 'saveInitiative'])->name('jal-rakshak.initiative.save');
        Route::post('jal-rakshak/activities/save', [JalRakshakController::class, 'saveActivities'])->name('jal-rakshak.activities.save');
        Route::post('jal-rakshak/gallery/save', [JalRakshakController::class, 'saveGallery'])->name('jal-rakshak.gallery.save');
        Route::post('jal-rakshak/categories/save', [JalRakshakController::class, 'saveCategory'])->name('jal-rakshak.categories.save');
        Route::post('jal-rakshak/categories/delete', [JalRakshakController::class, 'deleteCategory'])->name('jal-rakshak.categories.delete');
        Route::post('jal-rakshak/videos/save', [JalRakshakController::class, 'saveVideos'])->name('jal-rakshak.videos.save');
        Route::post('jal-rakshak/videos/upload-chunk', [JalRakshakController::class, 'uploadVideoChunk'])->name('jal-rakshak.videos.upload-chunk');
        Route::delete('jal-rakshak/videos/delete/{id}', [JalRakshakController::class, 'deleteVideo'])->name('jal-rakshak.videos.delete');
        Route::post('jal-rakshak/conservations/save', [JalRakshakController::class, 'saveConservations'])->name('jal-rakshak.conservations.save');
        Route::post('jal-rakshak/involvement/save', [JalRakshakController::class, 'saveInvolvement'])->name('jal-rakshak.involvement.save');
        Route::post('jal-rakshak/seo/save', [JalRakshakController::class, 'saveSeo'])->name('jal-rakshak.seo.save');

        // Career Routes
        Route::get('careers', [CareerController::class, 'index'])->name('careers.index');
        Route::post('careers/main/save', [CareerController::class, 'saveMain'])->name('careers.main.save');
        Route::post('careers/why-skipper/save', [CareerController::class, 'saveWhySkipper'])->name('careers.why-skipper.save');
        Route::post('careers/life-at-skipper/save', [CareerController::class, 'saveLifeAtSkipper'])->name('careers.life-at-skipper.save');
        Route::post('careers/skipper-pipes/save', [CareerController::class, 'saveSkipperPipes'])->name('careers.skipper-pipes.save');

        //Faq
        Route::resource('faq-masters', FaqMasterController::class)->names('faq_masters');
        Route::get('faq-masters/{faqMaster}/faqs', [FaqMasterController::class, 'getFaqs']);
        Route::post('faq-masters/{faqMaster}/faqs', [FaqMasterController::class, 'storeFaq']);
        Route::put('faq-masters/{faqMaster}/faqs/{faq}', [FaqMasterController::class, 'updateFaq']);
        Route::delete('faq-masters/{faqMaster}/faqs/{faq}', [FaqMasterController::class, 'deleteFaq']);
        Route::post('/faq-masters/section1/save', [FaqMasterController::class, 'saveSectionOne'])->name('faq.section1.save');
        Route::post('/faq-masters/section2/save', [FaqMasterController::class, 'saveSectionTwo'])->name('faq.section2.save');

        // Sections Routes
        Route::resource('sections', SectionController::class);

        // News Routes
        Route::resource('news', NewsController::class);
        Route::post('/news/section1/save', [NewsController::class, 'saveSectionOne'])->name('news.section1.save');
        Route::post('/news/section2/save', [NewsController::class, 'saveSectionTwo'])->name('news.section2.save');
        Route::post('news/update-sequence', [NewsController::class, 'updateSequence'])->name('news.update-sequence');

        // Network Routes
        Route::get('networks', [\App\Http\Controllers\NetworkController::class, 'index'])->name('networks.index');
        Route::post('networks/store', [\App\Http\Controllers\NetworkController::class, 'store'])->name('networks.store');
        // Main Network Routes
        Route::get('networks/main', [\App\Http\Controllers\NetworkController::class, 'showMainNetwork'])->name('networks.main');
        Route::post('networks/main/save', [\App\Http\Controllers\NetworkController::class, 'saveMainNetwork'])->name('networks.main.save');

        // Menu SEO Metadata
        Route::get('seo', [MenuController::class, 'seoIndex'])->name('seo.index');
        Route::post('seo', [MenuController::class, 'seoStore'])->name('seo.store');

        Route::get('footer/edit', [FooterController::class, 'edit'])->name('footer.edit');
        Route::post('footer/update', [FooterController::class, 'update'])->name('footer.update');

        // Contact Us Sections Routes
        Route::get('contact-us-sections/edit', [ContactUsSectionController::class, 'edit'])->name('contact-us-sections.edit');
        Route::post('contact-us-sections/update', [ContactUsSectionController::class, 'update'])->name('contact-us-sections.update');
    });

    // Routes accessible by Admin and Content Management (Blog & Product modules)
    Route::middleware('role:admin,content-management')->group(function () {
        // Blog routes
        Route::resource('blogs', BlogController::class)->names('blogs');
        Route::get('blogs/sequence/list', [BlogController::class, 'sequenceList'])->name('blogs.sequence.list');
        Route::post('blogs/update-sequence', [BlogController::class, 'updateSequence'])->name('blogs.update-sequence');
        Route::post('/blogs/section1/save', [BlogController::class, 'saveSectionOne'])->name('blog.section1.save');
        Route::post('/blogs/section2/save', [BlogController::class, 'saveSectionTwo'])->name('blog.section2.save');

        // Blog Category routes
        Route::resource('blog-categories', BlogCategoryController::class)->names('blog_categories');

        // Product routes
        Route::resource('products', ProductController::class)->names('products');
        Route::get('products-section/{product}', [ProductController::class, 'sections'])->name('products.sections');
        Route::post('products-section/{product}/overview', [ProductController::class, 'saveOverview'])->name('products.sections.overview.save');
        Route::post('products-section/{product}/applications', [ProductController::class, 'saveApplications'])->name('products.sections.applications.save');
        Route::post('products-section/{product}/features', [ProductController::class, 'saveFeatures'])->name('products.sections.features.save');
        Route::post('products-section/{product}/faq', [ProductController::class, 'saveFaq'])->name('products.sections.faq.save');

        // Product Category routes
        Route::resource('product-categories', ProductCategoryController::class)->names('product_categories');
    });

    // Routes accessible by Admin and Lead Management (Dashboard module)
    Route::middleware('role:admin,lead-management')->group(function () {
        // Dashboard routes are already defined above, but export routes need role check
        // These are already accessible to all authenticated users above
    });
});


// Frontend Routes
Route::name('front.')->group(function () {

    Route::get('/', [FrontController::class, 'index'])->name('home');
    Route::get('/blogs', [FrontController::class, 'blogs'])->name('blogs.index');


    Route::get('/blogs/{slug}', [FrontController::class, 'blogDetail'])->name('blogs.show');
    Route::post('/blogs/{blog}/comment', [FrontController::class, 'storeBlogComment'])->name('blogs.comment');
    Route::get('/partner/{slug}', [FrontController::class, 'partner'])->name('partner.show');
    Route::get('/products/{slug}', [FrontController::class, 'productDetail'])->name('products.show');
    Route::get('/company/{slug}', [FrontController::class, 'companyPage'])->name('company.page');
    Route::post('/partner-enquiry', [FrontController::class, 'storePartnerEnquiry'])->name('partner.enquiry');
    Route::get('/dealer-thankyou', [FrontController::class, 'dealerThankyou'])->name('dealer.thankyou');
    Route::get('/distributor-thankyou', [FrontController::class, 'distributorThankyou'])->name('distributor.thankyou');

    Route::get('/faqs', [FrontController::class, 'faqs'])->name('faqs.index');
    Route::get('/news', [FrontController::class, 'news'])->name('news.index');
    Route::get('/media', [FrontController::class, 'media'])->name('media.index');
    Route::get('/why-skipper-pipes', [FrontController::class, 'whySkipperPipes'])->name('why-skipper-pipes.index');
    Route::get('/jal-rakshak', [FrontController::class, 'jalRakshak'])->name('jal-rakshak.index');
    Route::post('/jal-rakshak-submission', [FrontController::class, 'storeJalRakshakSubmission'])->name('jal-rakshak.submission');
    Route::get('/private-projects', [FrontController::class, 'privateProject'])->name('private-project.index');
    Route::post('/private-project-enquiry', [FrontController::class, 'storePrivateProjectEnquiry'])->name('private-project.enquiry');
    Route::get('/private-projects-thankyou', [FrontController::class, 'privateProjectsThankyou'])->name('private-projects.thankyou');
    Route::get('/contact-us', [FrontController::class, 'contact'])->name('contact.index');
    Route::post('/contact-us', [FrontController::class, 'storeContact'])->name('contact.store');

    Route::get('/careers', [FrontController::class, 'careers'])->name('careers.index');
    Route::post('/careers', [FrontController::class, 'storeCareerApplication'])->name('careers.store');


    Route::get('/network', [FrontController::class, 'network'])->name('network.index');
    Route::get('/{slug?}', [FrontController::class, 'section'])->name('section.index');
});