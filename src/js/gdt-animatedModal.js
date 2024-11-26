(function(factory) {
  // Establish the root object, `window` (`self`) in the browser, or `global` on the server.
  // We use `self` instead of `window` for `WebWorker` support.
  var root = (typeof self == 'object' && self.self === self && self) ||
    (typeof global == 'object' && global.global === global && global);

    // Set up animatedModal appropriately for the environment. Start with AMD.
    if (typeof define === 'function' && define.amd) {
      define(['underscore', 'jquery', 'exports'], function(_, $, exports) {
        // Export global even in AMD case in case this script is loaded with
        // others that may still expect a global animatedModal.
        root.animatedModal = factory(root, $);
      });

      // Next for Node.js or CommonJS. jQuery may not be needed as a module.
    } else if (typeof exports !== 'undefined') {
      var _ = require('underscore'), $;
      try { $ = require('jquery'); } catch (e) {}
      factory(root, $);

      // Finally, as a browser global.
    } else {
      root.$animatedModal = factory(root, (root.jQuery || root.Zepto || root.ender || root.$));
    }
})(function(window, $) {
  $.fn.animatedModal = function(options) {
    var modal = $(this),
      currentContext = this;

      //Defaults
      var settings = $.extend({
        modalTarget:'animatedModal',
        position:'fixed',
        width:'100%',
        height:'100%',
        top:'0px',
        left:'0px',
        zIndexIn: '9999',
        zIndexOut: '-9999',
        color: '#39BEB9',
        opacityIn:'1',
        opacityOut:'0',
        animatedIn:'zoomIn',
        animatedOut:'zoomOut',
        animationDuration:'.6s',
        overflow:'auto',
        // Callbacks
        beforeOpen: function() {},
        afterOpen: function() {},
        beforeClose: function() {},
        afterClose: function() {}

      }, options);

      var closeBt = $('.close-'+settings.modalTarget);

      ['beforeOpen', 'afterOpen', 'beforeClose', 'afterClose'].forEach(function(key) {
        if (key in settings) {
          settings[key] = settings[key].bind(this);
        }
      }, this);

      var href = $(modal).attr('href')
        , id = $('body').find('#'+settings.modalTarget)
        , idConc = '#'+id.attr('id');

      // Default Classes
      id.addClass('animated');
      id.addClass(settings.modalTarget+'-off');

      //Init styles
      var initStyles = {
        'position':settings.position,
        'width':settings.width,
        'height':settings.height,
        'top':settings.top,
        'left':settings.left,
        'background-color':settings.color,
        'overflow-y':settings.overflow,
        'z-index':settings.zIndexOut,
        'opacity':settings.opacityOut,
        '-webkit-animation-duration':settings.animationDuration,
        '-moz-animation-duration':settings.animationDuration,
        '-ms-animation-duration':settings.animationDuration,
        'animation-duration':settings.animationDuration
      };
      //Apply styles
      id.css(initStyles);

      function openModal() {
        $('body, html').css({'overflow':'hidden'});

        if (href == idConc) {
          if (id.hasClass(settings.modalTarget+'-off')) {
            id.removeClass(settings.animatedOut);
            id.removeClass(settings.modalTarget+'-off');
            id.addClass(settings.modalTarget+'-on');
          }

          if (id.hasClass(settings.modalTarget+'-on')) {
            settings.beforeOpen(id);
            id.css({'opacity':settings.opacityIn,'z-index':settings.zIndexIn});
            id.addClass(settings.animatedIn);
            id.one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', afterOpen);
          }
        }
      }

      function closeModal() {
        $('body, html').css({'overflow':'auto'});

        settings.beforeClose(id); //beforeClose
        if (id.hasClass(settings.modalTarget+'-on')) {
          id.removeClass(settings.modalTarget+'-on');
          id.addClass(settings.modalTarget+'-off');
        }

        if (id.hasClass(settings.modalTarget+'-off')) {
          id.removeClass(settings.animatedIn);
          id.addClass(settings.animatedOut);
          id.one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', afterClose);
        }
      }

      modal.click(function(e) {
        if (e && e.preventDefault) {
          e.preventDefault();
        }
        openModal();
      });

      closeBt.click(function(e) {
        if (e && e.preventDefault) {
          e.preventDefault();
        }
        closeModal();
      });

      function afterClose () {
        id.css({'z-index':settings.zIndexOut});
        settings.afterClose(id); //afterClose
      }

      function afterOpen () {
        settings.afterOpen(id); //afterOpen
      }

      return {
        open: openModal,
        close: closeModal
      };
  }; // End animatedModal.js
});
