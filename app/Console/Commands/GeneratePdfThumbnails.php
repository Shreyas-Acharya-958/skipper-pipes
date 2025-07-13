<?php

namespace App\Console\Commands;

use App\Models\Media;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Spatie\PdfToImage\Pdf;

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
                $filePath = storage_path('app/public/' . $media->file);
                if (!file_exists($filePath)) {
                    $this->warn("File not found: {$media->file}");
                    $errorCount++;
                    continue;
                }
                // Ensure thumbnail directory exists
                Storage::disk('public')->makeDirectory('thumbnails');
                $thumbnailFilename = 'thumbnails/' . pathinfo($media->file, PATHINFO_FILENAME) . '-thumb.jpg';
                $thumbnailPath = storage_path('app/public/' . $thumbnailFilename);
                $pdf = new Pdf($filePath);
                $pdf->setOutputFormat('jpg');
                $pdf->saveImage($thumbnailPath, 1); // Save first page as thumbnail
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
}