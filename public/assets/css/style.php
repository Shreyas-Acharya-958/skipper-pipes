<?php
header("Content-Type: text/css");
header("Cache-Control: public, max-age=2592000");

$cssFiles = [
    'font-awesome.min.css',
    // 'animate.css',
    'owl.carousel.min.css',
    'owl.theme.default.min.css',
    'swiper.min.css',
    'magnific-popup.css',
    'bootsnav.css',
    // 'responsive.css',
    'flaticon-set.css',
    'themify-icons.css',
    'sweetalert2.min.css'
];

$combined = '';
foreach ($cssFiles as $file) {
    if (file_exists(__DIR__ . '/' . $file)) {
        $combined .= file_get_contents(__DIR__ . '/' . $file);
    }
}

// Basic minification
$combined = preg_replace('!/\*.*?\*/!s', '', $combined);
$combined = preg_replace('/\s+/', ' ', $combined);

echo $combined;