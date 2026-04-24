<?php
header('Content-Type: application/javascript');

$files = [
    'jquery.min.js',
    'popper.min.js',
    'bootstrap.min.js',
    'jquery.magnific-popup.min.js',
    'owl.carousel.min.js'
];

foreach ($files as $file) {
    if (file_exists($file)) {
        echo file_get_contents($file) . "\n";
    }
}