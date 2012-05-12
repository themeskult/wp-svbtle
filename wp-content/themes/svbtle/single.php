<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Boilerplate
 * @since Boilerplate 1.0
 */

get_header(); ?>
<div class="entry-meta" >
	POSTED <?php boilerplate_posted_on(); ?>
</div><!-- .entry-meta -->
<?php
get_template_part( 'loop', 'index' );

?>
<?php get_footer(); ?>