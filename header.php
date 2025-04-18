<!doctype html>
<html class="no-js" lang="fr-CA">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  
  <?php // Are you using REAL FAVICON GENERATOR!? You should. If so...  ?>
  <?php // Put generated code in favicon-head.php file; then uncomment line below ?>
  <?php // get_template_part( 'template-part/favicon-head' ); ?>

  <?php // other html head stuff (before WP/theme scripts are loaded) ------- ?>

  <?php wp_head(); // wordpress head functions -- DONOTREMOVE ?>

  <?php // START Google Analytics here ?>
  <?php // END Analytics ?>
</head>

<!-- Google tag (gtag.js) --> <script async src="https://www.googletagmanager.com/gtag/js?id=G-J2551X1JBQ"></script> <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'G-J2551X1JBQ'); </script>

<body <?php 
    $classes = pretty_body_class();
    if (get_field('is_dark_page')) {
        $classes .= ' is-dark-page';
    }
    body_class($classes); 
?> itemscope itemtype="https://schema.org/WebPage">

<!-- Skip links should be the first focusable elements -->
<div class="skip-links">
<a href="#main-content" class="skip-link">Passer au contenu principal</a>
<a href="#site-navigation" class="skip-link">Passer à la navigation principale</a>
<a href="#c-page-footer" class="skip-link">Passer au pied de page</a>
</div>

  <header id="c-page-header" class="o-section c-page-header" role="banner" itemscope itemtype="https://schema.org/WPHeader">
    <div class="c-page-header-upper">
      <div class="o-wrapper-wide">
        <div class="c-page-header-upper-inner" role="contentinfo" aria-label="Emergency Contact">
            <span>Ligne d'urgence :<a href="tel:18003610608" aria-label="Appeler la ligne d'urgence 1 800 361 0608">1-800-361-0608</a></span>
        </div>
      </div>
    </div>
    <div class="c-header-spacer"></div>
  <div class="c-header-main">
    <div class="c-nav-bg"></div>
    <div class="o-wrapper-wide  u-relative">
        <?php get_template_part( 'template-part/header/logo' ); ?>
        <?php get_template_part( 'template-part/navigation/nav-main' ); ?>
        <?php get_template_part( 'template-part/navigation/nav-tertiary' ); ?>
     
        <div class="c-cl-mobile-nav">
          <button href="#" id="open-modal-nav" class="c-modal-nav-button" aria-haspopup="true" aria-expanded="false" aria-label="Open menu">
          
            <svg width="100%" height="100%" viewBox="0 0 12 9" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
              <path d="M0,0.5C0,0.226 0.226,0 0.5,0L11.5,0C11.774,0 12,0.226 12,0.5C12,0.774 11.774,1 11.5,1L0.5,1C0.226,1 0,0.774 0,0.5ZM0,4.5C0,4.226 0.226,4 0.5,4L11.5,4C11.774,4 12,4.226 12,4.5C12,4.774 11.774,5 11.5,5L0.5,5C0.226,5 0,4.774 0,4.5ZM0,8.5C0,8.226 0.226,8 0.5,8L11.5,8C11.774,8 12,8.226 12,8.5C12,8.774 11.774,9 11.5,9L0.5,9C0.226,9 0,8.774 0,8.5Z" style="fill-rule:nonzero;"/>
            </svg>
            </button>

            <div class="c-lang-select  c-lang-select--mobile" role="navigation" aria-label="Language selector">
            <a href="https://ptni.ca/" class="c-lang-select-btn c-lang-select--current" id="lang-fr" aria-label="Sélectionner le français">FR</a>
            <a href="https://tnpi.ca" class="c-lang-select-btn " id="lang-en" aria-label="Sélectionner l'anglais">EN</a>
        
</div>
    
          <div class="x-body-wrapper"></div>
            <div id="modal-nav-wrap" class="c-modal-nav-wrap" tabindex="-1"  aria-modal="true" hidden>
              

              
              <nav class="c-modal-nav" aria-label="Mobile navigation menu" role="navigation" itemscope itemtype="https://schema.org/SiteNavigationElement">
              <div class="c-modal-nav-header-upper">
                <div class="o-wrapper-wide">
                <div class="c-page-header-upper-inner" role="contentinfo" aria-label="Emergency Contact">
                      <span>Ligne d'urgence: <a href="tel:18003610608" aria-label="Appeler la ligne d'urgence 1 800 361 0608">1-800-361-0608</a></span>
                  </div>
                </div>
              </div>
              <div class="c-modal-nav-header">

              <button id="close-modal-nav" class="c-close-modal-nav" aria-label="Fermer le menu" aria-expanded="flase">
              <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 50 50"><path fill="currentColor" d="m37.304 11.282l1.414 1.414l-26.022 26.02l-1.414-1.413z"/><path fill="currentColor" d="m12.696 11.282l26.022 26.02l-1.414 1.415l-26.022-26.02z"/></svg>
              </button>
              
                <div class="c-modal-nav-logo">
                  <a href="/" rel="nofollow">
                    <img src="<?php bloginfo('template_url') ?>/img/tnpi-logo-en.svg" alt="<?php bloginfo('name'); ?>" />
                  </a>
                </div> <!-- /c-main-logo -->
                <div class="c-lang-select  c-lang-select--mobile-menu" role="navigation" aria-label="Language selector">
                <a href="https://ptni.ca/" class="c-lang-select-btn c-lang-select--current" id="lang-fr" aria-label="Sélectionner le français">FR</a>
                <a href="https://tnpi.ca" class="c-lang-select-btn " id="lang-en" aria-label="Sélectionner l'anglais">EN</a>
        
</div>
              </div>
                <?php  gdt_nav_menu( 'mobile-menu', 'c-mobile-menu' ); // Adjust using Menus in WordPress Admin ?>

                
                

 <!-- <form role="search" method="get" id="search-form" class="c-search-form" action="<?php echo home_url( '/' ); ?>">
  <fieldset>
    <legend class="u-visually-hidden">Rechercher</legend> 
 <div>
      <label for="s" class="u-visually-hidden">Rechercher :</label> 
      <input type="search" id="s" name="s" value="" class="search-input" placeholder="Rechercher..." aria-label="Rechercher" />
      <button type="submit" id="search-submit" class="search-submit" aria-label="Soumettre la recherche"><svg version="1.1" id="main" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="40.844px" height="40.84px" viewBox="0 0 40.844 40.84" enable-background="new 0 0 40.844 40.84" xml:space="preserve">
<path fill="#FFFFFF" d="M40.844,37.94L40.844,37.94l-8.84-8.837c2.438-3.065,3.896-6.942,3.896-11.154C35.9,8.052,27.85,0,17.951,0
	S0,8.052,0,17.949c0,9.898,8.053,17.95,17.951,17.95c4.213,0,8.088-1.459,11.154-3.896l8.838,8.836v0.001h2.9V37.94L40.844,37.94z
	 M4,17.949C4,10.258,10.26,4,17.951,4S31.9,10.258,31.9,17.949c0,3.563-1.344,6.817-3.551,9.285l-1.111,1.113
	c-2.469,2.207-5.723,3.552-9.287,3.552C10.26,31.899,4,25.642,4,17.949z"></path>
</svg></button>
    </div>
  </fieldset>
</form> -->

<form role="search" method="get" id="search-form" class="c-search-form" action="<?php echo home_url( '/' ); ?>">
    <div class="search-wrapper">
        <!-- Single, properly associated label -->
        <label for="search-input" class="u-visually-hidden">Rechercher</label>
        
        <input type="search" 
               id="search-input" 
               name="s" 
               class="search-input" 
               placeholder="Search..." />

        <button type="submit" 
                class="search-submit" 
                aria-label="Submit search">
            <svg version="1.1" 
                 xmlns="http://www.w3.org/2000/svg" 
                 xmlns:xlink="http://www.w3.org/1999/xlink" 
                 x="0px" 
                 y="0px" 
                 width="40.844px" 
                 height="40.84px" 
                 viewBox="0 0 40.844 40.84" 
                 enable-background="new 0 0 40.844 40.84" 
                 xml:space="preserve"
                 aria-hidden="true">
                <title>Icône de recherche</title>
                <path fill="#FFFFFF" d="M40.844,37.94L40.844,37.94l-8.84-8.837c2.438-3.065,3.896-6.942,3.896-11.154C35.9,8.052,27.85,0,17.951,0
                    S0,8.052,0,17.949c0,9.898,8.053,17.95,17.951,17.95c4.213,0,8.088-1.459,11.154-3.896l8.838,8.836v0.001h2.9V37.94L40.844,37.94z
                    M4,17.949C4,10.258,10.26,4,17.951,4S31.9,10.258,31.9,17.949c0,3.563-1.344,6.817-3.551,9.285l-1.111,1.113
                    c-2.469,2.207-5.723,3.552-9.287,3.552C10.26,31.899,4,25.642,4,17.949z"></path>
            </svg>
        </button>
    </div>
</form>





              </nav>
            </div> <!-- /modal-nav-wrap -->
        </div>
      </div>
      <!-- /o-wrapper-wide-->
  </div>
  </header> 
  <!-- /c-page-header -->
