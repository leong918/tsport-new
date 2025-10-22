/**
 * Profile Page JavaScript
 * Handles profile page specific functionality including avatar editor and modals
 */

import $ from 'jquery';
import BasePage from './BasePage.js';

class ProfilePage extends BasePage {
    constructor() {
        super();
        this.pageName = 'profile';
        this.pageSelector = '#page-profile';
        
        // Auto-initialize if page elements are present
        if (this.shouldInitialize()) {
            this.init();
        }
    }

    /**
     * Check if page should be initialized
     */
    shouldInitialize() {
        return $(this.pageSelector).length > 0 || 
               window.location.pathname.includes('/profile') ||
               document.body.classList.contains('profile-page');
    }

    /**
     * Initialize page functionality
     */
    init() {
        document.body.classList.add('profile-page');
        super.init();

        // Make service globally available
        window.ProfilePage = this;
        
        console.log('ProfilePage initialized successfully');
    }

    /**
     * Initialize page components
     */
    initializeComponents() {
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => {
                this.initializeAllComponents();
            });
        } else {
            this.initializeAllComponents();
        }
    }

    /**
     * Initialize all components after DOM is ready
     */
    initializeAllComponents() {
        console.log('Initializing profile page components...');
        
        this.initializeModals();
        this.setupLogoutButton();
        
        console.log('Profile page components initialized');
    }

    /**
     * Initialize Bootstrap modals
     */
    initializeModals() {
        console.log('Initializing profile modals...');

        const editModal = document.getElementById('edit-profile-modal');
        
        if (editModal) {
            // Wait for modal to be fully shown before initializing tabs
            editModal.addEventListener('shown.bs.modal', () => {
                console.log('✨ Edit profile modal shown');
                this.initializeTabImageSwitching(editModal);
                this.initializeColorSelection(editModal);
                this.initializeNumberPicker(editModal);
                this.initializeNameInput(editModal);
                this.initializeSaveButton(editModal);
            });
        }
        
        console.log('Profile modals initialized');
    }

    /**
     * Initialize Bootstrap tab image switching
     */
    initializeTabImageSwitching(modal) {
        console.log('🎨 Initializing tab image switching...');
        
        const tabButtons = modal.querySelectorAll('button[data-bs-toggle="pill"]');
        console.log('Found tab buttons:', tabButtons.length);
        
        if (tabButtons.length === 0) {
            console.warn('No tab buttons found!');
            return;
        }
        
        // Function to update all tab images
        const updateTabImages = (activeButton) => {
            tabButtons.forEach(btn => {
                const img = btn.querySelector('.tab-img');
                if (!img) return;
                
                const btnId = btn.id;
                let imageName = '';
                
                if (btnId === 'name-tab') imageName = 'name';
                else if (btnId === 'number-tab') imageName = 'number';
                else if (btnId === 'main-color-tab') imageName = 'main-color';
                else if (btnId === 'sec-color-tab') imageName = 'sec-color';
                
                if (btn === activeButton || btn.classList.contains('active')) {
                    img.src = '/assets/web/images/profile/' + imageName + '-active.png';
                    console.log('✅ Set active:', imageName);
                } else {
                    img.src = '/assets/web/images/profile/' + imageName + '-inactive.png';
                    console.log('⚪ Set inactive:', imageName);
                }
            });
        };
        
        // Listen to Bootstrap tab events
        tabButtons.forEach(button => {
            button.addEventListener('shown.bs.tab', function(event) {
                console.log('✨ Tab shown:', this.id);
                updateTabImages(this);
            });
        });
        
        // Set initial state
        const activeButton = modal.querySelector('button[data-bs-toggle="pill"].active');
        if (activeButton) {
            updateTabImages(activeButton);
        }
        
        console.log('✅ Tab image switching initialized');
    }

    /**
     * Initialize color selection handlers
     */
    initializeColorSelection(modal) {
        console.log('🎨 Initializing color selection...');
        
        // Get shirt image in modal
        const shirtImg = modal.querySelector('.shirt-wrapper .shirt');
        
        // Get default selected colors from HTML
        const defaultMainColor = modal.querySelector('#main-color-pane .color-option.selected');
        const defaultSecColor = modal.querySelector('#sec-color-pane .color-option.selected');
        
        // Track selected colors
        this.selectedMainColor = defaultMainColor ? parseInt(defaultMainColor.dataset.colorNumber) : 11;
        this.selectedSecColor = defaultSecColor ? parseInt(defaultSecColor.dataset.colorNumber) : 1;
        
        console.log('Initial colors - Main:', this.selectedMainColor, 'Secondary:', this.selectedSecColor);
        
        // Main color selection
        const mainColorOptions = modal.querySelectorAll('#main-color-pane .color-option');
        mainColorOptions.forEach((option) => {
            option.addEventListener('click', () => {
                this.selectedMainColor = parseInt(option.dataset.colorNumber);
                console.log('🎨 Main color selected:', this.selectedMainColor);
                
                // Update selected state
                mainColorOptions.forEach(opt => opt.classList.remove('selected'));
                option.classList.add('selected');
                
                // Update shirt image
                this.updateShirtImage(shirtImg);
            });
        });

        // Secondary color selection
        const secColorOptions = modal.querySelectorAll('#sec-color-pane .color-option');
        secColorOptions.forEach((option) => {
            option.addEventListener('click', () => {
                this.selectedSecColor = parseInt(option.dataset.colorNumber);
                console.log('🎨 Secondary color selected:', this.selectedSecColor);
                
                // Update selected state
                secColorOptions.forEach(opt => opt.classList.remove('selected'));
                option.classList.add('selected');
                
                // Update shirt image
                this.updateShirtImage(shirtImg);
            });
        });
        
        console.log('✅ Color selection initialized');
    }

    /**
     * Update shirt image based on color selection
     * Image format: {mainColor}-{secColor}.png (e.g., 11-1.png)
     */
    updateShirtImage(shirtImg) {
        if (!shirtImg) {
            console.warn('Shirt image not found');
            return;
        }
        
        // Build image filename: mainColor-secColor.png
        const filename = `/${this.selectedMainColor}/${this.selectedMainColor}-${this.selectedSecColor}.png`;
        const newSrc = `/assets/web/images/profile/shirt/${filename}`;
        
        console.log('🎽 Updating shirt image to:', newSrc);
        console.log('   Main color:', this.selectedMainColor, 'Secondary color:', this.selectedSecColor);
        
        shirtImg.src = newSrc;
    }

    /**
     * Initialize number picker
     */
    initializeNumberPicker(modal) {
        console.log('🔢 Initializing number picker...');
        
        const digits = modal.querySelectorAll('.number-digit');
        
        digits.forEach((digit) => {
            const display = digit.querySelector('.digit-display');
            const upBtn = digit.querySelector('.number-up');
            const downBtn = digit.querySelector('.number-down');
            
            if (upBtn) {
                upBtn.addEventListener('click', () => {
                    let current = parseInt(display.textContent);
                    current = (current + 1) % 10;
                    display.textContent = current;
                    console.log('Number up:', current);
                });
            }
            
            if (downBtn) {
                downBtn.addEventListener('click', () => {
                    let current = parseInt(display.textContent);
                    current = (current - 1 + 10) % 10;
                    display.textContent = current;
                    console.log('Number down:', current);
                });
            }
        });
        
        console.log('✅ Number picker initialized');
    }

    /**
     * Initialize name input
     */
    initializeNameInput(modal) {
        console.log('✏️ Initializing name input...');
        
        const nameInput = modal.querySelector('.jersey-name-input');
        if (nameInput) {
            nameInput.addEventListener('input', (e) => {
                console.log('Name changed:', e.target.value);
            });
        }
        
        console.log('✅ Name input initialized');
    }

    /**
     * Initialize save button
     */
    initializeSaveButton(modal) {
        console.log('💾 Initializing save button...');
        
        const saveBtn = modal.querySelector('.btn-save-image');
        if (saveBtn) {
            saveBtn.addEventListener('click', () => {
                console.log('Save button clicked');
                this.saveProfileChanges(modal);
            });
        }
        
        console.log('✅ Save button initialized');
    }

    /**
     * Save profile changes
     */
    saveProfileChanges(modal) {
        const nameInput = modal.querySelector('.jersey-name-input');
        const digits = modal.querySelectorAll('.digit-display');
        const mainColor = modal.querySelector('#main-color-pane .color-option.selected');
        const secColor = modal.querySelector('#sec-color-pane .color-option.selected');
        
        const profileData = {
            name: nameInput ? nameInput.value : '',
            number: Array.from(digits).map(d => d.textContent).join(''),
            mainColor: mainColor ? mainColor.dataset.color : '',
            secColor: secColor ? secColor.dataset.color : ''
        };
        
        console.log('Saving profile data:', profileData);
        
        // TODO: Send to backend API
        // For now, just close modal and show success
        const bsModal = bootstrap.Modal.getInstance(modal);
        if (bsModal) {
            bsModal.hide();
        }
        
        this.showSuccess('球衣設定已保存！');
    }

    /**
     * Setup logout button
     */
    setupLogoutButton() {
        window.logout = () => {
            const logoutUrl = window.logoutRoute || '/logout';
            console.log('Logging out:', logoutUrl);
            window.location.href = logoutUrl;
        };
    }

    /**
     * Bind event listeners
     */
    bindEvents() {
        // Events are bound in initializeComponents
    }

    /**
     * Setup visual effects and animations
     */
    setupEffects() {
        // No special effects for profile page
    }

    /**
     * Show success message
     */
    showSuccess(message) {
        super.showSuccess(message);
    }

    /**
     * Show error message
     */
    showError(message) {
        super.showError(message);
    }

    /**
     * Cleanup when page is destroyed
     */
    destroy() {
        delete window.ProfilePage;
        delete window.logout;
        super.destroy();
    }
}

// Auto-initialize if on profile page
$(document).ready(() => {
    new ProfilePage();
});

export default ProfilePage;
