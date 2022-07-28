<?php
/**
 * Settings and data used throughout the site.
 * 
 * Setup guide:
 * 
 * ==================================== Variables ====================================
 *  
 * $debug_ips -> ip adresses in this array can view dumps and ip checks in the code.
 * ___________________________________________________________________________________
 * 
 * $display_name -> The name of the company or organisation
 * ___________________________________________________________________________________
 * 
 * $site_domain -> The domain of the website like 'example.com'. dont forget to add extension like '.com', the 'www' is automatically added.
 * If the website is inside a folder like 'example.com/my-website/' add that path aswell WITHOUT the '/' at the end.
 * ___________________________________________________________________________________
 * 
 * $theme_color -> The css color notation of the website theme color
 * ___________________________________________________________________________________
 * 
 * $default_search_title -> The default title that will show up in search results if there is no title set for that page.
 * ___________________________________________________________________________________
 * 
 * $default_website_description -> The default website description 
 * that will show up in search results if there is no description set for that page.
 * 
 * 
 * 
 * 
 * =================================== Dont Forget! ===================================
 *
 * A list of things to cofigure that are not in this file.
 * 
 * ____________________________________________________________________________________
 * 
 * assets/php/page_builder.php -> Set the og:locale meta tag to the correct country value. ('nl_NL' for example)\
 * For a complete list see https://www.science.co.il/language/Locale-codes.php
 * _____________________________________________________________________________________
 * 
 * index.php -> Set the lang tag in the html element
 * _____________________________________________________________________________________
 * 
 * favicon.ico -> Replace this with your own website logo (must be .ico file)
 * _____________________________________________________________________________________
 */
$debug_ips = [
    '::1',
];

$ssl                    = true;

$display_name           = '';
$site_domain            = '';

$theme_color            = '';

$site_url = ($ssl ? 'https://' : 'http://') . 'www.' . $site_domain . '/';


// Will be used as title and description in case nothing is declared for that page

$default_search_title           = ''; // about 50 characters
$default_website_description    = ''; // about 160 characters


// Database 

$host       = '';
$db_name    = '';
$user       = '';
$password   = '';

$db = new PDO('mysql:host='.$host.';dbname='.$db_name, $user, $password);

?>