<?php
session_start();
require_once('config.php');

include_once('assets/php/page_builder.php');
include_once('assets/php/debug_functions.php');

include("assets/php/process_post.php");


// create url array
$url_array 	= $_SERVER['REQUEST_URI'];
if ($_SERVER['HTTP_HOST'] == 'www.localhost') $url_array = str_replace('/bedandbreakfasttwente/', '', $url_array);

$url_array 	= explode('/', $url_array);
foreach ($url_array as &$value) {
	$value = explode('?', $value)[0];
}


$page_info = get_page_info($url_array);
?>
<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?= $page_info['metatags'] ?>

		<link rel="stylesheet" href="assets/css/icons.css">
		<link rel="stylesheet" href="assets/css/basic_style.css">
		<link rel="stylesheet" href="assets/css/basic_responsive.css">

		<?php
        // stylesheets
        foreach ($page_info['files']['css'] as $path) {
            echo '<link rel="stylesheet" href="'.$path.'">';
        }

		// javascript
        foreach ($page_info['files']['css'] as $path) {
		    echo '<script src="'.$path.'" defer></script>';
        }
		?>

		<script src="assets/js/jQuery.js"></script>
	</head>

	<body>
		<?php
		include('pages/blocks/header.php');

        foreach ($page_info['files']['php'] as $path) {
			include($path);
		}

		include('pages/blocks/footer.php');
		?>
	</body>
</html>