<?php

add_action( 'after_setup_theme', 'theme_setup' );
add_action( 'init', 'widgets_init' );
add_action('admin_head', 'load_theme_scripts');
add_action('init', 'register_custom_menu');
add_action( 'load-post.php', 'wp_svbtle_post_meta_boxes_setup' );
add_action( 'load-post-new.php', 'wp_svbtle_post_meta_boxes_setup' );

// Coming...
// include('vendor/UCF-Theme-Updater/updater.php');

function theme_setup() {
	global $wp_version;
	if (version_compare($wp_version, '3.4' , '>=')){ 
		add_theme_support( 'custom-header', array(
			// Header image default
			'default-image'			=> get_template_directory_uri() . '/images/icons/bolt_large.png',
			'header-text'			=> false,
			'default-text-color'		=> '000',
			'width'				=> '100',
			'flex-width'                    => true,
			'height'			=> '100',
			'flex-height'                   => true,
			'random-default'		=> true,
			'wp-head-callback'		=> 'theme_header_style',
			'admin-head-callback'		=> 'theme_admin_header_style',
			'admin-preview-callback'	=> 'theme_admin_header_image'
		) );
	} else {
		add_theme_support( 'custom-header', array( 'random-default' => true ) );
		//WP Custom Header - random roation by default
		define( 'HEADER_TEXTCOLOR', '' );
		define( 'HEADER_IMAGE', '%s/images/icons/bolt_large.png' );
		define( 'HEADER_IMAGE_HEIGHT', '100' );
		define( 'HEADER_IMAGE_WIDTH', '100' );
		define('NO_HEADER_TEXT', true );
		add_custom_image_header( 'theme_header_style', 'theme_admin_header_style', 'theme_admin_header_image' );
	}
	register_default_headers( array(
		'atom' => array(
			'url' => '%s/images/icons/atom_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/atom.png',
			'description' => 'atom'
		),
		'bear' => array(
			'url' => '%s/images/icons/bear_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/bear.png',
			'description' => 'bear'
		),
		'bolt' => array(
			'url' => '%s/images/icons/bolt_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/bolt.png',
			'description' => 'bolt'
		),
		'bullhorn' => array(
			'url' => '%s/images/icons/bullhorn_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/bullhorn.png',
			'description' => 'bullhorn'
		),
		'business_man' => array(
			'url' => '%s/images/icons/business_man_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/business_man.png',
			'description' => 'business_man'
		),
		'cassette' => array(
			'url' => '%s/images/icons/cassette_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/cassette.png',
			'description' => 'cassette'
		),
		'cell_phone' => array(
			'url' => '%s/images/icons/cell_phone_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/cell_phone.png',
			'description' => 'cell_phone'
		),
		'chain_link' => array(
			'url' => '%s/images/icons/chain_link_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/chain_link.png',
			'description' => 'chain_link'
		),
		'coffee' => array(
			'url' => '%s/images/icons/coffee_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/coffee.png',
			'description' => 'coffee'
		),
		'cog_head' => array(
			'url' => '%s/images/icons/cog_head_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/cog_head.png',
			'description' => 'cog_head'
		),
		'day_night' => array(
			'url' => '%s/images/icons/day_night_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/day_night.png',
			'description' => 'day_night'
		),
		'disapprove' => array(
			'url' => '%s/images/icons/disapprove_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/disapprove.png',
			'description' => 'disapprove'
		),
		'dog' => array(
			'url' => '%s/images/icons/dog_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/dog.png',
			'description' => 'dog'
		),
		'eye' => array(
			'url' => '%s/images/icons/eye_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/eye.png',
			'description' => 'eye'
		),
		'film' => array(
			'url' => '%s/images/icons/film_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/film.png',
			'description' => 'film'
		),
		'flask' => array(
			'url' => '%s/images/icons/flask_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/flask.png',
			'description' => 'flask'
		),
		'ghost' => array(
			'url' => '%s/images/icons/ghost_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/ghost.png',
			'description' => 'ghost'
		),
		'glasses' => array(
			'url' => '%s/images/icons/glasses_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/glasses.png',
			'description' => 'glasses'
		),
		'hat' => array(
			'url' => '%s/images/icons/hat_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/hat.png',
			'description' => 'hat'
		),
		'heart' => array(
			'url' => '%s/images/icons/heart_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/heart.png',
			'description' => 'heart'
		),
		'infection' => array(
			'url' => '%s/images/icons/infection_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/infection.png',
			'description' => 'infection'
		),
		'infinity' => array(
			'url' => '%s/images/icons/infinity_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/infinity.png',
			'description' => 'infinity'
		),
		'iphone' => array(
			'url' => '%s/images/icons/iphone_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/iphone.png',
			'description' => 'iphone'
		),
		'like' => array(
			'url' => '%s/images/icons/like_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/like.png',
			'description' => 'like'
		),
		'man_stairs' => array(
			'url' => '%s/images/icons/man_stairs_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/man_stairs.png',
			'description' => 'man_stairs'
		),
		'mine_cross' => array(
			'url' => '%s/images/icons/mine_cross_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/mine_cross.png',
			'description' => 'mine_cross'
		),
		'motorcycle' => array(
			'url' => '%s/images/icons/motorcycle_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/motorcycle.png',
			'description' => 'motorcycle'
		),
		'no_smoking' => array(
			'url' => '%s/images/icons/no_smoking_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/no_smoking.png',
			'description' => 'no_smoking'
		),
		'pan_ui' => array(
			'url' => '%s/images/icons/pan_ui_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/pan_ui.png',
			'description' => 'pan_ui'
		),
		'radio' => array(
			'url' => '%s/images/icons/radio_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/radio.png',
			'description' => 'radio'
		),
		'paperplane' => array(
			'url' => '%s/images/icons/paperplane_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/paperplane.png',
			'description' => 'radio'
		),
		'robot_square' => array(
			'url' => '%s/images/icons/robot_square_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/robot_square.png',
			'description' => 'robot_square'
		),
		'soccer_shoe' => array(
			'url' => '%s/images/icons/soccer_shoe_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/soccer_shoe.png',
			'description' => 'soccer_shoe'
		),
		'automobile' => array(
			'url' => '%s/images/icons/automobile_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/automobile.png',
			'description' => 'automobile'
		),
		'guitar' => array(
			'url' => '%s/images/icons/guitar_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/guitar.png',
			'description' => 'guitar'
		),
		'acting' => array(
			'url' => '%s/images/icons/acting_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/acting.png',
			'description' => 'acting'
		),
		'cloudrain' => array(
			'url' => '%s/images/icons/cloudrain_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/cloudrain.png',
			'description' => 'cloudrain'
		),
		'whale' => array(
			'url' => '%s/images/icons/whale_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/whale.png',
			'description' => 'whale'
		),
		'money' => array(
			'url' => '%s/images/icons/money_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/money.png',
			'description' => 'money'
		),
		'sunrise' => array(
			'url' => '%s/images/icons/sunrise_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/sunrise.png',
			'description' => 'sunrise'
		)
	) );
}

function widgets_init() {
	register_sidebar(array(
		'name' => __( 'Sidebar', 's' ),
		'id' => 'sidebar',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<span class="hidden">',
		'after_title' => '</span>',
	));
}

function theme_header_style() {
    ?><style type="text/css">
figure.logo a, aside#logo div a, aside.kudo.complete span.circle{background-image: url(<?php header_image(); ?>);}
    </style><?php
}
function theme_admin_header_style() {
    ?><style type="text/css">
		aside#logo div a,aside.kudo.complete span.circle{background-image: url(<?php header_image(); ?>);}
    </style><?php
}
function theme_admin_header_image() {
   	?><div style="display:inline-block;height:50px;background-color:#000;"><img src=<?php header_image(); ?> height="50px"></div>
    <?php
}

function register_custom_menu() {
	register_nav_menu( 'primary', __( 'Svbtle Menu') );
}

require_once ( get_template_directory() . '/theme-options.php' );




function load_theme_scripts() {
    wp_enqueue_style( 'farbtastic' );
    wp_enqueue_script( 'farbtastic' );
}

function wp_svbtle_external_url( $object, $box ) { ?>
	<?php wp_nonce_field( basename( __FILE__ ), '_wp_svbtle_external_url' ); ?>
	<p>
		<input class="widefat" type="text" name="wp_svbtle_external_url" id="wp_svbtle_external_url" value="<?php echo esc_attr( get_post_meta( $object->ID, '_wp_svbtle_external_url', true ) ); ?>" size="30" />
	</p>
<?php }


function wp_svbtle_post_meta_boxes_setup() {
	add_action( 'add_meta_boxes', 'wp_svbtle_add_post_meta_boxes' );
	add_action( 'save_post', 'wp_svbtle_save_post_class_meta', 10, 2 );
}

function wp_svbtle_add_post_meta_boxes() {
	add_meta_box(
		'wp_svbtle_external_url', esc_html__( 'External Url', 'example' ),
		'wp_svbtle_external_url',
		'post',
		'side',
		'high'
	);
}

function wp_svbtle_save_post_class_meta( $post_id, $post ) {

	if ( !isset( $_POST['_wp_svbtle_external_url'] ) || !wp_verify_nonce( $_POST['_wp_svbtle_external_url'], basename( __FILE__ ) ) )
		return $post_id;

	$post_type = get_post_type_object( $post->post_type );

	if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
		return $post_id;

	$new_meta_value = ( isset( $_POST['wp_svbtle_external_url'] ) ? esc_url_raw( $_POST['wp_svbtle_external_url'] ) : '' );

	$meta_key = '_wp_svbtle_external_url';
	$meta_value = get_post_meta( $post_id, $meta_key, true );

	if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, $meta_key, $new_meta_value, true );
	elseif ( $new_meta_value && $new_meta_value != $meta_value )
		update_post_meta( $post_id, $meta_key, $new_meta_value );
	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, $meta_key, $meta_value );
}


function print_post_title() {
global $post;
$thePostID = $post->ID;
$post_id = get_post($thePostID);
$title = $post_id->post_title;
$perm = get_permalink($post_id);
$post_keys = array(); $post_val = array();
$post_keys = get_post_custom_keys($thePostID);
$is_link = 0;

if (!empty($post_keys)) {
foreach ($post_keys as $pkey) {
if ($pkey=='_wp_svbtle_external_url' || $pkey=='_wp_svbtle_external_url' || $pkey=='_wp_svbtle_external_url') {
$post_val = get_post_custom_values($pkey);
}
}
if (empty($post_val)) {
$link = $perm;
} else {
$link = $post_val[0];
$is_link = 1;
}
} else {
$link = $perm;
}
if ($is_link): ?>
	<a href="<?php echo $link ?>" class="title"><?php echo the_title() ?></a>
	<a href="<?php echo the_permalink() ?>" class="anchor"><img src="<?php echo get_bloginfo('stylesheet_directory') ?>/images/anchor.svg" class="scalable"></a>
<?php else: ?>
	<a href="<?php the_permalink(); ?>" class="no-link" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>

<?php endif; 

}


if ( ! function_exists( 'wp_svbtle_comment' ) ) :

function wp_svbtle_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p class="row">
			<strong class="ping-label span1"><?php _e( 'Pingback:', 'the-bootstrap' ); ?></strong>
			<span class="span7"><?php comment_author_link(); edit_comment_link( __( 'Edit', 'the-bootstrap' ), '<span class="sep">&nbsp;</span><span class="edit-link label">', '</span>' ); ?></span>
		</p>
	<?php
			break;
		default :
			$offset	=	$depth - 1;
			$span	=	7 - $offset;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment row">
			<div class="comment-author-avatar span1<?php if ($offset) echo " offset{$offset}"; ?>">
				<?php echo get_avatar( $comment, 70 ); ?>
			</div>
			<footer class="comment-meta span<?php echo $span; ?>">
				<div class="comment-author vcard">
					<?php
						/* translators: 1: comment author, 2: date and time */
						printf( __( '%1$s <span class="says">said</span> on %2$s:', 'the-bootstrap' ),
							sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
							sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( __( '%1$s at %2$s', 'the-bootstrap' ), get_comment_date(), get_comment_time() )
							)
						);
						edit_comment_link( __( 'Edit', 'the-bootstrap' ), '<span class="sep">&nbsp;</span><span class="edit-link label">', '</span>' ); ?>
				</div><!-- .comment-author .vcard -->

				<?php if ( ! $comment->comment_approved ) : ?>
				<div class="comment-awaiting-moderation alert alert-info"><em><?php _e( 'Your comment is awaiting moderation.', 'the-bootstrap' ); ?></em></div>
				<?php endif; ?>

			</footer>

			<div class="comment-content span<?php echo $span; ?>">
				<?php
				comment_text();
				comment_reply_link( array_merge( $args, array(
					'reply_text'	=>	__( 'Reply <span>&darr;</span>', 'the-bootstrap' ),
					'depth'			=>	$depth,
					'max_depth'		=>	$args['max_depth']
				) ) ); ?>
			</div>

		</article><!-- #comment-<?php comment_ID(); ?> -->
	<?php
			break;
	endswitch;
}
endif; // ends check for wp_svbtle_comment()



function implement_ajax() {
	global $wpdb;

	$post_id = intval($_POST['article']);

	$kudos = get_post_meta( $post_id , '_wp-svbtle-kudos', true );
	$new_kudos = $kudos + 1;

	add_post_meta( $post_id, '_wp-svbtle-kudos', 1, true ) or update_post_meta( $post_id, '_wp-svbtle-kudos', $new_kudos );

	header('HTTP/1.1 200 OK');

}

add_action('wp_ajax_my_special_action', 'implement_ajax');
add_action('wp_ajax_nopriv_my_special_action', 'implement_ajax');//for users that are not logged in.


function remove_kudos() {
	
	global $wpdb;

	$post_id = intval($_POST['article']);

	$kudos = get_post_meta( $post_id , '_wp-svbtle-kudos', true );
	$new_kudos = $kudos - 1;

	if ($new_kudos < 0) $new_kudos = 0;

	add_post_meta( $post_id, '_wp-svbtle-kudos', 1, true ) or update_post_meta( $post_id, '_wp-svbtle-kudos', $new_kudos );

	header('HTTP/1.1 200 OK');

}

add_action('wp_ajax_remove_kudos', 'remove_kudos');
add_action('wp_ajax_nopriv_remove_kudos', 'remove_kudos');//for users that are not logged in.


// unregister all default WP Widgets
function unregister_default_wp_widgets() {
	unregister_widget('WP_Widget_Calendar');
	unregister_widget('WP_Widget_Archives');
	unregister_widget('WP_Widget_Links');
	unregister_widget('WP_Widget_Meta');
	unregister_widget('WP_Widget_Categories');
	unregister_widget('WP_Widget_Recent_Posts');
	unregister_widget('WP_Widget_Recent_Comments');
	unregister_widget('WP_Widget_RSS');
	unregister_widget('WP_Widget_Tag_Cloud');
}
add_action('widgets_init', 'unregister_default_wp_widgets', 1);

 
add_action('admin_bar_menu', 'add_items',  100);
function add_items($admin_bar)
{
 	global $post;

    $args = array(
            'id'    => 'wp-svbtle-editor',
            'title' => 'wp-svbtle editor',
            'href'  => get_bloginfo('url') . '/wp-svbtle/',
            'meta'  => array('title' => __('wp-svbtle editor'))
            );
 
 	if (is_single() or is_page()) {
 		$args['href'] = get_bloginfo('url') . '/wp-svbtle/index.php?page=edit&id='.$post->ID;
 		$args['title'] = 'Edit post with wp-svbtle';
 	}

    //This is where the magic works.
    $admin_bar->add_menu( $args);
}

// Modifying the Comment Call before and after comment_form gets called in comments.php
add_action('comment_form_before','svbtle_comment_form_before');
add_action('comment_form_after','svbtle_comment_form_after');
function svbtle_comment_form_before() {
 echo '<div class="comments">';
 }

 function svbtle_comment_form_after() {
 echo '</div>';
 }
