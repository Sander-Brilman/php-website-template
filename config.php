<?php
/**
 * Settings and data used throughout the site.
 */

$debug_ips = [
    '::1',
];

$ssl                    = true;

$display_name           = '';
$site_domain            = ''; // dont forget to add extension like .com, www. is automatically added

$site_url = ($ssl ? 'https://' : 'http://') . 'www.' . $site_domain . '/';


// Will be used as title and description in case nothing is declared for that page

$default_website_title          = ''; // about 50 characters
$default_website_description    = ''; // about 160 characters


// Database 

$host       = '';
$db_name    = '';
$user       = '';
$password   = '';

$db = new PDO('mysql:host='.$host.';dbname='.$db_name, $user, $password);

?>