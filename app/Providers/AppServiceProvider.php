<?php

namespace App\Providers;

use App\Models\Banner;
use App\Models\Footer;
use App\Models\Menu;
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

        View::composer('front.layouts.app', function ($view) {
            $viewData = $view->getData();
            $banners = $viewData['banners'] ?? collect();

            $view->with([
                'layoutBanner' => $banners->first() ?? Banner::where('status', '1')->orderBy('sequence')->first(),
                'layoutMenus' => Menu::tree(),
                'layoutFooter' => Footer::select('section1', 'section2', 'section3', 'section4')->first(),
            ]);
        });
    }
}
