<?php
/**
 * Settings and data used throughout the site.
 * 
 */
$debug_ips = [
    '::1',
];

$ssl                    = true;

$display_name           = '';
$site_domain            = '';

$theme_color            = '';
$site_url = ($ssl ? 'https://' : 'http://') . 'www.' . $site_domain . '/';

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
?>