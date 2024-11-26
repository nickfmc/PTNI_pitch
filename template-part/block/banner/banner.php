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
$id = 'c-img-banner-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'c-img-banner';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
if( $is_preview ) {
    $className .= ' is-admin';
}

// Add .c-img-banner-hero class if image_is_first_content_of_page is true
if (get_field('image_is_first_content_of_page')) {
    $className .= ' c-img-banner-hero';
}
?>


 
<div id="<?php echo esc_attr($id); ?>" class="alignfull <?php echo esc_attr($className); ?>"  >

<?php
$image = get_field('banner_image');
$size = 'full';
$fetchpriority = get_field('image_is_first_content_of_page') ? 'high' : 'low';

// Retrieve the ACF fields for image position and add '%' units
$image_position_x_axis = get_field('image_position_x_axis') ? get_field('image_position_x_axis') . '%' : '50%';
$image_position_y_axis = get_field('image_position_y_axis') ? get_field('image_position_y_axis') . '%' : '50%';

// Create the object-position style
$object_position = $image_position_x_axis . ' ' . $image_position_y_axis;

if ($image) {
    echo wp_get_attachment_image($image, $size, false, array(
        'fetchpriority' => $fetchpriority,
        'style' => 'object-position: ' . esc_attr($object_position) . ';'
    ));
}
?>

</div>
