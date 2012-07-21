<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Boilerplate
 * @since Boilerplate 1.0
 */

get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>

<article id="<?php the_ID(); ?>" class="post">
	<h2>
		<?php print_post_title() ?>
	</h2>
	<?php the_content( __( 'Continue reading <span class="meta-nav">&raquo;</span>', 'hbd-theme' )  ); ?>
	
	<h2><?php //echo get_the_category_list(', '); ?></h2>
</article>
<?php endwhile; // End the loop. Whew. ?>


<?php get_footer(); ?>