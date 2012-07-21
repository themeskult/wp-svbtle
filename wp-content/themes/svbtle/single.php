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
    <time datetime="<?php echo date('Y-m-d'); ?>" id="top_time"><?php boilerplate_posted_on(); ?></time>
</header>

<?php
get_template_part( 'loop', 'index' );

?>
<div class="comments">
	<?php comments_template(); ?>
</div><!-- .comments -->

<div id="nav-below">
	<a href="#" class="back-to-blog">←   Back to blog</a>
</div><!-- .nav-below -->
<?php get_footer(); ?>