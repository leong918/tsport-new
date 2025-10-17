/**
 * Register Page JavaScript
 * Handles user registration functionality
 */

import $ from 'jquery';
import BasePage from './BasePage.js';
import { ValidationService } from '../services/ValidationService.js';
import { FormService } from '../services/FormService.js';
import { AuthService } from '../services/AuthService.js';

class RegisterPage extends BasePage {
    constructor() {
        super();
        this.pageName = 'register';
        this.pageSelector = '#register, [body-id="register"]';
        this.validationRules = {
            username: ValidationService.validateUsername,
            password: ValidationService.validatePassword,
            email: ValidationService.validateEmail,
            phone_no: ValidationService.validatePhoneNumber
        };
        
        // Auto-initialize if page elements are present
        if (this.shouldInitialize() || this.isRegisterPage()) {
            this.init();
        }
    }

    /**
     * Check if we're on the register page
     */
    isRegisterPage() {
        return document.body.id === 'register' || 
               window.location.pathname.includes('/register') ||
               $('form').length > 0; // Fallback for register forms
    }

    /**
     * Initialize page
     */
    init() {
        // Set body id and class for specific styling
        document.body.id = 'register';
        document.body.classList.add('auth-page');

        // Setup CSRF token
        AuthService.setupCSRFToken();

        // Call parent init
        super.init();

        // Focus on username field
        $('input[name="username"]').focus();
    }

    /**
     * Bind event listeners
     */
    bindEvents() {
        const $registerForm = $('form');
        
        if ($registerForm.length) {
            // Setup form submission with validation
            FormService.handleFormSubmission(
                $registerForm,
                this.validationRules,
                async (formData) => {
                    await this.handleRegistration(formData);
                },
                (errors) => {
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
        }
    }

    /**
     * Setup visual effects and animations
     */
    setupEffects() {
        // Setup password strength indicator
        FormService.setupPasswordStrengthIndicator($('input[name="password"]'));

        // Setup phone number formatting
        FormService.setupPhoneNumberFormatting($('input[name="phone_no"]'));
    }

    /**
     * Handle registration submission
     */
    async handleRegistration(formData) {
        try {
            // Show loading state
            const $submitBtn = $('button[type="submit"]');
            const originalText = $submitBtn.text();
            $submitBtn.prop('disabled', true).text('創建中...');

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
                FormService.showSuccessMessage('註冊成功！正在跳轉...');
                
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
                    FormService.showErrorMessage('註冊失敗，請稍後重試');
                }
            }
        } catch (error) {
            console.error('Registration error:', error);
            FormService.showErrorMessage('註冊過程中出現錯誤，請稍後重試');
        } finally {
            // Restore button state
            const $submitBtn = $('button[type="submit"]');
            $submitBtn.prop('disabled', false).text('創建賬戶');
        }
    }
}

// Auto-initialize if on register page
$(document).ready(() => {
    // Only initialize if we're on the register page
    if (window.location.pathname.includes('/register') || document.body.classList.contains('register-page')) {
        new RegisterPage();
    }
});

export default RegisterPage;
