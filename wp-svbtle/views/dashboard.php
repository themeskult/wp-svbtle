<?php
/*
Template Name: Post Manager
*/
global $wpdb;
global $current_user;

nocache_headers();
?>
		<div id="container">
			<div id="content" role="main">
				<div id="formbox">
				<?php if (is_user_logged_in()) {
				$memberposts = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_author = $current_user->ID AND post_status = 'publish' AND post_type = 'post' ORDER BY post_date DESC");
				?>
					<?php if ( !empty($memberposts) ) {
					require_once dirname( __FILE__ ) . '/manage.php';

					if ($err != "") {
						echo "<p>".$err."</p>";
					}
					if ($_GET['edit'] == "success") {
						echo "<p>Your post was successfully edited.</p>";
					}					

					?>
						<p><b>List of your posts:</b></p>
						<form action="" method="post" enctype="multipart/form-data">
						<?php wp_nonce_field( 'manage-post' ); ?>
							<ul class="post_list">
							<?php
							foreach ($memberposts as $memberpost) {
								echo "<li><input type="."checkbox"." name="."id[]"." value="."$memberpost->ID"." />&nbsp;<a href="."$memberpost->guid".">".$memberpost->post_title."</a> (<em>".date("d/m/Y",strtotime($memberpost->post_date))."</em>)</li>";
							}
							?>
							</ul>
						<br class="clear" />

						<select name="action">
							<option value="edit">Edit Post</option>
							<option value="del">Delete Post</option>
						</select>

						<input id="submit" type="submit" value="Proceed" />
						</form>
					<?php } ?>
				<?php } else { ?>
				<p>Sorry, you must be logged in to manage your posts!</p>
				<?php } ?>
				</div>
			</div><!-- #content -->
		</div><!-- #container -->

