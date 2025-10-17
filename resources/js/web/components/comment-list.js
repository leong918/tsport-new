/**
 * Comment List Component
 * Handles comment interactions like likes, adding comments, etc.
 */

class CommentListComponent {
    constructor() {
        this.init();
    }

    /**
     * Initialize the component
     */
    init() {
        this.setupCommentLikes();
        this.setupAutoScroll();
        this.setupScrollProtection();
        
        // 移动端特别初始化
        if (this.isMobileDevice()) {
            this.initMobileOptimizations();
        }
        
        // Make globally available
        window.CommentListComponent = this;
    }

    /**
     * Initialize mobile-specific optimizations
     */
    initMobileOptimizations() {
        // 禁用页面缩放干扰
        const viewport = document.querySelector('meta[name="viewport"]');
        if (viewport) {
            const content = viewport.getAttribute('content');
            if (!content.includes('user-scalable=no')) {
                // 在 comment list 获得焦点时禁用缩放
                const containers = document.querySelectorAll('.comment-list-component .comments-list');
                containers.forEach(container => {
                    container.addEventListener('touchstart', () => {
                        viewport.setAttribute('content', content + ', user-scalable=no');
                    }, { passive: true });
                    
                    container.addEventListener('touchend', () => {
                        setTimeout(() => {
                            viewport.setAttribute('content', content);
                        }, 500);
                    }, { passive: true });
                });
            }
        }
        
        // 添加移动端特定的 CSS 类
        document.body.classList.add('mobile-comment-optimized');
    }

    /**
     * Setup scroll protection to prevent conflicts with smooth scroll
     */
    setupScrollProtection() {
        const containers = document.querySelectorAll('.comment-list-component .comments-list');
        containers.forEach(container => {
            // Enhanced smooth scrolling for comment containers
            this.enhanceCommentScrolling(container);
            
            // 移动端触摸滚动优化
            this.setupMobileScrolling(container);
            
            // 桌面端鼠标滚动优化
            this.setupDesktopScrolling(container);
        });
    }

    /**
     * Setup mobile-specific scrolling optimizations
     */
    setupMobileScrolling(container) {
        let isScrolling = false;
        let scrollTimeout;
        
        // 触摸开始
        container.addEventListener('touchstart', (e) => {
            if (!isScrolling) {
                isScrolling = true;
                console.log('📱 Comment scrolling started');
                this.pausePageSmoothScroll();
            }
            
            // 清除之前的超时
            if (scrollTimeout) {
                clearTimeout(scrollTimeout);
            }
        }, { passive: true });

        // 触摸移动 - 优化触摸滚动
        container.addEventListener('touchmove', (e) => {
            // 确保滚动在容器内
            e.stopPropagation();
        }, { passive: true });

        // 触摸结束
        container.addEventListener('touchend', (e) => {
            // 延迟标记滚动结束，允许惯性滚动
            scrollTimeout = setTimeout(() => {
                if (isScrolling) {
                    isScrolling = false;
                    console.log('📱 Comment scrolling ended');
                    this.resumePageSmoothScroll();
                }
            }, 800); // 增加延迟时间
        }, { passive: true });

        // 监听滚动事件以延长暂停时间
        container.addEventListener('scroll', (e) => {
            if (isScrolling) {
                // 如果还在滚动，重置超时
                if (scrollTimeout) {
                    clearTimeout(scrollTimeout);
                }
                scrollTimeout = setTimeout(() => {
                    if (isScrolling) {
                        isScrolling = false;
                        console.log('📱 Comment scrolling ended (via scroll)');
                        this.resumePageSmoothScroll();
                    }
                }, 600);
            }
        }, { passive: true });
    }

    /**
     * Setup desktop-specific scrolling optimizations
     */
    setupDesktopScrolling(container) {
        // 只在非触摸设备上应用
        if ('ontouchstart' in window) return;
        
        // 鼠标滚动事件 - 更好的隔离
        container.addEventListener('wheel', (e) => {
            e.stopPropagation(); // 防止事件冒泡到页面滚动
            
            // 添加自定义平滑滚动
            this.handleSmoothWheelScroll(container, e);
        }, { passive: false });
    }

    /**
     * Enhanced scrolling for comment containers
     */
    enhanceCommentScrolling(container) {
        // 基础 CSS 平滑滚动增强
        container.style.scrollBehavior = 'smooth';
        container.style.scrollPaddingTop = '10px';
        container.style.scrollPaddingBottom = '10px';
        
        // 移动端特别优化
        if (this.isMobileDevice()) {
            // iOS 和 Android 平滑滚动
            container.style.webkitOverflowScrolling = 'touch';
            container.style.overscrollBehaviorY = 'contain';
            
            // 硬件加速
            container.style.transform = 'translateZ(0)';
            container.style.willChange = 'scroll-position';
            
            // 禁用 scroll snap 避免干扰
            container.style.scrollSnapType = 'none';
            container.style.webkitScrollSnapType = 'none';
            
            // 移动端触摸优化
            container.style.touchAction = 'pan-y';
        } else {
            // 桌面端设置滚动条稳定区域
            container.style.scrollbarGutter = 'stable';
        }
    }

    /**
     * Check if device is mobile
     */
    isMobileDevice() {
        return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) 
            || 'ontouchstart' in window 
            || window.innerWidth <= 768;
    }

    /**
     * Handle smooth wheel scrolling for comment containers
     */
    handleSmoothWheelScroll(container, e) {
        // 只在桌面端处理滚轮事件
        if (this.isMobileDevice()) {
            return;
        }
        
        // 获取滚动距离
        const delta = e.deltaY;
        const scrollAmount = Math.abs(delta) > 100 ? delta : delta * 1.5;
        
        // 检查滚动边界
        const maxScroll = container.scrollHeight - container.clientHeight;
        const currentScroll = container.scrollTop;
        const newScrollTop = Math.max(0, Math.min(maxScroll, currentScroll + scrollAmount));
        
        // 平滑滚动到新位置
        container.scrollTo({
            top: newScrollTop,
            behavior: 'smooth'
        });
        
        // 防止默认滚动
        e.preventDefault();
    }

    /**
     * Temporarily pause page smooth scroll
     */
    pausePageSmoothScroll() {
        if (window.smoothScrollControl && typeof window.smoothScrollControl.isPaused === 'function') {
            // 使用 smoothScrollControl 检查状态
            if (!window.smoothScrollControl.isPaused()) {
                window.smoothScrollControl.pause();
            }
        } else if (window.smoothScroll && typeof window.smoothScroll.pauseScrolling === 'function') {
            // 备用方案：检查 isPaused 属性
            if (!window.smoothScroll.isPaused) {
                window.smoothScroll.pauseScrolling();
            }
        }
    }

    /**
     * Resume page smooth scroll
     */
    resumePageSmoothScroll() {
        if (window.smoothScrollControl && typeof window.smoothScrollControl.isPaused === 'function') {
            // 使用 smoothScrollControl 检查状态
            if (window.smoothScrollControl.isPaused()) {
                window.smoothScrollControl.resume();
            }
        } else if (window.smoothScroll && typeof window.smoothScroll.resumeScrolling === 'function') {
            // 备用方案：检查 isPaused 属性
            if (window.smoothScroll.isPaused) {
                window.smoothScroll.resumeScrolling();
            }
        }
    }

    /**
     * Setup comment like button event listeners
     */
    setupCommentLikes() {
        const likeButtons = document.querySelectorAll('.comment-list-component .like-btn');
        likeButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation(); // 防止事件冒泡到 smooth scroll
                this.handleCommentLike(button);
            });
        });
    }

    /**
     * Handle comment like/unlike functionality
     */
    handleCommentLike(button) {
        const commentId = button.dataset.commentId;
        if (!commentId) return;

        // Prevent multiple clicks
        if (button.disabled) return;

        // Show loading state
        const originalContent = button.innerHTML;
        button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
        button.disabled = true;

        // Send like request
        fetch(`/comment/${commentId}/like`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Restore original content first
                button.innerHTML = originalContent;
                
                // Then update button state
                const img = button.querySelector('img');
                const likeCount = button.querySelector('.like-count');

                if (data.liked) {
                    button.classList.add('liked');
                    if (img) {
                        const oldSrc = img.src;
                        const newSrc = img.src.replace('like-inactive.png', 'like-active.png');
                        img.src = newSrc;
                    }
                } else {
                    button.classList.remove('liked');
                    if (img) {
                        const oldSrc = img.src;
                        const newSrc = img.src.replace('like-active.png', 'like-inactive.png');
                        img.src = newSrc;
                    }
                }

                if (likeCount) {
                    likeCount.textContent = data.likes_count;
                }

                // Add visual feedback
                button.style.transform = 'scale(1.1)';
                setTimeout(() => {
                    button.style.transform = 'scale(1)';
                }, 200);
            } else {
                // Restore content on error
                button.innerHTML = originalContent;
                console.error('Failed to like comment:', data.message);
            }
        })
        .catch(error => {
            // Restore content on error
            button.innerHTML = originalContent;
            console.error('Error liking comment:', error);
        })
        .finally(() => {
            // Only disable the loading state
            button.disabled = false;
        });
    }

    /**
     * Setup auto scroll for comment containers
     */
    setupAutoScroll() {
        const containers = document.querySelectorAll('.comment-list-component .comments-list');
        containers.forEach(container => {
            // 确保容器有正确的滚动属性
            container.style.overflowY = 'auto';
            container.style.webkitOverflowScrolling = 'touch'; // iOS smooth scrolling
            
            // 应用增强的滚动设置
            this.enhanceCommentScrolling(container);
            
            // 只在需要时滚动到底部，使用平滑滚动
            if (container && container.scrollHeight > container.clientHeight) {
                // 使用 requestAnimationFrame 确保 DOM 更新完成
                requestAnimationFrame(() => {
                    container.scrollTo({
                        top: container.scrollHeight,
                        behavior: 'smooth'
                    });
                });
            }
        });
    }

    /**
     * Add a new comment to the specified container
     */
    addComment(containerId, comment) {
        const container = document.getElementById(containerId);
        if (!container) return;

        // Remove no-comments message if exists
        const noComments = container.querySelector('.no-comments');
        if (noComments) {
            noComments.remove();
        }

        // Create new comment element and add to top
        const commentHtml = this.createCommentHtml(comment);
        container.insertAdjacentHTML('afterbegin', commentHtml);

        // Re-setup event listeners for new comment
        this.setupCommentLikes();

        // Add fade-in animation for new comment
        const newComment = container.firstElementChild;
        if (newComment) {
            newComment.style.opacity = '0';
            newComment.style.transform = 'translateY(-10px)';
            
            // 平滑滚动到新评论
            setTimeout(() => {
                newComment.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                newComment.style.opacity = '1';
                newComment.style.transform = 'translateY(0)';
                
                // 滚动到新评论位置
                newComment.scrollIntoView({
                    behavior: 'smooth',
                    block: 'nearest',
                    inline: 'nearest'
                });
            }, 10);
        }
    }

    /**
     * Create HTML for a new comment
     */
    createCommentHtml(comment) {
        return `
            <div class="comment-item" data-comment-id="${comment.id}">
                <div class="comment-avatar">
                    <div class="avatar-img">
                        <img src="${comment.avatar || '/assets/web/images/chat/avatar-default.png'}" alt="${comment.user_name}">
                    </div>
                </div>
                <div class="comment-content">
                    <div class="comment-meta">
                        <span class="comment-author">${comment.user_name}</span>
                        <span class="comment-time">${comment.created_at_human || '刚刚'}</span>
                    </div>
                    <div class="comment-bubble">
                        ${comment.comment}
                    </div>
                </div>
                <div class="comment-actions">
                    <button class="like-btn" data-comment-id="${comment.id}">
                        <img src="/assets/web/images/chat/like-inactive.png" alt="Like">
                        <span class="like-count">${comment.likes_count || 0}</span>
                    </button>
                </div>
            </div>
        `;
    }

    /**
     * Refresh component after DOM changes
     */
    refresh() {
        this.setupCommentLikes();
        this.setupAutoScroll();
        this.setupScrollProtection();
    }

    /**
     * Get CSRF token from meta tag
     */
    getCSRFToken() {
        const token = document.querySelector('meta[name="csrf-token"]');
        return token ? token.getAttribute('content') : '';
    }
}

// Auto-initialize when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    new CommentListComponent();
});

export default CommentListComponent;
