<?php
session_start();
require_once('local_config.php');
require_once('global_config.php');

include_once('assets/php/debug_functions.php');
include_once('assets/php/functions.php');
include_once('assets/php/page_builder.php');

include("assets/php/process_form.php");
include("assets/php/redirects.php");

unset($_SESSION['forms']);

$page_info = get_page_info($url_array);

$css_vars = "
--theme-color: $theme_color;
";
?>
<!DOCTYPE html>
<html lang="<?= explode('_', $locate)[0] ?>" style="<?= $css_vars ?>">
	<head>
        <!-- title -->
		<?= $page_info['title'] ?>


		<!-- meta tags -->
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?= $page_info['metatags'] ?>


        <!-- canonical url's -->
        <?= $page_info['canonical_url'] ?>


		<!-- stylesheets -->
		<link rel="stylesheet" href="<?= url('/assets/css/icons.css') ?>">
		<?php
		foreach ($page_info['files']['css'] as $path)
			echo '<link rel="stylesheet" href="'.url($path).'">';
		?>


		<!-- javascript -->
		<?php
		foreach ($page_info['files']['js'] as $path)
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