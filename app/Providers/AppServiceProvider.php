<?php

namespace App\Providers;

use App\Models\Banner;
use App\Models\Footer;
use App\Models\Menu;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\HomeSectionFour;
use App\Models\HomeSectionFourReview;
use App\Models\HomeSectionOne;
use App\Models\HomeSectionOneFeature;
use App\Models\HomeSectionThree;
use App\Models\HomeSectionTwo;
use App\Models\ImageAltText;
use App\Models\MenuSeoMetadata;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductionApplicationSection;
use App\Models\ProductionFaqSection;
use App\Models\ProductionFeaturesSection;
use App\Models\ProductionOverviewSection;
use App\Observers\SiteCacheObserver;
use App\Support\SiteCache;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Load helper functions
        if (file_exists(app_path('helpers.php'))) {
            require_once app_path('helpers.php');
        }

        foreach ([
            Product::class,
            ProductCategory::class,
            ProductionOverviewSection::class,
            ProductionApplicationSection::class,
            ProductionFeaturesSection::class,
            ProductionFaqSection::class,
            Banner::class,
            Blog::class,
            BlogCategory::class,
            HomeSectionOne::class,
            HomeSectionOneFeature::class,
            HomeSectionTwo::class,
            HomeSectionThree::class,
            HomeSectionFour::class,
            HomeSectionFourReview::class,
            Menu::class,
            MenuSeoMetadata::class,
            Footer::class,
            ImageAltText::class,
        ] as $model) {
            $model::observe(SiteCacheObserver::class);
        }

        View::composer('front.layouts.app', function ($view) {
            $viewData = $view->getData();
            $banners = $viewData['banners'] ?? collect();
            if (request()->routeIs('front.home', 'front.products.show')) {
                $layoutData = SiteCache::remember('layout', 86400, function () use ($banners) {
                    return [
                        'menus' => Menu::tree(),
                        'footer' => Footer::select('section1', 'section2', 'section3', 'section4')->first(),
                        'banner' => $banners->first() ?? Banner::where('status', '1')->orderBy('sequence')->first(),
                    ];
                });
            } else {
                $layoutData = [
                    'menus' => Menu::tree(),
                    'footer' => Footer::select('section1', 'section2', 'section3', 'section4')->first(),
                    'banner' => $banners->first() ?? Banner::where('status', '1')->orderBy('sequence')->first(),
                ];
            }

            $view->with([
                'layoutBanner' => $banners->first() ?? $layoutData['banner'],
                'layoutMenus' => $layoutData['menus'],
                'layoutFooter' => $layoutData['footer'],
            ]);
        });
    }
}
