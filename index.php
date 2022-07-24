<?php
session_start();
require_once('config.php');

include_once('assets/php/functions.php');
include_once('assets/php/page_builder.php');
include_once('assets/php/debug_functions.php');

// create url array
$url_array 	= $_SERVER['REQUEST_URI'];
if ($_SERVER['HTTP_HOST'] == 'www.localhost') $url_array = str_replace('', '', $url_array);

$url_array 	= explode('/', $url_array);
foreach ($url_array as &$value) {
	$value = explode('?', $value)[0];
}

include("assets/php/process_form.php");
include("assets/php/redirects.php");


$page_info = get_page_info($url_array);
?>
<!DOCTYPE html>
<html lang="">
	<head>
		<?= $page_info['title'] ?>

		<!-- meta tags -->
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?= $page_info['metatags'] ?>

		<!-- stylesheets -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="<?= url('/assets/css/icons.css') ?>">
		<?php
		foreach ($page_info['files']['css'] as $path)
			echo '<link rel="stylesheet" href="'.url($path).'">';
		?>

		<!-- javascript -->
		<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous" async></script>
		<?php
		foreach ($page_info['files']['css'] as $path)
			echo '<script src="'.url($path).'" async defer></script>';
		?>

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