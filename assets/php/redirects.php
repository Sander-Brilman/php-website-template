<?php
/**
 * =======================================================
 *              READ ON HOW TO USE THIS FILE
 * ========================================================
 * 
 * 
 * --------------------------------------------------------
 *                  How to: Set redirects
 * --------------------------------------------------------
 * - @link https://github.com/Sander-Brilman/php-website-template#how-to-use--set-redirects
 * 
 * 
 * 
 * --------------------------------------------------------
 *                  Full template guide:
 * --------------------------------------------------------
 * - @link https://github.com/Sander-Brilman/php-website-template#how-to-use
 */


// remove trailing '/' from url to improve SEO
if (end($url_array) == '') {
    $url            = str_replace($site_folder, '', $_SERVER['REQUEST_URI']);
    $param_location = strpos($url, '?');
    redirect(
    $param_location === false 
        ? substr($url,0,strlen($url)-1) 
        : substr($url,0,$param_location-1).substr($url,$param_location)
    );
}


?>