<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class WarmSiteCache extends Command
{
    protected $signature = 'site-cache:warm';

    protected $description = 'Warm cached content for the home and product pages';

    public function handle(): int
    {
        $paths = [
            '/',
            '/products/agriculture-pipes',
            '/products/cpvc-pipes-and-fittings',
            '/products/swr-pipes-and-fittings',
            '/products/upvc-pipes-and-fittings',
        ];
        $failed = false;

        foreach ($paths as $path) {
            try {
                $response = Http::timeout(30)->get(url($path));

                $this->line($path . ': HTTP ' . $response->status());
                if ($response->status() >= 400) {
                    $failed = true;
                }
            } catch (\Throwable $exception) {
                $this->error($path . ': ' . $exception->getMessage());
                $failed = true;
            }
        }

        return $failed ? self::FAILURE : self::SUCCESS;
    }
}
