<?php

/**
 * blockname Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'c-breadcrumbs-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'c-breadcrumbs';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

if( $is_preview ) {
    $className .= ' is-admin';
}


?>
<?php if( get_field('color') ) { $color = get_field('color'); }?>
 
<div id="<?php echo esc_attr($id); ?>" class="c-breadcrumbs-<?php echo $color;?> <?php echo esc_attr($className); ?> ">

<?php if( get_field('title_overide') ) { 
    echo '<h1>' . get_field('title_overide') . '</h1>'; 
} else { 
    echo '<h1>' . get_the_title() . '</h1>'; 
} ?>


<?php
    // Display Yoast SEO breadcrumbs
    if ( function_exists('yoast_breadcrumb') ) {
        yoast_breadcrumb( '<nav aria-label="fil d\'Ariane" id="breadcrumbs">','</nav>' );
    }
    
?>


</div>
