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
 * Definition of WP-SVBTLE path
 *
 */

if (! defined("ABSPATH")) {
	define("ABSPATH", dirname(dirname(__FILE__)) . "/");
}

define("WPSVBTLE_PATH", ABSPATH . "wp-svbtle/");

/* 
 * Runing application
 *
 */
require_once WPSVBTLE_PATH . "includes/wps-functions.php";

$page = $_GET['page'] ? $_GET['page'] : '';

if($page === '') {
	wp_redirect($current_page . '?page=dashboard');
}

wp_svbtle_render($page);


?>