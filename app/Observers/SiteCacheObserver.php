<?php

namespace App\Observers;

use App\Support\SiteCache;
use Illuminate\Database\Eloquent\Model;

class SiteCacheObserver
{
    public function created(Model $model): void
    {
        SiteCache::invalidate();
    }

    public function updated(Model $model): void
    {
        SiteCache::invalidate();
    }

    public function deleted(Model $model): void
    {
        SiteCache::invalidate();
    }

    public function restored(Model $model): void
    {
        SiteCache::invalidate();
    }

    public function forceDeleted(Model $model): void
    {
        SiteCache::invalidate();
    }
}
