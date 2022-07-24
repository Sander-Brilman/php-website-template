<?php
/**
 * A collection of all function declarations
 */
function redirect(string $url_from_root)
{
    /**
     * Redirect to a new page.
     * 
     * @param string The path from the root website url.
     * 
     * @return void
     */
    global $site_url;
    header('location: '.$site_url.$url_from_root);
    exit;
    return;
}

function url(string $path_from_root)
{
    /**
     * Creates a absolute path to a file or url.
     * 
     * @param string
     * 
     * @return string the absolute path
     */
    global $site_url;
    return $site_url . $path_from_root;
}
?>