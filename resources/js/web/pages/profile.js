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
                
                // Add event listener for when modal is shown
                if (modalId === '#edit-profile-modal') {
                    modalElement.addEventListener('shown.bs.modal', function () {
                        console.log('✨ Edit profile modal shown, initializing tabs...');
                        // Small delay to ensure DOM is ready
                        setTimeout(() => {
                            initAvatarEditorTabs();
                        }, 100);
                    });
                    
                    // Also initialize once immediately
                    console.log('📦 Pre-initializing tabs for edit-profile-modal');
                    initAvatarEditorTabs();
                }
            } catch (error) {
                console.error(`Error initializing SafeModal ${modalId}:`, error);
            }
        } else {
            console.warn(`Modal element ${modalId} not found in DOM`);
        }
    });
    
    console.log('Profile modals initialized with SafeModal wrapper');
}

/**
 * Initialize avatar editor modal tabs
 */
function initAvatarEditorTabs() {
    const modal = document.getElementById('edit-profile-modal');
    if (!modal) {
        console.warn('Edit profile modal not found');
        return;
    }
    
    console.log('🎨 Initializing avatar editor tabs...');
    
    const jerseyData = {
        name: 'E神',
        number: 10,
        mainColor: '#DC143C',
        secColor: '#228B22'
    };
    
    // Tab switching
    const tabButtons = modal.querySelectorAll('.tab-button');
    console.log('Found tab buttons:', tabButtons.length);
    
    tabButtons.forEach((button, index) => {
        const targetTab = button.dataset.tab;
        console.log(`Tab button ${index}:`, targetTab);
        
        // Remove any existing event listeners
        const newButton = button.cloneNode(true);
        button.parentNode.replaceChild(newButton, button);
        
        // Add click event listener
        newButton.addEventListener('click', function(e) {
            console.log('🖱️ Tab button clicked:', targetTab);
            console.log('Event target:', e.target);
            console.log('Current button:', this);
            switchTab(targetTab, newButton, modal);
        });
        
        // Also add a test attribute
        newButton.setAttribute('onclick', `console.log('Direct onclick works for: ${targetTab}')`);
    });
    
    // Color selection
    initColorSelection(modal, jerseyData);
    
    // Number picker
    initNumberPicker(modal, jerseyData);
    
    // Name input
    initNameInput(modal, jerseyData);
    
    // Save button
    initSaveButton(modal, jerseyData);
    
    console.log('✅ Avatar editor tabs initialized');
}

/**
 * Switch between tabs in avatar editor
 */
function switchTab(tabId, clickedButton, modal) {
    console.log('🔄 Switching to tab:', tabId);
    
    // Hide all tab panes
    const allPanes = modal.querySelectorAll('.tab-pane');
    console.log('Found tab panes:', allPanes.length);
    
    allPanes.forEach(pane => {
        pane.style.display = 'none';
        pane.classList.remove('active');
        console.log('Hiding pane:', pane.id);
    });

    // Show target tab pane
    const targetPane = modal.querySelector(`#${tabId}`);
    if (targetPane) {
        targetPane.style.display = 'block';
        targetPane.classList.add('active');
        console.log('✅ Showing pane:', tabId);
    } else {
        console.error('❌ Target pane not found:', tabId);
    }

    // Update tab button images
    modal.querySelectorAll('.tab-button').forEach(btn => {
        const img = btn.querySelector('.tab-img');
        const tab = btn.dataset.tab;
        
        // Determine image name from tab id
        let imageName = '';
        if (tab === 'name-tab') imageName = 'Name';
        else if (tab === 'number-tab') imageName = 'Number';
        else if (tab === 'main-color-tab') imageName = 'Main_Color';
        else if (tab === 'sec-color-tab') imageName = 'Sec_Color';
        
        // Set active/inactive image
        if (btn === clickedButton) {
            img.src = `/assets/web/images/profile/${imageName}_Active.png`;
            img.classList.add('active');
            console.log('✅ Active tab:', imageName);
        } else {
            img.src = `/assets/web/images/profile/${imageName}_Inactive.png`;
            img.classList.remove('active');
        }
    });
}

/**
 * Initialize color selection
 */
function initColorSelection(modal, jerseyData) {
    // Main color selection
    const mainColorOptions = modal.querySelectorAll('#main-color-tab .color-option');
    mainColorOptions.forEach(option => {
        option.addEventListener('click', () => {
            mainColorOptions.forEach(opt => opt.classList.remove('selected'));
            option.classList.add('selected');
            
            const color = option.dataset.color;
            modal.querySelector('.main-color-input').value = color;
            jerseyData.mainColor = color;
            console.log('Main color selected:', color);
        });
    });

    // Secondary color selection
    const secColorOptions = modal.querySelectorAll('#sec-color-tab .color-option');
    secColorOptions.forEach(option => {
        option.addEventListener('click', () => {
            secColorOptions.forEach(opt => opt.classList.remove('selected'));
            option.classList.add('selected');
            
            const color = option.dataset.color;
            modal.querySelector('.sec-color-input').value = color;
            jerseyData.secColor = color;
            console.log('Secondary color selected:', color);
        });
    });
}

/**
 * Initialize number picker
 */
function initNumberPicker(modal, jerseyData) {
    const digits = modal.querySelectorAll('.number-digit');
    
    digits.forEach((digit, index) => {
        const display = digit.querySelector('.digit-display');
        const upBtn = digit.querySelector('.number-up');
        const downBtn = digit.querySelector('.number-down');
        
        upBtn.addEventListener('click', () => {
            let current = parseInt(display.textContent);
            current = (current + 1) % 10;
            display.textContent = current;
            updateJerseyNumber(modal, jerseyData);
        });
        
        downBtn.addEventListener('click', () => {
            let current = parseInt(display.textContent);
            current = (current - 1 + 10) % 10;
            display.textContent = current;
            updateJerseyNumber(modal, jerseyData);
        });
    });
}

/**
 * Update jersey number from digit displays
 */
function updateJerseyNumber(modal, jerseyData) {
    const digits = modal.querySelectorAll('.digit-display');
    const number = Array.from(digits).map(d => d.textContent).join('');
    modal.querySelector('.jersey-number-input').value = number;
    jerseyData.number = parseInt(number);
    console.log('Jersey number:', number);
}

/**
 * Initialize name input
 */
function initNameInput(modal, jerseyData) {
    const nameInput = modal.querySelector('.jersey-name-input');
    if (nameInput) {
        nameInput.addEventListener('input', (e) => {
            jerseyData.name = e.target.value;
            console.log('Jersey name:', e.target.value);
        });
    }
}

/**
 * Initialize save button
 */
function initSaveButton(modal, jerseyData) {
    const saveBtn = modal.querySelector('.btn-save');
    if (saveBtn) {
        saveBtn.addEventListener('click', () => {
            console.log('Saving jersey customization:', jerseyData);
            
            // Close modal
            const bsModal = bootstrap.Modal.getInstance(modal);
            if (bsModal) {
                bsModal.hide();
            }
            
            // Show success message
            FormService.showSuccessMessage('球衣設定已保存！');
        });
    }
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

// Make tab switch function globally available
window.switchProfileTab = function(tabId) {
    console.log('🌍 Global switchProfileTab called:', tabId);
    const modal = document.getElementById('edit-profile-modal');
    if (!modal) {
        console.error('Modal not found');
        return;
    }
    
    // Find the button
    const button = modal.querySelector(`[data-tab="${tabId}"]`);
    if (button) {
        switchTab(tabId, button, modal);
    } else {
        console.error('Button not found for tab:', tabId);
    }
};
