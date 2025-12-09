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
        $this->info('═══════════════════════════════════════════════════════════');
        $this->info('  Starting Image Scan for Alt Text Management');
        $this->info('═══════════════════════════════════════════════════════════');
        $this->newLine();

        $force = $this->option('force');
        if ($force) {
            $this->warn('Force mode enabled: Will update existing entries');
        }
        $this->newLine();

        $scanned = 0;
        $added = 0;
        $updated = 0;
        $skipped = 0;

        foreach ($this->directories as $dir) {
            $fullPath = base_path($dir);

            if (!File::exists($fullPath)) {
                $this->warn("  ⚠ Directory not found: {$dir}");
                $this->newLine();
                continue;
            }

            $this->info("  📁 Scanning: {$dir}");
            $result = $this->scanDirectory($fullPath, $dir, $force);
            $scanned += $result['scanned'];
            $added += $result['added'];
            $updated += $result['updated'];
            $skipped += $result['skipped'];

            $this->line("     ✓ Found: {$result['scanned']} images");
            $this->line("     ✓ Added: {$result['added']} new entries");
            if ($result['updated'] > 0) {
                $this->line("     ✓ Updated: {$result['updated']} existing entries");
            }
            if ($result['skipped'] > 0) {
                $this->line("     ⊘ Skipped: {$result['skipped']} existing entries (use --force to update)");
            }
            $this->newLine();
        }

        $this->info('═══════════════════════════════════════════════════════════');
        $this->info('  Scan Complete!');
        $this->info('═══════════════════════════════════════════════════════════');
        $this->newLine();
        $this->table(
            ['Metric', 'Count'],
            [
                ['Total Images Scanned', $scanned],
                ['New Images Added', $added],
                ['Existing Images Updated', $updated],
                ['Existing Images Skipped', $skipped],
            ]
        );
        $this->newLine();
        $this->info("  💡 Tip: Visit /admin/image-alt-texts to manage alt text");
        $this->newLine();

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
        $skipped = 0;

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
                } else {
                    $skipped++;
                }
            } else {
                // Generate default alt text from filename (remove extension, replace underscores/hyphens with spaces)
                $fileName = $file->getFilename();
                $fileNameWithoutExt = pathinfo($fileName, PATHINFO_FILENAME);
                // Replace underscores, hyphens, and multiple spaces with single space
                $defaultAltText = preg_replace('/[_\-\s]+/', ' ', $fileNameWithoutExt);
                // Trim and capitalize first letter of each word
                $defaultAltText = trim($defaultAltText);
                $defaultAltText = ucwords(strtolower($defaultAltText));

                // Create new entry
                ImageAltText::create([
                    'image_path' => '/' . $relativePath,
                    'normalized_path' => $normalizedPath,
                    'file_name' => $fileName,
                    'directory' => dirname($relativePath),
                    'file_size' => $file->getSize(),
                    'alt_text' => $defaultAltText,
                ]);
                $added++;
            }
        }

        return [
            'scanned' => $scanned,
            'added' => $added,
            'updated' => $updated,
            'skipped' => $skipped,
        ];
    }
}
