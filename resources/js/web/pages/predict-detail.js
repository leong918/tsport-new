/**
 * Predict Detail Page JavaScript
 * Handles prediction details, comments, interactions
 */

import $ from 'jquery';
import BasePage from './BasePage.js';

class PredictDetailPage extends BasePage {
    constructor() {
        super();
        this.pageName = 'predict-detail';
        this.pageSelector = '#page-predict-detail';
        this.predictId = null;
        this.commentSection = null;
        this.isScrollTriggerLoaded = false;
        this.footballTerms = [
            '足球', '预测', '分析', '比赛', '进球', '射门', '传球', '控球', '防守', '进攻',
            '角球', '任意球', '点球', '越位', '犯规', '黄牌', '红牌', '换人', '加时',
            '点球大战', '主队', '客队', '平局', '胜负', '比分', '赔率', '盘口', '让球',
            '大小球', '半场', '全场', '首发', '替补', '教练', '战术', '阵型', '配合',
            '反击', '定位球', '门将', '后卫', '中场', '前锋', '队长', '核心', '新星',
            '老将', '伤病', '停赛', '复出', '转会', '续约', '合同', '身价', '转会费',
            '联赛', '杯赛', '欧冠', '世界杯', '欧洲杯', '亚洲杯', '友谊赛', '热身赛',
            '季前赛', '常规赛', '季后赛', '决赛', '半决赛', '四分之一决赛', '小组赛',
            '淘汰赛', '附加赛', '升降级', '保级', '夺冠', '卫冕', '三连冠', '不败',
            '连胜', '连败', '逆转', '绝杀', '补时', '伤停补时', '开球', '中圈'
        ];
        
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
                          window.location.pathname.includes('/predict/') ||
                          document.body.classList.contains('predict-detail-page');
        
        return shouldInit;
    }

    /**
     * Initialize page functionality
     */
    init() {
        // Set body class for specific styling
        document.body.classList.add('predict-detail-page');
        
        // Call parent init
        super.init();

        // Make service globally available
        window.PredictDetailPage = this;
        window.PredictDetail = {
            likePredict: (event, id) => this.handlePredictLike(event, id),
            submitComment: (event, id) => this.handleCommentSubmit(event),
            likeComment: (id) => this.handleCommentLike($(`[data-comment-id="${id}"]`)),
            showMessage: (msg, type) => this.showMessage(msg, type),
            generateBackgroundText: () => this.generateBackgroundText(),
            getPredictId: () => this.predictId,
            getPredictLikeStats: (id) => this.getPredictLikeStats(id),
            copyLink: (event) => this.handleCopyLink(event),
        };
    }

    /**
     * Initialize page components
     */
    initializeComponents() {
        // Extract prediction ID immediately
        this.extractPredictId();
        
        // Also set up a DOM ready handler as backup
        $(document).ready(() => {
            if (!this.predictId) {
                this.extractPredictId();
            }
        });
        
        // Try multiple ways to find the comment section
        this.commentSection = document.getElementById('section-input-comment') || 
                             document.querySelector('#section-input-comment') ||
                             document.querySelector('.comment-input-section');
    }

    /**
     * Bind event listeners
     */
    bindEvents() {
        // Comment form submission
        $(document).on('submit', '.comment-form', (e) => this.handleCommentSubmit(e));

        // Comment like buttons
        $(document).on('click', '.like-btn', (e) => {
            e.preventDefault();
            this.handleCommentLike($(e.currentTarget));
        });

        // Auto-resize textarea
        $(document).on('input', '.comment-input', (e) => this.handleTextareaResize(e));

        // Like prediction buttons
        $(document).on('click', '.like-prediction-btn', (e) => {
            e.preventDefault();
            const predictId = $(e.currentTarget).data('predict-id') || this.predictId;
            this.likePredict(predictId);
        });

        // Share button
        $(document).on('click', '.share-btn', (e) => {
            e.preventDefault();
            this.handleCopyLink(e);
        });
    }

    /**
     * Setup visual effects and animations
     */
    setupEffects() {
        this.generateBackgroundText();
    }

    /**
     * Extract prediction ID from URL or data attributes
     */
    extractPredictId() {
        // Try to get from URL pattern /predict/{id}
        const urlMatch = window.location.pathname.match(/\/predict\/(\d+)/);
        if (urlMatch) {
            this.predictId = parseInt(urlMatch[1]);
            return;
        }
        
        // Try page element data attribute
        const pageElement = $('#page-predict-detail');
        if (pageElement.length) {
            const dataId = pageElement.data('predict-id');
            if (dataId) {
                this.predictId = parseInt(dataId);
                return;
            }
        }
        
        // Try form data attribute
        const formElement = $('.comment-form');
        if (formElement.length) {
            const formId = formElement.data('predict-id');
            if (formId) {
                this.predictId = parseInt(formId);
                return;
            }
        }
        
        // Try meta tag (if available)
        const metaElement = $('meta[name="predict-id"]');
        if (metaElement.length) {
            const metaId = metaElement.attr('content');
            if (metaId) {
                this.predictId = parseInt(metaId);
                return;
            }
        }
        
        this.predictId = null;
    }

    /**
     * Handle comment like
     */
    async handleCommentLike($button) {
        // Use CommentListComponent if available
        if (window.CommentListComponent && window.CommentListComponent.handleCommentLike) {
            window.CommentListComponent.handleCommentLike($button[0]);
            return;
        }
        
        // If CommentListComponent is not available, show error
        this.showError('评论功能暂时不可用，请刷新页面重试');
    }

    /**
     * Add new comment to the comments list
     */
    addCommentToList(comment) {
        // Use CommentListComponent if available
        if (window.CommentListComponent && window.CommentListComponent.addComment) {
            window.CommentListComponent.addComment('comments-list', comment);
            return;
        }
        
        // Simple fallback if CommentListComponent is not available
        this.showSuccess('评论已提交，请刷新页面查看');
    }

    /**
     * Update comment count in stats bar
     */
    updateCommentCount() {
        const $commentCountSpan = $('.stats-bar .stat-item').find('i.fa-comment').next('span');
        const currentCount = parseInt($commentCountSpan.text()) || 0;
        $commentCountSpan.text(currentCount + 1);
    }

    /**
     * Handle textarea auto-resize
     */
    handleTextareaResize(event) {
        const $textarea = $(event.target);
        $textarea.css('height', 'auto');
        $textarea.css('height', Math.min($textarea[0].scrollHeight, 120) + 'px');
    }

    /**
     * Handle comment form submission
     */
    async handleCommentSubmit(event) {
        event.preventDefault();

        const $form = $(event.target);
        
        // Try multiple ways to get the prediction ID
        let predictId = $form.data('predict-id') || this.predictId;
        
        // If still null, try to extract from page element
        if (!predictId) {
            const pageElement = $('#page-predict-detail');
            predictId = pageElement.data('predict-id');
        }
        
        // If still null, try to extract from URL again
        if (!predictId) {
            const urlMatch = window.location.pathname.match(/\/predict\/(\d+)/);
            if (urlMatch) {
                predictId = parseInt(urlMatch[1]);
            }
        }
        
        // Validate prediction ID
        if (!predictId || predictId === 'null' || predictId === 'undefined') {
            this.showError('无法获取预测ID，请刷新页面重试');
            return;
        }
        
        const formData = new FormData($form[0]);
        const $submitButton = $form.find('.submit-button');
        const originalText = $submitButton.text();

        try {
            // Show loading state
            $submitButton.text('提交中...').prop('disabled', true);

            const response = await fetch(`/predict/${predictId}/comment`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': this.getCSRFToken(),
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const contentType = response.headers.get('content-type');
            if (!contentType || !contentType.includes('application/json')) {
                throw new Error('Server returned non-JSON response');
            }

            const data = await response.json();

            if (data.success) {
                // Clear form
                $form[0].reset();

                // Show success message
                this.showSuccess('评论提交成功！');

                // Add new comment to the list
                this.addCommentToList(data.comment);

                // Update comment count
                this.updateCommentCount();
            } else {
                this.showError(data.message || '评论提交失败');
            }

        } catch (error) {
            this.showError('网络错误，请稍后重试');
        } finally {
            // Restore button state
            $submitButton.text(originalText).prop('disabled', false);
        }
    }

    /**
     * Like prediction functionality
     */
    async likePredict(predictId) {
        try {
            const response = await fetch(`/predict/${predictId}/like`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.getCSRFToken(),
                    'Accept': 'application/json'
                }
            });

            const data = await response.json();

            if (data.success) {
                // Update like count
                const $likesCount = $('#likes-count');
                if ($likesCount.length) {
                    $likesCount.text(data.likes_count);
                }

                // Add animation effect
                const $heartIcon = $('.stat-item .fa-heart');
                if ($heartIcon.length) {
                    $heartIcon.css({
                        'transform': 'scale(1.3)',
                        'color': '#e74c3c'
                    });
                    setTimeout(() => {
                        $heartIcon.css('transform', 'scale(1)');
                    }, 300);
                }

                this.showSuccess('点赞成功！');
            } else {
                this.showError(data.message || '点赞失败，请稍后重试');
            }

        } catch (error) {
            this.showError('网络错误，请稍后重试');
        }
    }

    /**
     * Show error message
     */
    showError(message) {
        this.showMessage(message, 'error');
        super.showError(message);
    }

    /**
     * Show success message
     */
    showSuccess(message) {
        this.showMessage(message, 'success');
        super.showSuccess(message);
    }

    /**
     * Show message notification
     */
    showMessage(message, type = 'info') {
        const $messageElement = $(`
            <div class="alert alert-${type === 'success' ? 'success' : 'danger'} alert-dismissible fade show" 
                 style="position: fixed; top: 20px; right: 20px; z-index: 9999; min-width: 300px;">
                ${message}
                <button type="button" class="btn-close" onclick="$(this).parent().remove()"></button>
            </div>
        `);

        $('body').append($messageElement);

        // Auto remove after 3 seconds
        setTimeout(() => {
            $messageElement.fadeOut(300, function() {
                $(this).remove();
            });
        }, 3000);
    }

    /**
     * Generate dense background text effect
     */
    generateBackgroundText() {
        const $backgroundTextContainer = $('.background-text');
        if (!$backgroundTextContainer.length) return;

        const container = $backgroundTextContainer[0];
        const containerHeight = container.offsetHeight;
        const containerWidth = container.offsetWidth;
        const fontSize = 10; // pixels
        const lineHeight = 12; // pixels

        const linesCount = Math.ceil(containerHeight / lineHeight) + 5;
        const wordsPerLine = Math.ceil(containerWidth / (fontSize * 0.6)) + 10;

        let backgroundText = '';

        for (let line = 0; line < linesCount; line++) {
            let lineText = '';
            for (let word = 0; word < wordsPerLine; word++) {
                const randomTerm = this.footballTerms[Math.floor(Math.random() * this.footballTerms.length)];
                lineText += randomTerm + ' ';
            }
            backgroundText += lineText.trim() + '\n';
        }

        $backgroundTextContainer.text(backgroundText);
    }

    /**
     * Handle prediction like/unlike
     */
    async handlePredictLike(event, predictId = null) {
        event.preventDefault();
        
        const $button = $(event.currentTarget);
        
        // Prevent multiple clicks
        if ($button.hasClass('processing')) {
            return;
        }
        
        try {
            // Add processing state
            $button.addClass('processing').prop('disabled', true);
            
            const id = predictId || this.predictId;
            if (!id) {
                throw new Error('Prediction ID not found');
            }

            const response = await fetch(`/predict/${id}/like`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.getCSRFToken(),
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.message || 'Failed to process like');
            }

            if (data.success) {
                // Update UI
                this.updatePredictLikeUI(id, data.liked, data.likes_count);
                this.showMessage(data.message, 'success');
            } else {
                throw new Error(data.message || 'Failed to like prediction');
            }

        } catch (error) {
            this.showMessage(error.message || 'Failed to process like. Please try again.', 'error');
        } finally {
            // Remove processing state
            $button.removeClass('processing').prop('disabled', false);
        }
    }

    /**
     * Update prediction like UI
     */
    updatePredictLikeUI(predictId, isLiked, likeCount) {
        // Update predict like button if it exists (for logged in users)
        const $likeBtn = $(`.predict-like-btn[data-predict-id="${predictId}"], .like-prediction-btn[data-predict-id="${predictId}"]`);
        if ($likeBtn.length) {
            const $likeImg = $likeBtn.find('img');
            const $likeCountSpan = $likeBtn.find('.like-count');

            // Update like button state and image
            if (isLiked) {
                $likeBtn.addClass('liked');
                if ($likeImg.length) {
                    // 更换为激活状态的图片
                    $likeImg.attr('src', $likeImg.attr('src').replace('like-title-inactive.png', 'like-title-active.png'));
                }
            } else {
                $likeBtn.removeClass('liked');
                if ($likeImg.length) {
                    // 更换为非激活状态的图片
                    $likeImg.attr('src', $likeImg.attr('src').replace('like-title-active.png', 'like-title-inactive.png'));
                }
            }

            // Update like count
            if ($likeCountSpan.length) {
                $likeCountSpan.text(likeCount);
            }

            // Add visual feedback animation (scale effect)
            $likeBtn.css('transform', 'scale(1.1)');
            setTimeout(() => {
                $likeBtn.css('transform', 'scale(1)');
            }, 200);
        }

        // Also update the likes count for non-logged in users display
        const $likesCount = $('#likes-count');
        if ($likesCount.length) {
            $likesCount.text(likeCount);
        }

        // Update any other like count displays
        $('.stats-bar .stat-item span').first().text(likeCount);
    }

    /**
     * Get prediction like statistics
     */
    async getPredictLikeStats(predictId = null) {
        try {
            const id = predictId || this.predictId;
            if (!id) {
                throw new Error('Prediction ID not found');
            }

            const response = await fetch(`/predict/${id}/like-stats`, {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': this.getCSRFToken(),
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.message || 'Failed to get statistics');
            }

            return data.data;

        } catch (error) {
            return null;
        }
    }

    /**
     * Refresh interactions after dynamic content changes
     */
    refreshInteractions() {
        // Re-bind events if needed
    }

    /**
     * Handle copy link functionality
     */
    async handleCopyLink(event) {
        event.preventDefault();
        
        const $button = $(event.currentTarget);
        const url = $button.data('url') || window.location.href;
        const title = $button.data('title') || document.title;
        
        // Check if Web Share API is supported (mobile devices)
        if (navigator.share && /Android|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
            try {
                await navigator.share({
                    title: title,
                    url: url,
                    text: `查看${title} - 预测详情`
                });
                
                this.showSuccess('分享成功！');
                this.addShareButtonFeedback($button);
                return;
            } catch (error) {
                // If sharing is cancelled or fails, fall back to copy
            }
        }
        
        // Fall back to copy functionality
        try {
            // Check if the browser supports the Clipboard API
            if (navigator.clipboard && window.isSecureContext) {
                await navigator.clipboard.writeText(url);
                this.showSuccess('链接已复制到剪贴板！');
            } else {
                // Fallback for older browsers or non-HTTPS
                this.fallbackCopyToClipboard(url);
                this.showSuccess('链接已复制到剪贴板！');
            }
            
            // Add visual feedback
            this.addShareButtonFeedback($button);
            
        } catch (error) {
            // Try fallback method
            try {
                this.fallbackCopyToClipboard(url);
                this.showSuccess('链接已复制到剪贴板！');
                this.addShareButtonFeedback($button);
            } catch (fallbackError) {
                // If all else fails, show the URL for manual copying
                this.showCopyDialog(url, title);
            }
        }
    }

    /**
     * Fallback method for copying to clipboard
     */
    fallbackCopyToClipboard(text) {
        // Create a temporary textarea element
        const textArea = document.createElement('textarea');
        textArea.value = text;
        textArea.style.position = 'fixed';
        textArea.style.left = '-999999px';
        textArea.style.top = '-999999px';
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();
        
        try {
            document.execCommand('copy');
        } finally {
            document.body.removeChild(textArea);
        }
    }

    /**
     * Show copy dialog when clipboard API is not available
     */
    showCopyDialog(url, title) {
        const dialogHtml = `
            <div class="copy-dialog-overlay" style="
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                z-index: 10000;
                display: flex;
                align-items: center;
                justify-content: center;
            ">
                <div class="copy-dialog" style="
                    background: white;
                    border-radius: 10px;
                    padding: 2rem;
                    max-width: 90%;
                    width: 400px;
                    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
                ">
                    <h4 style="margin: 0 0 1rem 0; color: #333;">分享链接</h4>
                    <p style="margin: 0 0 1rem 0; color: #666; font-size: 0.9rem;">
                        请复制以下链接进行分享：
                    </p>
                    <div style="
                        background: #f8f9fa;
                        border: 1px solid #dee2e6;
                        border-radius: 5px;
                        padding: 0.75rem;
                        margin: 0 0 1.5rem 0;
                        font-family: monospace;
                        font-size: 0.8rem;
                        word-break: break-all;
                        user-select: all;
                    ">
                        ${url}
                    </div>
                    <div style="text-align: center;">
                        <button class="btn btn-primary" onclick="this.closest('.copy-dialog-overlay').remove()" style="
                            background: #007bff;
                            color: white;
                            border: none;
                            border-radius: 5px;
                            padding: 0.5rem 1.5rem;
                            cursor: pointer;
                        ">
                            关闭
                        </button>
                    </div>
                </div>
            </div>
        `;
        
        $('body').append(dialogHtml);
        
        // Auto-remove after 10 seconds
        setTimeout(() => {
            $('.copy-dialog-overlay').fadeOut(300, function() {
                $(this).remove();
            });
        }, 10000);
    }

    /**
     * Add visual feedback to share button
     */
    addShareButtonFeedback($button) {
        const $icon = $button.find('i');
        const originalIcon = $icon.attr('class');
        
        // Change icon to checkmark temporarily
        $icon.removeClass('fa-share-alt').addClass('fa-check');
        $button.css({
            'color': '#28a745',
            'transform': 'scale(1.1)'
        });
        
        // Restore original state after 2 seconds
        setTimeout(() => {
            $icon.removeClass('fa-check').addClass('fa-share-alt');
            $button.css({
                'color': '',
                'transform': 'scale(1)'
            });
        }, 2000);
    }

    /**
     * Cleanup when page is destroyed
     */
    destroy() {
        // Clean up position interval
        if (this.positionInterval) {
            clearInterval(this.positionInterval);
        }
        
        // Remove global references
        delete window.PredictDetailPage;
        delete window.PredictDetail;
        
        super.destroy();
    }
}

// Auto-initialize if on predict detail page
$(document).ready(() => {
    new PredictDetailPage();
});

export default PredictDetailPage;
