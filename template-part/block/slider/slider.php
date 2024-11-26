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
$id = 'c-testimonialslider-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'c-testimonialslider';
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

<div class="splide">
  <div class="splide__track">
    <span class="c-top-left"></span>
    <span class="c-bottom-right"></span>
    <div class="splide__list">
      <?php if( have_rows('testimonials') ): ?>
       <?php while( have_rows('testimonials') ): the_row(); ?>
      <div class="splide__slide">
     <p> <?php echo get_sub_field('testimonial'); ?></p>
     <span class="c-testimonial-citation"><?php echo get_sub_field('citation'); ?></span>
      </div>
      <?php endwhile; ?>
      <?php endif; ?>
    </div>
  </div>

  <div class="splide__arrows">
		<button class="splide__arrow splide__arrow--prev">
    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 256 256"><path fill="currentColor" d="m218.8 130.8l-72 72a3.9 3.9 0 0 1-5.6 0a3.9 3.9 0 0 1 0-5.6l65.1-65.2H40a4 4 0 0 1 0-8h166.3l-65.1-65.2a4 4 0 0 1 5.6-5.6l72 72a3.9 3.9 0 0 1 0 5.6Z"/></svg>
		</button>
		<button class="splide__arrow splide__arrow--next">
    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 256 256"><path fill="currentColor" d="M220 128a4 4 0 0 1-4 4H49.7l65.1 65.2a3.9 3.9 0 0 1 0 5.6a3.9 3.9 0 0 1-5.6 0l-72-72a3.9 3.9 0 0 1 0-5.6l72-72a4 4 0 0 1 5.6 5.6L49.7 124H216a4 4 0 0 1 4 4Z"/></svg>

		</button>
  </div>
  
</div>

</div>

<style>
  .my-slider-progress {
    background: #ccc;
  }
  
  .my-slider-progress-bar {
    background: greenyellow;
    height: 2px;
    transition: width 400ms ease;
    width: 0;
  }
</style>
