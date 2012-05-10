<?php

if (! function_exists(wp_svbtle_render)) {
	function wp_svbtle_render($p) {
		// available sections
		$pages = array(
			'dashboard',
			'edit'
		);

		if ( in_array($p, $pages) ) {
			require_once WPSVBTLE_PATH . "views/$p.php";
		}else {
			wp_redirect( $current_page . 'index.php?page=dashboard' );
		}
	}
}

?>