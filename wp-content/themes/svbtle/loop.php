<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if ( $wp_query->max_num_pages > 1 ) : ?>

<?php endif; ?>

<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if ( ! have_posts() ) : ?>
	<article id="post-0" class="post error404 not-found">
		<h1 class="entry-title"><?php _e( 'Not Found', 'boilerplate' ); ?></h1>
		<div class="entry-content">
			<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'boilerplate' ); ?></p>
			<?php get_search_form(); ?>
		</div><!-- .entry-content -->
	</article><!-- #post-0 -->
<?php endif; ?>



<?php while ( have_posts() ) : the_post(); ?>
	<?php $options = get_option ( 'svbtle_options' ); ?>

	<?php $kudos = get_post_meta($post->ID, '_wp-svbtle-kudos', true); 
				if ($kudos > "") { $kudos = $kudos; } else { $kudos = "0"; } ?>
				
		<article id="<?php the_ID(); ?>" <?php post_class(); ?>>

			
			<figure class="kudo">	
				<a class="kudos kudoable animate" id="<?php the_ID(); ?>">
					<div class="circle"><div class="filled">&nbsp;</div></div>
					<p class="count"><?php echo $kudos; ?> <span class="identifier">Kudos</p>
				</a>
				<div class="pbar"><div class="progress">&nbsp;</div></div>
			</figure>
			
			<h2 class="entry-title"><?php print_post_title(); ?></h2>



	<?php if ( is_archive() || is_search() ) : // Only display excerpts for archives and search. ?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
	<?php else : ?>
			<div class="entry-content">
				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'boilerplate' ) ); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'boilerplate' ), 'after' => '</div>' ) ); ?>
			</div><!-- .entry-content -->
	<?php endif; ?>


		</article><!-- #post-## -->


<?php endwhile; // End the loop. Whew. ?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
	<nav id="nav-below" class="navigation">
		<?php next_posts_link( __( '&larr; Previous', 'boilerplate' ) ); ?>
		<div class="next">
			<?php previous_posts_link( __( 'Next &rarr;', 'boilerplate' ) ); ?>
		</div>
	</nav><!-- #nav-below -->
<?php endif; ?>