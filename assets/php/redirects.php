<?php
/**
 * A collection of all redirects on the site.
 */
function redirect(string $url)
{
    /**
     * Redirect to a new page.
     * 
     * @param string The path from the root website url.
     * 
     * @return void You will never reach this code anyways so it doesnt matter
     */
    global $site_url;
    header('location: '.$site_url.$url);
    exit;
    return;
}
?>