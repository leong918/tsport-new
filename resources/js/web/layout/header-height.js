/**
 * Dynamic Header Height Calculator
 * Calculates the actual header height and sets CSS custom properties
 */

class HeaderHeight {
    constructor() {
        this.header = null;
        this.initialized = false;
        this.resizeObserver = null;
        this.init();
    }

    init() {
        // Wait for DOM to be ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => this.setup());
        } else {
            this.setup();
        }
    }

    setup() {
        this.header = document.getElementById('header');
        
        if (!this.header) {
            console.warn('Header element not found');
            return;
        }

        // Calculate and set initial header height
        this.calculateAndSetHeight();

        // Set up resize observer for responsive changes
        this.setupResizeObserver();

        // Listen for font load events (since header might change height when fonts load)
        this.setupFontLoadListener();

        this.initialized = true;
    }

    calculateAndSetHeight() {
        if (!this.header) return;

        // Get the actual computed height of the header
        const headerRect = this.header.getBoundingClientRect();
        const headerHeight = Math.ceil(headerRect.height);
        
        // Add 10px buffer as requested
        const totalHeight = headerHeight + 10;

        // Set CSS custom properties
        document.documentElement.style.setProperty('--header-height', `${totalHeight}px`);
        document.documentElement.style.setProperty('--header-actual-height', `${headerHeight}px`);
        
        // Also set mobile height (you can adjust this logic as needed)
        const mobileHeight = Math.max(headerHeight - 10, 60) + 10; // Minimum 70px total
        document.documentElement.style.setProperty('--header-height-mobile', `${mobileHeight}px`);
    }

    setupResizeObserver() {
        if (!window.ResizeObserver) {
            // Fallback for browsers without ResizeObserver
            window.addEventListener('resize', this.debounce(() => {
                this.calculateAndSetHeight();
            }, 250));
            return;
        }

        this.resizeObserver = new ResizeObserver(entries => {
            for (let entry of entries) {
                if (entry.target === this.header) {
                    this.calculateAndSetHeight();
                    break;
                }
            }
        });

        this.resizeObserver.observe(this.header);
    }

    setupFontLoadListener() {
        // Listen for font load events which might change header height
        if ('fonts' in document) {
            document.fonts.ready.then(() => {
                // Small delay to ensure layout has updated
                setTimeout(() => {
                    this.calculateAndSetHeight();
                }, 100);
            });
        }

        // Also listen for image loads in header (like logos)
        const headerImages = this.header.querySelectorAll('img');
        headerImages.forEach(img => {
            if (img.complete) {
                this.calculateAndSetHeight();
            } else {
                img.addEventListener('load', () => {
                    this.calculateAndSetHeight();
                });
            }
        });
    }

    // Utility function for debouncing
    debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    // Method to manually recalculate (useful for external calls)
    recalculate() {
        if (this.initialized) {
            this.calculateAndSetHeight();
        }
    }

    // Cleanup method
    destroy() {
        if (this.resizeObserver) {
            this.resizeObserver.disconnect();
        }
        this.initialized = false;
    }
}

// Create singleton instance
const headerHeight = new HeaderHeight();

// Export for external use and add global method for manual recalculation
window.HeaderHeight = headerHeight;
window.recalculateHeaderHeight = () => headerHeight.recalculate();

export default headerHeight;
