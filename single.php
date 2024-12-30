<?php get_header(); ?>

<div class="o-layout-row">
  <main id="main-content" class="" role="main" itemscope itemprop="mainContentOfPage" itemtype="https://schema.org/WebPageElement">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <header class="c-article-header">
        <?php get_template_part( 'template-part/post/entry-meta' ); ?>
      </header>
      <!-- /article-header -->
      <article <?php post_class(); ?> role="article">
        <?php the_content(); ?>
      </article>
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
