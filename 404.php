<?php get_header(); ?>

  <div class="o-layout-row">
    <main id="main-content" class="o-wrapper-wide" role="main" itemscope itemprop="mainContentOfPage" itemtype="https://schema.org/WebPageElement">
      <section class="editor-content">
        <div class=" alignwide c-404-content">

      
        <h1 class="h1-style" role="heading" aria-level="1">Page non trouvée</h1>

        <div id="<?php echo esc_attr($id); ?>" class="c-breadcrumbs-Dark">
        <?php
            // Display Yoast SEO breadcrumbs
            if ( function_exists('yoast_breadcrumb') ) {
              yoast_breadcrumb( '<nav aria-label="fil d\'ariane" id="breadcrumbs">','</nav>' );
              }
        ?>
        </div>






          <div class="c-404-inner-content">
            <div>
            <h2 class="is-style-u-eyebrow-heading u-ttu" role="heading" aria-level="2">Erreur 404</h2>
              <p class="has-large-font-size">Nous sommes désolés, mais la page ou le document que vous recherchez est introuvable. Il se peut qu'il ait été supprimé, déplacé vers un nouvel emplacement, que son nom ait été changé ou qu'il soit temporairement indisponible.<p>
                        
                         <h2 class="u-ttu is-style-u-eyebrow-heading u-blue-dark mt-14">Que Pouvez-Vous Faire ?</h2>
                         <ul>
                          <li>Aller à la page <a href="<?php echo home_url(); ?>">d'accueil</a>.</li>
                          <li>Utilisez la fonction de recherche pour trouver les informations que vous cherchez.</li>
                          <li>Si vous croyez qu'il y a une erreur ou si vous avez besoin d'aide, veuillez nous <a href="/contact">contacter</a>.</li>
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
