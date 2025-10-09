/**
 * Common input component utilities and enhancements
 */

/**
 * Initialize all input-related functionality
 */
export function initInputComponents() {
    // Initialize password toggle functionality
    initPasswordToggle();
    
    // Initialize other input enhancements
    initInputValidation();
    initInputFocus();
}

/**
 * Password toggle functionality
 */
export function initPasswordToggle() {
    // Make togglePassword available globally for onclick handlers
    window.togglePassword = togglePassword;
    
    // Add event listeners for toggle buttons
    document.addEventListener('DOMContentLoaded', function() {
        const toggleButtons = document.querySelectorAll('.toggle-btn');
        toggleButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const input = this.parentElement.querySelector('input[type="password"], input[type="text"]');
                if (input) {
                    togglePassword(input.id || input.name);
                }
            });
        });
    });
}

/**
 * Toggle password visibility for a given field
 * @param {string} fieldName - The name/id of the password field
 */
export function togglePassword(fieldName = 'password') {
    const input = document.getElementById(fieldName);
    if (!input) return;
    
    const toggleBtn = input.parentElement.querySelector('.toggle-btn');
    if (!toggleBtn) return;
    
    const hideIcon = toggleBtn.querySelector('.icon-hide');
    const showIcon = toggleBtn.querySelector('.icon-show');
    
    if (input.type === 'password') {
        input.type = 'text';
        if (hideIcon && showIcon) {
            hideIcon.style.display = 'none';
            showIcon.style.display = 'inline';
        }
    } else {
        input.type = 'password';
        if (hideIcon && showIcon) {
            hideIcon.style.display = 'inline';
            showIcon.style.display = 'none';
        }
    }
}

/**
 * Enhanced input validation feedback
 */
export function initInputValidation() {
    document.addEventListener('DOMContentLoaded', function() {
        const inputs = document.querySelectorAll('.input-field');
        
        inputs.forEach(input => {
            // Add real-time validation feedback
            input.addEventListener('blur', function() {
                validateInput(this);
            });
            
            // Clear validation on focus
            input.addEventListener('focus', function() {
                clearValidationState(this);
            });
        });
    });
}

/**
 * Validate individual input field
 * @param {HTMLElement} input - The input element to validate
 */
export function validateInput(input) {
    const wrapper = input.closest('.input-field-section');
    const errorElement = wrapper ? wrapper.querySelector('.text-danger') : null;
    
    // Basic validation - can be extended
    if (input.hasAttribute('required') && !input.value.trim()) {
        addValidationError(wrapper, 'This field is required');
        return false;
    }
    
    // Email validation
    if (input.type === 'email' && input.value) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(input.value)) {
            addValidationError(wrapper, 'Please enter a valid email address');
            return false;
        }
    }
    
    clearValidationError(wrapper);
    return true;
}

/**
 * Add validation error styling and message
 * @param {HTMLElement} wrapper - The input wrapper element
 * @param {string} message - Error message to display
 */
function addValidationError(wrapper, message) {
    if (!wrapper) return;
    
    const input = wrapper.querySelector('.input-field');
    const errorElement = wrapper.querySelector('.text-danger');
    
    if (input) {
        input.classList.add('is-invalid');
    }
    
    if (errorElement && !errorElement.textContent) {
        errorElement.textContent = message;
    }
}

/**
 * Clear validation error styling and message
 * @param {HTMLElement} wrapper - The input wrapper element
 */
function clearValidationError(wrapper) {
    if (!wrapper) return;
    
    const input = wrapper.querySelector('.input-field');
    
    if (input) {
        input.classList.remove('is-invalid');
    }
}

/**
 * Clear validation state when input gains focus
 * @param {HTMLElement} input - The input element
 */
function clearValidationState(input) {
    const wrapper = input.closest('.input-field-section');
    if (wrapper) {
        clearValidationError(wrapper);
    }
}

/**
 * Enhanced input focus effects
 */
export function initInputFocus() {
    document.addEventListener('DOMContentLoaded', function() {
        const inputs = document.querySelectorAll('.input-field');
        
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                const wrapper = this.closest('.input-field-wrapper');
                if (wrapper) {
                    wrapper.classList.add('focused');
                }
            });
            
            input.addEventListener('blur', function() {
                const wrapper = this.closest('.input-field-wrapper');
                if (wrapper) {
                    wrapper.classList.remove('focused');
                }
            });
        });
    });
}
