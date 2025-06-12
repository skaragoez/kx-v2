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
