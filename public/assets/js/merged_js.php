<?php 

$cacheFile = __DIR__ . '/merged.js';

header('Content-Type: application/javascript');
header("Cache-Control: public, max-age=2592000");

// If already built → serve instantly
if (file_exists($cacheFile)) {
    readfile($cacheFile);
    exit;
}

// Build only once
$files = [
    __DIR__ . '/jquery.min.js',
    __DIR__ . '/popper.min.js',
    __DIR__ . '/bootstrap.min.js',
    __DIR__ . '/jquery.magnific-popup.min.js',
    __DIR__ . '/owl.carousel.min.js'
];

$output = '';

foreach ($files as $file) {
    if (!file_exists($file)) {
        continue;
    }
    $output .= file_get_contents($file) . "\n";
}

// Save merged file
file_put_contents($cacheFile, $output);

// Output once
echo $output;