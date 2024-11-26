<article <?php post_class(''); ?> role="article">

  <header class="c-article-header">
    <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
    <?php get_template_part( 'template-part/post/entry-meta' ); ?>
  </header> <!-- /article-header -->

  <section class="editor-content">
    <?php the_excerpt(); ?>
  </section> <!-- /editor-content -->

</article> <!-- /article -->