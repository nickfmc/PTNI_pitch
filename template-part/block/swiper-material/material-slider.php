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
$id = 'c-material-swiper-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'c-material-swiper';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
if( $is_preview ) {
    $className .= ' is-admin';
}


?>

 
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> ">

<div class="swiper" style="<?php if( get_field('slider_hieght_in_pixels') ) { echo 'height:' . get_field('slider_hieght_in_pixels') . 'px;'; }?>">
      <div class="swiper-wrapper">
        <div class="swiper-slide swiper-slide-b464">
          <div class="swiper-material-wrapper">
            <div class="swiper-material-content">
              <img
                class="swiper-slide-bg-image swiper-slide-bg-image-c61b"
                data-swiper-material-scale="1.25"
                src="https://studio.swiperjs.com/demo-images/models/17.jpg"
              />

              <div
                class="swiper-slide-content swiper-material-animate-opacity swiper-slide-content-499f"
              >
                <div class="swiper-slide-text swiper-slide-text-852c">
                  Nicole
                </div>
              </div>
            </div>
          </div>
        </div>

<?php if( have_rows('slides') ): ?>
 <?php while( have_rows('slides') ): the_row(); ?>
 <div class="swiper-slide swiper-slide-b464">
 <div class="swiper-material-wrapper">
            <div class="swiper-material-content">
    <?php
      $image = get_sub_field('image');
      $size = 'full';
      if($image){
        echo wp_get_attachment_image($image, $size, false, array( 
          'class' => 'swiper-slide-bg-image swiper-slide-bg-image-c61b',
          'data-swiper-material-scale' => '1.25'
        ));
      }
    ?>
    <div
                class="swiper-slide-content swiper-material-animate-opacity swiper-slide-content-499f"
              >
                <div class="swiper-slide-text swiper-slide-text-852c">
<?php if( get_sub_field('title') ) { echo  get_sub_field('title'); }?>
                </div>
            </div>

</div>
        </div>
</div>
<?php endwhile; ?>
<?php endif; ?>


    

      </div>
    </div>



</div>


  

