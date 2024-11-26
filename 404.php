<?php get_header(); ?>

  <div class="o-layout-row">
    <main class="o-wrapper-wide" role="main" itemscope itemprop="mainContentOfPage" itemtype="https://schema.org/WebPageElement">
      <section class="editor-content">
        <div class=" alignwide c-404-content">

      
        <h1 class="h1-style" role="heading" aria-level="1">Page Not Found</h1>

        <div id="<?php echo esc_attr($id); ?>" class="c-breadcrumbs-Dark">
        <?php
            // Display Yoast SEO breadcrumbs
            if ( function_exists('yoast_breadcrumb') ) {
                yoast_breadcrumb( '<nav aria-label="breadcrumbs" id="breadcrumbs">','</nav>' );
              }
        ?>
        </div>






          <div class="c-404-inner-content">
            <div>
            <h2 class="is-style-u-eyebrow-heading u-ttu" role="heading" aria-level="2">404 Error</h2>
              <p class="has-large-font-size">We are sorry, but the page or document you are looking for cannot be found. It might have been removed, moved to a new location, had its name changed, or is temporarily unavailable.<p>
                        
                         <h2 class="u-ttu is-style-u-eyebrow-heading u-blue-dark mt-14">What can you do?</h2>
                         <ul>
                          <li>Go to the <a href="<?php echo home_url(); ?>">Homepage</a>.</li>
                          <li>Use the search functionality to find the information you are looking for.</li>
                          <li>If you believe there is an error or need further assistance, please <a href="/contact">contact us</a>.</li>
                         </ul>
            </div>
        
          </div>
          <div>
         
          </div>
        </div>
      </section>
      <!-- /editor-content -->
    </main>
    <!-- /container -->
  </div>
  <!-- /layout-row-->

<?php get_footer(); ?>
