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
 * - @link https://github.com/Sander-Brilman/php-website-template/releases/tag/v1.0.0#how-to-use--set-redirects
 * 
 * 
 * 
 * --------------------------------------------------------
 *                  Full template guide:
 * --------------------------------------------------------
 * - @link https://github.com/Sander-Brilman/php-website-template/releases/tag/v1.0.0#how-to-use
 */

// remove trailing '/' from url to improve SEO
if (end($url_array) == '' && str_replace($site_folder, '', $_SERVER['REQUEST_URI']) !== '') {
    refresh();
}
?>