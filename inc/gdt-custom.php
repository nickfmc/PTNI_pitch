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


// dynamic GB alt tags
add_filter( 'render_block', function( $content, $block ) {
    if (
        'generateblocks/image' !== $block['blockName'] ||
        ! isset( $block['attrs']['mediaId'] )
    ) {
        return $content;
    }

    $image_alt = get_post_meta($block['attrs']['mediaId'], '_wp_attachment_image_alt', TRUE);

    return preg_replace(
        '/(alt=")([^"]*)(")/',
        "$1{$image_alt}$3",
        $content
    );

}, 10, 2 );
 

/**
 * Optional: Customize the validation summary message at the top of the form
 */
function customize_gf_validation_summary($message, $form) {
    return "Il y a des erreurs dans le formulaire. Veuillez les corriger avant de continuer.";
}
add_filter('gform_validation_message', 'customize_gf_validation_summary', 10, 2);


add_filter('gform_field_validation', function($result, $value, $form, $field) {
    if (!$result['is_valid'] && $result['message'] == 'This field is required.') {
        $result['message'] = 'Ce champ est requis.';
    }
    return $result;
}, 10, 4);


add_filter('gform_field_content', function($content, $field) {
    if ($field->isRequired) {
        $content = str_replace('(Required)', '(Requis)', $content);
    }
    return $content;
}, 10, 2);

 


?>
