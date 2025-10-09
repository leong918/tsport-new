export default class StickyHeader {
  constructor(headerSelector = '#header') {
    this.header = document.querySelector(headerSelector);
    this.isSticky = false;
    this.headerHeight = 0;
    this.originalTop = 0;
    this.ticking = false;
  }

  init() {
    if (!this.header) {
      return;
    }

    this.setupStickyBehavior();
    this.setupResizeHandler();
  }

  setupStickyBehavior() {
    // Get header dimensions
    this.headerHeight = this.header.offsetHeight;
    this.originalTop = this.header.offsetTop;
    
    // Use native scroll event with throttling for better performance
    this.handleScroll = this.handleScroll.bind(this);
    window.addEventListener('scroll', this.onScroll.bind(this), { passive: true });
    
    // Initial check
    this.handleScroll();
  }

  onScroll() {
    if (!this.ticking) {
      requestAnimationFrame(() => {
        this.handleScroll();
        this.ticking = false;
      });
      this.ticking = true;
    }
  }

  handleScroll() {
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    const shouldBeSticky = scrollTop > this.originalTop;

    if (shouldBeSticky && !this.isSticky) {
      this.makeSticky();
    } else if (!shouldBeSticky && this.isSticky) {
      this.removeSticky();
    }
  }

  makeSticky() {
    this.isSticky = true;
    this.header.classList.add('is-sticky');
    
    // Add sticky styles
    this.header.style.position = 'fixed';
    this.header.style.top = '0';
    this.header.style.left = '0';
    this.header.style.right = '0';
    this.header.style.zIndex = '1000';
    this.header.style.width = '100%';
    
    // Add padding to body to prevent content jump
    document.body.style.paddingTop = this.headerHeight + 'px';
  }

  removeSticky() {
    this.isSticky = false;
    this.header.classList.remove('is-sticky');
    
    // Remove sticky styles
    this.header.style.position = '';
    this.header.style.top = '';
    this.header.style.left = '';
    this.header.style.right = '';
    this.header.style.zIndex = '';
    this.header.style.width = '';
    
    // Remove padding from body
    document.body.style.paddingTop = '';
  }

  setupResizeHandler() {
    const handleResize = () => {
      // Recalculate dimensions on resize
      this.headerHeight = this.header.offsetHeight;
      this.originalTop = this.header.offsetTop;
      
      // Update body padding if currently sticky
      if (this.isSticky) {
        document.body.style.paddingTop = this.headerHeight + 'px';
      }
    };

    // Use ResizeObserver if available
    if (window.ResizeObserver) {
      const resizeObserver = new ResizeObserver(handleResize);
      resizeObserver.observe(this.header);
    }
    
    // Fallback for older browsers
    window.addEventListener('resize', handleResize);
  }

  destroy() {
    // Remove event listeners
    window.removeEventListener('scroll', this.onScroll);
    window.removeEventListener('resize', this.setupResizeHandler);
    
    // Remove sticky state if active
    if (this.isSticky) {
      this.removeSticky();
    }
  }
}
