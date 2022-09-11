<?php
/**
 * ========================================================
 *              READ ON HOW TO USE THIS FILE
 * ========================================================
 * 
 * 
 * --------------------------------------------------------
 *                  How to: Define pages
 * --------------------------------------------------------
 * - @link https://github.com/Sander-Brilman/php-website-template#how-to-use--set-pages-in-page_builder
 * 
 * 
 * 
 * --------------------------------------------------------
 *              How to: Define title & meta tags:
 * --------------------------------------------------------
 * - @link https://github.com/Sander-Brilman/php-website-template#how-to-use--title-and-metatags-in-pages
 * 
 * 
 * 
 * -------------------------------------------------------
 *                  How to: Canonical urls
 * -------------------------------------------------------
 * - @link https://github.com/Sander-Brilman/php-website-template#how-to-use--canonical-urls
 * 
 * 
 * 
 * --------------------------------------------------------
 *                  Full template guide:
 * --------------------------------------------------------
 * - @link https://github.com/Sander-Brilman/php-website-template#how-to-use
 */

function get_page_info(array $url_array = []): array
{
	/**
	 * Returns a array with info and html tags for loading the page.
     * Including what files to load and the SEO (meta) tags.
     * 
	 * Used to define pages for the website.
     * 
     * 
     * -------------------------------------
     *         READ HERE HOW TO USE
     * -------------------------------------
     * @link https://github.com/Sander-Brilman/php-website-template#how-to-use--title-and-metatags-in-pages
     * 
     * 
	 *
	 * @param array The url array formatted inside config.php
	 *
	 * @return array Returns a associative with a array of file paths and the metatags.
	*/
	$php = [];
	$css = [];
	$js  = [];

    $canonical_url = generate_canonical_url();
	$meta_tags     = generate_meta_tags();
	$title         = generate_title();

	$indexing	   = true;

	$page_info  = [
		'files' => [
			'php' => &$php,
			'css' => &$css,
			'js'  => &$js,
		],
        'canonical_url' => &$canonical_url,
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
			$indexing = false;
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
                
                case 'js':
				case 'css':
					$name = 'assets/'.$file_extension.'/'.$name;
					break;
			}
		}
	}

	if ($indexing) {
		$meta_tags .= '<meta name="robots" content="noindex"/>';
	}

	return $page_info;
}

function generate_meta_tags(string $search_title = '', string $description = '', string $path_from_root = '', string $image_alt = ''): string
{
	/**
	 * Generate the html meta tags with the given values.
	 * Meta tags will fill with default values if left empty. 
     * 
     * Used inside the get_page_info function
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
	global $theme_color;
    global $locate;

	global $default_seo_title;
	global $default_seo_description;
	global $logo_path;

	$search_title 	= $search_title == '' ? $default_seo_title : $search_title;
	$description 	= $description 	== '' ? $default_seo_description : $description;

	if ($path_from_root == '') {
		$path_from_root = $logo_path;
	}

	// title
	$meta_tags 	=  '<meta name="title" 	        content="'.$search_title.'" />
                    <meta property="og:title" 	content="'.$search_title.'" />
					<meta name="twitter:title" 	content="'.$search_title.'" />';

	// description
	$meta_tags 	.= '<meta name="description"         content="'.$description.'">
					<meta property="og:description"  content="'.$description.'" />
					<meta name="twitter:description" content="'.$description.'" />';

	// image & alt text.
	$meta_tags 	.= '<meta property="og:image"  		content="'.url($path_from_root).'" />
					<meta name="twitter:image" 		content="'.url($path_from_root).'" />
					<meta property="og:image:alt" 	content="'.$image_alt.'"  />';

	// site name
	$meta_tags 	.= '<meta property="og:site_name" content="'.$display_name.'" />';

	// Other
	$meta_tags 	.= '<meta property="og:locale" content="'.$locate.'" />
					<meta property="og:type"   content="website" />
					<meta name="theme-color"   content="'.$theme_color.'" />';

    // Apple IOS icon
    $meta_tags  .= '<link rel="apple-touch-icon" href="'.url($path_from_root).'">
                    <link rel="apple-touch-startup-image" href="'.url($path_from_root).'">';


	return $meta_tags;
}

function generate_title(string $title = '', bool $add_display_name = true): string
{
	/**
	 * Generate the html title tag.
	 * If no value is given it will use the display name
     * 
     * Used inside the get_page_info function
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

function generate_canonical_url(string $page_url = '', bool $use_url_function = true): string
{
    /**
     * Sets the canonical url tags.
     * By default it will use the current url without parameters or # to avoid search engines seeing it as duplicated content
     * 
     * If value is empty and there are no parameters it will return a empty string
     * 
     * @param string the canonical page url. Gets automatically inserted in the url function
     * 
     * @param bool Set to false to prevent the value automatically inserting in the url function
     * 
     * @param string the link & meta tags with the canonical url 
     */
    global $site_url;
    global $url_array;

    if ($page_url == '') {
        $stripped_page_url = substr($site_url, 0, strlen($site_url) - 1);

        foreach ($url_array as $item) $stripped_page_url .=  '/'.$item;

        $page_url = $stripped_page_url;
    }

    $page_url = $use_url_function ? url($page_url) : $page_url;

    return '<link rel="canonical" href="'.$page_url.'">
            <meta property="og:url" content="'.$page_url.'" />';
}
?>