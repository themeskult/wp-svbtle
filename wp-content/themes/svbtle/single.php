<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Boilerplate
 * @since Boilerplate 1.0
 */

get_header(); ?>


<header id="begin">
    <time datetime="<?php echo date('Y-m-d'); ?>" id="top_time"><?php the_time('F d, Y'); ?></time>
</header>

<?php
get_template_part( 'loop', 'index' );

?>
<div class="comments">
	<?php comments_template(); ?>
</div><!-- .comments -->

<nav class="pagination">
  <span class="prev">
    <a href="<?php echo home_url( '/' ); ?>" class="back_to_blog">←&nbsp;&nbsp;&nbsp;Back to blog</a>
  </span>
</nav>
<?php get_footer(); ?>