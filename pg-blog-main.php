<?php
/*
Template Name: Blog Main Page
*/
?>

<?php get_header(); ?>

<div class="o-layout-row">
  <main id="main-content" class="" role="main" itemscope itemprop="mainContentOfPage" itemtype="https://schema.org/WebPageElement">
    <div class="editor-content  clearfix">
      <h1 class="">Blog</h1>
      <?php
        $temp = $wp_query;
        $wp_query = null;
        $wp_query = new WP_Query(
          array(
            'posts_per_page' => 1,
            'paged' => $paged
          )
        );
      ?>
      <?php if ($wp_query->have_posts()) : while ($wp_query->have_posts()) : $wp_query->the_post(); ?>

        <article <?php post_class('post-intro'); ?> role="article" itemscope itemtype="https://schema.org/BlogPosting">
          <section class="editor-content  clearfix" itemprop="articleBody">
            <h2 itemprop="headline"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
            <?php echo gdt_content_excerpt( 175 ); ?>
            <?php get_template_part( 'template-part/post/entry-meta' ); ?>
          </section>
          <!-- /editor-content -->
        </article>
        <!-- /post-intro -->

      <?php endwhile; endif; ?>

      <?php /* Display navigation to next/previous pages when applicable */ ?>
      <?php if ( $wp_query->max_num_pages > 1 ) : ?>
        <?php $max_page = $wp_query->max_num_pages; ?>
        <nav class="c-post-nav">
          <ul class="">
            <li class="post-nav-prev"><?php next_posts_link(__('&laquo; Older Entries', 'flexdev')) ?></li>
             <?php if (($paged < $max_page) && ($paged > 1))  { echo "<li class='nav-divider'><span>|</span></li>"; }  ?>
            <li class="post-nav-next"><?php previous_posts_link(__('Newer Entries &raquo;', 'flexdev')) ?></li>
          </ul>
        </nav>
      <?php endif; ?>

      <?php $wp_query = null; $wp_query = $temp; ?>
      <?php wp_reset_postdata(); ?>

    </div>
    <!-- /editor-content -->

    <?php get_sidebar(); // sidebar ?>

  </main>
</div>
<!-- /layout-row -->

<?php get_footer(); ?>
