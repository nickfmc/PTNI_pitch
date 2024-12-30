<?php get_header(); ?>

<div class="o-layout-row">
  <main id="main-content" class="o-wrapper-wide" role="main" itemscope itemprop="mainContentOfPage" itemtype="https://schema.org/WebPageElement">
    
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <?php get_template_part( 'template-part/post/content' ); ?>
    <?php endwhile; ?>
      <?php get_template_part( 'template-part/post/post-nav' ); ?>
    <?php else : ?>
      <?php get_template_part( 'template-part/post/not-found' ); ?>
    <?php endif; ?>

    <?php get_sidebar(); // sidebar ?>

  </main>
</div>
<!-- /layout-row-->

<?php get_footer(); ?>
