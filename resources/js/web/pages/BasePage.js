/**
 * Base Page Class Template
 * Standard structure for all page JavaScript files
 */

import $ from 'jquery';

export default class BasePage {
    constructor() {
        this.pageName = 'base';
        this.pageSelector = '#page-base';
        this.isInitialized = false;
        
        // Auto-initialize after subclass sets props and once DOM is ready
        const autoInit = () => {
            if (this.shouldInitialize()) {
                this.init();
            }
        };

        const schedule = () => {
            if (typeof queueMicrotask === 'function') {
                queueMicrotask(autoInit);
            } else {
                setTimeout(autoInit, 0);
            }
        };

        if (typeof document !== 'undefined' && document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => schedule(), { once: true });
        } else {
            schedule();
        }
    }

    /**
     * Check if page should be initialized
     * Override this method in child classes
     */
    shouldInitialize() {
        // If selector exists on the page, initialize
        if ($(this.pageSelector).length > 0) return true;

        const path = (window.location && window.location.pathname) || '/';
        // Handle root path: treat as home or when targeting body
        if (path === '/' && (this.pageName === 'home' || (this.pageSelector || '').includes('body'))) {
            return true;
        }

        // Fallback: match by segment
        return path.includes(`/${this.pageName}`);
    }

    /**
     * Initialize page functionality
     * Override this method in child classes
     */
    init() {
        if (this.isInitialized) return;
        
        console.log(`Initializing ${this.pageName} page...`);
        
        this.bindEvents();
        this.initializeComponents();
        this.setupEffects();
        
        this.isInitialized = true;
        console.log(`${this.pageName} page initialized successfully`);
    }

    /**
     * Bind event listeners
     * Override this method in child classes
     */
    bindEvents() {
        // Override in child classes
    }

    /**
     * Initialize page components
     * Override this method in child classes
     */
    initializeComponents() {
        // Override in child classes
    }

    /**
     * Setup visual effects and animations
     * Override this method in child classes
     */
    setupEffects() {
        // Override in child classes
    }

    /**
     * Cleanup when page is destroyed
     * Override this method in child classes
     */
    destroy() {
        console.log(`Destroying ${this.pageName} page...`);
        this.isInitialized = false;
    }

    /**
     * Get CSRF token for AJAX requests
     */
    getCSRFToken() {
        return $('meta[name="csrf-token"]').attr('content') || '';
    }

    /**
     * Show loading state
     */
    showLoading(message = 'Loading...') {
        // Implementation for loading state
    }

    /**
     * Hide loading state
     */
    hideLoading() {
        // Implementation for hiding loading state
    }

    /**
     * Show error message
     */
    showError(message) {
        console.error(`${this.pageName} Error:`, message);
    }

    /**
     * Show success message
     */
    showSuccess(message) {
        console.log(`${this.pageName} Success:`, message);
    }
}

// Auto-initialize pattern for conditional loading
export function createPageInstance(PageClass, condition = null) {
    if (condition === null || condition()) {
        return new PageClass();
    }
    return null;
}
