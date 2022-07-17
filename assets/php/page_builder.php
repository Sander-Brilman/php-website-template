<?php
function get_page_info(array $url_array = [])
{
	/**
	 * Returns a data array with info for the page. Including what files to load and the meta tags.
	 * Used to define scripts, files and meta tags that will be loaded for a page.
	 * 
	 * Files are stored as relative paths from the root, the types of files are:
	 * - css
	 * - js (javascript)
	 * - php
	 *
	 * To add files you add the filename to the right variable.
	 * To add set the metatags overwrite the meta_tags variable.
	 *
	 * Files will automatically get a file extensions at the end of the function.
	 *
	 * =============== File path info ===============
	 *
	 * CSS and JavaScript files will automatically include the path to the assets folder.
	 *
	 * PHP will automatically include the path to the pages folder.
	 * To include a block add the 'blocks/' path to the beginning of the filename.
	 *
	 * ==============================================
	 *
	 * @param array The url array formatted inside index.php
	 *
	 * @return array Returns a associative with a array of file paths and the metatags.
	*/
	$php        = [];
	$css        = [];
	$js			= [];
	$meta_tags  = '';
	$page_info = [
		'files' => [
			'php' => &$php,
			'css' => &$css,
			'js'  => &$js,
		],
		'metatags' => &$meta_tags,
	];

	switch ($url_array[0]) {
		case '':
			$php[] = 'home';
			break;

		default:
			$php[] = '404';
			$meta_tags = generate_meta_tags('Requested page not found', 'The page you requested is currently not available...');
			break;
	}

	foreach ($page_info['files'] as $file_extension => &$names) {

		foreach ($names as &$name) {
			if (strpos($name, ".$file_extension") === false) {
				$name .= ".$file_extension";
			}

			switch ($file_extension) {
				case 'php':
					$name = 'pages/'.$name;
					break;
				case 'css':
					$name = 'assets/css/'.$name;
					break;
				case 'js':
					$name = 'assets/js/'.$name;
					break;
			}
		}
	}

	return $page_info;
}

function generate_meta_tags(string $title = '', string $description = '', string $image_path = '', string $image_alt = '') {
	/**
	 * Generate the html meta tags with the given values
	 * 
	 * @param string Title tag
	 * @param string The description
	 * @param string The image path. If left empty it will pick the favicon.
	 * @param string The description for the image, 
	 * 
	 * @return string The html meta tags. 
	 */
	global $display_name;
	global $site_url;
	global $site_domain;

	global $default_website_title;
	global $default_website_description;

	$title 			= $title 		== '' ? "$default_website_title | $display_name" : $title;
	$description 	= $description 	== '' ? $default_website_description : $description;

	if ($image_path == '') {
		$image_path = $site_url.'favicon.ico';
		$image_alt  = $display_name.' Logo';
	}


	// title & description
	$meta_tags 	=  '<title>'.$title.'</title>
					<meta property="og:title" 	content="'.$title.'" />
					<meta name="twitter:title" 	content="'.$title.'" />';

	$meta_tags 	.= '<meta property="og:description"  content="'.$description.'" />
					<meta name="twitter:description" content="'.$description.'" />';


	// image & alt text.
	$meta_tags 	.= '<meta property="og:image"  		content="'.$image_path.'" />
					<meta name="twitter:image" 		content="'.$image_path.'" />
					<meta property="og:image:alt" 	content="'.$image_alt.'"  />';


	// Other
	$meta_tags 	.= '<meta property="og:locale" content="nl_NL" />
					<meta property="og:type"   content="website" />';

	$meta_tags 	.= '<meta property="og:site_name" content="'.$site_domain.'" />';

	return $meta_tags;
}

?>

