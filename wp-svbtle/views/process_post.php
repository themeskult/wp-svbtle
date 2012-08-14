<?php
global $current_user;
get_currentuserinfo();

require_once WPSVBTLE_PATH . "includes/markdown.php";

//ver de manejar mejor esto, con _wp_http_referer a lo mejor
$current_page   = "index.php?page=" . $_GET['page'];

function wp_svbtle_security(){
	// Security
	if ( !is_user_logged_in() ){
		wp_redirect( get_bloginfo( 'url' ) . '/' );
		exit;
	};

}

if(!empty($_GET['id']) and isset($_GET['action']) and ($_GET['action'] == 'del')) {
	
	wp_svbtle_security();
	if(!current_user_can('delete_posts')){
		die('You do not have sufficient permissions to access this page.');
	}
	
	$post_id = wp_delete_post( $_GET['id']);
	
	wp_redirect( 'index.php?page=dashboard' );
	exit;

// Si en cambio estoy en un nuevo post	
}elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	$err = "";
	// UPDATE OR EDIT

	wp_svbtle_security();
	if(!current_user_can('publish_posts')){
		die('You do not have sufficient permissions to access this page.');
	}
	
	// Validation
	if (isset($_POST['post_title']) and ($_POST['post_title'] == "")) {
		$err .= __('Please fill in Post Title field') . "<br />";
		$post_title = "";
		$post_content = "";
	}
	
	if (isset($err) and $err == "" ) {
		
		$post_status = 'draft';
		

		
		if (isset($_POST['post_status']))
				$post_status 	= $_POST['post_status'];
		
		// If it's a new idea, use that title. Then escape quotes.
		$post_title = $_POST['idea_title'] ? $_POST['idea_title'] : $_POST['post_title'] ;
		$post_title = htmlentities($post_title, ENT_QUOTES, 'UTF-8');
	
		$post =	array(
				'ID'	=> $_POST['id'],
				'post_title'	=> $post_title,
				'post_content'	=> Markdown($_POST['post_content']),
				'post_status'	=> $_POST['post_status']
		);

		
		if ($_GET['id']) {
			wp_update_post($post);
			update_post_meta( $_POST['id'], 'wp-svbtle-markdown', $_POST['post_content']);
			if (!empty($_POST['external_url']))
				update_post_meta( $_POST['id'], '_wp_svbtle_external_url', $_POST['external_url']);
			$post_id = $_POST['id'];
		}else {
			$post_id = wp_insert_post($post);
			add_post_meta($post_id, 'wp-svbtle-markdown', $_POST['post_content']);
			if (!empty($_POST['external_url']))
				add_post_meta($post_id, '_wp_svbtle_external_url', $_POST['external_url']);
		}
	

		
		$current_page .= (isset($post_id) ? "&id=" . $post_id : "");
		wp_redirect($current_page . '&success=success' );
		exit;		
		
	}
	
}else {
	// View Post
	$err = "";
		
	
	if (isset($_GET['id']) and (get_post($_GET['id']))) {
		$post = get_post($_GET['id']);

		$post_id 		= $post->ID;
		$post_title 	= $post->post_title;

		
		if (get_post_meta($_GET['id'], 'wp-svbtle-markdown', true)) {
			$post_content = get_post_meta($_GET['id'], 'wp-svbtle-markdown', true);
		}else {
			$post_content 	= $post->post_content;
		}

		if (get_post_meta($_GET['id'], '_wp_svbtle_external_url', true)) {
			$external_url = get_post_meta($_GET['id'], '_wp_svbtle_external_url', true);
		}else {
			$external_url 	= "";
		}
		
		$post_status 	= $post->post_status;
		
	}else {
		
		$post_id = "";
		$post_title = "";
		$post_content = "";
		$post_status = "";
		
	}
}