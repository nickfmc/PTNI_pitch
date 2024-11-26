<?php

/***********************************************
IMAGES & CROPPING - #images
************************************************/

/************* IMAGE SIZE OPTIONS *************/

// Default thumb size
set_post_thumbnail_size( 150, 150, true );

// Image crop sizes
add_image_size( 'crop-1200-500', 1200, 500, true );

// Add support for hard cropping WordPress medium image size
// update_option( 'medium_crop', 1 );



/************ ADD IMAGE SIZES TO WP EDITOR MEDIA SELECTOR ********/
/*
The function below adds the ability to use the dropdown menu to select
the new images sizes you have just created from within the media manager
when you add media to your content blocks. If you add more image sizes,
duplicate one of the lines in the array and name it according to your
new image size.
*/

// add_filter( 'image_size_names_choose', 'gdt_custom_image_sizes' );
// function gdt_custom_image_sizes( $sizes ) {
//   return array_merge( $sizes, array(
//     'crop-1200-500' => __('1200px by 500px'),
//   ) );
// }


/**
 * Responsive Image Helper Function
 *
 * @param string $image_id the id of the image (from ACF or similar)
 * @param string $image_size the size of the thumbnail image or custom image size
 * @param string $max_width the max width this image will be shown to build the sizes attribute
 * DEMO USAGE: <img class="" <?php echo gdt_responsive_image( get_field( 'test_image' ), 'crop-1200-500', '1200px' ); ?> />
 */

function gdt_responsive_image( $image_id, $image_size, $max_width ) {
	// check the image ID is not blank
	if($image_id != '') {
		// set the default src image size
		$image_src = wp_get_attachment_image_url( $image_id, $image_size );

		// set the srcset with various image sizes
		$image_srcset = wp_get_attachment_image_srcset( $image_id, $image_size );

    // get the alt text for this image
    $image_alt_text = get_post_meta( $image_id, '_wp_attachment_image_alt', true );

		// generate the markup for the responsive image
		$responsive_image = 'src="' . $image_src . '" srcset="' . $image_srcset . '" sizes="(max-width: ' . $max_width . ') 100vw, ' . $max_width . '" alt="' . $image_alt_text . '"';
		return $responsive_image;
	}
}




?>
