<!DOCTYPE html>
<!--[if lt IE 7 ]><html <?php language_attributes(); ?> class="no-js ie ie6 lte7 lte8 lte9"><![endif]-->
<!--[if IE 7 ]><html <?php language_attributes(); ?> class="no-js ie ie7 lte7 lte8 lte9"><![endif]-->
<!--[if IE 8 ]><html <?php language_attributes(); ?> class="no-js ie ie8 lte8 lte9"><![endif]-->
<!--[if IE 9 ]><html <?php language_attributes(); ?> class="no-js ie ie9 lte9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php

		if ( is_singular() && get_option( 'thread_comments' ) )
			wp_enqueue_script( 'comment-reply' );

		wp_head();
?>
	</head>
	<body <?php body_class(); ?>>
	
	<div id="wrap">
		
		<header role="banner">
			<h1><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<p><?php bloginfo( 'description' ); ?></p>
			
			<?php 
			ob_start(); 
			bloginfo('home');
			$site_url = ob_get_clean(); 
			?>
			
			<div class="links">
				<p><a href="<?php bloginfo('home'); ?>"><?php echo str_replace('http://', '', $site_url) ?></a></p>
				<p><a href="http://twitter.com/gravityonmars">@gravityonmars</a> 		</p>
				<p><a href="<?php echo get_settings('admin_email') ?>">say hello</a>    </p>
				<p><a href="<?php bloginfo('rss2_url'); ?>">rss feed</a>     </p>
			</div><!-- .links -->
		</header>
		
		<section id="content" role="main">
	

