<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForceLowercaseUrls
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Commented out - lowercase redirect now handled by nginx
        // $uri = $request->getRequestUri();
        // $path = parse_url($uri, PHP_URL_PATH);
        // $query = parse_url($uri, PHP_URL_QUERY);

        // // Convert path to lowercase
        // $lowercasePath = mb_strtolower($path, 'UTF-8');

        // // Check if the path contains uppercase letters
        // if ($path !== $lowercasePath) {
        //     // Build the lowercase URL
        //     $url = $lowercasePath;

        //     // Append query string if present
        //     if ($query) {
        //         $url .= '?' . $query;
        //     }

        //     // Redirect to lowercase URL with 301 (permanent redirect for SEO)
        //     return redirect($url, 301);
        // }

        return $next($request);
    }
}