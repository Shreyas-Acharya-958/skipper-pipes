# Image Alt Text Management System

## Overview

This system provides a comprehensive solution for managing alternative text (alt text) for all images across your website. It automatically scans images from public directories, stores them in a database, and provides an admin interface for managing alt text.

## Features

-   ✅ Automatically scans all images from public directories (`public/assets`, `public/storage`, `public/images`)
-   ✅ Admin interface to manage alt text for all images
-   ✅ Helper function to automatically get alt text for any image URL
-   ✅ Search and filter capabilities
-   ✅ Bulk update functionality

## Setup Instructions

### 1. Run Migration

The migration has already been run. If you need to run it again:

```bash
php artisan migrate
```

### 2. Scan Images

Scan all images from public directories and add them to the database:

```bash
php artisan images:scan
```

To force re-scan of all images (updates existing entries):

```bash
php artisan images:scan --force
php artisan images:update-default-alt-text --force
```

### 3. Access Admin Interface

Navigate to: `http://yourwebsite.com/admin/image-alt-texts`

## Usage

### In Blade Templates

Use the helper function `image_alt_text()` to get alt text for any image:

```blade
{{-- Basic usage --}}
<img src="{{ asset('assets/img/logo.png') }}"
     alt="{{ image_alt_text('assets/img/logo.png', 'Default Alt Text') }}">

{{-- With fallback --}}
<img src="{{ $product->image }}"
     alt="{{ image_alt_text($product->image, $product->title) }}">

{{-- In a loop --}}
@foreach($images as $image)
    <img src="{{ asset($image->path) }}"
         alt="{{ image_alt_text($image->path, 'Image') }}">
@endforeach
```

### In PHP Code

```php
use App\Models\ImageAltText;

// Get alt text for an image
$altText = ImageAltText::getAltText('assets/img/logo.png');

// With fallback
$altText = ImageAltText::getAltText('assets/img/logo.png') ?? 'Default Alt Text';

// Or use the helper function
$altText = image_alt_text('assets/img/logo.png', 'Default Alt Text');
```

## Admin Interface

### Access

Go to: `/admin/image-alt-texts`

### Features

1. **Search**: Search by filename, path, directory, or alt text
2. **Filter**: Filter by directory or alt text status (with/without)
3. **Edit**: Click the save button next to each image to save individual alt text
4. **Bulk Update**: Edit multiple images and click "Save All Changes"
5. **Scan Images**: Click "Scan Images" to add new images to the database

### How It Works

1. The system normalizes image paths (removes leading slashes, converts to lowercase)
2. When you use `image_alt_text()` helper, it tries to match the image path
3. If exact match not found, it tries to match by filename
4. Returns the alt text if found, otherwise returns null (or fallback if provided)

## Example: Updating Existing Views

Replace hardcoded alt text with the helper function:

**Before:**

```blade
<img src="{{ asset('assets/img/logo.png') }}" alt="Company Logo">
```

**After:**

```blade
<img src="{{ asset('assets/img/logo.png') }}"
     alt="{{ image_alt_text('assets/img/logo.png', 'Company Logo') }}">
```

This way, if an admin updates the alt text in the admin panel, it will automatically be used everywhere the image appears.

## Command Reference

### Scan Images

```bash
# Scan and add new images
php artisan images:scan

# Force re-scan (updates existing entries)
php artisan images:scan --force
```

## Database Structure

The `image_alt_texts` table contains:

-   `id`: Primary key
-   `image_path`: Full path to image (e.g., `/assets/img/logo.png`)
-   `normalized_path`: Normalized path for matching (lowercase, normalized slashes)
-   `alt_text`: Alternative text (nullable)
-   `file_name`: Just the filename
-   `directory`: Directory path
-   `file_size`: File size in bytes
-   `created_at`, `updated_at`: Timestamps

## Notes

-   The system automatically handles different path formats (with/without leading slashes)
-   Paths are normalized for matching (case-insensitive)
-   If exact path match fails, it tries filename matching
-   Always provide a fallback value when using the helper function for better UX
