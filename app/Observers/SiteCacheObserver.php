<?php

namespace App\Observers;

use App\Support\SiteCache;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductionApplicationSection;
use App\Models\ProductionFaqSection;
use App\Models\ProductionFeaturesSection;
use App\Models\ProductionOverviewSection;
use App\Models\Banner;
use App\Models\Menu;
use App\Models\MenuSeoMetadata;
use App\Models\Footer;
use App\Models\ImageAltText;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Database\Eloquent\Model;

class SiteCacheObserver
{
    private static ?\WeakMap $originalSlugs = null;

    public function updating(Model $model): void
    {
        if ($model instanceof Product) {
            self::$originalSlugs ??= new \WeakMap();
            self::$originalSlugs[$model] = $model->getOriginal('slug');
        }
    }

    public function created(Model $model): void
    {
        $this->forgetAffected($model);
    }

    public function updated(Model $model): void
    {
        $this->forgetAffected($model);
        if ($model instanceof Product && self::$originalSlugs && isset(self::$originalSlugs[$model])) {
            SiteCache::forgetProduct(self::$originalSlugs[$model]);
            unset(self::$originalSlugs[$model]);
        }
    }

    public function deleted(Model $model): void
    {
        $this->forgetAffected($model);
    }

    public function restored(Model $model): void
    {
        $this->forgetAffected($model);
    }

    public function forceDeleted(Model $model): void
    {
        $this->forgetAffected($model);
    }

    private function forgetAffected(Model $model): void
    {
        if ($model instanceof Product) {
            SiteCache::forgetProduct($model->slug);
            SiteCache::forgetHome();

            return;
        }

        if ($model instanceof ProductCategory) {
            SiteCache::forgetHome();

            return;
        }

        if ($model instanceof ProductionOverviewSection || $model instanceof ProductionApplicationSection ||
            $model instanceof ProductionFeaturesSection || $model instanceof ProductionFaqSection) {
            if ($model->product_id) {
                SiteCache::forgetProduct(Product::whereKey($model->product_id)->value('slug'));
                if ($model instanceof ProductionOverviewSection || $model instanceof ProductionFeaturesSection || $model instanceof ProductionFaqSection) {
                    SiteCache::forgetHome();
                }
            } elseif ($model->product_category_id) {
                SiteCache::forgetHome();
            } else {
                SiteCache::invalidate();
            }

            return;
        }

        if ($model instanceof Banner) {
            SiteCache::forgetLayout();
            SiteCache::forgetHome();

            return;
        }

        if ($model instanceof Menu || $model instanceof MenuSeoMetadata) {
            // Menu links and their SEO metadata map to URL-specific cache keys.
            // Their complete URL mapping is not stable enough for a safe targeted forget.
            SiteCache::invalidate();

            return;
        }

        if ($model instanceof Footer) {
            SiteCache::forgetLayout();
            SiteCache::forgetHome();

            return;
        }

        if ($model instanceof Blog || $model instanceof BlogCategory || $model instanceof ImageAltText ||
            str_starts_with(class_basename($model), 'HomeSection')) {
            SiteCache::forgetHome();
            if ($model instanceof ImageAltText) {
                SiteCache::forget('image_alt_texts_map');
            }

            return;
        }

        SiteCache::invalidate();
    }
}
