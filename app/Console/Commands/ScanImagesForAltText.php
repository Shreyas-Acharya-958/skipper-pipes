<?php

namespace App\Console\Commands;

use App\Models\ImageAltText;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ScanImagesForAltText extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'images:scan {--force : Force re-scan of all images}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scan all images from public directories and add them to database for alt text management';

    /**
     * Image extensions to scan
     */
    protected $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'svg', 'webp', 'bmp', 'ico'];

    /**
     * Directories to scan
     */
    protected $directories = [
        'public/assets',
        'public/storage',
        'public/images',
    ];

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting image scan...');

        $force = $this->option('force');
        $scanned = 0;
        $added = 0;
        $updated = 0;

        foreach ($this->directories as $dir) {
            $fullPath = base_path($dir);

            if (!File::exists($fullPath)) {
                $this->warn("Directory not found: {$dir}");
                continue;
            }

            $this->info("Scanning: {$dir}");
            $result = $this->scanDirectory($fullPath, $dir, $force);
            $scanned += $result['scanned'];
            $added += $result['added'];
            $updated += $result['updated'];
        }

        $this->info("\nScan complete!");
        $this->info("Total images scanned: {$scanned}");
        $this->info("New images added: {$added}");
        $this->info("Existing images updated: {$updated}");

        return 0;
    }

    /**
     * Scan a directory recursively for images
     */
    protected function scanDirectory($fullPath, $relativeDir, $force = false)
    {
        $scanned = 0;
        $added = 0;
        $updated = 0;

        $files = File::allFiles($fullPath);

        foreach ($files as $file) {
            $extension = strtolower($file->getExtension());

            if (!in_array($extension, $this->imageExtensions)) {
                continue;
            }

            $scanned++;

            // Get relative path from public directory
            $relativePath = str_replace(public_path(), '', $file->getPathname());
            $relativePath = ltrim(str_replace('\\', '/', $relativePath), '/');

            // Normalize path
            $normalizedPath = ImageAltText::normalizePath($relativePath);

            // Check if image already exists
            $imageAltText = ImageAltText::where('normalized_path', $normalizedPath)->first();

            if ($imageAltText) {
                if ($force) {
                    // Update file info
                    $imageAltText->file_size = $file->getSize();
                    $imageAltText->save();
                    $updated++;
                }
            } else {
                // Create new entry
                ImageAltText::create([
                    'image_path' => '/' . $relativePath,
                    'normalized_path' => $normalizedPath,
                    'file_name' => $file->getFilename(),
                    'directory' => dirname($relativePath),
                    'file_size' => $file->getSize(),
                    'alt_text' => null,
                ]);
                $added++;
            }
        }

        return [
            'scanned' => $scanned,
            'added' => $added,
            'updated' => $updated,
        ];
    }
}
