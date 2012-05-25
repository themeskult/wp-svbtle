<?php

function main_css()  
{
	wp_register_style( 'style', get_template_directory_uri() . '/style.css', array(), '20120417', 'all' );

	wp_enqueue_style( 'style' );
}

add_action( 'after_setup_theme', 'theme_setup' );

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
		'sunrise' => array(
			'url' => '%s/images/icons/sunrise_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/sunrise.png',
			'description' => 'sunrise'
		)
	) );
}

function theme_header_style() {
    ?><style type="text/css">
        figure#user_logo div.logo, article a.kudos.completed div.circle div.filled, figure#cover_logo{background-image: url(<?php header_image(); ?>);}
    </style><?php
}
function theme_admin_header_style() {
    ?><style type="text/css">
        figure#user_logo div.logo, article a.kudos.completed div.circle div.filled, figure#cover_logo{background-image: url(<?php header_image(); ?>);}
    </style><?php
}
function theme_admin_header_image() {
   	?><div style="display:inline-block;height:50px;background-color:#000;"><img src=<?php header_image(); ?> height="50px"></div>
    <?php
}



/*function widgets_init() {
	register_sidebar(array(
		'name' => __( 'Sidebar', 's' ),
		'id' => 'sidebar',
		'before_widget' => '<li>',
		'after_widget' => '</li>',
		'before_title' => '',
		'after_title' => '',
	));
}
add_action( 'init', 'widgets_init' );*/

function content_nav( $nav_id ) {
	global $wp_query;
		if ( $wp_query->max_num_pages > 1 ) : ?>
	<nav class="pagination">
		<span class="prev"><?php previous_posts_link( '←   Newer' ); ?></span>
		<span class="next"><?php next_posts_link( __( 'Continue   →') ); ?></span>
  </nav>
		<?php endif;
}

function single_content_nav( $nav_id ) {
	?>
	<a href="<?php echo home_url(); ?>" class="back_to_blog">←&nbsp;&nbsp;&nbsp;Back to blog</a>
	<?php 
}

function register_custom_menu() {
	register_nav_menu('custom_menu', __('Svbtle Menu'));
}
add_action('init', 'register_custom_menu');

require_once ( get_stylesheet_directory() . '/theme-options.php' );


add_action('init', 'load_theme_scripts');
function load_theme_scripts() {
    wp_enqueue_style( 'farbtastic' );
    wp_enqueue_script( 'farbtastic' );
}

add_theme_support( 'post-thumbnails', array( 'post' ) ); 

if ( ! function_exists( 'boilerplate_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post—date/time and author.
 *
 * @since Twenty Ten 1.0
 */
function boilerplate_posted_on() {
	// BP: slight modification to Twenty Ten function, converting single permalink to multi-archival link
	// Y = 2012
	// F = September
	// m = 01–12
	// j = 1–31
	// d = 01–31
	// printf( __( '<span class="%1$s">Posted on</span> <span class="entry-date">%2$s %3$s %4$s</span> <span class="meta-sep">by</span> %5$s', 'boilerplate' ),

	printf( __( '<span class="entry-date">%2$s %3$s %4$s</span>', 'boilerplate' ),
		// %1$s = container class
		'meta-prep meta-prep-author',
		// %2$s = month: /yyyy/mm/
		sprintf( '%3$s',
			home_url() . '/' . get_the_date( 'Y' ) . '/' . get_the_date( 'm' ) . '/',
			esc_attr( 'View Archives for ' . get_the_date( 'F' ) . ' ' . get_the_date( 'Y' ) ),
			get_the_date( 'F' )
		),
		// %3$s = day: /yyyy/mm/dd/
		sprintf( '%3$s',
			home_url() . '/' . get_the_date( 'Y' ) . '/' . get_the_date( 'm' ) . '/' . get_the_date( 'd' ) . '/',
			esc_attr( 'View Archives for ' . get_the_date( 'F' ) . ' ' . get_the_date( 'j' ) . ' ' . get_the_date( 'Y' ) ),
			get_the_date( 'j' )
		),
		// %4$s = year: /yyyy/
		sprintf( '%3$s',
			home_url() . '/' . get_the_date( 'Y' ) . '/',
			esc_attr( 'View Archives for ' . get_the_date( 'Y' ) ),
			get_the_date( 'Y' )
		),
		// %5$s = author vcard
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'boilerplate' ), get_the_author() ),
			get_the_author()
		)
	);
}
endif;

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
if ($pkey=='url1' || $pkey=='title_url' || $pkey=='url_title') {
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
echo '<a class="is_link_"'.$is_link.'" href="'.$link.'" rel="bookmark" title="'.$title.'">'.$title.'</a>';
}


function implement_ajax() {
	global $wpdb;

	$post_id = $_POST['article'];
	$cooking = $_POST['cooking'];

	$table_name = $wpdb->prefix . 'postmeta';

	$sql = "SELECT meta_value FROM $table_name WHERE post_id = $post_id AND meta_key = '_wp-svbtle-kudos'";

	$kudos = $wpdb->get_var( $wpdb->prepare( $sql ) );

	$new_kudos = $kudos + 1;

	add_post_meta( $post_id, '_wp-svbtle-kudos', 1, true ) or update_post_meta( $post_id, '_wp-svbtle-kudos', $new_kudos );

	header('HTTP/1.1 200 OK');

}

add_action('wp_ajax_my_special_action', 'implement_ajax');

add_action('wp_ajax_nopriv_my_special_action', 'implement_ajax');//for users that are not logged in.
?>