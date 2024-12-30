  <footer class="o-section c-page-footer" role="contentinfo" itemscope itemtype="https://schema.org/WPFooter">
    <div class="c-page-footer-topper">
      <div class="o-wrapper-wide">
        <p class="is-style-u-eyebrow-heading u-ttu">
        Ligne d&rsquo;urgence PTNI: <a href="tel:18003610608" aria-label="Appeler la ligne d'urgence de PTNI au 1-800-361-0608">1-800-361-0608</a>
        </p>
      </div>
    </div>
    <div class="c-page-footer-spacer"><div class="o-wrapper-wide"></div></div>
    <div class="c-page-footer-nav">
      <div class="o-wrapper-wide">
        <nav class="c-footer-nav" role="navigation" aria-label="Footer Navigation">
        <?php gdt_nav_menu( 'footer-menu', 'c-footer-nav-menu' ); ?>
        </nav>
      </div>
    </div>


    <div class="c-page-footer-main">
      <div class="o-wrapper-wide">
      <div class="grid-x">
          <div class="cell  medium-6">
            <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
              <?php dynamic_sidebar( 'footer-1' ); ?>
            <?php endif; ?>
          </div>
          <div class="cell  medium-6">
          <?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
            <?php dynamic_sidebar( 'footer-2' ); ?>
          <?php endif; ?>
          </div>
         
        </div>
        <!-- /.c-footer-widgets -->
        
        <!-- /.c-logo-copy-wrap -->
      </div>
      <!-- /.o-wrapper-wide -->
    </div>
    <div class="c-page-footer-lower">
      <div class="o-wrapper-wide">
        <div class="">
            <div class="c-copywrite">
              &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>
            </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- /.c-page-footer -->

  <?php // get_template_part( 'template-part/navigation/nav-modal' ); ?>

  <!-- all js scripts are loaded in lib/gdt-enqueues.php -->
  <?php wp_footer(); ?>

</body>
</html>
