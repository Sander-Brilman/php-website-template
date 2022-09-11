<?php
/**
 * Settings for running the website for this specific device
 * 
 * 
 * 
 * --------------------------------------------------------
 *          How to: Set $site_folder variable
 * --------------------------------------------------------
 * - @link https://github.com/Sander-Brilman/php-website-template/releases/tag/v1.0.0#setup-guide--website-inside-a-folder-important
 * 
 * 
 * 
 * --------------------------------------------------------
 *                  Full setup guide:
 * --------------------------------------------------------
 * - @link https://github.com/Sander-Brilman/php-website-template/releases/tag/v1.0.0#setup-guide
 */

$site_folder = ''; // Don't forget the '/' at the start & end 



// Database variables
try {
	$host       = '';
	$db_name    = '';
	$user       = '';
	$password   = '';

	$db = new PDO('mysql:host='.$host.';dbname='.$db_name, $user, $password);
} catch (PDOException $e) { }
?>