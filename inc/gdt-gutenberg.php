<?php
/**
 * All your Gutenbergs belong to GDT. What does that mean?
 * Anyway, theme support and custom stuff related to Gutenberg belongs below.
 */

// ++ NOTE: More theme support options are available. Info here: 
// https://developer.wordpress.org/block-editor/developers/themes/theme-support/


// ++ Add the corresponding classname to wide block wrappers ( alignwide or alignfull )
add_theme_support( 'align-wide' ); 
add_theme_support( 'responsive-embeds' );


// ++ Enqueue block editor customization file...That is where we do our Gutenberg hackin'
function gdt_customizing_blocks() {
  wp_enqueue_script(
      'gdt_customizing_blocks',
      get_theme_file_uri('/dist/gutenberg-custom.js'), 
    array('wp-blocks', 'wp-dom'), 
    filemtime( get_stylesheet_directory() . '/dist/gutenberg-custom.js' ),
    true
  );
}
add_action( 'enqueue_block_editor_assets', 'gdt_customizing_blocks' );


/**
 * Add a block category for if it doesn't exist already.
 *
 * @param array $categories Array of block categories.
 *
 * @return array
 */



function custom_block_category( $categories ) {
  return array_merge(
      array(
          array(
              'slug' => 'my-blocks',
              'title' => __( 'Custom Blocks', 'my-blocks' ),
          ),
      ),
      $categories
  );
}
add_filter( 'block_categories_all', 'custom_block_category', 10, 2 );


// Register Block Scripts
function maw_register_guten_script() {
  function get_script_version($script_path) {
    $file_path = get_template_directory() . $script_path;
    if (file_exists($file_path)) {
        return filemtime($file_path);
    }
    return false; 
}
  wp_register_script( 'splide', get_template_directory_uri() .'/src/js/splide.min.js', [ 'acf' ], get_script_version('/src/js/splide.min.js'));
  wp_register_script( 'slider', get_template_directory_uri() .'/template-part/block/slider/slider.js', [ 'splide' , 'acf' ], get_script_version('/template-part/block/slider/slider.js'));
  wp_register_script( 'swiper', get_template_directory_uri() .'/dist/swiper-bundle.min.js', [], get_script_version('/dist/swiper-bundle.min.js')); 
  wp_register_script( 'effects', get_template_directory_uri() .'/template-part/block/swiper-material/effect-material.min.js', [], get_script_version('/template-part/block/swiper-material/effect-material.min.js'));
  wp_register_script( 'material-slider', get_template_directory_uri() .'/template-part/block/swiper-material/slider.js', [ 'swiper' ,'effects' , 'acf' ], get_script_version('/template-part/block/swiper-material/slider.js'));
  wp_register_script( 'project-slider', get_template_directory_uri() .'/template-part/block/swiper-projects/project-slider.js', [ 'swiper' ,'effects' , 'acf' ], get_script_version('/template-part/block/swiper-projects/project-slider.js'));
}
  add_action( 'init', 'maw_register_guten_script' );

// Add ACF json blocks.

function register_acf_blocks() { 
  register_block_type(  get_stylesheet_directory() . '/template-part/block/banner/block.json' );
  register_block_type(  get_stylesheet_directory() . '/template-part/block/breadcrumbs/block.json' );
  register_block_type(  get_stylesheet_directory() . '/template-part/block/videoplayer/block.json' );
  // register_block_type(  get_stylesheet_directory() . '/template-part/block/swiper-material/block.json' );
  // register_block_type(  get_stylesheet_directory() . '/template-part/block/swiper-projects/block.json' );
}

add_action( 'init', 'register_acf_blocks', 5 );




?>
