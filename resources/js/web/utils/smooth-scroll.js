import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { ScrollSmoother } from 'gsap/ScrollSmoother';

export class SmoothScrollNavigation {
  constructor() {
    this.smoother = null;
    this.stickyHeader = null;
    this.isPaused = false;

    // Register GSAP plugins
    gsap.registerPlugin(ScrollTrigger, ScrollSmoother);
  }

  init() {
    this.setupSmoothScroll();
    this.exposeGlobalMethods();
  }

  /**
   * Expose methods globally for other components to use
   */
  exposeGlobalMethods() {
    // Make smooth scroll control available globally
    window.smoothScrollControl = {
      pause: () => {
        console.log('🎯 smoothScrollControl.pause() called');
        return this.pauseScrolling();
      },
      resume: () => {
        console.log('🎯 smoothScrollControl.resume() called');
        return this.resumeScrolling();
      },
      isPaused: () => this.isPausedState(),
      refresh: () => this.refresh(),
      scrollTo: (target, options) => this.scrollTo(target, options),
      
      // 手动测试函数
      test: () => {
        console.log('🧪 Testing smooth scroll control...');
        console.log('Current paused state:', this.isPausedState());
        console.log('Pausing...');
        this.pauseScrolling();
        setTimeout(() => {
          console.log('Resuming...');
          this.resumeScrolling();
        }, 2000);
      }
    };

    // Also expose directly on window.smoothScroll for backwards compatibility
    window.smoothScroll = {
      pauseScrolling: () => {
        console.log('🎯 window.smoothScroll.pauseScrolling() called');
        return this.pauseScrolling();
      },
      resumeScrolling: () => {
        console.log('🎯 window.smoothScroll.resumeScrolling() called');
        return this.resumeScrolling();
      },
      isPaused: this.isPaused,  // 直接暴露状态属性
      refresh: () => this.refresh(),
      scrollTo: (target) => this.scrollTo(target)
    };
    
    console.log('✅ Smooth scroll control methods exposed globally');
    console.log('💡 Test with: window.smoothScrollControl.test()');
  }

  /**
   * Initialize ScrollSmoother
   */
  setupSmoothScroll() {
    try {
      this.smoother = ScrollSmoother.create({
        wrapper: '#smooth-wrapper',
        content: '#smooth-content',
        smooth: 1.2,
        effects: true,
        smoothTouch: 0.1,
        normalizeScroll: true,
        ignoreMobileResize: true
      });

    } catch (error) {
      this.setupFallbackSmoothScroll();
    }
  }

  /**
   * Fallback smooth scroll for browsers that don't support ScrollSmoother
   */
  setupFallbackSmoothScroll() {
    document.documentElement.style.scrollBehavior = 'smooth';
  }

  /**
   * Pause smooth scrolling when offcanvas is open
   */
  pauseScrolling() {
    console.log('🔄 pauseScrolling() method called, isPaused:', this.isPaused);
    
    if (this.isPaused) return;
    
    this.isPaused = true;
    
    if (this.smoother) {
      // Disable ScrollSmoother
      this.smoother.paused(true);
      console.log('✅ ScrollSmoother paused');
    } else {
      // Disable CSS smooth scrolling
      document.documentElement.style.scrollBehavior = 'auto';
      console.log('✅ CSS smooth scrolling disabled');
    }

    // Disable scroll triggers temporarily
    ScrollTrigger.getAll().forEach(trigger => {
      trigger.disable();
    });
    
    console.log('🔄 Smooth scroll paused successfully');
  }

  /**
   * Resume smooth scrolling when offcanvas is closed
   */
  resumeScrolling() {
    console.log('▶️ resumeScrolling() method called, isPaused:', this.isPaused);
    
    if (!this.isPaused) return;
    
    this.isPaused = false;
    
    if (this.smoother) {
      // Re-enable ScrollSmoother
      this.smoother.paused(false);
      console.log('✅ ScrollSmoother resumed');
    } else {
      // Re-enable CSS smooth scrolling
      document.documentElement.style.scrollBehavior = 'smooth';
      console.log('✅ CSS smooth scrolling enabled');
    }

    // Re-enable scroll triggers
    ScrollTrigger.getAll().forEach(trigger => {
      trigger.enable();
    });

    // Refresh ScrollTrigger after resuming
    setTimeout(() => {
      this.refresh();
    }, 100);
    
    console.log('▶️ Smooth scroll resumed successfully');
  }

  /**
   * Refresh ScrollSmoother (call after dynamic content changes)
   */
  refresh() {
    if (this.smoother && !this.isPaused) {
      this.smoother.refresh();
    }
    if (!this.isPaused) {
      ScrollTrigger.refresh();
    }
  }

  /**
   * Get current scroll position
   */
  getScrollY() {
    if (this.smoother) {
      return this.smoother.scrollTop();
    }
    return window.pageYOffset || document.documentElement.scrollTop;
  }

  /**
   * Scroll to specific position or element
   */
  scrollTo(target, options = {}) {
    if (this.isPaused) {
      return;
    }

    const defaultOptions = {
      duration: 1,
      ease: 'power2.out',
      ...options
    };

    if (this.smoother) {
      this.smoother.scrollTo(target, true, defaultOptions.duration);
    } else {
      // Fallback for CSS smooth scrolling
      if (typeof target === 'string') {
        const element = document.querySelector(target);
        if (element) {
          element.scrollIntoView({ behavior: 'smooth' });
        }
      } else if (typeof target === 'number') {
        window.scrollTo({ top: target, behavior: 'smooth' });
      }
    }
  }

  /**
   * Check if smooth scroll is currently paused
   */
  isPausedState() {
    return this.isPaused;
  }
  /**
   * Destroy smooth scroll functionality
   */
  destroy() {
    // Clean up global methods
    if (window.smoothScrollControl) {
      delete window.smoothScrollControl;
    }

    if (this.smoother) {
      this.smoother.kill();
    }
    ScrollTrigger.getAll().forEach(trigger => trigger.kill());
    
    // Reset scroll behavior
    document.documentElement.style.scrollBehavior = 'auto';
    this.isPaused = false;
  }
}
