<?php

namespace App\Console\Commands;

use App\Support\SiteCache;
use Illuminate\Console\Command;

class ClearSiteCache extends Command
{
    protected $signature = 'site-cache:clear';

    protected $description = 'Invalidate cached site page content';

    public function handle(): int
    {
        SiteCache::invalidate();
        $this->info('Site page cache invalidated.');

        return self::SUCCESS;
    }
}
