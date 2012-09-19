<?php
if ( post_password_required() ) : ?>
<div id="comments">
	<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'the-bootstrap' ); ?></p>
</div><!-- #comments -->
<?php
	return;
endif;

if ( have_comments() ) : ?>
<div id="comments">
	<h2>
		Comments
	</h2>

	<?php if ( get_comment_pages_count() > 1 AND get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
	<nav id="comment-nav-above" class="well">
		<h1 class="assistive-text"><?php _e( 'Comment navigation', 'the-bootstrap' ); ?></h1>
		<div class="nav-previous alignleft"><?php next_comments_link( __( '&larr; Newer Comments', 'the-bootstrap' ) ); ?></div>
		<div class="nav-next alignright"><?php previous_comments_link( __( 'Older Comments &rarr;', 'the-bootstrap' ) ); ?></div>
	</nav>
	<?php endif; // check for comment navigation ?>

	<ol class="commentlist unstyled">
		<?php wp_list_comments( array( 'callback' => 'wp_svbtle_comment' ) ); ?>
	</ol>

	<?php if ( get_comment_pages_count() > 1 AND get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
	<nav id="comment-nav-below" class="well">
		<h1 class="assistive-text"><?php _e( 'Comment navigation', 'the-bootstrap' ); ?></h1>
		<div class="nav-previous alignleft"><?php next_comments_link( __( '&larr; Newer Comments', 'the-bootstrap' ) ); ?></div>
		<div class="nav-next alignright"><?php previous_comments_link( __( 'Older Comments &rarr;', 'the-bootstrap' ) ); ?></div>
	</nav>
	<?php endif; // check for comment navigation ?>

</div><!-- #comments -->
<?php endif;

if ( ! comments_open() AND ! is_page() AND post_type_supports( get_post_type(), 'comments' ) ) : ?>
	<p class="nocomments"><?php _e( 'Comments are closed.', 'the-bootstrap' ); ?></p>
<?php endif;
comment_form();