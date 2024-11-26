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
            slidesPerView: "auto",
            navigation: {
              prevEl: ".swiper-button-prev",
              nextEl: ".swiper-button-next",
            },
            watchSlidesProgress: true,
            effect: "coverflow",
            pagination: { el: ".swiper-pagination" },
            lazy: { enabled: true },
            centeredSlides: true,
            coverflowEffect: { stretch: 100 },
        });

    }

    // Initialize each block on page load (front end).
    $(document).ready(function(){ 
        $('.c-project-swiper').each(function(){
            initializeBlock( $(this) );
        });
    });

    // Initialize dynamic block preview (editor).
    if( window.acf ) {
        window.acf.addAction( 'render_block_preview/type=slider-block', initializeBlock );
        // Stop links from activating in the editor
    }

})(jQuery);
    

