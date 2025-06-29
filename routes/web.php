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
use App\Http\Controllers\FrontController;
use App\Http\Controllers\UserController;

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

    // Product Category routes
    Route::resource('product-categories', ProductCategoryController::class)->names('product_categories');

    // Blog Category routes
    Route::resource('blog-categories', BlogCategoryController::class)->names('blog_categories');

    // Blog Comment routes
    Route::resource('blog-comments', BlogCommentController::class)->names('blog_comments');

    // Company Page routes
    Route::resource('company-pages', CompanyPageController::class)->names('company_pages');

    // Contact routes
    Route::resource('contacts', ContactController::class)->names('contacts');

    // Menu Management Routes
    Route::resource('menus', MenuController::class);
    Route::post('menus/update-order', [MenuController::class, 'updateOrder'])->name('menus.update-order');

    // Banner routes
    Route::resource('banners', BannerController::class);
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