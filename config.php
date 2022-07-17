<?php
$debug_ips = [
    '::1',
];

$ssl                    = true;

$display_name           = '';
$site_domain            = ''; // dont forget to add extension like .com

$site_url = ($ssl ? 'https://' : 'http://') . 'www.' . $site_domain . '/';


$default_website_title          = ''; // about 50 characters
$default_website_description    = ''; // about 160 characters


// Database 

$host       = '';
$db_name    = '';
$user       = '';
$password   = '';

$db = new PDO('mysql:host='.$host.';dbname='.$db_name, $user, $password);

?>