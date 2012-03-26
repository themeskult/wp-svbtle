<?php
/*
Template Name: Post Manager
*/
global $wpdb;
global $current_user;

nocache_headers();
include('header.php')
?>
<a href="#" class="button logout"><img src="logout.png" width="16" height="18" alt="Logout"></a>
<div class="wrap">
	
	<div class=" module">
		<div class="ideas">
			<h2><a href="?page=whatever" class="button new-entry">New entry</a>Ideas</h2>
			
				<form action="whatever_submit" class="form-idea" method="post" accept-charset="utf-8">
					<input type="text" name="" value="" class="start_typing" id="" placeholder="Start typing an idea here...">
				</form>
			
			<?php $ideas_posts = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_status = 'draft' AND post_type = 'post' ORDER BY post_date DESC"); ?>

			<?php foreach ($ideas_posts as $memberpost): ?>
				<p>
					<a href="?page=whatever&id=<?php echo $memberpost->ID ?>"><?php echo $memberpost->post_title ?></a>
				</p>
			<?php endforeach ?>
		</div><!-- .ideas -->		
	</div><!-- .ideas -->
	
	
	<div class="published module">
		<h2>Published</h2>
		<?php $published_posts = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'post' ORDER BY post_date DESC");?>
		
		<?php foreach ($published_posts as $memberpost): ?>
			<p>
				<a href="?page=whatever&id=<?php echo $memberpost->ID ?>"><span class="word-count"><?php echo str_word_count($memberpost->post_content) ?></span><?php echo $memberpost->post_title ?></a>
			</p>
		<?php endforeach ?>
	</div><!-- .name -->
	
</div><!-- .wrap -->


