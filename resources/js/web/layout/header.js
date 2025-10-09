// Header JavaScript functionality for TSport
// Handles offcanvas sidebar and smooth scroll integration

export class HeaderController {
  static instance = null;
  
  constructor() {
    // Prevent multiple instances (singleton pattern)
    if (HeaderController.instance) {
      return HeaderController.instance;
    }
    
    this.offcanvasElement = null;
    this.bsOffcanvas = null;
    this.bootstrapCheckAttempts = 0;
    this.maxBootstrapCheckAttempts = 50; // 5 seconds max wait
    this.autoCloseOnNavigation = true; // Flag to control auto-close behavior
    this.isInitialized = false; // Track initialization status
    this.lastToggleTime = 0; // Track last toggle time to prevent rapid toggles
    this.toggleDebounceDelay = 500; // 500ms between toggles
    
    HeaderController.instance = this;
    this.init();
  }

  init() {
    // Wait for DOM to be ready and bootstrap to be available
    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', () => this.waitForBootstrap());
    } else {
      this.waitForBootstrap();
    }
  }

  waitForBootstrap() {
    this.bootstrapCheckAttempts++;
    
    // Check if bootstrap is available
    if (typeof window.bootstrap !== 'undefined') {
      this.initializeHeader();
    } else if (this.bootstrapCheckAttempts < this.maxBootstrapCheckAttempts) {
      // Wait a bit more for bootstrap to load
      setTimeout(() => this.waitForBootstrap(), 100);
    }
  }

  initializeHeader() {
    // Prevent multiple initialization
    if (this.isInitialized) {
      return;
    }
    
    // Initialize Bootstrap 5 Offcanvas
    this.setupOffcanvas();
    
    // Setup event listeners
    this.setupEventListeners();
    
    // Expose global functions
    this.exposeGlobalFunctions();
    
    this.isInitialized = true;
  }

  setupOffcanvas() {
    this.offcanvasElement = document.getElementById('offcanvas-sidebar');
    
    if (this.offcanvasElement) {
      // Check if bootstrap is available
      if (typeof window.bootstrap !== 'undefined' && window.bootstrap.Offcanvas) {
        // Create Bootstrap offcanvas instance
        this.bsOffcanvas = new window.bootstrap.Offcanvas(this.offcanvasElement, {
          backdrop: true,
          keyboard: true,
          scroll: false
        });
      }
    }
  }

  setupEventListeners() {
    if (!this.offcanvasElement || !this.bsOffcanvas) return;

    // Prevent duplicate event listeners
    if (this.offcanvasElement.hasAttribute('data-events-bound')) {
      return;
    }
    this.offcanvasElement.setAttribute('data-events-bound', 'true');

    // Custom event handlers for smooth scroll integration
    this.offcanvasElement.addEventListener('show.bs.offcanvas', () => {
      // Dispatch custom event for smooth scroll pause
      document.dispatchEvent(new CustomEvent('smoothscroll:pause', {
        detail: { source: 'offcanvas', action: 'open' }
      }));
    });

    this.offcanvasElement.addEventListener('shown.bs.offcanvas', () => {
      // Additional actions after sidebar is fully open
    });

    this.offcanvasElement.addEventListener('hide.bs.offcanvas', () => {
      // Prepare for smooth scroll resume
    });

    this.offcanvasElement.addEventListener('hidden.bs.offcanvas', () => {
      // Dispatch custom event for smooth scroll resume
      document.dispatchEvent(new CustomEvent('smoothscroll:resume', {
        detail: { source: 'offcanvas', action: 'close' }
      }));
    });

    // Handle navigation link clicks - only attach to existing nav links
    const navLinks = this.offcanvasElement.querySelectorAll('.nav-link:not(form .nav-link)');
    
    navLinks.forEach((link, index) => {
      // Prevent duplicate event listeners
      if (!link.hasAttribute('data-sidebar-listener')) {
        link.setAttribute('data-sidebar-listener', 'true');
        
        const href = link.getAttribute('href');
        
        link.addEventListener('click', (e) => {
          // Only close sidebar for actual navigation (not empty links or # links)
          if (href && href !== '#' && href !== 'javascript:void(0)' && this.autoCloseOnNavigation) {
            // Check if it's the same page (no need to close in that case)
            if (href === window.location.pathname) {
              return;
            }
            
            // Add a small delay before closing to allow for any click effects
            setTimeout(() => {
              if (this.bsOffcanvas && this.isOpen()) {
                this.bsOffcanvas.hide();
              }
            }, 150);
          }
        });
      }
    });

    // Handle logout form submission
    const logoutForm = this.offcanvasElement.querySelector('form[action*="logout"]');
    if (logoutForm) {
      logoutForm.addEventListener('submit', () => {
        this.bsOffcanvas.hide();
      });
    }

    // Add click listener to hamburger button to handle manual toggle
    const hamburgerButtons = document.querySelectorAll('[data-bs-target="#offcanvas-sidebar"]');
    
    hamburgerButtons.forEach((hamburgerBtn, index) => {
      if (!hamburgerBtn.hasAttribute('data-debug-listener')) {
        hamburgerBtn.setAttribute('data-debug-listener', 'true');
        
        // Remove Bootstrap's default click behavior to prevent conflicts
        hamburgerBtn.removeAttribute('data-bs-toggle');
        hamburgerBtn.removeAttribute('data-bs-target');
        
        let lastClickTime = 0;
        const debounceDelay = 300; // 300ms debounce
        
        // Add our controlled click handler
        hamburgerBtn.addEventListener('click', (e) => {
          // Always prevent default and stop propagation first
          e.preventDefault();
          e.stopPropagation();
          e.stopImmediatePropagation();
          
          const currentTime = Date.now();
          const timeSinceLastClick = currentTime - lastClickTime;
          
          // Debounce rapid clicks
          if (timeSinceLastClick < debounceDelay) {
            return false;
          }
          
          lastClickTime = currentTime;
          
          // Manually toggle the sidebar
          if (this.bsOffcanvas) {
            if (this.isOpen()) {
              this.bsOffcanvas.hide();
            } else {
              this.bsOffcanvas.show();
            }
          }
          
          return false;
        }, true); // Use capture phase to intercept early
      }
    });
  }

  exposeGlobalFunctions() {
    // Expose offcanvas instance globally
    window.sidebarOffcanvas = this.bsOffcanvas;

    // Global functions for external control with smooth scroll integration
    window.openSidebar = () => {
      if (this.bsOffcanvas && !this.isOpen()) {
        this.bsOffcanvas.show();
        return true;
      }
      return false;
    };

    window.closeSidebar = () => {
      if (this.bsOffcanvas && this.isOpen()) {
        this.bsOffcanvas.hide();
        return true;
      }
      return false;
    };

    window.toggleSidebar = () => {
      if (this.bsOffcanvas) {
        this.bsOffcanvas.toggle();
        return true;
      }
      return false;
    };

    window.isSidebarOpen = () => {
      return this.isOpen();
    };

    window.getSidebarInstance = () => {
      return this;
    };

    // Debug functions to control auto-close behavior
    window.enableSidebarAutoClose = () => {
      this.enableAutoClose();
    };

    window.disableSidebarAutoClose = () => {
      this.disableAutoClose();
    };

    window.isSidebarAutoCloseEnabled = () => {
      return this.isAutoCloseEnabled();
    };
  }

  // Public methods for external use
  open() {
    const currentTime = Date.now();
    if (currentTime - this.lastToggleTime < this.toggleDebounceDelay) {
      return false;
    }
    
    if (this.bsOffcanvas && !this.isOpen()) {
      this.lastToggleTime = currentTime;
      this.bsOffcanvas.show();
      return true;
    }
    return false;
  }

  close() {
    const currentTime = Date.now();
    if (currentTime - this.lastToggleTime < this.toggleDebounceDelay) {
      return false;
    }
    
    if (this.bsOffcanvas && this.isOpen()) {
      this.lastToggleTime = currentTime;
      this.bsOffcanvas.hide();
      return true;
    }
    return false;
  }

  toggle() {
    const currentTime = Date.now();
    if (currentTime - this.lastToggleTime < this.toggleDebounceDelay) {
      return false;
    }
    
    if (this.bsOffcanvas) {
      this.lastToggleTime = currentTime;
      this.bsOffcanvas.toggle();
      return true;
    }
    return false;
  }

  isOpen() {
    return this.offcanvasElement && this.offcanvasElement.classList.contains('show');
  }

  // Methods to control auto-close behavior
  enableAutoClose() {
    this.autoCloseOnNavigation = true;
  }

  disableAutoClose() {
    this.autoCloseOnNavigation = false;
  }

  isAutoCloseEnabled() {
    return this.autoCloseOnNavigation;
  }

  // Cleanup method
  destroy() {
    if (this.bsOffcanvas) {
      this.bsOffcanvas.dispose();
    }
    
    // Clean up global references
    if (window.sidebarOffcanvas === this.bsOffcanvas) {
      delete window.sidebarOffcanvas;
      delete window.openSidebar;
      delete window.closeSidebar;
      delete window.toggleSidebar;
    }
  }
}

export default HeaderController;
