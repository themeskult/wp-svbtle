<?php
/*
Template Name: Post Manager
*/
global $wpdb;
global $current_user;

nocache_headers();
include('header.php')
?>
<a href="<?php echo wp_logout_url( home_url()  ); ?>" class="button logout"><img src="logout.png" width="16" height="18" alt="Logout"></a>
<div class="wrap">
	
	<div class="module">
		<div class="ideas">
			<h2><a href="index.php?page=edit" class="button new-entry">New entry</a>Ideas</h2>
			
				<form action="index.php?page=edit" class="form-idea" method="post" accept-charset="utf-8">
					<input type="hidden" name="action" value="dashboard_submit" />
					<?php wp_nonce_field( 'new-post' ); ?>
					<input type="text" name="idea_title" value="" class="start_typing" id="idea_title" placeholder="Start typing an idea here...">
				</form>
			
			<?php $ideas_posts = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_status = 'draft' AND post_type = 'post' ORDER BY post_date DESC"); ?>

			<?php foreach ($ideas_posts as $memberpost): ?>
				<p>
					<a href="index.php?page=edit&id=<?php echo $memberpost->ID ?>"><?php echo $memberpost->post_title ?></a>
				</p>
			<?php endforeach ?>
		</div><!-- .ideas -->		
	</div><!-- .ideas -->
	
	
	<div class="published module">
		<h2>Published</h2>
		<?php $published_posts = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'post' ORDER BY post_date DESC");?>
		
		<?php foreach ($published_posts as $memberpost): ?>
			<p>
				<a href="index.php?page=edit&id=<?php echo $memberpost->ID ?>"><span class="word-count"><?php echo str_word_count($memberpost->post_content) ?></span><?php echo $memberpost->post_title ?></a>
			</p>
		<?php endforeach ?>
	</div><!-- .name -->
	
</div><!-- .wrap -->

<?php include('footer.php') ?>