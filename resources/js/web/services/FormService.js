/**
 * Form Service
 * Handles form validation, submission, and error display
 */

import { ValidationService } from './ValidationService.js';

export class FormService {
    /**
     * Display validation error for a form field
     * @param {jQuery} $element 
     * @param {string} message 
     */
    static showFieldError($element, message) {
        $element.addClass('is-invalid');
        
        // Remove existing error message
        $element.siblings('.invalid-feedback').remove();
        
        // Add new error message
        if (message) {
            $element.after(`<div class="invalid-feedback">${message}</div>`);
        }
    }

    /**
     * Clear validation error for a form field
     * @param {jQuery} $element 
     */
    static clearFieldError($element) {
        $element.removeClass('is-invalid');
        $element.siblings('.invalid-feedback').remove();
    }

    /**
     * Setup real-time validation for a form field
     * @param {jQuery} $element 
     * @param {function} validator 
     * @param {string} event - Event type ('input', 'blur', 'change')
     */
    static setupRealtimeValidation($element, validator, event = 'input') {
        $element.on(event, function() {
            const value = $(this).val();
            const validation = validator(value);
            
            if (!validation.isValid && value.trim()) {
                FormService.showFieldError($(this), validation.message);
            } else {
                FormService.clearFieldError($(this));
            }
        });
    }

    /**
     * Setup password strength indicator
     * @param {jQuery} $passwordElement 
     */
    static setupPasswordStrengthIndicator($passwordElement) {
        $passwordElement.on('input', function() {
            const password = $(this).val();
            const validation = ValidationService.validatePassword(password);
            
            // Remove existing strength indicator
            $(this).siblings('.password-strength').remove();
            
            if (password.length > 0 && validation.strength > 0) {
                const strengthInfo = ValidationService.getPasswordStrengthInfo(validation.strength);
                if (strengthInfo.text) {
                    $(this).after(`<small class="password-strength ${strengthInfo.class}">密码强度: ${strengthInfo.text}</small>`);
                }
            }
        });
    }

    /**
     * Setup phone number formatting
     * @param {jQuery} $phoneElement 
     */
    static setupPhoneNumberFormatting($phoneElement) {
        $phoneElement.on('input', function() {
            // Remove non-numeric characters
            let value = $(this).val().replace(/\D/g, '');
            $(this).val(value);
        });
    }

    /**
     * Validate entire form
     * @param {jQuery} $form 
     * @param {object} validationRules 
     * @returns {object} {isValid: boolean, errors: object}
     */
    static validateForm($form, validationRules) {
        const formData = {};
        let isValid = true;
        const errors = {};

        // Clear all existing errors
        $form.find('.is-invalid').removeClass('is-invalid');
        $form.find('.invalid-feedback').remove();

        // Collect form data and validate
        for (const [fieldName, validator] of Object.entries(validationRules)) {
            const $field = $form.find(`[name="${fieldName}"]`);
            if ($field.length) {
                const value = $field.val();
                formData[fieldName] = value;
                
                const validation = validator(value);
                if (!validation.isValid) {
                    FormService.showFieldError($field, validation.message);
                    errors[fieldName] = validation.message;
                    isValid = false;
                }
            }
        }

        // Include CSRF token if present in the form
        const $csrfField = $form.find('input[name="_token"]');
        if ($csrfField.length) {
            formData._token = $csrfField.val();
        }

        return { isValid, errors, formData };
    }

    /**
     * Handle form submission with validation
     * @param {jQuery} $form 
     * @param {object} validationRules 
     * @param {function} onSuccess 
     * @param {function} onError 
     */
    static handleFormSubmission($form, validationRules, onSuccess, onError) {
        $form.on('submit', function(e) {
            e.preventDefault();
            
            const validation = FormService.validateForm($form, validationRules);
            
            if (validation.isValid) {
                if (onSuccess) {
                    onSuccess(validation.formData, $form);
                }
            } else {
                if (onError) {
                    onError(validation.errors, $form);
                }
                
                // Focus on first invalid field
                const $firstInvalid = $form.find('.is-invalid').first();
                if ($firstInvalid.length) {
                    $firstInvalid.focus();
                }
            }
        });
    }

    /**
     * Setup modal form management
     * @param {jQuery} $modal 
     */
    static setupModalFormManagement($modal) {
        // Auto-focus on first input when modal opens
        $modal.on('shown.bs.modal', function() {
            $(this).find('input:first').focus();
        });

        // Clear validation errors when modal closes
        $modal.on('hidden.bs.modal', function() {
            $(this).find('.is-invalid').removeClass('is-invalid');
            $(this).find('.invalid-feedback').remove();
            $(this).find('.password-strength').remove();
        });
    }

    /**
     * Display a success message
     * @param {string} message 
     * @param {number} duration 
     */
    static showSuccessMessage(message, duration = 3000) {
        // Create temporary success alert
        const alertHtml = `
            <div class="alert alert-success alert-dismissible fade show position-fixed" 
                 style="top: 20px; right: 20px; z-index: 9999;">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `;
        
        $('body').append(alertHtml);
        
        // Auto-remove after duration
        setTimeout(() => {
            $('.alert-success').fadeOut(() => {
                $('.alert-success').remove();
            });
        }, duration);
    }

    /**
     * Display an error message
     * @param {string} message 
     * @param {number} duration 
     */
    static showErrorMessage(message, duration = 5000) {
        // Create temporary error alert
        const alertHtml = `
            <div class="alert alert-danger alert-dismissible fade show position-fixed" 
                 style="top: 20px; right: 20px; z-index: 9999;">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `;
        
        $('body').append(alertHtml);
        
        // Auto-remove after duration
        setTimeout(() => {
            $('.alert-danger').fadeOut(() => {
                $('.alert-danger').remove();
            });
        }, duration);
    }
}
