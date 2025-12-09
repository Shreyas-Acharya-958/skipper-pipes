<?php

namespace App\Console\Commands;

use App\Models\ImageAltText;
use Illuminate\Console\Command;

class UpdateDefaultAltText extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'images:update-default-alt-text {--force : Update even if alt text already exists}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update default alt text for all images that don\'t have alt text (generated from filename)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('═══════════════════════════════════════════════════════════');
        $this->info('  Updating Default Alt Text for Images');
        $this->info('═══════════════════════════════════════════════════════════');
        $this->newLine();

        $force = $this->option('force');

        if ($force) {
            $this->warn('Force mode enabled: Will update ALL images (even those with existing alt text)');
            $images = ImageAltText::all();
        } else {
            $images = ImageAltText::where(function ($query) {
                $query->whereNull('alt_text')
                    ->orWhere('alt_text', '');
            })->get();
        }

        $total = $images->count();
        $updated = 0;
        $skipped = 0;

        if ($total === 0) {
            $this->info('  ✓ No images found that need updating.');
            $this->newLine();
            return 0;
        }

        $this->info("  Found {$total} image(s) to process...");
        $this->newLine();

        $bar = $this->output->createProgressBar($total);
        $bar->start();

        foreach ($images as $image) {
            // Skip if alt text exists and not in force mode
            if (!$force && !empty($image->alt_text)) {
                $skipped++;
                $bar->advance();
                continue;
            }

            // Generate default alt text from filename
            $fileName = $image->file_name;
            $fileNameWithoutExt = pathinfo($fileName, PATHINFO_FILENAME);

            // Replace underscores, hyphens, and multiple spaces with single space
            $defaultAltText = preg_replace('/[_\-\s]+/', ' ', $fileNameWithoutExt);

            // Trim and capitalize first letter of each word
            $defaultAltText = trim($defaultAltText);
            $defaultAltText = ucwords(strtolower($defaultAltText));

            // Update the image
            $image->alt_text = $defaultAltText;
            $image->save();

            $updated++;
            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);

        $this->info('═══════════════════════════════════════════════════════════');
        $this->info('  Update Complete!');
        $this->info('═══════════════════════════════════════════════════════════');
        $this->newLine();
        $this->table(
            ['Metric', 'Count'],
            [
                ['Total Images Processed', $total],
                ['Alt Text Updated', $updated],
                ['Skipped (already had alt text)', $skipped],
            ]
        );
        $this->newLine();
        $this->info("  💡 Visit /admin/image-alt-texts to review and edit alt text");
        $this->newLine();

        return 0;
    }

    /**
     * Generate default alt text from filename
     */
    protected function generateDefaultAltText($fileName)
    {
        $fileNameWithoutExt = pathinfo($fileName, PATHINFO_FILENAME);
        // Replace underscores, hyphens, and multiple spaces with single space
        $defaultAltText = preg_replace('/[_\-\s]+/', ' ', $fileNameWithoutExt);
        // Trim and capitalize first letter of each word
        $defaultAltText = trim($defaultAltText);
        $defaultAltText = ucwords(strtolower($defaultAltText));

        return $defaultAltText;
    }
}
