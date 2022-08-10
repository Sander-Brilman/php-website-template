<?php
/**
 * =======================================================
 *              READ ON HOW TO USE THIS FILE
 * ========================================================
 * 
 * 
 * --------------------------------------------------------
 *          How to: Set required values (Important!)
 * --------------------------------------------------------
 * - @link https://github.com/Sander-Brilman/php-website-template#setup-guide--required-values-important
 * 
 * 
 * 
 * --------------------------------------------------------
 *              How to: Set Optional values
 * --------------------------------------------------------
 * - @link https://github.com/Sander-Brilman/php-website-template#setup-guide--optional-values
 * 
 * 
 * 
 * --------------------------------------------------------
 *                  Full setup guide:
 * --------------------------------------------------------
 * - @link https://github.com/Sander-Brilman/php-website-template#setup-guide
 */

$debug_ips = [
	'::1',
];

$display_name           = '';
$site_domain            = '';
$site_folder            = ''; // Don't forget the '/' at the start & end 

$theme_color            = ''; // css color notation
$locate                 = ''; // language_TERRITORY format (nl_NL or en_US for example)

$default_search_title           = ''; // about 50 characters
$default_website_description    = ''; // about 160 characters


// Database variables
try {
	$host       = '';
	$db_name    = '';
	$user       = '';
	$password   = '';

	$db = new PDO('mysql:host='.$host.';dbname='.$db_name, $user, $password);
} catch (PDOException $e) { }


/*
 * ===========================================================
 *             Don't change anything below
 * ===========================================================
*/

$site_url = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
$site_url .= 'www.';
$site_url .= $site_domain . $site_folder;

$url_array 	= $_SERVER['REQUEST_URI'];
$url_array  = str_replace($site_folder, '', $url_array);
$url_array 	= explode('/', $url_array);

foreach ($url_array as &$value) {
	$value = explode('?', $value)[0];
}
?>