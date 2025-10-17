/**
 * Login Page JavaScript
 * Handles user login functionality
 */

import $ from 'jquery';
import BasePage from './BasePage.js';
import { ValidationService } from '../services/ValidationService.js';
import { FormService } from '../services/FormService.js';
import { AuthService } from '../services/AuthService.js';

class LoginPage extends BasePage {
    constructor() {
        super();
        this.pageName = 'login';
        this.pageSelector = '#login, [body-id="login"]';
        this.validationRules = {
            username: ValidationService.validateUsername,
            password: (password) => {
                if (!password || !password.trim()) {
                    return { isValid: false, message: '密码是必填项' };
                }
                return { isValid: true, message: '' };
            }
        };
        
        // Auto-initialize if page elements are present
        if (this.shouldInitialize() || this.isLoginPage()) {
            this.init();
        }
    }

    /**
     * Check if we're on the login page
     */
    isLoginPage() {
        return document.body.id === 'login' || 
               window.location.pathname.includes('/login') ||
               $('form').length > 0; // Fallback for login forms
    }

    /**
     * Initialize page
     */
    init() {
        // Set body id and class for specific styling
        document.body.id = 'login';
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
        const $loginForm = $('form');
        
        if ($loginForm.length) {
            // Setup form submission with validation
            FormService.handleFormSubmission(
                $loginForm,
                this.validationRules,
                async (formData) => {
                    await this.handleLogin(formData);
                },
                (errors) => {
                    console.log('Login form validation errors:', errors);
                }
            );

            // Setup real-time validation
            FormService.setupRealtimeValidation(
                $('input[name="username"]'), 
                ValidationService.validateUsername,
                'blur'
            );
        }
    }

    /**
     * Setup visual effects and animations
     */
    setupEffects() {
        // Add any visual effects or animations here
    }

    /**
     * Handle login submission
     */
    async handleLogin(formData) {
        try {
            // Show loading state
            const $submitBtn = $('button[type="submit"]');
            const originalText = $submitBtn.text();
            $submitBtn.prop('disabled', true).text('登入中...');

            // Attempt login
            const result = await AuthService.login(formData);

            if (result.success) {
                FormService.showSuccessMessage('登入成功！');
                
                // Handle redirect
                if (result.data.redirect) {
                    setTimeout(() => {
                        window.location.href = result.data.redirect;
                    }, 1000);
                }
            } else {
                // Handle login errors
                if (result.errors.general) {
                    FormService.showErrorMessage(result.errors.general[0]);
                } else {
                    FormService.showErrorMessage('登入失败，请检查用户名和密码');
                }
            }
        } catch (error) {
            console.error('Login error:', error);
            FormService.showErrorMessage('登入过程中出现错误，请稍后重试');
        } finally {
            // Restore button state
            const $submitBtn = $('button[type="submit"]');
            $submitBtn.prop('disabled', false).text('登入');
        }
    }
}

// Auto-initialize if on login page
$(document).ready(() => {
    // Only initialize if we're on the login page
    if (window.location.pathname.includes('/login') || document.body.classList.contains('login-page')) {
        new LoginPage();
    }
});

export default LoginPage;
