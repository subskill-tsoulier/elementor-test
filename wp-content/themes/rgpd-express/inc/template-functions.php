<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package RGPD_Express
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function rgpd_express_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'rgpd_express_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function rgpd_express_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'rgpd_express_pingback_header' );



/**
 * function to remove rss flux
 *
 * @return void
 */
function wp_remove_rss_feed() {
	wp_die(__('No feed Available. Please visit our <a href="' . get_bloginfo('url') . '">Homepage</a>'));
}

add_action('do_feed', 'wp_remove_rss_feed', 1);
add_action('do_feed_rdf', 'wp_remove_rss_feed', 1);
add_action('do_feed_rss', 'wp_remove_rss_feed', 1);
add_action('do_feed_rss2', 'wp_remove_rss_feed', 1);
add_action('do_feed_atom', 'wp_remove_rss_feed', 1);
add_action('do_feed_rss2_comments', 'wp_remove_rss_feed', 1);
add_action('do_feed_atom_comments', 'wp_remove_rss_feed', 1);

comments_template( '', false );

remove_action('wp_head', 'wlwmanifest_link');
remove_action( 'wp_head', 'wp_generator' );

function bybe_remove_yoast_json($data){
  $data = array();
  return $data;
}

add_filter('wpseo_json_ld_output', 'bybe_remove_yoast_json', 10, 1);

function disable_shortlink_header() { 
	remove_action( 'template_redirect', 'wp_shortlink_header', 11); 
}

add_filter('after_setup_theme', 'disable_shortlink_header');

remove_action( 'wp_head', 'rest_output_link_wp_head' );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 20, 2 );

function smartwp_remove_wp_block_library_css() {
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
	wp_dequeue_style( 'dashicons-css' );
	wp_dequeue_style('admin-bar-css');
}
add_action( 'wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100 );

function wpshapere_remove_dashicons_wordpress() {
    wp_dequeue_style('dashicons');
    wp_deregister_style( 'dashicons' );
}
add_action( 'wp_enqueue_scripts', 'wpshapere_remove_dashicons_wordpress' );


function remove_classic_theme() {
    wp_dequeue_style( 'classic-theme-styles' );
}
add_action( 'wp_enqueue_scripts', 'remove_classic_theme', 20 );

/*  DISABLE GUTENBERG STYLE IN HEADER| WordPress 5.9 */
function wps_deregister_styles() {
    wp_dequeue_style( 'global-styles' );
}
add_action( 'wp_enqueue_scripts', 'wps_deregister_styles', 100 );


remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );

function my_deregister_scripts(){
	wp_dequeue_script( 'wp-embed' );
}
add_action( 'wp_footer', 'my_deregister_scripts' );

function disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );	
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );	
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}

function disable_emojis_re( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

add_action( 'init', 'disable_emojis_re' );

show_admin_bar(false);

// Removes from admin menu
add_action( 'admin_menu', 'pk_remove_admin_menus' );
function pk_remove_admin_menus() {
	remove_menu_page( 'edit-comments.php' );
}

// Removes from post and pages
add_action('init', 'pk_remove_comment_support', 100);
function pk_remove_comment_support() {
   remove_post_type_support( 'post', 'comments' );
   remove_post_type_support( 'page', 'comments' );
}

// Removes from admin bar
add_action( 'wp_before_admin_bar_render', 'pk_remove_comments_admin_bar' );
function pk_remove_comments_admin_bar() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('comments');
}