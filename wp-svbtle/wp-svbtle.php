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
require_once(dirname(dirname(__FILE__)) . '/wp-config.php');
require_once(dirname(dirname(__FILE__)) . '/wp-blog-header.php');

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

define("WPSUBTLE_PATH", ABSPATH . "wp-svbtle/");

/* 
 * Runing application
 *
 */
$page = $_GET['page'] ? $_GET['page'] : '';

if($page === '') {
	wp_redirect($current_page . '?page=dashboard');
}

// require_once(ABSPATH . 'wp-subtle/wp-subtle.php');
if (! function_exists(wp_subtle_render)) {
	function wp_subtle_render($p) {
		// available sections
		$sections = array(
			'dashboard',
			'new_post',
			'edit_post'
		);

		if (in_array($p,$sections)) {
			// echo file_get_contents("views/test.php");
			require_once WPSUBTLE_PATH . "views/$p.php";
		}else {
			wp_redirect( $current_page . '?page=dashboard' );
		}
	}
}

wp_subtle_render($page);


 ?>