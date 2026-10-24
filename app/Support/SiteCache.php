<?php

namespace App\Support;

use Closure;
use Illuminate\Support\Facades\Cache;

class SiteCache
{
    public static function remember(string $key, int $seconds, Closure $callback)
    {
        $cache = Cache::store('file');
        $version = $cache->get('site_cache_version', 1);
        $cacheKey = 'site_cache_' . $version . '_' . sha1($key);

        if ($cache->has($cacheKey)) {
            return $cache->get($cacheKey);
        }

        return $cache->lock($cacheKey . '_lock', 120)->block(10, function () use ($cache, $cacheKey, $seconds, $callback) {
            if ($cache->has($cacheKey)) {
                return $cache->get($cacheKey);
            }

            $value = $callback();
            $cache->put($cacheKey, $value, $seconds);

            return $value;
        });
    }

    public static function invalidate(): void
    {
        $cache = Cache::store('file');

        $cache->lock('site_cache_version_lock', 10)->block(5, function () use ($cache) {
            $version = (int) $cache->get('site_cache_version', 0);
            $cache->forever('site_cache_version', $version + 1);
        });
    }
}
