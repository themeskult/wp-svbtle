<?php
/*
Template Name: Post Manager
*/
global $wpdb;
global $current_user;

nocache_headers();
include('header.php')
?>

<div class="wrap">
	
	<div class=" module">
		<div class="ideas">
			<a href="#" class="button">New entry</a>
			<h2>Ideas</h2>
			<?php
			$ideas_posts = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_status = 'draft' AND post_type = 'post' ORDER BY post_date DESC");
			?>

			<?php foreach ($ideas_posts as $memberpost): ?>
				<p>
					<a href="<?php echo $memberpost->guid ?>"><span class="word-count"><?php echo str_word_count($memberpost->post_content) ?></span><?php echo $memberpost->post_title ?></a>
				</p>
			<?php endforeach ?>
		</div><!-- .ideas -->		
	</div><!-- .ideas -->
	
	
	<div class="published module">
		<h2>Published</h2>
		<?php
		$published_posts = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'post' ORDER BY post_date DESC");
		?>
		
		<?php foreach ($published_posts as $memberpost): ?>
			<p>
				<a href="<?php echo $memberpost->guid ?>"><span class="word-count"><?php echo str_word_count($memberpost->post_content) ?></span><?php echo $memberpost->post_title ?></a>
			</p>
		<?php endforeach ?>
	</div><!-- .name -->
	
</div><!-- .wrap -->


