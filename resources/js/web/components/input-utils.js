/**
 * Utility functions for input components
 */

/**
 * Toggle password visibility for a given field
 * @param {string} fieldName - The name/id of the password field
 */
export function togglePassword(fieldName = 'password') {
    const input = document.getElementById(fieldName);
    const toggleBtn = input.parentElement.querySelector('.toggle-btn');
    const hideIcon = toggleBtn.querySelector('.icon-hide');
    const showIcon = toggleBtn.querySelector('.icon-show');
    
    if (input.type === 'password') {
        input.type = 'text';
        hideIcon.style.display = 'none';
        showIcon.style.display = 'inline';
    } else {
        input.type = 'password';
        hideIcon.style.display = 'inline';
        showIcon.style.display = 'none';
    }
}

/**
 * Initialize password toggle functionality globally
 */
export function initPasswordToggle() {
    // Make togglePassword available globally for onclick handlers
    window.togglePassword = togglePassword;
    
    // Also add event listeners for better practice
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
