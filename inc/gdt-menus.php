<?php
  
/*********************************************
 MENU SETUP - #navigation
**********************************************/


// setup wp_nav_menu stuff.............

// registering WP nav menus
register_nav_menus(
  array(
    'main-menu' => 'Primary Menu',           // main nav menu
    'tertiary-menu' => 'Tertiary Menu',      // tertiary nav menu
    'mobile-menu' => 'Mobile Menu',      // mobile nav menu
    'footer-menu' => 'Footer Menu'           // footer nav menu
  )
);


/* usage: <?php gdt_nav_menu( 'main-menu', 'c-menu-main' ); ?> */
function gdt_nav_menu( $theme_location, $class )
{
  $menu = null;
  if (has_nav_menu( $theme_location )) {
    $menu = wp_nav_menu(array(
      'container' => false,
      'theme_location' => $theme_location,
      'menu_class' => $class . '',
      'echo' => 0,
    ));
  } 
  echo $menu;
}


function walked_nav_menu( $theme_location, $menu_class, $args = array() ) {
    $defaults = array(
        'theme_location' => $theme_location,
        'menu_class'     => $menu_class,
    );
    $args = wp_parse_args( $args, $defaults );
    wp_nav_menu( $args );
}




/*
 * Adds menu data support for HC Off-canvas Nav
 */

$hc_nav_menu_walker;

class HC_Walker_Nav_Menu extends Walker_Nav_Menu {

  public function start_lvl(&$output, $depth = 0, $args = array()) {
    global $hc_nav_menu_walker;
    $hc_nav_menu_walker->start_lvl($output, $depth, $args);
  }

  public function end_lvl(&$output, $depth = 0, $args = array()) {
    global $hc_nav_menu_walker;
    $hc_nav_menu_walker->end_lvl($output, $depth, $args);
  }

  public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
    global $hc_nav_menu_walker;

    $item_output = '';

    $hc_nav_menu_walker->start_el($item_output, $item, $depth, $args, $id);

    if ($item->current_item_parent) {
      $item_output = preg_replace('/<li/', '<li data-nav-active', $item_output, 1);
    }

    if ($item->current) {
      $item_output = preg_replace('/<li/', '<li data-nav-highlight', $item_output, 1);
    }

    $output .= $item_output;
  }

  public function end_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
    global $hc_nav_menu_walker;
    $hc_nav_menu_walker->end_el($output, $item, $depth, $args, $id);
  }
}

add_filter('wp_nav_menu_args', function($args) {
  global $hc_nav_menu_walker;

  if (!empty($args['walker'])) {
    $hc_nav_menu_walker = $args['walker'];
  }
  else {
    $hc_nav_menu_walker = new Walker_Nav_Menu();
  }

  $args['walker'] = new HC_Walker_Nav_Menu();

  return $args;
});


?>