<?php
/*
Template Name: New Post
*/
// process the collected data
require_once WPSUBTLE_PATH . 'views/test_form_process.php'; 

// $wpdb->hide_errors();
// nocache_headers();
// get_header();
?>
		<div id="container">
			<div id="content" role="main">
				<div id="formbox">
				<?php
					if ($err != "") {
						echo "<p>".$err."</p>";
					}
				?>
				<?php
					if ($_GET['success'] == "success") {
						echo "<p>Your post was successfully submitted.</p>";
					}
					else { ?>
						<?php if (is_user_logged_in()) { // checking weather or not the user has logged in.
						?>
						<form action="" method="post" enctype="multipart/form-data">
							<input type="hidden" name="action" value="post" />
							<?php wp_nonce_field( 'new-post' ); ?>
								<p>
									<input type="text" id="post_title" name="post_title" value="<?php echo $post_title;?>" size="60" tabindex="1"/>
									<label for="title">Post Title</label>
								</p>

								<p>
									<?php wp_dropdown_categories('show_option_none=Choose Post Category&orderby=name&order=ASC&hide_empty=0&hierarchical=1'); ?>
									<label for="cat">Post Category</label>
								</p>	

								<p><label for="post_content">Post Content:</label><br />
									<script type="text/javascript" src="<?php echo get_template_directory_uri(). '/tiny_mce/'; ?>tiny_mce.js"></script>
									<textarea name="post_content" id="post_content" cols=88 rows=20 tabindex="2"><?php echo $post_content; ?></textarea>
										<script type="text/javascript">
										tinyMCE.init({
											theme : "advanced",
											mode : "textareas",
										});
										</script>
								</p>

								<p>
									<input type="text" id="post_tags" name="post_tags" value="<?php echo $post_tags;?>" size="60" tabindex="3"/>
									<label for="post_tags">Post Tags</label>
								</p>
								<input id="submit" type="submit" value="Submit Post" />

						</form>
						<?php } else { ?>
						<p>Sorry, you don't have permission to post new article!</p>
						<?php } ?>
					<?php } ?>
				</div>
			</div><!-- #content -->
		</div><!-- #container -->

<?php //get_sidebar(); ?>
<?php //get_footer(); ?>
