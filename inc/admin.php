<?php
/*
This file handles the admin area and functions.
You can use this file to make changes to the dashboard.
*/

/**
 * CONTENTS
 *
 * CORE ADMIN STUFF ------
 * Dashboard Widgets......................hide widgets you don't want to see
 * Admin area tweaks......................remove admin menu items; hide admin bar
 * Limit number of revisions..............limit revisions saved in db
 * Flush rewrite rules....................on theme switch, flush CPT rewrites
 * Custom Login Page......................styles; logo URL
 * 
 * OTHER ADMIN STUFF ------
 * ACF styling edits......................add styling to alternating rows -- easier to see that way
 * Hide ACF from admin menu...............(commented out by default)
 * Custom footer..........................promote yourself in the WP footer (off by default)
 *
 */


/*------------------------------------*\
    CORE ADMIN STUFF
\*------------------------------------*/

/************* DASHBOARD WIDGETS *****************/

// disable some default dashboard widgets
function disable_default_dashboard_widgets() {
  global $wp_meta_boxes;
  // unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);    // Right Now Widget
  // unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);    // Activity Widget
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);  // Comments Widget
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);  // Incoming Links Widget
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);      // Plugins Widget

  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);    // Quick Press Widget
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);    // Recent Drafts Widget
  // unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);      // Primary Dashboard
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);      // Secondary Dashboard

  // remove plugin dashboard boxes
  unset($wp_meta_boxes['dashboard']['normal']['core']['yoast_db_widget']);      // Yoast's SEO Plugin Widget
  unset($wp_meta_boxes['dashboard']['normal']['core']['rg_forms_dashboard']);      // Gravity Forms Plugin Widget
  unset($wp_meta_boxes['dashboard']['normal']['core']['bbp-dashboard-right-now']);  // bbPress Plugin Widget
  unset($wp_meta_boxes['dashboard']['normal']['core']['tribe_dashboard_widget']);  // TEC Plugin Widget
}

// removing the dashboard widgets
add_action( 'wp_dashboard_setup', 'disable_default_dashboard_widgets' );


/************* CUSTOMIZE ADMIN *******************/

// remove unnecessary admin menus (for admins and non-admins)
function hide_menu_items() {
  if( current_user_can( 'update_core' ) ):
    remove_menu_page( 'edit-comments.php' ); // Comments
  endif;
  if( !current_user_can( 'update_core' ) ):
    remove_menu_page( 'index.php' ); // Dashboard tab
    remove_menu_page( 'edit.php?post_type=page '); // Pages
    remove_menu_page( 'upload.php' ); // Media
    remove_menu_page( 'link-manager.php' ); // Links
    remove_menu_page( 'edit-comments.php' ); // Comments
    remove_menu_page( 'themes.php' ); // Appearance
    remove_menu_page( 'plugins.php' ); // Plugins
    remove_menu_page( 'users.php' ); // Users
    remove_menu_page( 'tools.php' ); // Tools
    remove_menu_page( 'options-general.php' ); // Settings
    // remove_menu_page( 'acf-options' );
  endif;
  }
add_action( 'admin_menu', 'hide_menu_items', 999 );


// Disable the Wordpress Admin Bar for all but admins.
if (!current_user_can('update_core')):
  show_admin_bar(false);
endif;



// Limit Number of Post & Page Revisions
add_filter('wp_revisions_to_keep', 'limit_revisions_by_posttype', 10, 2);
function limit_revisions_by_posttype($num, $post)
{
  $num = 15;
  return $num;
}



// Flush rewrite rules so theme's custom post types work
add_action('after_switch_theme', 'flexdev_flush_rewrite_rules');
function flexdev_flush_rewrite_rules()
{
  flush_rewrite_rules();
}



/************* CUSTOM LOGIN PAGE *****************/

// calling your own login css so you can style it
// updated to proper 'enqueue' method
// http://codex.wordpress.org/Plugin_API/Action_Reference/login_enqueue_scripts
function gdt_login_css() {
  $css_path = get_template_directory() . '/inc/login.css';
  $version = filemtime($css_path);
  wp_enqueue_style( 'gdt_login_css', get_template_directory_uri() . '/inc/login.css', false, $version );
}
// changing the logo link from wordpress.org to your site
function gdt_login_url() { return home_url(); }

// changing the alt text on the logo to show your site name
function gdt_login_title() { return get_option('blogname'); }

// run above functions on the login page
add_action( 'login_enqueue_scripts', 'gdt_login_css', 10 );
add_filter( 'login_headerurl', 'gdt_login_url' );
add_filter( 'login_headertext', 'gdt_login_title' );



/*------------------------------------*\
    OTHER ADMIN STUFF
\*------------------------------------*/

// Add some colour contrast to ACF repeater sections
function custom_acf_repeater_colors()
{
  echo '<style type="text/css">
    .acf-repeater .acf-row:nth-child(odd) > .acf-row-handle.order,
    .acf-repeater .acf-row:nth-child(odd) > .acf-row-handle.remove {
      background: #dadada;
    }
  </style>';
}
add_action('admin_head', 'custom_acf_repeater_colors');



// ++ REMOVE ACF FROM ADMIN MENU
// add_filter('acf/settings/show_admin', '__return_false');



/************* CUSTOM BACKEND FOOTER **************/
// function gdt_custom_admin_footer() {
//   echo '<span id="footer-dev-cred">Developed by <a href="https://mountainairweb.com" target="_blank">Mountain Air Web</a></span>.';
// }
// add_filter('admin_footer_text', 'gdt_custom_admin_footer');


?>
