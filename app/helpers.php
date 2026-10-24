<?php

if (!function_exists('image_alt_text')) {
    /**
     * Get alt text for an image URL or path
     * 
     * @param string $imageUrl The image URL or path
     * @param string|null $fallback Fallback text if alt text not found
     * @return string|null
     */
    function image_alt_text($imageUrl, $fallback = null)
    {
        if (!request()->routeIs('front.home', 'front.products.show')) {
            return Cache::rememberForever('image_alt_texts_map', fn () =>
                \App\Models\ImageAltText::getAltText($imageUrl) ?? $fallback
            );
        }

        $imagePath = parse_url($imageUrl, PHP_URL_PATH) ?: $imageUrl;
        $imagePath = ltrim($imagePath, '/');
        $normalizedPath = \App\Models\ImageAltText::normalizePath($imagePath);
        $fileName = strtolower(basename($imagePath));

        $imageAltTexts = \App\Support\SiteCache::remember('image_alt_texts_map', 604800, function () {
            return \App\Models\ImageAltText::query()
                ->get(['normalized_path', 'file_name', 'alt_text'])
                ->toArray();
        });

        foreach ($imageAltTexts as $image) {
            if (($image['normalized_path'] ?? null) === $normalizedPath && !empty($image['alt_text'])) {
                return $image['alt_text'];
            }
        }

        foreach ($imageAltTexts as $image) {
            if (strtolower($image['file_name'] ?? '') === $fileName && !empty($image['alt_text'])) {
                return $image['alt_text'];
            }
        }

        return $fallback;
    }
}

