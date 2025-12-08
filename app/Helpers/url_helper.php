<?php

/**
 * URL Helper
 * 
 * This helper provides compatibility functions for CI3's url_helper
 * to ease migration to CI4.
 */

if (!function_exists('base_url')) {
    /**
     * Base URL
     *
     * Create a local URL based on your basepath.
     * Segments can be passed via the first parameter either as a string or an array.
     *
     * @param string|array $uri
     * @param string|null   $protocol
     *
     * @return string
     */
    function base_url($uri = '', ?string $protocol = null): string
    {
        // Get the base URL from config
        $config = config('App');
        $baseURL = $config->baseURL;
        
        // Remove trailing slash from base URL
        $baseURL = rtrim($baseURL, '/');
        
        // Remove leading slash from URI
        $uri = ltrim($uri, '/');
        
        // Combine and return
        return $baseURL . ($uri ? '/' . $uri : '');
    }
}

if (!function_exists('site_url')) {
    /**
     * Site URL
     *
     * Create a local URL based on your basepath.
     * Segments can be passed via the first parameter either as a string or an array.
     *
     * @param string|array $uri
     * @param string|null   $protocol
     *
     * @return string
     */
    function site_url($uri = '', ?string $protocol = null): string
    {
        return base_url($uri, $protocol);
    }
}

if (!function_exists('current_url')) {
    /**
     * Current URL
     *
     * Returns the full URL (including segments) of the page where this
     * function is placed
     *
     * @param bool $returnObject
     *
     * @return string|\CodeIgniter\HTTP\URI
     */
    function current_url(bool $returnObject = false)
    {
        $request = \Config\Services::request();
        
        if ($returnObject) {
            return $request->getUri();
        }
        
        return (string) $request->getUri();
    }
}


