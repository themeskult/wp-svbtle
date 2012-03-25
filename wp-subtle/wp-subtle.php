<?php
/*
 * 
 *
 *
 *
 */

/* 
 * Including wp-functions
 *
 */
require_once(dirname(dirname(__FILE__)) . '/wp-load.php');

/* 
 * Checking logued user
 *
 */
if (!is_user_logged_in()) { auth_redirect(); }

/* 
 * Definition of WP-SUBTLE path
 *
 */

if (! defined("ABSPATH")) {
	define("ABSPATH", dirname(dirname(__FILE__)) . "/");
}

define("WPSUBTLE_PATH", ABSPATH . "wp-subtle/");

/* 
 * Runing application
 *
 */

// require_once(ABSPATH . 'wp-subtle/wp-subtle.php');
if (! function_exists(wp_subtle_render)) {
	function wp_subtle_render($page) {
		// echo file_get_contents("views/test.php");
		require_once WPSUBTLE_PATH . "views/test_newpost.php";
	}
}

wp_subtle_render('dashboard');


 ?>