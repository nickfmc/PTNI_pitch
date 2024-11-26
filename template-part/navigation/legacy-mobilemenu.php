
<div id="modal-navigation" class="mfp-hide  c-modal-navigation">
  
  <?php // class name for button below MUST match id above with "close" added to it, ex: CLOSE-id-name ?>
  <span class="close-modal-navigation">&times;</span>

  <div class="c-modal-nav-wrap">

    <h2>MENU</h2>
    <nav class="c-modal-nav" role="navigation" itemscope itemtype="https://schema.org/SiteNavigationElement">
      <ul class="c-modal-menu">
        <?php
          $pageargs = array(
            'depth' => 2,
            'exclude' => '',
            'title_li' => '',
            'sort_column'=> 'menu_order',
            'sort_order'=> 'asc',
            );
          wp_list_pages( $pageargs );
        ?>
      </ul>
      <?php // gdt_nav_menu( 'main-menu', 'modal-menu' ); // Adjust using Menus in WordPress Admin ?>
    </nav>

  </div> <!-- /modal-nav-wrap -->
</div> /modal-navigation
