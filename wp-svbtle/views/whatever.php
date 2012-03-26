<?php
/*
Template Name: New Post
*/
// process the collected data
require_once WPSVBTLE_PATH . 'views/process_post.php'; 

nocache_headers();
include('header.php');
?>
<form action="" method="post" enctype="multipart/form-data">

	<div class="wrap">
		<?php if ($err != ""): ?>
			<?php echo "<p>".$err."</p>" ?>
		<?php elseif ($_GET['success'] == "success"): ?>
			<?php echo "<p>Your post was successfully submitted.</p>" ?>
		<?php elseif ($_GET['edit'] == "success"): ?>
			<?php echo "<p>Your post was successfully edited.</p>" ?>					
		<?php endif ?>

		<?php if (is_user_logged_in()): // checking weather or not the user has logged in.?>
			<?php if(isset($post_id)): ?>
				<input type="hidden" name="action" value="edit" />
				<input type="hidden" name="id" value="<?php echo $post_id; ?>" />
				<?php wp_nonce_field( 'manage-post' ); ?>
			<?php else: ?>
				<input type="hidden" name="action" value="post" />
				<?php wp_nonce_field( 'new-post' ); ?>
			<?php endif; ?>

			<p>
				<input type="text" id="post_title" class="text" name="post_title" value="<?php echo $post_title;?>" placeholder="Title Here" size="60" tabindex="1"/>
			</p>

			<p>
				<textarea name="post_content" id="post_content" placeholder="Write post here" cols=88 rows=20 tabindex="2"><?php echo $post_content; ?></textarea>
			</p>

		<?php else: ?>
			<?php // a lo mejor convendría un redirect? ?>
			<p>Sorry, you don't have permission to post new article!</p>
		<?php endif ?>
			
	</div><!-- .wrap -->

	<div class="buttons">
		<a href="#" class="button">Preview</a>
		<a href="#" class="button">Option</a>
		
		<div class="double">
			<a href="#" class="button checked">&#10004;	Idea</a>
			<a href="#" class="button ">Public</a>
		</div>
		
		<input type="submit" class="button" value="Save"/>
		<a href="?page=dashboard" class="button">Dashboard</a>

	</div><!-- .buttons -->
</form>
