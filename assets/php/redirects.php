<?php
/**
 * A collection of all redirects on the site.
 * 
 * ---------------------------------
 * Hint: use the redirect function.
 * ---------------------------------
 */

if ($url_array[0] == 'search' && !isset($_GET['order'])) {
    redirect('redirect_url_from_root');
}

?>