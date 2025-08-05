/**
 * GutenDevTheme scripts (footer)
 * This file contains any js scripts you want added to the theme's footer. 
 */

// *********************** START CUSTOM JS *********************************
// Translate form steps Gforms
document.addEventListener('DOMContentLoaded', function() {
    // Initial page load
    updateProgressBarText();

    // Handle Gravity Forms page transitions
    if (typeof gform !== 'undefined') {
        // After form page changes
        gform.addAction('gform_page_loaded', function() {
            updateProgressBarText();
        });

        // After form render
        gform.addAction('gform_post_render', function() {
            updateProgressBarText();
        });

        // Add specific AJAX completion handler
        jQuery(document).on('gform_post_conditional_logic', function() {
            updateProgressBarText();
        });

        // Additional AJAX event handler
        jQuery(document).bind('gform_page_loaded', function() {
            updateProgressBarText();
        });
    }
});

function updateProgressBarText() {
    // Increased delay to ensure AJAX content is loaded
    setTimeout(function() {
        const progressBar = document.querySelector('.gf_progressbar_wrapper');
        if (progressBar) {
            const titleElement = progressBar.querySelector('.gf_progressbar_title');
            if (titleElement && titleElement.textContent.includes('Step')) {
                titleElement.textContent = titleElement.textContent
                    .replace('Step', 'Étape')
                    .replace('of', 'sur');
            }
        }
    }, 100); // Increased timeout for AJAX completion
}


// END Translate form steps Gforms

document.addEventListener('DOMContentLoaded', function() {
    const dropArea = document.getElementById('gform_drag_drop_area_4_10');
    const uploadField = document.getElementById('gform_multifile_upload_4_10');
    const defaultMessagesList = document.getElementById('gform_multifile_messages_4_10');

    if (!dropArea || !uploadField) {
        console.log('Upload elements not found');
        return;
    }

    dropArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropArea.classList.add('gform-dropzone--dragover');
    });

    dropArea.addEventListener('dragleave', (e) => {
        e.preventDefault();
        dropArea.classList.remove('gform-dropzone--dragover');
    });

    dropArea.addEventListener('drop', (e) => {
        e.preventDefault();
        e.stopPropagation();
        dropArea.classList.remove('gform-dropzone--dragover');
        
        const files = e.dataTransfer.files;
        const maxFileSize = 10 * 1024 * 1024; // 10MB limit (adjust as needed)
        
        for (let file of files) {
            const extension = file.name.split('.').pop().toLowerCase();
            const allowedTypes = ['pdf', 'jpeg', 'jpg', 'png', 'gif'];
            
            // Check file size
            if (file.size > maxFileSize) {
                if (defaultMessagesList) {
                    defaultMessagesList.style.display = 'none';
                }
                const errorMessage = `${file.name} - Le fichier dépasse la limite de taille`;
                displayError(errorMessage, dropArea);
                return;
            }

            // Check file type
            if (!allowedTypes.includes(extension)) {
                if (defaultMessagesList) {
                    defaultMessagesList.style.display = 'none';
                }
                const errorMessage = `${file.name} - Ce type de fichier n'est pas autorisé. Doit être l'un des suivants : ${allowedTypes.join(', ')}`;
                displayError(errorMessage, dropArea);
                return;
            }
        }

        // If files are valid, trigger the default upload handling
        const dt = new DataTransfer();
        for (let file of files) {
            dt.items.add(file);
        }
        uploadField.files = dt.files;
        
        const event = new Event('change', { bubbles: true });
        uploadField.dispatchEvent(event);
    });

    // Observer to watch for and translate default messages
    const observer = new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
            if (mutation.type === 'childList' && defaultMessagesList) {
                const messages = defaultMessagesList.getElementsByClassName('gfield_validation_message');
                Array.from(messages).forEach(message => {
                    const text = message.textContent;
                    if (text.includes('File exceeds size limit')) {
                        defaultMessagesList.style.display = 'none';
                        const fileName = text.split(' - ')[0];
                        displayError(`${fileName} - Le fichier dépasse la limite de taille`, dropArea);
                    } else if (text.includes('This type of file is not allowed')) {
                        defaultMessagesList.style.display = 'none';
                        const fileName = text.split(' - ')[0];
                        displayError(`${fileName} - Ce type de fichier n'est pas autorisé. Doit être l'un des suivants : pdf, jpeg, jpg, png, gif`, dropArea);
                    }
                });
            }
        });
    });

    // Start observing the messages list for changes
    if (defaultMessagesList) {
        observer.observe(defaultMessagesList, { childList: true, subtree: true });
    }

    // Also handle direct file input changes
    uploadField.addEventListener('change', function(e) {
        const files = e.target.files;
        const maxFileSize = 10 * 1024 * 1024; // 10MB limit (adjust as needed)

        for (let file of files) {
            if (file.size > maxFileSize) {
                if (defaultMessagesList) {
                    defaultMessagesList.style.display = 'none';
                }
                const errorMessage = `${file.name} - Le fichier dépasse la limite de taille`;
                displayError(errorMessage, dropArea);
                return;
            }
        }
    });
});

function displayError(message, dropArea) {
    const existingError = document.querySelector('.gform-upload-error');
    if (existingError) {
        existingError.remove();
    }

    const errorDiv = document.createElement('div');
    errorDiv.className = 'gform-upload-error';
    errorDiv.textContent = message;
    errorDiv.style.cssText = 'background: #c02b0a; color: #fff; margin-top: 8px; font-size: 0.875em; padding: 5px 10px;';

    dropArea.parentNode.insertBefore(errorDiv, dropArea.nextSibling);

    setTimeout(() => {
        errorDiv.remove();
    }, 20000);
}




// fix empty figure usage
function applyRoleToFigures() {
    // Get all figure elements
    const figures = document.querySelectorAll('figure');

    figures.forEach(figure => {
        // Get all child nodes (including text nodes)
        const children = Array.from(figure.childNodes);
        
        // Filter out whitespace text nodes
        const nonWhitespaceChildren = children.filter(node => {
            if (node.nodeType === Node.TEXT_NODE) {
                return node.textContent.trim().length > 0;
            }
            return true;
        });

        // Check if there's exactly one child and it's an img
        if (nonWhitespaceChildren.length === 1 && 
            nonWhitespaceChildren[0].nodeName.toLowerCase() === 'img') {
            figure.setAttribute('role', 'none');
        }
    });
}


// fix empty figure usage
function applyRoleToFigures() {
    // Get all figure elements
    const figures = document.querySelectorAll('figure');

    figures.forEach(figure => {
        // Get all child nodes (including text nodes)
        const children = Array.from(figure.childNodes);
        
        // Filter out whitespace text nodes
        const nonWhitespaceChildren = children.filter(node => {
            if (node.nodeType === Node.TEXT_NODE) {
                return node.textContent.trim().length > 0;
            }
            return true;
        });

        // Check if there's exactly one child and it's an img
        if (nonWhitespaceChildren.length === 1 && 
            nonWhitespaceChildren[0].nodeName.toLowerCase() === 'img') {
            figure.setAttribute('role', 'none');
        }
    });
}


// Run the function when the DOM is fully loaded
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', applyRoleToFigures);
} else {
    applyRoleToFigures();
}

// END fix empty figure usage



// external link accessibility script
class AccessibilityEnhancer {
    constructor() {
        this.newTabText = '(Opens in a new tab)';
        this.externalLinkText = '(External link)';
        this.pdfText = '(PDF file)'; 
    }
  
    enhanceLinks() {
        const links = document.querySelectorAll('a');
        
        links.forEach(link => {
            this.enhanceSingleLink(link);
        });
    }
  
    enhanceSingleLink(link) {
      const isNewTab = link.target === '_blank' || link.target === 'blank';
      const isExternal = this.isExternalLink(link);
      const isPDF = this.isPDFLink(link); // Add this line
      const existingLabel = link.getAttribute('aria-label');
      const linkText = link.textContent || link.innerText;
      
      let newLabel = existingLabel || linkText;
  
      // Add appropriate notices
      if (isNewTab && !newLabel.includes(this.newTabText)) {
          newLabel += ` ${this.newTabText}`;
      }
      if (isExternal && !newLabel.includes(this.externalLinkText)) {
          newLabel += ` ${this.externalLinkText}`;
      }
      if (isPDF && !newLabel.includes(this.pdfText)) { // Add this block
          newLabel += ` ${this.pdfText}`;
      }
  
        // Set the enhanced label
        if (newLabel !== linkText) {
            link.setAttribute('aria-label', newLabel.trim());
        }
  
        // Add security attributes for external links
        if (isNewTab || isExternal) {
            const rel = 'noopener noreferrer';
            const currentRel = link.getAttribute('rel');
            if (!currentRel || !currentRel.includes(rel)) {
                link.setAttribute('rel', rel);
            }
        }
    }
  
    isExternalLink(link) {
        if (!link.href) return false;
        
        const currentDomain = window.location.hostname;
        try {
            const linkDomain = new URL(link.href).hostname;
            return linkDomain !== currentDomain;
        } catch (e) {
            return false;
        }
    }
  
    isPDFLink(link) {
        if (!link.href) return false;
        
        // Check if the URL ends with .pdf
        if (link.href.toLowerCase().endsWith('.pdf')) return true;
        
        // Check if the MIME type is available and is PDF
        if (link.type && link.type.toLowerCase() === 'application/pdf') return true;
        
        // Check if the download attribute exists and the file ends with .pdf
        if (link.hasAttribute('download')) {
            const downloadValue = link.getAttribute('download');
            if (downloadValue && downloadValue.toLowerCase().endsWith('.pdf')) return true;
        }
        
        return false;
    }
    
  
    // Method to handle dynamically added content
    observe() {
        const observer = new MutationObserver((mutations) => {
            mutations.forEach(mutation => {
                mutation.addedNodes.forEach(node => {
                    if (node.nodeType === 1) { // ELEMENT_NODE
                        // Check the added element itself
                        if (node.tagName === 'A') {
                            this.enhanceSingleLink(node);
                        }
                        // Check for links within the added element
                        const links = node.querySelectorAll('a');
                        links.forEach(link => this.enhanceSingleLink(link));
                    }
                });
            });
        });
  
        observer.observe(document.body, {
            childList: true,
            subtree: true
        });
    }
  }
  
  // Usage
  const accessibilityEnhancer = new AccessibilityEnhancer();
  
  document.addEventListener('DOMContentLoaded', () => {
    accessibilityEnhancer.enhanceLinks();
    accessibilityEnhancer.observe(); // Optional: observe for dynamic content
  });
  // END external link accessibility script
  
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
                playPauseButton.textContent = 'Pause'; // French: 'Pause'
                playIcon.classList.add('is-hidden'); // Hide play icon
            } else {
                video.pause();
                playPauseButton.textContent = 'Lecture'; // French: 'Lecture'
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
                muteButton.textContent = video.muted ? 'Activer le son' : 'Muet'; // French: 'Activer le son' (Unmute), 'Muet' (Mute)
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
  
  // Add role="presentation" to the span
  span.setAttribute('role', 'presentation');
  
  // Optionally, you can add some text or attributes to the span
  span.textContent = ''; // Replace with your desired text
  
  // Insert the span before the button text
  button.insertBefore(span, button.firstChild);
});





// *********************** START CUSTOM JQUERY DOC READY SCRIPTS *******************************
jQuery( document ).ready(function( $ ) {

   // get Template URL
   var templateUrl = object_name.templateUrl;
   


});
// *********************** END CUSTOM JQUERY DOC READY SCRIPTS *********************************
