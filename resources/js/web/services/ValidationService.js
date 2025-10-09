/**
 * Validation Service
 * Centralized validation logic for forms
 */

export class ValidationService {
    /**
     * Validate username format
     * @param {string} username 
     * @returns {object} {isValid: boolean, message: string}
     */
    static validateUsername(username) {
        if (!username || !username.trim()) {
            return { isValid: false, message: '用户名是必填项' };
        }

        if (username.length < 3) {
            return { isValid: false, message: '用户名至少需要3个字符' };
        }

        if (username.length > 50) {
            return { isValid: false, message: '用户名不能超过50个字符' };
        }

        const usernameRegex = /^[a-zA-Z0-9_]+$/;
        if (!usernameRegex.test(username)) {
            return { isValid: false, message: '用户名只能包含字母、数字和下划线' };
        }

        return { isValid: true, message: '' };
    }

    /**
     * Validate email format
     * @param {string} email 
     * @returns {object} {isValid: boolean, message: string}
     */
    static validateEmail(email) {
        if (!email || !email.trim()) {
            return { isValid: false, message: '邮箱是必填项' };
        }

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            return { isValid: false, message: '请输入有效的邮箱地址' };
        }

        return { isValid: true, message: '' };
    }

    /**
     * Validate password strength
     * @param {string} password 
     * @returns {object} {isValid: boolean, message: string, strength: number}
     */
    static validatePassword(password) {
        if (!password || !password.trim()) {
            return { isValid: false, message: '密码是必填项', strength: 0 };
        }

        if (password.length < 6) {
            return { isValid: false, message: '密码至少需要6个字符', strength: 0 };
        }

        // Calculate password strength
        let strength = 0;
        if (password.length >= 6) strength++;
        if (password.match(/[a-z]+/)) strength++;
        if (password.match(/[A-Z]+/)) strength++;
        if (password.match(/[0-9]+/)) strength++;
        if (password.match(/[^A-Za-z0-9]+/)) strength++;

        return { isValid: true, message: '', strength };
    }

    /**
     * Get password strength text and class
     * @param {number} strength 
     * @returns {object} {text: string, class: string}
     */
    static getPasswordStrengthInfo(strength) {
        switch(strength) {
            case 1:
                return { text: '弱', class: 'text-danger' };
            case 2:
                return { text: '一般', class: 'text-warning' };
            case 3:
                return { text: '中等', class: 'text-info' };
            case 4:
            case 5:
                return { text: '强', class: 'text-success' };
            default:
                return { text: '', class: '' };
        }
    }

    /**
     * Validate phone number
     * @param {string} phoneNo 
     * @returns {object} {isValid: boolean, message: string}
     */
    static validatePhoneNumber(phoneNo) {
        if (!phoneNo || !phoneNo.trim()) {
            return { isValid: false, message: '电话号码是必填项' };
        }

        // Basic phone number validation (digits only)
        const phoneRegex = /^\d+$/;
        if (!phoneRegex.test(phoneNo)) {
            return { isValid: false, message: '电话号码只能包含数字' };
        }

        if (phoneNo.length < 8 || phoneNo.length > 15) {
            return { isValid: false, message: '电话号码长度应在8-15位之间' };
        }

        return { isValid: true, message: '' };
    }

    /**
     * Validate jersey number
     * @param {string|number} jerseyNumber 
     * @returns {object} {isValid: boolean, message: string}
     */
    static validateJerseyNumber(jerseyNumber) {
        const num = parseInt(jerseyNumber);
        
        if (isNaN(num)) {
            return { isValid: false, message: '球衣号码必须是数字' };
        }

        if (num < 1 || num > 99) {
            return { isValid: false, message: '球衣号码必须在1-99之间' };
        }

        return { isValid: true, message: '' };
    }

    /**
     * Validate redeem code format
     * @param {string} code 
     * @returns {object} {isValid: boolean, message: string}
     */
    static validateRedeemCode(code) {
        if (!code || !code.trim()) {
            return { isValid: false, message: '请输入兑换码' };
        }

        const codeRegex = /^[A-Za-z0-9]{6,20}$/;
        if (!codeRegex.test(code)) {
            return { isValid: false, message: '兑换码格式不正确（6-20位字母数字组合）' };
        }

        return { isValid: true, message: '' };
    }

    /**
     * Validate form data against multiple rules
     * @param {object} formData 
     * @param {object} rules 
     * @returns {object} {isValid: boolean, errors: object}
     */
    static validateForm(formData, rules) {
        const errors = {};
        let isValid = true;

        for (const [field, value] of Object.entries(formData)) {
            if (rules[field]) {
                const validation = rules[field](value);
                if (!validation.isValid) {
                    errors[field] = validation.message;
                    isValid = false;
                }
            }
        }

        return { isValid, errors };
    }
}
