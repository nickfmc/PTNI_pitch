<?php get_header(); ?>

<div class="o-layout-row">
  <main class="o-wrapper-wide" role="main" itemscope itemprop="mainContentOfPage" itemtype="https://schema.org/WebPageElement">


  <section class="editor-content">
  <div class=" alignwide c-search-content">
    <h1 class="h1-style" role="heading" aria-level="1"><span>Search Results for:</span> <?php echo esc_attr(get_search_query()); ?></h1>
    <div id="<?php echo esc_attr($id); ?>" class="c-breadcrumbs-Dark">
        <?php
            // Display Yoast SEO breadcrumbs
            if ( function_exists('yoast_breadcrumb') ) {
                yoast_breadcrumb( '<nav aria-label="breadcrumbs" id="breadcrumbs">','</nav>' );
              }
        ?>
</div>

<div class="c-search-content">
  <div class="c-search-inner-content">
    <div>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
     
        <article <?php post_class(); ?> role="article">
          <header class="c-article-header">
            <h2 class="h4-style"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
            
          </header>
          <!-- /c-article-header -->
          <section class="c-excerpt-content">
            <?php the_excerpt(); ?>
          </section>
          <!-- /c-excerpt-content -->
        </article>
        <!-- /article -->
            <?php endwhile; ?>
        <?php get_template_part( 'template-part/post/post-nav' ); ?>
        
            <?php else : ?>
        <article class="PostNotFound">
          <header class="ArticleHeader">
            <h4><?php _e("Sorry, No Results.", "flexdev"); ?></h4>
          </header>
          <section class="EntryContent">
            <p><?php _e("Please try another search.", "flexdev"); ?></p>
          </section>
        </article>
  
    <?php endif; ?>
            </div>
    </div>
    </div>


  </div>



    
    
   
    </section>
  </main>
</div>
<!-- /layout-row-->

<?php get_footer(); ?>
