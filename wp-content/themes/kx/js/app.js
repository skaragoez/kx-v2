// Contact Form 7 - Clickable Radio Button List Items
document.addEventListener('DOMContentLoaded', function() {
    // Wait for Contact Form 7 to be fully loaded
    const checkFormReady = setInterval(function() {
        const listItems = document.querySelectorAll('.service-selection .wpcf7-list-item');
        if (listItems.length > 0) {
            clearInterval(checkFormReady);
            initClickableRadioItems();
        }
    }, 100);

    function initClickableRadioItems() {
        // Make entire list item clickable for radio buttons
        const listItems = document.querySelectorAll('.service-selection .wpcf7-list-item');
        listItems.forEach(function(item) {
            item.addEventListener('click', function(e) {
                // Only trigger if not clicking directly on the radio button
                if (e.target.type !== 'radio') {
                    const radio = item.querySelector('input[type="radio"]');
                    if (radio) {
                        radio.checked = true;
                        // Trigger change event
                        radio.dispatchEvent(new Event('change'));
                    }
                }
            });
        });
    }
});

// --
// Slider modifications

(function() {
    // Function to modify swiper after initialization
    function modifySwiper(swiperInstance) {
        // Responsive breakpoints (matching _variables.scss)
        swiperInstance.params.breakpoints = {
            0: {
                slidesPerView: 1
            },
            782: { // sm (mobile)
                slidesPerView: 2
            },
            1030: { // md
                slidesPerView: 2
            },
            1230: { // lg (content)
                slidesPerView: 3
            }
        };

        // Apply the changes
        swiperInstance.update();

        console.log('Swiper modified:', swiperInstance);
    }

    // Listen for swiper initialization events
    document.addEventListener('swiper:afterInit', function(event) {
        const swiperInstance = event.detail;
        modifySwiper(swiperInstance);
    });

    // Also handle any existing swipers that might already be initialized
    document.addEventListener('DOMContentLoaded', function() {
        // Small delay to ensure swipers are initialized
        setTimeout(function() {
            const sliders = document.querySelectorAll('.swiper');
            sliders.forEach(function(slider) {
                if (slider.swiper) {
                    modifySwiper(slider.swiper);
                }
            });
        }, 100);
    });
})();