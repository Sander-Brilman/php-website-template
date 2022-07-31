<?php
function get_page_info(array $url_array = [])
{
	/**
	 * Returns a array with info for the page. Including what files to load and the SEO meta tags.
	 * Used to define scripts, files and meta tags that will be loaded for a page.
	 * 
	 * Read readme.md for more information on how to use.
	 *
	 * @param array The url array formatted inside index.php
	 *
	 * @return array Returns a associative with a array of file paths and the metatags.
	*/
	$php        = [];
	$css        = [];
	$js			= [];
	$meta_tags  = generate_meta_tags();
	$title      = generate_title();
	$no_index	= false;
	$page_info  = [
		'files' => [
			'php' => &$php,
			'css' => &$css,
			'js'  => &$js,
		],
		'metatags' => &$meta_tags,
		'title' => &$title,
	];

	// insert your pages here.
	switch ($url_array[0]) {
		case '':
			$php[] = 'home';
			break;

		default:
			$php[] = '404';
			$no_index = true;
			$title = generate_title('Unknown page');
			break;
	}

	// add the path and file extension
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

	if ($no_index) {
		$meta_tags = '<meta name="robots" content="noindex"/>';
	}

	return $page_info;
}

function generate_meta_tags(string $search_title = '', string $description = '', string $image_path = '', string $image_alt = '') {
	/**
	 * Generate the html meta tags with the given values.
	 * Meta tags will fill with default values if left empty. 
	 * 
	 * @param string Title for the page
	 * @param string Title search results
	 * @param string The description
	 * @param string The image path. If left empty it will pick the favicon.
	 * @param string The description for the image, 
	 * 
	 * @return string The html meta tags. 
	 */
	global $display_name;
	global $site_url;
	global $site_domain;
	global $theme_color;

	global $default_search_title;
	global $default_website_description;

	$search_title 	= $search_title == '' ? $default_search_title : $search_title;
	$description 	= $description 	== '' ? $default_website_description : $description;

	if ($image_path == '') {
		$image_path = $site_url.'favicon.ico';
		$image_alt  = $display_name.' Logo';
	}

	// title
	$meta_tags 	=  '<meta property="og:title" 	content="'.$search_title.'" />
					<meta name="twitter:title" 	content="'.$search_title.'" />';

	// description
	$meta_tags 	.= '<meta name="description"         content="'.$description.'">
					<meta property="og:description"  content="'.$description.'" />
					<meta name="twitter:description" content="'.$description.'" />';

	// image & alt text.
	$meta_tags 	.= '<meta property="og:image"  		content="'.$image_path.'" />
					<meta name="twitter:image" 		content="'.$image_path.'" />
					<meta property="og:image:alt" 	content="'.$image_alt.'"  />';

	// site name
	$meta_tags 	.= '<meta property="og:site_name" content="'.$site_domain.'" />';

	// Other
	$meta_tags 	.= '<meta property="og:locale" content="" />
					<meta property="og:type"   content="website" />
					<meta name="theme-color"   content="'.$theme_color.'" />';

	return $meta_tags;
}

function generate_title(string $title = '', bool $add_display_name = true)
{
	/**
	 * Generate the html title tag.
	 * If no value is given it will use the display name
	 * 
	 * @param string Title for the page
	 * @param bool Add a vertical + the display name to the title
	 * 
	 * @return string The html meta tags. 
	 */
	global $display_name;

	if ($title == '') {
		return "<title>$display_name</title>";
	}

	return '<title>' . $title . ($add_display_name ? " | $display_name" : '') . '</title>';
}
?>