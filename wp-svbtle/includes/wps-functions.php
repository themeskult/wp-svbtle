<?php

if (! function_exists(wp_svbtle_render)) {
	function wp_svbtle_render($p) {
		// available sections
		$pages = array(
			'dashboard',
			'new_post',
			'edit_post'
		);

		if ( in_array($p, $pages) ) {
			require_once WPSVBTLE_PATH . "views/$p.php";
		}else {
			wp_redirect( $current_page . '?page=dashboard' );
		}
	}
}

?>