/**
 * Profile Page JavaScript
 * Handles profile page specific functionality including avatar editor and modals
 */

import { SafeModal } from '../utils/bootstrap-wrapper.js';
import { ValidationService } from '../services/ValidationService.js';
import { FormService } from '../services/FormService.js';
import { AuthService } from '../services/AuthService.js';
import { ProfileService } from '../services/ProfileService.js';

/**
 * Initialize Bootstrap modals for profile page using SafeModal wrapper
 */
function initProfileModals() {
    console.log('Initializing profile modals with SafeModal wrapper');

    // Initialize all modals on the profile page using SafeModal wrapper
    const modalIds = [
        '#edit-profile-modal',
        '#profile-info-modal', 
        '#password-change-modal',
        '#redeem-code-modal'
    ];

    modalIds.forEach(modalId => {
        const modalElement = document.querySelector(modalId);
        if (modalElement) {
            try {
                // Use SafeModal wrapper to avoid backdrop errors
                const safeModal = new SafeModal(modalElement);
                console.log(`SafeModal initialized for ${modalId}`);
            } catch (error) {
                console.error(`Error initializing SafeModal ${modalId}:`, error);
            }
        } else {
            console.warn(`Modal element ${modalId} not found in DOM`);
        }
    });
    
    console.log('Profile modals initialized with SafeModal wrapper');
}

export function initProfilePage() {
    // Only run if we're on the profile page
    if (document.body.id !== 'profile' && !window.location.pathname.includes('/profile')) {
        return;
    }

    // Set body id for specific styling
    document.body.id = 'profile';
    
    // Initialize Bootstrap modals specifically for profile page
    initProfileModals();
    
    // Setup CSRF token
    AuthService.setupCSRFToken();

    // Initialize avatar editor
    ProfileService.initAvatarEditor();
    
    // Setup modal management
    ProfileService.setupModalManagement();
    
    // Setup jersey number validation
    ProfileService.setupJerseyNumberValidation();
    
    // Setup form handlers
    setupProfileForms();
    
    // Initialize profile data if available
    const currentUser = AuthService.getCurrentUser();
    if (currentUser) {
        ProfileService.initializeProfileData(currentUser);
    }
}

/**
 * Setup all profile-related forms
 */
function setupProfileForms() {
    // Profile info form
    setupProfileInfoForm();
    
    // Password change form
    setupPasswordChangeForm();
    
    // Redeem code form
    setupRedeemCodeForm();
}

/**
 * Setup profile information form
 */
function setupProfileInfoForm() {
    const $form = $('#profile-info-modal form');
    if (!$form.length) return;

    const validationRules = {
        username: ValidationService.validateUsername,
        email: ValidationService.validateEmail,
        phone: (phone) => {
            if (phone && phone.trim()) {
                return ValidationService.validatePhoneNumber(phone);
            }
            return { isValid: true, message: '' };
        }
    };

    FormService.handleFormSubmission(
        $form,
        validationRules,
        async (formData) => {
            await handleProfileUpdate(formData);
        },
        (errors) => {
            console.log('Profile form validation errors:', errors);
        }
    );
}

/**
 * Setup password change form
 */
function setupPasswordChangeForm() {
    const $form = $('#password-change-modal form');
    if (!$form.length) return;

    const validationRules = {
        current_password: (password) => {
            if (!password || !password.trim()) {
                return { isValid: false, message: '請輸入當前密碼' };
            }
            return { isValid: true, message: '' };
        },
        new_password: ValidationService.validatePassword,
        new_password_confirmation: (confirmation) => {
            const newPassword = $form.find('input[name="new_password"]').val();
            if (!confirmation || !confirmation.trim()) {
                return { isValid: false, message: '請確認新密碼' };
            }
            if (confirmation !== newPassword) {
                return { isValid: false, message: '新密碼與確認密碼不匹配' };
            }
            return { isValid: true, message: '' };
        }
    };

    FormService.handleFormSubmission(
        $form,
        validationRules,
        async (formData) => {
            await handlePasswordChange(formData);
        },
        (errors) => {
            console.log('Password change validation errors:', errors);
        }
    );

    // Setup password strength indicator for new password
    FormService.setupPasswordStrengthIndicator($form.find('input[name="new_password"]'));
}

/**
 * Setup redeem code form
 */
function setupRedeemCodeForm() {
    const $form = $('#redeem-code-modal form');
    if (!$form.length) return;

    const validationRules = {
        redeem_code: ValidationService.validateRedeemCode
    };

    FormService.handleFormSubmission(
        $form,
        validationRules,
        async (formData) => {
            await handleRedeemCode(formData.redeem_code);
        },
        (errors) => {
            console.log('Redeem code validation errors:', errors);
        }
    );
}

/**
 * Handle profile update
 * @param {object} formData 
 */
async function handleProfileUpdate(formData) {
    try {
        const $submitBtn = $('#profile-info-modal button[type="submit"]');
        const originalText = $submitBtn.text();
        $submitBtn.prop('disabled', true).text('保存中...');

        const result = await AuthService.updateProfile(formData);

        if (result.success) {
            FormService.showSuccessMessage('個人資料更新成功！');
            $('#profile-info-modal').modal('hide');
            
            // Update header user info if needed
            ProfileService.updateHeaderUserInfo(result.data.user || formData);
        } else {
            if (result.errors.general) {
                FormService.showErrorMessage(result.errors.general[0]);
            } else {
                FormService.showErrorMessage('更新失敗，請稍後重試');
            }
        }
    } catch (error) {
        console.error('Profile update error:', error);
        FormService.showErrorMessage('更新過程中出現錯誤');
    } finally {
        const $submitBtn = $('#profile-info-modal button[type="submit"]');
        $submitBtn.prop('disabled', false).text('保存');
    }
}

/**
 * Handle password change
 * @param {object} formData 
 */
async function handlePasswordChange(formData) {
    try {
        const $submitBtn = $('#password-change-modal button[type="submit"]');
        const originalText = $submitBtn.text();
        $submitBtn.prop('disabled', true).text('更新中...');

        const result = await AuthService.changePassword(formData);

        if (result.success) {
            FormService.showSuccessMessage('密碼更新成功！');
            $('#password-change-modal').modal('hide');
        } else {
            if (result.errors.general) {
                FormService.showErrorMessage(result.errors.general[0]);
            } else {
                FormService.showErrorMessage('密码更新失败，请稍后重试');
            }
        }
    } catch (error) {
        console.error('Password change error:', error);
        FormService.showErrorMessage('密码更新过程中出现错误');
    } finally {
        const $submitBtn = $('#password-change-modal button[type="submit"]');
        $submitBtn.prop('disabled', false).text('更新密码');
    }
}

/**
 * Handle redeem code
 * @param {string} code 
 */
async function handleRedeemCode(code) {
    try {
        const $submitBtn = $('#redeem-code-modal button[type="submit"]');
        const originalText = $submitBtn.text();
        $submitBtn.prop('disabled', true).text('兑换中...');

        const result = await AuthService.redeemCode(code);

        if (result.success) {
            FormService.showSuccessMessage('兑换码使用成功！');
            $('#redeem-code-modal').modal('hide');
        } else {
            if (result.errors.general) {
                FormService.showErrorMessage(result.errors.general[0]);
            } else {
                FormService.showErrorMessage('兑换失败，请检查兑换码');
            }
        }
    } catch (error) {
        console.error('Redeem code error:', error);
        FormService.showErrorMessage('兑换过程中出现错误');
    } finally {
        const $submitBtn = $('#redeem-code-modal button[type="submit"]');
        $submitBtn.prop('disabled', false).text('兑换');
    }
}

/**
 * Logout function (legacy export - now handled by AuthService)
 * @deprecated Use AuthService.logout() instead
 */
export function logout() {
    const logoutUrl = window.logoutRoute || '/logout';
    AuthService.logout(logoutUrl);
}

/**
 * Initialize profile data (legacy export - now handled by ProfileService)
 * @deprecated Use ProfileService.initializeProfileData() instead
 */
export function initializeProfileData(userData) {
    ProfileService.initializeProfileData(userData);
}

// Auto-initialize when DOM is ready
$(document).ready(function() {
    // Only initialize if we're on a profile-related page
    if (window.location.pathname.includes('/profile') || 
        window.location.pathname.includes('/personal-info') || 
        document.body.classList.contains('profile-page')) {
        initProfilePage();
    }
});

// Make logout function globally available (for onclick handlers in templates)
window.logout = logout;
