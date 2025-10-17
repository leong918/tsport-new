/**
 * Authentication Service
 * Handles authentication-related API calls and user management
 */

export class AuthService {
    /**
     * Get CSRF token from form data or meta tag
     * @param {object} formData 
     * @returns {string}
     */
    static getCSRFToken(formData = {}) {
        return formData._token || 
               document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
    }

    /**
     * Login user
     * @param {object} credentials 
     * @returns {Promise}
     */
    static async login(credentials) {
        try {
            const response = await fetch('/do-login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': AuthService.getCSRFToken(credentials),
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify(credentials)
            });

            // Check if response is JSON
            const contentType = response.headers.get('content-type');
            if (!contentType || !contentType.includes('application/json')) {
                console.error('Expected JSON but received:', contentType);
                throw new Error('Server returned non-JSON response');
            }

            const data = await response.json();
            
            if (response.ok) {
                return { success: true, data };
            } else {
                return { success: false, errors: data.errors || { general: [data.message] } };
            }
        } catch (error) {
            console.error('Login error:', error);
            
            // Check if the error is due to HTML response instead of JSON
            if (error.message && error.message.includes('Unexpected token')) {
                console.warn('Received HTML response instead of JSON - possible redirect or server error');
                return { success: false, errors: { general: ['請刷新頁面重試'] } };
            }
            
            return { success: false, errors: { general: ['網絡錯誤，請稍後重試'] } };
        }
    }

    /**
     * Register user
     * @param {object} userData 
     * @returns {Promise}
     */
    static async register(userData) {
        try {
            const response = await fetch('/do-register', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': AuthService.getCSRFToken(userData),
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify(userData)
            });

            // Check if response is JSON
            const contentType = response.headers.get('content-type');
            if (!contentType || !contentType.includes('application/json')) {
                console.error('Expected JSON but received:', contentType);
                throw new Error('Server returned non-JSON response');
            }

            const data = await response.json();
            
            if (response.ok) {
                return { success: true, data };
            } else {
                return { success: false, errors: data.errors || { general: [data.message] } };
            }
        } catch (error) {
            console.error('Registration error:', error);
            
            // Check if the error is due to HTML response instead of JSON
            if (error.message && error.message.includes('Unexpected token')) {
                console.warn('Received HTML response instead of JSON - possible redirect or server error');
                return { success: false, errors: { general: ['請刷新頁面重試'] } };
            }
            
            return { success: false, errors: { general: ['網絡錯誤，請稍後重試'] } };
        }
    }

    /**
     * Update user profile
     * @param {object} profileData 
     * @returns {Promise}
     */
    static async updateProfile(profileData) {
        try {
            const response = await fetch('/update-profile', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': AuthService.getCSRFToken(profileData),
                    'Accept': 'application/json'
                },
                body: JSON.stringify(profileData)
            });

            const data = await response.json();
            
            if (response.ok) {
                return { success: true, data };
            } else {
                return { success: false, errors: data.errors || { general: [data.message] } };
            }
        } catch (error) {
            console.error('Profile update error:', error);
            return { success: false, errors: { general: ['網絡錯誤，請稍後重試'] } };
        }
    }

    /**
     * Change password
     * @param {object} passwordData 
     * @returns {Promise}
     */
    static async changePassword(passwordData) {
        try {
            const response = await fetch('/change-password', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': AuthService.getCSRFToken(passwordData),
                    'Accept': 'application/json'
                },
                body: JSON.stringify(passwordData)
            });

            const data = await response.json();
            
            if (response.ok) {
                return { success: true, data };
            } else {
                return { success: false, errors: data.errors || { general: [data.message] } };
            }
        } catch (error) {
            console.error('Password change error:', error);
            return { success: false, errors: { general: ['網絡錯誤，請稍後重試'] } };
        }
    }

    /**
     * Redeem code
     * @param {string} code 
     * @returns {Promise}
     */
    static async redeemCode(code) {
        try {
            const requestData = { redeem_code: code };
            const response = await fetch('/redeem-code', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': AuthService.getCSRFToken(requestData),
                    'Accept': 'application/json'
                },
                body: JSON.stringify(requestData)
            });

            const data = await response.json();
            
            if (response.ok) {
                return { success: true, data };
            } else {
                return { success: false, errors: data.errors || { general: [data.message] } };
            }
        } catch (error) {
            console.error('Redeem code error:', error);
            return { success: false, errors: { general: ['網絡錯誤，請稍後重試'] } };
        }
    }

    /**
     * Logout user with confirmation
     * @param {string} logoutUrl 
     * @returns {Promise<boolean>}
     */
    static async logout(logoutUrl) {
        if (!confirm('確定要登出嗎？')) {
            return false;
        }

        try {
            // Show loading state
            document.body.style.opacity = '0.7';
            document.body.style.pointerEvents = 'none';
            
            // Redirect to logout URL
            window.location.href = logoutUrl;
            return true;
        } catch (error) {
            console.error('Logout error:', error);
            document.body.style.opacity = '1';
            document.body.style.pointerEvents = 'auto';
            return false;
        }
    }

    /**
     * Check if user is authenticated (client-side check)
     * @returns {boolean}
     */
    static isAuthenticated() {
        // This would typically check for auth tokens or session data
        // For now, we'll check if there's user data in the page
        return document.querySelector('[data-user-authenticated]') !== null;
    }

    /**
     * Get current user data (if available in page)
     * @returns {object|null}
     */
    static getCurrentUser() {
        const userDataElement = document.querySelector('[data-user-data]');
        if (userDataElement) {
            try {
                return JSON.parse(userDataElement.getAttribute('data-user-data'));
            } catch (error) {
                console.error('Error parsing user data:', error);
            }
        }
        return null;
    }

    /**
     * Handle authentication redirects
     * @param {object} response 
     */
    static handleAuthRedirect(response) {
        if (response.success && response.data.redirect) {
            window.location.href = response.data.redirect;
        }
    }

    /**
     * Setup CSRF token for all AJAX requests
     */
    static setupCSRFToken() {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        if (csrfToken) {
            // Set up jQuery AJAX defaults if jQuery is available
            if (window.$ && $.ajaxSetup) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                });
            }

            // Set up fetch defaults
            window.csrfToken = csrfToken;
        }
    }
}
