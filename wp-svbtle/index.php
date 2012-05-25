<?php

/* 
 * Including wp-functions
 *
 */

require_once(dirname(dirname(__FILE__)) . '/wp-blog-header.php');

/* 
 * Checking logued user
 *
 */
if (!is_user_logged_in()) { 
	auth_redirect(); 
}

if(!current_user_can('publish_posts') or !current_user_can('edit_posts')){
	die('You do not have sufficient permissions to access this page.');
}


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
	wp_redirect($current_page . 'index.php?page=dashboard');
}

wp_svbtle_render($page);


?>