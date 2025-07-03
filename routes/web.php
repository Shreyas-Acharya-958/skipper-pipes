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

Route::get('/', function () {
    return view('welcome');
});



// Admin authentication routes (no middleware)

Route::get('admin/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::prefix('admin')->name('admin.')->group(function () {

    Route::post('login', [AuthController::class, 'login'])->name('login.post');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});


// Admin routes (with auth middleware)
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // User Management routes
    Route::resource('users', UserController::class);

    // Blog routes
    Route::resource('blogs', BlogController::class)->names('blogs');

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

    // Company Page routes
    Route::resource('company-pages', CompanyPageController::class)->names('company_pages');
    Route::post('company-pages-update/{id}', [CompanyPageController::class, 'update'])->name('company_pages_update.update');

    // Route::get('company-pages', [CompanyPageController::class, 'index'])->name('company_pages.index');
    // Route::get('company-pages/{company_page}', [CompanyPageController::class, 'show'])->name('company_pages.show');
    // Route::post('company-pages', [CompanyPageController::class, 'store'])->name('company_pages.store');
    // Route::put('company-pages/{company_page}', [CompanyPageController::class, 'update'])->name('company_pages.update');
    // Route::delete('company-pages/{company_page}', [CompanyPageController::class, 'destroy'])->name('company_pages.destroy');


    // Contact routes
    Route::resource('contacts', ContactController::class)->names('contacts');

    // Menu Management Routes
    Route::resource('menus', MenuController::class);
    Route::post('menus/update-order', [MenuController::class, 'updateOrder'])->name('menus.update-order');

    // Banner routes
    Route::resource('banners', BannerController::class);


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

    //Certifications
    Route::get('/company-pages/certifications/sections', [CertificationController::class, 'sections'])->name('certifications.sections');
    Route::post('/company-pages/certifications/section1/save', [CertificationController::class, 'saveSectionOne'])->name('certifications.section1.save');
    Route::delete('/company-pages/certifications/section1/delete', [CertificationController::class, 'delete'])->name('certifications.section1.delete');
});


// Frontend Routes
Route::name('front.')->group(function () {

    Route::get('/', [FrontController::class, 'index'])->name('home');
    Route::get('/blogs', [FrontController::class, 'blogs'])->name('blogs.index');
    Route::get('/blogs/{slug}', [FrontController::class, 'blogDetail'])->name('blogs.show');
    Route::post('/blogs/{blog}/comment', [FrontController::class, 'storeComment'])->name('blogs.comment');
    //Route::get('/products', [FrontController::class, 'products'])->name('products.index');
    Route::get('/products/{slug}', [FrontController::class, 'productDetail'])->name('products.show');
    Route::get('/company/{slug}', [FrontController::class, 'companyPage'])->name('company.page');
});
// Route::get('/admin/users', function () {
//     //redireto admin login page
//     return redirect()->route('admin.login');
// });
// Route::get('/admin', function () {
//     return redirect()->route('admin.login');
// });