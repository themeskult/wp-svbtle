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
				<input type="hidden" name="action" value="post" />
				<?php wp_nonce_field( 'new-post' ); ?>
				<p>
					<input type="text" id="post_title" class="text" name="post_title" value="<?php echo $post_title;?>" placeholder="Title Here" size="60" tabindex="1"/>
				</p>

				<p>
					<textarea name="post_content" id="post_content" placeholder="Write post here" cols=88 rows=20 tabindex="2"><?php echo $post_content; ?></textarea>
				</p>


			<?php } else { ?>
			<p>Sorry, you don't have permission to post new article!</p>
			<?php } ?>
		<?php } ?>
		
</div><!-- .wrap -->

<div class="buttons">
	<a href="#" class="button">Preview</a>
	<a href="#" class="button">Option</a>
	
	<div class="double">
		<input type="radio" class="RadioClass" name="status" value="draft" id="">
		<a href="#" class="button checked"><span class="tick">&#10004;</span>	Idea</a>
		
		<input type="radio" class="RadioClass" name="status" value="public" id="">
		<a href="#" class="button "><span class="tick">&#10004;</span> Public</a>
	</div>
	
	<input type="submit" class="button" value="Save"/>
	<a href="?page=dashboard" class="button">Dashboard</a>

</div><!-- .buttons -->
</form>
