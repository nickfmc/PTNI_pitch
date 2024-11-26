/**
 * GutenDevTheme scripts (footer)
 * This file contains any js scripts you want added to the theme's footer. 
 */

// *********************** START CUSTOM JS *********************************

// Accessible Video Player
document.addEventListener('DOMContentLoaded', function() {
    const videoPlayers = document.querySelectorAll('.video-player');

    videoPlayers.forEach(videoPlayer => {
        const video = videoPlayer.querySelector('video');
        const playPauseButton = videoPlayer.querySelector('.play-pause');
        const muteButton = videoPlayer.querySelector('.mute');
        const ccButton = videoPlayer.querySelector('.cc');
        const transcriptToggleButton = videoPlayer.querySelector('.transcript-toggle');
        const progressBar = videoPlayer.querySelector('.progress-bar');
        const progressContainer = videoPlayer.querySelector('.progress-container');
        const transcript = videoPlayer.closest('.alignfull').querySelector('.transcript'); // Find the transcript outside the video player
        const playIcon = videoPlayer.querySelector('.c-play-icon');

        // Play/Pause functionality
        function togglePlayPause() {
            if (video.paused) {
                video.play();
                playPauseButton.textContent = 'Pause';
                playIcon.classList.add('is-hidden'); // Hide play icon
            } else {
                video.pause();
                playPauseButton.textContent = 'Play';
                playIcon.classList.remove('is-hidden'); // Show play icon
            }
        }

        playPauseButton.addEventListener('click', togglePlayPause);

        // Play/Pause functionality when clicking on the video
        video.addEventListener('click', function(event) {
            // Check if the click is not on the controls area
            if (!event.target.closest('.controls')) {
                togglePlayPause();
            }
        });

        // Play/Pause functionality when clicking on the play icon
        playIcon.addEventListener('click', function(event) {
            togglePlayPause();
        });

        // Mute/Unmute functionality (only if the button exists)
        if (muteButton) {
            muteButton.addEventListener('click', function() {
                video.muted = !video.muted;
                muteButton.textContent = video.muted ? 'Unmute' : 'Mute';
            });
        }

        // Toggle Captions functionality (only if the button exists)
        if (ccButton) {
            ccButton.addEventListener('click', function() {
                const track = video.querySelector('track');
                if (track.mode === 'showing') {
                    track.mode = 'hidden';
                    ccButton.textContent = 'CC';
                } else {
                    track.mode = 'showing';
                    ccButton.textContent = 'CC (On)';
                }
            });
        }

        // Toggle Transcript functionality
        if (transcriptToggleButton && transcript) {
            transcriptToggleButton.addEventListener('click', function() {
                const isHidden = transcript.hasAttribute('hidden');
                if (isHidden) {
                    transcript.removeAttribute('hidden');
                    transcriptToggleButton.setAttribute('aria-expanded', 'true');
                    transcriptToggleButton.textContent = 'Hide Transcript';
                } else {
                    transcript.setAttribute('hidden', '');
                    transcriptToggleButton.setAttribute('aria-expanded', 'false');
                    transcriptToggleButton.textContent = 'Transcript';
                }
            });
        }

        // Update progress bar as the video plays
        video.addEventListener('timeupdate', function() {
            const progress = (video.currentTime / video.duration) * 100;
            progressBar.style.width = `${progress}%`;
            // Update ARIA attributes for accessibility
    progressContainer.setAttribute('aria-valuenow', progress.toFixed(2));
        });

        // Seek functionality
        progressContainer.addEventListener('click', function(e) {
            const rect = progressContainer.getBoundingClientRect();
            const offsetX = e.clientX - rect.left;
            const newTime = (offsetX / rect.width) * video.duration;
            video.currentTime = newTime;
        });

        // Keyboard navigation for controls
        const controls = videoPlayer.querySelectorAll('.controls button');
        controls.forEach((control, index) => {
            control.addEventListener('keydown', function(e) {
                if (e.key === 'ArrowRight') {
                    controls[(index + 1) % controls.length].focus();
                } else if (e.key === 'ArrowLeft') {
                    controls[(index - 1 + controls.length) % controls.length].focus();
                }
            });
        });
    });
});



// // grab element for Headroom
// var headroomElement = document.querySelector("#c-page-header");
// console.log(headroomElement);

// // get height of element for Headroom
// var headerHeight = headroomElement.offsetHeight; 
// console.log(headerHeight);

// // construct an instance of Headroom, passing the element
// var headroom = new Headroom(headroomElement, {
//   "offset": headerHeight,
//   "tolerance": 5,
//   "classes": {
//     "initial": "animate__animated",
//     "pinned": "animate__slideInDown",
//     "unpinned": "animate__slideOutUp"
//   }
// });
// headroom.init();
document.addEventListener('DOMContentLoaded', function() {
    const imgBanners = document.querySelectorAll('.c-img-banner');

    imgBanners.forEach(imgBanner => {
        const img = imgBanner.querySelector('img');

        if (img) { // Check if the image element exists
            img.addEventListener('load', function() {
                imgBanner.classList.add('loaded');
            });

            // If the image is cached, the load event might not fire
            if (img.complete) {
                imgBanner.classList.add('loaded');
            }
        }
    });
});


// Sticky header
document.addEventListener('DOMContentLoaded', function() {
  const headerMain = document.querySelector('.c-header-main');
  const headerSpacer = document.querySelector('.c-header-spacer');
  const stickyOffset = 35;

  window.addEventListener('scroll', function() {
      if (window.scrollY > stickyOffset) {
          headerMain.classList.add('sticky');
          headerSpacer.classList.add('sticky');
      } else {
          headerMain.classList.remove('sticky');
          headerSpacer.classList.remove('sticky');
      }
  });
});

// *********************** START CUSTOM JS *********************************

// Accessible Search Popup
document.addEventListener('DOMContentLoaded', function() {
    const searchButton = document.getElementById('search-button');
    const searchPopup = document.getElementById('search-popup');
    const searchSubmit = document.getElementById('search-submit');
    const searchField = document.getElementById('s'); // Corrected ID for the search field
    const closeSearchPopupButton = document.getElementById('close-search-popup');

    if (!searchButton || !searchPopup || !searchField || !closeSearchPopupButton) {
        console.error('One or more elements are not found:', {
            searchButton,
            searchPopup,
            searchField,
            closeSearchPopupButton
        });
        return;
    }

    window.closeSearchPopup = function() {
        searchButton.setAttribute('aria-expanded', 'false');
        searchPopup.setAttribute('aria-hidden', 'true');
        searchPopup.setAttribute('inert', '');
        searchButton.focus();
        releaseFocus();
    };

    searchButton.addEventListener('click', function() {
        const isExpanded = searchButton.getAttribute('aria-expanded') === 'true';
        searchButton.setAttribute('aria-expanded', !isExpanded);
        searchPopup.setAttribute('aria-hidden', isExpanded);
        searchPopup.removeAttribute('inert');
        if (!isExpanded) {
            searchField.focus();
            trapFocus(searchPopup);
        } else {
            window.closeSearchPopup();
        }
    });

    // Add keydown event listener to trigger click on Enter key press for the search field
    searchField.addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            searchSubmit.click();
        }
    });

    // Add keydown event listener to trigger click on Enter key press for the search submit button
    searchSubmit.addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            searchSubmit.click();
        }
    });

    closeSearchPopupButton.addEventListener('click', function() {
        window.closeSearchPopup();
    });

    function trapFocus(element) {
        const focusableElements = element.querySelectorAll('a, button, input, textarea, select, details, [tabindex]:not([tabindex="-1"])');
        
        if (focusableElements.length === 0) {
            console.error('No focusable elements found within the element.');
            return;
        }

        const firstElement = focusableElements[0];
        const lastElement = focusableElements[focusableElements.length - 1];

        if (!firstElement || !lastElement) {
            console.error('First or last focusable element is null.');
            return;
        }

        function handleFocus(event) {
            if (event.shiftKey) {
                if (document.activeElement === firstElement) {
                    event.preventDefault();
                    lastElement.focus();
                }
            } else {
                if (document.activeElement === lastElement) {
                    event.preventDefault();
                    firstElement.focus();
                }
            }
        }

        element.addEventListener('keydown', handleFocus);
        element.dataset.trapFocus = 'true';
    }

    function releaseFocus() {
        const element = document.querySelector('[data-trap-focus="true"]');
        if (element) {
            element.removeEventListener('keydown', handleFocus);
            delete element.dataset.trapFocus;
        }
    }

    function handleFocus(event) {
        const element = document.querySelector('[data-trap-focus="true"]');
        if (!element) return;

        const focusableElements = element.querySelectorAll('a, button, input, textarea, select, details, [tabindex]:not([tabindex="-1"])');
        const firstElement = focusableElements[0];
        const lastElement = focusableElements[focusableElements.length - 1];

        if (event.shiftKey) {
            if (document.activeElement === firstElement) {
                event.preventDefault();
                lastElement.focus();
            }
        } else {
            if (document.activeElement === lastElement) {
                event.preventDefault();
                firstElement.focus();
            }
        }
    }
});

// END Accessible Search Popup

// *********************** END CUSTOM JS *********************************


// *********************** END CUSTOM JS *********************************
// a hover + click dropdown menu
document.addEventListener('DOMContentLoaded', function() {
    const menuButtons = document.querySelectorAll('.menu-item-has-children > button');
    const navBg = document.querySelector('.c-nav-bg');
    const menuItems = document.querySelectorAll('li.menu-item-has-children');

    menuButtons.forEach(button => {
        button.addEventListener('click', function() {
            const expanded = this.getAttribute('aria-expanded') === 'true' || false;

            // Close all other menu items
            menuButtons.forEach(btn => {
                if (btn !== this) {
                    btn.setAttribute('aria-expanded', 'false');
                }
            });

            // Toggle the clicked menu item
            this.setAttribute('aria-expanded', !expanded);
            const submenu = this.nextElementSibling;
            if (submenu && !expanded) {
                submenu.querySelector('a').focus();
            }

            // Toggle .c-nav-bg visibility
            if (!expanded) {
                navBg.classList.add('visible');
            } else {
                navBg.classList.remove('visible');
            }
        });

        button.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                this.click();
            }
        });

        button.addEventListener('mouseover', function() {
            menuButtons.forEach(btn => {
                if (btn !== this) {
                    btn.setAttribute('aria-expanded', 'false');
                }
            });
        });
    });

    menuItems.forEach(item => {
        item.addEventListener('mouseover', function() {
            navBg.classList.add('visible');
        });

        item.addEventListener('mouseout', function() {
            // Check if any menu item is still expanded
            const anyExpanded = Array.from(menuButtons).some(button => button.getAttribute('aria-expanded') === 'true');
            if (!anyExpanded) {
                navBg.classList.remove('visible');
            }
        });
    });

    document.addEventListener('click', function(event) {
        const isClickInside = event.target.closest('.menu-item-has-children');
        if (!isClickInside) {
            menuButtons.forEach(button => {
                button.setAttribute('aria-expanded', 'false');
            });
            navBg.classList.remove('visible');
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Tab') {
            const activeElement = document.activeElement;
            const submenu = activeElement.closest('.sub-menu');
            if (submenu) {
                const focusableElements = submenu.querySelectorAll('a, button, input, [tabindex]:not([tabindex="-1"])');
                const lastFocusableElement = focusableElements[focusableElements.length - 1];
                if (activeElement === lastFocusableElement) {
                    const parentButton = submenu.previousElementSibling;
                    if (parentButton && parentButton.tagName === 'BUTTON') {
                        parentButton.setAttribute('aria-expanded', 'false');
                    }
                }
            }
        }
        // Close menu on Esc key press
        if (e.key === 'Escape') {
            menuButtons.forEach(button => {
                button.setAttribute('aria-expanded', 'false');
            });
            navBg.classList.remove('visible');
            document.activeElement.blur(); // Release focus
        }
    });

        // Handle pageshow event to reset state when navigating back
        window.addEventListener('pageshow', function(event) {
            if (event.persisted) {
                // Reset the state of .c-nav-bg and menu buttons
                navBg.classList.remove('visible');
                menuButtons.forEach(button => {
                    button.setAttribute('aria-expanded', 'false');
                });
            }
        });

        
});





// document.getElementById('open-modal-nav').addEventListener('click', function(){
//     document.querySelector('html').classList.add('has-modal-nav-open');
// });

// document.getElementById('close-modal-nav').addEventListener('click', function(){
//     document.querySelector('html').classList.remove('has-modal-nav-open');
// });

const openModalNav = document.getElementById('open-modal-nav');
const closeModalNav = document.getElementById('close-modal-nav');
const html = document.querySelector('html');
const modalNavWrap = document.querySelector('.c-modal-nav-wrap');

function openMenu() {
    html.classList.add('has-modal-nav-open');
    openModalNav.setAttribute('aria-expanded', 'true');
    closeModalNav.setAttribute('aria-expanded', 'true');
    modalNavWrap.removeAttribute('hidden');
    modalNavWrap.setAttribute('aria-modal', 'true'); // Add this line
    trapFocus(modalNavWrap);
    closeModalNav.focus(); // Move focus to the close button when menu opens
}

function closeMenu() {
    html.classList.remove('has-modal-nav-open');
    openModalNav.setAttribute('aria-expanded', 'false');
    closeModalNav.setAttribute('aria-expanded', 'false');
    modalNavWrap.setAttribute('hidden', '');
    modalNavWrap.setAttribute('aria-modal', 'false'); // Add this line
    openModalNav.focus(); // Return focus to the open button when menu closes
}


openModalNav.addEventListener('click', openMenu);
closeModalNav.addEventListener('click', closeMenu);

// Close modal nav when clicking outside of it when it's already open
document.addEventListener('click', function(e) {
    var isClickOnButton = e.target.closest('#open-modal-nav') !== null;
    var isClickInsideModal = e.target.closest('.c-modal-nav-wrap') !== null;
    var isModalOpen = html.classList.contains('has-modal-nav-open');

    if (!isClickOnButton && !isClickInsideModal && isModalOpen) {
        closeMenu();
    }
});

// Close modal nav when pressing the escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && html.classList.contains('has-modal-nav-open')) {
        closeMenu();
    }
});

// Trap focus inside the modal nav
function trapFocus(element) {
    var focusableElements = element.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
    var firstFocusableElement = focusableElements[0];
    var lastFocusableElement = focusableElements[focusableElements.length - 1];

    firstFocusableElement.focus();

    element.addEventListener('keydown', function(e) {
        var isTabPressed = e.key === 'Tab' || e.keyCode === 9;

        if (!isTabPressed) {
            return; 
        }

        if (e.shiftKey) { // if shift key pressed for shift + tab combination
            if (document.activeElement === firstFocusableElement) {
                lastFocusableElement.focus(); // add focus for the last focusable element
                e.preventDefault();
            }
        } else { // if tab key is pressed
            if (document.activeElement === lastFocusableElement) { // if focused has reached to last focusable element then focus first focusable element after pressing tab
                firstFocusableElement.focus(); // add focus for the first focusable element
                e.preventDefault();
            }
        }
    }); 
}
// var modalNavWrap = document.querySelector('.c-modal-nav-wrap');
trapFocus(modalNavWrap);

// ACCORDION VERSION ////////////////////
// Get all the top-level menu items that have a submenu
var menuItems = document.querySelectorAll('.c-mobile-menu > .menu-item-has-children');

// Loop through the menu items
menuItems.forEach(function(menuItem) {
    // Get the link inside the menu item
    var link = menuItem.querySelector('a');

    // Get the submenu inside the menu item
    var submenu = menuItem.querySelector('.sub-menu');

    // Add a click event listener to the original link
    link.addEventListener('click', function(event) {
        // Prevent the link from navigating to the href
        event.preventDefault();
        
        // Close all other menu items except for ancestors of the clicked item
        menuItems.forEach(function(otherMenuItem) {
            if (otherMenuItem !== menuItem && !menuItem.contains(otherMenuItem) && !otherMenuItem.contains(menuItem)) {
                otherMenuItem.classList.remove('is-open');
                var otherSubmenu = otherMenuItem.querySelector('.sub-menu');
                if (otherSubmenu) {
                    otherSubmenu.style.height = null;
                    otherSubmenu.classList.remove('open');
                    setTabIndex(otherSubmenu, -1); // Set tabindex to -1 for hidden items
                }
            }
        });
        
        // Toggle the 'open' class on the submenu
        submenu.classList.toggle('open');
        
        // Toggle the 'is-open' class on the menu item
        menuItem.classList.toggle('is-open');

        // Set tabindex for focusable elements
        if (submenu.classList.contains('open')) {
            setTabIndex(submenu, 0); // Remove tabindex for visible items
        } else {
            setTabIndex(submenu, -1); // Set tabindex to -1 for hidden items
        }
    });

    // Add a span inside the top-level a tags
    var span = document.createElement('span');
    span.textContent = ' '; // Add any text or leave it empty
    link.appendChild(span);

    // Initially set tabindex to -1 for all focusable elements in the submenu
    setTabIndex(submenu, -1);
});

// Function to set tabindex for focusable elements
function setTabIndex(element, index) {
    var focusableElements = element.querySelectorAll('a, button, input, select, textarea, [tabindex]');
    focusableElements.forEach(function(focusable) {
        if (index === 0) {
            focusable.removeAttribute('tabindex');
        } else {
            focusable.setAttribute('tabindex', index);
        }
    });
}
// // ACCORDION VERSION ////////////////////


// Select all buttons with the class 'gb-tabs__button'
var buttons = document.querySelectorAll('button.gb-tabs__button');

// Loop through each button
buttons.forEach(function(button) {
  // Create a new span element
  var span = document.createElement('span');
  
  // Add the class 'c-tab-toggle' to the span
  span.classList.add('c-tab-toggle');
  
  // Optionally, you can add some text or attributes to the span
  span.textContent = ''; // Replace with your desired text
  
  // Insert the span before the button text
  button.insertBefore(span, button.firstChild);
});




// *********************** START CUSTOM JQUERY DOC READY SCRIPTS *******************************
jQuery( document ).ready(function( $ ) {

   // get Template URL
   var templateUrl = object_name.templateUrl;
   

  //  $('#mobile-nav').hcOffcanvasNav({
  //   disableAt: 1024,
  //   width: 280,
  //   customToggle: $('.toggle'),
  //    pushContent: '.menu-slide',
  //   levelTitles: true,
  //   position: 'right',
  //   levelOpen: 'expand',
  //   navTitle: $('<div class="c-mobile-menu-header"><a href="/"><img src="'+ templateUrl + '/img/logo.svg"></a></div>'),
  //   levelTitleAsBack: true
  // });


  // modal menu init ----------------------------------
  // var modal_menu = jQuery("#c-modal-nav-button").animatedModal({
  //   modalTarget: 'modal-navigation',
  //   animatedIn: 'slideInDown',
  //   animatedOut: 'slideOutUp',
  //   animationDuration: '0.40s',
  //   color: '#dedede',
  //   afterClose: function() {
  //     $( 'body, html' ).css({ 'overflow': '' });
  //   }
  // });

  // // get last and current hash + update on hash change
  // var currentHash = function() {
  //   return location.hash.replace(/^#/, '')
  // }
  // var last_hash
  // var hash = currentHash()
  // $(window).bind('hashchange', function(event) {
  //   last_hash = hash;
  //   hash = currentHash();
  // });

  // enable back/foward to close/open modal --------------------------
  // $("#c-modal-nav-button").on('click', function(){ window.location.href = ensureHash("#menu"); });
  // function ensureHash(newHash) {
  //   if (window.location.hash) {
  //     return window.location.href.substring(0, window.location.href.lastIndexOf(window.location.hash)) + newHash;
  //   }
  //   return window.location.hash + newHash;
  // }
  // // if back button is pressed, close the modal
  // $(window).on('hashchange', function (event) {
  //   if (last_hash == 'menu' && hash == '') {
  //     modal_menu.close();
  //     history.replaceState('', document.title, window.location.pathname);
  //   } // if forward button, open the modal
  //   else if (window.location.hash == "#menu"){
  //     modal_menu.open();
  //   }
  // });

  // // if close button is clicked, clear the #menu hash added above
  // $('.close-modal-navigation').on('click', function (e) {
  //   history.replaceState('', document.title, window.location.pathname);
  // });

  // // close modal menu if esc key is used ------------------------
  // $(document).keyup(function(ev){
  //   if(ev.keyCode == 27 && hash == 'menu') {
  //     window.history.back();
  //   }
  // });


  // Magnific as menu popup
  // MENU POPUP
  // $('#c-modal-nav-button').magnificPopup({
  //   type: 'inline',
  //   removalDelay: 700, //delay removal by X to allow out-animation
  //   showCloseBtn: false,
  //   closeOnBgClick: false,
  //   autoFocusLast: false,
  //   fixedContentPos: false, 
  //   fixedContentPos: true,
  //   callbacks: {
  //     beforeOpen: function() {
  //        this.st.mainClass = 'mfp-move-from-side menu-popup';
  //        $('body').addClass('mfp-active');
  //     },
  //     open: function() { 
  //       $('#close-modal, .close-modal-navigation').on('click',function(event){
  //         event.preventDefault();
  //         $.magnificPopup.close(); 
  //       }); 
  //   },
  //   beforeClose: function() {
  //   $('body').removeClass('mfp-active');
  // }
  //   },
  //   midClick: true // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
  // });

});
// *********************** END CUSTOM JQUERY DOC READY SCRIPTS *********************************
