<?php
/**
 * Custom functions for this project? If yes, drop them here!
 */

  // If using acf icon picker - https://github.com/houke/acf-icon-picker -  modify the path to the icons directory
//   add_filter( 'acf_icon_path_suffix', 'acf_icon_path_suffix' );

//   function acf_icon_path_suffix( $path_suffix ) {
//       return 'img/icons/';
//   }

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
    // Translation for invalid email message
    if ($result['message'] == 'The email address entered is invalid, please check the formatting (e.g. email@domain.com).') {
        $result['message'] = "L'adresse courriel entrée est invalide, veuillez vérifier le format (par ex. courriel@domaine.com).";
    }
    if ($result['message'] == 'Please enter a valid Website URL (e.g. https://gravityforms.com).') {
        $result['message'] = "Veuillez entrer une URL de site Web valide (ex: https://ptni.ca).";
    }
      if ($result['message'] == 'Sorry, this file extension is not permitted for security reasons.' || 
        strpos($result['message'], 'Sorry, this file extension is not permitted for security reasons.') !== false) {
        
        // Extract filename if it exists in the message
        $filename = '';
        if (strpos($result['message'], ' - Sorry, this file extension') !== false) {
            $parts = explode(' - ', $result['message']);
            $filename = $parts[0] . ' - ';
        }
        
        $result['message'] = $filename . "Désolé, cette extension de fichier n'est pas autorisée pour des raisons de sécurité.";
    }
    
    
    return $result;
}, 10, 4);


add_filter('gform_field_content', function($content, $field) {
    if ($field->isRequired) {
        $content = str_replace('(Required)', '(Requis)', $content);
    }

    $content = str_replace('Drop files here or ', 'Déposez les fichiers ici ou ', $content);
    $content = str_replace('Select files', 'Sélectionner les fichiers', $content);
    $content = str_replace('Max. file size: ', 'Taille maximale du fichier : ', $content);
    $content = str_replace('Accepted file types: ', 'Types de fichiers acceptés : ', $content);
    $content = str_replace('Max. files', 'Maximum. fichiers', $content);


    return $content;
}, 10, 2);







 

/**
 * Modify Yoast SEO search page title
 *
 * @param string $title The current title
 * @return string Modified title
 */
function modify_yoast_search_title( $title ) {
    if ( is_search() ) {
        $search_term = get_search_query();
        if ( ! empty( $search_term ) ) {
            return sprintf( 
                'Résultats de recherche pour: "%s"', 
                esc_html( $search_term )
            );
        }
    }
    return $title;
}
add_filter( 'wpseo_title', 'modify_yoast_search_title' );


//* Remove Yoast SEO breadcrumbs from Revelanssi's search results

add_filter( 'the_content', 'wpdocs_remove_shortcode_from_index' );

function wpdocs_remove_shortcode_from_index( $content ) {

    if ( is_search() ) {

        $content = strip_shortcodes( $content );

    }

    return $content;

}


?>
