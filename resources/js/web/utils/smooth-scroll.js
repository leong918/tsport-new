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
    this.setupOffcanvasListeners();
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
   * Setup event listeners for offcanvas open/close
   */
  setupOffcanvasListeners() {
    // Listen for Bootstrap offcanvas events
    document.addEventListener('show.bs.offcanvas', () => {
      this.pauseScrolling();
    });

    document.addEventListener('hidden.bs.offcanvas', () => {
      this.resumeScrolling();
    });

    // Listen for custom offcanvas events (if using custom implementation)
    document.addEventListener('offcanvas:open', () => {
      this.pauseScrolling();
    });

    document.addEventListener('offcanvas:close', () => {
      this.resumeScrolling();
    });

    // Listen for custom smooth scroll events
    document.addEventListener('smoothscroll:pause', () => {
      this.pauseScrolling();
    });

    document.addEventListener('smoothscroll:resume', () => {
      this.resumeScrolling();
    });
  }

  /**
   * Pause smooth scrolling when offcanvas is open
   */
  pauseScrolling() {
    if (this.isPaused) return;
    
    this.isPaused = true;
    
    if (this.smoother) {
      // Disable ScrollSmoother
      this.smoother.paused(true);
    } else {
      // Disable CSS smooth scrolling
      document.documentElement.style.scrollBehavior = 'auto';
    }

    // Disable scroll triggers temporarily
    ScrollTrigger.getAll().forEach(trigger => {
      trigger.disable();
    });

    // Dispatch custom event
    document.dispatchEvent(new CustomEvent('smoothscroll:paused', {
      detail: { timestamp: Date.now() }
    }));
  }

  /**
   * Resume smooth scrolling when offcanvas is closed
   */
  resumeScrolling() {
    if (!this.isPaused) return;
    
    this.isPaused = false;
    
    if (this.smoother) {
      // Re-enable ScrollSmoother
      this.smoother.paused(false);
    } else {
      // Re-enable CSS smooth scrolling
      document.documentElement.style.scrollBehavior = 'smooth';
    }

    // Re-enable scroll triggers
    ScrollTrigger.getAll().forEach(trigger => {
      trigger.enable();
    });

    // Refresh ScrollTrigger after resuming
    setTimeout(() => {
      this.refresh();
    }, 100);

    // Dispatch custom event
    document.dispatchEvent(new CustomEvent('smoothscroll:resumed', {
      detail: { timestamp: Date.now() }
    }));
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
    // Remove event listeners
    document.removeEventListener('show.bs.offcanvas', this.pauseScrolling);
    document.removeEventListener('hidden.bs.offcanvas', this.resumeScrolling);
    document.removeEventListener('offcanvas:open', this.pauseScrolling);
    document.removeEventListener('offcanvas:close', this.resumeScrolling);
    document.removeEventListener('smoothscroll:pause', this.pauseScrolling);
    document.removeEventListener('smoothscroll:resume', this.resumeScrolling);

    if (this.smoother) {
      this.smoother.kill();
    }
    ScrollTrigger.getAll().forEach(trigger => trigger.kill());
    
    // Reset scroll behavior
    document.documentElement.style.scrollBehavior = 'auto';
    this.isPaused = false;
  }
}
