<?php
set_time_limit(0);
	if ( !is_user_logged_in() ){
		wp_redirect( get_bloginfo( 'url' ) . '/' );
		exit;
	};

if (isset($_POST['action']) && wp_verify_nonce($_POST['_wpnonce'],'manage-post')) {
	$action = $_POST['action'];
	$ids = $_POST['id'];
	$err = "";

	switch ($action) {
	case 'del' :
			if ( !empty($ids) ) {
			foreach ($ids as $post_id) {
				wp_delete_post( $post_id );
			}
			$err .= __('Your Post was deleted.') . "<br />";
			}
	break;

	case 'edit' :
	if ( !empty($ids) ) {
		if (isset($_POST['edit']) && $_POST['edit'] == 'edit' && wp_verify_nonce($_POST['_wpnonce'],'manage-post')) {
			$cat = array();
			$err = "";
			$post_id		= $_POST['id'];
			$post_title 	= $_POST['post_title'];
			$post_content 	= $_POST['post_content'];
			$cat[0]	 		= $_POST['cat'];
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
					$post_id = wp_update_post( array(
						'ID'	=> $post_id,
						'post_title'	=> $post_title,
						'post_content'	=> $post_content,
						'post_category'	=> $cat,
					) );
					wp_redirect( $current_page . '&edit=success' );
					exit;
				}
		}

		else {
		$post = get_post($ids[0]);
		$post_id 		= $post->ID;
		$post_title 	= $post->post_title;
		$post_content 	= $post->post_content;
		$cat 			= get_the_category( $post_id );
		?>
						<form action="" method="post" enctype="multipart/form-data">
							<?php wp_nonce_field( 'manage-post' ); ?>
							<input type="hidden" name="action" value="edit" />
							<input type="hidden" name="edit" value="edit" />
							<input type="hidden" name="id" value="<?php echo $post_id; ?>" />
								<p>
									<input type="text" id="post_title" name="post_title" value="<?php echo $post_title;?>" size="60" tabindex="1"/>
									<label for="title">Post Title</label>
								</p>

								<p>
									<?php wp_dropdown_categories('show_option_none=Choose Post Category&orderby=name&order=ASC&hide_empty=0&hierarchical=1&selected='.$cat[0]->cat_ID); ?>
									<label for="cat">Post Category</label>
								</p>	

								<p><label for="post_content">Post Content:</label><br />
									<script type="text/javascript" src="<?php echo get_template_directory_uri(). '/tiny_mce/'; ?>tiny_mce.js"></script>
									<textarea name="post_content" id="post_content" cols=90 rows=20 tabindex="2"><?php echo $post_content; ?></textarea>
										<script type="text/javascript">
										tinyMCE.init({
											theme : "advanced",
											mode : "textareas",
										});
										</script>
								</p>

								<input id="submit" type="submit" value="Edit Post" />
						</form>
						<hr />
		<?php
		}
	}
	break;

	default:
		wp_redirect( get_bloginfo( 'url' ) . '/');
		exit;
	}
}
?>
