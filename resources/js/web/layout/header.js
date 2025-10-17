// Header JavaScript functionality for TSport
// Handles offcanvas sidebar, smooth scroll integration, and dynamic header height

/**
 * Dynamic Header Height Calculator
 * Calculates the actual header height and sets CSS custom properties
 */
class HeaderHeight {
  constructor() {
    this.header = null;
    this.initialized = false;
    this.resizeObserver = null;
  }

  init() {
    // Wait for DOM to be ready
    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', () => this.setup());
    } else {
      this.setup();
    }
  }

  setup() {
    this.header = document.getElementById('header');
    
    if (!this.header) {
      return;
    }

    // Calculate and set initial header height
    this.calculateAndSetHeight();

    // Set up resize observer for responsive changes
    this.setupResizeObserver();

    // Listen for font load events (since header might change height when fonts load)
    this.setupFontLoadListener();

    this.initialized = true;
  }

  calculateAndSetHeight() {
    if (!this.header) return;

    // Get the actual computed height of the header
    const headerRect = this.header.getBoundingClientRect();
    const headerHeight = Math.ceil(headerRect.height);
    
    // Add 10px buffer as requested
    const totalHeight = headerHeight + 10;
    
    // Set CSS custom property
    document.documentElement.style.setProperty('--header-height', `${totalHeight}px`);
  }

  setupResizeObserver() {
    if (!window.ResizeObserver) return;

    this.resizeObserver = new ResizeObserver((entries) => {
      for (let entry of entries) {
        // Debounce the height calculation
        clearTimeout(this.resizeTimeout);
        this.resizeTimeout = setTimeout(() => {
          this.calculateAndSetHeight();
        }, 250);
      }
    });

    if (this.header) {
      this.resizeObserver.observe(this.header);
    }
  }

  setupFontLoadListener() {
    if ('fonts' in document) {
      document.fonts.ready.then(() => {
        setTimeout(() => {
          this.calculateAndSetHeight();
        }, 100);
      });
    } else {
      // Fallback for browsers without FontFaceSet API
      window.addEventListener('load', () => {
        setTimeout(() => {
          this.calculateAndSetHeight();
        }, 500);
      });
    }
  }

  recalculate() {
    this.calculateAndSetHeight();
  }

  destroy() {
    if (this.resizeObserver && this.header) {
      this.resizeObserver.unobserve(this.header);
      this.resizeObserver.disconnect();
    }
    clearTimeout(this.resizeTimeout);
  }
}

/**
 * Header Controller Class
 * Manages the offcanvas sidebar with Bootstrap 5 integration
 */
class HeaderController {
  constructor() {
    // 单例模式 - 防止重复实例化
    if (HeaderController.instance) {
      return HeaderController.instance;
    }
    
    HeaderController.instance = this;
    
    // Bootstrap 5 offcanvas properties
    this.offcanvasElement = null;
    this.bsOffcanvas = null;
    this.headerHeight = null;
    this.isInitialized = false;

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', () => this.init());
    } else {
      this.init();
    }
  }

  init() {
    if (this.isInitialized) return;

    // Initialize header height calculator
    this.headerHeight = new HeaderHeight();
    this.headerHeight.init();

    // Initialize Bootstrap 5 Offcanvas
    this.setupOffcanvas();

    // Initialize event listeners
    this.setupEventListeners();

    // Expose global functions
    this.exposeGlobalFunctions();
    
    this.isInitialized = true;
  }

  setupOffcanvas() {
    this.offcanvasElement = document.getElementById('offcanvas-sidebar');
    console.log('🎯 Offcanvas element found:', !!this.offcanvasElement);
    
    if (this.offcanvasElement) {
      // Check multiple Bootstrap namespace variations
      const BootstrapOffcanvas = window.Bootstrap?.Offcanvas || 
                                 window.bootstrap?.Offcanvas || 
                                 window.Offcanvas ||
                                 (window.bootstrap && bootstrap.Offcanvas);
      
      console.log('🎯 Bootstrap variations check:');
      console.log('  - window.Bootstrap:', !!window.Bootstrap);
      console.log('  - window.bootstrap:', !!window.bootstrap);
      console.log('  - window.Offcanvas:', !!window.Offcanvas);
      console.log('  - Final BootstrapOffcanvas:', !!BootstrapOffcanvas);
      
      if (BootstrapOffcanvas) {
        try {
          this.bsOffcanvas = new BootstrapOffcanvas(this.offcanvasElement, {
            backdrop: false,
            keyboard: false,
            scroll: false
          });
          console.log('✅ Bootstrap Offcanvas initialized successfully');
        } catch (error) {
          console.log('❌ Bootstrap Offcanvas initialization failed:', error);
        }
      } else {
        // 如果 Bootstrap Offcanvas 不可用，使用自定义实现
        console.log('⚠️ Bootstrap Offcanvas not available, using custom implementation');
        this.setupCustomOffcanvas();
      }
    }
  }

  /**
   * 自定义 offcanvas 实现（当 Bootstrap 不可用时）
   */
  setupCustomOffcanvas() {
    this.bsOffcanvas = {
      show: () => {
        this.offcanvasElement.classList.add('show');
        this.pauseSmoothScroll();
        console.log('📱 Custom offcanvas opened');
      },
      hide: () => {
        this.offcanvasElement.classList.remove('show');
        this.resumeSmoothScroll();
        console.log('📱 Custom offcanvas closed');
      },
      toggle: () => {
        if (this.offcanvasElement.classList.contains('show')) {
          this.bsOffcanvas.hide();
        } else {
          this.bsOffcanvas.show();
        }
      }
    };
    
    // 添加点击触发器的事件监听
    const triggers = document.querySelectorAll('[data-bs-toggle="offcanvas"][data-bs-target="#offcanvas-sidebar"]');
    triggers.forEach(trigger => {
      trigger.addEventListener('click', (e) => {
        e.preventDefault();
        this.bsOffcanvas.toggle();
      });
    });
    
    console.log('✅ Custom offcanvas implementation ready');
  }

  setupEventListeners() {
    // 设置返回按钮事件监听
    this.setupBackButton();
    
    if (!this.offcanvasElement || !this.bsOffcanvas) return;

    // 只有在使用真正的 Bootstrap Offcanvas 时才添加这些事件监听器
    if (this.offcanvasElement && typeof this.bsOffcanvas.show === 'function' && this.bsOffcanvas.constructor.name !== 'Object') {
      // Bootstrap 5 事件监听器
      this.offcanvasElement.addEventListener('show.bs.offcanvas', (event) => {
        this.pauseSmoothScroll();
        console.log('📱 Bootstrap offcanvas opening - smooth scroll paused');
      });

      this.offcanvasElement.addEventListener('shown.bs.offcanvas', (event) => {
      });

      this.offcanvasElement.addEventListener('hide.bs.offcanvas', (event) => {
      });

      this.offcanvasElement.addEventListener('hidden.bs.offcanvas', (event) => {
        this.resumeSmoothScroll();
        console.log('📱 Bootstrap offcanvas closed - smooth scroll resumed');
      });
    } else {
      console.log('📱 Using custom offcanvas - events handled in custom implementation');
    }

    // 延迟绑定关闭按钮，避免冲突
    setTimeout(() => {
      const closeButton = this.offcanvasElement.querySelector('.offcanvas-close');
      if (closeButton) {
        closeButton.addEventListener('click', (e) => {
          e.preventDefault();
          e.stopPropagation();
          this.close();
        });
      }
    }, 1000);
  }

  setupBackButton() {
    // 使用事件委托，处理所有返回按钮（包括动态添加的）
    document.addEventListener('click', (e) => {
      if (e.target.closest('.back-btn')) {
        e.preventDefault();
        e.stopPropagation();
        this.goBack();
      }
    });
  }

  goBack() {
    // 检查是否有历史记录可以返回
    if (window.history.length > 1) {
      window.history.back();
    } else {
      // 如果没有历史记录，检查是否有设定的首页路由
      const homeUrl = window.homeRoute || window.location.origin + '/';
      window.location.href = homeUrl;
    }
  }

  exposeGlobalFunctions() {
    window.headerController = this;
    window.openSidebar = () => this.open();
    window.closeSidebar = () => this.close();
    window.toggleSidebar = () => this.toggle();
    window.isSidebarOpen = () => this.isOpen();
    window.goBack = () => this.goBack();
  }

  // Sidebar control methods
  open() {
    if (this.bsOffcanvas && !this.isOpen()) {
      this.bsOffcanvas.show();
      return true;
    }
    return false;
  }

  close() {
    if (this.bsOffcanvas && this.isOpen()) {
      this.bsOffcanvas.hide();
      // 恢复 smooth scroll (会在 hidden 事件中调用)
      return true;
    }
    return false;
  }

  /**
   * 暂停 smooth scroll 的辅助方法
   */
  pauseSmoothScroll() {
    console.log('🔄 Attempting to pause smooth scroll...');
    console.log('window.smoothScrollControl available:', !!window.smoothScrollControl);
    
    if (window.smoothScrollControl && typeof window.smoothScrollControl.pause === 'function') {
      window.smoothScrollControl.pause();
      console.log('✅ Called smoothScrollControl.pause()');
    } else if (window.smoothScroll && typeof window.smoothScroll.pauseScrolling === 'function') {
      window.smoothScroll.pauseScrolling();
      console.log('✅ Called smoothScroll.pauseScrolling()');
    } else {
      // 延迟重试机制
      console.log('⏳ Retrying in 100ms...');
      setTimeout(() => {
        if (window.smoothScrollControl && typeof window.smoothScrollControl.pause === 'function') {
          window.smoothScrollControl.pause();
          console.log('✅ Delayed call to smoothScrollControl.pause()');
        } else if (window.smoothScroll && typeof window.smoothScroll.pauseScrolling === 'function') {
          window.smoothScroll.pauseScrolling();
          console.log('✅ Delayed call to smoothScroll.pauseScrolling()');
        } else {
          console.log('❌ No smooth scroll control method available after retry');
        }
      }, 100);
    }
  }

  /**
   * 恢复 smooth scroll 的辅助方法
   */
  resumeSmoothScroll() {
    console.log('▶️ Attempting to resume smooth scroll...');
    
    if (window.smoothScrollControl && typeof window.smoothScrollControl.resume === 'function') {
      window.smoothScrollControl.resume();
      console.log('✅ Called smoothScrollControl.resume()');
    } else if (window.smoothScroll && typeof window.smoothScroll.resumeScrolling === 'function') {
      window.smoothScroll.resumeScrolling();
      console.log('✅ Called smoothScroll.resumeScrolling()');
    } else {
      // 延迟重试机制
      console.log('⏳ Retrying in 100ms...');
      setTimeout(() => {
        if (window.smoothScrollControl && typeof window.smoothScrollControl.resume === 'function') {
          window.smoothScrollControl.resume();
          console.log('✅ Delayed call to smoothScrollControl.resume()');
        } else if (window.smoothScroll && typeof window.smoothScroll.resumeScrolling === 'function') {
          window.smoothScroll.resumeScrolling();
          console.log('✅ Delayed call to smoothScroll.resumeScrolling()');
        } else {
          console.log('❌ No smooth scroll control method available after retry');
        }
      }, 100);
    }
  }

  toggle() {
    if (this.isOpen()) {
      this.close();
    } else {
      this.open();
    }
  }

  isOpen() {
    if (!this.offcanvasElement) return false;
    return this.offcanvasElement.classList.contains('show');
  }
}

// Create and export singleton instance - 防止重复实例化
// const headerController = new HeaderController();

// Export both default and named exports for compatibility
export default HeaderController;
export { HeaderController, HeaderHeight };
