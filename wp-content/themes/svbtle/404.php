<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Boilerplate
 * @since Boilerplate 1.0
 */

wp_redirect(get_bloginfo('url').'?not_found=1',302);
exit;
