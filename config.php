<?php
/**
 * Settings and data used throughout the site.
 * How to use -> https://github.com/Sander-Brilman/php-website-template#setup-guide
 */
$debug_ips = [
	'::1',
];

$display_name           = '';
$site_domain            = '';
$site_folder            = ''; // Dont forget the '/' at the start & end

$theme_color            = ''; // css color notation

$default_search_title           = ''; // about 50 characters
$default_website_description    = ''; // about 160 characters


try {
	// Database variables
	$host       = '';
	$db_name    = '';
	$user       = '';
	$password   = '';

	$db = new PDO('mysql:host='.$host.';dbname='.$db_name, $user, $password);
} catch (PDOException $e) { }



// _______________Dont change this_______________

$site_url = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
$site_url .= 'www.';
$site_url .= $site_domain . $site_folder;

?>