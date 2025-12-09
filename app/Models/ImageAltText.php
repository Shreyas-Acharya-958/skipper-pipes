<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageAltText extends Model
{
    protected $fillable = [
        'image_path',
        'normalized_path',
        'alt_text',
        'file_name',
        'directory',
        'file_size',
    ];

    /**
     * Normalize image path for matching
     */
    public static function normalizePath($path)
    {
        // Remove leading slash, convert to lowercase, normalize slashes
        $path = ltrim($path, '/');
        $path = strtolower($path);
        $path = str_replace('\\', '/', $path);
        return $path;
    }

    /**
     * Get alt text for an image URL or path
     */
    public static function getAltText($imageUrl)
    {
        // Extract path from URL
        $path = parse_url($imageUrl, PHP_URL_PATH);
        if (!$path) {
            $path = $imageUrl;
        }

        // Remove leading slash
        $path = ltrim($path, '/');

        // Normalize the path
        $normalized = self::normalizePath($path);

        // Try to find exact match
        $image = self::where('normalized_path', $normalized)->first();

        if ($image && $image->alt_text) {
            return $image->alt_text;
        }

        // Try to find by filename if full path doesn't match
        $fileName = basename($path);
        $image = self::where('file_name', $fileName)
            ->whereNotNull('alt_text')
            ->first();

        return $image ? $image->alt_text : null;
    }
}
