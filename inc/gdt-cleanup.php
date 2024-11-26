<?php
/** 
 * A bunch of random cleaning and house keeping stuff is in here. Contents listed below.
 * More commonly edited / used stuff is found in other files. Best to just move on...
 */

/**
 * CONTENTS
 *
 * CLEAN UP -------
 * GutenDev Go Time..................fire up key filteres and functions
 * Head clean up....................getting rid of junk WP generates
 * Theme Support....................activating WP functions for theme functionality
 *
 */


/*------------------------------------*\
    CLEAN UP STUFF
\*------------------------------------*/

function gutendev_go_time() {
  // launching operation cleanup......
  add_action( 'init', 'gdt_head_cleanup' );
  // remove WP version from RSS
  add_filter( 'the_generator', 'gdt_rss_version' );
  // remove injected CSS for recent comments widget
  add_filter( 'show_recent_comments_widget_style', '__return_false', 99 );
  // enqueue base scripts and styles
  add_action( 'wp_enqueue_scripts', 'gdt_scripts_and_styles', 999 );
  // enable theme to support various stuff
  gdt_theme_support();
  // adding sidebars to Wordpress (these are created in functions.php)
  add_action( 'widgets_init', 'gdt_register_sidebars' );
  // cleaning up excerpt
  add_filter( 'excerpt_more', 'gdt_excerpt_more' );

} /* end gutendev go time */

// hook flexdex_go_time() into after_setup_theme hook so above function runs before init
add_action( 'after_setup_theme', 'gutendev_go_time' );



function gdt_head_cleanup() {
  // remove really simple discovery link
  remove_action( 'wp_head', 'rsd_link' );
  // windows live writer
  remove_action( 'wp_head', 'wlwmanifest_link' );
  // previous link
  remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
  // start link
  remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
  // links for adjacent posts
  remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
  // WP version
  remove_action( 'wp_head', 'wp_generator' );
  // Disable comments feed
  add_filter( 'feed_links_show_comments_feed', '__return_false' );

} /* end fdt head cleanup */


// get ride of all the emoji junk code
function disable_wp_emojicons()
{
  // all actions related to emojis
  remove_action('admin_print_styles', 'print_emoji_styles');
  remove_action('wp_head', 'print_emoji_detection_script', 7);
  remove_action('admin_print_scripts', 'print_emoji_detection_script');
  remove_action('wp_print_styles', 'print_emoji_styles');
  remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
  remove_filter('the_content_feed', 'wp_staticize_emoji');
  remove_filter('comment_text_rss', 'wp_staticize_emoji');
  
}
add_action('init', 'disable_wp_emojicons');
add_filter('emoji_svg_url', '__return_false');


// remove WP version from RSS
function gdt_rss_version() { return ''; }

// remove WP version from scripts
function gdt_remove_wp_ver_css_js( $src ) {
  if ( strpos( $src, 'ver=' ) )
    $src = remove_query_arg( 'ver', $src );
  return $src;
}




/*------------------------------------*\
    THEME SUPPORT
\*------------------------------------*/

// Register various optional WP features
function gdt_theme_support() {
  // Enable support for Post Thumbnails (Featured Images) on specified post types.
  add_theme_support( 'post-thumbnails');
  // Enable Title tags
  add_theme_support( 'title-tag' );
  // HTML5 support
  add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
  // Widget customizer selective refresh
  add_theme_support( 'customize-selective-refresh-widgets') ;
  // Add default posts and comments RSS feed links to head.
  add_theme_support( 'automatic-feed-links' );
  // Editor styles (they apply to Gutenberg or classic editor...)
  add_theme_support( 'editor-styles' );
  // Change file location for editor styles
  add_editor_style( 'dist/editor-styles.css' );
  // remove bundled WP block patterns
  remove_theme_support( 'core-block-patterns' );
  // Add support for responsive embeds
  add_theme_support('responsive-embeds');
 

 // Add support for Block Templates

// add_theme_support('wp-block-styles');
add_theme_support('custom-line-height');
add_theme_support('custom-units');
add_theme_support('custom-spacing');
add_theme_support('custom-colors');
add_theme_support('block-template-parts' );
add_theme_support('block-templates');

}



?>
