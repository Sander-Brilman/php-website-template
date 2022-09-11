<?php
/**
 * A collection of all function declarations
 */

function url(string $path_from_root = ''): string
{
    /**
     * Creates a absolute url based on the config settings.
     * Automatically strips the leading & trailing '/' to improve SEO
     * 
     * Read purpose here:
     * @link https://github.com/Sander-Brilman/php-website-template/releases/tag/v1.0.0#how-to-use--links-on-the-webpage-important
     * 
     * @param string
     * 
     * @return string the absolute url
     */
    global $site_url;
    $path_array = explode('/', $path_from_root);

    // remove leading '/'
    if (substr($path_from_root, 0, 1) == '/') {$path_from_root = substr($path_from_root, 1);}  


    // remove trailing '/'
    if (end($path_array) === '') {
        $param_location = strpos($path_from_root, '?');
        $path_from_root = $param_location === false ? substr($path_from_root,0,strlen($path_from_root)-1) : substr($path_from_root,0,$param_location-1).substr($path_from_root,$param_location);    
    }

    return $site_url . $path_from_root;
}

function redirect(string $url_from_root, bool $use_url_function = true): void
{
    /**
     * Redirect to a new page.
     * 
     * Used for easy redirecting.
     * 
     * @param string The path from the root website url.
     * 
     * @param bool Run the entered value through the url function.
     * @param bool Redirect to the same page (to clear POST)
     * 
     * @return void
     */
    $redirect = $use_url_function ? url($url_from_root) : $url_from_root;

    header('location: '.$redirect);
    exit;
    return;
}

function refresh(): void
{
    /**
     * Refreshes the page clearing POST
     * 
     * @return void
     */
    global $site_folder;
    
    redirect(str_replace($site_folder, '', $_SERVER['REQUEST_URI']));
}

function set_form_id(string $form_name): string
{
    /**
     * Creates a unique verify code for a form.
     * This code is used to verify that the form is from this website.
     * 
     * Returns a hidden checkbox element with the id set.
     * 
     * Use the check_form_id function to check if that specific form has been submitted.
     * 
     * Purpose is to prevent Cross Site Request Forgery and identify forms.
     * 
     * Docs:
     * @link https://github.com/Sander-Brilman/php-website-template/releases/tag/v1.0.0#security-features--cross-site-request-forgery
     * 
     * @param string The name of the form. Must be unique. Pass the same value to the check_form_id function.
     * 
     * @return string The checkbox element with the name & verify code set.
     */
    $code = isset($_SESSION['forms'][$form_name])
        ? $_SESSION['forms'][$form_name]
        : bin2hex(random_bytes(5));

    $_SESSION['forms'][$form_name] = $code;

    return '<input style="display: none;" type="checkbox" name="'.$form_name.'" value="'.$code.'" checked hidden>';
}

function check_form_id(string $form_name): bool
{
    /**
     * Checks if there has been a form submitted with the given name.
     * Returns true if it contains the same name & verify code
     * 
     * How to use:
     * @link https://github.com/Sander-Brilman/php-website-template/releases/tag/v1.0.0#security-features--cross-site-request-forgery
     * 
     * @param string The name of the form you want to check for submission
     * 
     * @return bool
     */
    return (
        isset($_POST[$form_name]) &&
        isset($_SESSION['forms'][$form_name]) &&
        $_POST[$form_name] === $_SESSION['forms'][$form_name]
    );
}

function safe_echo(string $string): void
{
    /**
     * Easy to use function that prevents XSS.
     * 
     * Docs:
     * @link https://github.com/Sander-Brilman/php-website-template/releases/tag/v1.0.0#security-features--cross-site-request-forgery
     * 
     * @param string The string to echo
     * @return void
     */
    echo htmlspecialchars($string);
}
?>