/**
 * Live Page JavaScript
 * Handles live streaming page functionality, video controls, tabs, and dummy chat
 */

import $ from 'jquery';
import videojs from 'video.js';
import flvjs from 'flv.js';
import BasePage from './BasePage.js';
import CommentListComponent from '../components/comment-list.js';

// Make videojs and flvjs globally available
window.videojs = videojs;
window.flvjs = flvjs;

class LivePage extends BasePage {
    constructor() {
        super();
        this.pageName = 'live';
        this.pageSelector = '#page-live';
        this.matchId = null;
        this.commentList = null;
        this.avatarColors = ['#ff6b35', '#ffa726', '#66bb6a', '#ef5350', '#ff7043', '#42a5f5', '#ab47bc'];
        
        // Bind methods to preserve context
        this.submitComment = this.submitComment.bind(this);
        this.setupDummyChat = this.setupDummyChat.bind(this);
        
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
        console.log('Current match ID:', this.matchId);
        
        this.setupVideoPlayer();
        this.setupVideoControls();
        this.setupTabSwitching();
        this.setupActionButtons();
        this.initializeCommentList();
        this.setupDummyChat();
        this.setupStatusUpdates();
        
        console.log('Live page components initialized');
        console.log('Final match ID:', this.matchId);
    }

    /**
     * Initialize comment list component
     */
    initializeCommentList() {
        const commentContainer = document.getElementById('live-chat-comments');
        
        if (commentContainer) {
            this.commentList = new CommentListComponent(commentContainer, {
                entityType: 'match',
                entityId: this.matchId
            });
            
            // Make it globally accessible
            window.CommentListComponent = this.commentList;
            
            console.log('CommentListComponent initialized for match:', this.matchId);
        } else {
            console.warn('Comment container #live-chat-comments not found');
        }
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
        
        // Priority 1: Try page element data attribute (most reliable)
        const pageElement = document.getElementById('page-live');
        if (pageElement) {
            const dataId = pageElement.getAttribute('data-match-id');
            console.log('Data attribute value:', dataId);
            if (dataId && dataId !== '') {
                this.matchId = parseInt(dataId);
                console.log('✓ Match ID from page data:', this.matchId);
                return;
            }
        }
        
        // Priority 2: Try to get from URL pattern /live/{id}
        const urlMatch = window.location.pathname.match(/\/live\/(\d+)/);
        if (urlMatch) {
            this.matchId = parseInt(urlMatch[1]);
            console.log('✓ Match ID from URL:', this.matchId);
            return;
        }
        
        console.error('❌ Could not extract match ID from any source');
        console.log('Page element:', pageElement);
        console.log('URL:', window.location.pathname);
        this.matchId = null;
    }

    /**
     * Setup video player (FLV/HLS streaming)
     */
    setupVideoPlayer() {
        const playerElement = document.getElementById('live-stream-player');
        if (!playerElement) {
            console.log('No live stream player element found');
            return;
        }

        const streamKey = playerElement.getAttribute('data-stream-key');
        const isLive = playerElement.getAttribute('data-is-live') === 'true';

        if (isLive && streamKey) {
            // Use FLV stream for live broadcasting
            const flvUrl = `http://localhost:8889/live/${streamKey}.flv`;

            if (typeof videojs !== 'undefined') {
                this.player = videojs('live-stream-player', {
                    controls: false, // Hide controls
                    autoplay: true, // Enable autoplay
                    muted: true, // Mute by default to allow autoplay
                    fluid: true,
                    responsive: true,
                    liveui: true,
                    bigPlayButton: false, // Hide big play button
                    controlBar: false, // Disable control bar
                    html5: {
                        vhs: {
                            overrideNative: true
                        },
                        nativeAudioTracks: false,
                        nativeVideoTracks: false
                    }
                });

                // Try to load FLV stream first
                console.log('Attempting to load FLV stream:', flvUrl);
                
                // Use FLV.js for better FLV support
                if (typeof flvjs !== 'undefined' && flvjs.isSupported()) {
                    console.log('Using FLV.js for stream playback');
                    
                    const videoElement = this.player.tech().el();
                    const flvPlayer = flvjs.createPlayer({
                        type: 'flv',
                        url: flvUrl,
                        isLive: true,
                        hasAudio: true,
                        hasVideo: true,
                        enableWorker: true,
                        enableStashBuffer: false,
                        autoCleanupSourceBuffer: true
                    });
                    
                    flvPlayer.attachMediaElement(videoElement);
                    flvPlayer.load();
                    
                    // Auto-play after loading
                    flvPlayer.on(flvjs.Events.LOADING_COMPLETE, () => {
                        console.log('FLV stream loaded successfully');
                        videoElement.muted = true; // Ensure muted for autoplay
                        flvPlayer.play().then(() => {
                            console.log('Auto-play started successfully');
                        }).catch(e => {
                            console.log('Auto-play prevented, user interaction required:', e);
                        });
                    });
                    
                    flvPlayer.on(flvjs.Events.ERROR, (errorType, errorDetail) => {
                        console.error('FLV player error:', errorType, errorDetail);
                        this.showStreamError('Stream connection failed. Please refresh the page.');
                    });
                    
                    // Store flv player for cleanup
                    this.player.flvPlayer = flvPlayer;
                } else {
                    // Fallback: Test if stream is available via fetch
                    console.log('FLV.js not supported, testing stream availability...');
                    fetch(flvUrl, { method: 'HEAD' })
                        .then(response => {
                            if (response.ok) {
                                console.log('FLV stream available, trying direct video source...');
                                this.player.src({
                                    src: flvUrl,
                                    type: 'video/x-flv'
                                });
                                this.player.play().catch(e => console.log('Auto-play prevented:', e));
                            } else {
                                console.log('FLV stream not available');
                                this.showStreamError('Stream is currently offline.');
                            }
                        })
                        .catch(error => {
                            console.log('FLV test failed:', error);
                            this.showStreamError('Unable to connect to stream.');
                        });
                }

                this.player.on('error', (e) => {
                    console.error('Player error:', e);
                    setTimeout(() => {
                        console.log('Attempting to reload stream...');
                        location.reload();
                    }, 5000);
                });
            }
        }
    }

    /**
     * Show stream error message
     */
    showStreamError(message) {
        const errorDiv = document.createElement('div');
        errorDiv.className = 'alert alert-warning mt-3';
        errorDiv.innerHTML = `
            <i class="fas fa-exclamation-triangle me-2"></i>
            ${message}
            <button class="btn btn-sm btn-outline-primary ms-3" onclick="location.reload()">
                Refresh Page
            </button>
        `;
        
        const videoContainer = document.querySelector('.video-player');
        if (videoContainer) {
            videoContainer.appendChild(errorDiv);
        }
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

        // Global fullscreen toggle function
        window.toggleFullscreen = () => {
            const videoPlayer = document.querySelector('.video-player');
            const fullscreenBtn = document.querySelector('.fullscreen-btn i');
            
            if (!document.fullscreenElement) {
                // Enter fullscreen - only the video player, not the background
                if (videoPlayer.requestFullscreen) {
                    videoPlayer.requestFullscreen();
                } else if (videoPlayer.webkitRequestFullscreen) {
                    videoPlayer.webkitRequestFullscreen();
                } else if (videoPlayer.msRequestFullscreen) {
                    videoPlayer.msRequestFullscreen();
                } else if (this.player) {
                    this.player.requestFullscreen();
                }
                
                // Update icon to compress
                if (fullscreenBtn) {
                    fullscreenBtn.className = 'fas fa-compress';
                }
            } else {
                // Exit fullscreen
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                } else if (document.webkitExitFullscreen) {
                    document.webkitExitFullscreen();
                } else if (document.msExitFullscreen) {
                    document.msExitFullscreen();
                } else if (this.player) {
                    this.player.exitFullscreen();
                }
                
                // Update icon to expand
                if (fullscreenBtn) {
                    fullscreenBtn.className = 'fas fa-expand';
                }
            }
        };
        
        // Listen for fullscreen changes to update icon
        document.addEventListener('fullscreenchange', () => {
            const fullscreenBtn = document.querySelector('.fullscreen-btn i');
            if (fullscreenBtn) {
                if (document.fullscreenElement) {
                    fullscreenBtn.className = 'fas fa-compress';
                } else {
                    fullscreenBtn.className = 'fas fa-expand';
                }
            }
        });
        
        // Global mute toggle function
        window.toggleMute = () => {
            const muteBtn = document.querySelector('.mute-btn');
            const muteBtnIcon = document.querySelector('.mute-btn i');
            const videoElement = document.querySelector('#live-stream-player, #live-video');
            
            if (videoElement) {
                if (videoElement.muted) {
                    // Unmute
                    videoElement.muted = false;
                    if (this.player) {
                        this.player.muted(false);
                    }
                    if (muteBtnIcon) {
                        muteBtnIcon.className = 'fas fa-volume-up';
                    }
                    if (muteBtn) {
                        muteBtn.classList.add('unmuted');
                        muteBtn.title = '点击静音';
                    }
                } else {
                    // Mute
                    videoElement.muted = true;
                    if (this.player) {
                        this.player.muted(true);
                    }
                    if (muteBtnIcon) {
                        muteBtnIcon.className = 'fas fa-volume-mute';
                    }
                    if (muteBtn) {
                        muteBtn.classList.remove('unmuted');
                        muteBtn.title = '点击取消静音';
                    }
                }
            }
        };
    }

    /**
     * Setup periodic status updates and viewer tracking
     */
    setupStatusUpdates() {
        if (this.matchId) {
            // Join the live stream
            this.joinLiveStream();
            
            // Send heartbeat every 30 seconds to keep viewer active
            this.heartbeatInterval = setInterval(() => {
                this.sendHeartbeat();
            }, 30000);
            
            // Update viewer count every 15 seconds
            setInterval(() => {
                this.updateViewerCount();
            }, 15000);
            
            // Leave stream when page is closed
            window.addEventListener('beforeunload', () => {
                this.leaveLiveStream();
            });
        }
    }

    /**
     * Join live stream - increment viewer count
     */
    joinLiveStream() {
        if (!this.matchId) return;

        fetch(`/api/live/${this.matchId}/join`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Joined live stream, viewer count:', data.viewer_count);
                this.updateViewerCountDisplay(data.viewer_count);
            }
        })
        .catch(error => console.error('Error joining live stream:', error));
    }

    /**
     * Leave live stream - decrement viewer count
     */
    leaveLiveStream() {
        if (!this.matchId) return;

        // Use sendBeacon for reliable delivery when page is closing
        const url = `/api/live/${this.matchId}/leave`;
        const blob = new Blob([JSON.stringify({})], { type: 'application/json' });
        navigator.sendBeacon(url, blob);
    }

    /**
     * Send heartbeat to keep viewer session alive
     */
    sendHeartbeat() {
        if (!this.matchId) return;

        fetch(`/api/live/${this.matchId}/heartbeat`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .catch(error => console.error('Error sending heartbeat:', error));
    }

    /**
     * Update viewer count from server
     */
    updateViewerCount() {
        if (!this.matchId) return;

        fetch(`/api/live/${this.matchId}/viewers`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    this.updateViewerCountDisplay(data.viewer_count);
                }
            })
            .catch(error => console.error('Error updating viewer count:', error));
    }

    /**
     * Update viewer count display with animation
     */
    updateViewerCountDisplay(newCount) {
        const viewerCountElement = document.getElementById('live-viewer-count');
        if (!viewerCountElement) return;

        const oldCount = parseInt(viewerCountElement.textContent.replace(/,/g, '')) || 0;
        
        // Update the number
        viewerCountElement.textContent = newCount.toLocaleString();
        
        // Add animation class based on change
        const viewerContainer = document.querySelector('.viewer-count-hls');
        if (viewerContainer) {
            viewerContainer.classList.remove('viewer-increase', 'viewer-decrease');
            
            if (newCount > oldCount) {
                viewerContainer.classList.add('viewer-increase');
            } else if (newCount < oldCount) {
                viewerContainer.classList.add('viewer-decrease');
            }
            
            // Remove animation class after animation completes
            setTimeout(() => {
                viewerContainer.classList.remove('viewer-increase', 'viewer-decrease');
            }, 500);
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
                        // Handle goto activity action - use data attribute URL
                        const eventsUrl = this.getAttribute('data-events-url');
                        if (eventsUrl) {
                            console.log('Navigating to activity page:', eventsUrl);
                            window.location.href = eventsUrl;
                        }
                        break;
                        
                    case 'goto-bet':
                        // Handle goto bet action
                        console.log('Navigating to betting page...');
                        // window.location.href = '/bet'; // Uncomment when route is ready
                        break;
                        
                    case 'other-events':
                        // Handle other events action - use data attribute URL
                        const matchesUrl = this.getAttribute('data-matches-url');
                        if (matchesUrl) {
                            console.log('Navigating to matches page:', matchesUrl);
                            window.location.href = matchesUrl;
                        }
                        break;
                        
                    default:
                        console.warn('Unknown action:', action);
                }
            });
        });
        
        console.log('Action buttons initialized');
    }

    /**
     * Setup comment form submission functionality
     */
    setupDummyChat() {
        const commentForm = document.querySelector('.comment-form');
        const commentInput = document.querySelector('.comment-input');
        const submitButton = document.querySelector('.submit-button');
        const chatContainer = document.querySelector('.live-chat-comments');
        
        if (!commentForm) {
            console.log('Comment form not found - user not logged in');
            return;
        }

        if (!commentInput || !submitButton) {
            console.warn('Comment input or submit button not found');
            return;
        }
        
        // Store reference to this for use in event handlers
        const self = this;
        
        // Handle form submission
        commentForm.addEventListener('submit', (e) => {
            e.preventDefault();
            console.log('Form submitted, this.matchId:', self.matchId);
            self.submitComment(commentInput, chatContainer);
        });
        
        // Handle enter key (without shift)
        commentInput.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                console.log('Enter pressed, this.matchId:', self.matchId);
                self.submitComment(commentInput, chatContainer);
            }
        });
        
        // Auto scroll to bottom on load
        if (chatContainer) {
            this.scrollToBottom(chatContainer);
        }
        
        console.log('Comment form initialized with match ID:', this.matchId);
    }

    /**
     * Submit comment to server
     */
    submitComment(input, chatContainer) {
        const message = input.value.trim();
        if (!message) {
            console.log('Empty message, not submitting');
            return;
        }

        // Get match ID from instance or page element
        let matchId = this.matchId;
        
        // If matchId is still null, try to get it from the page element again
        if (!matchId) {
            const pageElement = document.getElementById('page-live');
            if (pageElement) {
                const dataId = pageElement.getAttribute('data-match-id');
                matchId = dataId ? parseInt(dataId) : null;
            }
        }

        // Debug: Check match ID
        console.log('Submitting comment with match ID:', matchId);
        console.log('Instance matchId:', this.matchId);
        
        if (!matchId) {
            console.error('Match ID is null, cannot submit comment');
            this.showError('无法提交评论：未找到直播ID');
            return;
        }
        
        // Disable input while submitting
        input.disabled = true;
        const submitButton = document.querySelector('.submit-button');
        if (submitButton) {
            submitButton.disabled = true;
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
        }
        
        // Prepare form data
        const formData = new FormData();
        formData.append('content', message);
        
        // Get CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]');
        
        // Submit comment to live match endpoint
        console.log('Submitting to URL:', `/live/${matchId}/comment`);
        fetch(`/live/${matchId}/comment`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken ? csrfToken.getAttribute('content') : '',
                'Accept': 'application/json',
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Comment submitted successfully:', data);
                console.log('Comment data:', data.comment);
                console.log('CommentList instance available:', !!this.commentList);
                console.log('Chat container:', chatContainer);
                
                // Clear input
                input.value = '';
                
                // Add comment to list using CommentListComponent instance
                if (this.commentList) {
                    console.log('Adding comment using commentList instance');
                    this.commentList.addComment(data.comment);
                    console.log('Comment added successfully');
                    
                    // Scroll to bottom to show new comment
                    if (chatContainer) {
                        this.scrollToBottom(chatContainer);
                    }
                } else {
                    console.warn('CommentList instance not available, reloading page');
                    // Fallback: reload page to show new comment
                    location.reload();
                }
                
                // Show success message
                this.showSuccess('评论发表成功！');
            } else {
                console.error('Failed to submit comment:', data);
                this.showError(data.message || '评论发表失败，请重试');
            }
        })
        .catch(error => {
            console.error('Error submitting comment:', error);
            this.showError('网络错误，请检查您的连接');
        })
        .finally(() => {
            // Re-enable input
            input.disabled = false;
            if (submitButton) {
                submitButton.disabled = false;
                submitButton.innerHTML = '发表评论';
            }
        });
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
        // Leave live stream
        this.leaveLiveStream();
        
        // Clear heartbeat interval
        if (this.heartbeatInterval) {
            clearInterval(this.heartbeatInterval);
        }
        
        // Cleanup video player
        if (this.player) {
            if (this.player.flvPlayer) {
                this.player.flvPlayer.destroy();
            }
            this.player.dispose();
        }

        // Remove global references
        delete window.LivePage;
        delete window.Live;
        delete window.toggleFullscreen;
        delete window.toggleMute;
        
        super.destroy();
    }
}

// Cleanup on page unload
window.addEventListener('beforeunload', function() {
    if (window.LivePage && window.LivePage.player && window.LivePage.player.flvPlayer) {
        window.LivePage.player.flvPlayer.destroy();
    }
});

// Auto-initialize if on live page
$(document).ready(() => {
    new LivePage();
});

export default LivePage;
