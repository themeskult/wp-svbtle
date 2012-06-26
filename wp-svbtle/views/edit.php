<?php
/*
Template Name: New Post
*/
// process the collected data
require_once WPSVBTLE_PATH . 'views/process_post.php';

//wp_enqueue_script('autosave');
wp_enqueue_script('autosave-dev','/wp-includes/js/autosave.dev.js', array('schedule', 'wp-ajax-response'), '1.0', 1 );
	wp_localize_script( 'autosave-dev', 'autosaveL10n', array(
		'autosaveInterval' => AUTOSAVE_INTERVAL,
		'savingText' => __('Saving Draft&#8230;'),
		'saveAlert' => __('The changes you made will be lost if you navigate away from this page.')
	) );

//wp_just_in_time_script_localization();

nocache_headers();
include('header.php');
?>

<script type="text/javascript">
addLoadEvent = function(func){if(typeof jQuery!="undefined")jQuery(document).ready(func);else if(typeof wpOnload!='function'){wpOnload=func;}else{var oldonload=wpOnload;wpOnload=function(){oldonload();func();}}};
var userSettings = {
		'url': '<?php echo SITECOOKIEPATH; ?>',
		'uid': '<?php if ( ! isset($current_user) ) $current_user = wp_get_current_user(); echo $current_user->ID; ?>',
		'time':'<?php echo time() ?>'
	},
	ajaxurl = '<?php echo admin_url( 'admin-ajax.php', 'relative' ); ?>',
	pagenow = '<?php echo $current_screen->id; ?>',
	typenow = '<?php echo $current_screen->post_type; ?>',
	adminpage = '<?php echo $admin_body_class; ?>',
	thousandsSeparator = '<?php echo addslashes( $wp_locale->number_format['thousands_sep'] ); ?>',
	decimalPoint = '<?php echo addslashes( $wp_locale->number_format['decimal_point'] ); ?>',
	isRtl = <?php echo (int) is_rtl(); ?>;
</script>

<form action="" method="post" enctype="multipart/form-data" id="post">
	<?php if ($err != ""): ?>
		<?php echo "<p class='wps-notice'>".$err."</p>" ?>
	<?php elseif ($_GET['success'] == "success"): ?>
		<?php echo "<p class='wps-notice'>Your post was successfully submitted.</p>" ?>
	<?php elseif ($_GET['edit'] == "success"): ?>
		<?php echo "<p class='wps-notice'>Your post was successfully updated.</p>" ?>					
	<?php endif ?>

	<div class="wrap">

		<?php if (is_user_logged_in()): // checking weather or not the user has logged in.?>
			<?php if(isset($post_id)): ?>
				<input type="hidden" name="action" value="edit" />
				<input type="hidden" name="id" id="post_ID" value="<?php echo $post_id; ?>" />
				<?php wp_nonce_field( 'manage-post' ); ?>
				<?php wp_nonce_field( 'autosave', 'autosavenonce', false ); ?>
			<?php else: ?>
				<input type="hidden" name="action" value="post" />
				<?php wp_nonce_field( 'new-post' ); ?>
			<?php endif; ?>

			<p>
				<input type="text" id="title" class="text" name="post_title" value="<?php echo $post_title;?>" placeholder="Title Here" size="60" tabindex="1"/>
			</p>

			<p>
				<textarea name="content" id="content" placeholder="Write post here"  tabindex="2"><?php echo $post_content ?></textarea>
			</p>

		<?php else: ?>
			<?php // a lo mejor convendría un redirect? ?>
			<p>Sorry, you don't have permission to post new article!</p>
		<?php endif ?>
			
	</div><!-- .wrap -->

	<div class="buttons">
		<?php if (!empty($_GET['id'])): ?>
			<a href="<?php echo get_permalink($post_id) ?>" target="_blank" class="button">Preview</a>
		<?php endif ?>
		<!-- <a href="#" class="button">Option</a> -->
		
		<div class="double">
			<input type="radio" class="RadioClass" name="post_status" value="draft" <?php if($post_status == 'draft'): ?>checked="checked"<?php endif; ?> id="">
			<a href="#" class="button <?php if($post_status == 'draft'): ?>checked<?php endif; ?>"><span class="tick">&#10004;</span>	Idea</a>
			
			<input type="radio" class="RadioClass" name="post_status" value="publish" <?php if($post_status == 'publish'): ?>checked="checked"<?php endif; ?> id="">
			<a href="#" class="button <?php if($post_status == 'publish'): ?>checked<?php endif; ?>"><span class="tick">&#10004;</span> Public</a>
		</div>
		<a href="index.php?page=edit&action=del&id=<?php echo $_GET['id'] ?>" class="button remove">Remove</a>
		
		<input type="submit" class="button" value="Save"/>
		<a href="index.php?page=dashboard" class="button">Dashboard</a>

	</div><!-- .buttons -->
</form>

<script type="text/javascript">
	$(document).ready(function() {
		$notice = $('p.wps-notice');
		if($notice.length) {
			$notice.fadeOut(2000);
		} 
	});
</script>

<?php include('footer.php'); ?>