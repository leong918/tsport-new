/**
 * Register Page JavaScript
 * Handles registration page specific functionality
 */

import { ValidationService } from '../services/ValidationService.js';
import { FormService } from '../services/FormService.js';
import { AuthService } from '../services/AuthService.js';

export function initRegisterPage() {
    // Only run if we're on the register page
    if (document.body.id !== 'register' && !window.location.pathname.includes('/register')) {
        return;
    }

    // Set body id for specific styling
    document.body.id = 'register';
    document.body.classList.add('auth-page');

    // Setup CSRF token
    AuthService.setupCSRFToken();

    // Get form element
    const $registerForm = $('form');
    
    if ($registerForm.length) {
        // Define validation rules
        const validationRules = {
            username: ValidationService.validateUsername,
            password: ValidationService.validatePassword,
            email: ValidationService.validateEmail,
            phone_no: ValidationService.validatePhoneNumber
        };

        // Setup form submission with validation
        FormService.handleFormSubmission(
            $registerForm,
            validationRules,
            async (formData) => {
                // Handle successful validation
                await handleRegistration(formData);
            },
            (errors) => {
                // Handle validation errors
                console.log('Registration form validation errors:', errors);
            }
        );

        // Setup real-time validation
        FormService.setupRealtimeValidation(
            $('input[name="username"]'), 
            ValidationService.validateUsername,
            'input'
        );

        FormService.setupRealtimeValidation(
            $('input[name="email"]'), 
            ValidationService.validateEmail,
            'blur'
        );

        // Setup password strength indicator
        FormService.setupPasswordStrengthIndicator($('input[name="password"]'));

        // Setup phone number formatting
        FormService.setupPhoneNumberFormatting($('input[name="phone_no"]'));
    }

    // Focus on username field
    $('input[name="username"]').focus();
}

/**
 * Handle registration submission
 * @param {object} formData 
 */
async function handleRegistration(formData) {
    try {
        // Show loading state
        const $submitBtn = $('button[type="submit"]');
        const originalText = $submitBtn.text();
        $submitBtn.prop('disabled', true).text('创建中...');

        // Add phone region if provided
        const phoneRegion = $('input[name="phone_region"]').val();
        if (phoneRegion) {
            formData.phone_region = phoneRegion;
        }

        // Add optional fields
        const referralCode = $('input[name="referral_code"]').val();
        if (referralCode) {
            formData.referral_code = referralCode;
        }

        const verificationCode = $('input[name="verification_code"]').val();
        if (verificationCode) {
            formData.verification_code = verificationCode;
        }

        // Attempt registration
        const result = await AuthService.register(formData);

        if (result.success) {
            FormService.showSuccessMessage('注册成功！正在跳转...');
            
            // Handle redirect (usually to home or login)
            if (result.data.redirect) {
                setTimeout(() => {
                    window.location.href = result.data.redirect;
                }, 1500);
            }
        } else {
            // Handle registration errors
            if (result.errors) {
                // Display specific field errors
                for (const [field, messages] of Object.entries(result.errors)) {
                    if (field === 'general') {
                        FormService.showErrorMessage(messages[0]);
                    } else {
                        const $field = $(`input[name="${field}"]`);
                        if ($field.length && messages.length > 0) {
                            FormService.showFieldError($field, messages[0]);
                        }
                    }
                }
            } else {
                FormService.showErrorMessage('注册失败，请稍后重试');
            }
        }
    } catch (error) {
        console.error('Registration error:', error);
        FormService.showErrorMessage('注册过程中出现错误，请稍后重试');
    } finally {
        // Restore button state
        const $submitBtn = $('button[type="submit"]');
        $submitBtn.prop('disabled', false).text('创建账户');
    }
}

// Auto-initialize when DOM is ready
$(document).ready(function() {
    initRegisterPage();
});
