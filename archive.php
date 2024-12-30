<?php get_header(); ?>

<div class="o-layout-row">
  <main id="main-content" class="o-wrapper-wide" role="main" itemscope itemprop="mainContentOfPage" itemtype="https://schema.org/WebPageElement">
    <?php
      the_archive_title( '<h1 class="">', '</h1>' );
      the_archive_description( '<div class="">', '</div>' );
    ?>
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <article <?php post_class(''); ?> role="article">
        <header class="c-article-header">
          <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
          <?php get_template_part( 'template-part/post/entry-meta' ); ?>
        </header>
        <!-- /article-header -->
        <section class="c-excerpt-content">
          <?php the_excerpt(); ?>
        </section>
        <!-- /c-excerpt-content -->
      </article>
      <!-- /article -->
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
