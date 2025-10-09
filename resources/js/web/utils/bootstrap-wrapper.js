/**
 * Bootstrap Wrapper Utility
 * Provides safe Bootstrap initialization and modal handling
 */

// Import Bootstrap with explicit CSS
import 'bootstrap/dist/css/bootstrap.min.css';
import * as Bootstrap from 'bootstrap';

/**
 * Safe Bootstrap Modal Wrapper
 */
export class SafeModal {
    constructor(element, options = {}) {
        this.element = typeof element === 'string' ? document.querySelector(element) : element;
        this.options = {
            backdrop: true,
            keyboard: true,
            focus: true,
            ...options
        };
        this.instance = null;
        this.init();
    }

    init() {
        if (!this.element) {
            console.error('Modal element not found');
            return;
        }

        try {
            // Check if Bootstrap is available
            if (typeof Bootstrap === 'undefined' || !Bootstrap.Modal) {
                console.error('Bootstrap Modal not available');
                return;
            }

            // Get existing instance or create new one
            this.instance = Bootstrap.Modal.getInstance(this.element);
            if (!this.instance) {
                this.instance = new Bootstrap.Modal(this.element, this.options);
            }
        } catch (error) {
            console.error('Error initializing modal:', error);
            // Fallback to basic modal functionality
            this.instance = null;
        }
    }

    show() {
        if (this.instance) {
            try {
                this.instance.show();
            } catch (error) {
                console.error('Error showing modal:', error);
                this.fallbackShow();
            }
        } else {
            this.fallbackShow();
        }
    }

    hide() {
        if (this.instance) {
            try {
                this.instance.hide();
            } catch (error) {
                console.error('Error hiding modal:', error);
                this.fallbackHide();
            }
        } else {
            this.fallbackHide();
        }
    }

    fallbackShow() {
        if (this.element) {
            this.element.style.display = 'block';
            this.element.classList.add('show');
            this.element.setAttribute('aria-modal', 'true');
            this.element.setAttribute('role', 'dialog');
            this.element.removeAttribute('aria-hidden');
            
            // Add backdrop
            this.addBackdrop();
        }
    }

    fallbackHide() {
        if (this.element) {
            this.element.style.display = 'none';
            this.element.classList.remove('show');
            this.element.removeAttribute('aria-modal');
            this.element.removeAttribute('role');
            this.element.setAttribute('aria-hidden', 'true');
            
            // Remove backdrop
            this.removeBackdrop();
        }
    }

    addBackdrop() {
        let backdrop = document.querySelector('.modal-backdrop');
        if (!backdrop) {
            backdrop = document.createElement('div');
            backdrop.className = 'modal-backdrop fade show';
            document.body.appendChild(backdrop);
        }
    }

    removeBackdrop() {
        const backdrop = document.querySelector('.modal-backdrop');
        if (backdrop) {
            backdrop.remove();
        }
    }
}

/**
 * Initialize all modals on the page
 */
export function initializeAllModals() {
    const modalElements = document.querySelectorAll('.modal');
    const modals = [];

    modalElements.forEach(modalElement => {
        try {
            const modal = new SafeModal(modalElement);
            modals.push(modal);
        } catch (error) {
            console.error('Error initializing modal:', modalElement.id, error);
        }
    });

    return modals;
}

/**
 * Safe modal trigger for data attributes
 */
export function setupModalTriggers() {
    document.addEventListener('click', function(e) {
        const trigger = e.target.closest('[data-bs-toggle="modal"]');
        if (trigger) {
            e.preventDefault();
            const targetSelector = trigger.getAttribute('data-bs-target');
            if (targetSelector) {
                const modal = new SafeModal(targetSelector);
                modal.show();
            }
        }
    });

    // Handle modal dismiss buttons
    document.addEventListener('click', function(e) {
        const dismissBtn = e.target.closest('[data-bs-dismiss="modal"]');
        if (dismissBtn) {
            e.preventDefault();
            const modalElement = dismissBtn.closest('.modal');
            if (modalElement) {
                const modal = new SafeModal(modalElement);
                modal.hide();
            }
        }
    });
}

// Make Bootstrap available globally
window.Bootstrap = Bootstrap;

export default Bootstrap;
