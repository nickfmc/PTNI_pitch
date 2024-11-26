<?php
/**
 * GutenDev Custom Taxonomy Registration Party
 * REMBEMBER -> Uncomment / add this file to functions.php
 */


// register ###REPLACE_ME### custom taxonomy
 add_action( 'init', 'gdt_CUSTOMTAX_reg', 0 );

// create taxonomy, for the post type(s) you connect it to below
function gdt_CUSTOMTAX_reg() {
  // Add new taxonomy, make it hierarchical (like categories)
  $singular = 'SampleTax';
  $plural = 'SampleTaxs';
  $labels = array(
    'name'              => "$plural",
    'singular_name'     => "$singular",
    'search_items'      => "$plural",
    'all_items'         => "$plural",
    'parent_item'       => "Parent $singular",
    'parent_item_colon' => "Parent $singular",
    'edit_item'         => "Edit $singular",
    'update_item'       => "Update $singular",
    'add_new_item'      => "Add New $singular",
    'new_item_name'     => "New $singular Name",
    'menu_name'         => "$plural"
  );
  $args = array(
    'public'            => false,
    'show_in_rest'      => true,
    'hierarchical'      => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => false  /* true or use custom slug => array( 'slug' => 'custom-tag-slug', 'with_front' => false  ) */
  );
  register_taxonomy( 'taxonomyname_tax', array( 'postname_type' ), $args );
}



?>
