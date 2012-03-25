<?php
set_time_limit(0);
if (isset($_POST['action']) && $_POST['action'] == 'post' && wp_verify_nonce($_POST['_wpnonce'],'new-post')) {
	if ( !is_user_logged_in() ){
		wp_redirect( get_bloginfo( 'url' ) . '/' );
		exit;
	};
	$cat = array();
	$err = "";
	$user_id 		= $current_user->user_id;
	$post_title 	= $_POST['post_title'];
	$post_content 	= $_POST['post_content'];
	$cat[0]	 		= $_POST['cat'];
	$post_tags 		= $_POST['post_tags'];
	$current_page   = $_POST['_wp_http_referer'];

	if ($post_title == "") {
		$err .= __('Please fill in Post Title field') . "<br />";
	}
	if ( $cat[0] == "-1") {
		$err .= __('Please choose your Post Category') . "<br />";
	} else {
		global $wpdb;
		$cat_ids = (array) $wpdb->get_col("SELECT term_id FROM $wpdb->terms");
		if ( !in_array($cat[0], $cat_ids) && $cat != "-1") {
			$err .= __('This category doesn\'t exist') . "<br />";
		}
	}
	if ($post_content == "") {
		$err .= __('Please fill in Post Content field') . "<br />";
	}

	if ( $err == "" ) {
		$post_id = wp_insert_post( array(
			'post_author'	=> $user_id,
			'post_title'	=> $post_title,
			'post_content'	=> $post_content,
			'post_category'	=> $cat,
			'post_status'	=> 'publish',
			'tags_input'	=> $post_tags
		) );
		wp_redirect( $current_page . '?success=success' );
		exit;
	}
}
?>
