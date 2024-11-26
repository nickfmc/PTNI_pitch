<?php
/**
 * Custom functions for this project? If yes, drop them here!
 */

  // If using acf icon picker - https://github.com/houke/acf-icon-picker -  modify the path to the icons directory
//   add_filter( 'acf_icon_path_suffix', 'acf_icon_path_suffix' );

//   function acf_icon_path_suffix( $path_suffix ) {
//       return 'img/icons/';
//   }
  
//used for Stackable blocks support - match to wrapper width 
global $content_width;
$content_width = 1180;


// generateblocks PRO breakpoints
add_action( 'wp', function() {
  add_filter( 'generateblocks_media_query', function( $query ) {
      $query['desktop'] = '(min-width: 1140px)';
      $query['tablet'] = '(max-width: 1139px)';
      $query['tablet_only'] = '(max-width: 1139px) and (min-width: 767px)';
      $query['mobile'] = '(max-width: 767px)';

      return $query;
  } );
}, 20 );



// Yoast Breadcrumbs Accessibility fix
// Convert the Yoast Breadcrumbs output wrapper into an ordered list.
add_filter( 'wpseo_breadcrumb_output_wrapper', function() {
	return 'ol';
} );

// Convert the Yoast Breadcrumbs single items into list items.
add_filter( 'wpseo_breadcrumb_single_link_wrapper', function() {
	return 'li';
} );

add_filter( 'wpseo_breadcrumb_separator', function() {
    return '<li class="breadcrumb-seperator" aria-hidden="true"> <span>/</span>/ </li>';
} );




class Custom_Menu_Walker extends Walker_Nav_Menu {
    // Start Level
    function start_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"sub-menu\">\n";
    }

    // Start Element
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        if (!empty($args->has_children)) {
            $classes[] = 'menu-item-has-children';
        }

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $id = apply_filters('nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';

        // Render top-level items differently
        if ($depth == 0) {
            $output .= $indent . '<li' . $id . $class_names .'>';
            $output .= '<button aria-haspopup="true" aria-expanded="false"><span>' . apply_filters('the_title', $item->title, $item->ID) . '</span></button>';
            return;
        }

        $output .= $indent . '<li' . $id . $class_names .'>';

        $atts = array();
        $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
        $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
        $atts['href']   = ! empty( $item->url )        ? $item->url        : '';

        if (!empty($args->has_children)) {
            $atts['aria-haspopup'] = 'true';
            $atts['aria-expanded'] = 'false';
        }

        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args);

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (! empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    // Check if item has children
    function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {
        if (!$element)
            return;

        $id_field = $this->db_fields['id'];

        // Display this element
        if (is_array($args[0]))
            $args[0]['has_children'] = !empty($children_elements[$element->$id_field]);
        else if (is_object($args[0]))
            $args[0]->has_children = !empty($children_elements[$element->$id_field]);

        parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
}


// class Custom_Menu_Walker extends Walker_Nav_Menu {
//     // Start Level
//     function start_lvl(&$output, $depth = 0, $args = array()) {
//         $indent = str_repeat("\t", $depth);
//         $output .= "\n$indent<ul class=\"sub-menu\" role=\"menu\">\n";
//     }

//     // Start Element
//     function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
//         $indent = ($depth) ? str_repeat("\t", $depth) : '';

//         $classes = empty($item->classes) ? array() : (array) $item->classes;
//         $classes[] = 'menu-item-' . $item->ID;

//         if (!empty($args->has_children)) {
//             $classes[] = 'menu-item-has-children';
//         }

//         $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
//         $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

//         $id = apply_filters('nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args);
//         $id = $id ? ' id="' . esc_attr($id) . '"' : '';

//         $output .= $indent . '<li' . $id . $class_names .'>';

//         $atts = array();
//         $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
//         $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
//         $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
//         $atts['href']   = ! empty( $item->url )        ? $item->url        : '';

//         if (!empty($args->has_children) && $depth == 0) {
//             $atts['aria-haspopup'] = 'true';
//             $atts['aria-expanded'] = 'false';
//         }

//         $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args);

//         $attributes = '';
//         foreach ($atts as $attr => $value) {
//             if (! empty($value)) {
//                 $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
//                 $attributes .= ' ' . $attr . '="' . $value . '"';
//             }
//         }

//         $item_output = $args->before;

//         if (!empty($args->has_children) && $depth == 0) {
//             $item_output .= '<button aria-haspopup="true" aria-expanded="false"><span>';
//             $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
//             $item_output .= '</span></button>';
//         } else {
//             $item_output .= '<a'. $attributes .'><span>';
//             $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
//             $item_output .= '</span></a>';
//         }

//         $item_output .= $args->after;

//         $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
//     }

//     // Check if item has children
//     function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {
//         if (!$element)
//             return;

//         $id_field = $this->db_fields['id'];

//         // Display this element
//         if (is_array($args[0]))
//             $args[0]['has_children'] = !empty($children_elements[$element->$id_field]);
//         else if (is_object($args[0]))
//             $args[0]->has_children = !empty($children_elements[$element->$id_field]);

//         parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
//     }
// }
// ****************** Grab custom data and input into Generate Block headline field ************

                  // function custom_field_gb_query() {
                  //   // Start output buffering
                  //   ob_start();
                  //     //  shortcode content
                      

                  //   $output = ob_get_clean();

                  //   // Return the content as a string
                  //   return $output;
                  // }
                  // add_shortcode('custom_field_gb_query', 'custom_field_gb_query');



                  // add_filter( 'render_block_generateblocks/headline', function( $block_content, $block ) {
                  //   if ( 
                  //     !is_admin() && 
                  //     ! empty( $block['attrs']['className'] ) && 
                  //     strpos( $block['attrs']['className'], 'is-field-name' ) !== false 
                  //   ) {
                  //     $post_id = get_the_ID();
                  //     $block_content = do_shortcode('[custom_field_gb_query]');		
                  //   }

                  //   return $block_content;
                  // }, 10, 2 );

// ****************** Grab custom data and input into Generate Block headline field ************

?>
