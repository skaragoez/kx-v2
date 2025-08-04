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

// --
// Newsticker functionality

(function() {
    // Newsticker configuration
    const config = {
        selector: '.wp-block-group.newsticker',
        contentSelector: '.newsticker-content',
        speed: 50, // pixels per second
        pauseOnHover: true,
        resetThreshold: 0.1, // Reset when 10% past the left edge
        mobileBreakpoint: 782, // Same as $breakpoints.sm from SCSS
        debug: false
    };

    // Check if current viewport is mobile
    function isMobile() {
        return window.innerWidth <= config.mobileBreakpoint;
    }

    function createNewsticker(container) {
        const content = container.querySelector(config.contentSelector);
        if (!content) {
            if (config.debug) console.warn('Newsticker content not found in container:', container);
            return null;
        }

        // Create newsticker instance
        const newsticker = {
            container: container,
            content: content,
            containerWidth: 0,
            contentWidth: 0,
            position: 0,
            isPaused: false,
            animationId: null,
            lastTime: 0,
            isActive: false,

            init() {
                if (isMobile()) {
                    this.setupDOM();
                    this.calculateDimensions();
                    this.setupEventListeners();
                    this.start();
                    this.isActive = true;
                } else {
                    this.deactivate();
                }
                
                if (config.debug) console.log('Newsticker initialized:', this, 'Active:', this.isActive);
            },

            activate() {
                if (!this.isActive && isMobile()) {
                    this.setupDOM();
                    this.calculateDimensions();
                    this.start();
                    this.isActive = true;
                    if (config.debug) console.log('Newsticker activated');
                }
            },

            deactivate() {
                if (this.isActive) {
                    this.stop();
                    this.resetDOM();
                    this.isActive = false;
                    if (config.debug) console.log('Newsticker deactivated');
                }
            },

            resetDOM() {
                // Reset inline styles for desktop display
                this.content.style.transform = '';
                this.content.style.willChange = '';
                // Remove duplicated content for desktop
                this.removeDuplicateContent();
            },

            setupDOM() {
                // Ensure proper CSS setup
                this.container.style.overflow = 'hidden';
                this.container.style.position = 'relative';
                this.container.style.width = '100%';
                
                this.content.style.display = 'flex';
                this.content.style.whiteSpace = 'nowrap';
                this.content.style.willChange = 'transform';
                this.content.style.position = 'relative';
                
                // Duplicate content for seamless loop
                this.duplicateContent();
            },

            duplicateContent() {
                // Check if content is already duplicated
                if (this.content.querySelector('.newsticker-duplicate')) {
                    return;
                }
                
                // Clone all children and append them
                const originalChildren = Array.from(this.content.children);
                originalChildren.forEach(child => {
                    const clone = child.cloneNode(true);
                    clone.classList.add('newsticker-duplicate');
                    this.content.appendChild(clone);
                });
                
                if (config.debug) console.log('Content duplicated for seamless loop');
            },

            removeDuplicateContent() {
                // Remove duplicated content
                const duplicates = this.content.querySelectorAll('.newsticker-duplicate');
                duplicates.forEach(duplicate => duplicate.remove());
                
                if (config.debug) console.log('Duplicate content removed');
            },

            calculateDimensions() {
                this.containerWidth = this.container.offsetWidth;
                // Calculate original content width (half of total, since we duplicated)
                this.originalContentWidth = this.content.scrollWidth / 2;
                this.contentWidth = this.content.scrollWidth;
                this.position = 0; // Start from original position
                
                if (config.debug) {
                    console.log('Dimensions calculated:', {
                        container: this.containerWidth,
                        originalContent: this.originalContentWidth,
                        totalContent: this.contentWidth
                    });
                }
            },

            setupEventListeners() {
                if (config.pauseOnHover) {
                    this.container.addEventListener('mouseenter', () => {
                        if (this.isActive) this.pause();
                    });
                    
                    this.container.addEventListener('mouseleave', () => {
                        if (this.isActive) this.resume();
                    });
                }

                // Handle visibility change (pause when tab is not visible)
                document.addEventListener('visibilitychange', () => {
                    if (this.isActive) {
                        if (document.hidden) {
                            this.pause();
                        } else if (!this.container.matches(':hover')) {
                            this.resume();
                        }
                    }
                });
            },

            animate(currentTime) {
                if (!this.lastTime) this.lastTime = currentTime;
                const deltaTime = currentTime - this.lastTime;
                this.lastTime = currentTime;

                if (!this.isPaused && deltaTime > 0) {
                    // Calculate movement based on time elapsed
                    const movement = (config.speed * deltaTime) / 1000;
                    this.position -= movement;

                    // Reset when original content width is scrolled (seamless loop with duplicates)
                    if (this.position <= -this.originalContentWidth) {
                        this.position = 0; // Reset to create seamless loop
                    }

                    // Apply transform
                    this.content.style.transform = `translateX(${this.position}px)`;
                }

                this.animationId = requestAnimationFrame((time) => this.animate(time));
            },

            start() {
                if (this.animationId) {
                    cancelAnimationFrame(this.animationId);
                }
                this.lastTime = 0;
                this.animationId = requestAnimationFrame((time) => this.animate(time));
            },

            pause() {
                this.isPaused = true;
                if (config.debug) console.log('Newsticker paused');
            },

            resume() {
                this.isPaused = false;
                if (config.debug) console.log('Newsticker resumed');
            },

            stop() {
                if (this.animationId) {
                    cancelAnimationFrame(this.animationId);
                    this.animationId = null;
                }
            },

            handleResize() {
                // Check if mobile state changed and activate/deactivate accordingly
                if (isMobile() && !this.isActive) {
                    this.activate();
                } else if (!isMobile() && this.isActive) {
                    this.deactivate();
                } else if (this.isActive) {
                    // Just recalculate dimensions if still active
                    this.calculateDimensions();
                }
                
                if (config.debug) console.log('Newsticker resized, mobile:', isMobile(), 'active:', this.isActive);
            },

            // Public method to update speed
            setSpeed(newSpeed) {
                config.speed = newSpeed;
                if (config.debug) console.log('Newsticker speed updated to:', newSpeed);
            }
        };

        return newsticker;
    }

    function initNewstickers() {
        const containers = document.querySelectorAll(config.selector);
        const instances = [];

        containers.forEach(container => {
            // Skip if already initialized
            if (container.newstickerInstance) {
                return;
            }

            const instance = createNewsticker(container);
            if (instance) {
                instance.init();
                container.newstickerInstance = instance;
                instances.push(instance);
            }
        });

        // Setup global resize handler for all instances
        if (instances.length > 0) {
            let resizeTimeout;
            window.addEventListener('resize', () => {
                clearTimeout(resizeTimeout);
                resizeTimeout = setTimeout(() => {
                    instances.forEach(instance => {
                        if (instance && instance.handleResize) {
                            instance.handleResize();
                        }
                    });
                }, 250);
            });
        }

        return instances;
    }

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initNewstickers);
    } else {
        initNewstickers();
    }

    // Expose global functions for manual control (optional)
    window.NewstickerControl = {
        init: initNewstickers,
        pauseAll() {
            document.querySelectorAll(config.selector).forEach(container => {
                if (container.newstickerInstance && container.newstickerInstance.isActive) {
                    container.newstickerInstance.pause();
                }
            });
        },
        resumeAll() {
            document.querySelectorAll(config.selector).forEach(container => {
                if (container.newstickerInstance && container.newstickerInstance.isActive) {
                    container.newstickerInstance.resume();
                }
            });
        },
        setGlobalSpeed(speed) {
            config.speed = speed;
            document.querySelectorAll(config.selector).forEach(container => {
                if (container.newstickerInstance && container.newstickerInstance.isActive) {
                    container.newstickerInstance.setSpeed(speed);
                }
            });
        },
        forceActivateAll() {
            document.querySelectorAll(config.selector).forEach(container => {
                if (container.newstickerInstance) {
                    container.newstickerInstance.activate();
                }
            });
        },
        deactivateAll() {
            document.querySelectorAll(config.selector).forEach(container => {
                if (container.newstickerInstance) {
                    container.newstickerInstance.deactivate();
                }
            });
        },
        isMobile: isMobile
    };
})();