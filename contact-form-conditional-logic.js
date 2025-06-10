document.addEventListener('DOMContentLoaded', function() {
    // Wait for Contact Form 7 to be fully loaded
    const checkFormReady = setInterval(function() {
        const radioButtons = document.querySelectorAll('input[name="service-type"]');
        if (radioButtons.length > 0) {
            clearInterval(checkFormReady);
            initConditionalFields();
        }
    }, 100);

    function initConditionalFields() {
        const radioButtons = document.querySelectorAll('input[name="service-type"]');
        const websiteField = document.getElementById('website-field');
        const socialMediaField = document.getElementById('social-media-field');
        const websiteInput = document.getElementById('website');
        const socialMediaInput = document.getElementById('social-media');

        // Function to update field visibility and requirements
        function updateFields() {
            const selectedValue = document.querySelector('input[name="service-type"]:checked');
            
            if (!selectedValue) {
                // Hide both fields if nothing is selected
                hideField(websiteField, websiteInput);
                hideField(socialMediaField, socialMediaInput);
                return;
            }

            const value = selectedValue.value;

            if (value === 'Website Optimizasyonu') {
                showField(websiteField, websiteInput);
                hideField(socialMediaField, socialMediaInput);
            } else if (value === 'Sosyal Medya Optimizasyonu') {
                hideField(websiteField, websiteInput);
                showField(socialMediaField, socialMediaInput);
            } else {
                hideField(websiteField, websiteInput);
                hideField(socialMediaField, socialMediaInput);
            }
        }

        function showField(fieldContainer, input) {
            if (fieldContainer && input) {
                fieldContainer.style.display = 'block';
                fieldContainer.style.opacity = '0';
                
                // Smooth fade in animation
                setTimeout(function() {
                    fieldContainer.style.transition = 'opacity 0.3s ease-in-out';
                    fieldContainer.style.opacity = '1';
                }, 10);

                // Make field required
                input.setAttribute('required', 'required');
                input.setAttribute('aria-required', 'true');
                
                // Update field name to make it required in CF7
                const currentName = input.getAttribute('name');
                if (currentName && !currentName.includes('*')) {
                    // Add required class for CF7 validation
                    input.classList.add('wpcf7-validates-as-required');
                }
            }
        }

        function hideField(fieldContainer, input) {
            if (fieldContainer && input) {
                fieldContainer.style.transition = 'opacity 0.3s ease-in-out';
                fieldContainer.style.opacity = '0';
                
                setTimeout(function() {
                    fieldContainer.style.display = 'none';
                }, 300);

                // Remove required attribute
                input.removeAttribute('required');
                input.removeAttribute('aria-required');
                input.classList.remove('wpcf7-validates-as-required');
                
                // Clear the value when hiding
                input.value = '';
                
                // Remove any validation errors
                input.classList.remove('wpcf7-not-valid');
                const wrapper = input.closest('.wpcf7-form-control-wrap');
                if (wrapper) {
                    const errorSpan = wrapper.querySelector('.wpcf7-not-valid-tip');
                    if (errorSpan) {
                        errorSpan.remove();
                    }
                }
            }
        }

        // Add event listeners to radio buttons
        radioButtons.forEach(function(radio) {
            radio.addEventListener('change', updateFields);
        });

        // Initial check
        updateFields();

        // Re-run when form is reset or reloaded
        document.addEventListener('wpcf7mailsent', function() {
            setTimeout(updateFields, 100);
        });

        document.addEventListener('wpcf7invalid', function() {
            updateFields();
        });
    }

    // Handle form validation for conditional fields
    document.addEventListener('wpcf7invalid', function(event) {
        const form = event.target;
        const websiteField = form.querySelector('#website-field');
        const socialMediaField = form.querySelector('#social-media-field');
        
        // Scroll to first visible error field
        setTimeout(function() {
            const firstError = form.querySelector('.wpcf7-not-valid');
            if (firstError) {
                const fieldContainer = firstError.closest('.form-section');
                if (fieldContainer && (fieldContainer.style.display !== 'none')) {
                    firstError.scrollIntoView({ 
                        behavior: 'smooth', 
                        block: 'center' 
                    });
                }
            }
        }, 100);
    });
}); 