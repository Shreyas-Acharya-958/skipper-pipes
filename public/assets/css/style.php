<?php
header("Content-Type: text/css");
header("Cache-Control: public, max-age=2592000");

$basePath = __DIR__; // /css/

$cssFiles = [
    // 'font-awesome.min.css',
    'owl.carousel.min.css',
    'owl.theme.default.min.css',
    '../js/swiper/swiper.min.css', // from /css/ to /js/
    'magnific-popup.css',
    'bootsnav.css',
    'flaticon-set.css',
    'themify-icons.css',
    'sweetalert2.min.css'
];

$combined = '';

foreach ($cssFiles as $file) {
    $fullPath = realpath($basePath . '/' . $file);

    if ($fullPath && file_exists($fullPath)) {
        $combined .= file_get_contents($fullPath) . "\n";
    }
}
// Basic minification
$combined = preg_replace('!/\*.*?\*/!s', '', $combined);
$combined = preg_replace('/\s+/', ' ', $combined);

echo $combined;