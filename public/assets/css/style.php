<?php
/**
 * style.php - serves concatenated vendor CSS.
 *
 * Usage:
 *   /css/style.php                       -> everything (same as the old behaviour)
 *   /css/style.php?g=core&v=2026102401   -> only the 'core' group
 *
 * - Builds each group once and stores it in css/.cache/ (rebuilds when a source file changes)
 * - Sends ETag / Last-Modified and answers 304 without reading any CSS
 * - With ?v= in the URL: cached for 1 year (immutable). Without ?v=: 1 hour + revalidate,
 *   so a forgotten version number can never trap users on stale CSS for months.
 */

$base = __DIR__; // /css/

// Move files between groups to match what each page really needs.
$groups = [
    'core'   => ['bootsnav.css', 'flaticon-set.css', 'themify-icons.css'],
    'swiper' => ['../js/swiper/swiper.min.css'],
    'owl'    => ['owl.carousel.min.css', 'owl.theme.default.min.css'],
    'popup'  => ['magnific-popup.css'],
    'alert'  => ['sweetalert2.min.css'],
    // 'all' keeps the ORIGINAL file order so the cascade is unchanged.
    'all'    => [
        'owl.carousel.min.css',
        'owl.theme.default.min.css',
        '../js/swiper/swiper.min.css',
        'magnific-popup.css',
        'bootsnav.css',
        'flaticon-set.css',
        'themify-icons.css',
        'sweetalert2.min.css',
    ],
];

$name = $_GET['g'] ?? 'all';
if (!is_string($name) || !isset($groups[$name])) { // whitelist: no user-controlled paths
    http_response_code(404);
    exit;
}

$paths = [];
$mtime = 0;
foreach ($groups[$name] as $file) {
    $p = realpath($base . '/' . $file);
    if ($p && is_file($p)) {
        $paths[] = $p;
        $mtime = max($mtime, filemtime($p));
    }
}

$etag = '"' . md5($name . '|' . $mtime . '|' . count($paths)) . '"';
$cacheControl = isset($_GET['v'])
    ? 'public, max-age=31536000, immutable'
    : 'public, max-age=3600, must-revalidate';

header('Content-Type: text/css; charset=utf-8');
header('Cache-Control: ' . $cacheControl);
header('ETag: ' . $etag);
header('Last-Modified: ' . gmdate('D, d M Y H:i:s', $mtime) . ' GMT');
header('Vary: Accept-Encoding');

if (($_SERVER['HTTP_IF_NONE_MATCH'] ?? '') === $etag) {
    http_response_code(304);
    exit;
}

$cacheDir  = $base . '/.cache';
$cacheFile = $cacheDir . '/style-' . $name . '-' . $mtime . '.css';

if (is_file($cacheFile)) {
    readfile($cacheFile);
    exit;
}

$css = '';
foreach ($paths as $p) {
    $css .= file_get_contents($p) . "\n";
}
// Basic minification (same as before) + drop repeated @charset rules
$css = preg_replace('!/\*.*?\*/!s', '', $css);
$css = preg_replace('/@charset\s+"[^"]*"\s*;/i', '', $css);
$css = preg_replace('/\s+/', ' ', $css);

// Store the result; if the folder isn't writable just serve it directly.
if (is_dir($cacheDir) || @mkdir($cacheDir, 0755, true)) {
    $tmp = @tempnam($cacheDir, 'css');
    if ($tmp && @file_put_contents($tmp, $css) !== false) {
        @chmod($tmp, 0644);
        if (@rename($tmp, $cacheFile)) {
            foreach (glob($cacheDir . '/style-' . $name . '-*.css') ?: [] as $old) {
                if ($old !== $cacheFile) {
                    @unlink($old); // remove stale builds
                }
            }
        }
    }
}

echo $css;