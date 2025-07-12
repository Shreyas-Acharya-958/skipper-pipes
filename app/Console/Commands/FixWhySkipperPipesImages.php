<?php

namespace App\Console\Commands;

use App\Models\WhySkipperPipe;
use App\Models\WhySkipperPipeSectionTwo;
use App\Models\WhySkipperPipeSectionThree;
use App\Models\WhySkipperPipeSectionFour;
use App\Models\WhySkipperPipeSectionFive;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class FixWhySkipperPipesImages extends Command
{
    protected $signature = 'why-skipper-pipes:fix-images';
    protected $description = 'Move Why Skipper Pipes images from private to public storage';

    public function handle()
    {
        $this->info('Starting to fix Why Skipper Pipes images...');

        // Fix main section
        $mainSection = WhySkipperPipe::first();
        if ($mainSection && $mainSection->image) {
            $this->moveImageToPublic($mainSection);
        }

        // Fix section 2 (Built for Condition)
        foreach (WhySkipperPipeSectionTwo::all() as $section) {
            if ($section->image) {
                $this->moveImageToPublic($section);
            }
        }

        // Fix section 3
        foreach (WhySkipperPipeSectionThree::all() as $section) {
            if ($section->image) {
                $this->moveImageToPublic($section);
            }
        }

        // Fix section 4
        foreach (WhySkipperPipeSectionFour::all() as $section) {
            if ($section->image) {
                $this->moveImageToPublic($section);
            }
        }

        // Fix section 5
        foreach (WhySkipperPipeSectionFive::all() as $section) {
            if ($section->image) {
                $this->moveImageToPublic($section);
            }
        }

        $this->info('All images have been fixed!');
    }

    private function moveImageToPublic($model)
    {
        $oldPath = $model->image;

        // Check if file exists in private storage
        if (Storage::exists($oldPath)) {
            // Get file contents
            $contents = Storage::get($oldPath);

            // Store in public storage
            Storage::disk('public')->put($oldPath, $contents);

            // Delete from private storage
            Storage::delete($oldPath);

            $this->line("Moved image: {$oldPath}");
        } else {
            $this->warn("Image not found: {$oldPath}");
        }
    }
}
