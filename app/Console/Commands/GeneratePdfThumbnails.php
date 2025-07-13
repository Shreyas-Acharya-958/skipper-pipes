<?php

namespace App\Console\Commands;

use App\Models\Media;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class GeneratePdfThumbnails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'media:generate-pdf-thumbnails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate thumbnails for PDF files that don\'t have thumbnails';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting PDF thumbnail generation...');

        $mediaItems = Media::where('file_type', 'pdf')
            ->whereNotNull('file')
            ->whereNull('thumbnail')
            ->get();

        if ($mediaItems->isEmpty()) {
            $this->info('No PDF files found without thumbnails.');
            return;
        }

        $this->info("Found {$mediaItems->count()} PDF files without thumbnails.");

        $successCount = 0;
        $errorCount = 0;

        foreach ($mediaItems as $media) {
            try {
                // Ensure thumbnail directory exists
                Storage::disk('public')->makeDirectory('thumbnails');

                $thumbnailFilename = 'thumbnails/' . pathinfo($media->file, PATHINFO_FILENAME) . '-thumb.png';

                // Create a simple PDF icon thumbnail
                $this->createPdfIcon($thumbnailFilename);

                // Update media record
                $media->update(['thumbnail' => $thumbnailFilename]);

                $this->info("Generated thumbnail for: {$media->title}");
                $successCount++;
            } catch (\Exception $e) {
                $this->error("Failed to generate thumbnail for {$media->title}: " . $e->getMessage());
                Log::error('PDF thumbnail generation failed for media ID ' . $media->id . ': ' . $e->getMessage());
                $errorCount++;
            }
        }

        $this->info("Thumbnail generation completed!");
        $this->info("Success: {$successCount}");
        $this->info("Errors: {$errorCount}");
    }

    /**
     * Create a simple PDF icon thumbnail
     */
    private function createPdfIcon($thumbnailFilename)
    {
        // Create a simple 300x400 PNG image with PDF styling
        $width = 300;
        $height = 400;

        // Create image
        $image = imagecreatetruecolor($width, $height);

        // Define colors
        $white = imagecolorallocate($image, 255, 255, 255);
        $red = imagecolorallocate($image, 220, 53, 69);
        $darkGray = imagecolorallocate($image, 52, 58, 64);
        $lightGray = imagecolorallocate($image, 108, 117, 125);

        // Fill background
        imagefill($image, 0, 0, $white);

        // Draw PDF document shape
        $margin = 20;
        $docWidth = $width - (2 * $margin);
        $docHeight = $height - (2 * $margin);

        // Main document rectangle
        imagefilledrectangle($image, $margin, $margin, $margin + $docWidth, $margin + $docHeight, $white);
        imagerectangle($image, $margin, $margin, $margin + $docWidth, $margin + $docHeight, $darkGray);

        // PDF label background
        $labelHeight = 40;
        imagefilledrectangle($image, $margin, $margin + $docHeight - $labelHeight, $margin + $docWidth, $margin + $docHeight, $red);

        // PDF text
        $fontSize = 5;
        $text = 'PDF';
        $textColor = $white;

        // Calculate text position to center it
        $textWidth = imagefontwidth($fontSize) * strlen($text);
        $textHeight = imagefontheight($fontSize);
        $textX = $margin + ($docWidth - $textWidth) / 2;
        $textY = $margin + $docHeight - $labelHeight + ($labelHeight - $textHeight) / 2;

        imagestring($image, $fontSize, $textX, $textY, $text, $textColor);

        // Draw some lines to represent text
        $lineY = $margin + 60;
        for ($i = 0; $i < 8; $i++) {
            $lineLength = rand(60, $docWidth - 40);
            imageline($image, $margin + 20, $lineY, $margin + 20 + $lineLength, $lineY, $lightGray);
            $lineY += 25;
        }

        // Save the image
        $thumbnailPath = storage_path('app/public/' . $thumbnailFilename);
        imagepng($image, $thumbnailPath);
        imagedestroy($image);

        return $thumbnailFilename;
    }
}