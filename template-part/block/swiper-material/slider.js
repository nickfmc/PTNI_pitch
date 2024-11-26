(function($){

   
    /**
     * initializeBlock
     *
     * Adds custom JavaScript to the block HTML.
     *
     * @date    15/4/19
     * @since   1.0.0
     *
     * @param   object $block The block jQuery element.
     * @param   object attributes The block attributes (only available when editing).
     * @return  void
     */
    var initializeBlock = function( $block ) {
        //Custom Script goes here

        var swiper = new Swiper($block.find(".swiper").get(0), {
            modules: [EffectMaterial],
            breakpoints: { 768: { slidesPerView: 2 } },
            effect: "material",
            spaceBetween: 16,
        });

    }

    // Initialize each block on page load (front end).
    $(document).ready(function(){ 
        $('.c-material-swiper').each(function(){
            initializeBlock( $(this) );
        });
    });

    // Initialize dynamic block preview (editor).
    if( window.acf ) {
        window.acf.addAction( 'render_block_preview/type=slider-block', initializeBlock );
        // Stop links from activating in the editor
    }

})(jQuery);
    

