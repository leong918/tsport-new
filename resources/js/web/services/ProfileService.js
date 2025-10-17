/**
 * Profile Service
 * Handles profile-specific functionality like avatar editor and profile data
 */

export class ProfileService {
    /**
     * Initialize avatar editor functionality
     */
    static initAvatarEditor() {
        // Avatar editor tab functionality
        $('.tab-img').on('click', function() {
            ProfileService.switchAvatarTab($(this));
        });

        // Initialize first tab as active
        $('.tab-img').first().trigger('click');

        // Color picker functionality
        $('.color-option').on('click', function() {
            ProfileService.selectColor($(this));
        });

        // Save profile changes (avatar editor)
        $('.save-profile-btn').on('click', function() {
            ProfileService.saveAvatarSettings();
        });
    }

    /**
     * Switch avatar editor tab
     * @param {jQuery} $clickedTab 
     */
    static switchAvatarTab($clickedTab) {
        // Reset all tabs to inactive state
        $('.tab-img').each(function() {
            $(this).attr('src', $(this).data('inactive'));
        });
        
        // Set clicked tab to active state
        $clickedTab.attr('src', $clickedTab.data('active'));
        
        // Hide all content sections
        $('.bottom-content > div').hide();
        
        // Show corresponding content section
        let tabId = $clickedTab.attr('id');
        $('.bottom-content > #' + tabId).show();
    }

    /**
     * Handle color picker selection
     * @param {jQuery} $colorOption 
     */
    static selectColor($colorOption) {
        const color = $colorOption.data('color');
        const section = $colorOption.closest('div[id]').attr('id');
        
        // Remove active class from all options in this section
        $colorOption.siblings('.color-option').removeClass('active');
        
        // Add active class to clicked option
        $colorOption.addClass('active');
        
        // Update hidden input based on section
        if (section === 'main-color') {
            $('#main-color-input').val(color);
        } else if (section === 'sec-color') {
            $('#sec-color-input').val(color);
        }
        
        // Visual feedback
        $colorOption.css('border', '3px solid white');
        $colorOption.siblings('.color-option').css('border', 'none');
    }

    /**
     * Save avatar settings
     */
    static saveAvatarSettings() {
        // Collect form data
        const profileData = {
            main_color: $('#main-color-input').val(),
            sec_color: $('#sec-color-input').val(),
            jersey_number: $('input[name="jersey_number"]').val(),
            jersey_name: $('input[name="jersey_name"]').val()
        };
        
        // Validate jersey number
        if (profileData.jersey_number) {
            const jerseyNumber = parseInt(profileData.jersey_number);
            if (jerseyNumber < 1 || jerseyNumber > 99) {
                alert('球衣号码必须在1-99之间');
                $('input[name="jersey_number"]').focus();
                return;
            }
        }
        
        // Validate jersey name
        if (profileData.jersey_name && profileData.jersey_name.trim().length === 0) {
            alert('请输入有效的球衣姓名');
            $('input[name="jersey_name"]').focus();
            return;
        }
        
        // TODO: Send AJAX request to save avatar settings
        console.log('Saving profile data:', profileData);
        
        // Show success message
        alert('头像设置已保存！');
        $('#edit-profile-modal').modal('hide');
    }

    /**
     * Initialize profile data from user object
     * @param {object} userData 
     */
    static initializeProfileData(userData) {
        if (!userData) return;

        // Set avatar colors
        if (userData.main_color) {
            $('#main-color-input').val(userData.main_color);
            $(`.color-option[data-color="${userData.main_color}"]`).trigger('click');
        }
        
        if (userData.sec_color) {
            $('#sec-color-input').val(userData.sec_color);
            $(`.color-option[data-color="${userData.sec_color}"]`).trigger('click');
        }
        
        // Set jersey information
        if (userData.jersey_number) {
            $('input[name="jersey_number"]').val(userData.jersey_number);
        }
        
        if (userData.jersey_name) {
            $('input[name="jersey_name"]').val(userData.jersey_name);
        }

        // Set profile form data
        if (userData.username) {
            $('input[name="username"]').val(userData.username);
        }

        if (userData.email) {
            $('input[name="email"]').val(userData.email);
        }

        if (userData.phone_no) {
            $('input[name="phone"]').val(userData.phone_no);
        }
    }

    /**
     * Setup jersey number validation
     */
    static setupJerseyNumberValidation() {
        $('input[name="jersey_number"]').on('input', function() {
            let value = parseInt($(this).val());
            
            if (isNaN(value) || value < 1 || value > 99) {
                $(this).addClass('is-invalid');
                if (!$(this).siblings('.invalid-feedback').length) {
                    $(this).after('<div class="invalid-feedback">请输入1-99之间的数字</div>');
                }
            } else {
                $(this).removeClass('is-invalid');
                $(this).siblings('.invalid-feedback').remove();
            }
        });
    }

    /**
     * Setup modal management for profile modals
     */
    static setupModalManagement() {
        const modals = [
            '#edit-profile-modal',
            '#profile-info-modal', 
            '#password-change-modal',
            '#redeem-code-modal'
        ];

        modals.forEach(modalSelector => {
            const $modal = $(modalSelector);
            
            // Auto-focus on modal open
            $modal.on('shown.bs.modal', function() {
                $(this).find('input:first').focus();
            });

            // Clear form validation on modal close
            $modal.on('hidden.bs.modal', function() {
                $(this).find('.is-invalid').removeClass('is-invalid');
                $(this).find('.invalid-feedback').remove();
                $(this).find('.password-strength').remove();
            });
        });
    }

    /**
     * Get user avatar URL
     * @param {object} user 
     * @returns {string}
     */
    static getUserAvatarUrl(user) {
        if (user?.avatar) {
            return `${user.avatar}`;
        }
        return null;
    }

    /**
     * Get user display name
     * @param {object} user 
     * @returns {string}
     */
    static getUserDisplayName(user) {
        return user?.username || user?.name || 'User';
    }

    /**
     * Update header user info
     * @param {object} user 
     */
    static updateHeaderUserInfo(user) {
        if (!user) return;

        // Update username display
        $('.user-name').text(ProfileService.getUserDisplayName(user));
        
        // Update email display
        $('.user-email').text(user.email || '');
        
        // Update avatar
        const avatarUrl = ProfileService.getUserAvatarUrl(user);
        if (avatarUrl) {
            $('.user-avatar img').attr('src', avatarUrl);
        } else {
            // Show initials placeholder
            const initials = ProfileService.getUserDisplayName(user).charAt(0).toUpperCase();
            $('.avatar-placeholder').text(initials);
        }
    }

    /**
     * Validate profile form data
     * @param {object} formData 
     * @returns {object}
     */
    static validateProfileData(formData) {
        const errors = {};
        let isValid = true;

        // Validate username
        if (formData.username) {
            const usernameRegex = /^[a-zA-Z0-9_]+$/;
            if (!usernameRegex.test(formData.username)) {
                errors.username = '用户名只能包含字母、数字和下划线';
                isValid = false;
            }
        }

        // Validate email
        if (formData.email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(formData.email)) {
                errors.email = '请输入有效的邮箱地址';
                isValid = false;
            }
        }

        return { isValid, errors };
    }
}
