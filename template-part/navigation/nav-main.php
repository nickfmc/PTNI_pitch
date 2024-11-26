<nav id="site-navigation" class="c-main-navigation" role="navigation" itemscope itemtype="https://schema.org/SiteNavigationElement">
    <?php
    walked_nav_menu( 'main-menu', 'c-main-menu', array(
        'walker' => new Custom_Menu_Walker()
    ) ); // Adjust using Menus in WordPress Admin ?>
<button id="search-button" aria-label="Open search" aria-expanded="false" aria-controls="search-popup">
<svg version="1.1" id="main" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 width="40.844px" height="40.84px" viewBox="0 0 40.844 40.84" enable-background="new 0 0 40.844 40.84" xml:space="preserve">
<path fill="#FFFFFF" d="M40.844,37.94L40.844,37.94l-8.84-8.837c2.438-3.065,3.896-6.942,3.896-11.154C35.9,8.052,27.85,0,17.951,0
	S0,8.052,0,17.949c0,9.898,8.053,17.95,17.951,17.95c4.213,0,8.088-1.459,11.154-3.896l8.838,8.836v0.001h2.9V37.94L40.844,37.94z
	 M4,17.949C4,10.258,10.26,4,17.951,4S31.9,10.258,31.9,17.949c0,3.563-1.344,6.817-3.551,9.285l-1.111,1.113
	c-2.469,2.207-5.723,3.552-9.287,3.552C10.26,31.899,4,25.642,4,17.949z"/>
</svg>
</button>

<div id="search-popup" role="dialog" aria-hidden="true" inert="true">
  <button type="button" id="close-search-popup" class="c-search-close-button" aria-label="Close search popup" onclick="closeSearchPopup()">
    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 width="16.972px" height="16.971px" viewBox="0 0 16.972 16.971" enable-background="new 0 0 16.972 16.971" xml:space="preserve">
<polyline fill="#FFFFFF" points="0.708,16.971 16.971,0.708 16.264,0 0.001,16.264 "/>
<rect x="-3.014" y="7.985" transform="matrix(-0.7071 -0.7071 0.7071 -0.7071 8.4862 20.4858)" fill="#FFFFFF" width="23" height="1.001"/>
</svg></button>
  <form role="search" method="get" id="search-form" class="c-search-form" action="<?php echo home_url( '/' ); ?>">
    <div>
      <label for="s" class="u-visually-hidden">Search for:</label>
      <input type="search" id="s" name="s" value="" class="search-input" placeholder="Search..." />
      <button type="submit" id="search-submit" class="search-submit">Search</button>
    </div>
  </form>
</div>
<div class="c-lang-select" role="navigation" aria-label="Language selector">
       <a href="/" class="c-lang-select-btn c-lang-select--current" id="lang-en" aria-label="Select English">EN</a>
        <a href="https://fr.tnpi.ca/" class="c-lang-select-btn" id="lang-fr" aria-label="Select French">FR</a>
</div>

</nav>
