<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\ProductionFeaturesSection;
use App\Support\SiteCache;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Tests\TestCase;

class SitePageCacheTest extends TestCase
{
    public function test_home_and_product_pages_respond_with_their_configured_status(): void
    {
        $this->get('/')->assertOk();

        foreach ([
            '/products/agriculture-pipes',
            '/products/cpvc-pipes-and-fittings',
            '/products/swr-pipes-and-fittings',
            '/products/upvc-pipes-and-fittings',
        ] as $path) {
            $status = $this->get($path)->getStatusCode();
            $this->assertContains($status, [200, 301], $path . ' should render or follow its existing redirect.');
        }
    }

    public function test_unknown_product_is_not_cached(): void
    {
        $slug = 'missing-' . Str::random(12);
        $this->get('/products/' . $slug)->assertNotFound();

        $version = Cache::store('file')->get('site_cache_version', 1);
        $cacheKey = 'site_cache_' . $version . '_' . sha1('product:' . $slug);
        $seoCacheKey = 'site_cache_' . $version . '_' . sha1('seo:products/' . $slug);

        $this->assertFalse(Cache::store('file')->has($cacheKey));
        $this->assertFalse(Cache::store('file')->has($seoCacheKey));
    }

    public function test_warm_home_and_product_requests_run_no_database_queries(): void
    {
        $paths = [
            '/',
            '/products/cpvc-pipes-and-fittings',
            '/products/swr-pipes-and-fittings',
            '/products/upvc-pipes-and-fittings',
        ];
        $queries = [];

        DB::listen(function ($query) use (&$queries) {
            $queries[] = $query->sql;
        });

        foreach ($paths as $path) {
            SiteCache::invalidate();
            $queries = [];
            $this->get($path)->assertOk();
            $coldQueryCount = count($queries);

            $queries = [];
            $this->get($path)->assertOk();

            $this->assertGreaterThan(0, $coldQueryCount, $path . ' should perform content queries when cold.');
            $this->assertSame(0, count($queries), $path . ' should perform no database queries when warm.');
        }
    }

    public function test_warm_command_requests_all_five_pages(): void
    {
        Http::fake(['*' => Http::response('', 200)]);

        $this->artisan('site-cache:warm')->assertSuccessful();

        Http::assertSentCount(5);
    }

    public function test_product_edits_invalidate_cached_page_content(): void
    {
        $product = Product::where('slug', 'cpvc-pipes-and-fittings')->first();
        if (!$product) {
            $this->markTestSkipped('The local CPVC product is not available.');
        }

        DB::beginTransaction();
        try {
            $title = 'Cache verification ' . Str::random(8);
            $product->title = $title;
            $product->h1_title = $title;
            $product->save();

            $this->get('/products/' . $product->slug)->assertOk()->assertSee($title);
        } finally {
            DB::rollBack();
            SiteCache::invalidate();
        }
    }

    public function test_product_feature_edits_invalidate_cached_page_content(): void
    {
        $product = Product::where('slug', 'cpvc-pipes-and-fittings')->first();
        if (!$product) {
            $this->markTestSkipped('The local CPVC product is not available.');
        }

        $feature = ProductionFeaturesSection::where('product_id', $product->id)->first();
        if (!$feature) {
            $this->markTestSkipped('The local CPVC product has no feature to update.');
        }

        DB::beginTransaction();
        try {
            $title = 'Feature cache verification ' . Str::random(8);
            $feature->title = $title;
            $feature->save();

            $this->get('/products/' . $product->slug)->assertOk()->assertSee($title);
        } finally {
            DB::rollBack();
            SiteCache::invalidate();
        }
    }
}
