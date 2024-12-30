<?php
/*
Template Name: Blank (Full Wide) Page
*/
?>

<?php get_header(); ?>

<div class="o-layout-row">
  <main id="main-content" class="" role="main" itemscope itemprop="mainContentOfPage" itemtype="https://schema.org/WebPageElement">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <?php the_content(); ?>
    <?php endwhile; endif; // END main loop (if/while) ?>
  </main>
</div>
<!-- /layout-row-->

<?php // IF USING PARTS -> get_template_part( 'template-part/name-of-part' ); ?>

<?php get_footer(); ?>
