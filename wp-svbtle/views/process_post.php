<?php

if (!function_exists(Markdown)) {
  require_once WPSVBTLE_PATH . "includes/markdown.php";
}

//ver de manejar mejor esto, con _wp_http_referer a lo mejor
$current_page   = "index.php?page=" . $_GET['page'];

if(!empty($_GET['id']) and ($_GET['action'] == 'del')) {
	
	if(!current_user_can('delete_posts')){
		die('You do not have sufficient permissions to access this page.');
	}
	
	$post_id = wp_delete_post( $_GET['id']);
	
	wp_redirect( 'index.php?page=dashboard' );
	exit;

// Si en cambio estoy en un nuevo post	
} elseif(isset($_POST['action']) && $_POST['action'] == 'post' && wp_verify_nonce($_POST['_wpnonce'],'new-post')) {
	if ( !is_user_logged_in() ){
		wp_redirect( get_bloginfo( 'url' ) . '/' );
		exit;
	};
	$err = "";
	$user_id 		= $current_user->user_id;
	$post_title 	= $_POST['post_title'];
	$post_content 	= $_POST['post_content'];
	$post_status 	= $_POST['post_status'];

	// $current_page   = $_POST['_wp_http_referer'];

	if ($post_title == "") {
		$err .= __('Please fill in Post Title field') . "<br />";
	}

	if ( $err == "" ) {
		
		if(!current_user_can('publish_posts')){
			die('You do not have sufficient permissions to access this page.');
		}
		
		
		$post_id = wp_insert_post( array(
			'post_author'	=> $user_id,
			'post_title'	=> $post_title,
			'post_content'	=> Markdown($post_content),
			'post_type'		=> "post",
			'post_status'	=> $post_status // Idea=>draft || Public=>publish
		) );

		add_post_meta($post_id, 'wp-svbtle-markdown', $post_content, true);

		$current_page .= (isset($post_id) ? "&id=" . $post_id : "");
		wp_redirect( $current_page . '&success=success' );
		exit;
	}
// Si en cambio es un edit
} elseif (isset($_GET['id'])) {
	// En caso de un submit de un edit
	if (isset($_POST['action']) && $_POST['action'] == 'edit' && wp_verify_nonce($_POST['_wpnonce'],'manage-post')) {
		
		
		$err = "";
		$post_id		= $_POST['id'];
		$post_title 	= $_POST['post_title'];
		$post_content 	= $_POST['post_content'];
		$post_status 	= $_POST['post_status'];

		if ($post_title == "") {
			$err .= __('Please fill in Post Title field') . "<br />";
		}

		if ( $err == "" ) {
			
			if(!current_user_can('edit_posts')){
				die('You do not have sufficient permissions to access this page.');
			}
			
			$post_id = wp_update_post( array(
				'ID'	=> $post_id,
				'post_title'	=> $post_title,
				'post_content'	=> Markdown($post_content),
				'post_status'	=> $post_status
			) );
		
			if (get_post_meta($post_id, 'wp-svbtle-markdown', true)) {
				update_post_meta($post_id, 'wp-svbtle-markdown', $post_content);
			}else {
				add_post_meta($post_id, 'wp-svbtle-markdown', $post_content, true);
			}
			
			$current_page .= "&id=" . $_GET['id'];
			wp_redirect( $current_page . '&edit=success' );
			exit;
		}
	// En caso de entrar a ver el post 
	} else {
		$err = "";

		$post = get_post($_GET['id']);

		$post_id 		= $post->ID;
		$post_title 	= $post->post_title;
		
		if (get_post_meta($post_id, 'wp-svbtle-markdown', true)) {
			$post_content = get_post_meta($post_id, 'wp-svbtle-markdown', true);
		}else {
			$post_content 	= $post->post_content;
		}

		$post_status 	= $post->post_status;
		
	}

} elseif (isset($_POST['action']) && $_POST['action'] == 'dashboard_submit' && wp_verify_nonce($_POST['_wpnonce'],'new-post')) {

	$user_id 		= $current_user->user_id;
	$post_title 	= $_POST['idea_title'];
	// $post_content 	= $_POST['post_content'];
	$post_status 	= 'draft';

	$post_id = wp_insert_post( array(
		'post_author'	=> $user_id,
		'post_title'	=> $post_title,
		// 'post_content'	=> $post_content,
		'post_type'		=> "post",
		'post_status'	=> $post_status // Idea=>draft || Public=>publish
	) );

	$current_page .= (isset($post_id) ? "&id=" . $post_id : "");
	wp_redirect( $current_page . '&success=success' );
	exit;

} else {
	$post_status = 'draft';
}

?>
