<?php

// List of known pages from your frontend
$pages = [
    '/',
    '/company/overview',
    '/company/leadership',
    '/company/manufacturing',
    '/company/csr',
    '/company/certifications',
    '/why-skipper-pipes',
    '/products/upvc-pipes',
    '/products/cpvc-pipes',
    '/products/swr-pipes',
    '/products/agriculture-pipes',
    '/products/casing-pipes',
    '/products/column-pipes',
    '/products/ribbed-strainer-pipes',
    '/products/hdpe-pipes',
    '/products/marina-tank',
    '/network',
    '/partner/become-dealer',
    '/partner/become-distributor',
    '/careers',
    '/news',
    '/blogs',
    '/media',
    '/faqs',
    '/contact-us',
    '/disclaimer',
    '/privacy-policy',
    '/terms-conditions',
];

$uri = $_SERVER['REQUEST_URI'];
$path = parse_url($uri, PHP_URL_PATH);
$query = isset(parse_url($uri)['query']) ? ('?' . parse_url($uri)['query']) : '';

$lower = strtolower($path);

// Redirect only if uppercase exists AND lowercase exists in pages list
if ($path !== $lower && in_array($lower, $pages)) {
    header("Location: " . $lower . $query, true, 301);
    exit;
}