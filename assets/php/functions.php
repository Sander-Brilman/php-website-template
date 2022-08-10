<?php
/**
 * A collection of all function declarations
 */

function redirect(string $url_from_root, bool $include_site_url = true): void
{
    /**
     * Redirect to a new page.
     * 
     * Used for easy redirecting.
     * 
     * @param string The path from the root website url.
     * 
     * @return void
     */
    global $site_url;
    $redirect = $include_site_url ? $site_url.$url_from_root : $url_from_root;
    header('location: '.$redirect);
    exit;
    return;
}

function url(string $path_from_root = ''): string
{
    /**
     * Creates a absolute path to a file or url.
     * 
     * Read purpose here:
     * @link https://github.com/Sander-Brilman/php-website-template#how-to-use--links-on-the-webpage-important
     * 
     * @param string
     * 
     * @return string the absolute path
     */
    global $site_url;
    if (substr($path_from_root, 0, 1) == '/') {$path_from_root = substr($path_from_root, 1);  }  
    if (substr($path_from_root, -1, 1) == '/') {$path_from_root = substr($path_from_root, 0, strlen($path_from_root) - 1);}

    return $site_url . $path_from_root;
}
?>