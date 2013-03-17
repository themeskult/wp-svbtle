<?php

require_once WPSVBTLE_PATH . 'views/process_post.php'; 

nocache_headers();
$page = "edit";
include('header.php');
?>

<aside id="logo" class="clearfix">
		<a href="index.php?page=dashboard">
			<?php if (1==1): ?>
				<img src="../wp-content/themes/svbtle/images/icons/bolt_large.png" />
			<?php endif ?>
		</a>
</aside>




<div class="wrap">
	

	<form action="" method="post" enctype="multipart/form-data">
		<?php if ($err != ""): ?>
			<?php echo "<p class='wps-notice'>".$err."</p>" ?>
		<?php elseif (isset($_GET['edit']) and ($_GET['success'] == "success")): ?>
			<?php echo "<p class='wps-notice'>Your post was successfully submitted.</p>" ?>
		<?php elseif (isset($_GET['edit']) and ($_GET['edit'] == "success")): ?>
			<?php echo "<p class='wps-notice'>Your post was successfully updated.</p>" ?>					
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

			<textarea  id="post_title" class="text expand" name="post_title" placeholder="Title Here" size="60" tabindex="1"><?php echo $post_title;?></textarea>
			<div id="post_content_wrapper" style="position:fixed;left:200px;top:75px;bottom:75px;max-height:100%">
				<textarea name="post_content" id="post_content" placeholder="Write post here" class="content" style="min-height:100%;max-height:100%" tabindex="2"><?php echo $post_content ?></textarea>
			</div>
		<?php else: ?>
			<?php // a lo mejor convendría un redirect? ?>
			<p>Sorry, you don't have permission to post new article!</p>
		<?php endif ?>

		<div class="buttons">
			<?php if (!empty($_GET['id'])): ?>
			<a href="<?php echo get_permalink($post_id) ?>" target="_blank" class="button preview">Preview</a>
			<?php endif ?>
			<a href="#external-url" class="open-external button">Option</a>
			
			<div class="double">
				<input type="radio" class="RadioClass" name="post_status" value="draft" <?php if($post_status == 'draft' or empty($_GET['id'])): ?>checked="checked"<?php endif; ?> id="">
				<a href="#" class="button <?php if(($post_status == 'draft') or empty($_GET['id'])): ?>checked<?php endif; ?>"><span class="tick">&#10004;</span>	Idea</a>
				
				<input type="radio" class="RadioClass" name="post_status" value="publish" <?php if($post_status == 'publish'): ?>checked="checked"<?php endif; ?> id="">
				<a href="#" class="button <?php if($post_status == 'publish'): ?>checked<?php endif; ?>"><span class="tick">&#10004;</span> Public</a>
			</div>
			<a href="index.php?page=edit&action=del&id=<?php echo $_GET['id'] ?>" class="button remove">Remove</a>
			
			
			<div class="overlay">
				<div id="external-url" >
					<label>External Url</label>
					<p><input type="text" placeholder="http://your-url.com" name="external_url" style="border: 1px solid black; padding: 4px; width: 300px" value="<?php echo $external_url ?>" id=""></p>
					<input class="button close-fancy" type="button" value="OK" />
				</div>
			</div><!-- .overlay -->

			
			<input type="submit" class="button" value="Save"/>

		</div><!-- .buttons -->
	</form>
</div><!-- .wrap -->



<script type="text/javascript">
	$(document).ready(function() {
		$notice = $('p.wps-notice');
		if($notice.length) {
			$notice.fadeOut(2000);
		} 
		
		$('.open-external').click(function(){
			$('.overlay').show();
		});
		
		$('.close-fancy').click(function(){
			$('.overlay').hide();
		});
		
		$('textarea').autosize();

		$('#post_content').bind('input', function() {
			Editor(document.getElementById("post_content"), document.getElementById("preview"));
		});
	});
</script>
<script src="js/markdown.js"></script>
<script>
      function Editor(input, preview)
      {
        this.update = function () {
          preview.innerHTML = markdown.toHTML(input.value);
        }
        input.editor = this;
        this.update();
      }
      new Editor(document.getElementById("post_content"), document.getElementById("preview"));
</script>


<?php include('footer.php'); ?>
