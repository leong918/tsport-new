/**
 * Live Page JavaScript
 * Handles live streaming page functionality, video controls, tabs, and dummy chat
 */

import $ from 'jquery';
import BasePage from './BasePage.js';

class LivePage extends BasePage {
    constructor() {
        super();
        this.pageName = 'live';
        this.pageSelector = '#page-live';
        this.matchId = null;
        this.avatarColors = ['#ff6b35', '#ffa726', '#66bb6a', '#ef5350', '#ff7043', '#42a5f5', '#ab47bc'];
        
        // Auto-initialize if page elements are present
        if (this.shouldInitialize()) {
            this.init();
        }
    }

    /**
     * Check if page should be initialized
     */
    shouldInitialize() {
        const shouldInit = $(this.pageSelector).length > 0 || 
                          window.location.pathname.includes('/live') ||
                          document.body.classList.contains('live-page');
        
        return shouldInit;
    }

    /**
     * Initialize page functionality
     */
    init() {
        // Set body class for specific styling
        document.body.classList.add('live-page');
        
        // Call parent init
        super.init();

        // Make service globally available
        window.LivePage = this;
        window.Live = {
            setupVideoControls: () => this.setupVideoControls(),
            setupTabSwitching: () => this.setupTabSwitching(),
            setupActionButtons: () => this.setupActionButtons(),
            setupDummyChat: () => this.setupDummyChat(),
            scrollToBottom: (element) => this.scrollToBottom(element),
            getMatchId: () => this.matchId,
        };
        
        console.log('LivePage initialized successfully with ID:', this.matchId);
    }

    /**
     * Initialize page components
     */
    initializeComponents() {
        // Extract match ID
        this.extractMatchId();
        
        // Wait for DOM to be fully ready and Bootstrap to load
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
        console.log('Initializing live page components...');
        
        this.setupVideoControls();
        this.setupTabSwitching();
        this.setupActionButtons();
        this.setupDummyChat();
        
        console.log('Live page components initialized');
    }

    /**
     * Bind event listeners
     */
    bindEvents() {
        // Video controls events are handled in setupVideoControls
        // Tab switching events are handled in setupTabSwitching
        // Chat events are handled in setupDummyChat
        
        // Back button is handled by HeaderController globally
        // No need for page-specific back button handling
    }

    /**
     * Setup visual effects and animations
     */
    setupEffects() {
        // Auto scroll chat to bottom on page load
        this.scrollToBottom($('#live-chat-messages')[0]);
    }

    /**
     * Extract match ID from URL or data attributes
     */
    extractMatchId() {
        console.log('Current URL:', window.location.pathname);
        
        // Try to get from URL pattern /live/{id}
        const urlMatch = window.location.pathname.match(/\/live\/(\d+)/);
        if (urlMatch) {
            this.matchId = parseInt(urlMatch[1]);
            console.log('Match ID from URL:', this.matchId);
            return;
        }
        
        // Try page element data attribute
        const pageElement = $('#page-live');
        if (pageElement.length) {
            const dataId = pageElement.data('match-id');
            if (dataId) {
                this.matchId = parseInt(dataId);
                console.log('Match ID from page data:', this.matchId);
                return;
            }
        }
        
        console.log('Could not extract match ID from any source');
        this.matchId = null;
    }

    /**
     * Setup video controls
     */
    setupVideoControls() {
        const fullscreenBtn = document.querySelector('.fullscreen-btn');
        const video = document.getElementById('live-video');
        
        if (fullscreenBtn && video) {
            fullscreenBtn.addEventListener('click', function() {
                if (video.requestFullscreen) {
                    video.requestFullscreen();
                } else if (video.webkitRequestFullscreen) {
                    video.webkitRequestFullscreen();
                } else if (video.msRequestFullscreen) {
                    video.msRequestFullscreen();
                }
            });
            
            console.log('Video controls initialized');
        }
    }

    /**
     * Setup tab switching functionality using Bootstrap 5 tabs/pills
     */
    setupTabSwitching() {
        const pillButtons = document.querySelectorAll('[data-bs-toggle="pill"]');
        const chatInput = document.getElementById('section-input-comment');
        const loginPrompt = document.getElementById('section-login-prompt');
        
        console.log('Setting up Bootstrap 5 pills...');
        console.log('Found pill buttons:', pillButtons.length);
        console.log('Bootstrap available:', !!window.bootstrap);
        
        // Function to handle chat input visibility
        const handleChatInputVisibility = (targetTabId) => {
            const isLiveTab = targetTabId === 'tab-live';
            console.log('Handling chat input visibility for:', targetTabId, 'isLiveTab:', isLiveTab);
            
            if (chatInput) {
                if (isLiveTab) {
                    chatInput.classList.remove('hidden');
                    chatInput.style.display = 'block';
                } else {
                    chatInput.classList.add('hidden');
                    setTimeout(() => {
                        if (chatInput.classList.contains('hidden')) {
                            chatInput.style.display = 'none';
                        }
                    }, 300);
                }
            }
            
            if (loginPrompt) {
                if (isLiveTab) {
                    loginPrompt.classList.remove('hidden');
                    loginPrompt.style.display = 'block';
                } else {
                    loginPrompt.classList.add('hidden');
                    setTimeout(() => {
                        if (loginPrompt.classList.contains('hidden')) {
                            loginPrompt.style.display = 'none';
                        }
                    }, 300);
                }
            }
        };
        
        // Initialize Bootstrap pills
        pillButtons.forEach((button, index) => {
            console.log(`Setting up pill button ${index}:`, button.getAttribute('data-bs-target'));
            
            // Listen to Bootstrap pill events
            button.addEventListener('shown.bs.tab', (event) => {
                const targetTabId = event.target.getAttribute('data-bs-target')?.replace('#', '');
                if (targetTabId) {
                    handleChatInputVisibility(targetTabId);
                    console.log('Bootstrap pill switched to:', targetTabId);
                }
            });
            
            button.addEventListener('hide.bs.tab', (event) => {
                const targetTabId = event.target.getAttribute('data-bs-target')?.replace('#', '');
                console.log('Bootstrap pill hiding:', targetTabId);
            });
        });
        
        // Set initial state
        const activeTab = document.querySelector('.tab-pane.active');
        if (activeTab) {
            handleChatInputVisibility(activeTab.id);
        }
        
        console.log('Bootstrap 5 pills initialized');
    }

    /**
     * Setup action buttons functionality
     */
    setupActionButtons() {
        // Setup betting button actions
        const bettingButtons = document.querySelectorAll('.betting-btn[data-action]');
        bettingButtons.forEach(button => {
            button.addEventListener('click', function() {
                const action = this.dataset.action;
                console.log('Betting action:', action);
                // Handle different betting actions here
                // You can add actual betting logic here
            });
        });
        
        // Setup action button events
        const actionButtons = document.querySelectorAll('.action-btn[data-action]');
        actionButtons.forEach(button => {
            button.addEventListener('click', function() {
                const action = this.dataset.action;
                console.log('Action button clicked:', action);
                
                switch(action) {
                    case 'goto-activity':
                        // Handle goto activity action
                        console.log('Navigating to activity page...');
                        // window.location.href = '/activity'; // Uncomment when route is ready
                        break;
                        
                    case 'goto-bet':
                        // Handle goto bet action
                        console.log('Navigating to betting page...');
                        // window.location.href = '/bet'; // Uncomment when route is ready
                        break;
                        
                    case 'other-events':
                        // Handle other events action
                        console.log('Showing other events...');
                        // window.location.href = '/events'; // Uncomment when route is ready
                        break;
                        
                    default:
                        console.warn('Unknown action:', action);
                }
            });
        });
        
        console.log('Action buttons initialized');
    }

    /**
     * Setup dummy chat functionality
     */
    setupDummyChat() {
        const input = document.querySelector('.live-comment-input');
        const sendBtn = document.querySelector('.btn-send');
        const chatMessages = document.getElementById('live-chat-messages');
        
        if (!input || !sendBtn || !chatMessages) {
            console.warn('Chat elements not found');
            return;
        }
        
        // Handle send button click
        sendBtn.addEventListener('click', () => {
            this.sendDummyMessage(input, chatMessages, this.avatarColors);
        });
        
        // Handle enter key
        input.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                this.sendDummyMessage(input, chatMessages, this.avatarColors);
            }
        });
        
        // Auto scroll to bottom
        this.scrollToBottom(chatMessages);
        
        console.log('Dummy chat initialized');
    }

    /**
     * Send a dummy message to chat
     */
    sendDummyMessage(input, chatMessages, avatarColors) {
        const message = input.value.trim();
        if (!message) return;
        
        // Create new message element
        const messageDiv = document.createElement('div');
        messageDiv.className = 'chat-message';
        
        const randomColor = avatarColors[Math.floor(Math.random() * avatarColors.length)];
        
        messageDiv.innerHTML = `
            <div class="message-avatar">
                <div class="avatar-circle" style="background-color: ${randomColor};">
                    <span class="avatar-number">5</span>
                </div>
            </div>
            <div class="message-content">
                <div class="message-bubble">
                    ${this.escapeHtml(message)}
                </div>
            </div>
        `;
        
        // Add message to chat
        chatMessages.appendChild(messageDiv);
        
        // Clear input
        input.value = '';
        
        // Scroll to bottom
        this.scrollToBottom(chatMessages);
        
        // Add fade in animation
        messageDiv.style.opacity = '0';
        messageDiv.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            messageDiv.style.transition = 'all 0.3s ease';
            messageDiv.style.opacity = '1';
            messageDiv.style.transform = 'translateY(0)';
        }, 100);
        
        console.log('Dummy message sent:', message);
    }

    /**
     * Scroll element to bottom
     */
    scrollToBottom(element) {
        if (!element) return;
        
        setTimeout(() => {
            element.scrollTop = element.scrollHeight;
        }, 100);
    }

    /**
     * Escape HTML characters to prevent XSS
     */
    escapeHtml(text) {
        const map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return text.replace(/[&<>"']/g, function(m) { return map[m]; });
    }

    /**
     * Show more options menu
     */
    showMoreOptions() {
        console.log('More options menu triggered');
        // TODO: Implement proper more options functionality
        this.showSuccess('更多选项功能待开发');
    }

    /**
     * Show error message
     */
    showError(message) {
        super.showError(message);
    }

    /**
     * Show success message
     */
    showSuccess(message) {
        super.showSuccess(message);
    }

    /**
     * Cleanup when page is destroyed
     */
    destroy() {
        // Remove global references
        delete window.LivePage;
        delete window.Live;
        
        super.destroy();
    }
}

// Auto-initialize if on live page
$(document).ready(() => {
    new LivePage();
});

export default LivePage;
