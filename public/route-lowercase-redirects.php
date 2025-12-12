<?php

// List of known static pages from your frontend
$staticPages = [
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
    '/jal-rakshak', // Added jal-rakshak
];

// Dynamic route patterns that should be lowercased
$dynamicRoutePatterns = [
    '/blogs/',           // Blog detail pages: /blogs/{slug}
    '/products/',        // Product detail pages: /products/{slug}
    '/partner/',         // Partner pages: /partner/{slug}
    '/company/',         // Company pages: /company/{slug}
];

$uri = $_SERVER['REQUEST_URI'];
$path = parse_url($uri, PHP_URL_PATH);
$query = isset(parse_url($uri)['query']) ? ('?' . parse_url($uri)['query']) : '';

$lower = strtolower($path);

// Check if path has uppercase characters
if ($path !== $lower) {
    $shouldRedirect = false;

    // Check if it's a static page
    if (in_array($lower, $staticPages)) {
        $shouldRedirect = true;
    }
    // Check if it matches a dynamic route pattern
    else {
        foreach ($dynamicRoutePatterns as $pattern) {
            if (stripos($path, $pattern) === 0) {
                $shouldRedirect = true;
                break;
            }
        }
    }

    // Perform redirect if needed
    if ($shouldRedirect) {
        header("Location: " . $lower . $query, true, 301);
        exit;
    }
}
