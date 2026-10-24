<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use SplFileInfo;

class CleanupSiteCache extends Command
{
    protected $signature = 'site-cache:cleanup';

    protected $description = 'Remove expired files from the site page cache';

    public function handle(): int
    {
        $directory = config('cache.stores.site_file.path');
        $cutoff = now()->subDays(8)->getTimestamp();
        $removed = 0;

        if (!is_dir($directory)) {
            $this->info('No site cache files to clean.');

            return self::SUCCESS;
        }

        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($directory, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::CHILD_FIRST
        );

        foreach ($files as $file) {
            if ($file instanceof SplFileInfo && $file->isFile() && $file->getMTime() < $cutoff && @unlink($file->getPathname())) {
                $removed++;
            }
        }

        $this->info($removed . ' expired site cache files removed.');

        return self::SUCCESS;
    }
}
