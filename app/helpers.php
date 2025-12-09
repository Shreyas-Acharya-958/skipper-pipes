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
        return \App\Models\ImageAltText::getAltText($imageUrl) ?? $fallback;
    }
}

